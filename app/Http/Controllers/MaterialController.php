<?php

namespace App\Http\Controllers;

use App\Http\Requests\Material\DestroyRequest;
use App\Http\Requests\Material\StoreRequest;
use App\Http\Requests\Material\UpdateRequest;
use App\Models\Category;
use App\Models\material;
use App\Http\Requests\StorematerialRequest;
use App\Http\Requests\UpdatematerialRequest;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new Material())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('material.index');
    }
    public function getPrice($id)
    {
        $material = material::find($id);
        if ($material) {
            return response()->json(['price' => $material ? $material->price : 0]); // Giả sử cột giá trong bảng materials là 'price'
        }
        return response()->json(['price' => 0], 404);
    }
    public function api()
    {
        return DataTables::of(material::query())
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
                return route('materials.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('materials.destroy', $object);
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
        $categorys = Category::query()->get();
        $units = Unit::query()->get();
        return view('material.create', [
            'category' => $categorys,
            'units' => $units,

        ]);
        //return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $path = Storage::disk('public')->putFile('Vt_images', $request->file('image'));
        $arr = $request->validated();
        $arr['image'] = $path;

        material::create($arr);
        return redirect()
            ->route('materials.index')
            ->with('success', 'Đã thêm thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(material $material)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(material $material)
    {
        return view('material.edit', ['each' => $material,]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $materialId)
    {
        $object = $this->model->findOrFail($materialId);

        $data = $request->validated();

        // Xử lý file ảnh
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($object->image && Storage::exists($object->image)) {
                Storage::delete($object->image);
            }
            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('KL_images', 'public');
            $data['image'] = $imagePath;
            // $object->image = $imagePath;
        } else {
            unset($data['image']);
        }

        // Cập nhật các trường khác
        $object->fill($data);
        $object->save();

        return redirect()->route('warehouses.index')->with('success', 'Cập nhật kho thành công!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $requet, $materialId)
    {
        // Cập nhật warehouse_id thành NULL cho các bản ghi liên quan
        Material::where('warehouse_id', $materialId)->update(['warehouse_id' => null]);


        // Xóa bản ghi trong bảng warehouses
        $this->model->where('id', $materialId)->delete();

        return response([
            'status' => true,
            'message' => 'Xóa kho thành công'
        ], 200);
    }
}
