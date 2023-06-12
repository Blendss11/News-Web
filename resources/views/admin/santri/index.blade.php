@extends('admin.parent')

@section('content')

<div class="container card">
    <a href="{{ route('santri.create') }}" class="btn btn-primary">
        Add santri
    </a>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                <td>No</td>
                <td>Name</td>
                <td>Phone</td>
                <td>City</td>
                <td>Date</td>
                <td>Address</td>
                <td>Action</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($santri as $row )
                    
                
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->city }}</td>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->address }}</td>
                    <td>
                        <a href="{{ route('santri.show', $row->id) }}" class="btn btn-primary">
                            Show
                        </a>

                        <a href="{{ route('santri.edit', $row->id) }}" class="btn btn-warning mt-2">
                            Edit
                        </a>

                        <form action="{{ route('santri.destroy', $row->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger m-1" type="submit"> DELETE </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection