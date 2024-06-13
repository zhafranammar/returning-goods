@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Report Incoming Product') }}</h1>
    <a href="{{ route('report-incoming-products.create') }}" class="btn btn-primary mb-3">Create New Report</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered" id="report-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Supplier</th>
                <th>Confirmation Date</th>
                <th>Pickup Date</th>
                <th>Finished Date</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->product->name }}</td>
                    <td>{{ $report->supplier->name }}</td>
                    <td>{{ $report->confirm_date }}</td>
                    <td>{{ $report->return_date }}</td>
                    <td>{{ $report->finished_date }}</td>
                    <td>{{ $report->quantity }}</td>
                    <td>{{ $report->status_return }}</td>
                    <td>{{ $report->notes }}</td>
                    <td>
                        <a href="{{ route('report-returning-products.show', $report->id) }}" class="btn btn-success">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#report-table').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": []
            }]
        });
    </script>
@endsection

