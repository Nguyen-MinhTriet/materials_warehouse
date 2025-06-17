@extends('layout.master')
@section('content')
    <form action="{{ route('batches.update', $each) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $each->name) }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Vật Tư</label>
            <select name="material_id" class="form-control">
                @foreach ($materials as $vt)
                    <option value="{{ $vt->id }}"
                        {{ old('material_id', $each->material_id) == $vt->id ? 'selected' : '' }}>
                        {{ $vt->name }}
                    </option>
                @endforeach
            </select>
            @error('material_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Piếu Nhập</label>
            <select name="import_receipt_id" class="form-control">
                @foreach ($import_receipts as $px)
                    <option value="{{ $px->id }}"
                        {{ old('import_receipt_id', $each->import_receipt_id) == $px->id ? 'selected' : '' }}>
                        {{ $px->issued_date }}
                    </option>
                @endforeach
            </select>
            @error('import_receipt_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="example-number" class="form-label"> Số Lượng Nhập </label>
            <input class="form-control" id="example-number" type="number" name="import_quantity"
                value="{{ $each->import_quantity }}">
            @error('import_quantity')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-number" class="form-label">Giá Nhập</label>
            <input class="form-control" id="example-number" type="number" name="import_price"
                value="{{ $each->import_price }}">
            @error('import_price')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-date" class="form-label">Ngày Lập</label>
            <input class="form-control" id="example-date" type="date" name="import_date"
                value="{{ $each->import_date }}">
            @error('import_date')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-number" class="form-label">Số Lượng Tồn</label>
            <input class="form-control" id="example-number" type="number"
                name="stock_quantity"value="{{ $each->stock_quantity }}">
            @error('stock_quantity')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success"> Sửa </button>
    </form>
@endsection
