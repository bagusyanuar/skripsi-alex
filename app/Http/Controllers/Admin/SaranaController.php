<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Ruangan;
use App\Models\Sarana;

class SaranaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $data = Sarana::all();
        return view('admin.sarana.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.sarana.add');
    }

    public function create()
    {
        try {

            Sarana::create([
                'name' => $this->postField('nama'),
                'qty' => 0,
            ]);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Sarana::findOrFail($id);
        return view('admin.sarana.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $bagian = Sarana::find($id);
            $data = [
                'name' => $this->postField('nama'),
            ];
            $bagian->update($data);
            return redirect()->route('sarana.index')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Sarana::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
