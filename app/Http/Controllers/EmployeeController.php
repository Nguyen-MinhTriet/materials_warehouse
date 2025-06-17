<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\DestroyRequest;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\employee;
use App\Http\Requests\StoreemployeeRequest;
use App\Http\Requests\UpdateemployeeRequest;
use App\Models\export_receipt;
use App\Models\import_receipt;
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
        //return view('employee.index');
        $employees = employee::with('warehouse')->get();
        return view('employee.index', compact('employees'));
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
                return $object->warehouse ? $object->warehouse->name : 'Không có kho';
            })
            ->addColumn('edit', function ($object) {
                return route('employees.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('employees.destroy', $object);
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouses = warehouse::query()->get();

        return view('employee.create', [
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
        $warehouses = Warehouse::query()->get();
        return view('employee.edit', [
           'each' => $employee,
            'warehouses' => $warehouses,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $employeeId)
    {
        $object = $this->model->find($employeeId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('employees.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request ,$employeeId)
    {
        // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        export_receipt::where('employee_id', $employeeId)->update(
            ['employee_id' => null],
        );
        // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        import_receipt::where('employee_id', $employeeId)->update(
            ['employee_id' => null],
        );
        // Xóa bản ghi trong bảng warehouses
        $this->model->where('id', $employeeId)->delete();

        return response([
            'status' => true,
            'message' => 'Xóa kho thành công'
        ], 200);

    }
}
