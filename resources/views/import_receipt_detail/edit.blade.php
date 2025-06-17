@extends('layout.master')
@section('content')
    <form action="{{ route('import_receipts.update', $each) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Tên Nhân Viên</label>
            <select name="employee_id" class="form-control">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}"
                        {{ old('employee_id', $each->employee_id) == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
            @error('employee_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Kho</label>
            <select name="warehouse_id" class="form-control">
                @foreach ($warehouses as $wh)
                    <option value="{{ $wh->id }}"
                        {{ old('warehouse_id', $each->warehouse_id) == $wh->id ? 'selected' : '' }}>
                        {{ $wh->name }}
                    </option>
                @endforeach
            </select>
            @error('warehouse_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Nhà Cung Cấp</label>
            <select name="supplier_id" class="form-control">
                @foreach ($suppliers as $ncc)
                    <option value="{{ $ncc->id }}"
                        {{ old('supplier_id', $each->supplier_id) == $ncc->id ? 'selected' : '' }}>
                        {{ $ncc->name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-date" class="form-label">Ngày Lập</label>
            <input class="form-control" id="example-date" type="date" name="issued_date"
                value="{{ $each->issued_date }}">
            @error('issued_date')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="example-number" class="form-label">Tổng Tiền</label>
            <input class="form-control" id="example-number" type="number" name="total_amount"
                value="{{ $each->total_amount }}">
            @error('total_amount')
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
