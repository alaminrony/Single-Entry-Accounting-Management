@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.VIEW_VOUCHER')</h1>
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
                            <h3 class="card-title">@lang('lang.VIEW_VOUCHER')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">@lang('lang.TRANSACTION_TYPE') :</label>
                                <div class="col-sm-9">
                                    {!!Form::select('transaction_type',$transactionTypeArr,!empty($target->transaction_type) ? $target->transaction_type : null,['class'=>'form-control','readonly']) !!}
                                    @if($errors->has('transaction_type'))
                                    <span class="text-danger">{{$errors->first('transaction_type')}}</span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">@lang('lang.ISSUE') :</label>
                                <div class="col-sm-9">
                                    {!!Form::select('issue_id',$issueArr,!empty($target->issue_id) ? $target->issue_id : null,['class'=>'form-control','readonly']) !!}
                                    @if($errors->has('issue_id'))
                                    <span class="text-danger">{{$errors->first('issue_id')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">@lang('lang.PAYMENT_MODE') :</label>
                                <div class="col-sm-9">
                                    {!!Form::select('payment_mode',$paymentModeArr,!empty($target->payment_mode) ? $target->payment_mode : null,['class'=>'form-control','id'=>'paymentMode','readonly']) !!}
                                    @if($errors->has('payment_mode'))
                                    <span class="text-danger">{{$errors->first('payment_mode')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="display: none;" id="bankAccount">
                                <label class="col-sm-3 col-form-label">@lang('lang.BANK_ACCOUNT') :</label>
                                <div class="col-sm-9">
                                    {!!Form::select('bank_account_id',$bankAccountArr,!empty($target->bank_account_id) ? $target->bank_account_id : null,['class'=>'form-control','readonly']) !!}
                                    @if($errors->has('bank_account_id'))
                                    <span class="text-danger">{{$errors->first('bank_account_id')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="display: none;" id="chequeNo">
                                <label for="checkNumber" class="col-sm-3 col-form-label">@lang('lang.CHEQUE_NO') :</label>
                                <div class="col-sm-9">
                                    {!!Form::text('cheque_no',$target->cheque_no,['class'=>'form-control','id'=>'checkNumber','placeholder'=>'Enter cheque no','readonly'])!!}
                                    @if($errors->has('cheque_no'))
                                    <span class="text-danger">{{$errors->first('cheque_no')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Amount" class="col-sm-3 col-form-label">@lang('lang.AMOUNT') :</label>
                                <div class="col-sm-9">
                                    {!!Form::number('amount',$target->amount,['class'=>'form-control','id'=>'Amount','placeholder'=>'Enter amount','readonly'])!!}
                                    @if($errors->has('amount'))
                                    <span class="text-danger">{{$errors->first('amount')}}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="window.open('{{route('transaction.index')}}','_self');return false;" type="submit" class="btn btn-default ">Back</button>
                                <button onclick="window.open('{{route('transaction.index')}}','_self');return false;" type="submit" class="btn btn-info float-right">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        var payment_mode = "{{$target->payment_mode}}";
        if (payment_mode == 'cheque') {
            $('#bankAccount').show();
            $('#chequeNo').show();
        }
    });

</script>
@endpush
