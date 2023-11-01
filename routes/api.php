<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CandidateResponseController;
use App\Http\Controllers\ChromeExtensionController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\NewJobPostingController;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods: POST,GET,OPTIONS');


route::get('position_report',[HomeController::class,'positionReport']);

/*********************Allot Client*************************/
Route::get('getUserList/{software_category}',[ApiController::class,'getUserListByType']);
Route::post('allot-client-to-manager',[ApiController::class,'allotClientManager']);
Route::get('UserName/{id}',[ApiController::class,'UserName']);
/*********************Allot Client*************************/

/*********************Chrome Extension*************************/
Route::post('login-from-extension',[ChromeExtensionController::class,'userLoginFromExtension']);
Route::post('strore-candidate-profile-data',[ChromeExtensionController::class,'storeCandidateProfileData']);
/*********************Chrome Extension*************************/

Route::post('send-to-linkedin/{id}',[CommonController::class, 'sendToLinkedin']);
Route::post('send-to-shine/{id}',[CommonController::class, 'sendToShine']);
Route::post('clickindia/{job_id}/{id}',[CommonController::class, 'sendToClickIndia']);
Route::post('facebook/{job_id}',[CommonController::class, 'sendToFacebookGroup']);
Route::post('jobsora/{job_id}',[NewJobPostingController::class, 'sendToJobsora']);
Route::post('Learn4Good/{job_id}',[NewJobPostingController::class, 'sendToLearn4Good']);Route::post('jobgrin/{job_id}',[NewJobPostingController::class, 'sendtojobgrin']);
Route::post('careerbliss/{job_id}',[NewJobPostingController::class, 'sendToCareerBliss']);Route::post('theindiajob/{job_id}',[NewJobPostingController::class, 'sendToTheIndiaJob']);Route::post('jobrapido/{job_id}',[NewJobPostingController::class, 'sendToJobRapido']);Route::post('talent/{job_id}',[NewJobPostingController::class, 'sendToTalentJob']);
Route::post('eluta/{job_id}',[NewJobPostingController::class, 'sendToEluta']);
Route::post('jobisite/{job_id}',[NewJobPostingController::class, 'sendToJobisite']);Route::post('jobswype/{job_id}',[NewJobPostingController::class, 'sendToJobswype']);Route::post('workcircle/{job_id}',[NewJobPostingController::class, 'sendToWorkCircle']);Route::post('juju/{job_id}',[NewJobPostingController::class, 'sendToJuju']);
Route::post('econ/{job_id}',[NewJobPostingController::class, 'sendToEconJob']);
Route::post('cari/{job_id}',[NewJobPostingController::class, 'sendToCariJob']);
Route::post('bebee/{job_id}',[NewJobPostingController::class, 'sendToBebeeJob']);





Route::get('getshine',[CandidateResponseController::class, 'getresponseshine']);

Route::post('apply_candidate_happiest',[CandidateResponseController::class, 'candidateFromHappiest']);
