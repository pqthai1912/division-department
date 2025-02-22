@extends('layouts.default')

@push('title')
    <title>User Add</title>
@endpush

@push('title_header')
    <h2 class="text-center my-2">User Add</h2>
@endpush

@section('content')
{{-- Just change content here --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body mt-4">
                <form id="user-add" method="post" action="{{ route('user.store') }}">
                    @csrf
                    <div class="row">
                        {{-- row 1 --}}
                        <div class="col-md-6 col-lg-6 my-3">
                            <div class="input-group">
                                <label class="input-group-text">ID</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="User Name" name="name"
                             placeholder="User Name" value="{{ old('name') }}" :disabled="$partialAccess"/>
                        </div>
                        {{-- row 2 --}}
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="Email" name="email"
                             placeholder="Email" value="{{ old('email') }}" :disabled="$partialAccess"/>
                        </div>
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.label-select label="Division" name="division_id"
                             :options="$divisions" value="{{ old('division_id') }}" :disabled="$partialAccess"/>
                        </div>
                        {{-- row 3 --}}
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="Entered Date" name="entered_date"
                             placeholder="Entered Date" value="{{ old('entered_date') }}" :disabled="$partialAccess"/>
                        </div>
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.label-select label="Position" name="position_id"
                             :options="UserConstant::ROLE" value="{{ old('position_id') }}" :disabled="$partialAccess"/>
                        </div>
                        {{-- row 4 --}}
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="Password" name="password" placeholder="Password"
                             type="password" value="{{ old('password') }}" :disabled="$partialAccess"/>
                        </div>
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="Password Confirmation" name="password_confirmation"
                             placeholder="Password Confirmation" type="password"
                             value="{{ old('password_confirmation') }}" :disabled="$partialAccess"/>
                        </div>

                        <div class="col-md-12 col-lg-12 my-3" role="group" aria-label="Button group">
                            <button type="submit" class="btn btn-success mr-2" value="Register" {{ $partialAccess ? 'disabled' : '' }}>Register</button>
                            <button type="submit" class="btn btn-primary mx-2 d-none" value="Update">Update</button>
                            <button type="button" class="btn btn-danger d-none" value="Delete" {{ $partialAccess ? 'disabled' : '' }}>Delete</button>
                            <a type="button" href="{{ route('user.index') }}" class="btn btn-secondary mx-2" {{ $partialAccess ? 'disabled' : '' }}>Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
