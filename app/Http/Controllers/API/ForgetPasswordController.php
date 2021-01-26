<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ForgetMail;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Providers\SendMail;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:55',
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'errors' => $validator->messages()], 500);
        }
        if (User::where('email',$request->email)->count()==0) {
            return new JsonResponse(['success' => false, 'message' =>'Email  Not fount' ], 500);
        }
        $credentials = request()->validate(['email' => 'required|email']);
         $token['token']=Password::sendResetLink($credentials);
       Mail::to($request->email)->send(new ForgetMail($token));

        return new JsonResponse(['success' => true, 'message' => 'Reset password link sent on your email']);
    }
    public function reset() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }
        return response()->json(["msg" => "Password has been successfully changed"]);
    }
}



