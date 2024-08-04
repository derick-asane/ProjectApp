<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    public function register(Request $request){
        $incomingField = $request->validate([
            "name" => ["required", "min:3","max:10", Rule::unique('users', 'name')] ,
            "email"=> ["required","email", Rule::unique('users', 'email')] ,
            "password"=> ["required","min: 8","max:200 ",],
        ]);
        $incomingField["password"]= bcrypt($incomingField["password"]); 
        $user =User::create($incomingField);
        auth()->login($user);
        return redirect('/');
    }
    public function logout(Request $request){
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request){

        $incomingField = $request->validate([
            'loginname'=> 'required',
            'loginpassword' => 'required'
        ]);
       
         if(auth()->attempt(['name' => $incomingField['loginname'], 'password' =>  $incomingField['loginpassword']])){
            $request->session()->regenerate();
        }
        return redirect('/');
    }
}
