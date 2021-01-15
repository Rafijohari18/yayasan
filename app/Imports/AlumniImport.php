<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Alumni;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\WithStartRow;


class AlumniImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
         Alumni::create([
            'nama'               => $row['0'],
            'jk'                 => $row['1'],
            'no_hp'              => $row['2'],
            'tempat_lahir'       => $row['3'],
            'tgl_lahir'          => is_numeric($row['4']) ? 
                                    Date::excelToDateTimeObject($row['4'])
                                    ->format('Y-m-d') : $row['4'],
            'alamat'              => $row['5'],
            'sekolah_ke'          => $row['6'],
            'masuk_tahun'         => $row['7'],
            'tamat_tahun'         => $row['8'],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

}
