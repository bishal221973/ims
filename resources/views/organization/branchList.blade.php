@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Organization
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <a href="{{ route('organization.create') }}" class="btn btn-info">New Organization</a>
                        </div>
                    </div>
                </div>

                <!-- multiple select row Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                    </div>
                    <div class="pb-20">
                        {{-- multiple-select-row --}}
                        <table class="data-table table hover  nowrap">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th class="table-plus datatable-nosort">Name</th>
                                    <th>Organization</th>
                                    <th>Branch</th>

                                    <th>Opening Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branchs as $branch)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="table-plus">
                                            {{ $branch->user->name }} <br>
                                            {{ $branch->user->email }} <br>
                                            {{ $branch->user->gender ? $branch->user->gender : '' }} <br>
                                        </td>
                                        <td>
                                            {{ $branch->organization->organization_name }} <br>
                                            {{ $branch->organization->organization_phone ? $branch->organization->organization_phone : '' }}
                                            <br>
                                            {{ $branch->organization->organization_email ? $branch->organization->organization_email : '' }}
                                        </td>
                                        <td>{{$branch->branch_name}}</td>
                                        <td>Not Defined</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('branch.edit', $branch) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <form action="{{ route('organization.delete', $branch) }}"
                                                        method="post" onsubmit="return confirm('Are you sure to delete ?')"
                                                        class="form-inline d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="dropdown-item {{$branch->branch_name == "Main Branch" ? "d-none" : ""}}"><i
                                                                class="dw dw-delete-3"></i>
                                                            Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- multiple select row Datatable End -->

            </div>

        </div>
    </div>
@endsection
