<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\view

class ProjectController extends Controller
{
    public function index(){
     return view('project');   
    }
}