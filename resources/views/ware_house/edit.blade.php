@extends('layout.master')
@section('content')
    <form action="{{ route('warehouses.update', $each) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label> Tên Danh Mục </label>
            <input type="text" name="name" class="form-control" value="{{ $each->name }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Địa chỉ </label>
            <input type="text" name="address" class="form-control" value="{{ $each->address }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-fileinput" class="form-label">Hình ảnh</label>
            <input type="file" id="example-fileinput" class="form-control" value="{{ $each->images }}">
        </div>
        <div class="mb-3">
            <label for="example-helping" class="form-label">Kinh độ</label>
            <input type="text" id="example-helping" class="form-control" placeholder="Helping text" value="{{ $each->longitude }}">
        </div>
        <div class="mb-3">
            <label for="example-helping" class="form-label">Vĩ độ</label>
            <input type="text" id="example-helping" class="form-control" placeholder="Helping text" value="{{ $each->latitude }}">
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
        <button type="submit" class="btn btn-success"> Cập Nhật </button>
    </form>
@endsection
