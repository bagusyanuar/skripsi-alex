<?php


namespace App\Http\Controllers\Api\Admin;


use App\Helper\CustomController;
use App\Models\StockKeluar;
use Carbon\Carbon;

class StockKeluarController extends CustomController
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
                $kondisi = (int) $this->postField('kondisi');

                $kondisi_value = '-';
                switch ($kondisi) {
                    case 0:
                        $kondisi_value = 'Rusak Ringan';
                        break;
                    case 1:
                        $kondisi_value = 'Rusak Berat';
                        break;
                    case 2:
                        $kondisi_value = 'Di Pinjam';
                        break;
                    case 3:
                        $kondisi_value = 'Barang Hilang';
                        break;
                    default:
                        break;
                }
                $data_request = [
                    'tanggal' => $tanggal,
                    'sarana_id' => $sarana_id,
                    'ruangan_id' => $id,
                    'keterangan' => $keterangan,
                    'status' => 0,
                    'qty' => $qty,
                    'deskripsi' => '-',
                    'kondisi' => $kondisi_value,
                ];
                StockKeluar::create($data_request);
                return $this->jsonResponse('success', 200);
            }
            $start_date = $this->field('start_date') ?? Carbon::now()->format('Y-m-d');
            $end_date = $this->field('end_date') ?? Carbon::now()->format('Y-m-d');
            $data = StockKeluar::with(['sarana', 'ruangan'])
                ->whereBetween('tanggal', [$start_date, $end_date])
                // ->where('ruangan_id', '=', $id)
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }

    public function detail($id, $id_keluar)
    {
        try {

            $data = StockKeluar::with(['sarana', 'ruangan'])
                ->where('id', '=', $id_keluar)
                ->first();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }
}
