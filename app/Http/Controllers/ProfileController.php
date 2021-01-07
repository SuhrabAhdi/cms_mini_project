<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function edit(User $user){
        return view('profile.edit',compact('user'));
    }

    public function update(Request $request,User $user){

        $path = $request->image->store('images','public');
         $user->profile()->update(array_merge(
        $request->except('_token','_method'),
        ['image'=>$path]
    ));
    return redirect('/dashboard');

    }


}
