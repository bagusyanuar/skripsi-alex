<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Ruangan;
use App\Models\Stock;

class StockController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $ruangan = Ruangan::all();
        if ($this->request->ajax()) {
            $ruangan = $this->field('ruangan');
            $data = Stock::with(['sarana'])->where('ruangan_id', '=', $ruangan)->get();
            return $this->basicDataTables($data);
        }
        return view('admin.stock.index')->with(['ruangan' => $ruangan]);
    }

    public function cetak()
    {
        $ruangan = $this->field('ruangan');
        $ruangan_data = Ruangan::find($ruangan);
        $data = Stock::with(['sarana'])->where('ruangan_id', '=', $ruangan)->get();
        return $this->convertToPdf('admin.cetak.stock', [
            'data' => $data,
            'data_ruangan' => $ruangan_data
        ]);
    }
}
