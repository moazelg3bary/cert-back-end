<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nationality' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'errors' => $validator->messages()], 500);
        }

        $request['password'] = bcrypt($request->password);

        $user = User::create($request->toArray());
        $user['token'] = $user->createToken('authToken')->accessToken;
        $user['profile_completed'] = 0;

        return new JsonResponse(['success' => true, 'data' => $user]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid Credentials'], 500);
        }

        $user = auth()->user();
        $user['token'] = auth()->user()->createToken('authToken')->accessToken;

        return new JsonResponse(['success' => true, 'data' => $user]);
    }

    public function completeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:55',
            'middle_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'id_type' => 'required|in:id,passport',
            'id_number' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'errors' => $validator->messages()], 500);
        }

        $user = auth()->user();

        if($user['profile_completed']) {
            // return new JsonResponse(['success' => false], 500);
        }

        $data = $request->only('id_type', 'id_number', 'first_name', 'middle_name', 'last_name');
        $data['profile_completed'] = true;
        $user->update($data);
        $user->save();
        return new JsonResponse(['success' => true, 'data' => $user]);
    }

    public function uploadAvatar(Request $request)
    {
        $disk = Storage::disk('gcs');
        $disk->put('avatars/1', $request->file('avatar'));
        // $path = $request->file('avatar')->store('avatars');

        return $path;
    }

    public function me()
    {
        return new JsonResponse(['success' => true, 'data' => auth()->user()]);
    }
}
