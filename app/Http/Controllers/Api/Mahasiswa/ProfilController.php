<?php


namespace App\Http\Controllers\Api\Mahasiswa;


use App\Helper\CustomController;
use App\Models\Keluhan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            $user = User::with(['mahasiswa'])
                ->where('id', '=', Auth::id())
                ->first();
            if (!$user) {
                return $this->jsonResponse('user tidak ditemukan', 200);
            }
            if ($this->request->method() === 'POST') {
                $password = $this->postField('password');
                $user->update([
                    'password' => Hash::make($password)
                ]);
                return $this->jsonResponse('success', 200);
            }
            return $this->jsonResponse('success', 200, $user);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }
}
