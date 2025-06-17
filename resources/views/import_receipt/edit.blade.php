@extends('layout.master')
@section('content')
    <form action="{{ route('import_receipts.update', $each) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
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
            </div>
            <div class="col-md-6">

                <div class="mb-3">
                    <label for="example-date" class="form-label">Ngày Lập</label>
                    <input class="form-control" id="example-date" type="date" name="issued_date"
                        value="{{ $each->issued_date }}">
                    @error('issued_date')
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
            </div>
        </div>

        <button type="button" class="btn btn-primary" id="add-row">Thêm Dòng</button>
        <h4>Chi Tiết Hóa Đơn</h4>
        <table class="table table-bordered" id="invoice-details">
            <thead>
                <tr>
                    <th>Vật Tư</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Tổng Tiền</th>
                    <th>Hành Động</th>
                </tr>
            </thead>

            @foreach ($each->details as $index => $detail)
                <tr class="detail-row">
                    <td>
                        <select name="details[{{ $index }}][material_id]" class="form-control material-id">
                            <option value="">Chọn vật tư</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}"
                                    {{ old('details.' . $index . '.material_id', $detail->material_id) == $material->id ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('details.' . $index . '.material_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="number" name="details[{{ $index }}][quantity]" class="form-control quantity"
                            min="1" value="{{ old('details.' . $index . '.quantity', $detail->quantity) }}">
                        @error('details.' . $index . '.quantity')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="number" name="details[{{ $index }}][unit_price]"
                            class="form-control unit-price" min="0" step="0.01" readonly>
                        @error('details.' . $index . '.unit_price')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="number" name="details[{{ $index }}][total_amount]"
                            class="form-control total-price" readonly
                            value="{{ old('details.' . $index . '.total_amount', $detail->total_amount) }}">
                        @error('details.' . $index . '.total_price')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </td>
                   
                    <td>
                        <button type="button" class="btn btn-danger remove-row">Xóa</button>
                    </td>
                </tr>
            @endforeach

        </table>
        <div class="mb-3">
            <label for="example-number" class="form-label">Tổng Tiền</label>
            <input class="form-control" id="example-number" type="number" name="total_amount"
                value="{{ $each->total_amount }}">
            @error('total_amount')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success"> Sửa </button>
    </form>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tính tổng tiền ngay khi tải trang
            updateTotalAmount();

            // Khởi tạo giá đơn vị cho các dòng hiện có
            $('.material-id').each(function() {
                var materialId = $(this).val();
                var row = $(this).closest('tr');
                if (materialId) {
                    $.ajax({
                        url: '{{ route('get.material.price', '') }}/' + materialId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            row.find('.unit-price').val(data.price);
                            calculateTotalPrice(row);
                            updateTotalAmount();
                        },
                        error: function(xhr) {
                            console.log('AJAX Error: ', xhr.responseText);
                            row.find('.unit-price').val(0);
                        }
                    });
                }
            });
            // Thêm dòng mới
            $(document).on('click', '#add-row', function() {
                var rowCount = $('.detail-row').length;
                var newRow = $('.detail-row:first').clone(); // Sao chép hàng đầu tiên

                // Xóa giá trị và làm mới select
                newRow.find('select, input').val('');
                newRow.find('select').each(function() {
                    $(this).html('<option value="">Chọn...</option>'); // Làm mới dropdown
                    if ($(this).hasClass('material-id')) {
                        @foreach ($materials as $material)
                            $(this).append(
                                '<option value="{{ $material->id }}">{{ $material->name }}</option>'
                            );
                        @endforeach
                    }
                });

                // Cập nhật tên trường với chỉ số mới
                newRow.find('[name]').each(function() {
                    var oldName = $(this).attr('name');
                    var newName = oldName.replace('[0]', '[' + rowCount + ']');
                    $(this).attr('name', newName);
                });

                $('#invoice-details tbody').append(newRow);
                updateTotalAmount();
            });

            // Xóa dòng
            $(document).on('click', '.remove-row', function() {
                if ($('.detail-row').length > 1) {
                    $(this).closest('tr').remove();
                    updateTotalAmount();
                }
            });

            // Lấy giá vật tư qua AJAX
            $(document).on('change', '.material-id', function() {
                var materialId = $(this).val();
                var row = $(this).closest('tr');
                var unitPriceInput = row.find('.unit-price');

                if (materialId) {
                    $.ajax({
                        url: '{{ route('get.material.price', '') }}/' + materialId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            unitPriceInput.val(data.price);
                            calculateTotalPrice(row);
                            updateTotalAmount();
                        },
                        error: function(xhr) {
                            console.log('AJAX Error: ', xhr.responseText);
                            unitPriceInput.val(0);
                        }
                    });
                } else {
                    unitPriceInput.val('');
                    calculateTotalPrice(row);
                    updateTotalAmount();
                }
            });

            // Tính tổng tiền mỗi dòng
            $(document).on('input', '.quantity, .unit-price', function() {
                var row = $(this).closest('tr');
                calculateTotalPrice(row);
                updateTotalAmount();
            });

            // Hàm tính tổng tiền mỗi dòng
            function calculateTotalPrice(row) {
                var quantity = parseFloat(row.find('.quantity').val()) || 0;
                var unitPrice = parseFloat(row.find('.unit-price').val()) || 0;
                var totalPrice = quantity * unitPrice;
                row.find('.total-price').val(totalPrice.toFixed(2));
            }

            // Hàm cập nhật tổng tiền hóa đơn
            function updateTotalAmount() {
                var total = 0;
                $('.total-price').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });
                $('input[name="total_amount"]').val(total.toFixed(2));
            }
        });
    </script>
@endpush
