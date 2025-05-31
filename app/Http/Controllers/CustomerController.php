<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\StorecustomerRequest;
use App\Http\Requests\UpdatecustomerRequest;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;

    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new Customer())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('customer.index');
    }
    public function api()
    {
        return DataTables::of(Customer::query())
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
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('customers.index')->with('success', 'Khách hàng đã được tạo.');
  
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecustomerRequest $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        //
    }
}
