<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){

        // $data = ModelsRequest::all();
        $data = ModelsRequest::where('pengajuan','ongoing')->with('user')->get();
        $userCount = User::count();
        $requestCount = ModelsRequest::count();

        return view('home.home', compact('data','userCount','requestCount'));
    }
}
