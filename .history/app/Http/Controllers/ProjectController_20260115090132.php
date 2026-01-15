<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\view\project;

class ProjectController extends Controller
{
    public function index(){
     return view('project', 
     [
        'nama'
     ]);   
    }
}