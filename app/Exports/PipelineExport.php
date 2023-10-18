<?php

namespace App\Exports;

use App\Models\Pipeline;
use Maatwebsite\Excel\Concerns\FromCollection;

class PipelineExport implements FromCollection
{


    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

   
}
