<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\WithStartRow;


class SiswaImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
         Siswa::create([
            'no_induk'          => $row['0'],
            'nisn'              => $row['1'],
            'nama'              => $row['2'],
            'jk'                => $row['3'],
            'tempat_lahir'      => $row['4'],
            'tgl_lahir'         => is_numeric($row['5']) ? 
                                    Date::excelToDateTimeObject($row['5'])
                                    ->format('Y-m-d') : $row['5'],
            'umur'              => $row['6'],
            'agama'             => $row['7'],
            'alamat'            => $row['8'],
            'nama_ortu'         => $row['9'],
            'pendidikan_ortu'   => $row['10'],
            'alamat_ortu'       => $row['11'],
            'keterangan'        => $row['12'],

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

}
