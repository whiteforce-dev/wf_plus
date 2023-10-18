<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sheet;
use App\Models\User;
use App\Models\ExcelSheets;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SheetsImport;
use Illuminate\Support\Facades\Auth;

class SheetController extends Controller
{

    public function sheet_view(){
        $currentUser=Auth::user()->id;
        $currentUser = User::find($currentUser);
        $childUsers = $currentUser->descendantIds();
        array_unshift($childUsers,$currentUser->id);
        $users = User::whereIn('id', $childUsers)->get();

        $excelSheet=ExcelSheets::with('GetUser')->whereIn('created_by',$childUsers)->orderBy('id','desc')->where('software_category',Auth::user()->software_category)->paginate(50);
        $currentUser=Auth::user()->role;

        return view('pages.sheet.sheet_view',compact('excelSheet','currentUser'));
    }

    //excel sheet import function//
    public function importExcel(Request $request){

        $request->validate([
            'file'=>'required'
        ]);
        $file=$request->file('file');

        $fileName=$file->getClientOriginalName();
        // $savePath='/calling_sheets/';
        // $filePath=$savePath.$fileName;

        $excelSheet=new ExcelSheets();
        $excelSheet->name=$fileName;
        // $excelSheet->file_path=$filePath;
        $excelSheet->software_category=Auth::user()->software_category ??'onrole';
        $excelSheet->created_by=Auth::user()->id;
        $excelSheet->save();
        $excel_id=$excelSheet->id;
        Excel::import(new SheetsImport($excel_id),$file);
        // $file->move(public_path().$savePath,$fileName);
        // $file->move($savePath,$fileName);

        return redirect('sheet_view')->with('success', 'File imported successfully.');
   }

   public function sheet($sheetId){

        $sheetName=ExcelSheets::where('id',$sheetId)->where('software_category',Auth::user()->software_category)->first();
        $sheetName=$sheetName->name ?? "Not Found";

        $sheet = Sheet::with('GetUser')->where('excel_id',$sheetId)->where('software_category',Auth::user()->software_category)->orderBy('id','desc')->paginate(100);

        return view('pages.sheet.sheet',compact('sheet','sheetName'));
    }


   //delete function for single sheet entry//
   public function callingSheetDelete($id){
    $calling_sheet = Sheet::where('id',$id)->first();
    $calling_sheet->delete();
    return back()->with('success', 'Calling Sheet Delete Successfully');
   }

   public function bulkDelete(Request $request){
        if($request->id){
            $ids=explode(",",$request->id);
            foreach($ids as $id){
                $excelSheet=ExcelSheets::where('id',$id)->first();
                $excelSheet->delete();
            }
            return back()->with('success', 'Calling Sheet Bulk Delete Successfully');
        }
        else{
            return back();
        }
   }


    //add manager's remark function //
   public function addManagerRemark(Request $request,$id){
       $sheet=Sheet::where('id',$id)->first();
       $sheet->manager_remerk=$request->remark;
       $sheet->save();
       return back()->with('success', 'Manager Remark Added Successfully');
   }

   //delete function for delete sheet from database//
   public function deleteExcel($id){
        $excelSheet=ExcelSheets::where('id',$id)->first();
        $excelSheet->delete();
        $sheets=Sheet::where('excel_id',$id)->get();
        $length=$sheets->count();
        for($i=0;$i<$length;$i++){
            $sheet=Sheet::where('excel_id',$id)->first();
            $sheet->delete();
        }
        return back()->with('success', 'Calling Sheet Deleted Successfully');
   }

}