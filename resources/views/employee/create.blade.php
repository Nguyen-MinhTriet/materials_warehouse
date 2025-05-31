@extends('layout.master')
@section('content')
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" value="{{ old('email') }}">
            @error('email')
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
            <label>Chức Vụ</label>
            <input type="text" name="position" class="form-control" value="{{ old('position') }}">
            @error('position')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Hợp Đồng</label>
            <input type="text" name="contract" class="form-control" value="{{ old('contract') }}">
            @error('contract')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div class="mt-2">
                <div class="form-check form-check-inline">
                    <input type="radio" id="genderMale" name="gender" class="form-check-input" value="0" {{ old('gender') == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="genderMale">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="genderFemale" name="gender" class="form-check-input" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="genderFemale">Nữ</label>
                </div>
                @error('gender')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Birthdate</label>
            <input type="date" name="birth_date" value="{{ old('birth_date') }}">
            @error('birth_date')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Kho</label>
            <select name="warehouse_id" class="form-control">
                @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                        {{ $warehouse->name }}
                    </option>
                @endforeach
            </select>
            @error('warehouse_id')
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
