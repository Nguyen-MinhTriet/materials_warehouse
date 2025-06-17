<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethods\DestroyRequest;
use App\Http\Requests\PaymentMethods\StoreRequest;
use App\Http\Requests\PaymentMethods\UpdateRequest;
use App\Models\export_receipt;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new PaymentMethod())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }

    public function index()
    {
        // return view('payment_methods.index');
        return view('payment_method.index');
    }
    public function api()
    {
        return DataTables::of(PaymentMethod::query())
            ->editColumn('created_at', function ($object) {
                return $object->created_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            })
            ->editColumn('updated_at', function ($object) {
                return $object->updated_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            })

            ->addColumn('edit', function ($object) {
                return route('payment_methods.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('payment_methods.destroy', $object);
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
        return view('payment_method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('payment_methods.index')->with('success', 'Danh mục đã được tạo.');

    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $payment_methods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $payment_method)
    {
        return view('payment_method.edit', ['each' => $payment_method]);
        //       return view('payment_methods.edit', ['each' => $payment_method]);
        // return redirect()->route('payment_methods.update', ['payment_method' => $payment_methods->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $payment_methodsId)
    {

        $object = $this->model->find($payment_methodsId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('payment_methods.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, $payment_methodsId)
    {
        export_receipt::where('payment_method_id', $payment_methodsId)->update(
            ['payment_method_id' => null],
        );
        $this->model->where('id', $payment_methodsId)->delete();

        return response([
            'status' => true,
            'message' => 'Xóa kho thành công'
        ], 200);
        // $this->model->where('id', $payment_methodsId)->delete();
        // return redirect()->route('payment_methods.index')->with('success', 'Xoá danh mục thành công!');

    }
}
