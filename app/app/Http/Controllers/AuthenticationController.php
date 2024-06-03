<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    //

    public function authenticateAdmin(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials, $request->post('remember') == 'on')){
                return redirect('/home');
            }

            return redirect()->back()->with([
                'message' => 'Invalid Username / Password',
                'type' => 'danger'
            ]);
        }
        catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function loginCustomer(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials, $request->post('remember') == 'on')){
                return redirect('/customer/home');
            }

            return redirect()->back()->with([
                'message' => 'Invalid Username / Password',
                'type' => 'danger'
            ]);
        }
        catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
               'email' => 'required|unique:users',
               'username' => 'required',
               'password' => 'required|confirmed',
                'contact_no' => 'required',
                'name' => 'required'
            ]);

            $request->merge([
                'password' => \Hash::make($request->post('password')),
                'type' => 'Customer'
            ]);

            User::create($request->all());

            \DB::commit();
            return redirect()->back()->with([
                'message' => 'Registered successfully',
                'type' => 'success'
            ]);
        }
        catch (\Exception $exception) {
            return redirect()->back()->with([
                'message' => 'Unable to register ' . $exception->getMessage(),
                'type' => 'danger'
            ]);
        }
    }
}
