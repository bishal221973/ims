@extends('layouts.app')
@section('title', 'Role')
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
                                        Role
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

                @can('role_create')
                    <form action="{{ $role->id ? route('role.update', $role) : route('role.store') }}" method="POST">
                        @csrf
                        @isset($role->id)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="pd-20 card mb-2">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label>Role Name *:</label>

                                                <input type="text" class="form-control"
                                                    value="{{ old('role', $role->name) }}" name="role" id="">
                                                @error('role')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="pd-20 card">
                                    {{-- <div class="row mb-5">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input " type="checkbox" value="" id="grantAll">
                                        <label class="form-check-label" for="grantAll">
                                            Grant all permissions
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                                    <div class="row">

                                        @foreach ($permissions as $key => $permission)
                                            @php
                                                $selected = false;
                                            @endphp
                                            {{-- {{ $permission }} --}}
                                            @foreach ($role->permissions as $item)
                                                {{-- {{ $item }} --}}
                                                @php
                                                    if ($permission->id == $item->id) {
                                                        $selected = true;
                                                    }
                                                @endphp
                                            @endforeach



                                            <div class="col-xl-3 mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input permissionFields" name="premissions[]"
                                                        type="checkbox" value="{{ $permission->name }}"
                                                        id="{{ $permission->id }}" {{ $selected ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="pd-20 card mt-3">
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" value="{{ $role->id ? 'Update' : 'Save' }}" class="btn btn-info">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endcan


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
