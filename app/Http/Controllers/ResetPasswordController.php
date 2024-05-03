<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class ResetPasswordController extends Controller
{
    public function update(Request $request, $token)
    {
       
       /// dd($request);
        $email = $request->query('email'); 
        $user = User::where('email',  $email)->first();
        
        return view('auth.ResetPassword', compact('user', 'token'));
    }


    public function submitResetPasswordForm(Request $request)
{
    $request->validate([
        'oldpassword' => 'required',
        'newpassword' => 'required|min:8|confirmed', // Adding 'confirmed' rule
    ]);

    // Retrieve the password reset record
    $update = DB::table('password_resets')
                ->where(['email' => $request->email, 'token' => $request->token])
                ->first();

    // Check if the password reset record exists
    if (!$update) {
        return back()->withInput()->with('error', 'Invalid token!');
    }

    // Update user password only if old password matches
    $user = User::where('email', $request->email)->first();

    if (!Hash::check($request->oldpassword, $user->password)) {
        return back()->withInput()->with('error', 'Old password does not match!');
    }

    // Update the user's password
    $user->password = Hash::make($request->newpassword);
    $user->save();

    // Delete entry from password_resets table
    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect('/login')->with('message', 'Your password has been successfully changed!');
}


}