<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function index() {

        return view('tasklist.index');
        
    }
}
