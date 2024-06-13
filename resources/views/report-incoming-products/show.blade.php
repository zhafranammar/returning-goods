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
                <a href="{{ route('incoming.print', $reportIncomingProduct->id) }}" class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="product_code">Product</label>
                    <select name="product_code" id="product_code" class="form-control" disabled>
                        @foreach ($products as $product)
                            <option value="{{ $product->code }}" {{ $product->code == $reportIncomingProduct->product_code ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier_code">Supplier</label>
                    <select name="supplier_code" id="supplier_code" class="form-control" disabled>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->code }}" {{ $supplier->code == $reportIncomingProduct->supplier_code ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="received_date">Received Date</label>
                    <input type="date" name="received_date" id="received_date" class="form-control" value="{{ $reportIncomingProduct->received_date}}" disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control"  value="{{ $reportIncomingProduct->quantity}}" disabled>
                </div>
                <div class="form-group">
                    <label for="quality_status">Quality Status</label>
                    <input type="text" name="quality_status" id="quality_status" class="form-control"  value="{{ $reportIncomingProduct->quality_status}}" disabled>
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" class="form-control" value="{{ $reportIncomingProduct->notes}}"" disabled></textarea>
                </div>
                @php
                    $reportDamage = \App\Models\ReportDamagedProduct::where('report_incoming_id', $reportIncomingProduct->id)->first();
                    // dd($reportDamage);
                @endphp
                @if ($reportIncomingProduct->quality_status=='Good')
                    <a href="{{ route('report-incoming-products.index') }}" class="btn btn-primary">Back</a>
                @else
                    <a href="{{ route('report-damaged-products.show', $reportDamage->id) }}" class="btn btn-primary">Detail Report Damaged Product</a>
                @endif

            </div>
        </div>
    </div>
@endsection
