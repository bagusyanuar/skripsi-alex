<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
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
        return view('admin.stock.index')->with(['data' => $data]);
    }
}
