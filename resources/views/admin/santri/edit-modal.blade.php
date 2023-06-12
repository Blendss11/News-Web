@extends('admin.parent')

@section('content')

<form action="{{ route('santri.update', $santri->id) }}" method="post">
    @csrf
    @method('PUT')

    <label for="" class="form-label">Name Siswa</label>
    <input type="text" class="form-control" name="name" value="{{ $santri->name }}">

    <label for="" class="form-label">Phone Siswa</label>
    <input type="number" class="form-control" name="phone" value="{{ $santri->phone }}>
    
    <label for="" class="form-label">City</label>
    <input type="text" class="form-control" name="city" value="{{ $santri->city }}>
    
    <label for="" class="form-label">Date</label>
    <input type="date" class="form-control" name="date" value="{{ $santri->date }}>
    
    <label for="" class="form-label">Address</label>
    <textarea class="form-control" name="address" id="" cols="30" rows="10">{{ $santri->address }}</textarea>

    <button class="btn btn-primary mt-3" type="submit">Update Siswa</button>
</form>


@endsection