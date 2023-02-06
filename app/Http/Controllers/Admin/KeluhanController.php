<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Keluhan;
use App\Models\Stock;
use App\Models\StockKeluar;
use Illuminate\Support\Facades\DB;

class KeluhanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Keluhan::with(['user.mahasiswa.kelas'])->where('status', '=', 0)->get();
        return view('admin.keluhan.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Keluhan::with(['user.mahasiswa.kelas'])->where('id', '=', $id)->firstOrFail();
        if ($this->request->method() === 'POST') {
            try {
                $status = $this->postField('status') === 'terima' ? 9 : 6;
                $data_request = [
                    'status' => $status,
                    'keterangan' => $this->postField('status') === 'terima' ? '-' : $this->postField('keterangan')
                ];
                $data->update($data_request);
                return redirect()->route('keluhan.index')->with(['success' => 'Berhasil konfirmasi permintaan...']);
            } catch (\Exception $e) {
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
            }
        }
        return view('admin.keluhan.detail')->with(['data' => $data]);
    }

    public function data_page()
    {
        if ($this->request->ajax()) {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Keluhan::with(['user.mahasiswa.kelas'])
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->where('status', '!=', 0)
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.keluhan.data');
    }

    public function cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Keluhan::with(['user.mahasiswa.kelas'])
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->where('status', '!=', 0)
            ->get();
        return $this->convertToPdf('admin.cetak.keluhan', [
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'data' => $data,

        ]);
    }
}
