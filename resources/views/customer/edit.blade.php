@extends('layout.master')
@section('content')
    <form action="{{ route('customers.update' , $each ) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Tên Khách Hàng</label>
            <input type="text" name="name" class="form-control" value="{{ old('name' , $each->name ) }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Tên Gọi Khác</label>
            <input type="text" name="nickname" class="form-control" value="{{ old('nickname' ,$each->nickname) }}">
            @error('nickname')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Số Điện Thoại</label>
            <input type="text" name="phone" class="form-control" data-toggle="input-mask" data-mask-format="0000-0000" value="{{ old('phone' , $each->phone) }}">
            @error('phone')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputAddress" class="form-label">Địa Chỉ</label>
            <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Vui lòng nhập địa chỉ" value="{{ old('address', $each->address ) }}">
            @error('address')
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
        <button type="submit" class="btn btn-success"> Sửa </button>
    </form>
@endsection
