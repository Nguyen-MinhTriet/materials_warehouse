@extends('layout.master')
@push('css')
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css" rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-body ">
            <a class="btn btn-success" href="{{ route('payment_methods.create') }}">
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
                        <th>Tên Danh Mục</th>
                        <th>  Create At</th>
                        <th>  Create At</th>
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
            let table = $('#table-index').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('payment_methods.api') !!}',
                columnDefs: [
                    { className: "not-export", targets: [4, 5] }
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'edit', name: 'edit', },
                    { data: 'delete', name: 'delete', orderable: false, searchable: false }
                ]
            });
        });
    </script>

@endpush
