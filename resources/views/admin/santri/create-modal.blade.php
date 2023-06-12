@extends('admin.parent')

@section('content')

<form action="{{ route('santri.store') }}" method="post">
    @csrf
    @method('POST')

    <label for="" class="form-label">Name Siswa</label>
    <input type="text" class="form-control" name="name">

    <label for="" class="form-label">Phone Siswa</label>
    <input type="number" class="form-control" name="phone">

    <label for="" class="form-label">City</label>
    <input type="text" class="form-control" name="city">

    <label for="" class="form-label">Date</label>
    <input type="date" class="form-control" name="date">
    
    <label for="" class="form-label">Address</label>
    <textarea class="form-control" name="address" id="" cols="30" rows="10"></textarea>

    <button class="btn btn-primary mt-3" type="submit">Add santri</button>
</form>

@endsection