<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Ruangan;

class RuanganController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $data = Ruangan::all();
        return view('admin.ruangan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.ruangan.add');
    }

    public function create()
    {
        try {

            Ruangan::create([
                'nama' => $this->postField('nama')
            ]);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Ruangan::findOrFail($id);
        return view('admin.ruangan.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $bagian = Ruangan::find($id);
            $data = [
                'nama' => $this->postField('nama'),
            ];
            $bagian->update($data);
            return redirect()->route('ruangan.index')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Ruangan::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
