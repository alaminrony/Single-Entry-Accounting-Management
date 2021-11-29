@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.VOUCHER_ENTRY')</h1>
                </div>
                <!--                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">Simple Tables</li>
                                    </ol>
                                </div>-->
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
                            <h3 class="card-title">@lang('lang.VOUCHER_ENTRY')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{route('transaction.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">@lang('lang.TRANSACTION_TYPE') :</label>
                                    <div class="col-sm-9">
                                        {!!Form::select('transaction_type',$transactionTypeArr,'',['class'=>'form-control','id'=>'trType']) !!}
                                        @if($errors->has('transaction_type'))
                                        <span class="text-danger">{{$errors->first('transaction_type')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">@lang('lang.ISSUE') :</label>
                                    <div class="col-sm-9">
                                        {!!Form::select('issue_id',$issueArr,'',['class'=>'form-control','id'=>'Issue']) !!}
                                        @if($errors->has('issue_id'))
                                        <span class="text-danger">{{$errors->first('issue_id')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">@lang('lang.PARTY') :</label>
                                    <div class="col-sm-9">
                                        {!!Form::select('user_id',$users,'',['class'=>'form-control','id'=>'user_id','class'=>'js-example-basic-single','data-width'=>'100%']) !!}
                                        @if($errors->has('user_id'))
                                        <span class="text-danger">{{$errors->first('user_id')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">@lang('lang.PAYMENT_MODE') :</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="paymentMode" name="payment_mode">
                                            <option value="">-- Select payment mode --</option>
                                            <option value="cash" <?php if (old('payment_mode') == 'cash') echo ' selected="selected"' ?>>Cash</option>
                                            <option value="cheque" <?php if (old('payment_mode') == 'cheque') echo ' selected="selected"' ?>>Cheque</option>
                                        </select>
                                        @if($errors->has('payment_mode'))
                                        <span class="text-danger">{{$errors->first('payment_mode')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none;" id="bankAccount">
                                    <label class="col-sm-3 col-form-label">@lang('lang.BANK_ACCOUNT') :</label>
                                    <div class="col-sm-9">
                                        {!!Form::select('bank_account_id',$bankAccountArr,!empty(old('bank_account_id')) ? old('bank_account_id') : null,['class'=>'form-control']) !!}
                                        @if($errors->has('bank_account_id'))
                                        <span class="text-danger">{{$errors->first('bank_account_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none;" id="chequeNo">
                                    <label for="checkNumber" class="col-sm-3 col-form-label">@lang('lang.CHEQUE_NO') :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="cheque_no" id="checkNumber" placeholder="Enter cheque no">
                                        @if($errors->has('cheque_no'))
                                        <span class="text-danger">{{$errors->first('cheque_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Amount" class="col-sm-3 col-form-label">@lang('lang.AMOUNT') :</label>
                                    <div class="col-sm-9">
                                        <input type="number" min='0',max='50' class="form-control" id="Amount" placeholder="Enter amount" name="amount">
                                        @if($errors->has('amount'))
                                        <span class="text-danger">{{$errors->first('amount')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-default ">Cancel</button>
                                    <button type="submit" class="btn btn-info float-right">Save</button>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });
    var payment_mode = "{{old('payment_mode')}}";
    if (payment_mode == 'cheque') {
        $('#bankAccount').show();
        $('#chequeNo').show();
    }
    $(document).on('change', '#paymentMode', function () {
        var value = $(this).val();
        if (value == 'cheque') {
            $('#bankAccount').show();
            $('#chequeNo').show();
        } else {
            $('#bankAccount').hide();
            $('#chequeNo').hide();
        }
    });
    $(document).on('change', '#trType', function () {
        var trType = $(this).val();
        if (trType != '') {
            $.ajax({
                url: "{{route('transaction.getIssue')}}",
                type: "post",
                data: {trType: trType},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#Issue').html(data.data);
                }
            });
        }

    });


</script>
@endpush
