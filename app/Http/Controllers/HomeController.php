<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){

        // $data = ModelsRequest::all();
        $data = ModelsRequest::where('pengajuan','ongoing')->with('user')->get();
        return view('home.home', compact('data'));
    }
}
