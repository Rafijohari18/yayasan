<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Guru;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GuruImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $pelatihan   = explode(',',$row['6']);
        $prestasi    = explode(',',$row['7']);
        $penghargaan = explode(',',$row['8']);


         Guru::create([
            'nama'              => $row['0'],
            'jk'                => $row['1'],
            'tempat_lahir'      => $row['2'],
            'tgl_lahir'         => is_numeric($row['3']) ? 
                                    Date::excelToDateTimeObject($row['3'])
                                    ->format('Y-m-d') : $row['3'],
            'agama'             => $row['4'],
            'pendidikan'        => $row['5'],
            'pelatihan'         => $row['6'] == null ? null : $pelatihan, //ini
            'prestasi'          => $row['7'] == null ? null : $prestasi,
            'penghargaan'       => $row['8'] == null ? null : $penghargaan,
            'jabatan'           => $row['9'],
            'thn_masuk'         => $row['10'],
            'alamat'            => $row['11'],
            'tmt'               => $row['12'],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

}
