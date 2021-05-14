<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function createMessage(Request $request)
    {
        $userId = $request->user()->id;
    }

    public function msg(Request $request)
    {

    }
}
