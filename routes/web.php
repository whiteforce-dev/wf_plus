<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyseController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateResponseController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\Integrations\ConfigrationController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\JobDescriptionController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\MonthlyTargetController;
use App\Http\Controllers\NewJobPostingController;
use App\Http\Controllers\NewPositionController;
use App\Http\Controllers\PipelineController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatedCandidateController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ShineController;
use App\Http\Controllers\ShineTestController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TimesjobController;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\JoiningCandidateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

date_default_timezone_set("Asia/kolkata");

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {

    route::get('welcome', function () {
        Cache::forget('dashboard_view_cache_' . Auth::user()->id);
        Cache::forget('position_list_cache_' . Auth::user()->id);
        return redirect('dashboard');
        // return view('welcome');
    });

    Route::get('refresh-cache/{param}', [HomeController::class, 'refreshCache']);
    // Redirect To Welcome and Home
    route::get('/', function () {
        Cache::forget('dashboard_view_cache_' . Auth::user()->id);
        Cache::forget('position_list_cache_' . Auth::user()->id);
        return redirect('dashboard');
    });
    route::get('v2/login', function () {
        return view('pages.login');
    });

    route::get('/home', function () {
        Cache::forget('dashboard_view_cache_' . Auth::user()->id);
        Cache::forget('position_list_cache_' . Auth::user()->id);
        return redirect('dashboard');
    });

    //logout User
    route::get('logout', [HomeController::class, 'logOut']);

    //Change Admin Category
    route::get('change-admin-category', [HomeController::class, 'changeAdminCategory']);
    Route::get('profileSetting/{id}', [ProfileController::class, 'ProfileSetting']);
    Route::post('updateprofile/{id}', [ProfileController::class, 'updateProfile']);
    Route::get('changepassword/{id}', [ProfileController::class, 'ChangePassword']);
    Route::Any('updatepassword/{id}', [ProfileController::class, 'UpdatePassword']);

    // Dashboard Section
    Route::prefix('dashboard')->group(function () {
        route::get('/', [HomeController::class, 'index']);
        route::get('company-count', [HomeController::class, 'companyCount']);
        route::get('position-count', [HomeController::class, 'positionCount']);
        route::get('candidate-count', [HomeController::class, 'candidateCount']);
        route::get('open-close-position', [HomeController::class, 'openClosePosition']);
        route::get('candidate-stats', [HomeController::class, 'candidateStats']);
        route::get('joined-stats', [HomeController::class, 'joinedStats']);
        route::get('target-stats', [HomeController::class, 'targetStats']);
    });

    route::get('position_report', [HomeController::class, 'positionReport']);
    route::get('company_report', [HomeController::class, 'companyReport']);
    route::get('offered_report', [HomeController::class, 'offeredReport']);
    route::get('interview_report', [HomeController::class, 'interviewReport']);
    route::get('manager_vise_interview', [HomeController::class, 'getInterview']);
    route::get('manager_vise_offered', [HomeController::class, 'getOffered']);

    // Admin Can Login Any User
    Route::get('login-as-user/{userId}', [AdminController::class, 'loginAsUser'])->name('login_as_user');
    Route::get('back-to-admin', [AdminController::class, 'backToAdmin'])->name('back_to_admin');

    // User Create Section
    Route::resource('user', UserController::class);

    Route::get('edit-profile', [UserController::class, 'editProfile']);
    Route::get('left-resion/{id}', [UserController::class, 'leftResion']);
    Route::get('get-parent-user', [UserController::class, 'getParentUser']);

    //User Target Section
    // Route::get('target', [TargetController::class, 'userTarget']);
    // Route::get('manager-team-target/{manager}', [TargetController::class, 'managerTeamTarget']);
    // Route::get('manager-team-target-edit/{manager}', [TargetController::class, 'managerTeamTargetEdit']);
    // Route::post('save-user-target', [TargetController::class, 'saveUserTarget']);
    // Route::post('update-user-target', [TargetController::class, 'updateUserTarget']);

    Route::get('target', [MonthlyTargetController::class, 'target']);
    Route::get('team-target/{manager}', [MonthlyTargetController::class, 'teamTarget']);
    Route::post('save-user-monthly-target', [MonthlyTargetController::class, 'saveUserTarget']);

    //Target section
    Route::get('assinge-target', [TargetController::class, 'assingeTarget']);

    // Client Section kapil//
    Route::resource('client', ClientController::class);
    Route::post('allotOldClients', [ClientController::class, 'allotOldClients']);

    // Hr Section
    Route::resource('hr', HrController::class);

    //Position SectionPosition
    Route::resource('position', PositionController::class);
    Route::get('search-position', [PositionController::class, 'searchPosition']);
    Route::get('get-portal-form', [PositionController::class, 'getPortalForm']);

    Route::get('position-hold/{positionId}', [PositionController::class, 'positionhold']);
    Route::get('position-unhold/{positionId}', [PositionController::class, 'positionunhold']);
    Route::get('position-close/{positionId}', [PositionController::class, 'positionclose']);
    Route::get('position-open/{positionId}', [PositionController::class, 'positionopen']);
    // Route::get('stagechange', [PositionController::class, 'stagechange']);
    Route::get('applied-candidate/{positionId}', [PositionController::class, 'appliedCandidate']);
    // Route::get('share-position/{positionId}', [PositionController::class, 'sharePosition'])->name('Position.sharePosition');
    // Route::Post('position-shared-to/{positionId}', [PositionController::class, 'sharePositionTo'])->name('Position.sharePositionTo');
    Route::get('job-postion-report/{positionId}', [PositionController::class, 'jobPostingReport'])->name('Position.jobPostingReport');
    Route::any('changestage/{id?}/{stageName?}', [PositionController::class, 'changestage']);
    Route::Post('position-search/{id?}', [PositionController::class, 'positionSearch']);
    Route::get('show-job-posting-full-report', [PositionController::class, 'jobPostingReport']);
    Route::get('get-job-template', [PositionController::class, 'getTemplate']);

    // Show created template in add postion form
    Route::get('position/position/create/{id}', [PositionController::class, 'getDescription']);
    Route::get('job-posting-reports', [PositionController::class, 'jobPostingReports']);
    Route::get('position-details/{id}', [PositionController::class, 'positionInfo']);

    Route::get('position-closed', [PositionController::class, 'closedPosition']);
    Route::get('position-hold', [PositionController::class, 'holdPosition']);

    Route::get('show-managerlist', [PositionController::class, 'showManagerList']);
    Route::post('sharedmanager', [PositionController::class, 'sharedmanager']);
    Route::get('get-specilization', [PositionController::class, 'getSpecilization']);

    //Shine
    Route::get('getShineCity', [ShineController::class, 'getShineCity']);
    Route::get('getShineEducationStream', [ShineController::class, 'getShineEducationStream']);
    Route::get('findShineCity', [ShineController::class, 'findShineCity']);
    Route::get('findShineEducationStream', [ShineController::class, 'findShineEducationStream']);

    // Monster
    Route::get('getCategoryRole', [MonsterController::class, 'getCategoryRole']);
    Route::get('getMonsterEducationStream', [MonsterController::class, 'getMonsterEducationStream']);
    Route::get('getnoukriugspec', [MonsterController::class, 'getNoukriugspec']);
    Route::get('getnoukripgspec', [MonsterController::class, 'getNoukripgspec']);
    Route::get('noukri_functional_role', [MonsterController::class, 'noukri_functional_role']);
    Route::get('getIndustryCategoryFunction', [MonsterController::class, 'getIndustryCategoryFunction']);

    //Times Job Controller
    Route::any('sendTotimesjobs_test', [TimesjobController::class, 'sendTotimesjobs_test']);
    Route::any('times_farea', [TimesjobController::class, 'times_farea']);
    route::any('timesjob-candidate', [TimesjobController::class, 'timesjobCandidateResponse']);
    Route::any('authenticate', [TimesjobController::class, 'authenticate']);
    Route::any('sendapijobs', [TimesjobController::class, 'call_cURL']);
    Route::any('times_jobs_text', [TimesjobController::class, 'times_jobs_text']);
    Route::get('times_greduation', [TimesjobController::class, 'times_greduation']);
    Route::get('times_post_greduation', [TimesjobController::class, 'times_post_greduation']);
    Route::any('sendTotimesjobs', [TimesjobController::class, 'sendTotimesjobs']);

    //candidate Section
    Route::resource('candidate', CandidateController::class);
    Route::post('candidate/details', [CandidateController::class, 'candidateDetails']);
    Route::post('interview-form/{id}/{positionId}', [CandidateController::class, 'interviewForm']);
    Route::get('send_mail_to_candidate', [CandidateController::class, 'sendMail']);

    // Job template create edit delete controller
    Route::resource('job_description', JobDescriptionController::class);
    Route::post('set-interview', [CandidateController::class, 'set_interview']);
    Route::post('set-interview-multiple', [CandidateController::class, 'set_interview_multiple']);
    Route::post('set-offer-detail', [CandidateController::class, 'setOfferDetail']);
    Route::get('sendbirthday/{hr}', [CandidateController::class, 'sendbirthdaymail']);

    //Hr investment Section //
    Route::resource('investment', InvestmentController::class);
    Route::get('gift-details/{id}', [InvestmentController::class, 'giftDetail']);
    Route::post('save-investment/{id}', [InvestmentController::class, 'saveInvestment']);
    Route::get('delete-investment/{id}', [InvestmentController::class, 'deleteInvestment']);
    Route::get('edit-investment/{id}', [InvestmentController::class, 'editInvestment']);
    Route::post('update-investment/{id}', [InvestmentController::class, 'updateInvestment']);
    Route::get('show-investment/{id}', [InvestmentController::class, 'showInvestment']);
    Route::get('consolidated-investment', [InvestmentController::class, 'hrConsolidate']);

    // Candidate section
    Route::resource('candidate', CandidateController::class);
    Route::get('bh', [CandidateController::class, 'bh']);
    Route::get('batch', [CandidateController::class, 'createBatchHeader']);

    Route::post('get-position-list', [CandidateController::class, 'getPositionList']);
    Route::post('add-candidate-to-multiple-pipeline', [CandidateController::class, 'addToMultiplePipeline']);
    Route::post('get-candidate-history', [CandidateController::class, 'getHistory']);
    // Candidate response section //
    Route::get('all_responses/{job_id}/{portal}/{data}', [CandidateResponseController::class, 'allResponses'])->name('all_responses');
    // Route::get('revert-candidate-add',[CandidateResponseController::class, 'getPositionList']);

    Route::get('global_serch', function () {
        return view('pages.candidate.global_serch');
    });

    // New Position Controller
    Route::post('newPositionStore/{id}', [NewPositionController::class, 'sendToShine']);

    //Sheet Section //

    Route::get('sheet_view', [SheetController::class, 'sheet_view']);
    Route::get('sheet/{id}', [SheetController::class, 'sheet']);
    Route::post('importExcel', [SheetController::class, 'importExcel']);
    Route::post('calling-sheet-delete/{id}', [SheetController::class, 'callingSheetDelete']);
    Route::post('delete_excel/{id}', [SheetController::class, 'deleteExcel']);
    Route::get('bulk_delete/', [SheetController::class, 'bulkDelete']);
    Route::get('bulk_delete_sheetdata/', [SheetController::class, 'bulkDeleteSheet']);
    Route::get('add_manager_remark/{id}', [SheetController::class, 'addManagerRemark']);

    //Pipeline-
    Route::get('position/pipeline/{id}', [PipelineController::class, 'index']);
    Route::get('add-candidate-to-pipeline/{id}', [PipelineController::class, 'addCandidateToPipeline']);
    Route::get('remove-candidate-from-pipeline', [PipelineController::class, 'removeCandidateFromPipeline']);
    Route::get('assign_to_pipeline', [PipelineController::class, 'assignToPipeline']);
    Route::get('get-candidate-by-query', [PipelineController::class, 'getCandidateByQuery']);
    Route::get('candidate-move-to-stage', [PipelineController::class, 'candidateMoveToStage']);
    Route::get('open-schedule-interview-modal/{pipeline}', [PipelineController::class, 'openInterviewScheduleForm']);
    Route::get('open-schedule-interview-modal-multiple', [PipelineController::class, 'openInterviewScheduleFormMultiple']);
    Route::get('open-offerd-interview-modal/{pipeline}', [PipelineController::class, 'openOfferedForm']);
    Route::get('open-joined-modal/{pipeline}', [PipelineController::class, 'openJoinedForm']);
    Route::post('saved-joined-details', [PipelineController::class, 'savedJoinedDetails']);

    Route::get('get-candidate-accroding-stage', [PipelineController::class, 'getCandidateAccrodingStage']);
    Route::get('pipeline-stage-update', [PipelineController::class, 'pipelineStageUpdate']);

    Route::get('candidate-batch-header/{pipeline_id}/{position_id}/{candidate_id}', [PipelineController::class, 'candidateBatchHeader']);
    Route::post('download-bulk-batch-header', [PipelineController::class, 'downloadBulkBatchHeader']);
    Route::get('download-single-batch-header/{filename}', [PipelineController::class, 'downloadSingleBatchHeader']);
    Route::get('matching-percentage', [PipelineController::class, 'matching_percentage']);
    Route::get('deleteBatchHeader', [PipelineController::class, 'deleteBatchHeader']);

    //created by shanki add country state city
    route::get('get-state/{country}', [LocationController::class, 'stateList']);
    route::get('get-city/{state}', [LocationController::class, 'cityList']);

    Route::get('addCountry', [LocationController::class, 'addCountry']);
    Route::post('storeCountry', [LocationController::class, 'storeCountry']);
    Route::any('editCountry/{id}', [LocationController::class, 'EditCountry']);
    Route::any('updateCountry/{id}', [LocationController::class, 'UpdateCountry']);
    Route::any('deleteCountry/{id}', [LocationController::class, 'deleteCountry']);

    Route::get('addState', [LocationController::class, 'AddState']);
    Route::post('storeState', [LocationController::class, 'storeState']);
    Route::any('/select-state/{id}', [LocationController::class, 'getState']);
    Route::any('statelist', [LocationController::class, 'getStateList']);
    Route::any('editState/{id}', [LocationController::class, 'EditState']);
    Route::any('updateState/{id}', [LocationController::class, 'UpdateState']);
    Route::any('deleteState/{id}', [LocationController::class, 'deleteState']);

    Route::get('addCity', [LocationController::class, 'AddCity']);
    Route::post('storecity', [LocationController::class, 'storeCity']);
    Route::any('editCity/{id}', [LocationController::class, 'EditCity']);
    Route::any('updateCity/{id}', [LocationController::class, 'UpdateCity']);
    Route::any('deleteCity/{id}', [LocationController::class, 'deleteCity']);

    //Related Candidate
    Route::get('related_candidate/{position_id}', [RelatedCandidateController::class, 'related_candidate'])->name('related_candidate');
    Route::post('send-related-candidate-mail', [RelatedCandidateController::class, 'send_related_candidate_mail']);
    Route::get('related_candidate/view-mail-revert/{position_id}', [RelatedCandidateController::class, 'view_mail_revert']);
    Route::post('related_candidate/view-mail-revert-search', [RelatedCandidateController::class, 'view_mail_revert_search']);
    Route::get('test', [RelatedCandidateController::class, 'test'])->name('test');

    //Reports Section
    Route::get('getChildrenRollWiseWithParent/{id}', [ReportsController::class, 'getChildrenRollWiseWithParent']);
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportsController::class, 'index']);
        Route::get('/monthly-target-report', [ReportsController::class, 'monthly_target_report']);
        Route::post('/monthly-target-report', [ReportsController::class, 'monthly_target_report_data']);

        Route::get('/month-wise-report', [ReportsController::class, 'month_wise_report']);
        Route::post('/month-wise-report', [ReportsController::class, 'month_wise_report_data']);

        Route::get('/quarter-wise-report', [ReportsController::class, 'quarter_wise_report']);
        Route::post('/quarter-wise-report', [ReportsController::class, 'quarter_wise_report_data']);

        Route::get('/interview-pannel-report', [ReportsController::class, 'interview_pannel_report']);
        Route::post('/interview-pannel-report', [ReportsController::class, 'interview_pannel_report_data']);
        Route::any('/hr_birthdays', [ReportsController::class, 'hr_birthdays']);

        Route::get('/calling-sheet-report', [ReportsController::class, 'calling_sheet_report']);
        Route::post('/calling-sheet-report', [ReportsController::class, 'calling_sheet_report_data']);

        Route::get('/company-report', [ReportsController::class, 'company_report']);
        Route::post('/company-report', [ReportsController::class, 'company_report_data']);

        Route::get('/daily-lineup-report', [ReportsController::class, 'daily_lineup_report']);
        Route::post('/daily-lineup-report', [ReportsController::class, 'daily_lineup_report_data']);
        Route::post('/get-lineup-report', [ReportsController::class, 'get_lineup_report_data']);
        Route::post('/get-user-child', [ReportsController::class, 'get_user_child']);
        Route::post('/pipeline-report', [ReportsController::class, 'pipeline_report_data']);
        Route::get('/pipeline-report', [ReportsController::class, 'pipeline_report']);Route::get('/client-portal-jobs', [ReportsController::class, 'client_portal_jobs']);Route::get('/applied-candidate-report', [ReportsController::class, 'applied_candidate_report']);
        Route::post('/applied-candidate-report-data', [ReportsController::class, 'applied_candidate_report_data']);

        //LeaderBoard
        route::get('leader-board', [LeaderboardController::class, 'leaderBoard']);

        Route::get('/chrome-extension-report', [ReportsController::class, 'chrome_extension_report']);
        Route::post('/chrome-extension-report', [ReportsController::class, 'chrome_extension_report_data']);
        Route::post('/get-extension-data', [ReportsController::class, 'get_extension_data']);

        Route::get('/joining-report', [ReportsController::class, 'joining_report']);
        Route::post('/joining-report', [ReportsController::class, 'joining_report_data']);

        Route::get('/joining-consolidate-report', [ReportsController::class, 'consolidate_report']);
        Route::post('/joining-consolidate-report', [ReportsController::class, 'consolidate_report_data']);

        Route::get('/requirement-report', [ReportsController::class, 'requirement_report']);
        Route::post('/requirement-report', [ReportsController::class, 'requirement_report_data']);

        Route::get('/month-joining-report', [ReportsController::class, 'month_joining_report']);
        Route::post('/month-joining-report', [ReportsController::class, 'month_joining_report_data']);


        Route::get('/job-analysis-report', [ReportsController::class, 'job_analysis_report']);
        Route::post('/job-analysis-report', [ReportsController::class, 'job_analysis_report_data']);
    });

    // Job Match With Resume
    Route::get('analyse', [AnalyseController::class, 'analyse']);
    Route::post('get-match-result', [AnalyseController::class, 'getMatchResult']);
    Route::post('show-result', [AnalyseController::class, 'showResult']);
    Route::get('delete_sync_request/{id}', [AnalyseController::class, 'delete_sync_request']);

    //email attachment syncing
    Route::get('sync_email_attachments', [AnalyseController::class, 'sync_email_attachments']);
    Route::post('sync_email_attachments', [AnalyseController::class, 'sync_email_attachments_store']);
    Route::get('checkemail', [AnalyseController::class, 'checkemail']);

    //Multiple resume matching
    Route::get('multiple_resume_matching', [AnalyseController::class, 'multiple_resume_matching']);
    Route::post('multiple_resume_matching', [AnalyseController::class, 'multiple_resume_matching_result']);
});

