@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Report') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-4">
        <!-- Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Detail Report</h6>
                <a href="{{ route('returning.print', $reportReturningProduct->id) }}" class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="product_code">Product</label>
                    <select name="product_code" id="product_code" class="form-control" disabled>
                        @foreach ($products as $product)
                            <option value="{{ $product->code }}" {{ $product->code == $reportReturningProduct->product_code ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier_code">Supplier</label>
                    <select name="supplier_code" id="supplier_code" class="form-control" disabled>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->code }}" {{ $supplier->code == $reportReturningProduct->supplier_code ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="confirm_date">Confimation Date</label>
                    <input type="date" name="confirm_date" id="confirm_date" class="form-control" value="{{ $reportReturningProduct->confirm_date}}" disabled>
                </div>
                <div class="form-group">
                    <label for="return_date">Pickup Date</label>
                    <input type="date" name="return_date" id="return_date" class="form-control" value="{{ $reportReturningProduct->return_date}}" disabled>
                </div>
                <div class="form-group">
                    <label for="finished_date">Finish Date</label>
                    <input type="date" name="finished_date" id="finished_date" class="form-control" value="{{ $reportReturningProduct->finished_date}}" disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control"  value="{{ $reportReturningProduct->quantity}}" disabled>
                </div>
                <div class="form-group">
                    <label for="status_return">Status</label>
                    <input type="text" name="status_return" id="status_return" class="form-control"  value="{{ $reportReturningProduct->status_return}}" disabled>
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" class="form-control" value="{{ $reportReturningProduct->notes}}"" disabled></textarea>
                </div>
                @if ($reportReturningProduct->status_return == 'Wait for Pickup')
                    <button id="pickup-btn" class="btn btn-primary">Pick Up</button>
                @elseif ($reportReturningProduct->status_return == 'Delivery')
                    <button id="finish-btn" class="btn btn-primary">Finish Delivery</button>
                @endif
            </div>
        </div>
    </div>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pickup-btn').on('click', function() {
                $.ajax({
                    url: '{{ route("update.status") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: '{{ $reportReturningProduct->id }}',
                        status: 'Delivery',
                        date_field: 'return_date'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#status_return').val('Delivery');
                            $('#return_date').val(response.date);
                            $('#pickup-btn').hide();
                            location.reload(); // Reload to update the view
                        }
                    }
                });
            });

            $('#finish-btn').on('click', function() {
                $.ajax({
                    url: '{{ route("update.status") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: '{{ $reportReturningProduct->id }}',
                        status: 'Finished',
                        date_field: 'finished_date'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#status_return').val('Finished');
                            $('#finished_date').val(response.date);
                            $('#finish-btn').hide();
                            location.reload(); // Reload to update the view
                        }
                    }
                });
            });
        });
    </script>
@endsection
