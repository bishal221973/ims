@extends('layouts.app')
@section('title', 'Employee')
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
                                        Employee
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

                @can('employee_create')
                    <form action="{{ $employee->id ? route('employee.update', $employee) : route('employee.store') }}"
                        method="POST">
                        @csrf
                        @isset($employee->id)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="pd-20 card mb-2">
                                    {{-- @isset($unit->id)
                                    @method('PUT')
                                @endisset --}}
                                    <h5 class="mb-3">Personal details</h5>
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Full Name *:</label>

                                                @if ($employee->id)
                                                    <input type="text" name="name"
                                                        value="{{ old('name', $employee->user->name) }}" class="form-control"
                                                        required />
                                                @else
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control" required />
                                                @endif
                                                @error('name')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Email *:</label>

                                                @if ($employee->id)
                                                    <input type="email" name="email"
                                                        value="{{ old('email', $employee->user->email) }}" class="form-control"
                                                        required />
                                                @else
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        class="form-control" required />
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
                                                @if ($employee->id)
                                                    <select class="custom-select2 form-control" name="gender"
                                                        style="width: 100%; height: 38px">
                                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}
                                                            {{ $employee->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                        <option value="Female"
                                                            {{ old('gender') == 'Female' ? 'selected' : '' }}
                                                            {{ $employee->gender == 'Female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}
                                                            {{ $employee->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                @else
                                                    <select class="custom-select2 form-control" name="gender"
                                                        style="width: 100%; height: 38px">
                                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                                            Male
                                                        </option>
                                                        <option value="Female"
                                                            {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                                            Female
                                                        </option>
                                                        <option value="Other"
                                                            {{ old('gender') == 'Other' ? 'selected' : '' }}>
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
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>DOB *:</label>

                                                @if ($employee->id)
                                                    <input type="text" name="dob"
                                                        value="{{ old('dob', $employee->user->dob) }}" id="nepali-datepicker"
                                                        class="form-control" required />
                                                @else
                                                    <input type="text" name="dob" value="{{ old('dob') }}"
                                                        id="nepali-datepicker" class="form-control" required />
                                                @endif
                                                @error('dob')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Country Name :</label>
                                                <select class="custom-select2 form-control" name="country_id"
                                                    style="width: 100%; height: 38px" id="countryId">
                                                    <option value="" selected disabled>Please select a country</option>

                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country_id') == $country->id ? 'selected' : '' }}
                                                            {{ $country->id == $employee->country_id ? 'selected' : '' }}>
                                                            {{ $country->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('country_id')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Province :</label>
                                                <select class="custom-select2 form-control" id="ProvinceId" name="province_id"
                                                    style="width: 100%; height: 38px">
                                                    <option value="" selected disabled>Please select a province</option>

                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}"
                                                            {{ old('province_id') == $province->id ? 'selected' : '' }}
                                                            {{ $province->id == $employee->province_id ? 'selected' : '' }}>
                                                            {{ $province->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('country_id')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Address *:</label>

                                                @if ($employee->id)
                                                    <input type="text" name="address"
                                                        value="{{ old('address', $employee->user->address) }}"
                                                        class="form-control" required />
                                                @else
                                                    <input type="text" name="address" value="{{ old('address') }}"
                                                        class="form-control" required />
                                                @endif
                                                @error('address')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Phone *:</label>

                                                @if ($employee->id)
                                                    <input type="text" name="phone"
                                                        value="{{ old('phone', $employee->user->phone) }}"
                                                        class="form-control" required />
                                                @else
                                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                                        class="form-control" required />
                                                @endif
                                                @error('phone')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Image *:</label>

                                                <input type="file" name="image" value="{{ old('image') }}"
                                                    class="form-control" />
                                                @error('image')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    {{-- <div class="form-group d-flex justify-content-end">
                                    <input type="submit" value="Save" class="btn btn-info">
                                </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="pd-20 card mb-2">
                                    {{-- @isset($unit->id)
                                    @method('PUT')
                                @endisset --}}
                                    <h5 class="mb-3">Organizational details</h5>

                                    <div class="row">
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Branch Name *:</label>

                                                <select class="custom-select2 form-control" required name="branch_id"
                                                    style="width: 100%; height: 38px">
                                                    <option value="" selected disabled>Please select a branch</option>
                                                    @if ($employee->id)
                                                        @foreach ($branches as $branch)
                                                            <option value="{{ $branch->id }}"
                                                                {{ $branch->id == $employee->branch_id ? 'selected' : '' }}>
                                                                {{ $branch->branch_name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($branches as $branch)
                                                            <option value="{{ $branch->id }}"
                                                                {{ $branch->branch_name == 'Main Branch' ? 'selected' : '' }}>
                                                                {{ $branch->branch_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                                @error('branch_id')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Salary *:</label>

                                                <input type="text" name="salary"
                                                    value="{{ old('salary', $employee->salary) }}" class="form-control"
                                                    required />
                                                @error('salary')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Joining Date *:</label>

                                                <input type="text" name="joining_date"
                                                    value="{{ old('joining_date', $employee->joining_date) }}"
                                                    class="form-control" required id="nepali-datepicker1" />
                                                @error('joining_date')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label>Role *:</label>

                                                @if ($employee->id)
                                                    <select name="role[]" class="custom-select2 form-control"
                                                        style="width: 100%; height: 38px" multiple>
                                                        <option value="" disabled>Please select</option>
                                                        @php
                                                            $i = 0;
                                                            $j = $employee->user->roles->count();

                                                        @endphp
                                                        @foreach ($roles as $role)
                                                            @if ($employee->id || $i < $j - 1)
                                                                @if ($j > 0)
                                                                    <option value="{{ $role->id }}"
                                                                        {{ $role->id == $employee->user->roles[$i]->id ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>

                                                                    @php
                                                                        if ($role->id == $employee->user->roles[$i]->id && $i < $j - 1) {
                                                                            $i++;
                                                                        }
                                                                    @endphp
                                                                @else
                                                                    <option value="{{ $role->id }}">
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endif
                                                            @else
                                                                <option value="{{ $role->id }}">
                                                                    {{ $role->name }} </option>
                                                            @endif
                                                            @php
                                                            @endphp
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="role[]" class="custom-select2 form-control"
                                                        style="width: 100%; height: 38px" multiple>
                                                        <option value="" disabled>Please select</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @error('role')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="pd-20 card mb-2">
                                    {{-- @isset($unit->id)
                                @method('PUT')
                            @endisset --}}
                                    <h5 class="mb-3">Login Detail</h5>

                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Password *:</label>

                                                <input type="text" name="password" value="{{ old('password') }}"
                                                    class="form-control" required {{ $employee->id ? 'readonly' : '' }} />
                                                @error('password')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Confirm Password *:</label>

                                                <input type="text" name="" {{ $employee->id ? 'readonly' : '' }}
                                                    value="{{ old('email') }}" class="form-control" required />

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12"> --}}
                        <div class="pd-20 card mb-2 ">
                            <div class="d-flex col-12 justify-content-end">
                                <input type="submit" value="{{ $employee->id ? 'Update' : 'Save' }}"
                                    class="col-md-2  btn btn-info">
                            </div>
                        </div>
                        {{-- </div> --}}
                    </form>
                @endcan


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
