<?php

namespace App\Imports;

use App\Models\Cupon;
use Maatwebsite\Excel\Concerns\ToModel;

class CuponImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if(!empty($row[0])){
            return Cupon::create([
                'placa' => $row[0],
                'name' => $row[1],
                'number' => $row[2],
                'email' => $row[3],
                'enabled' => $row[4],
            ]);
        }
    }
}
