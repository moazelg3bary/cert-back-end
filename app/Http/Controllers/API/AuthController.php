<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Providers\SendMail;

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
        $token = auth()->user()->createToken('authToken')->accessToken;
        $user['token'] = $token;
        // SendMail::dispatch([
        //     'user' => $user,
        //     'template' => 'emails.login',
        //     'subject' => SendMail::getLoginSubject()
        // ]);

        return new JsonResponse(['success' => true, 'data' => $user]);
    }

    public function completeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:55',
            'middle_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'id_type' => 'required|in:id,passport'
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'errors' => $validator->messages()], 500);
        }

        $user = auth()->user();

        if($user['profile_completed']) {
            return new JsonResponse(['success' => false], 500);
        }

        $data = $request->only('id_type', 'id_number', 'first_name', 'middle_name', 'last_name');
        $data['profile_completed'] = true;
        $user->update($data);
        $user->save();
        return new JsonResponse(['success' => true, 'data' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:55',
            'middle_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'id_number' => 'required|min:2|numeric',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'nationality' => 'required|max:55',
            'phone_number' => 'max:55'
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'errors' => $validator->messages()], 500);
        }
        $data = $request->only('email', 'phone_number', 'country_of_residence', 'nationality', 'id_number', 'first_name', 'middle_name', 'last_name');
        $user->update($data);
        $user->save();
        return new JsonResponse(['success' => true, 'data' => $user]);
    }

    public function uploadAvatar(Request $request)
    {
        if(!$request->avatar) {
            return new JsonResponse(['success' => false], 500);
        }
        $allowedExtensions = ['jpg', 'png', 'jpeg'];
        $extension = explode('/', mime_content_type($request->avatar))[1];
        if(!in_array($extension, $allowedExtensions)) {
            return new JsonResponse(['success' => false, 'extension' => $extension], 500);
        }

        $image = base64_decode(preg_replace('#^data:image/[^;]+;base64,#', '', $request->avatar));

        $disk = Storage::disk('gcs');

        $user = auth()->user();
        if($user->avatar_name) {
            $disk->delete($user->avatar_name);
        }
        // $image = $request->file('avatar');
        $prefix = 'avatars/';
        $extension = '.jpg';
        $image_name = $prefix . Carbon::now()->timestamp . $extension;
        $avatar = $disk->put($image_name, $image);
        // return $avatar;
        $disk->setVisibility($image_name, 'public');

        $url = $disk->url($image_name);

        $user->avatar_name = $image_name;
        $user->avatar_url = $url;

        $user->save();

        return new JsonResponse(['success' => true, 'data' => auth()->user()]);
    }

    public function me()
    {
        return new JsonResponse(['success' => true, 'data' => auth()->user()]);
    }

    public function editProfile(Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'errors' => $validator->messages()], 500);
        }
        $request['password'] = bcrypt($request->password);
        $user->update($request);
        $user->save();
        return new JsonResponse(['success' => true, 'data' => $user]);
    }

}
