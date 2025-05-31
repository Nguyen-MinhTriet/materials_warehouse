@extends('layout.master')
@section('content')
    <form action="{{ route('warehouses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label> Tên Danh Mục </label>
            <input type="text" name="name" class="form-control" >
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Địa chỉ </label>
            <input type="text" name="address" class="form-control" ">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-fileinput" class="form-label">Hình ảnh</label>
            <input type="file" id="example-fileinput" name="image" class="form-control"">
        </div>
        {{-- <input type="file" name="image" > --}}

        <div class="form-group">
            <label> Tên Danh Mục </label>
            <input type="text" name="longitude" class="form-control" >
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Tên Danh Mục </label>
            <input type="text" name="latitude" class="form-control" >
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <label> Trạng thái </label>
        <div class="mt-2">
            <div class="form-check form-check-inline">
                <input type="radio" id="customRadio3" name="status" class="form-check-input" value="0"
                    {{ old('status', $each->status ?? 0) == '0' ? 'checked' : '' }}>
                <label class="form-check-label" for="customRadio3">Hoạt động</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="customRadio4" name="status" class="form-check-input" value="1"
                    {{ old('status', $each->status ?? 0) == '1' ? 'checked' : '' }}>
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
