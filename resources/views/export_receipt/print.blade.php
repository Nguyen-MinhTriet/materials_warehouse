
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hóa Đơn Xuất #{{ $receipt->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <h2 class="text-center">HÓA ĐƠN XUẤT</h2>
    <div style="display: flex; justify-content: space-between;">
        <div style="width: 48%;">
            <p><strong>Mã phiếu:</strong> {{ $receipt->id }}</p>
            <p><strong>Ngày lập:</strong> {{ $receipt->issued_date }}</p>
            <p><strong>Nhân viên:</strong> {{ $receipt->employee->name ?? '' }}</p>
            <p><strong>Kho:</strong> {{ $receipt->warehouse->name ?? '' }}</p>
        </div>
        <div style="width: 48%;">
            <p><strong>Khách hàng:</strong> {{ $receipt->customer->name ?? '' }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $receipt->paymentMethod->name ?? '' }}</p>
            <p><strong>Trạng thái:</strong> {{ $receipt->status ? 'Đã thanh toán' : 'Chưa thanh toán' }}</p>
        </div>
    </div>
    <h4>Chi tiết:</h4>
    <table>
        <thead>
            <tr>
                <th>Vật tư</th>
                <th>Lô hàng</th>
                <th>Số lượng</th>
                <th>Đơn Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receipt->details as $detail)
                <tr>
                    <td>{{ $detail->material->name ?? '' }}</td>
                    <td>{{ $detail->batch->name ?? '' }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->material->price ?? 0, 0, ',', '.') }} đ</td>
                    <td>{{ number_format($detail->total_price, 0, ',', '.') }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Tổng cộng: {{ number_format($receipt->total_amount, 0, ',', '.') }} đ</h4>

    <br>
</div>
    <button onclick="window.print()" class="btn btn-success" >In hóa đơn</button>
</body>

</html>
