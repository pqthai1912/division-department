@extends('layouts.default')

@push('title')
    <title>User List</title>
@endpush

@push('title_header')
    <h2 class="text-center my-2">User List</h2>
@endpush

@section('content')
    {{-- Just change content here --}}
    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <form id="search-user" method="post" action="{{ route('user.search') }}">
                        @csrf
                        <div class="form-group mt-5 mb-3">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 py-3">
                                    <x-inputs.text label="User Name" name="name"
                                     placeholder="User Name"
                                     :value=" Session::get('users')['name'] ?? '' "  />
                                </div>
                                <div class="d-none d-sm-none d-md-block col-lg-4 py-3"></div>
                                <div class="d-none d-sm-none d-md-block col-lg-4 py-3"></div>

                                <div class="col-md-6 col-lg-4 py-3">
                                    <x-inputs.text label="Entered Date From" name="entered_date_from"
                                     placeholder="Entered Date From"
                                     :value=" isset(Session::get('users')['entered_date_from']) &&
                                      Session::get('users')['entered_date_from'] !== '' ?
                                      date('Y/m/d', strtotime(Session::get('users')['entered_date_from'])) : '' " />
                                </div>
                                <div class="col-md-6 col-lg-4 py-3">
                                    <x-inputs.text label="Entered Date To" name="entered_date_to"
                                     placeholder="Entered Date To"
                                     :value=" isset(Session::get('users')['entered_date_to']) &&
                                      Session::get('users')['entered_date_to'] !== '' ?
                                      date('Y/m/d', strtotime(Session::get('users')['entered_date_to'])) : '' "
                                     />
                                </div>
                                <div class="d-sm-none d-md-block col-lg-4 py-3"></div>

                                <div class="col-md-6 col-lg-4 py-3"></div>
                                <div class="col-md-6 col-lg-4 py-3">
                                    <button id="btn-submit" type="submit" name="action"
                                        class="btn btn-primary custom-btn float-right" value="search"
                                        style="float:right;margin-left:15px;">Search</button>
                                    <button id="btn-reset" type="submit"  name="action"
                                        class="btn btn-danger custom-btn"
                                        style="float:right;" value="clear"
                                        formnovalidate
                                        >Clear</button>
                                </div>
                        </div>
                    </form>
                    {{-- To begin, not show table --}}
                    @if (isset($users))
                        {{ $users->links('utils.custom-pagination') }}
                        <table class="users table table-bordered table-hover">
                            <thead>
                                <tr class="table-primary">
                                    <th class="row-1 row-name" scope="col">User Name</th>
                                    <th class="row-2 row-email" scope="col">Email</th>
                                    <th class="row-3 row-division" scope="col">Division Name</th>
                                    <th class="row-4 row-date" scope="col">Entered Date</th>
                                    <th class="row-5 row-position" scope="col">Position</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        @if (auth()->user()->position_id == UserConstant::GENERAL_DIRECTOR[0])
                                            <th scope="row">
                                                <a href="{{route('user.edit', $user->id) }}">
                                                    {{ $user->name }}
                                                </a>
                                            </th>
                                        @else
                                            <th scope="row">{{ $user->name }}</th>
                                        @endif
                                        <td>{{ $user->email }}</td>
                                        <td>{{ App\Models\User::divisionName($user->division_id) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($user->entered_date)) }}</td>
                                        <td>{{ App\Models\User::position($user->position_id) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            {{ CommonConstant::NO_RECORD }}
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <!-- End Bordered Table -->
                        {{-- Just GENERAL_DIRECTOR --}}
                        @if (auth()->user()->position_id == UserConstant::GENERAL_DIRECTOR[0])
                            <div class="form-group">
                                <a href="{{ route('user.create') }}">
                                    <button class="btn btn-success custom-btn">
                                        Add New
                                    </button>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                {{-- check users have a least 1 record --}}
                            @if ($users->count() > 0)
                                <button id="csv" class="btn btn-secondary custom-btn">
                                    <a href="{{ url('/export') }}" class="text-white">
                                        Output CSV

                                    </a>
                                </button>
                            @endif

                            </div>
                        @endif
                    @else
                        {{-- Just GENERAL_DIRECTOR --}}
                        @if (auth()->user()->position_id == UserConstant::GENERAL_DIRECTOR[0])
                            <div class="form-group">
                                <a href="{{ route('user.create') }}">
                                    <button class="btn btn-success custom-btn">
                                        Add New
                                    </button>
                                </a>
                            </div>
                        @endif
                    @endif



                </div>

            </div>



        </div>
    </div>

@stop
