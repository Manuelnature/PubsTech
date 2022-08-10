<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetailingController extends Controller
{
    public function index(){
        return view('pages.retailing');
    }
}
