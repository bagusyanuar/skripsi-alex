<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Mahasiswa::with(['user', 'kelas'])->get();
        return view('admin.mahasiswa.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $data = Kelas::all();
        return view('admin.mahasiswa.add')->with(['data' => $data]);
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $user_data = [
                'username' => $this->postField('username'),
                'password' => Hash::make($this->postField('password')),
                'role' => 'mahasiswa',
            ];
            $user = User::create($user_data);
            $member_data = [
                'user_id' => $user->id,
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'kelas_id' => $this->postField('kelas')
            ];
            Mahasiswa::create($member_data);
            DB::commit();
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = User::with(['mahasiswa.kelas'])->where('id', '=', $id)->firstOrFail();
        $kelas = Kelas::all();
        return view('admin.mahasiswa.edit')->with(['data' => $data, 'kelas' => $kelas]);
    }

    public function patch()
    {
        try {
            DB::beginTransaction();
            $id = $this->postField('id');
            $user = User::find($id);
            $data_user = [
                'username' => $this->postField('username'),
            ];

            if ($this->postField('password') !== '') {
                $data_user['password'] = Hash::make($this->postField('password'));
            }
            $user->update($data_user);
            $member = Mahasiswa::with('user')->where('user_id', '=', $user->id)->firstOrFail();
            $member_data = [
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'kelas_id' => $this->postField('kelas')
            ];
            $member->update($member_data);
            DB::commit();
            return redirect()->route('mahasiswa.index')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            DB::beginTransaction();
            $id = $this->postField('id');
            Mahasiswa::with('user')->where('user_id', '=', $id)->delete();
            User::destroy($id);
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('failed', 500);
        }
    }
}
