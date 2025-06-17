<?php

namespace App\Http\Controllers;

use App\Http\Requests\Export_receipt_detail\DestroyRequest;
use App\Http\Requests\Export_receipt_detail\StoreRequest;
use App\Http\Requests\Export_receipt_detail\UpdateRequest;
use App\Models\batch;
use App\Models\export_receipt;
use App\Models\export_receipt_detail;
use App\Http\Requests\Storeexport_receipt_detailRequest;
use App\Http\Requests\Updateexport_receipt_detailRequest;
use App\Models\Material;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class ExportReceiptDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new export_receipt_detail())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
         return view('export_receipt_detail.index');
    }
public function api()
    {
        return DataTables::of(export_receipt_detail::query())
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
                return route('export_receipt_detail.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('export_receipt_detail.destroy', $object);
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
        $export_receipts = export_receipt::query()->get();
        $materials = Material::query()->get();
        $batchs = batch::query()->get();
        return view('export_receipt_detail.create', [
            'export_receipts' => $export_receipts,
            'materials' => $materials,
            'batchs' => $batchs,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        
        $this->model->create($request->validated());
        return redirect()->route('export_receipt_detail.index')->with('success', 'Danh mục đã được tạo.');

    }

    /**
     * Display the specified resource.
     */
    public function show(export_receipt_detail $export_receipt_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(export_receipt_detail $export_receipt_detail)
    {

        $export_receipts = export_receipt::query()->get();
        $materials = Material::query()->get();
        $batchs = batch::query()->get();
        return view('export_receipt_detail.edit', [
            'export_receipts' => $export_receipts,
            'materials' => $materials,
            'batchs' => $batchs,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,  $export_receipt_detailId)
    {
          $object = $this->model->find($export_receipt_detailId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('export_receipts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest  $request,$export_receipt_detailId)
    {
         // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        export_receipt::where('employee_id', $export_receipt_detailId)->update(
            ['employee_id' => null],
        );
        // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        export_receipt::where('warehouse_id', $export_receipt_detailId)->update(
            ['warehouse_id' => null],
        );
        export_receipt::where('payment_method_id', $export_receipt_detailId)->update(
            ['payment_method_id' => null],
        );
        export_receipt::where('customer_id', $export_receipt_detailId)->update(
            ['customer_id' => null],
        );

        // Xóa bản ghi trong bảng warehouses
        $this->model->where('id', $export_receipt_detailId)->delete();

        return response([
            'status' => true,
            'message' => 'Xóa kho thành công'
        ], 200);
    }
}
