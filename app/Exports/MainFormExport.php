<?php

namespace App\Exports;

use App\Models\MainForm;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class MainFormExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MainForm::select("id","customer_id","user_id")->get();
    }
    
    public function headings(): array
    {
        return [
          '#',
          'customer_id',
          'user_id'
        ];
    }
}
