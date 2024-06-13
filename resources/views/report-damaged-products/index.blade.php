@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Report Incoming Product') }}</h1>
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
                <th>Report Date</th>
                <th>Quantity</th>
                <th>Status Report</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->product->name }}</td>
                    <td>{{ $report->supplier->name }}</td>
                    <td>{{ $report->report_date }}</td>
                    <td>{{ $report->quantity }}</td>
                    <td>{{ $report->status_report }}</td>
                    <td>{{ $report->damage_description }}</td>
                    <td>
                        <a href="{{ route('report-damaged-products.show', $report->id) }}" class="btn btn-success">Detail</a>
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

