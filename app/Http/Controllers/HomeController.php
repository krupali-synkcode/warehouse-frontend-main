<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\EmirateTypeRepository;
use App\Repositories\StorageTypeRepository;
use App\Repositories\WarehouseRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $warehouseRepo;
    protected $categoryRepo;
    protected $storageRepo;
    protected $emirateRepo;

    public function __construct()
    {
        $this->warehouseRepo = new WarehouseRepository;
        $this->categoryRepo = new CategoryRepository;
        $this->storageRepo = new StorageTypeRepository;
        $this->emirateRepo = new EmirateTypeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $latitude = $request->get('latitude', '');
        $longitude = $request->get('longitude', '');

        if ($latitude && $longitude) {
            $request->session()->put('user_latitude', $latitude);
            $request->session()->put('user_longitude', $longitude);
        }

        $warehouses = $this->warehouseRepo->getAll($request);
        $categories = $this->categoryRepo->getAll();
        $storageTypes = $this->storageRepo->getAll();
        $emirateTypes = $this->emirateRepo->getAll();

        $compacts = [
            'warehouses' => $warehouses,
            'categories' => collect($categories)->take(5),
            'dropdownCategories' => collect($categories)->slice(5),
            'storageTypes' => $storageTypes,
            'emirateTypes' => $emirateTypes
        ];
        return view('home', $compacts);
    }
}
