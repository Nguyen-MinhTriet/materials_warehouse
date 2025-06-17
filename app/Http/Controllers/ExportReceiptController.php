<?php

namespace App\Http\Controllers;

use App\Http\Requests\Export_receipt\DestroyRequest;
use App\Http\Requests\Export_receipt\StoreRequest;
use App\Http\Requests\Export_receipt\UpdateRequest;
use App\Models\batch;
use App\Models\Customer;
use App\Models\employee;
use App\Models\export_receipt;
use App\Http\Requests\Storeexport_receiptRequest;
use App\Http\Requests\Updateexport_receiptRequest;
use App\Models\export_receipt_detail;
use App\Models\Material;
use App\Models\PaymentMethod;
use App\Models\Warehouse;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class ExportReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct(export_receipt $model)
    {
        // $this->model = Category::query();
        $this->model = (new export_receipt())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        $receipts = export_receipt::with('employee', 'warehouse', 'customer', 'paymentMethod')->get();

        return view('export_receipt.index', compact('receipts'));
        //    return view('export_receipt.index', compact('receipts'));
    }
    public function print($id)
    {
        $receipt = export_receipt::with(['employee', 'warehouse', 'customer', 'paymentMethod', 'details.material', 'details.batch'])->findOrFail($id);

        return view('export_receipt.print', compact('receipt'));
    }
    public function api()
    {
        return DataTables::of(export_receipt::query())
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
                return route('export_receipts.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('export_receipts.destroy', $object);
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
        $customers = Customer::query()->get();
        $payment_methods = PaymentMethod::query()->get();
        $materials = Material::query()->get();
        $batches = batch::query()->get();
        return view('export_receipt.create', [
            'employees' => $employees,
            'warehouses' => $warehouses,
            'customers' => $customers,
            'payment_methods' => $payment_methods,
            'materials' => $materials,
            'batches' => $batches,

        ]);
        //return view('export_receipt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // return response()->json($request->all());
        try {
            DB::beginTransaction();

            $exportReceipt = $this->model->create([
                'employee_id' => $request->employee_id,
                'warehouse_id' => $request->warehouse_id,
                'customer_id' => $request->customer_id,
                'issued_date' => $request->issued_date,
                'payment_method_id' => $request->payment_method_id,
                'status' => $request->status,
                'total_amount' => $request->total_amount,
            ]);

            foreach ($request->input('details', []) as $detail) {
                $exportReceipt->details()->create([
                    'material_id' => $detail['material_id'],
                    'batch_id' => $detail['batch_id'],
                    'quantity' => $detail['quantity'],
                    'total_price' => $detail['total_price'],
                ]);
            }
            // Cập nhật số lượng tồn kho trong bảng materials (trừ đi)
            $material = Material::find($detail['material_id']);
            if ($material) {
                $currentQuantity = $material->quantity ?? 0;
                $exportQuantity = $detail['quantity'];

                if ($exportQuantity > $currentQuantity) {
                    throw new \Exception("Số lượng xuất ({$exportQuantity}) vượt quá tồn kho ({$currentQuantity}) cho vật tư ID {$detail['material_id']}.");

                }
                $material->quantity = $currentQuantity - $exportQuantity;
                $material->save();
            } else {
                throw new \Exception("Vật tư với ID {$detail['material_id']} không tồn tại.");
            }
            DB::commit();

            return redirect()->route('export_receipts.index')->with('success', 'Hóa đơn đã được tạo thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Lỗi tạo phiếu xuất: ' . $e->getMessage());
            // Log::error($e->getTraceAsString()); // log trace chi tiết
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()])->withInput();
        }
    }
    // $this->model->create($request->validated());
    // return redirect()->route('export_receipts.index')->with('success', 'Danh mục đã được tạo.');
    // try {
    //     // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
    //     DB::beginTransaction();

    //     // Tạo bản ghi trong export_receipts
    //     // $exportReceipt = ExportReceipt::create([
    //     //     'invoice_code' => $validated['invoice_code'],
    //     //     'customer_id' => $validated['customer_id'],
    //     //     'issued_date' => $validated['issued_date'],
    //     //     'total_amount' => $validated['total_amount'],
    //     //     'status' => $validated['status'],
    //     // ]);
    //     $exportReceipt = $this->model->create($request->validated());

    //     // Lưu các chi tiết vào export_receipt_details
    //     if ($request->has('details')) {
    //         foreach ($request->validated()['export_receipt_details'] as $detail) {
    //             export_receipt_detail::create([
    //                 'export_receipt_id' => $exportReceipt->id,
    //                 'material_id' => $detail['material_id'],
    //                 'batch_id' => $detail['batch_id'],
    //                 'quantity' => $detail['quantity'],
    //                 'total_price' => $detail['total_price'],
    //             ]);
    //         }
    //     }

    //     // Commit transaction
    //     DB::commit();

    //     return redirect()->route('export_receipts.index')->with('success', 'Hóa đơn đã được tạo thành công!');
    // } catch (\Exception $e) {
    //     // Rollback nếu có lỗi
    //     DB::rollBack();
    //     return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()])->withInput();
    // }



    /**
     * Display the specified resource.
     */
    public function show(export_receipt $export_receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(export_receipt $export_receipt)
    {
        // $employees = employee::query()->get();
        // $warehouses = Warehouse::query()->get();
        // $customers = Customer::query()->get();
        // $payment_methods = PaymentMethod::query()->get();
        // $materials = Material::query()->get();
        // $batches = batch::query()->get();
        // return view('export_receipt.create', [
        //     'employees' => $employees,
        //     'warehouses' => $warehouses,
        //     'customers' => $customers,
        //     'payment_methods' => $payment_methods,
        //     'materials' => $materials,
        //     'batches' => $batches,

        // ]);
        //     $employees = Employee::query()->get();
        // $warehouses = Warehouse::query()->get();
        // $customers = Customer::query()->get();
        // $payment_methods = PaymentMethod::query()->get();
        // $materials = Material::query()->get();
        // $batches = Batch::query()->get();

        // // Tải chi tiết hóa đơn cùng với export_receipt
        // $export_receipt = ExportReceipt::with('details')->find($export_receipt->id);

        // return view('export_receipt.edit', [
        //     'each' => $export_receipt,
        //     'employees' => $employees,
        //     'warehouses' => $warehouses,
        //     'customers' => $customers,
        //     'payment_methods' => $payment_methods,
        //     'materials' => $materials,
        //     'batches' => $batches,
        // ]);
        $employees = Employee::query()->get();
        $warehouses = Warehouse::query()->get();
        $customers = Customer::query()->get();
        $payment_methods = PaymentMethod::query()->get();
        $materials = Material::query()->get();
        $batches = batch::query()->get();
        $export_receipt = export_receipt::with('details')->find($export_receipt->id);
        return view('export_receipt.edit', [
            'each' => $export_receipt,
            'employees' => $employees,
            'warehouses' => $warehouses,
            'customers' => $customers,
            'payment_methods' => $payment_methods,
            'materials' => $materials,
            'batches' => $batches,
        ]);

        // return view('export_receipt.edit', ['each'=> $export_receipt, ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $export_receiptId)
    {

        try {
            DB::beginTransaction();

            // Tìm bản ghi export_receipt
            $exportReceipt = $this->model->findOrFail($export_receiptId);

            // Cập nhật thông tin phiếu xuất
            $exportReceipt->update([
                'employee_id' => $request->employee_id,
                'warehouse_id' => $request->warehouse_id,
                'customer_id' => $request->customer_id,
                'issued_date' => $request->issued_date,
                'payment_method_id' => $request->payment_method_id,
                'status' => $request->status,
                'total_amount' => $request->total_amount,
            ]);

            // Xóa các chi tiết hóa đơn cũ
            $exportReceipt->details()->delete();

            // Tạo lại các chi tiết hóa đơn mới
            foreach ($request->input('details', []) as $detail) {
                $exportReceipt->details()->create([
                    'material_id' => $detail['material_id'],
                    'batch_id' => $detail['batch_id'],
                    'quantity' => $detail['quantity'],
                    'total_price' => $detail['total_price'],
                ]);
            }

            DB::commit();

            return redirect()->route('export_receipts.index')->with('success', 'Hóa đơn đã được cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $requet, $export_receiptId)
    {
        // // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        export_receipt::where('employee_id', $export_receiptId)->update(
            ['employee_id' => null],
        );
        // // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        // export_receipt::where('warehouse_id', $export_receiptId)->update(
        //     ['warehouse_id' => null],
        // );
        // export_receipt::where('payment_method_id', $export_receiptId)->update(
        //     ['payment_method_id' => null],
        // );
        // export_receipt::where('customer_id', $export_receiptId)->update(
        //     ['customer_id' => null],
        // );

        // Xoá các bản ghi chi tiết liên quan trước
        DB::table('export_receipt_details')
            ->where('export_receipt_id', $export_receiptId)
            ->delete();

        // Sau đó mới xoá phiếu xuất chính
        $this->model->where('id', $export_receiptId)->delete();

        return response([
            'status' => true,
            'message' => 'Xóa phiếu xuất thành công'
        ], 200);
    }
}
