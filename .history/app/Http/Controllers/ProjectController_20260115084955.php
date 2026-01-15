<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\view\pro

class ProjectController extends Controller
{
    public function index(){
     return view('project');   
    }
}