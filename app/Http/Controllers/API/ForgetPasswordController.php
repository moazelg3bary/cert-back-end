<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Providers\SendMail;
use Str;


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
        $user=User::where('email',$request->email)->first();
        if ($user->count()==0) {
            return new JsonResponse(['success' => false, 'message' =>'Email  Not fount' ], 500);
        }
        $token=app('auth.password.broker')->createToken($user);
        Mail::to($request->email)->send(new ForgetPassword($token));
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        return new JsonResponse(['success' => true, 'message' => 'Reset password link sent on your email']);

    }
    public function reset(Request $request,$token) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'errors' => $validator->messages()], 500);
        }
        $token=DB::table('password_resets')->select('token')->where('token',$token)->get();
        if (count($token)==0) {
            return new JsonResponse(['success' => false, 'message' => 'Token not valid']);
        }
        $user=User::where('email',$request->email)->first();
        $user->password = $request->password;
        $user->save();

        return response()->json(["msg" => "Password has been successfully changed"]);
    }
}



