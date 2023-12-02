<?php

use App\Models\Designation;
use App\Models\User;
use App\Utils\AppConstant;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ClientAllotment;
use setasign\Fpdi\Fpdi;
use App\Models\Position;
use App\Models\Pipeline;
use App\Jobs\CandidateBatchHeader;

function uploadImageWithBase64($fileName, $path = '')
{
    $name = "default.png";
    if ($fileName) {
        $time = time();
        //Base64 To Image Convert
        list($type, $image) = explode(';', $fileName);
        list(, $image) = explode(',', $image);
        $file = base64_decode($image);
        $name = $time . '.png';


        // $filePath = $path . '/' . $name;


        $filePath = $path . '/' . $name;
        $fullPath = base_path();
        $filePath = str_replace("src", $filePath, $fullPath);

        $img = Image::make($file);
        $img->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($filePath);

        //detach method is the key! Hours to find it... :/

        // $resource = $img->stream()->detach();

        // $filePath = $path . '/' . $name;
        // Storage::disk('public_uploads')->put($filePath, $resource);



        //Thumb
        // $filePath = $path . '/thumb/' . $name;

        $filePath = $path . '/thumb/' . $name;
        $fullPath = base_path();
        $filePath = str_replace("src", $filePath, $fullPath);



        $img = Image::make($file);
        $img->resize(100, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($filePath);
        //detach method is the key! Hours to find it... :/

        // $resource = $img->stream()->detach();

        // $filePath = $path . '/thumb/' . $name;
        // Storage::disk('public_uploads')->put($filePath, $resource);
    }
    return $name;
}

function thumb($path)
{
    $array = explode('/', $path);
    $lastvalue = end($array);
    return $array[0] . '/thumb/' . end($array);
}

function getSuperParentDesignation($type)
{
    $designation =  Designation::where('role', $type)->first();
    if ($designation->id >= 3) {
        $superParentDeignation = Designation::find($designation->id - 1);
        return $superParentDeignation->role;
    }
    return 0;
}

function getDesignationList($type)
{
    $designation =  Designation::where('role', $type)->first();
    if ($designation->id <= 6) {
        $demotionFirstStep = Designation::find($designation->id + 1);
        return $demotionFirstStep->role;
    }
    return 0;
}

function getParent($user, $level)
{
    $user = User::find($user);
    if ($level == 1) {
        return $user->parent;
    }
    if ($level == 2) {
        return $user->parent->parent;
    }
    if ($level == 3) {
        return $user->parent->parent->parent;
    }
    if ($level == 4) {
        return $user->parent->parent->parent->parent;
    }
    if ($level == 5) {
        return $user->parent->parent->parent->parent->parent;
    }
    if ($level == 6) {
        return $user->parent->parent->parent->parent->parent->parent;
    }
}



function modDate($date, $format)
{
    return Carbon::parse($date)->format($format);
}

function encValue($value)
{
    $hashids = new Hashids('', 6);
    return $hashids->encode($value);
}

function decValue($value)
{
    $hashids = new Hashids('', 6);
    return $hashids->decode($value)[0];
}

function stagesArr(){
    return [
        'sourcing',
        'telephonic',
        'f2f',
        'not_attend',
        'rejected',
        'hot',
        'hold',
        'selected',
        'backout',
        'offered',
        'joined',
    ];
}

//vrinda old code
// function getAllParentRollWise(){
//     $roles = [
//         'assistant_manager'=>'Assistant Manager',
//         'manager'=>'Manager',
//         'senior_manager'=>'Senior Manager',
//         'general_manager'=>'General Manager',
//         'business_head'=>'Business Head',
//     ];
//     $allParents = [];
//     foreach($roles as $role => $role_name){
//         if($role == Auth::user()->role){
//             break;
//         }
//         $allParents[$role_name] = User::where('software_category',Auth::user()->software_category)->where('role',$role)->where('is_active',1)->pluck('name','id')->toArray();
//     }
//     return array_reverse($allParents);
// }



function getAllParentRollWise(){
    $user = User::find(Auth::user()->id);
    $descendantIds = $user->descendantIds();
    $descendantIds = [Auth::user()->id,...$descendantIds];
    $allChilds = [];
    $roles = [
        'business_head'=>'Business Head',
        'general_manager'=>'General Manager',
        'senior_manager'=>'Senior Manager',
        'manager'=>'Manager',
        'assistant_manager'=>'Assistant Manager',
        // 'talent_acquisition'=>'Talent Acquisition'
    ];
    if(Auth::user()->role == 'talent_acquisition'){
        $roles = [
            'talent_acquisition'=>'Talent Acquisition'
        ];
    }
    foreach($roles as $role => $role_name){
        $users = User::whereIn('id',$descendantIds)->where('role',$role)->pluck('name','id')->toArray();
        if(!empty($users)){
            $allChilds[$role_name] = $users;
        }
    }
   
    return $allChilds;
  
}

function getAllChildrenRollWise($id){
    $user = User::find($id);
    $descendantIds = $user->descendantIds();
    $allChilds = [];
    $roles = [
        'business_head'=>'Business Head',
        'general_manager'=>'General Manager',
        'senior_manager'=>'Senior Manager',
        'manager'=>'Manager',
        'assistant_manager'=>'Assistant Manager',
        'talent_acquisition'=>'Talent Acquisition'
    ];
    foreach($roles as $role => $role_name){
        $users = User::whereIn('id',$descendantIds)->where('role',$role)->pluck('name','id')->toArray();
        if(!empty($users)){
            $allChilds[$role_name] = $users;
        }
    }
    return $allChilds;
}

function allRoles(){
    return $roles = [
        'business_head'=>'Business Head',
        'general_manager'=>'General Manager',
        'senior_manager'=>'Senior Manager',
        'manager'=>'Manager',
        'assistant_manager'=>'Assistant Manager',
        'talent_acquisition'=>'Talent Acquisition'
    ];
}

function monthsArray(){
    return [
        '01'=>'Jan',
        '02'=>'Feb',
        '03'=>'Mar',
        '04'=>'Apr',
        '05'=>'May',
        '06'=>'Jun',
        '07'=>'Jul',
        '08'=>'Aug',
        '09'=>'Sep',
        '10'=>'Oct',
        '11'=>'Nov',
        '12'=>'Dec',
    ];
}

function getQuarterMonths($quarter){
    if($quarter == 1){ 
        $months = ['01'=>'JAN','02'=>'FEB','03'=>'MAR'];
    } elseif($quarter == 2){
        $months = ['04'=>'APR','05'=>'MAY','06'=>'JUN'];
    } elseif($quarter == 3){
        $months = ['07'=>'JUL','08'=>'AUG','09'=>'SEP'];
    } elseif($quarter == 4){
        $months = ['10'=>'OCT','11'=>'NOV','12'=>'DEC'];
    }
    return $months;
}

function levelArray($level){
    $array = [
        1 => "A",
        2 => "B",
        3 => "C",
        4 => "D",
        5 => "E",
        6 => "F",
        7 => "G",
        8 => "H",
        9 => "I",
        10 => "J",
        11 => "K",
        12 => "L",
        13 => "M",
        14 => "N",
        15 => "O",
        16 => "P",
        17 => "Q",
        18 => "R",
        19 => "S",
        20 => "T",
        21 => "U",
        22 => "V",
        23 => "W",
        24 => "X",
        25 => "Y",
        26 => "Z"
    ];
    return $array[$level];
}


function getRoleDisplay($role){
    $array = [
        'admin' => "Admin",
        'business_head' => "Business Head",
        'general_manager' => "General Manager",
        'senior_manager' => "Senior Manager",
        'manager' => "Manager",
        'assistant_manager' => "Assistant Manager",
        'talent_acquisition' => "Talent Acquisition"
    ];
    return $array[$role];
}

function inc_format($num) {
    $explrestunits = "" ;
    $num = abs($num);
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}

function diffWithDate($date){
    $createdAt = Carbon::parse($date);
    $today = Carbon::now();
    $daysSinceCreation = $createdAt->diffInDays($today);
    if($daysSinceCreation <= 1){
        return 'Today';
    }
    return $daysSinceCreation.' Days';
}

function getClientAllotedToNames($client_id,$childUsers){
   $alloted_to_names = ClientAllotment::join('users', 'client_allotment.alloted_to', "=", "users.id")
            ->whereIn('alloted_to',$childUsers)
            ->where('client_id',$client_id)
            ->pluck('users.name')
            ->toArray();
    return $alloted_to_names ?? [];
}

function getManagerAndSmList($software_category = null){
    if(empty($software_category)){
        $software_category = Auth::user()->software_category;
    }
    $roles = [
        'senior_manager'=>'Senior Manager',
        'manager'=>'Manager',
    ];
    $allUsers = [];
    foreach($roles as $role => $role_name){
        $data = User::where('software_category',$software_category)->where('role',$role)->where('is_active',1)->pluck('name','id')->toArray();
        if(!empty($data)){
            $allUsers[$role_name] = $data;
        }
    }
    return $allUsers;
}

function onroleUser($id){
    $userList = [
        "1"=> "admin@saisungroup.com",
        "2"=> "bh1@white-force.com",
        "3"=> "shiney@white-force.com",
        "4"=> "franchiseadmin@white-force.com",
        "5"=> "fgm1@white-force.com",
        "15"=> "juhi@white-force.com",
        "16"=> "shrutikaushik@white-force.com",
        "17"=> "poonam.tiwari@saisungroup.org",
        "19"=> "deepika@white-force.com",
        "21"=> "anup@white-force.in",
        "22"=> "ashishsharma@white-force.in",
        "24"=> "mohit@white-force.com",
        "35"=> "mili@saisungroup.com",
        "39"=> "shristi@saisungroup.org",
        "10002"=> "ashish@white-force.com",
        "10018"=> "pooja@white-force.in",
        "10021"=> "callaudit@white-force.com",
        "10026"=> "franchisemasterwf@gmail.com",
        "10030"=> "ilyas@white-force.com",
        "10032"=> "priyanka.whiteforce@gmail.com",
        "10039"=> "usadmin@white-force.com",
        "10042"=> "jennifer@onlyitconsulting.com",
        "10043"=> "aman@onlyitconsulting.com",
        "10044"=> "manager@gmail.com",
        "10045"=> "ashley@onlyitconsulting.com",
        "10046"=> "tanish@white-force.in",
        "10065"=> "saras.whiteforce@gmail.com",
        "10067"=> "sagar.whiteforce@gmail.com",
        "10074"=> "hr@white-force.in",
        "10075"=> "khushi.jat@white-force.in",
        "10076"=> "deepika2@white-force.com",
        "10077"=> "priya@white-force.in",
        "10085"=> "kritika.vishwakarma@white-force.in",
        "10086"=> "harshal@white-force.in",
        "10094"=> "himanshu.tamang@white-force.in",
        "10097"=> "ritik.singh@white-force.in",
        "10098"=> "renuka.rajak@white-force.in",
        "10103"=> "harshaltrainee1@whiteforce.com",
        "10104"=> "harshaltrainee2@whiteforce.com",
        "10105"=> "harshaltrainee3@whiteforce.com",
        "10109"=> "mili@white-force.com",
        "10110"=> "madhavi@white-force.in",
        "10113"=> "kishita.dubey@white-force.in",
        "10115"=> "abhaykant.whiteforce@gmail.com",
        "10119"=> "rahulk.kanojia@white-force.in",
        "10123"=> "mushira@white-force.in",
        "10125"=> "akansha.soni@white-force.in",
        "10129"=> "govind.whiteforce@gmail.com",
        "10132"=> "subham.whiteforce@gmail.com",
        "10143"=> "mohit.yadav@white-force.in",
        "10144"=> "juhiagrawalwhiteforce@gmail.com",
        "10145"=> "ea.md@rajpal-group.com",
        "10148"=> "deepika.trainee1@white-force",
        "10150"=> "ganeshbahadur.thapa@white-force.in",
        "10151"=> "aashi.chourasiya@white-force.in",
        "10153"=> "mansi.mourya@white-force.in",
        "10154"=> "mohit.trainee3@white-force.com",
        "10157"=> "apeksha.peshwani@white-force.in",
        "10159"=> "arya.badgaiyan@white-force.in",
        "10160"=> "musarrat.jahan@white-force.in",
        "10163"=> "tanishq.nikose@white-force.in",
        "10164"=> "sreshthi.sunpal@white-force.in",
        "10165"=> "vikas.whiteforce@gmail.com",
        "10166"=> "mili@gmail",
        "10167"=> "aman.whiteforce@gmail.com",
        "10168"=> "utkarsh.satre@white-force.in",
        "10170"=> "pushpraj.whiteforce@gmail.com",
        "10171"=> "shikha.whiteforce@gmail.com",
        "10172"=> "danish.ahmed@white-force.in",
        "10173"=> "ziya.ansari@white-force.in",
        "10174"=> "sm1@white-force.com",
        "10175"=> "mgr1@white-force.com",
        "10176"=> "asm1@white-force.com",
        "10177"=> "assist@white-force.com",
        "10178"=> "asm3@white-force.com",
        "10179"=> "asm4@white-force.com",
        "10180"=> "mgr2@white-force.com",
        "10182"=> "asm5@white-force.com",
        "10183"=> "asm6@white-force.com",
        "10184"=> "asm7@white-force.com",
        "10185"=> "asm8@white-force.com",
        "10187"=> "asm9@white-force.com",
        "10188"=> "asm10@white-force.com",
        "10190"=> "dummy@franchise.com",
        "10191"=> "simran.gyanani@white-force.in",
        "10192"=> "shreya.dubey@white-force.in",
        "10195"=> "gurpreet@white-force.in",
        "10196"=> "aditya.thakur@white-force.in",
        "10197"=> "sangeo.george@white-force.in",
        "10198"=> "benedict.george@white-force.in",
        "10199"=> "harleen.whiteforce@gmail.com",
        "10200"=> "asmharshal@white-force.com",
        "10201"=> "rahul.tiwari@white-force.in",
        "10202"=> "manmeet.singh@white-force.in",
        "10203"=> "shakil.whiteforce@gmail.com",
        "10205"=> "abhilash.whiteforce@gmail.com",
        "10206"=> "poonam.whiteforce1@gmail.com",
        "10207"=> "prabha.whiteforce@gmail.com",
        "10208"=> "yadava.whiteforce@gmail.com",
        "10209"=> "blanck10203@white-force.com",
        "10210"=> "ilyas.trainee2@white-force.com",
        "10211"=> "anood.whiteforce@gmail.com",
        "10212"=> "amit.whiteforce@gmail.com",
        "10213"=> "shalini.whiteforce@gmail.com",
        "10214"=> "parag.whiteforce@gmail.com",
        "10215"=> "dummy.manager@franchise.com",
        "10216"=> "priya.whiteforce1@gmail.com",
        "10217"=> "kalpana.shukla@white-force.in",
        "10218"=> "mohan.whiteforce@gmail.com",
        "10220"=> "rohit.mishra@white-force.in",
        "10221"=> "yash.whiteforce1@gmail.com",
        "10222"=> "trainee@gmail.com",
        "10223"=> "shivangini.rajak@white-force.in",
        "10224"=> "blanck10190@white-force.com",
        "10225"=> "dummy.1@gmail.com",
        "10226"=> "dummy.2@gmail.com",
        "10227"=> "dummy.3@gmail.com",
        "10228"=> "ashish.trainee1@whiteforce",
        "10229"=> "ashish.trainee2@whiteforce",
        "10230"=> "surbhiwhiteforce@gmail.com",
        "10231"=> "anushawhiteforce@gmail.com",
        "10232"=> "mohit.trainee1@white-force.com",
        "10233"=> "janvi.narang@white-force.in",
        "10234"=> "ankita.patel@white-force.in",
        "10235"=> "vishakha.butey@white-force.in",
        "10236"=> "gurmeet.trainee1@gmail.com",
        "10237"=> "gurmeet.trainee2@gmail.com",
        "10238"=> "priteshwhiteforce@gmail.com",
        "10239"=> "mayankwhiteforce@gmail.com",
        "10240"=> "asm3.kalpana@white-force.com",
        "10241"=> "pragati.chouhan@white-force.in",
        "10242"=> "kalpana.trainee2@white-force.com",
        "10243"=> "ilyas.trainee1@white-force.com",
        "10244"=> "nishthajwhiteforce@gmail.com",
        "10245"=> "shruti.trainee2@whiteforce.com"
    ];
    $useremail = !empty($userList[$id]) ? $userList[$id] : 'admin@white-force.com';
    return $useremail;
}

function offroleUser($id){
    $userList = [
        "1"=> "admin@saisungroup.com",
        "10005"=> "akash@white-force.com",
        "10007"=> "diksha@white-force.com",
        "10010"=> "yasmeen@white-force.in",
        "10011"=> "poonam@white-force.in",
        "10012"=> "himanshi@white-force.in",
        "10021"=> "shristi@white-force.in",
        "10024"=> "deepali@white-force.com",
        "10035"=> "ranjeet@white-force.com",
        "10038"=> "parul@white-force.in",
        "10040"=> "shivani@white-force.in",
        "10042"=> "callaudit@white-force.com",
        "10043"=> "shivani.jyotiki@white-force.in",
        "10049"=> "manager@gmail.com",
        "10051"=> "gadesaw903@5ubo.com",
        "10053"=> "kunal@white-force.in",
        "10054"=> "shiney@white-force.com",
        "10055"=> "kotexe8260@mnqlm.com",
        "10057"=> "deepak@white-force.in",
        "10061"=> "samit@white-force.in",
        "10064"=> "aayushi.chandra@white-force.in",
        "10068"=> "off.trainee1@white-force.com",
        "10069"=> "off.trainee2@white-force.com",
        "10070"=> "waseem@white-force.in",
        "10071"=> "geeta.khatri@white-force.in",
        "10073"=> "mili@white-force.com",
        "10074"=> "pratibha.thakur@white-force.in",
        "10075"=> "ankit.srivas@white-force.in",
        "10078"=> "christopher.whiteforce@gmail.com",
        "10079"=> "ranjeet.trainee2@whiteforce.com",
        "10080"=> "samit.trainee1@whiteforce.com",
        "10082"=> "shivani.samundre@white-force.in",
        "10085"=> "amrit@white-force.in",
        "10086"=> "siddharth.raghuwanshi@white-force.in",
        "10088"=> "akash.trainee4@white-force.com",
        "10089"=> "diksha.trainee2@white-force.com",
        "10090"=> "pranav.singh@white-force.in",
        "10092"=> "ankita.dubey@white-force.in",
        "10093"=> "vishal.rajput@white-force.in",
        "10094"=> "rajani.dahayat@white-force.in",
        "10096"=> "monty.sahu@white-force.in",
        "10097"=> "ankit.gadari@white-force.in",
        "10099"=> "dummy@whiteforce.com",
        "10100"=> "ishrat.fatima@white-force.in",
        "10101"=> "nitesh.kushwaha@white-force.in",
        "10102"=> "kanchan.tiwari@white-force.in",
        "10103"=> "siddhi.tiwari@white-force.in",
        "10104"=> "shweta.sahu@white-force.in",
        "10106"=> "nikita.yadav@white-force.in",
        "10108"=> "miliwhiteforce25@gmail.com",
        "10109"=> "khushi88whiteforce@gmail.com",
        "10110"=> "satyawati@white-force.in",
        "10111"=> "apoorva.mishra@white-force.in",
        "10112"=> "deepali.trainee3@white-force.com",
        "10113"=> "abhijeetpatil613@gmail.com",
        "10114"=> "ranjeet.trainee3@whiteforce.com",
        "10115"=> "tabassum.whiteforce@gmail.com",
        "10116"=> "simran.dsouza@white-force.in",
        "10117"=> "amansahuwhiteforce@gmail.com",
        "10118"=> "rishabhpardeshi1996@gmail.com",
        "10119"=> "diksha.trainee1@white-force.com",
        "10120"=> "diksha.trainee3@white-force.com"
    ];
    $useremail = !empty($userList[$id]) ? $userList[$id] : 'admin@white-force.com';
    return $useremail;
}


function CATEGORIES(){
    return AppConstant::CATEGORIES;
}
function ONROLE_CATEGORY(){
    return AppConstant::ONROLE_CATEGORY;
}
function OFFROLE_CATEGORY(){
    return AppConstant::OFFROLE_CATEGORY;
}
function FRANCHISE_CATEGORY(){
    return AppConstant::FRANCHISE_CATEGORY;
}

function changeStringToArray($string){
    return explode(" ",str_ireplace(array( '\'', '"',',' , ';', '<', '>', '-','.','&','|' ), ' ', $string));
}

function convertPdfVersion($inputfile){
    $convertedPDFPath = '';
    try{
        $pdfVersion = getPDFVersion($inputfile);
        if ($pdfVersion > 1.4) {
            $convertedPDFPath = storage_path('app/converted_new.pdf');
            $s3FilePath = 'candidate_resume/' . time() . '-converted_new.pdf';
            $command = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dBATCH -sOutputFile=" . escapeshellarg($convertedPDFPath) . " " . escapeshellarg($inputfile);
            $result = exec($command, $output, $returnCode);
        }
        return $convertedPDFPath;
    } catch(\Exception $e){
        return $convertedPDFPath;
    }
}

function getPDFVersion(string $inputFile): float{
    try{
        $handle = fopen($inputFile, 'rb');
        $firstLine = fgets($handle);
        fclose($handle);
        // Extract the PDF version from the first line
        preg_match('/\d+\.\d+/', $firstLine, $matches);
    
        return isset($matches[0]) ? (float)$matches[0] : 0.0;
    } catch(\Exception $e) {
        return 0.0;
    }
}

function clientNameFixer(){
    $positions = Position::get();
    foreach($positions as $position){
        $position->clientname = $position->findClientGet->name ?? 'Not Mentioned';
        $position->save();
    }
    return 'done';
}

function updateBatchHeader($old_data,$changed_data){
    try{
       $will_batch_header_chnage = false;
       if($old_data->name != $changed_data->name ||
        $old_data->languages != $changed_data->languages || 
        $old_data->gender != $changed_data->gender ||
        $old_data->current_company != $changed_data->company_name ||
        $old_data->current_title != $changed_data->designation || 
        $old_data->current_salary != $changed_data->current_salary || 
        $old_data->expected_salary != $changed_data->expected_salary || 
        $old_data->total_experience != $changed_data->total_experience || 
        $old_data->notice_period != $changed_data->notice_period || 
        $old_data->highest_qualification != $changed_data->education_name || 
        $old_data->highest_qualification_year != $changed_data->education_year ||
        $old_data->current_location != $changed_data->current_location ||
        $old_data->date_of_birth != $changed_data->date_of_birth ||
        (!empty($changed_data->resume) && $old_data->resume_file != $changed_data->resume))
        { 
            $will_batch_header_chnage = true;
        }
        if(!empty($will_batch_header_chnage)){
            $pipelines = Pipeline::where('candidate_id',$old_data->id)->select('id','position_id','candidate_id','batch_header_file','batch_header_date')->get();
            foreach($pipelines as $pipeline){
                if(!empty($pipeline->batch_header_file)){
                    Storage::disk('s3')->delete('candidate_batch_header/'.$pipeline->batch_header_file);
                }
                $pipeline->batch_header_file = null;
                $pipeline->batch_header_date = null;
                $pipeline->save();
                CandidateBatchHeader::dispatch($pipeline->id, $pipeline->position_id, $pipeline->candidate_id);
            }
        }
    } catch(\Exception $e){
        
    }
}

function getDispatchTime(){
    $current_time = date('H:i:s');
    if($current_time > '08:00:00' && $current_time < '13:59:59'){
        $dispach_time = Carbon::today()->setTime(14, 0, 0);
    } elseif($current_time >= '14:00:00' && $current_time < '20:59:59'){
        $dispach_time = Carbon::today()->setTime(21, 0, 0);
    } else { 
        $dispach_time = now()->addMinutes(10);
    }
    return $dispach_time;
}
function logo(){
    $logos = [
        "shine" => url('logo/shine.png'),
        "clickindia" => url('images/jobpostingportal/clickIndia.png'),
        "linkedin" => url('logo/Linkedin1.png'),
        "monster" => url('images/jobpostingportal/monster.png'),
        "jobIsJob" => url('logo/jobisjob.png'),
        "careerJet" => url('images/jobpostingportal/careerjet.png'),
        "post_job_free" => url('images/jobpostingportal/postJobFree.png'),
        "jora" => url('logo/jora.png'),
        "naukri" => url('logo/Naukri.com.png') ,
        "indeed" => url('images/jobpostingportal/Indeed-logo.png'),
        "jooble" => url('logo/Jooble1.png'),
        "timesjob" => url('images/jobpostingportal/TimesJobs-logo.png'),
        "facebook" => url('logo/facebook.png'),
        "whatsjob india" => url('logo/whatjobs.png'),
        "Drjobs india" => url('logo/DrJob.png'),
        "Adzuna india" => url('images/jobpostingportal/Adzuna_Logo.png'),
        "Linkedin Ats" => url('logo/linkedin.png'),
        "Jobsora" => url('logo/jobsora.png'),
        "learn4good" => url('logo/learn4good.jpg'),
        "jobgrin" => url('logo/jobgrin.png'),
        "careerbliss" => url('logo/careerbliss.png'),
        "indiajob" => url('logo/theIndiaJobs.png'),
        "jobrapido" => url('logo/jobrapido.png'),
        "google" => url('logo/google_happiest.png'),
        "my_job_helper" => url('logo/MyJobHelper.png'),
        "job_vertise" => url('logo/jobvertise.webp'),
        "Cv Library" => url('logo/CVLibrary.png'),
        "adzuna usa" => url('images/jobpostingportal/Adzuna_Logo.png'),
        "whatsjob USA" => url('logo/whatjobs.png'),
        "Times Ascent USA" => url('logo/TimeAscent.png'),
        "Tanqeeb UAE" => url('logo/tanqeeb.png'),
        "ziprecruiter" => url('logo/ziprecruiter.png'),
        "eluta" => url('logo/eluta.png') ,
        "jobisite" => url('logo/jobisite.jpg'),
        "jobswype" => url('logo/jobswype.png'),
        "workcircle" => url('logo/workcircle.png'),
        "juju" => url('logo/juju.jpg'),
        "econ" => url('logo/econ.png'),
        "cari" => url('logo/cari.png'),
        "bebee" => url('logo/bebee.jpg'),
        "jobinventory" => url('logo/jobinventory.png'),
        "talent" => url('logo/talent.png'),
        "reed" => url('logo/reed.png'),
        "whiteforce-google" => url('logo/google_whiteforce.png'),
        "whiteforce"  => url('logo/whiteforce.png'),
        "happiest"  => url('logo/HappiestResume.png'),
    ];
    return $logos;
}
