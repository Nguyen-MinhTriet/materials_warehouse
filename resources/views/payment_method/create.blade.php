@extends('layout.master')
@section('content')
    <form action="{{ route('payment_methods.store') }}" method="POST" >
        @csrf
        <div class="form-group">
            <label> Tên Danh Mục </label>
            <input type="text" name="name" class="form-control" value="">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
@endsection
