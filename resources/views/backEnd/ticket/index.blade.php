@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.TICKET_LIST')</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right mr-2">
                        <a href="{{route('ticketEntry.create')}}" class="btn btn-success"  title="@lang('lang.CREATE_MEDICAL')"><i class="fa fa-plus-square"></i> @lang('lang.CREATE_TICKET')</a>
                    </div>
                </div>
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>'ticketEntry.ticketFilter','method'=>'GET'])!!}
            <input type="hidden" name='filter' value="true">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.TEXT'):</label>
                                {!!Form::text('search_value',Request::get('search_value'),['class'=>'form-control','id'=>'search_value','width'=>'100%','placeholder'=>'Enter search keywords']) !!}
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
                            <h3 class="card-title">@lang('lang.TICKET_LIST')</h3>
                            <div class="float-right">
                                <a href="{{url('admin/ticket-entry?view=print')}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/ticket-entry?view=pdf')}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>
                                <a href="{{url('admin/ticket-entry?view=excel')}}" class="btn btn-success"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body" id="tableData">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.CREATED_AT')</th>
                                        <th>@lang('lang.CUSTOMER_CODE')</th>
                                        <th>@lang('lang.NAME')</th>
                                        <th>@lang('lang.TICKET_NO')</th>
                                        <th>@lang('lang.ACTION')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($targets->isNotEmpty())
                                    <?php $i = 0; ?>
                                    @foreach($targets as $target)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        <td>{{$target->customer_code}}</td>
                                        <td>{{$target->name}}</td>
                                        <td>{{$target->ticket_no}}</td>
                                        <td width="20%">
                                            <div style="float: left;margin-right:4px;">
                                                <a class="btn btn-success btn-sm" title="@lang('lang.VIEW_TICKET')"  href="{{route('ticketEntry.view',$target->id)}}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-warning btn-sm" title="@lang('lang.EDIT_TICKET')"  href="{{route('ticketEntry.edit',$target->id)}}"><i class="fa fa-edit"></i></a>
                                                <a type="button" class="btn btn-secondary btn-sm openCreateModal" data-id="{{$target->id}}" data-issue="4" data-toggle="modal" title="@lang('lang.TRANSACTION')" data-target="#viewCreateModal"><i class="fa fa-exchange-alt"></i></a>
                                                <a href="{{route('ticketEntry.transaction-list',$target->id)}}" class="btn btn-primary btn-sm"  title="@lang('lang.TRANSACTION_LIST')"><i class="fa fa-list"></i></a>
                                            </div>
                                            <div style="float: left;">
                                                {!!Form::open(['route'=>['ticketEntry.destroy',$target->id]])!!}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm deleteBtn" title="@lang('lang.DELETE_MEDICAL')"><i class="fa fa-trash"></i></button>
                                                {!!Form::close()!!}
                                            </div>  
                                        </td>
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
<div class="modal fade" id="viewUserCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="createModalShowData">
        </div>
    </div>
</div>

<div class="modal fade" id="viewListModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="listModalShow">
        </div>
    </div>
</div>

<div class="modal fade" id="viewTransEditModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="showTrnData">
        </div>
    </div>
</div>

@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
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


    $(document).on('click', '.openCreateModal', function () {
        var id = $(this).attr('data-id');
        var issue_id = $(this).attr('data-issue');
        if (id != '') {
            $.ajax({
                url: "{{route('transaction.create')}}",
                type: "post",
                data: {application_id: id, issue_id: issue_id},
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
                        var newOption = new Option(data.name, data.id, true, true);
                        $('#User').append(newOption).trigger('change');
                    }
                }
            });
        }
    });







    $(document).on('click', '#update', function () {
        var data = new FormData($('#updateFormData')[0]);
        if (data != '') {
            $.ajax({
                url: "{{route('bankLedger.update')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $("#edit_transaction_type_error").text('');
                    $("#edit_amount_error").text('');
                    if (data.errors) {
                        $("#edit_transaction_type_error").text(data.errors.transaction_type);
                        $("#edit_amount_error").text(data.errors.amount);
                    }
                    if (data.response == "success") {
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                        $('#viewTransEditModal').modal('hide');
                        toastr.success("@lang('lang.TRANSACTION_UPDATED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
//                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
                    }
                }
            });
        }
    });


    $(document).on('click', '.deleteTrBtn', function () {
        var id = $(this).attr('data-id');
        if (id != '') {
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
                            $.ajax({
                                url: "{{route('bankLedger.destroy')}}",
                                type: "post",
                                data: {id: id},
                                dataType: "json",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (data) {
                                    if (data.response == 'success') {
                                        setTimeout(function () {
                                            location.reload();
                                        }, 1000);
                                        $('#viewListModal').modal('hide');
                                        toastr.success("@lang('lang.TRANSACTION_DELETED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
                                    }
                                }
                            });
                        } else {
                            swal("Cancelled", "Your Record is safe :)", "error");

                        }
                    });
        }
    });



    $('.deleteBtn').on('click', function (event) {
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
