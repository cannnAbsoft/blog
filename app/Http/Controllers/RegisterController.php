<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    public function store()
    {
        $attributes = request()->validate([
            'userName'=>['required','min:3','max:255', Rule::unique('users','userName')],
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users,email',
            'password'=>'required|min:7|max:255',
        ]);
        $user = User::create($attributes);
        auth()->login($user);
//        session()->flash('success','Your account register success');
        return redirect('/')->with('success','Your account has been created');
    }
}
