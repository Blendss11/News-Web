@extends('admin.parent')

@section('content')



<label for="" class="form-label">Name</label>
<input type="text" class="form-control" value="{{ $santri->name }}" readonly>

<label for="" class="form-label">Phone</label>
<input type="text" class="form-control" value="{{ $santri->phone }}" readonly>
<label for="" class="form-label">city</label>
<input type="text" class="form-control" value="{{ $santri->city }}" readonly>
<label for="" class="form-label">date</label>
<input type="date" class="form-control" value="{{ $santri->date }}" readonly>


<label for="" class="form-label">Address</label>
<textarea class="form-control"  cols="30" rows="10" readonly>
    {!! $santri->address !!}
</textarea>

<a href="{{ route('santri.index') }}" class="btn btn-outline-info mt-3">Back</a>

@endsection