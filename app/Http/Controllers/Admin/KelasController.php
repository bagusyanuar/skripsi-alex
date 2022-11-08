<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Jurusan;
use App\Models\Kelas;

class KelasController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Kelas::with('jurusan')->get();
        return view('admin.kelas.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $jurusan = Jurusan::all();
        return view('admin.kelas.add')->with(['jurusan' => $jurusan]);
    }

    public function create()
    {
        try {

            Kelas::create([
                'jurusan_id' => $this->postField('jurusan'),
                'nama' => $this->postField('nama'),
            ]);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $jurusan = Jurusan::all();
        $data = Kelas::findOrFail($id);
        return view('admin.kelas.edit')->with(['data' => $data, 'jurusan' => $jurusan]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $bagian = Kelas::find($id);
            $data = [
                'jurusan_id' => $this->postField('jurusan'),
                'nama' => $this->postField('nama'),
            ];
            $bagian->update($data);
            return redirect()->route('kelas.index')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Kelas::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
