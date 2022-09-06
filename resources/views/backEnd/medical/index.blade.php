@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.MEDICAL_LIST')</h1>
                </div>
                @if(!empty($accessArr['medical'][31]))
                <div class="col-sm-6">
                    <div class="float-right mr-2">
                        <a href="{{route('medicalEntry.create')}}" class="btn btn-success"  title="@lang('lang.CREATE_MEDICAL')"><i class="fa fa-plus-square"></i> @lang('lang.CREATE_MEDICAL')</a>
                    </div>
                </div>
                @endif
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

    @if(!empty($accessArr['medical'][35]))
    <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>'medicalEntry.medicalFilter','method'=>'GET'])!!}
            <input type="hidden" name='filter' value="true">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('lang.EXPIRY_DATE'):</label>
                                {!!Form::select('expiry_date',$expiryDateArr,Request::get('expiry_date'),['class'=>'select2 form-control','id'=>'expiry_date','width'=>'100%']) !!}
                                @if($errors->has('expiry_date'))
                                <span class="text-danger">{{$errors->first('expiry_date')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('lang.FROM_DATE'):</label>
                                <div class="input-group date" id="fromDate" data-target-input="nearest">
                                    <input type="text" name='from_date' class="form-control datetimepicker-input" data-target="#fromDate" value="{{Request::get('from_date')}}"/>
                                    <div class="input-group-append" data-target="#fromDate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if($errors->has('from_date'))
                                <span class="text-danger">{{$errors->first('from_date')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('lang.TO_DATE'):</label>
                                <div class="input-group date" id="toDate" data-target-input="nearest">
                                    <input type="text" name="to_date" class="form-control datetimepicker-input" data-target="#toDate" value="{{Request::get('to_date')}}"/>
                                    <div class="input-group-append" data-target="#toDate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if($errors->has('to_date'))
                                <span class="text-danger">{{$errors->first('to_date')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.TEXT'):</label>
                                {!!Form::text('search_value',Request::get('search_value'),['class'=>'form-control','id'=>'search_value','width'=>'100%','placeholder'=>'Enter search keywords']) !!}
                                @if($errors->has('search_value'))
                                <span class="text-danger">{{$errors->first('search_value')}}</span>
                                @endif
                            </div>
                        </div>

                        @if(!empty($accessArr['medical'][105]))
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.CREATED_BY'):</label>
                                {!!Form::select('created_by',$users,Request::get('created_by'),['class'=>'select2 form-control','id'=>'created_by','width'=>'100%']) !!}
                                @if($errors->has('created_by'))
                                <span class="text-danger">{{$errors->first('created_by')}}</span>
                                @endif
                            </div>
                        </div>
                        @endif

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
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.MEDICAL_LIST') <span>({{$targets->total()}}) data found</span></h3>
                            <div class="float-right">
                                <?php
                                $queryString = "&expiry_date=" . Request::get('expiry_date') .
                                        "&created_by=" . Request::get('created_by') .
                                        "&search_value=" . Request::get('search_value') .
                                        "&from_date=" . Request::get('from_date') .
                                        "&to_date=" . Request::get('to_date');
                                ?>
                                <a type="button" href="{{route('medicalEntry.index')}}"  class="btn btn-primary">@lang('lang.BACK_TO_ALL_LIST')</a>
<!--                                <a href="{{url('admin/medical-entry?view=print&filter=true'.$queryString)}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/medical-entry?view=pdf&filter=true'.$queryString)}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>-->
                                <a href="{{url('admin/medical-entry?view=excel&filter=true'.$queryString)}}" class="btn btn-warning"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
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
                                        <th>@lang('lang.PASSPORT_NO')</th>
                                        <th>@lang('lang.CONTACT_NO')</th>
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
                                        <td>{{$target->passport_no}}</td>
                                        <td>{{$target->contact_no}}</td>
                                        <td width="25%">
                                            <div  class="btn-group">
                                                @if(!empty($accessArr['invoice'][67]))
                                                <a class="btn btn-primary btn-sm" title="@lang('lang.ADD_INVOICE')" href="{{route('invoice.create',3)}}"><i class="fas fa-file-invoice"></i></a>
                                                @endif

                                                @if(!empty($accessArr['invoice'][66]))
                                                <a class="btn btn-secondary btn-sm" title="@lang('lang.INVOICE_LIST')" href="{{route('invoice.index',3)}}"><i class="fas fa-list"></i></a>
                                                @endif

                                                @if(!empty($accessArr['medical'][33]))
                                                <a class="btn btn-success btn-sm" title="@lang('lang.VIEW_MEDICAL')"  href="{{route('medicalEntry.view',$target->id)}}"><i class="fa fa-eye"></i></a>
                                                @endif

                                                @if(!empty($accessArr['medical'][32]))
                                                <a class="btn btn-warning btn-sm" title="@lang('lang.EDIT_MEDICAL')"  href="{{route('medicalEntry.edit',$target->id)}}"><i class="fa fa-edit"></i></a>
                                                @endif

                                                @if(!empty($accessArr['medical'][36]))
                                                <a type="button" class="btn btn-secondary btn-sm openCreateModal" data-id="{{$target->id}}" data-issue="3" data-toggle="modal" title="@lang('lang.TRANSACTION')" data-target="#viewCreateModal"><i class="fa fa-exchange-alt"></i></a>
                                                @endif

                                                @if(!empty($accessArr['medical'][37]))
                                                <a href="{{route('medicalEntry.transaction-list',$target->id)}}" class="btn btn-primary btn-sm"  title="@lang('lang.TRANSACTION_LIST')"><i class="fa fa-list"></i></a>
                                                @endif

                                                <a href="{{route('medicalEntry.combineReport',$target->id)}}" class="btn btn-secondary btn-sm"  title="@lang('lang.COMBINE_REPORT')"><i class="fa fa-list"></i></a>

                                                @if(!empty($accessArr['medical'][34]))
                                                {!!Form::open(['route'=>['medicalEntry.destroy',$target->id]])!!}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm deleteBtn" title="@lang('lang.DELETE_MEDICAL')"><i class="fa fa-trash"></i></button>
                                                {!!Form::close()!!}
                                                @endif
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
    $('#fromDate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#toDate').datetimepicker({
        format: 'YYYY-MM-DD'
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
                        // Create a DOM Option and pre-select by default
                        var newOption = new Option(data.name, data.id, true, true);
                        // Append it to the select
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
