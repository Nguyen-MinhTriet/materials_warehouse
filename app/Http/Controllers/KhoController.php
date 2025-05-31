<?php

namespace App\Http\Controllers;

use App\Models\kho;
use App\Http\Requests\StorekhoRequest;
use App\Http\Requests\UpdatekhoRequest;
use App\Models\warehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class KhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new kho())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        // return view('warehouse.index');
    }
        public function api()
    {
        // return DataTables::of($this->model->with('warehouse'))
        //     ->editColumn('gender', function($object) {
        //         return $object->gender_name;
        //     })
        //     ->addColumn('edit', function($object) {
        //         return route('warehouses.edit', $object->id);
        //     })
        //     ->addColumn('destroy', function($object) {
        //         return route('warehouses.destroy', $object->id);
        //     })        
        //     ->make(true);      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(kho $kho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kho $kho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekhoRequest $request, kho $kho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kho $kho)
    {
        //
    }
}
