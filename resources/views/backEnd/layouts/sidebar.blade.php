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

                @if(!empty($accessArr['dashboard'][13]))
                <li class="nav-item menu-open">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('lang.DASHBOARD')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                @endif

                @if(!empty($accessArr['user'][1]) || !empty($accessArr['user_role'][8]))
                <li class="nav-item {{$route == 'user.index' || $route == 'user.create' || $route == 'role.index' ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'user.index' || $route == 'user.create' || $route == 'role.index' ? "active" :''}}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            @lang('lang.USER_MANAGEMENT')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['user'][1]))
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link {{$route == 'user.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.USER_LIST')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['user_role'][8]))
                        <li class="nav-item">
                            <a href="{{route('role.index')}}" class="nav-link {{$route == 'role.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.USER_ROLE')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['visa'][14]) || !empty($accessArr['visa'][15]))
                <li class="nav-item {{$route == 'visaEntry.index' || $route == 'visaEntry.create' || $route == 'visaEntry.view' || $route == 'visaEntry.edit' || $route == 'visaEntry.combineReport'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'visaEntry.index' || $route == 'visaEntry.create' || $route == 'visaEntry.view' || $route == 'visaEntry.edit' || $route == 'visaEntry.combineReport' ? "active" :''}}">
                        <i class="nav-icon fab fa-cc-visa"></i>
                        <p>
                            @lang('lang.VISA')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['visa'][14]))
                        <li class="nav-item">
                            <a href="{{route('visaEntry.index')}}" class="nav-link {{$route == 'visaEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.VISA_LIST')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['visa'][15]))
                        <li class="nav-item">
                            <a href="{{route('visaEntry.create')}}" class="nav-link {{$route == 'visaEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.VISA_ENTRY')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['passport'][22]) || !empty($accessArr['passport'][23]))
                <li class="nav-item {{$route == 'passportEntry.index' || $route == 'passportEntry.create' || $route == 'passportEntry.view' || $route == 'passportEntry.edit' || $route == 'passportEntry.combineReport'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'passportEntry.index' || $route == 'passportEntry.create' || $route == 'passportEntry.view' || $route == 'passportEntry.edit' || $route == 'passportEntry.combineReport' ? "active" :''}}">
                        <i class="nav-icon fas fa-passport"></i>
                        <p>
                            @lang('lang.PASSPORT')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['passport'][22]))
                        <li class="nav-item">
                            <a href="{{route('passportEntry.index')}}" class="nav-link {{$route == 'passportEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PASSPORT_LIST')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['passport'][23]))
                        <li class="nav-item">
                            <a href="{{route('passportEntry.create')}}" class="nav-link {{$route == 'passportEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PASSPORT_ENTRY')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['medical'][30]) || !empty($accessArr['medical'][31]))
                <li class="nav-item {{$route == 'medicalEntry.index' || $route == 'medicalEntry.create' || $route == 'medicalEntry.view' || $route == 'medicalEntry.edit' || $route == 'medicalEntry.combineReport'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'medicalEntry.index' || $route == 'medicalEntry.create' || $route == 'medicalEntry.view' || $route == 'medicalEntry.edit' || $route == 'medicalEntry.combineReport' ? "active" :''}}">
                        <i class="nav-icon fa fa-medkit"></i>
                        <p>
                            @lang('lang.MEDICAL')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['medical'][30]))
                        <li class="nav-item">
                            <a href="{{route('medicalEntry.index')}}" class="nav-link {{$route == 'medicalEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.MEDICAL_LIST')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['medical'][31]))
                        <li class="nav-item">
                            <a href="{{route('medicalEntry.create')}}" class="nav-link {{$route == 'medicalEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.MEDICAL_ENTRY')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['ticket'][38]) || !empty($accessArr['ticket'][39]))
                <li class="nav-item {{$route == 'ticketEntry.index' || $route == 'ticketEntry.create' || $route == 'ticketEntry.view' || $route == 'ticketEntry.edit' || $route == 'ticketEntry.combineReport'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'ticketEntry.index' || $route == 'ticketEntry.create' || $route == 'ticketEntry.view' || $route == 'ticketEntry.edit' || $route == 'ticketEntry.combineReport' ? "active" :''}}">
                        <i class="nav-icon fa fa-ticket-alt"></i>
                        <p>
                            @lang('lang.TICKET')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['ticket'][38]))
                        <li class="nav-item">
                            <a href="{{route('ticketEntry.index')}}" class="nav-link {{$route == 'ticketEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.TICKET_LIST')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['ticket'][39]))
                        <li class="nav-item">
                            <a href="{{route('ticketEntry.create')}}" class="nav-link {{$route == 'ticketEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.TICKET_ENTRY')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['package'][46]) || !empty($accessArr['package'][47]))
                <li class="nav-item {{$route == 'packageEntry.index' || $route == 'packageEntry.create' || $route == 'packageEntry.view' || $route == 'packageEntry.edit'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'packageEntry.index' || $route == 'packageEntry.create' || $route == 'packageEntry.view' || $route == 'packageEntry.edit' ? "active" :''}}">
                        <i class="nav-icon fas fa-plane-departure"></i>
                        <p>
                            @lang('lang.PACKAGE_TOUR')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['package'][46]))
                        <li class="nav-item">
                            <a href="{{route('packageEntry.index')}}" class="nav-link {{$route == 'packageEntry.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PACKAGE_LIST')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['package'][47]))
                        <li class="nav-item">
                            <a href="{{route('packageEntry.create')}}" class="nav-link {{$route == 'packageEntry.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PACKAGE_ENTRY')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['bank'][54]) || !empty($accessArr['bank'][55]) || !empty($accessArr['bank'][62]))
                <li class="nav-item {{$route == 'bankAccount.index' || $route == 'bankAccount.create' || $route == 'pendingCheque.index' ?  "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'bankAccount.index' || $route == 'bankAccount.create' || $route == 'pendingCheque.index'  ? "active" :''}}">
                        <i class="nav-icon fa fa-university"></i>
                        <p>
                            @lang('lang.BANK_MANAGEMENT')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['bank'][54]))
                        <li class="nav-item">
                            <a href="{{route('bankAccount.index')}}" class="nav-link {{$route == 'bankAccount.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.BANK_LIST')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['bank'][55]))
                        <li class="nav-item">
                            <a href="{{route('bankAccount.create')}}" class="nav-link {{$route == 'bankAccount.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.CREATE_BANK')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['bank'][62]))
                        <li class="nav-item">
                            <a href="{{route('pendingCheque.index')}}" class="nav-link {{$route == 'pendingCheque.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PENDING_CHEQUE')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['report'][71]) || !empty($accessArr['report'][74]) || !empty($accessArr['report'][77]))
                <li class="nav-item {{$route == 'payable.index' || $route == 'receivable.index' || $route == 'report.transactionList' || $route == 'serviceContract.index' || $route == 'userLog.index' || $route == 'log.index'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'payable.index' || $route == 'receivable.index' || $route == 'report.transactionList' || $route == 'serviceContract.index' || $route == 'userLog.index' || $route == 'log.index' ? "active" :''}}">
                        <i class="nav-icon fa fa-chart-pie"></i>
                        <p>
                            @lang('lang.REPORT_SIDEBAR')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['report'][71]))
                        <li class="nav-item">
                            <a href="{{route('payable.index')}}" class="nav-link {{$route == 'payable.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.ACCOUNT_PAYABLE')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['report'][74]))
                        <li class="nav-item">
                            <a href="{{route('receivable.index')}}" class="nav-link {{$route == 'receivable.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.ACCOUNT_REVEIVABLE')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['party_ledger'][124]))
                        <li class="nav-item">
                            <a href="{{route('serviceContract.index')}}" class="nav-link {{$route == 'serviceContract.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.SERVICE_CONTRACT')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['report'][77]))
                        <li class="nav-item">
                            <a href="{{route('report.transactionList')}}" class="nav-link {{$route == 'report.transactionList' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.TRANSACTION_LIST')</p>
                            </a>
                        </li>
                        @endif


                        @if(!empty($accessArr['log'][127]))
                        <li class="nav-item">
                            <a href="{{route('userLog.index')}}" class="nav-link {{$route == 'userLog.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.USER_LOG')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['log'][128]))
                        <li class="nav-item">
                            <a href="{{route('log.index')}}" class="nav-link {{$route == 'log.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.LOG')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['invoice'][66]) || !empty($accessArr['invoice'][67]))
                <li class="nav-item {{$route == 'invoice.index' || $route == 'invoice.create' || $route == 'invoice.view' || $route == 'invoice.edit'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'invoice.index' || $route == 'invoice.create' || $route == 'invoice.view' || $route == 'invoice.edit' ? "active" :''}}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            @lang('lang.INVOICE')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['invoice'][66]))
                        <li class="nav-item">
                            <a href="{{route('invoice.index',0)}}" class="nav-link {{$route == 'invoice.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.INVOICE_LIST')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['invoice'][67]))
                        <li class="nav-item">
                            <a href="{{route('invoice.create',0)}}" class="nav-link {{$route == 'invoice.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.CREATE_INVOICE')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif


                @if(!empty($accessArr['service_contract'][118]))
                <li class="nav-item {{$route == 'serviceCharge.index' || $route == 'serviceCharge.create' || $route == 'serviceCharge.view' || $route == 'serviceCharge.edit'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'serviceCharge.index' || $route == 'serviceCharge.create' || $route == 'serviceCharge.view' || $route == 'serviceCharge.edit' ? "active" :''}}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            @lang('lang.SERVICE_CHARGE')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['service_contract'][118]))
                        <li class="nav-item">
                            <a href="{{route('serviceCharge.index')}}" class="nav-link {{$route == 'serviceCharge.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.SERVICE_CHARGE_LIST')</p>
                            </a>
                        </li>
                        @endif    
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['general_setting'][80]) || !empty($accessArr['issue'][85]) || !empty($accessArr['product'][90]))
                <li class="nav-item {{$route == 'setting.index' || $route == 'head.index' || $route == 'product.index'  ? "menu-open" :''}}"">
                    <a href="#" class="nav-link {{$route == 'setting.index' || $route == 'head.index' || $route == 'product.index' ? "active" :''}}">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            @lang('lang.SETTINGS')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['general_setting'][80]))
                        <li class="nav-item">
                            <a href="{{route('setting.index')}}" class="nav-link {{$route == 'setting.index' ? "active" :''}}">
                                <i class="fa fa-cogs nav-icon"></i>
                                <p>@lang('lang.GENERAL_SETTING')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['issue'][85]))
                        <li class="nav-item">
                            <a href="{{route('head.index')}}" class="nav-link {{$route == 'head.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.ISSUE')</p>
                            </a>
                        </li>
                        @endif

                        @if(!empty($accessArr['product'][90]))
                        <li class="nav-item">
                            <a href="{{route('product.index')}}" class="nav-link {{$route == 'product.index' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PRODUCT')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(!empty($accessArr['permission'][95]) || !empty($accessArr['permission'][96]))
                <li class="nav-item {{$route == 'permission.index' || $route == 'permission.create'  ? "menu-open" :''}}">
                    <a href="#" class="nav-link {{$route == 'permission.index' || $route == 'permission.create' ? "active" :''}}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            @lang('lang.PERMISSION')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(!empty($accessArr['permission'][95]))
                        <li class="nav-item">
                            <a href="{{route('permission.index')}}" class="nav-link {{$route == 'permission.index' || $route == 'permission.create' ? "active" :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('lang.PERMISSION')</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

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