<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\EmailAppPassword;
use Auth;
use App\Models\EmailAttachmentSyncRequest;
use App\Jobs\EmailAttachmentSyncRequestJob;
use Carbon\Carbon;
use App\Models\Analysis;

class AnalyseController extends Controller
{
	function analyse()
	{
		return view('pages.analyse.analyse');
	}
	function getMatchResult(Request $request)
	{
		$file1 = $request->file('resume');
		$file2 = $request->file('jd');
		if ($file1 && $file2) {
			$file1Path = $file1->path();
			$file2Path = $file2->path();
			$client = new Client();
			try {
				$response = $client->post('https://happyhire.co.in/upload/Resume_matching', [
					'multipart' => [
						[
							'name'     => 'resume',
							'contents' => fopen($file1Path, 'r'),
							'filename' => $file1->getClientOriginalName(),
						],
						[
							'name'     => 'jd',
							'contents' => fopen($file2Path, 'r'),
							'filename' => $file2->getClientOriginalName(),
						],
					],
				]);

				// Handle the API response if needed
				$statusCode = $response->getStatusCode();
				$responseBody = $response->getBody()->getContents();



				$data =  json_decode($responseBody, true);
				$data =  (object) $data;
				$missing_keywords = $data->data['missing_keywords'];
				$match_keywords = $data->data['match_keywords'];



				$status = $data->status ?? '';
				$message = $data->message ?? '';

				$score = $data->data['score'][0] ?? 0;


				//Missing Keywords
				$missing_tools_and_technologies = $missing_keywords['Tools_and_technologies'] ?? [];
				$missing_role = $missing_keywords['Role'] ?? [];
				$missing_concepts = $missing_keywords['Concepts'] ?? [];
				$missing_education = $missing_keywords['Education'] ?? [];
				$missing_yrs_of_exp = $missing_keywords['Yrs_of_Exp'] ?? [];


				//Match Keywords
				$matching_tools_and_technologies = $match_keywords['Tools_and_technologies'] ?? [];
				$matching_role = $match_keywords['Role'] ?? [];
				$matching_concepts = $match_keywords['Concepts'] ?? [];
				$matching_education = $match_keywords['Education'] ?? [];
				$matching_yrs_of_exp = $match_keywords['Yrs_of_Exp'] ?? [];

				$table = view('pages.analyse.resume_matching_result', compact('score', 'missing_tools_and_technologies', 'missing_role', 'missing_concepts', 'missing_education', 'missing_yrs_of_exp', 'matching_tools_and_technologies', 'matching_role', 'matching_concepts', 'matching_education', 'matching_yrs_of_exp'))->render();


				$analysis = new Analysis();
				$analysis->user_id = Auth::user()->id;
				$analysis->software_category = Auth::user()->software_category;
				$analysis->save();


				return response()->json(['status' => 200, 'response' => $table]);
			} catch (\Exception $e) {
				// Handle any exceptions that might occur during the API call
				$table = view('master.404')->render();
				return response()->json(['status' => 500, 'response' => $table, 'message' => $e->getMessage()]);
			}
		}

		return 'Please upload both files.';
	}

	public function showResult(Request $request)
	{
		$data = json_decode(json_encode($request->response));
		$status = $data->status ?? '';
		$message = $data->message ?? '';

		$score = $data->data->score[0] ?? 0;

		//Missing Keywords
		$missing_tools_and_technologies = $data->data->missing_keywords->Tools_and_technologies ?? [];
		$missing_role = $data->data->missing_keywords->Role ?? [];
		$missing_concepts = $data->data->missing_keywords->Concepts ?? [];
		$missing_education = $data->data->missing_keywords->Education ?? [];
		$missing_yrs_of_exp = $data->data->missing_keywords->Yrs_of_Exp ?? [];


		//Match Keywords
		$matching_tools_and_technologies = $data->data->match_keywords->Tools_and_technologies ?? [];
		$matching_role = $data->data->match_keywords->Role ?? [];
		$matching_concepts = $data->data->match_keywords->Concepts ?? [];
		$matching_education = $data->data->match_keywords->Education ?? [];
		$matching_yrs_of_exp = $data->data->match_keywords->Yrs_of_Exp ?? [];

		return view('pages.analyse.resume_matching_result', compact('score', 'missing_tools_and_technologies', 'missing_role', 'missing_concepts', 'missing_education', 'missing_yrs_of_exp', 'matching_tools_and_technologies', 'matching_role', 'matching_concepts', 'matching_education', 'matching_yrs_of_exp'));
	}

