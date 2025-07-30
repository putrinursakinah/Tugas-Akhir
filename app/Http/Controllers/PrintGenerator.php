<?php
namespace App\Http\Controllers;
use App\Http\Controllers\PrintPdf;
use App\Http\Controllers\PrintExcel;
class PrintGenerator{
    public static function selectPrinter($type){
        if($type=='pdf'){
            echo "hai";
return new PrintPdf();
        }
            
        else if($type=='excel'){
           
             return new PrintExcel();
        }
    }
    
}