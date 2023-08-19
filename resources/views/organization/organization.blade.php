@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card p-0 mb-2">
                    <div class="col-md-6 pt-3 col-sm-12">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Organization
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

                <form
                    action="{{ $organization->id ? route('organization.update', $organization) : route('organization.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($organization->id)
                        @method('PUT')
                    @endisset
                    <div class="pd-20 card mb-2">
                        <h5>Admin Info</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Full Name *:</label>
                                        @if ($organization->id)
                                            <input type="text" name="name"
                                                value="{{ old('name', $organization->user->name) }}" class="form-control" />
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
                                        @if ($organization->id)
                                            <input type="email" name="email"
                                                value="{{ old('email', $organization->user->email) }}"
                                                class="form-control" />
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
                                        @if ($organization->id)
                                            <select class="custom-select2 form-control" name="gender"
                                                style="width: 100%; height: 38px">
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}
                                                    {{ $organization->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}
                                                    {{ $organization->gender == 'Female' ? 'selected' : '' }}>Female
                                                </option>
                                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}
                                                    {{ $organization->gender == 'Other' ? 'selected' : '' }}>Other</option>
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
                                        @if ($organization->id)
                                            <input type="text" name="dob"
                                                value="{{ old('dob', $organization->user->dob) }}" id="nepali-datepicker"
                                                class="form-control" placeholder="Nepali YYYY-MM-DD"/>
                                        @else
                                            <input type="text" name="dob" value="{{ old('dob') }}"
                                                id="nepali-datepicker" class="form-control" placeholder="Nepali YYYY-MM-DD" />
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
                                        @if ($organization->id)
                                            <input type="text" name="address"
                                                value="{{ old('address', $organization->user->address) }}"
                                                class="form-control">
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
                                        @if ($organization->id)
                                            <input type="number" value="{{ old('phone', $organization->user->phone) }}"
                                                class="form-control"name="phone" />
                                        @else
                                            <input type="number" value="{{ old('phone') }}"
                                                class="form-control"name="phone" />
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
                                            placeholder="**********" {{ $organization->id ? 'readonly' : '' }} />
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
                                            {{ $organization->id ? 'readonly' : '' }} class="form-control"
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
                        <h5>Organization Info</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name :</label>
                                        <input type="text" name="organization_name"
                                            value="{{ old('organization_name', $organization->organization_name) }}"
                                            class="form-control" />
                                        @error('organization_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Address :</label>
                                        <input type="text" name="organization_address"
                                            value="{{ old('organization_address', $organization->organization_address) }}"
                                            class="form-control" />
                                        @error('organization_address')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone :</label>
                                        <input type="number" name="organization_phone"
                                            value="{{ old('organization_phone', $organization->organization_phone) }}"
                                            class="form-control" />
                                        @error('organization_phone')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email :</label>
                                        <input type="email" name="organization_email"
                                            value="{{ old('organization_email', $organization->organization_email) }}"
                                            class="form-control" />
                                        @error('organization_email')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Vat Number :</label>
                                        <input type="number" name="vat_number"
                                            value="{{ old('vat_number', $organization->vat_number) }}"
                                            class="form-control" />
                                        @error('vat_number')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Logo :</label>
                                        <input type="file" name="logo" class="form-control" />
                                        @error('logo')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fav Icon :</label>
                                        <input type="file" name="fav_icon" class="form-control" />
                                        @error('fav_icon')
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
                            <input type="submit" value="{{ $organization->id ? 'Update' : 'Register' }}"
                                class="btn btn-success text-white my-bnt">
                        </div>
                    </div>
                </form>





                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
