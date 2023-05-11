<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestingMailTrap extends Controller
{
    public function index()
    {
        Mail::send([], [], function ($message) {
            $message->to('aksanurirwan@gmail.com');
            $message->subject('Test email');
            $message->setBody('This is a test email.');
        });
    }
}
