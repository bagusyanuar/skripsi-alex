<?php


namespace App\Http\Controllers\Api\Mahasiswa;


use App\Helper\CustomController;
use App\Models\Keluhan;
use App\Models\StockKeluar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            if ($this->request->method() === 'POST') {
                $deskripsi = $this->postField('deskripsi');
                $data_request = [
                    'tanggal' => Carbon::now(),
                    'user_id' => Auth::id(),
                    'deskripsi' => $deskripsi,
                    'keterangan' => '-',
                    'status' => 0,
                ];
                Keluhan::create($data_request);
                return $this->jsonResponse('success', 200);
            }

            $data = Keluhan::with(['sarana', 'ruangan'])
                 ->where('user_id', '=', Auth::id())
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }
}
