<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Hash;

class EmpAuthController extends Controller
{
    public function register(){
        return view('Emp.register');
    }

    public function create(Request $request){
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return redirect('/dashboard')->withSuccess("SuccessFully Inserted!!!!");
    }

    public function dashboard(){
        if(Auth::check()){
            $user = Auth::user();
            return view('Emp.dashboard',['user'=>$user]);
        }

        return redirect('/login');
        
    }

    public function login(){
        return view('Emp.login');
    }

    public function authemp(Request $request){
        $data = $request->only('email','password');
        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->withSuccess('Login Successfully');

        }

        return back()->withErrors('The provided credentials do not match our records.',);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
