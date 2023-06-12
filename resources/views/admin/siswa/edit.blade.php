@extends('admin.parent')

@section('content')

<form action="{{ route('siswa.update', $siswa->id) }}" method="post">
    @csrf
    @method('PUT')

    <label for="" class="form-label">Name Siswa</label>
    <input type="text" class="form-control" name="name" value="{{ $siswa->name }}">

    <label for="" class="form-label">Phone Siswa</label>
    <input type="number" class="form-control" name="phone" value="{{ $siswa->phone }}>
    
    <label for="" class="form-label">Address</label>
    <textarea class="form-control" name="address" id="" cols="30" rows="10">{{ $siswa->address }}</textarea>

    <button class="btn btn-primary mt-3" type="submit">Update Siswa</button>
</form>


@endsection