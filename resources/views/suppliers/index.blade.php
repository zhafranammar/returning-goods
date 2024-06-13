@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Suppliers') }}</h1>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Create New Supplier</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered" id="suppliers-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Contact Person</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->code }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->contact_person }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>
                        <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#suppliers-table').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": []
            }]
        });
    </script>
@endsection

