@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.BANK_ACCOUNT')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.VIEW_BANK_ACCOUNT')</h3>
                        </div>

                        <div class="card-body">
                            <div>
                                <table class="table table-bordered" id='Target'>
                                    <tbody>
                                        <tr>
                                            <td><strong>@lang('lang.ACCOUNT_NO')</strong> </td>
                                            <td>{{$target->account_no}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.ACCOUNT_NAME')</strong> </td>
                                            <td>{{$target->account_name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.BANK_NAME')</strong> </td>
                                            <td>{{$target->bank_name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.BRANCH_NAME')</strong> </td>
                                            <td>{{$target->branch}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.CURRENT_AMOUNT')</strong> </td>
                                            <td>{{$target->current_amount}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('lang.CREATED_AT')</strong> </td>
                                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