//Events
Route::any('add-events', [EventsController::class, 'index']);
Route::any('store-emp-event', [EventsController::class, 'StoreEvent']);
Route::any('delete-event/{id}', [EventsController::class, 'DeleteEvent']);
Route::get('/compareJsonToTable', [RelatedCandidateController::class, 'compareJsonToTable']);
Route::get('saveClientData', [ClientController::class, 'saveClientData']);

//Candidate Reponse
Route::get('apply_candidate_form/{id}/{portal}', [CandidateResponseController::class, 'appliedCandidate']);
Route::post('applied_candidate', [CandidateResponseController::class, 'candidateFromPortal']);
Route::get('facebook/{id}', [CommonController::class, 'sendToFacebookGroup']);

//preescreening form
Route::get('prescreening', [RelatedCandidateController::class, 'prescreening']);
Route::post('prescreening/store-data/{id}', [RelatedCandidateController::class, 'prescreeningStoreData']);
Route::get('prescreening/thank-you', function () {
    return view('pages.related_candidate.prescreening.thankyou_page');
});

// Tracker
Route::post('download-tracker', [TrackerController::class, 'exportToExcel']);
Route::get('cloneCandidateData', [CandidateController::class, 'cloneCandidateData']);

//Check
Route::get('test', [CandidateController::class, 'test']);

