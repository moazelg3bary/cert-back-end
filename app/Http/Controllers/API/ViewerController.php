<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\Guards\TokenGuard;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['addAccessToken', 'auth:api']);
    }

    public function ViewCertificate()
    {
        $certificate = auth()->user()->certificates()->findOrFail(request()->id);
        // return response()->json($certificate);
        return view('certificate.index', compact(['certificate']));
    }
}
