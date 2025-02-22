@extends('layouts.default')

@push('title')
    <title>User Edit</title>
@endpush

@push('title_header')
    <h2 class="text-center my-2">User Edit</h2>
@endpush

@section('content')
{{-- Just change content here --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body mt-4">
                <form id="user-edit" method="post" action="{{ route('user.update',$user->id) }}">
                    @csrf
                    @method('put')
                    <div class="row">
                        {{-- row 1 --}}
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="ID" name="id" placeholder="ID" :disabled="true"
                             :value="$user->id" />
                        </div>
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="User Name" name="name" placeholder="User Name"
                             :value="$user->name"
                                :disabled="$partialAccess"
                             />
                        </div>
                        {{-- row 2 --}}
                        <div class="col-md-6 col-lg-6 my-3">
                            <input type="hidden" id="original-email" name="original_email" value="{{ $user->email }}">
                            <x-inputs.text label="Email" name="email" placeholder="Email"
                             :value="$user->email"
                             :disabled="$partialAccess"
                             />
                        </div>
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.label-select label="Division" name="division_id"
                             :options="$divisions" :value="$user->division_id"
                             :disabled="$partialAccess"
                             />
                        </div>
                        {{-- row 3 --}}
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="Entered Date" name="entered_date" placeholder="Entered Date"
                            :value="date('Y/m/d', strtotime($user->entered_date))"
                            :disabled="$partialAccess"
                             />
                        </div>
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.label-select label="Position" name="position_id"
                             :options="UserConstant::ROLE" :value="$user->position_id"
                             :disabled="$partialAccess"
                             />
                        </div>
                        {{-- row 4 --}}
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="Password" name="password" placeholder="Password"
                             type="password" />
                        </div>
                        <div class="col-md-6 col-lg-6 my-3">
                            <x-inputs.text label="Password Confirmation" name="password_confirmation"
                             placeholder="Password Confirmation" type="password" />
                        </div>

                        <div class="col-md-12 col-lg-12 my-3" role="group" aria-label="Button group">
                            <button type="submit" class="btn btn-success d-none" value="Register">Register</button>
                            <button type="submit" class="btn btn-primary mr-2 " value="Update" {{ $partialAccess ? 'disabled' : '' }}>Update</button>
                            <button id="delete-btn" type="button" class="btn btn-danger mx-2"
                             value="Delete" {{ $partialAccess ? 'disabled' : '' }}>Delete</button>
                            <a type="button" href="{{ route('user.index') }}" class="btn btn-secondary" {{ $partialAccess ? 'disabled' : '' }}>Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@push('javascript')
    <script>var url_delete_user = " {{ route('user.destroy',$user->id) }} ";</script>
@endpush
