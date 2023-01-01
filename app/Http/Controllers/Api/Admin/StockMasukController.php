<?php


namespace App\Http\Controllers\Api\Admin;


use App\Helper\CustomController;
use App\Models\StockMasuk;
use Carbon\Carbon;

class StockMasukController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        try {
            if ($this->request->method() === 'POST') {
                $tanggal = $this->postField('tanggal');
                $sarana_id = $this->postField('sarana_id');
                $keterangan = $this->postField('keterangan');
                $qty = $this->postField('qty');
                $data_request = [
                    'tanggal' => $tanggal,
                    'sarana_id' => $sarana_id,
                    'ruangan_id' => $id,
                    'keterangan' => $keterangan,
                    'status' => 0,
                    'qty' => $qty,
                    'deskripsi' => '-'
                ];
                StockMasuk::create($data_request);
                return $this->jsonResponse('success', 200);
            }
            $start_date = $this->field('start_date') ?? Carbon::now()->format('Y-m-d');
            $end_date = $this->field('end_date') ?? Carbon::now()->format('Y-m-d');
            $data = StockMasuk::with(['sarana', 'ruangan'])
                ->whereBetween('tanggal', [$start_date, $end_date])
                // ->where('ruangan_id', '=', $id)
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }
    
    public function detail($id, $id_masuk)
    {
        try {
            $data = StockMasuk::with(['sarana', 'ruangan'])
                ->where('id', '=', $id_masuk)
                ->first();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }
}
