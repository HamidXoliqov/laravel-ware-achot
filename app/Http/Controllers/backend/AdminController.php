<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Models\Accounts;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        if(Auth::check())
        {
            return redirect()->route('home');
        }
        else
        {            
            return view('backend.admin.login');
        }
    }
    public function signupForm()
    {
        if(Auth::check())
        {
            return redirect()->route('home');
        }
        else
        {
            return view('backend.admin.signup');
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'min:3','max:50','email'],
            'password' => ['required', 'string', 'min:6','max:50'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else
            return redirect()->route('dashboard');
    }
    
    public function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3','max:50', 'unique:users'],
            'email' => ['required', 'string', 'min:3','max:50', 'unique:users','email'],
            'password' => ['required', 'string', 'min:6','max:50'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else
        User::create([
            'name' => $request->all()['name'],
            'email' => $request->all()['email'],
            'password' => Hash::make($request->all()['password']),
        ]);
        return redirect()->route('dashboard');
    }
    public function dashboard()
    {
        // $accounts = Accounts::orderBy('created_at', 'desc')->paginate(30);
        return view('backend.admin.dashboard');
    }
    public function search()
    {
        $query = Accounts::query();
        if (isset($_GET["q"]) && $_GET["q"]) {
            $key = $_GET["q"];    
            $accounts = $query->where('name','LIKE','%'.$key.'%')->orderBy('created_at', 'desc')->paginate(30);
            return view('backend.admin.dashboard',compact('accounts'));
        }
        $accounts = $query->paginate(30);
        return view('backend.admin.dashboard',compact('accounts'));

    }
}
