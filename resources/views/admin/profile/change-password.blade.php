@extends('admin.parent')


@section('content')

<p>ini halaman change password</p>


@if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endforeach
@endif

<div class="card">
    <div class="card-body">
      <h5 class="card-title">Change password</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="{{ route('updatePassword') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-12">
          <label for="inputPassword4" class="form-label">Current Password</label>
          <input type="password" class="form-control" id="inputPassword4" name="current_password">
        </div>
        <div class="col-12">
          <label for="inputPassword4" class="form-label">New Password</label>
          <input type="password" class="form-control" id="inputPassword4" name="password">
        </div>
        <div class="col-12">
          <label for="inputPassword4" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="inputPassword4" name="confirmation_password">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Update password</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- Vertical Form -->

    </div>
  </div>

@endsection