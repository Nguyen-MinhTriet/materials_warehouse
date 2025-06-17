@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css"
        rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-body ">
            <a class="btn btn-success" href="{{ route('batches.create') }}">
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

            <table class="table table-striped table-centered mb-0" id="table-index">
                <thead class="table-light">
                    <tr>
                        <th>#</th> 
                        <th>Tên </th> 
                        <th>Vật Tư</th>
                        <th>Phiều Nhập</th>
                        <th>Số Lượng Nhập</th>
                        <th>Giá Nhập</th>
                        <th>Ngày Nhập</th>
                        <th>Sl Tồn</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
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
                    $.extend(true, {}, buttonCommon, {
                        extend: 'print',
                    }),
                    'colvis'
                ],
                // đoạn này xử lý print ra không dính edit vs delete
                processing: true,
                serverSide: true,
                ajax: '{!! route('batches.api') !!}',
                columnDefs: [{
                    className: "not-export",
                    targets: [8, 9]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'material_id',
                        name: 'material_id'
                    },
                    {
                        data: 'import_receipt_id',
                        name: 'import_receipt_id'
                    },
                    {
                        data: 'import_quantity',
                        name: 'import_quantity'
                    },
                    {
                        data: 'import_price',
                        name: 'import_price'
                    },
                    {
                        data: 'import_date',
                        name: 'import_date'
                    },
                    {
                        data: 'stock_quantity',
                        name: 'stock_quantity'
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
                            <form action="${data}" method="POST"> 
                                @csrf
                                @method('DELETE')
                                <button class=" btn-delete btn btn-danger" type='button'> Delete</button>    
                            </form>
                        `;
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
                DataType: 'json',
                data: form.serialize(),
                success:function() {
                    console.log("success");
                    table.draw();
                    
                },
                error: function () {
                    console.log("error");
                }
            });
        }); 
        });
    </script>
@endpush
