@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Attendance
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p p-3" style="height: 60vh;overflow:scroll">
                            <div class="profile-timeline">
                                <div class="timeline-month">
                                    <h5>August, 2020</h5>
                                </div>
                                <div class="profile-timeline-list">
                                    <ul>
                                        <li>
                                            <div class="date">12 Aug</div>
                                            <div class="task-name">
                                                <i class="ion-android-alarm-clock"></i> Task
                                                Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                        <li>
                                            <div class="date">10 Aug</div>
                                            <div class="task-name">
                                                <i class="ion-ios-chatboxes"></i> Task Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                        <li>
                                            <div class="date">10 Aug</div>
                                            <div class="task-name">
                                                <i class="ion-ios-clock"></i> Event Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                        <li>
                                            <div class="date">10 Aug</div>
                                            <div class="task-name">
                                                <i class="ion-ios-clock"></i> Event Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="timeline-month">
                                    <h5>July, 2020</h5>
                                </div>
                                <div class="profile-timeline-list">
                                    <ul>
                                        <li>
                                            <div class="date">12 July</div>
                                            <div class="task-name">
                                                <i class="ion-android-alarm-clock"></i> Task
                                                Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                        <li>
                                            <div class="date">10 July</div>
                                            <div class="task-name">
                                                <i class="ion-ios-chatboxes"></i> Task Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="timeline-month">
                                    <h5>June, 2020</h5>
                                </div>
                                <div class="profile-timeline-list">
                                    <ul>
                                        <li>
                                            <div class="date">12 June</div>
                                            <div class="task-name">
                                                <i class="ion-android-alarm-clock"></i> Task
                                                Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                        <li>
                                            <div class="date">10 June</div>
                                            <div class="task-name">
                                                <i class="ion-ios-chatboxes"></i> Task Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                        <li>
                                            <div class="date">10 June</div>
                                            <div class="task-name">
                                                <i class="ion-ios-clock"></i> Event Added
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit.
                                            </p>
                                            <div class="task-time">09:30 am</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box height-100-p col-12 p-3">

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
