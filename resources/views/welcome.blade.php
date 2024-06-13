@extends('layouts.auth')

@section('main-content')
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-8 col-lg-6">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3 text-dark">
                                <div>
                                    <img src="https://yt3.googleusercontent.com/ytc/AIdro_kJnyLQmO6idb1CEsVS8qI2EuuUSNkxdWoW0SZpl10yR_c=s900-c-k-c0x00ffffff-no-rj" alt="Logo" class="logo" width="90">
                                </div>
                                <h1>Returning Goods</h1>
                                <p>Manage your returns efficiently and effectively with our system.</p>
                                <p>Streamline your workflow, reduce costs, and improve productivity.</p>
                                <a href="{{ route('login') }}" class="btn">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
