<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IPController extends Controller
{
    public  function create(){
        $areas=DB::table('areas')->get();
        return view('IP.create',['areas'=>$areas]);
    }
    public  function index(){
        return view('IP.index');
    }
    
}
