@extends('layouts.app')
@section('title', 'Branch')
@section('content')
    <div class="main-container">
        <div class="mt-4 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card p-0 mb-2">
                    <div class="col-md-6 pt-3 col-sm-12">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Branch
                                </li>
                            </ol>
                        </nav>
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

                @can('branch_create')
                    <form action="{{ $branch->id ? route('branch.update', $branch) : route('branch.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @isset($branch->id)
                            @method('PUT')
                        @endisset
                        <div class="pd-20 card mb-2">
                            <h5>Branch admin info</h5>
                            <section>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name *:</label>
                                            @if ($branch->id)
                                                <input type="text" name="name"
                                                    value="{{ old('name', $branch->user->name) }}" class="form-control" />
                                            @else
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control" />
                                            @endif
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email *:</label>
                                            @if ($branch->id)
                                                <input type="email" name="email"
                                                    value="{{ old('email', $branch->user->email) }}" class="form-control" />
                                            @else
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    class="form-control" />
                                            @endif
                                            @error('email')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender :</label>
                                            @if ($branch->id)
                                                <select class="custom-select2 form-control" name="gender"
                                                    style="width: 100%; height: 38px">
                                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}
                                                        {{ $branch->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}
                                                        {{ $branch->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}
                                                        {{ $branch->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            @else
                                                <select class="custom-select2 form-control" name="gender"
                                                    style="width: 100%; height: 38px">
                                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                                        Female
                                                    </option>
                                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>
                                                        Other</option>
                                                </select>
                                            @endif
                                            @error('gender')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>DOB :</label>
                                            @if ($branch->id)
                                                <input type="text" name="dob"
                                                    value="{{ old('dob', $branch->user->dob) }}" id="nepali-datepicker"
                                                    class="form-control" placeholder="Nepali YYYY-MM-DD" />
                                            @else
                                                <input type="text" name="dob" value="{{ old('dob') }}"
                                                    id="nepali-datepicker" class="form-control"
                                                    placeholder="Nepali YYYY-MM-DD" />
                                            @endif
                                            @error('dob')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address :</label>
                                            @if ($branch->id)
                                                <input type="text" name="address"
                                                    value="{{ old('address', $branch->user->address) }}" class="form-control">
                                            @else
                                                <input type="text" name="address" value="{{ old('address') }}"
                                                    class="form-control">
                                            @endif
                                            @error('address')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone :</label>
                                            @if ($branch->id)
                                                <input type="number" value="{{ old('phone', $branch->user->phone) }}"
                                                    class="form-control date-picker"name="phone" />
                                            @else
                                                <input type="number" value="{{ old('phone') }}"
                                                    class="form-control date-picker"name="phone" />
                                            @endif
                                            @error('phone')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Image :</label>
                                            <input type="file" class="form-control" name="image" />
                                            @error('image')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password *:</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="**********" {{ $branch->id ? 'readonly' : '' }} />
                                            @error('password')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Conform Password *:</label>
                                            <input type="password" name="password_confirmation"
                                                {{ $branch->id ? 'readonly' : '' }} class="form-control"
                                                placeholder="**********" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                            </section>
                        </div>
                        <div class="pd-20 card mb-2">
                            <!-- Step 2 -->
                            <h5>Branch Info</h5>
                            <section>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Branch Name *:</label>
                                            <input type="text" name="branch_name" {{ $branch->id ? 'readonly' : '' }}
                                                value="{{ old('branch_name', $branch->branch_name) }}"
                                                class="form-control" />
                                            @error('branch_name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Address :</label>
                                            <input type="text" name="address"
                                                value="{{ old('address', $branch->address) }}" class="form-control" />
                                            @error('address')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Phone :</label>
                                            <input type="number" name="branch_phone"
                                                value="{{ old('branch_phone', $branch->branch_phone) }}"
                                                class="form-control" />
                                            @error('branch_phone')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email :</label>
                                            <input type="email" name="branch_email"
                                                value="{{ old('branch_email', $branch->branch_email) }}"
                                                class="form-control" />
                                            @error('branch_email')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 3 -->

                            <!-- Step 4 -->

                        </div>
                        <div class="pd-20 card mb-3">
                            <div class="col-12 d-flex justify-content-end">
                                <input type="submit" value="{{ $branch->id ? 'Update' : 'Register' }}"
                                    class="btn btn-info text-white">
                            </div>
                        </div>
                    </form>
                @endcan





                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
