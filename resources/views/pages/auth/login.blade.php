@extends('layouts.auth.default-auth')

@push('title')
    <title>Login</title>
@endpush

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="pt-4 pb-2"></div>

                <form id="login-form" action="{{ route('post.login') }}" class="row g-3 needs-validation" method="POST">
                    @csrf
                    <x-alert/>
                    <div class="col-12">
                        <x-inputs.label-text label="Email" name="email" />
                    </div>


                    <div class="col-12">
                        <x-inputs.label-text label="Password" name="password"
                        type="password" />
                    </div>

                    <div class="col-12">
                        <x-button class="btn btn-primary w-50" value="Login" type="submit" />
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
