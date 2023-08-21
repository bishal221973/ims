@extends('layouts.app')
@section('title', 'Assign-Project')
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
                                        Assign-Project
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
                    @can('assign_project_create')
                        <div class="col-xl-5">
                            <div class="pd-20 card mb-2">
                                <form
                                    action="{{ $assignProject->id ? route('unit.update', $assignProject) : route('assign-project.store') }}"
                                    method="POST">
                                    @csrf
                                    @isset($assignProject->id)
                                        @method('PUT')
                                    @endisset
                                    <div class="form-group">
                                        <label>Project *:</label>

                                        <select class="custom-select2 form-control" required name="project_id"
                                            style="width: 100%; height: 38px">
                                            <option value="" selected disabled>Please select a project</option>

                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                    {{ $project->id == $assignProject->project_id ? 'selected' : '' }}>
                                                    {{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="name" value="{{ old('name', $assignProject->name) }}"
                                        class="form-control" required /> --}}
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Employee *:</label>

                                        <select name="employee_id[]" class="custom-select2 form-control"
                                            style="width: 100%; height: 38px" multiple>
                                            @php
                                                $i = 0;
                                                $j = $assignProject->employee->count();

                                            @endphp
                                            @foreach ($employees as $employees)
                                                @if ($assignProject->id || $i < $j - 1)
                                                    @if ($j > 0)
                                                        <option value="{{ $employees->id }}"
                                                            {{ $employees->id == $assignProject->employee[$i]->id ? 'selected' : '' }}>
                                                            {{ $employees->name }}
                                                        </option>

                                                        @php
                                                            if ($employees->id == $assignProject->employee[$i]->id && $i < $j - 1) {
                                                                $i++;
                                                            }
                                                        @endphp
                                                    @else
                                                        <option value="{{ $employees->id }}">
                                                            {{ $employees->name }}
                                                        </option>
                                                    @endif
                                                @else
                                                    <option value="{{ $employees->id }}">
                                                        {{ $employees->user->name }}
                                                    </option>
                                                @endif
                                                @php
                                                @endphp
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="name" value="{{ old('name', $assignProject->name) }}"
                                        class="form-control" required /> --}}
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <hr>
                                    <div class="form-group d-flex justify-content-end">
                                        <input type="submit" value="{{ $assignProject->id ? 'Update' : 'Save' }}"
                                            class="btn btn-info">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan

                    @can('assign_project_read')
                        <div class="col-xl-7">
                            <div class="card mb-30">
                                <div class="pd-20">
                                </div>
                                <div class="pb-20">
                                    <table class="data-table table hover  nowrap">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Project</th>
                                                <th>Employee</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assignProjects as $assignProject)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $assignProject->project->name }}</td>
                                                    <td>
                                                        {{-- {{$assignProject->employee}} --}}
                                                        @foreach ($assignProject->employee as $item)
                                                            <span
                                                                class="badge bg-info text-white">{{ $item->employee->user->name }}</span>
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            @can('assign_project_edit')
                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                                    href="#" role="button" data-toggle="dropdown">
                                                                    <i class="dw dw-more"></i>
                                                                </a>
                                                            @endcan
                                                            @can('assign_project_delete')
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('unit.edit', $assignProject) }}"><i
                                                                            class="dw dw-edit2"></i>
                                                                        Edit</a>
                                                                    <form action="{{ route('unit.delete', $assignProject->id) }}"
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
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>


                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
