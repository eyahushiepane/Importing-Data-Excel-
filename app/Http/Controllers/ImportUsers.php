<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportUsers extends Controller
{
    public static function import(Request $request) {
         
        if (($open = fopen('C:\Users\lenovo\Documents\Employee-Data.csv', 'r')) !== false) {
            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                $col1 = substr($data[1], 0, 255); 
                $col2 = substr($data[2], 0, 255); 
        
                $insertData = [
                    "COL 1" => $col1,
                    "COL 2" => $col2,
                    "COL 3" => $data[0],
                    "COL 4" => $data[1],
                    "COL 5" => $data[2],
                    "COL 6" => $data[3],
                    "COL 7" => $data[4],
                    "COL 8" => $data[5],
                    "COL 9" => $data[6],
                    "COL 10" => $data[7],
                    "COL 11" => $data[8],
                    "COL 12" => $data[9],
                    "COL 13" => $data[10],
                ];
        
                try {
                    DB::table("employee_data")->insert($insertData);
                } catch (\Exception $e) {
                    
                    return [
                        "success" => true,
                        "message" => "Import successfully",
                    ];
                }
        
                $encodedData = array_map('utf8_encode', $data);
            }
        } else {
            return [
                "success" => false,
                "message" => "File doesn't exist",
            ];
        }
    }
};

