<?php

namespace App\Imports;

use App\Models\Faculty;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToArray, WithHeadingRow
{
    public function array($array)
    {
        $arrFaculty = [];
        foreach($array as $each) {
            $facultyName = $each['faculty'];
            if (empty($arrFaculty[$facultyName])) {
                $arrFaculty[$facultyName] = Faculty::firstOrCreate([
                    'name' => $each['faculty'],
                ])->id;
            }

            $password = Hash::make('12345678');

            Teacher::updateorCreate([
                'id' => $each['id'],
            ], [
                'name' => $each['name'],
                'email' => $each['email'],
                'password' => $password,
                'phone' => $each['phone'],
                'address' => $each['address'],
                'gender' => ($each['gender'] === 'Nam') ? 1 : 0,
                'birthdate' => $each['birthdate'],
                'faculty_id' => $arrFaculty[$facultyName],
            ]);
        }
    }
}
