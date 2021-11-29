@extends('backEnd.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.TRANSACTION_LIST')</h1>
                </div>
<!--                <div class="col-sm-6">
                    <div class="float-right mr-2">
                        <a type="button" class="btn btn-secondary btn-sm openCreateModal" data-id="{{!empty($application_id)? $application_id : ''}}" data-issue="{{!empty($issue_id)? $issue_id : ''}}" data-toggle="modal" title="@lang('lang.TRANSACTION')" data-target="#viewCreateModal"><i class="fa fa-exchange-alt"> @lang('lang.CREATE_TRANSACTION')</i></a>
                    </div>
                </div>-->
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>
   

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <table class="table table-bordered bg-light" >
                            <thead>
                                <tr>
                                    <td><label>@lang('lang.TOTAL_TRANSACTION')</label></td>
                                    <td> <label>@lang('lang.TOTAL_CASH_IN')</label></td>
                                    <td> <label>@lang('lang.TOTAL_CASH_OUT')</label></td>
                                    <td><label>@lang('lang.TOTAL_PROFIT')</label></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$total_transaction}} TK</td>
                                    <td>{{$total_in}} TK</td>
                                    <td>{{$total_out}} TK</td>
                                    <td>{{$total_profit}} TK</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    

    <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>['report.filter'],'method'=>'GET'])!!}
            <input type="hidden" name='filter' value="true">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.USER'):</label>
                                {!!Form::select('user_id',$users,Request::get('user_id'),['class'=>'select2 form-control','id'=>'user_id','width'=>'100%']) !!}
                                @if($errors->has('user_id'))
                                <span class="text-danger">{{$errors->first('user_id')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.TRANSACTION_TYPE'):</label>
                                {!!Form::select('transaction_type',$transactionTypeArr,Request::get('transaction_type'),['class'=>'select2 form-control','id'=>'role_id','width'=>'100%']) !!}
                                @if($errors->has('transaction_type'))
                                <span class="text-danger">{{$errors->first('transaction_type')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.TEXT'):</label>
                                {!!Form::text('search_value',Request::get('search_value'),['class'=>'form-control','id'=>'search_value','width'=>'100%']) !!}
                                @if($errors->has('search_value'))
                                <span class="text-danger">{{$errors->first('search_value')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label></label>
                                <div class="input-group">
                                    <div class="float-right mt-2">
                                        <button type="submit" class="btn btn-warning" title="submit" ><i class="fa fa fa-search"></i> @lang('lang.SUBMIT')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </section>
    
    



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.TRANSACTION_LIST')</h3>
                            <div class="float-right">
                                <a href="{{url('admin/report-transaction-list?view=print')}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/report-transaction-list?view=pdf')}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>
                                <a href="{{url('admin/report-transaction-list/?view=excel')}}" class="btn btn-success"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
                            </div>
                        </div>
                        
                       

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.CREATED_AT')</th>
                                        <th>@lang('lang.TRANSACTION_TYPE')</th>
                                        <th>@lang('lang.AMOUNT')</th>
                                        <th>@lang('lang.PARTY')</th>
                                        <th>@lang('lang.PAYMENT_MODE')</th>
                                        <th>@lang('lang.CHEQUE_NO')</th>
                                        <th>@lang('lang.ISSUE')</th>
                                        <th>@lang('lang.BANK_INFO')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($targets->isNotEmpty())
                                    <?php $i = 0; ?>
                                    @foreach($targets as $target)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        <td>Cash {{$target->transaction_type}}</td>
                                        <td>{{$target->amount}}</td>
                                        <td>{{$users[$target->user_id]??''}}</td>
                                        <td>{{$target->payment_mode}}</td>
                                        <td>{{$target->cheque_no}}</td>
                                        <td>{{$issues[$target->issue_id]?? ''}}</td>
                                        <td width='15%'>{{$bankAccountArr[$target->bank_account_id]??''}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>No Data Found</tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {!!$targets->links('pagination::bootstrap-4')!!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<div class="modal fade" id="viewCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="CreateModalShow">
        </div>
    </div>
</div>
<div class="modal fade" id="viewEditModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="editModalShow">
        </div>
    </div>
</div>

<div class="modal fade" id="viewUserCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="createModalShowData">
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function(){
    $('.select2').select2();
    });
    $(document).on('change', '#ticket_type', function () {
    let ticketType = $(this).val();
    $('#reIssueField').hide();
    $('#deportField').hide();
    $('#refundIssueField').hide();
    if (ticketType == 'reissue') {
    $('#reIssueField').show();
    } else if (ticketType == 'deport') {
    $('#deportField').show();
    } else if (ticketType == 'refund') {
    $('#refundIssueField').show();
    }
    });
    $('.deleteBtn').on('click', function (e) {
    event.preventDefault();
    var form = $(this).closest('form');
    swal({
    title: "Are you sure?",
            text: "You want to delete this, you can't recover this data again.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, DELETE it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
    },
            function (isConfirm) {
            if (isConfirm) {
            form.submit();
            } else {
            swal("Cancelled", "Your Record is safe :)", "error");
            }
            });
    });
    $(document).on('click', '.openCreateModal', function () {
    var id = $(this).attr('data-id');
    var issue_id = $(this).attr('data-issue');
    if (id != '') {
    $.ajax({
    url: "{{route('transaction.create')}}",
            type: "post",
            data: {application_id: id, issue_id : issue_id},
            dataType: "json",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
            $('#CreateModalShow').html(data.data);
            $('.select2').select2();
            $('#User').select2();
            }
    });
    }
    });
    $(document).on('click', '#save', function () {
    var data = new FormData($('#saveFormData')[0]);
    if (data != '') {
    $.ajax({
    url: "{{route('transaction.store')}}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
            $("#transaction_type_error").text('');
            $("#user_id_error").text('');
            $("#amount_error").text('');
            $("#payment_mode_error").text('');
            $("#bank_account_id_error").text('');
            $("#cheque_no_error").text('');
            if (data.errors) {
            $("#transaction_type_error").text(data.errors.transaction_type);
            $("#user_id_error").text(data.errors.user_id);
            $("#amount_error").text(data.errors.amount);
            $("#payment_mode_error").text(data.errors.payment_mode);
            $("#bank_account_id_error").text(data.errors.bank_account_id);
            $("#cheque_no_error").text(data.errors.cheque_no);
            }
            if (data.response == "success") {
            setTimeout(function () {
            location.reload();
            }, 1000);
            $('#viewCreateModal').modal('hide');
            toastr.success("@lang('lang.VOUCHER_ADDED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
//                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
            }
            }
    });
    }
    });
    $(document).on('click', '.openEditModal', function () {
    var id = $(this).attr('data-id');
    if (id != '') {
    $.ajax({
    url: "{{route('transaction.edit')}}",
            type: "post",
            data: {id: id},
            dataType: "json",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
            $('#editModalShow').html(data.data);
            $('.select2').select2();
            $('#User').select2();
            }
    });
    }
    });
    $(document).on('click', '#update', function () {
    var data = new FormData($('#updateFormData')[0]);
    if (data != '') {
    $.ajax({
    url: "{{route('transaction.update')}}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
            $("#transaction_type_error").text('');
            $("#user_id_error").text('');
            $("#amount_error").text('');
            $("#payment_mode_error").text('');
            $("#bank_account_id_error").text('');
            $("#cheque_no_error").text('');
            if (data.errors) {
            $("#transaction_type_error").text(data.errors.transaction_type);
            $("#user_id_error").text(data.errors.user_id);
            $("#amount_error").text(data.errors.amount);
            $("#payment_mode_error").text(data.errors.payment_mode);
            $("#bank_account_id_error").text(data.errors.bank_account_id);
            $("#cheque_no_error").text(data.errors.cheque_no);
            }
            if (data.response == "success") {
            setTimeout(function () {
            location.reload();
            }, 1000);
            $('#viewEditModal').modal('hide');
            toastr.success("@lang('lang.VOUCHER_UPDATED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
//                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
            }
            }
    });
    }
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
    $(document).on('click', '.openUserCreateModal', function () {
    $.ajax({
    url: "{{route('user.create')}}",
            type: "post",
            dataType: "json",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
//                console.log(data);return false;
            $('#createModalShowData').html(data.data);
            }
    });
    });
    $(document).on('click', '#create', function () {
    var data = new FormData($('#createFormData')[0]);
    if (data != '') {
    $.ajax({
    url: "{{route('user.store')}}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
            $("#name_error").text('');
            $("#role_id_error").text('');
            $("#email_error").text('');
            $("#phone_error").text('');
            $("#password_error").text('');
            $("#balance_error").text('');
            $("#profile_photo_error").text('');
            $("#address_error").text('');
            if (data.errors) {
            $("#name_error").text(data.errors.name);
            $("#role_id_error").text(data.errors.role_id);
            $("#email_error").text(data.errors.email);
            $("#phone_error").text(data.errors.phone);
            $("#password_error").text(data.errors.password);
            $("#balance_error").text(data.errors.balance);
            $("#profile_photo_error").text(data.errors.profile_photo);
            $("#address_error").text(data.errors.address);
            }
            if (data.response == "success") {
            $('#viewUserCreateModal').modal('hide');
            toastr.success("@lang('lang.USER_CREATED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
            // Create a DOM Option and pre-select by default
            var newOption = new Option(data.name, data.id, true, true);
            // Append it to the select
            $('#User').append(newOption).trigger('change');
            }
            }
    });
    }
    });
</script>
@endpush
