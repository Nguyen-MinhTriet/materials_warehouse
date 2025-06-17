<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\DestroyRequest;
use App\Http\Requests\Supplier\StoreRequest;
use App\Http\Requests\Supplier\UpdateRequest;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new Supplier())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('supplier.index');
    }
    public function api()
    {
        return DataTables::of(Supplier::query())
            ->editColumn('status', function ($object) {
                return $object->status == 0 ? 'Hoạt Động' : 'Ngưng hoạt động';
            })
            ->addColumn('edit', function ($object) {
                return route('suppliers.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('suppliers.destroy', $object);
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
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Danh mục đã được tạo.');

    }

    /**
     * Display the specified resource.
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(supplier $supplier)
    {
        return view('supplier.edit', ['each' => $supplier, ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,  $supplierId)
    {
        
        $object = $this->model->find($supplierId);
        $object->fill($request->validated());
        $object->save();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Đã thêm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $supplier, $supplierId)
    {
        $this->model->where('id', $supplierId)->delete();
       // return redirect()->route('categorys.index')->with('success','Xoá danh mục thành công!');
        // Category::destroy($category);
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
