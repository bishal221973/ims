@extends('layouts.app')
@section('title','Fiscal-Year')
@section('content')
    <div class="main-container">
        <div class="mt-4 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card p-0 px-3 mb-2">
                    <div class="row">
                        <div class="col-md-6 pt-3 col-sm-12">
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb p-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Fiscal Year
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                @if (Session::has('success'))
                @php
                    $msg = Session::get('success');
                @endphp

                @push('message')
                    <script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: '{{ $msg }}'
                        })
                    </script>
                @endpush
            @endif

            @if (Session::has('error'))
                @php
                    $msg = Session::get('error');
                @endphp

                @push('message')
                    <script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: '{{ $msg }}'
                        })
                    </script>
                @endpush
            @endif

                <div class="row">
                    <div class="col-xl-5">
                        <div class="pd-20 card mb-2">
                            <form
                                action="{{ $fiscalYear->id ? route('fiscalyear.update', $fiscalYear) : route('fiscalyear.store') }}"
                                method="POST">
                                @csrf
                                @isset($fiscalYear->id)
                                    @method('PUT')
                                @endisset
                                <div class="form-group">
                                    <label>Name :*</label>

                                    <input type="text" name="name" value="{{ old('name', $fiscalYear->name) }}"
                                        class="form-control" required />
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Opening Date :*</label>

                                    <input type="text" name="opening_date" id="nepali-datepicker"
                                        value="{{ old('opening_date', $fiscalYear->opening_date) }}" class="form-control"
                                        required placeholder="Nepali YYYY-MM-DD"/>
                                    @error('opening_date')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Closing Date :*</label>

                                    <input type="text" name="closeing_date" id="nepali-datepicker1"
                                        value="{{ old('closeing_date', $fiscalYear->closeing_date) }}"
                                        class="form-control" required placeholder="Nepali YYYY-MM-DD"/>
                                    @error('closeing_date')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <hr>

                                <div class="form-group d-flex justify-content-end">
                                    <input type="submit" value="{{ $fiscalYear->id ? 'Update' : 'Save' }}"
                                        class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="card mb-30">
                            <div class="pd-20">
                            </div>
                            <div class="pb-20">
                                <table class="data-table table hover  nowrap">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Opening Date</th>
                                            <th>Closeing Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fiscalYears as $fiscalYear)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $fiscalYear->name }}</td>
                                                <td>{{ $fiscalYear->opening_date }}</td>
                                                <td>{{ $fiscalYear->closeing_date }}</td>
                                                <td>{{ $fiscalYear->status == 0 ? 'Inactive' : 'Active' }}</td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                            <a class="dropdown-item"
                                                                href="{{ route('fiscalyear.edit', $fiscalYear) }}"><i
                                                                    class="dw dw-edit2"></i>
                                                                Edit</a>
                                                            <form
                                                                action="{{ route('fiscalyear.delete', $fiscalYear->id) }}"
                                                                method="post"
                                                                onsubmit="return confirm('Are you sure to delete ?')"
                                                                class="form-inline d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item"><i
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
                    </div>
                </div>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
