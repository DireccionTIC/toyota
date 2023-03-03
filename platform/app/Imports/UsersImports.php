<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row[0])){
            return User::create([
                'name' => $row[0],
                'email' => $row[1],
                'password' => Hash::make($row[2]),
            ])->assignRole('rol2');
        }
    }
}
