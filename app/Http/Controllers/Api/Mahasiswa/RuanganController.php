<?php


namespace App\Http\Controllers\Api\Mahasiswa;


use App\Helper\CustomController;
use App\Models\Ruangan;

class RuanganController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            $q = $this->field('q');
            $data = Ruangan::with([])->where('nama', 'LIKE', '%' . $q . '%')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }

    public function detail($id)
    {
        try {
            $data = Ruangan::with(['stocks.sarana'])->where('id', '=', $id)
                ->first();
            if (!$data) {
                return $this->jsonResponse('ruangan tidak ditemukan', 404);
            }
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }
}
