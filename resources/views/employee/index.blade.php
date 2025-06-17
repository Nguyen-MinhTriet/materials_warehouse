@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.3.0/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/date-1.5.5/fc-5.0.4/fh-4.0.1/r-3.0.4/rg-1.5.1/sc-2.4.3/sb-1.8.2/sl-3.0.0/datatables.min.css"
        rel="stylesheet" integrity="sha384-wJzywSIs9l0kNG2OCJpmRYmyY2nUd/oFoJ9ZcRsM9NTXfUvXrQ9gLv6PjixD84+/"
        crossorigin="anonymous">
    {{-- cái link này đẩy vô layout.master á --}}
@endpush

@section('content')
    <div class="card">

        <div class="card-body ">
            <a class="btn btn-success" href="{{ route('employees.create') }} ">
                Thêm
            </a>
            {{-- <a class="btn btn-success" href=" {{ route('employees.create') }} ">
                Thêm
            </a> --}}
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
                        <th>Tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Địa Chỉ</th>
                        <th>Chức Vụ</th>
                        <th>Hợp đồng</th>
                        <th>Giới Tính </th>
                        <th>Ngày Sinh</th>
                        <th>Trạng Thái</th>
                        <th>Kho</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
@endsection

@push('js')
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
                processing: true,
                serverSide: true,
                ajax: '{!! route('employees.api') !!}',
                columnDefs: [{
                    className: "not-export",
                    targets: [11, 12]
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'contract',
                        name: 'contract'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'birth_date',
                        name: 'birth_date'
                    },
                    {
                        data: 'warehouse_name',
                        name: 'warehouse_id'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'edit',
                        target: 11,
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
                        target: 12,
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
                ]
            });
            $(document).on('click', '.btn-delete', function() {
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    DataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        console.log("success");
                        table.draw();

                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });
        });
    </script>
@endpush
