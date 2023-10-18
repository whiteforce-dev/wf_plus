<?php

namespace App\Http\Controllers\Integrations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\User;
use App\Models\Integrations\Integration;
use App\Models\Integrations\IntegrationTeam;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Image;

class ConfigrationController extends Controller
{
    public function integration(){
        return view('integrations.integration_page');
    }
    public function add_integration(Request $request){
        $request->validate([
            'company_name' => 'required',
            'about' => 'required',
        ]);
        $integration= Integration::find(1);
        $integration->company_name=$request->company_name;
        $integration->video_link=$request->video;
        $integration->about=$request->about;
        $image_code = $request->imageBaseString;
        if (!empty($image_code)) {
            $image_code = preg_replace('#^data:image/\w+;base64,#i', '',$image_code);
            $filepath = time() . '_' . rand() . '.png';
            Storage::disk('s3')->put('integrations/integration_images/' . $filepath, base64_decode($image_code), 'public');
            $integration->image  = $filepath;
        }
        $integration->save();
        $user =User::find(175);
        $user->name= $integration->company_name;
        $user->password = Hash::make("whiteforceplus@123");
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9-]+/', '-', $integration->company_name), '-'));
        $slug = preg_replace('/-+/', '-', $slug);
        $slug="admin@".$slug.".com";
        $user->email=$slug;
        $user->save();
        return redirect('showcase/v2/sushma/add-team-member/'.$integration->id);
    }
    public function add_member($id,Request $request){
        return view('integrations.add_team_member',compact('id'));
    }
    public function store_member(Request $request){
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
        ]);

        $team=IntegrationTeam::find(7);
        $team->integration_id=$request->integration_id;
        $team->name=$request->name;
        $team->designation=$request->designation;
        $image_code = $request->imageBaseString;
        if (!empty($image_code)) {
            $image_code = preg_replace('#^data:image/\w+;base64,#i', '',$image_code);
            $filepath = time() . '_' . rand() . '.png';
            Storage::disk('s3')->put('integrations/integration_teamsImage/' . $filepath, base64_decode($image_code), 'public');
            $team->member_image  = $filepath;
        }
        $team->save();
        return back()->with('success',"Member added Successfully");
    }

    private function saveBase64Image($base64String, $basePath){
    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64String));
    $fileName = uniqid() . '.png';

    $filePath = public_path($basePath . $fileName);

    // Save the image
    File::put($filePath, $imageData);
    return $fileName;
    }
}
