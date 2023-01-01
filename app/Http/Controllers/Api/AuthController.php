<?php


namespace App\Http\Controllers\Api;


use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $credentials = request(['username', 'password']);

        $user = User::where('username', '=', $this->postField('username'))->first();
        if (!$user) {
            return $this->jsonResponse('user tidak ditemukan', 401);
        }

        $role = $user->role;
        $is_password_valid = Hash::check($this->postField('password'), $user->password);
        if (!$is_password_valid) {
            return $this->jsonResponse('password tidak cocok', 401);
        }
        if (!$token = auth('api')->setTTL(null)->attempt($credentials)) {
            return $this->jsonResponse('Username dan Password Tidak Cocok', 401);
        }
        $token = auth('api')->setTTL(null)->tokenById($user->id);
        return $this->respondWithToken($token, $role);
    }

    protected function respondWithToken($token, $role)
    {
        return $this->jsonResponse('success', 200, [
            'access_token' => $token,
            'role' => $role,
            'type' => 'Bearer'
        ]);
    }
}
