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
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
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
                            <h3 class="card-title">@lang('lang.EDIT_BANK_ACCOUNT')</h3>
                        </div>
                        {!!Form::open(['route'=>['bankAccount.update',[$target->id,'page'=>$page]],'class'=>'form-horizontal'])!!}
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="accountNo" class="col-sm-3 col-form-label">@lang('lang.ACCOUNT_NO') :</label>
                                <div class="col-sm-9">
                                    {!!Form::text('account_no',$target->account_no??'',['class'=>'form-control','placeholder'=>__('lang.ENTER_ACCOUNT_NO'),'id'=>'accountNo'])!!}
                                    @if($errors->has('account_no'))
                                    <span class="text-danger">{{$errors->first('account_no')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="accountName" class="col-sm-3 col-form-label">@lang('lang.ACCOUNT_NAME') :</label>
                                <div class="col-sm-9">
                                    {!!Form::text('account_name',$target->account_name??'',['class'=>'form-control','placeholder'=>__('lang.ENTER_ACCOUNT_NAME'),'id'=>'accountName'])!!}
                                    @if($errors->has('account_name'))
                                    <span class="text-danger">{{$errors->first('account_name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bankName" class="col-sm-3 col-form-label">@lang('lang.BANK_NAME') :</label>
                                <div class="col-sm-9">
                                    {!!Form::text('bank_name',$target->bank_name??'',['class'=>'form-control','placeholder'=>__('lang.ENTER_BANK_NAME'),'id'=>'bankName'])!!}
                                    @if($errors->has('bank_name'))
                                    <span class="text-danger">{{$errors->first('bank_name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="branch" class="col-sm-3 col-form-label">@lang('lang.BRANCH_NAME') :</label>
                                <div class="col-sm-9">
                                    {!!Form::text('branch',$target->bank_name??'',['class'=>'form-control','placeholder'=>__('lang.ENTER_BRANCH_NAME'),'id'=>'branch'])!!}
                                    @if($errors->has('branch'))
                                    <span class="text-danger">{{$errors->first('branch')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="currentAmount" class="col-sm-3 col-form-label">@lang('lang.CURRENT_AMOUNT') :</label>
                                <div class="col-sm-9">
                                    {!!Form::text('current_amount',$target->current_amount??'',['class'=>'form-control','placeholder'=>__('lang.ENTER_CURRENT_AMOUNT'),'id'=>'currentAmount','readonly'=>'readonly'])!!}
                                    @if($errors->has('current_amount'))
                                    <span class="text-danger">{{$errors->first('current_amount')}}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{route('bankAccount.index')}}" class="btn btn-default ">Cancel</a>
                                <button type="submit" class="btn btn-info float-right">Save</button>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
