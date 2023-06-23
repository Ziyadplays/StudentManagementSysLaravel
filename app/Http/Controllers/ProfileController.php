<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function test(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'mimes:jpg,svg,png,jpeg|max:5048'
        ]);
        $input = $request->all();
// checks if the user has submitted the image and then assigns the current time with the nameof the user submitted into the form plus the extension of the image
// else it will just update the user with the data provided into the form
        if ($request->has('image')) {
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            $input['img-path'] = $newImageName;
        }
        $user = User::find(Auth::id());
        if ($user->hasRole('teacher')) {
            $user->Teacher->update($input);
        }
        $user->update($input);

        return redirect('/profile');


        //        methods:
//        guessExtension() getMimeType() store() asStore() storePublicaly() move() getClientOriginalName()
//        getClientMimeType() guessClientExtension() getSize() getError()
    }

}
