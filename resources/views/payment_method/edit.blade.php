@extends('layout.master')
@section('content')
    <form action="{{ route('payment_methods.update', $each )}}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label> Tên Danh Mục </label>
            <input type="text" name="name" class="form-control" value="{{ $each->name }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success"> Sửa </button>
    </form>
@endsection
