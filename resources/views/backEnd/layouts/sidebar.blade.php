<?php
$route = Request::route()->getName();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset($settingArr['logo'])}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>{{$settingArr['company_name']??''}}</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset(Auth::user()->profile_photo)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('lang.DASHBOARD')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item {{$route == 'user.index' || $route == 'user.create' || $route == 'role.index' ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'user.index' || $route == 'user.create' || $route == 'role.index' ? "active" :''}}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            @lang('lang.USER_MANAGEMENT')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link {{$route == 'user.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.USER_LIST')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('role.index')}}" class="nav-link {{$route == 'role.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.USER_ROLE')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{$route == 'visaEntry.index' || $route == 'visaEntry.create' || $route == 'visaEntry.view' || $route == 'visaEntry.edit'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'visaEntry.index' || $route == 'visaEntry.create' || $route == 'visaEntry.view' || $route == 'visaEntry.edit' ? "active" :''}}">
                        <i class="nav-icon fab fa-cc-visa"></i>
                        <p>
                            @lang('lang.VISA')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('visaEntry.index')}}" class="nav-link {{$route == 'visaEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.VISA_LIST')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('visaEntry.create')}}" class="nav-link {{$route == 'visaEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.VISA_ENTRY')</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item {{$route == 'passportEntry.index' || $route == 'passportEntry.create' || $route == 'passportEntry.view' || $route == 'passportEntry.edit'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'passportEntry.index' || $route == 'passportEntry.create' || $route == 'passportEntry.view' || $route == 'passportEntry.edit' ? "active" :''}}">
                        <i class="nav-icon fas fa-passport"></i>
                        <p>
                            @lang('lang.PASSPORT')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('passportEntry.index')}}" class="nav-link {{$route == 'passportEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PASSPORT_LIST')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('passportEntry.create')}}" class="nav-link {{$route == 'passportEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PASSPORT_ENTRY')</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item {{$route == 'medicalEntry.index' || $route == 'medicalEntry.create' || $route == 'medicalEntry.view' || $route == 'medicalEntry.edit'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'medicalEntry.index' || $route == 'medicalEntry.create' || $route == 'medicalEntry.view' || $route == 'medicalEntry.edit' ? "active" :''}}">
                        <i class="nav-icon fa fa-medkit"></i>
                        <p>
                            @lang('lang.MEDICAL')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('medicalEntry.index')}}" class="nav-link {{$route == 'medicalEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.MEDICAL_LIST')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('medicalEntry.create')}}" class="nav-link {{$route == 'medicalEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.MEDICAL_ENTRY')</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item {{$route == 'ticketEntry.index' || $route == 'ticketEntry.create' || $route == 'ticketEntry.view' || $route == 'ticketEntry.edit'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'ticketEntry.index' || $route == 'ticketEntry.create' || $route == 'ticketEntry.view' || $route == 'ticketEntry.edit' ? "active" :''}}">
                        <i class="nav-icon fa fa-ticket-alt"></i>
                        <p>
                            @lang('lang.TICKET')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('ticketEntry.index')}}" class="nav-link {{$route == 'ticketEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.TICKET_LIST')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('ticketEntry.create')}}" class="nav-link {{$route == 'ticketEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.TICKET_ENTRY')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{$route == 'packageEntry.index' || $route == 'packageEntry.create' || $route == 'packageEntry.view' || $route == 'packageEntry.edit'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'packageEntry.index' || $route == 'packageEntry.create' || $route == 'packageEntry.view' || $route == 'packageEntry.edit' ? "active" :''}}">
                        <i class="nav-icon fas fa-plane-departure"></i>
                        <p>
                            @lang('lang.PACKAGE_TOUR')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('packageEntry.index')}}" class="nav-link {{$route == 'packageEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PACKAGE_LIST')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('packageEntry.create')}}" class="nav-link {{$route == 'packageEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PACKAGE_ENTRY')</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item {{$route == 'bankAccount.index' || $route == 'bankAccount.create' || $route == 'pendingCheque.index' || $route == 'head.index'? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'bankAccount.index' || $route == 'bankAccount.create' || $route == 'pendingCheque.index' || $route == 'head.index' ? "active" :''}}">
                        <i class="nav-icon fa fa-university"></i>
                        <p>
                            @lang('lang.BANK_MANAGEMENT')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bankAccount.index')}}" class="nav-link {{$route == 'bankAccount.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.BANK_LIST')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('bankAccount.create')}}" class="nav-link {{$route == 'bankAccount.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.CREATE_BANK')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('pendingCheque.index')}}" class="nav-link {{$route == 'pendingCheque.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PENDING_CHEQUE')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('head.index')}}" class="nav-link {{$route == 'head.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.ISSUE')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{$route == 'payable.index' || $route == 'receivable.index' || $route == 'report.transactionList' ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'payable.index' || $route == 'receivable.index' || $route == 'report.transactionList' ? "active" :''}}">
                        <i class="nav-icon fa fa-chart-pie"></i>
                        <p>
                            @lang('lang.REPORT_SIDEBAR')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('payable.index')}}" class="nav-link {{$route == 'payable.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.ACCOUNT_PAYABLE')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('receivable.index')}}" class="nav-link {{$route == 'receivable.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.ACCOUNT_REVEIVABLE')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('report.transactionList')}}" class="nav-link {{$route == 'report.transactionList' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.TRANSACTION_LIST')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{$route == 'setting.index'  ? "menu-open" :''}}"">
                    <a href="#" class="nav-link {{$route == 'setting.index' ? "active" :''}}">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            @lang('lang.SETTINGS')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('setting.index')}}" class="nav-link {{$route == 'setting.index' ? "active" :''}}">
                                <i class="fa fa-cogs nav-icon"></i>
                                <p>@lang('lang.GENERAL_SETTING')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit();return false;">
                                <i class="nav-icon fa fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>