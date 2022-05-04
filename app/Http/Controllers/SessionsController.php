<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        //validate request
        $attributes = request()->validate([
           'email'=>'required|email',
            'password'=>'required'
        ]);
        //attempt to authenticate and log in the user
        //based on the provided credential
        if(!auth()->attempt($attributes))
        {
            throw ValidationException::withMessages([
                'email'=>'Your provided credential could not be verified.'
            ]);
        }
        session()->regenerate();
        //redirect with a success flash message
        return redirect('/')->with('success','Welcome Back!');
        //auth fail
//        return back()
//            ->withInput()
//            ->withErrors(['email'=>'Your provided credential could not be verified']);

    }
    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success','Goodbye!');
    }
}
