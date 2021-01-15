<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\ProfilAlumni;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Auth;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ProfilAlumniImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        ProfilAlumni::create([
            'nama'               => $row['0'],
            'pekerjaan'          => $row['1'],
            'angkatan'           => $row['2'],
            'alamat'             => $row['3'],
            'moto_hidup'         => $row['4'],
            'pesan_kesan'        => $row['5'], 
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

}
