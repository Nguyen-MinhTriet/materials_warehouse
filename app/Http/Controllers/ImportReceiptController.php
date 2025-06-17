<?php

namespace App\Http\Controllers;

use App\Http\Requests\Import_receipt\DestroyRequest;
use App\Http\Requests\Import_receipt\StoreRequest;
use App\Http\Requests\Import_receipt\UpdateRequest;
use App\Models\batch;
use App\Models\employee;
use App\Models\import_receipt;
use App\Http\Requests\Storeimport_receiptRequest;
use App\Http\Requests\Updateimport_receiptRequest;
use App\Models\Material;
use App\Models\PaymentMethod;
use App\Models\Supplier;
use App\Models\Warehouse;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class ImportReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     **/
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new import_receipt())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        //      $receipts = import_receipt::with('employee', 'warehouse', 'suppliers', 'paymentMethod')->get();

        return view('import_receipt.index');
    }

    public function print($id)
    {
        $receipt = import_receipt::with(['employee', 'warehouse', 'supplier', 'details.material'])->findOrFail($id);

        return view('import_receipt.print', compact('receipt'));
    }
    public function api()
    {
        return DataTables::of(import_receipt::query())
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
                return route('import_receipts.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('import_receipts.destroy', $object);
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
        $employees = employee::query()->get();
        $warehouses = Warehouse::query()->get();
        $suppliers = Supplier::query()->get();
        $materials = Material::query()->get();

        return view('import_receipt.create', [
            'employees' => $employees,
            'warehouses' => $warehouses,
            'suppliers' => $suppliers,
            'materials' => $materials,


        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //  return response()->json($request->all());
        try {
            DB::beginTransaction();

            $importReceipt = $this->model->create([
                'employee_id' => $request->employee_id,
                'warehouse_id' => $request->warehouse_id,
                'supplier_id' => $request->supplier_id,
                'issued_date' => $request->issued_date,
                'status' => $request->status,
                'total_amount' => $request->total_amount,
            ]);

            foreach ($request->input('details', []) as $detail) {
                $importReceipt->details()->create([
                    'material_id' => $detail['material_id'],
                    'quantity' => $detail['quantity'],
                    'total_amount' => $detail['total_amount'],
                ]);
            }

            // Cập nhật số lượng tồn kho trong bảng materials
            $material = Material::find($detail['material_id']);
            if ($material) {
                $material->quantity = ($material->quantity ?? 0) + $detail['quantity'];
                $material->save();
            } else {
                throw new \Exception("Vật tư với ID {$detail['material_id']} không tồn tại.");
            }

            DB::commit();

            return redirect()->route('import_receipts.index')->with('success', 'Hóa đơn đã được tạo thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Lỗi tạo phiếu xuất: ' . $e->getMessage());
            // Log::error($e->getTraceAsString()); // log trace chi tiết
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()])->withInput();
        }
        // $this->model->create($request->validated());
        //  return redirect()->route('import_receipts.index')->with('success', 'Danh mục đã được tạo.');

    }

    /**
     * Display the specified resource.
     */
    public function show(import_receipt $import_receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(import_receipt $import_receipt)
    {

        $employees = employee::query()->get();
        $warehouses = Warehouse::query()->get();
        $suppliers = Supplier::query()->get();
        $materials = Material::query()->get();
        $import_receipt = import_receipt::with('details')->find($import_receipt->id);
        return view('import_receipt.edit', [
            'each' => $import_receipt,
            'employees' => $employees,
            'warehouses' => $warehouses,
            'suppliers' => $suppliers,
            'materials' => $materials,

        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $import_receiptId)
    {
        try {
            DB::beginTransaction();

            // Tìm bản ghi export_receipt
            $importReceipt = $this->model->find($import_receiptId);

            // Cập nhật thông tin phiếu xuất
            $importReceipt->update([
                'employee_id' => $request->employee_id,
                'warehouse_id' => $request->warehouse_id,
                'supplier_id' => $request->supplier_id,
                'issued_date' => $request->issued_date,
                'status' => $request->status,
                'total_amount' => $request->total_amount,
            ]);

            // Xóa các chi tiết hóa đơn cũ
            $importReceipt->details()->delete();

            // Tạo lại các chi tiết hóa đơn mới
            foreach ($request->input('details', []) as $detail) {
                $importReceipt->details()->create([
                    'material_id' => $detail['material_id'],
                    'quantity' => $detail['quantity'],
                    'total_amount' => $detail['total_amount'],
                ]);
            }
                        // Cập nhật số lượng tồn kho trong bảng materials
            $material = Material::find($detail['material_id']);
            if ($material) {
                $material->quantity = ($material->quantity ?? 0) + $detail['quantity'];
                $material->save();
            } else {
                throw new \Exception("Vật tư với ID {$detail['material_id']} không tồn tại.");
            }

            DB::commit();

            return redirect()->route('import_receipts.index')->with('success', 'Hóa đơn đã được cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()])->withInput();
        }
        //$object = $this->model->find($import_receiptId);
        // $object->fill($request->validated());
        // $object->save();

        //  return redirect()->route('import_receipts.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, $import_receiptId)
    {
        // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        import_receipt::where('employee_id', $import_receiptId)->update(
            ['employee_id' => null],
        );
        // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        import_receipt::where('warehouse_id', $import_receiptId)->update(
            ['warehouse_id' => null],
        );
        import_receipt::where('supplier_id', $import_receiptId)->update(
            ['supplier_id' => null],
        );
        // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        batch::where('import_receipt_id', $import_receiptId)->update(['import_receipt_id' => null]);


        try {
            DB::beginTransaction();

            // Tìm phiếu nhập để xử lý
            $importReceipt = $this->model->findOrFail($import_receiptId);

            // Xử lý cập nhật số lượng tồn kho từ các chi tiết nhập
            foreach ($importReceipt->details as $detail) {
                $material = $detail->material;
                if ($material) {
                    $material->quantity = max(0, $material->quantity - $detail->quantity); // Tránh số lượng âm
                    $material->save();
                }
            }

            // Xóa các bản ghi chi tiết nhập liên quan
            $importReceipt->details()->delete();

            // Xóa các bản ghi batches liên quan (nếu không cần giữ)
            \App\Models\batch::where('import_receipt_id', $import_receiptId)->delete();

            // Xóa phiếu nhập chính
            $importReceipt->delete();

            DB::commit();

            return response([
                'status' => true,
                'message' => 'Xóa phiếu nhập thành công'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi xóa phiếu nhập: ' . $e->getMessage());
            \Log::error($e->getTraceAsString()); // Log trace chi tiết để debug
            return response([
                'status' => false,
                'message' => 'Có lỗi xảy ra khi xóa phiếu nhập: ' . $e->getMessage()
            ], 500);
        }
        // Xoá các bản ghi chi tiết liên quan trước
        // DB::table('import_receipt_details')
        //     ->where('import_receipt_id', $import_receiptId)
        //     ->delete();

        // // Sau đó mới xoá phiếu xuất chính
        // $this->model->where('id', $import_receiptId)->delete();

        // return response([
        //     'status' => true,
        //     'message' => 'Xóa phiếu xuất thành công'
        // ], 200);
    }
}
