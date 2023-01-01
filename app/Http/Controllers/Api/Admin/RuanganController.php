<?php


namespace App\Http\Controllers\Api\Admin;


use App\Helper\CustomController;
use App\Models\Ruangan;
use App\Models\Sarana;
use App\Models\Stock;

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

    public function available_stocks($id)
    {
        try {
            $name = $this->field('name');
            $data = Sarana::with(['stocks' => function ($q) use ($id) {
                return $q->where('ruangan_id', '=', $id);
            }])
            ->where('name', 'LIKE', '%'.$name.'%')
            ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }

    public function add_item($id)
    {
        try {
            $isExists = Stock::with([])->where('ruangan_id', '=', $id)
                ->where('sarana_id', '=', $this->postField('item_id'))
                ->exists();
            if ($isExists) {
                return $this->jsonResponse('sarana sudah tersedia diruangan', 400);
            }
            Stock::create([
                'ruangan_id' => $id,
                'sarana_id' => $this->postField('item_id'),
                'qty' => 0
            ]);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }

    public function room_stock()
    {
        try {
            $room_id = $this->field('room_id');
            $name = $this->field('name');
            $data = Stock::with(['sarana'])
                ->whereHas('sarana', function($q) use ($name){
                    return $q->where('name', 'LIKE', '%'.$name.'%');
                })
                ->where('ruangan_id', '=', $room_id)
                ->get();
            if (!$data) {
                return $this->jsonResponse('ruangan tidak ditemukan', 404);
            }
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('internal server error ' . $e->getMessage(), 500);
        }
    }
}
