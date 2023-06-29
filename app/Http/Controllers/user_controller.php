<?php

namespace App\Http\Controllers;

use App\Models\user;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class user_controller extends Controller
{
    public function view_login()
    {
        if (session()->get('admin_id')) {
            return redirect('/dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function check_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        try {
            $data = user::where('email', $request->email)->where('password', $request->password)->where('status', 1)->get();
            if (count($data) > 0) {
                Session::put('admin_id', $data[0]->user_id);
                Session::put('name', $data[0]->name);
                Session::put('email', $data[0]->email);
                return response()->json(['status' => 'true', 'msg' => 'Thanks For Login']);
            } else {
                return response()->json(['status' => 'false', 'msg' => 'This Email and Password Are Not Matched']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'false', 'msg' => 'This Email and Password Are Not Matched']);
        }
    }

    public function dashboard()
    {
        if (session()->get('admin_id')) {
            return view('dashboard.dashboard');
        } else {
            return redirect("/");
        }
    }

    public function logout()
    {
        session()->forget('admin_id');
        session()->forget('name');
        session()->forget('email');
        return redirect('/');
    }
}
