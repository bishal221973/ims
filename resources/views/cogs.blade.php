@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header" style="margin-bottom: 7px">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">

                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Opening Balance
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-5">
                        <div class="pd-20 card-box mb-2">
                            <form action="{{ $cogs->id ? route('cogs.update',$cogs) : route('cogs.store') }}" method="POST">
                                @csrf
                                @isset($cogs->id)
                                    @method('PUT')
                                @endisset
                                <div class="form-group">
                                    <label>Opening Balance :</label>

                                    <input type="number" name="opening_stock" value="{{ old('opening_stock',$cogs->opening_stock) }}" class="form-control" />
                                    @error('opening_stock')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group d-flex justify-content-end ">
                                    <input type="submit" value="{{$cogs->id ? "Update" : "Save"}}" class="btn btn-info ">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="card-box mb-30">
                            <div class="pd-20">
                            </div>
                            <div class="pb-20">
                                <table class="data-table table hover  nowrap">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th class="table-plus datatable-nosort">Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cogss as $cogs)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>RS. {{$cogs->opening_stock  }} /-</td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                            <a class="dropdown-item"
                                                                href="{{ route('cogs.edit', $cogs) }}"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                            <form action="{{ route('cogs.delete', $cogs) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Are you sure to delete ?')"
                                                                class="form-inline d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="dropdown-item"><i
                                                                        class="dw dw-delete-3"></i>
                                                                    Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                break;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
