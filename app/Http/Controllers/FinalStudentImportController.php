<?php

namespace App\Http\Controllers;

use App\Imports\FinalStudentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FinalStudentImportController extends Controller
{
    public function store()
    {
        Excel::import(new FinalStudentsImport(), request()->file('file'));
    }
}
