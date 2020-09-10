<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CCDC extends Controller
{
    public function import()
    {
        Excel::import(new CCDCImport, 'CCDC.xlsx');

        return redirect('/exel')->with('success', 'All good!');
    }
}
