@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css"
        rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .btn-group-action {
            display: flex;
            gap: 6px;
        }

        .card-body .btn {
            margin-bottom: 10px;
        }

        table.dataTable td {
            vertical-align: middle;
        }
    </style>
    <style>
        /* Tùy chỉnh bố cục cho hàng chứa dropdown & search */
        div.dataTables_wrapper .top {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        /* Tùy chỉnh bố cục cho hàng chứa info & paginate */
        div.dataTables_wrapper .bottom {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        /* Optional: giảm margin cho nút */
        .card-body .btn {
            margin-bottom: 10px;
        }

        table.dataTable td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-body ">

            <a class="btn btn-success" href="{{ route('export_receipts.create') }}">
                Thêm
            </a>
            {{-- <div class="form-group">
            <select id="select-course-name"></select>
        </div> --}}
            {{-- <div class="form-group">
            <select id="select-status" class="form-control">
                <option value="00">
                    Tất cả
                </option>
                {{-- chọn lựa cái chỗ đi học á --}}
            {{-- @foreach ($arrStudentStatus as $option => $value)
                    <option value="{{ $value  }}">
                        {{ $option }}
                    </option>
                @endforeach --}}
            {{-- </select>
        </div> --}}

            <table class="table table-striped table-bordered table-hover mt-3" id="table-index" style="width: 100%;">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Tên Nhân Viên</th>
                        <th>Kho</th>
                        <th>Khách Hàng</th>
                        <th>Ngày Lập</th>
                        <th>PT Thanh Toán</th>
                        <th>Tổng tiền</th>
                        <th>Trạng Thái</th>
                        <th class="not-export">Sửa</th>
                        <th class="not-export">Xoá</th>
                        <th class="not-export">In</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('js')
    {{-- đẩy vào javascript     --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.3.0/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/date-1.5.5/fc-5.0.4/fh-4.0.1/r-3.0.4/rg-1.5.1/sc-2.4.3/sb-1.8.2/sl-3.0.0/datatables.min.js">
    </script>
    <script>
        $(function() {
            let buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };
            let table = $('#table-index').DataTable({
                dom: 'Blfrtip',
                select: true,
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excelHtml5',
                    }),
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    'colvis'
                ],
                // đoạn này xử lý print ra không dính edit vs delete
                processing: true,
                serverSide: true,
                ajax: '{!! route('export_receipt.api') !!}',
                columnDefs: [{
                    className: "not-export",
                    targets: [8, 9, 10]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'employee_id',
                        name: 'employee_id'
                    },
                    {
                        data: 'warehouse_id',
                        name: 'warehouse_id'
                    },
                    {
                        data: 'customer_id',
                        name: 'customer_id'
                    },
                    {
                        data: 'issued_date',
                        name: 'issued_date'
                    },
                    {
                        data: 'payment_method_id',
                        name: 'payment_method_id'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'edit',
                        target: 8,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}">
                        Edit
                        </a>`;
                        }
                    },
                    {
                        data: 'destroy',
                        target: 9,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `
                            <form action="${data}" method="POST" class="d-inline"> 
                                @csrf
                                @method('DELETE')
                                <button class=" btn btn-sm btn-danger btn-delete" type='button'> Delete</button>    
                            </form>
                        `;
                        }
                    },
                    {
                        data: 'print',
                        target: 10,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<a href="/export_receipts/print/${row.id}" class="btn btn-info btn-sm" target="_blank">In</a>`;
                        }
                    },
                    // {
                    //     data: 'delete',
                    //     name: 'delete',
                    //     orderable: false,
                    //     searchable: false
                    // }
                ]
            });


            $(document).on('click', '.btn-delete', function() {
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        table.ajax.reload();
                        // console.log("success");
                        // table.draw();

                    },
                    error: function() {
                        alert('Lỗi không xoá được. ');
                        // console.log("error");
                        console.error(xhr.responseText); // để log lỗi server
                    }
                });
            });
        });
    </script>
@endpush
