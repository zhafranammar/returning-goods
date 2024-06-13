@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Report Incoming Product') }}</h1>

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
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add Report</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('report-incoming-products.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product_code">Product</label>
                        <select name="product_code" id="product_code" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->code }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplier_code">Supplier</label>
                        <select name="supplier_code" id="supplier_code" class="form-control">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->code }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="received_date">Received Date</label>
                        <input type="date" name="received_date" id="received_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="quality_status">Quality Status</label>
                        <select name="quality_status" id="quality_status" class="form-control">
                            <option value="Good">Good</option>
                            <option value="Damaged">Damaged</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Report</button>
                </form>
            </div>
        </div>
    </div>
@endsection

