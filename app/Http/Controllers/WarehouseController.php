<?php

namespace App\Http\Controllers;

use App\Repositories\WarehouseRepository;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    protected $warehouseRepository;

    public function __construct()
    {
        $this->warehouseRepository = new WarehouseRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($warehouse_Id)
    {
        $warehouse = $this->warehouseRepository->getById($warehouse_Id);
        if (empty($warehouse)) {
            $notification = response_array('danger', __('Warehouse not found.'));
            return redirect()->route('home')->with('notification', $notification);
        }

        $compacts = [
            'warehouse' => $warehouse,
            'formData' => session('form_data', [])
        ];

        return view('warehouse.index', $compacts);
    }
}
