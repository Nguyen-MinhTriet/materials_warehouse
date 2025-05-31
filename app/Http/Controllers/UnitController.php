<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\DestroyRequest;
use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Models\unit;
use App\Http\Requests\StoreunitRequest;
use App\Http\Requests\UpdateunitRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new Unit())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('unit.index');
    }
        public function api()
    {

        // return DataTables::of(Category::query())->make(true);

        //    return DataTables::of(Category::query())
        //     ->editColumn('created_at', function ($object) {
        //         return $object->created_at ? $object->created_at->format('Y') : '';
        //     })
        //     ->editColumn('status', function ($object) {
        //         return $object->status == 0 ? 'Nam' : 'Nữ';
        //     })
        //     ->make(true);
        return DataTables::of(Unit::query())
            ->editColumn('created_at', function ($object) {
                return $object->created_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            })
            ->editColumn('updated_at', function ($object) {
                return $object->updated_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            })
            ->editColumn('status', function ($object) {
                return $object->status == 0 ? 'Hoạt Động' : 'Ngưng hoạt động';
            })
            ->addColumn('edit', function ($object) {
                return '<a href="' . route('units.edit', $object->id) . '" class="btn btn-sm btn-primary">Sửa</a>';
            })
            ->addColumn('delete', function ($object) {
                return '<form action="' . route('units.destroy', $object->id) . '" method="POST" onsubmit="return confirm(\'Bạn có chắc muốn xóa?\')">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-sm btn-danger">Xoá</button></form>';
            })
            ->rawColumns(['edit', 'delete']) // Cho phép render HTML trong cột edit và delete
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('units.index')->with('success', 'Danh mục đã được tạo.');

    }

    /**
     * Display the specified resource.
     */
    public function show(unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(unit $unit)
    {
        return view('unit.edit', ['each' => $unit,]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,  $unitID)
    {
        $object = $this->model->find($unitID);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest  $unit, $unitID)
    {
        $this->model->where('id', $unitID)->delete();
        return redirect()->route('units.index')->with('success','Xoá danh mục thành công!');
    
    }
}
