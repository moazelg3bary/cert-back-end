<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Certificate;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


// SIGNER CODE 

    // $dll_path = env('APP_STORAGE_PATH') . 'signer/test.dll';
    // $file_name = env('APP_STORAGE_PATH') . 'certificates/Kcnc21xxOzBsxk0euq4t1JM5MgCaz9qwlRJHJOMO.jpeg';
    // $o = shell_exec('sudo dotnet ' . $dll_path . ' ' . $file_name .' 1234567');

class CertificateController extends Controller
{
    public function newCertificate(Request $request)
    {
        $user = auth()->user();
        $request['data'] = json_encode($request->data);
        // return $request;
        $certificate = new Certificate($request->toArray());
        
        $certificate->user()->associate($user);
        $certificate->save();
    }

    public function getCertificates()
    {
        return new JsonResponse(['success' => true, 'data' => auth()->user()->certificates]);
    }

    public function getCertificateById(Request $request)
    {
        $certificate = Certificate::findOrFail($request['id']);
        return new JsonResponse(['success' => true, 'data' => $certificate]);
    }

    public function upload(Request $request)
    {
        $disk_gcs = Storage::disk('gcs');
        $disk_local = Storage::disk('local');
        $file = $request->file('file');
        $disk_gcs->put('certificates/', $file);
        $local = $disk_local->put('certificates/', $file);

        return $o;
        
    }
}
