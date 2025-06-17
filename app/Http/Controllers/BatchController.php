<?php

namespace App\Http\Controllers;

use App\Http\Requests\Batch\DestroyRequest;
use App\Http\Requests\Batch\StoreRequest;
use App\Http\Requests\Batch\UpdateRequest;
use App\Models\batch;
use App\Http\Requests\StorebatchRequest;
use App\Http\Requests\UpdatebatchRequest;
use App\Models\import_receipt;
use App\Models\Material;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new batch())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
           return view('batche.index');
    }
       public function api()
    {
        return DataTables::of(batch::query())
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
                return route('batches.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('batches.destroy', $object);
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
         $materials = Material::query()->get();
        $import_receipts = import_receipt::query()->get();
        return view('batche.create', [
            'materials' => $materials,
            'import_receipts' => $import_receipts,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
         $this->model->create($request->validated());
        return redirect()->route('batches.index')->with('success', 'Danh mục đã được tạo.');

    }

    /**
     * Display the specified resource.
     */
    public function show(batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(batch $batch)
    {
        $materials = Material::query()->get();
        $import_receipts = import_receipt::query()->get();
        return view('batche.edit', [
            'each' => $batch,
            'materials' => $materials,
            'import_receipts' => $import_receipts,
        ]);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,  $batchId)
    {
        
        $object = $this->model->find($batchId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('batches.index');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request ,$batchId)
    {
        // Material::where('material_id', $batchId)->update(
        //     ['material_id' => null],
        // );
        // // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        // import_receipt::where('import_receipt_id', $batchId)->update(
        //     ['import_receipt_id' => null],
        // );

        // Xóa bản ghi trong bảng warehouses
        $this->model->where('id', $batchId)->delete();

        return response([
            'status' => true,
            'message' => 'Xóa kho thành công'
        ], 200);
    }
}
