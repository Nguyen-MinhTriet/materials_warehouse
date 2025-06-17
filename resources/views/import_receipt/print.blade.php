<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Phiếu Nhập - {{ $receipt->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            @page {
                size: A4 landscape; /* Chế độ ngang */
            }
            .no-print {
                display: none;
            }
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 10mm;
            }
            .container {
                width: 100%;
                max-width: 297mm; /* Chiều dài A4 ngang */
                margin: 0 auto;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
            }
            th, td {
                border: 1px solid #000;
                padding: 4px;
                text-align: left;
                word-wrap: break-word;
                font-size: 12px;
            }
            th:nth-child(1) { width: 5%; } /* STT */
            th:nth-child(2) { width: 20%; } /* Vật tư */
            th:nth-child(3) { width: 15%; } /* Lô hàng */
            th:nth-child(4) { width: 10%; } /* Số lượng */
            th:nth-child(5) { width: 20%; } /* Đơn giá */
            th:nth-child(6) { width: 20%; } /* Tổng tiền */
            .header, .footer {
                margin: 10px 0;
            }
            .footer {
                display: flex;
                justify-content: space-between;
            }
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20mm;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tiêu đề phiếu nhập -->
        <div class="header">
            <h2>PHIẾU NHẬP KHO</h2>
            <p>Số phiếu: {{ $receipt->id }} | Ngày: {{ $receipt->created_at->format('d/m/Y') }}</p>
        </div>

        <!-- Thông tin phiếu nhập -->
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Nhân viên:</strong> {{ $receipt->employee->name ?? 'N/A' }}</p>
                <p><strong>Kho:</strong> {{ $receipt->warehouse->name ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Nhà cung cấp:</strong> {{ $receipt->supplier->name ?? 'N/A' }}</p>
             
            </div>
        </div>

        <!-- Chi tiết phiếu nhập -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Vật tư</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($receipt->details as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->material->name ?? 'N/A' }}</td>
                        {{-- <td>{{ $detail->batch->batch_number ?? 'N/A' }}</td> --}}
                        <td>{{ $detail->quantity }}</td>
                        {{-- <td>{{ number_format($detail->unit_price, 2) }}</td> --}}
                         <td>{{ number_format($detail->material->price ?? 0, 0, ',', '.') }} đ</td>
                         <td>{{ number_format($detail->total_amount, 0, ',', '.') }} đ</td>
                         {{-- <td>{{ number_format($detail->total_price, 2) }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td>{{ number_format($receipt->total_amount, 3) }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Chữ ký -->
        <div class="footer">
            <div>
                <p><strong>Người lập phiếu</strong></p>
                <p>(Ký và ghi rõ họ tên)</p>
                <p><br><br>{{ $receipt->employee->name ?? 'N/A' }}</p>
            </div>
            <div>
                <p><strong>Người nhận hàng</strong></p>
                <p>(Ký và ghi rõ họ tên)</p>
                <p><br><br>____________________</p>
            </div>
        </div>

        <!-- Nút in -->
        <div class="no-print text-center mt-4">
            <button class="btn btn-primary" onclick="window.print()">In phiếu</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>

    <script>
        // Tự động mở cửa sổ in khi tải trang
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>