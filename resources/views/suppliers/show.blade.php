@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Supplier') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Supplier</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $supplier->code }}" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" disabled>
                </div>
                <div class="form-group">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $supplier->contact_person }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $supplier->email }}"disabled>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $supplier->address }}"disabled>
                    </div>
                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary">Edit Supplier</a>

            </div>
        </div>
    </div>
@endsection
