<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        //
    }

    /**
     *  register the specified resource from storage.
     */
    public function register(Request $request){

    }
    /**
     * Login User
     */
    public function login(Request $request){
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt( $credentials,$request->remember)) {
                $request->session()->regenerate();
                toastr()->success('Deconnexion avec success');
                return redirect()->intended('dashboard');
            }

            toastr()->error('The provided credentials do not match our records.');
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }catch (\Exception $exception){
            toastr()->error($exception->getMessage());
            return back();
        }
    }
    /**
     * Logout the specified resource from storage.
     */
    public function logout(Request $request){

        try {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            toastr()->success('Deconnexion avec success');
            return redirect('/');

        }catch (\Exception $exception){

            toastr()->error($exception->getMessage());
            return back();
        }
    }

    public function go_to_register(){

        return view('Auth.register');
    }

    public function go_to_login(){

        return view('Auth.login');
    }


    public function go_and_edit_profile(){

        return view('Users.profile');
    }
}
