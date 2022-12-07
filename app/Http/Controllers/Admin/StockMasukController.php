<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Stock;
use App\Models\StockKeluar;
use App\Models\StockMasuk;
use Illuminate\Support\Facades\DB;

class StockMasukController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = StockMasuk::with(['sarana', 'ruangan'])->where('status', '=', 0)->get();
        return view('admin.stock-masuk.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = StockMasuk::with(['sarana', 'ruangan'])->where('id', '=', $id)->firstOrFail();
        if ($this->request->method() === 'POST') {
            DB::beginTransaction();
            try {
                $status = $this->postField('status') === 'terima' ? 9 : 6;
                $data_request = [
                    'status' => $status,
                    'deskripsi' => $this->postField('status') === 'terima' ? '-' : $this->postField('deskripsi')
                ];
                $data->update($data_request);
                $ruangan_id = $data->ruangan_id;
                $sarana_id = $data->sarana_id;
                $qty = $data->qty;
                if ($status === 9) {
                    $stock = Stock::where('sarana_id', '=', $sarana_id)->where('ruangan_id', '=', $ruangan_id)
                        ->first();
                    if (!$stock) {
                        DB::rollBack();
                        return redirect()->back()->with(['failed' => 'data persediaan tidak ditemukan...']);
                    }
                    $stock->update([
                        'qty' => ($stock->qty + $qty),
                    ]);
                }
                DB::commit();
                return redirect()->route('stock.masuk.index')->with(['success' => 'Berhasil konfirmasi permintaan...']);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
            }
        }
        return view('admin.stock-masuk.detail')->with(['data' => $data]);
    }

    public function data_page()
    {
        if ($this->request->ajax()) {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = StockMasuk::with(['sarana', 'ruangan'])
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.stock-masuk.data');
    }
}
