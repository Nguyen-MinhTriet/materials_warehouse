@extends('layout.master')
@section('content')
    <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label> Tên Danh Mục </label>
            <input type="text" name="name" class="form-control" value="">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Giá </label>
            <input type="text" name="price" class="form-control" value="">
            @error('price')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-fileinput" class="form-label">Chọn hình</label>
            <input type="file" name="image" class="form-control">
            @error('image')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-textarea" class="form-label">Mô tả</label>
            <textarea class="form-control" id="example-textarea" name="description" rows="5"></textarea>
            @error('description')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="han_sd" class="block text-sm font-medium text-gray-700">Hạn SD</label>
            <input type="date" id="han_sd" name="expiration_date"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('expiration_date')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="ngay_sx" class="block text-sm font-medium text-gray- <div class="mb-4">
                <label for="ngay_sx" class="block text-sm font-medium text-gray-700">Ngày SX</label>
                <input type="date" id="ngay_sx" name="manufacture_date"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('manufacture_date')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
        </div>
        <div class="form-group">
            <label>Danh mục</label>
            <select name="category_id" class="form-control">
                @foreach ($category as $categorys)
                    <option value="{{ $categorys->id }}" {{ old('category_id') == $categorys->id ? 'selected' : '' }}>
                        {{ $categorys->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Đơn vị tính</label>
            <select name="unit_id" class="form-control">
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
            @error('unit_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="so_luong" class="block text-sm font-medium text-gray-700">Số Lượng</label>
            <input type="number" id="so_luong" name="quantity" min="0"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('quantity')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="thong_tin" class="block text-sm font-medium text-gray-700">Thông tin</label>
            <textarea id="thong_tin" name="information" rows="4"
                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            @error('information')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <label> Trạng thái </label>
        <div class="mt-2">
            <div class="form-check form-check-inline">
                <input type="radio" id="customRadio3" name="status" class="form-check-input" value="0"
                    {{ old('status') == '0' ? 'checked' : '' }}>
                <label class="form-check-label" for="customRadio3">Hoạt động</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="customRadio4" name="status" class="form-check-input" value="1"
                    {{ old('status') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="customRadio4">Ngưng hoạt động</label>
            </div>
            @error('status')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
@endsection
