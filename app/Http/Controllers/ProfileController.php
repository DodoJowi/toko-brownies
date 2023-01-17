<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('profile', compact('user'));
    }

    public function update(Request $request ) 
    {

        $this->validate($request, [
            'password' => 'confirmed',
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        if (!empty($request->password)) {
            $user->password =Hash::make($request->password) ;
        }
        $user->update();
        alert()->success('Profile sukses di update', 'Success');
        return redirect ('profile');
        
    }


}
