<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreRequest;
use App\Models\employee;
use App\Http\Requests\StoreemployeeRequest;
use App\Http\Requests\UpdateemployeeRequest;
use App\Models\warehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;

     public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new employee())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('employee.index');
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
        return DataTables::of($this->model->with('warehouse'))
            ->editColumn('created_at', function ($object) {
                return $object->created_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            })
            ->editColumn('updated_at', function ($object) {
                return $object->updated_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            })
            ->editColumn('status', function ($object) {
                return $object->status == 0 ? 'Hoạt Động' : 'Ngưng hoạt động';
            })
            ->addColumn('warehouse_name', function ($object) {
                return $object->warehouse->name;
            })
            ->addColumn('edit', function ($object) {
                return '<a href="' . route('categorys.edit', $object->id) . '" class="btn btn-sm btn-primary">Sửa</a>';
            })
            ->addColumn('delete', function ($object) {
                return '<form action="' . route('categorys.destroy', $object->id) . '" method="POST" onsubmit="return confirm(\'Bạn có chắc muốn xóa?\')">' .
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
        $warehouses = warehouse::query()->get();

        return view('employee.create',[
            'warehouses' => $warehouses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());

        return redirect()
                ->route('employees.index')
                ->with('success', 'Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateemployeeRequest $request, employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employee $employee)
    {
        //
    }
}
