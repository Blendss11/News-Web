@extends('admin.parent')

@section('content')

<form action="{{ route('siswa.store') }}" method="post">
    @csrf
    @method('POST')

    <label for="" class="form-label">Name Siswa</label>
    <input type="text" class="form-control" name="name">

    <label for="" class="form-label">Phone Siswa</label>
    <input type="number" class="form-control" name="phone">
    
    <label for="" class="form-label">Address</label>
    <textarea class="form-control" name="address" id="" cols="30" rows="10"></textarea>

    <button class="btn btn-primary mt-3" type="submit">Add Siswa</button>
</form>

@endsection