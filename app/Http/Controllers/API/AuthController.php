<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $response = [
        'message' => null,
        'data' => null
    ];

    public function register(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'nim' => 'required',
            'password' => 'required'
        ]);

        $data = User::create([
            'name' => $req->name,
            'email' => $req->nim,
            'password' => Hash::make($req->password),
        ]);

        $this->response['message'] = 'success';
        return response()->json($this->response, 200);
    }

    public function login(Request $req)
    {
        $req->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $req->nim)->first();

        if (!$user || ! Hash::check($req->password, $user->password)) {
            return response()->json([
                'message' => "failed"
            ]);
        }

        $token = $user->createToken($req->nim)->plainTextToken;
        $this->response['message'] = 'success';
        $this->response['nim'] = $user->nim;
        $this->response['data'] = [
            'token' => $token
        ];

        return response()->json($this->response, 200);
    }

    public function me()
    {
        $user = Auth::user(); //fungsi untuk mencari user yang aktif

        $this->response['message'] = 'success';
        $this->response['data'] = $user;

        return response()->json($this->response, 200);
    }

    public function logout()
    {
        $logout = auth()->user()->currentAccessToken()->delete(); //pas di-logout Tokennya dihapus

        return response()->json($this->response, 200);
    }
}
