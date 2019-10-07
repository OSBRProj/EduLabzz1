<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{    
    public function index()
    {
        return 'base';
    }
}