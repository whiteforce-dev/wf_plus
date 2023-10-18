<?php

namespace App\Imports;

use App\Models\Sheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use App\helper;

class SheetsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $excel_id;

    public function __construct($excel_id)
    {
        $this->excel_id = $excel_id;
    }

    public function model(array $row)
    {

        $sheet=new Sheet([
            'company_name'=>$row['company_name'],
            'candidate_name'=>$row['candidate_name'],
            'mobile'=>$row['mobile'],
            'position'=>$row['position'],
            'status'=>$row['status'],
            'reference'=>$row['reference'],

        ]);
        $sheet->manager_id=Auth::user()->parent_id?Auth::user()->parent_id:1;
        $sheet->created_by=Auth::user()->id;
        $sheet->software_category=Auth::user()->software_category??'onrole';
        $sheet->excel_id=$this->excel_id;
        return $sheet;
    }

}
