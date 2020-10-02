<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Certificate;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

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
}
