@extends('layout.master')
@section('content')
    <form action="{{ route('suppliers.update' , $each ) }}" method="POST" >
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
            <label> Quốc gia </label>
            <input type="text" name="country" class="form-control" value="{{ $each->country }}">
            @error('country')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ $each->country }}">
            @error('address')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Số điện thoại </label>
            <input type="text" name="phone" class="form-control" value="{{ $each->phone }}">
            @error('phone')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Mã số thuế </label>
            <input type="text" name="tax_code" class="form-control" value="{{ $each->tax_code }}">
            @error('tax_code')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> Người đại diện </label>
            <input type="text" name="contact_person" class="form-control" value="{{ $each->contact_person }}">
            @error('contact_person')
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
