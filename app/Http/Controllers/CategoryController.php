<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\DestroyRequest;
use App\Http\Requests\category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\category;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Route;
use Yajra\DataTables\DataTables;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct()
    {
        // $this->model = Category::query();
        $this->model = (new Category())->query();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' -> ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('category.index');
    }

    public function api()
    {
         return DataTables::of(Category::query())
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
            ->addColumn('edit', function($object){
                return route('categorys.edit', $object);
            })
            ->addColumn('destroy', function($object){
                return route('categorys.destroy', $object);
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
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('categorys.index')->with('success', 'Danh mục đã được tạo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('category.edit', ['each' => $category,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $categoryId)
    {

        $object = $this->model->find($categoryId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('categorys.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $category, $categoryId)
    {
        $this->model->where('id', $categoryId)->delete();
       // return redirect()->route('categorys.index')->with('success','Xoá danh mục thành công!');
        // Category::destroy($category);
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
