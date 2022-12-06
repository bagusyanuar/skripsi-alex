<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\StockKeluar;

class StockKeluarController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = StockKeluar::with(['sarana', 'ruangan'])->where('status', '=', 0)->get();
        return view('admin.stock-keluar.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = StockKeluar::with(['sarana', 'ruangan'])->where('id', '=', $id)->firstOrFail();
        return view('admin.stock-keluar.detail')->with(['data' => $data]);
    }
}
