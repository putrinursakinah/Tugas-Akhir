<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Printable;
use App\Exports\DataAnggaranExport;
use Maatwebsite\Excel\Facades\Excel;
class PrintExcel implements Printable
{

    public function print(){
        
       return Excel::download(new DataAnggaranExport, 'rkdddas.xlsx'); 
      
    }

}