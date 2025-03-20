<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login (Request $request){
        $incommingFields = $request->validate([
            'role' => 'required',
            'username' => 'required',
            'Password' => 'required'
        ]);
    }
}
