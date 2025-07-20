<?php

namespace App\Exports;

use App\Models\Learner;
use Maatwebsite\Excel\Concerns\FromCollection;

class LearnersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Learner::all();
    }

     public function headings(): array
    {
        return ["ID", "Name","Phone","Country", "Email"];
    }
}