Route::get('download/{path}', [CandidateController::class, 'download']);

//Client Purposes Only
Route::prefix('showcase/v2/sushma')->group(function () {
    Route::get('integration', [ConfigrationController::class, 'integration']);
    Route::post('add-integration-details', [ConfigrationController::class, 'add_integration']);
    Route::get('add-team-member/{id}', [ConfigrationController::class, 'add_member']);
    Route::post('store-member-details', [ConfigrationController::class, 'store_member']);
});

// shine job posting test
Route::get('shine-job-test', [ShineTestController::class, 'shineForm']);
Route::post('get-shine-details', [ShineTestController::class, 'shineFormSubmit']);

// new job posting test routes

Route::get('jobisite', [NewJobPostingController::class, 'jobisite']);
Route::post('send-to-jobisite', [NewJobPostingController::class, 'sendToJobisite']);
Route::get('greenhouse', [NewJobPostingController::class, 'greenhouse']);
Route::post('send-to-greenhouse', [NewJobPostingController::class, 'sendToGreenhouse']);
Route::get('monster', [NewJobPostingController::class, 'monster']);
Route::post('send-to-monster', [NewJobPostingController::class, 'sendToMonster']);
Route::get('learn4good', [NewJobPostingController::class, 'learn4good']);
Route::post('send-to-learn4good', [NewJobPostingController::class, 'sendToLearn4good']);
Route::get('eluta', [NewJobPostingController::class, 'eluta']);
Route::post('send-to-eluta', [NewJobPostingController::class, 'sendToEluta']);
Route::get('jobgrin', [NewJobPostingController::class, 'jobgrin']);
Route::post('send-to-jobgrin', [NewJobPostingController::class, 'sendToJobgrin']);
Route::get('jobinventory', [NewJobPostingController::class, 'jobinventory']);
Route::post('send-to-jobinventory', [NewJobPostingController::class, 'sendToJobinventory']);
Route::get('careerbliss', [NewJobPostingController::class, 'careerbliss']);
Route::post('send-to-careerbliss', [NewJobPostingController::class, 'sendToCareerbliss']);
Route::get('jobswype', [NewJobPostingController::class, 'jobswype']);
Route::post('send-to-jobswype', [NewJobPostingController::class, 'sendToJobswype']);
Route::get('clickIndia', [NewJobPostingController::class, 'clickIndia']);
Route::post('send-to-clickIndia', [NewJobPostingController::class, 'sendToClickIndia']);
Route::get('new-monster', [NewJobPostingController::class, 'newMonster']);
Route::get('getIndustry', [NewJobPostingController::class, 'getIndustry']);
Route::post('send-to-newmonster', [NewJobPostingController::class, 'sendToNewMonster']);
Route::get('talent', [NewJobPostingController::class, 'talent']);
Route::get('reed', [NewJobPostingController::class, 'reed']);
Route::post('send-to-reed', [NewJobPostingController::class, 'sendToReed']);


