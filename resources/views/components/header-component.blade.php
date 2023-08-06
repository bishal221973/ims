@php
    $myOrg = App\Models\Organization::select('id', 'logo', 'organization_name')
        ->where('status', 1)
        ->first();
    $activeFiscalYear = App\Models\FiscalYear::select('id', 'name')
        ->where('organization_id', orgId())
        ->where('status', 1)
        ->first();
@endphp
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Search Here" />
                    <div class="dropdown">
                        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                            <i class="ion-arrow-down-c"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text" />
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="header-right    ">
        @role('super-admin')
            <div class="user-info-dropdown">
                <div class="dropdown h-100 d-flex align-items-center">
                    <a class="dropdown-toggle h-100 d-flex align-items-center" href="#" role="button"
                        data-toggle="dropdown">
                        <span class="user-name">{{ $myOrg ? $myOrg->organization_name : 'Organization' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        @foreach (App\Models\Organization::select('id', 'organization_name')->latest()->get() as $item)
                            <a class="dropdown-item" href="{{ route('organization.active', $item) }}">
                                {{ $item->organization_name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div style="width: 40px"></div>
        @endrole
        <div class="user-info-dropdown">
            <div class="dropdown h-100 d-flex align-items-center">
                <a class="dropdown-toggle h-100 d-flex align-items-center" href="#" role="button"
                    data-toggle="dropdown">
                    <span class="user-name">{{ $activeFiscalYear ? $activeFiscalYear->name : 'Fiscal Year' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    @foreach (App\Models\FiscalYear::select('id', 'name')->where('organization_id', orgId())->latest()->get() as $item)
                        <a class="dropdown-item" href="{{ route('fiscalyear.active', $item->id) }}">
                            {{ $item->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div style="width: 40px"></div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{ asset('vendors/images/photo1.jpg') }}" alt="" />
                    </span>
                    <span class="font-weight-bold user-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                        <i class="dw dw-logout"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
