@extends('layout.master')
@section('content')
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label> tên khác Name</label>
            <input type="text" name="nickname" class="form-control" value="{{ old('name') }}">
            @error('nickname')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Telephone</label>
            <input type="text" name="phone" class="form-control" data-toggle="input-mask" data-mask-format="0000-0000" value="{{ old('phone') }}">
            @error('phone')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{ old('address') }}">
            @error('address')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Trạng thái</label>
            <div class="mt-2">
                <div class="form-check form-check-inline">
                    <input type="radio" id="statusActive" name="status" class="form-check-input" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusActive">Hoạt động</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="statusInactive" name="status" class="form-check-input" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusInactive">Ngưng hoạt động</label>
                </div>
                @error('status')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
