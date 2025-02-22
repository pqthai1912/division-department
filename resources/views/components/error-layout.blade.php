@extends('layouts.auth.default-auth')

@push('title')
    <title>Access Denied</title>
@endpush

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="pt-4 pb-2"></div>

                {{-- Just change content here --}}
                <div class="row">
                    {{ $slot }}
                </div>

            </div>
        </div>
    </div>
@stop