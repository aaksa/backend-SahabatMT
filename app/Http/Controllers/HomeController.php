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

        $previousCustomers = 1;

        $growthPercentage = (($userCount - $previousCustomers) / $previousCustomers) * 1;
        $growthPercentageFormatted = number_format($growthPercentage, 2, '.', '');


        return view('home.home', compact('data','userCount','requestCount' , 'growthPercentageFormatted'));
    }
}
