<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('admin.index');
    }

    // public function index()
    // {
    //     $users = User::all();
    //     return view('admin.index', ['users' => $users]);
    // }

    // Existing method for admins to view all users
public function index()
{
    $users = User::all();
    return view('admin.index', ['users' => $users]);
}

// New method for regular users to view all users
public function show()
{
    $users = User::all(); // Apply necessary permission checks
    return view('users.index', ['users' => $users]); // Make sure this view exists
}

    public function store(Request $request)
{
    // Create the user
    $user = User::create($request->all());

    // Redirect to admin.show route with the user parameter
    return redirect()->route('admin.show', ['user' => $user->id])->with('success', 'User added successfully');
}


// public function show()
// {
//     $users = User::all(); // Finds the user by ID or throws a 404 error if not found
//     return view('admin.show', compact('users')); // Returns the view with the user data
// }

public function edit($id)
{
    $user = User::findOrFail($id); // Finds the user by ID or throws a 404 error if not found
    return view('admin.edit', compact('user')); // Returns the edit form view with the user data
}

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.show', $user->id)->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully');
    }

    public function sendOtp(Request $request, $userId)
{
    // Find the user by ID
    $user = User::findOrFail($userId);

    // Generate a random 6 digit OTP
    $otp = rand(100000, 999999);

    // Store the OTP in the cache
    Cache::put("otp_for_user_{$user->id}", $otp, now()->addMinutes(5));

    try {
        // Send the OTP via email
        Mail::to($user->email)->send(new OtpMail($otp));
        
        return response()->json(['message' => 'OTP has been sent to the user\'s email'], 200);
    } catch (\Exception $e) {
        // Handle email sending error
        return response()->json(['error' => 'Failed to send OTP. Please try again later.'], 500);
    }
}


    public function verifyOtp(Request $request)
{
    $user = User::where('email', $request->email)->firstOrFail();
    $otp = Cache::get("otp_for_user_{$user->id}");

    if ($otp && $request->otp == $otp) {
        // OTP is correct. Proceed with the verification.
        Cache::forget("otp_for_user_{$user->id}");
        return response()->json(['message' => 'OTP verified successfully'], 200);
    } else {
        // OTP is incorrect. Return error response.
        return response()->json(['error' => 'Invalid OTP'], 400);
    }
}

}
