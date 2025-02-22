@extends('layouts.default')

@push('title')
    <title>Division List</title>
@endpush

@push('styles')
    <style>
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper .btn {
            color: rgb(255, 255, 255);
            background-color: rgb(0, 98, 255);
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
    </style>
@endpush

@push('title_header')
    <h2 class="text-center my-2">Division List</h2>
@endpush

@section('content')
    {{-- Just change content here --}}
    @if ($failures = Session::get('failures'))
        <div class="alert alert-danger" role="alert">
            <div class="row form-group" style="margin-left:20px;">
                <ul>
                    @foreach ($failures as $failure)
                        <li>
                            {{ 'Dòng: '. $failure->row().$failure->errors()[0] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body mt-5">
                        {{ $divisions->links('utils.custom-pagination') }}
                        <table class="users table table-bordered table-hover">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col" style="width:4%;">ID</th>
                                    <th scope="col">Division Name</th>
                                    <th scope="col" style="width:25%;">Division Note</th>
                                    <th scope="col">Division Leader</th>
                                    <th scope="col">Floor Number</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Updated Date</th>
                                    <th scope="col">Deleted Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($divisions as $division)
                                    <tr>
                                        <th scope="row">{{ $division->id }}</th>
                                        <td>{{ $division->name }}</td>
                                        <td>{!! nl2br(e($division->note))!!}</td>
                                        <td>{{
                                        App\Models\Division::divisionLeaderName($division->division_leader_id)
                                        }}</td>
                                        <td>{{ $division->division_floor_num }}</td>
                                        <td>{{ $division->created_date ?
                                            date('d/m/Y', strtotime($division->created_date)) : ''
                                        }}</td>
                                        <td>{{ $division->updated_date ?
                                            date('d/m/Y', strtotime($division->updated_date)) : ''
                                        }}</td>
                                        <td>{{ $division->deleted_date ?
                                            date('d/m/Y', strtotime($division->deleted_date)) : ''
                                        }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            No Record
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <!-- End Bordered Table -->
                        {{-- Import CSV --}}
                        <form id="form-csv" action="{{ route('division.import') }}"
                        method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="upload-btn-wrapper float-left mr-3">
                                <button id="btn-import-csv" class="btn btn-primary" {{ $partialAccess ? 'disabled' : '' }}>
                                    Import CSV</button>
                                <input id="file_csv" type="file" name="file_csv"
                                onchange="javascript:this.form.submit();"
                                data-label= "csv" />
                            </div>
                        </form>
                </div>

            </div>

        </div>
    </div>
@stop
