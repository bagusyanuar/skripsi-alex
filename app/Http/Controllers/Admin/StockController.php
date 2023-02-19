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
        $data = Stock::all();
        $ruangan = Ruangan::all();
        return view('admin.stock.index')->with(['data' => $data, 'ruangan' => $ruangan]);
    }

    public function cetak()
    {
        $data = Stock::all();
        return $this->convertToPdf('admin.cetak.stock', [
            'data' => $data
        ]);
    }
}
