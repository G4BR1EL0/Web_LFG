<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function edit(Request $request){

        $user = $request->user();
        
       // if (!$request->name )  *falta terminar logica (si name o email viene vacio)*

        User::where('id', '=', $user->id)->update([   
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['message'=>'Usuario actualizado'], 200);

    } 
    
}

