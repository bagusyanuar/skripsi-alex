<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = User::where('role', '=', 'admin')->get();
        return view('admin.admin.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.admin.add');
    }

    public function create()
    {
        try {
            $data = [
                'username' => $this->postField('username'),
                'password' => Hash::make($this->postField('password')),
                'role' => 'admin',
            ];
            User::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = User::findOrFail($id);
        return view('admin.admin.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $user = User::find($id);
            $data = [
                'username' => $this->postField('username'),
            ];

            if ($this->postField('password') !== '') {
                $data['password'] = Hash::make($this->postField('password'));
            }
            $user->update($data);
            return redirect('/admin')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            User::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