	public function sync_email_attachments()
	{
		$account_detail = EmailAppPassword::where('user_id', Auth::user()->id)->first();
		$sync_requests = EmailAttachmentSyncRequest::where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get();
		return view('pages.analyse.sync_email_attachments', compact('account_detail', 'sync_requests'));
	}

	public function sync_email_attachments_store(Request $request)
	{
		$logged_in_user_id = Auth::user()->id;
		if (!empty($request->want_to_save)) {
			$app_password = EmailAppPassword::where('user_id', $logged_in_user_id)->first();
			if (empty($app_password)) {
				$app_password = new EmailAppPassword;
			}
			$app_password->user_id = $logged_in_user_id;
			$app_password->email_address = $request->email_address;
			$app_password->app_password = $request->app_password;
			$app_password->account_type = $request->account_type;
			$app_password->save();
		}

		$sync_request = new EmailAttachmentSyncRequest();
		$sync_request->user_id = $logged_in_user_id;
		$sync_request->email = $request->email_address;
		$sync_request->app_password = $request->app_password;
		$sync_request->account_type = $request->account_type;
		$sync_request->from_date = $request->from_date;
		$sync_request->to_date = $request->to_date;
		$sync_request->software_category = Auth::user()->software_category;
		$sync_request->save();

		//EmailAttachmentSyncRequestJob::dispatch($sync_request->id)->delay(Carbon::today()->setTime(23, 0, 0));
		EmailAttachmentSyncRequestJob::dispatch($sync_request->id);
		return back()->withSuccess('Your request is successfully generated. Attachment will sync sortly');
	}

	public function delete_sync_request($id)
	{
		if (!empty($id)) {
			EmailAttachmentSyncRequest::where('id', $id)->delete();
		}
		return back()->withSuccess('Your request is successfully deleted');
	}

	public function checkemail()
	{
		$url = 'https://happyhire.co.in/mail_parsing/api/';
		$data = [
			"type"       => "gmail",
			"email"      => "rneeta867@gmail.com",
			"password"   => "ewvfjfqwezzbvelg",
			"start_date" => "25-07-2023",
			"end_date"   => "26-07-2023"
		];

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($curl);
		return $response;
		$click_res = json_decode($response);
		dd($click_res);
	}

	
	public function multiple_resume_matching(){
        return view('pages.analyse.multiple_resume_matching');
	}

	public function multiple_resume_matching_result(Request $request){
		$client = new Client();
		
		$apiEndpoint = 'https://happyhire.co.in/bulk_best_candidate/api/';
		
		$multipart = [];

		foreach ($request->file('resumes') as $file) {
			$multipart[] = [
				'name' => 'res',
				'contents' => fopen($file, 'r'),
				'filename' => $file->getClientOriginalName(),
			];
		}

		$jdFile = $request->file('jd');
		$multipart[] = [
			'name' => 'jd',
			'contents' => fopen($jdFile, 'r'),
			'filename' => $jdFile->getClientOriginalName(),
		];
		$response = $client->post($apiEndpoint, [
			'multipart' => $multipart,
		]);

		$statusCode = $response->getStatusCode();
		$responseBody = $response->getBody()->getContents();
        $responseBodyData = json_decode($responseBody);
		$resumes = $responseBodyData->resume;
		$best_candidates = $responseBodyData->best_candidate;
		
		$tools_and_technologies = 'Tools and technologies';
		
		return view('pages.analyse.multiple_resume_matching_data',compact('resumes','best_candidates','tools_and_technologies'));
	}
}
