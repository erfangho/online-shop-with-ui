<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user =  User::query()->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return "not match";
        } else {
            $request->session()->put('user', $user);
            return redirect('/');
        }
    }
}
