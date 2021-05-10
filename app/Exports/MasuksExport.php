<?php

namespace App\Exports;

use App\Models\Masuk;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MasuksExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        return Masuk::getDataMasuks();
    }

    public function headings(): array
    {
        return [
            'No',
            'name',
            'qty',
            'tgl',
        ];
    }
}
