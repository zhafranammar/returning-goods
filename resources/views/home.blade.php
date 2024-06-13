@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

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

    <div class="row">
        <!-- Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Users') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Suppliers Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('Suppliers') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['suppliers'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Damaged Products Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{ __('Damaged Products') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['damaged_products'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Good Products Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('Good Products') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['good_products'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Card Section 1: Report Incoming Products -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Report Incoming Products</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="max-width: 100%;" src="{{ asset('img/svg/undraw_data_reports_706v.svg') }}" alt="">
                    </div>
                    <p>View and manage incoming product reports.</p>
                    <a href="{{ route('report-incoming-products.index') }}" class="btn btn-primary btn-sm">View Reports</a>
                </div>
            </div>
        </div>

        <!-- Card Section 2: Report Damaged Products -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Report Damaged Products</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="max-width: 100%;" src="{{ asset('img/svg/undraw_notify_re_65on.svg') }}" alt="">
                    </div>
                    <p>View and manage damaged product reports.</p>
                    <a href="{{ route('report-damaged-products.index') }}" class="btn btn-primary btn-sm">View Reports</a>
                </div>
            </div>
        </div>

        <!-- Card Section 3: Report Returning Products -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Report Returning Products</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="max-width: 100%;" src="{{ asset('img/svg/undraw_data_report_re_p4so.svg') }}" alt="">
                    </div>
                    <p>View reports for returning products.</p>
                    <a href="{{ route('report-returning-products.index') }}" class="btn btn-primary btn-sm">View Reports</a>
                </div>
            </div>
        </div>
    </div>
@endsection
