@extends('admin.parent')

@section('content')



<label for="" class="form-label">Name</label>
<input type="text" class="form-control" value="{{ $siswa->name }}" readonly>

<label for="" class="form-label">Phone</label>
<input type="text" class="form-control" value="{{ $siswa->phone }}" readonly>


<label for="" class="form-label">Address</label>
<textarea class="form-control"  cols="30" rows="10" readonly>
    {!! $siswa->address !!}
</textarea>

<a href="{{ route('siswa.index') }}" class="btn btn-outline-info mt-3">Back</a>

@endsection