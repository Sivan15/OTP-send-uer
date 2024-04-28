<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function sendOtp(Request $request)
    {
      

        // Assuming you have the user instance here
        $user = User::where('email', $request->email)->firstOrFail();

        // Generate a random 6 digit OTP
        $otp = rand(100000, 999999); 

        Cache::put("otp_for_user_{$user->id}", $otp, now()->addMinutes(5));

        // Send the OTP via email
        Mail::to($user->email)->send(new OtpMail($otp));

    }

    public function verifyOtp(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $otp = Cache::get('otp_'.$user->email);

        if ($otp && $request->otp == $otp) {
           
            Cache::forget('otp_'.$user->email); 
           
        } else {
            // OTP is incorrect. Return error response.
        }
    }
}