// existing job posting route whiteforce
Route::post('add-position', [JobPostingController::class, 'position']);
Route::get('job-is-job', [JobPostingController::class, 'jobisjob']);
Route::get('new-monster', [JobPostingController::class, 'newMonster']);
Route::get('getIndustry', [PositionController::class, 'getIndustry']);
Route::post('send-to-newmonster', [JobPostingController::class, 'sendToNewMonster']);
Route::get('userTxt', [NewJobPostingController::class, 'user']);
Route::get('getshine/{id}', [NewJobPostingController::class, 'shine']);

Route::get('xml', [NewJobPostingController::class, 'xml']);
Route::get('xml', [NewJobPostingController::class, 'xml']);

Route::get('show-question-answer', [PositionController::class, 'showQuestionAnswer']);
Route::get('save-questionAndAnswer', [PositionController::class, 'saveQuestionAndAnswer']);


/*****Joining Form Formalities******/
Route::get('joining-form/basic-details', [JoiningCandidateController::class,'basicDetails']);
Route::post('store-basic-details', [JoiningCandidateController::class,'storeBasicDetails']);

// step -2
Route::get('joining-form/education', [JoiningCandidateController::class,'education']);
Route::post('store-education', [JoiningCandidateController::class,'storeEducation']);

//step -3
Route::get('joining-form/bank-details', [JoiningCandidateController::class,'bankDetails']);
Route::post('store-bank-details', [JoiningCandidateController::class,'storeBankDetails']);

