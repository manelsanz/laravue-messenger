<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return  view('profile');
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        
        if ($request->filled('password'))
            $user->password = bcrypt($request->password);
        
        $file = $request->image;
        if ($file) {
            $path = public_path('users');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $moved = $file->move($path, $fileName);
            $user->image = $fileName;
        }

        $user->save();
        
        // return response()->json(['success' => "Profile has been updated."], 201);
        return back();
    }
}
