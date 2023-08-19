@extends('layouts.app')
@section('title','Verify-Mail')
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
                                    Verify-Mail
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>





                <div class="card mb-3">

                    <div class="card-body">
                        <label class="text-danger font-weight-bold text-uppercase">Warning : </label>
                        <label class="text-warning">Your email is not verified. Please verify your email before
                            continue.</label>
                        <form action="{{ route('emailverify.sendMail') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <label>Email :*</label>
                                <input type="email" name="email" value="{{ Auth()->user()->email }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn btn-info mt-3" value="Send">
                            </div>
                        </form>
                    </div>
                </div>

                @if (Session::has('error'))
                    @php
                        $msg = Session::get('error');
                    @endphp

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>WARNING : </strong> {{ $msg }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('success'))
                    @php
                        $msg = Session::get('success');
                    @endphp

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>SUCCESS : </strong>We sent a verification mail to your email. Please <a href="https://mail.google.com/" target="_blank" class="font-weight-bold"><u>open gmail</u></a> to verify your email.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif



                <!-- success Popup html End -->
            </div>

        </div>
    </div>
@endsection