//step -4
Route::get('joining-form/work-experience', [JoiningCandidateController::class,'workExperience']);
Route::post('store-work-experience', [JoiningCandidateController::class,'storeWorkExperience']);

//step -5
Route::get('joining-form/skills',[JoiningCandidateController::class,'skills']);
Route::any('store-skills', [JoiningCandidateController::class,'storeSkills']);

//step -6
Route::get('joining-form/thankyou',[JoiningCandidateController::class,'thankyou']);
Route::get('approved-newjoinee', [JoiningCandidateController::class,'approvedNewjoinee']);
Route::any('approvedNewjoinee', [ApiController::class,'approvedNewjoinee']);
Route::get('candidateapproval/{id}',[JoiningCandidateController::class,'candidateapproval']);

Route::get('join', [JoiningCandidateController::class,'join']);
Route::post('sendjoiningform', [JoiningCandidateController::class,'sendjoinform']);
Route::get('newjoinee', [JoiningCandidateController::class,'newjoinee']);
Route::get('receiver-list', [JoiningCandidateController::class,'receiverEmail']);
Route::get('newjoineefulldetail/{id}', [JoiningCandidateController::class,'newjoineefulldetail']);
Route::any('getstate/{country}', [JoiningCandidateController::class,'get_state']);
Route::any('getcity/{state}',[JoiningCandidateController::class,'get_city']);
/*****Joining Form Formalities******/