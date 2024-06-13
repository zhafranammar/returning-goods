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
                <a href="{{ route('damaged.print', $reportDamagedProduct->id) }}" class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('report-damaged-products.update', $reportDamagedProduct->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="report_date">Report Date</label>
                        <input type="date" name="report_date" id="report_date" class="form-control" value="{{ $reportDamagedProduct->report_date}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="transaction_code">Purchase Receipt Number</label>
                        @if ($reportDamagedProduct->status_report=='Confirmed')
                            <input type="text" name="transaction_code" id="transaction_code" class="form-control" value="{{ $reportDamagedProduct->transaction_code}}" disabled>
                        @else
                            <input type="text" name="transaction_code" id="transaction_code" class="form-control">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="product_code">Product</label>
                        <select name="product_code" id="product_code" class="form-control" disabled>
                            @foreach ($products as $product)
                                <option value="{{ $product->code }}" {{ $product->code == $reportDamagedProduct->product_code ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplier_code">Supplier</label>
                        <select name="supplier_code" id="supplier_code" class="form-control" disabled>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->code }}" {{ $supplier->code == $reportDamagedProduct->supplier_code ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"  value="{{ $reportDamagedProduct->quantity}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="status_report">Status</label>
                        <input type="text" name="status_report" id="status_report" class="form-control"  value="{{ $reportDamagedProduct->status_report}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="damage_description">Description</label>
                        @if ($reportDamagedProduct->status_report=='Confirmed')
                            <textarea type="text" name="damage_description" id="damage_description" class="form-control" disabled>{{ $reportDamagedProduct->damage_description}}</textarea>
                        @else
                            <textarea name="damage_description" id="damage_description" class="form-control"></textarea>
                        @endif
                    </div>
                     @if ($reportDamagedProduct->status_report=='Confirmed')
                        @php
                            $reportReturn = \App\Models\ReportReturningProduct::where('report_damaged_id', $reportDamagedProduct->id)->first();
                        @endphp
                        <a href="{{ route('report-returning-products.show', $reportReturn->id) }}" class="btn btn-primary">Detail Report Return Product</a>
                     @else
                        <button type="submit" class="btn btn-primary">Confirm Report</button>
                    @endif
                </form>
                
            </div>
        </div>
    </div>
@endsection
