<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warehouse\StoreRequest;
use App\Http\Requests\Warehouse\UpdateRequest;
use App\Models\warehouse;
use App\Http\Requests\StorewarehouseRequest;
use App\Http\Requests\UpdatewarehouseRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new warehouse())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('ware_house.index');
    }
    public function api()
    {
        return DataTables::of(warehouse::query())
            // ->editColumn('created_at', function ($object) {
            //     return $object->created_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            // })
            // ->editColumn('updated_at', function ($object) {
            //     return $object->updated_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            // })
            ->editColumn('status', function ($object) {
                return $object->status == 0 ? 'Hoạt Động' : 'Ngưng hoạt động';
            })
            // ->addColumn('edit', function ($object) {
            //     return '<a href="' . route('categorys.edit', $object->id) . '" class="btn btn-sm btn-primary">Sửa</a>';
            // })
            ->addColumn('edit', function ($object) {
                return route('warehouses.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('warehouses.destroy', $object);
            })
            // ->addColumn('delete', function ($object) {
            //     return '<form action="' . route('categorys.destroy', $object->id) . '" method="POST" onsubmit="return confirm(\'Bạn có chắc muốn xóa?\')">' .
            //         csrf_field() . method_field('DELETE') .
            //         '<button type="submit" class="btn btn-sm btn-danger">Xoá</button></form>';
            // })
            // ->rawColumns(['edit', 'delete']) // Cho phép render HTML trong cột edit và delete
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ware_house.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $path = Storage::disk('public')->putFile('KL_images', $request->file('image'));
        $arr = $request->validated();
        $arr['image'] = $path;

        Warehouse::create($arr);
        return redirect()
            ->route('warehouses.index')
            ->with('success', 'Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(warehouse $warehouse)
    {
        return view('ware_house.edit', ['each' => $warehouse,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $warehouseId)
    {
        $object = $this->model->find($warehouseId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('warehouses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(warehouse $warehouse)
    {
        //
    }
}
