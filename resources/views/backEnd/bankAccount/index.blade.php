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
<!--                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>-->
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>
    
     <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>'bankAccount.filter','method'=>'GET'])!!}
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
                            <h3 class="card-title">@lang('lang.BANK_ACCOUNT_LIST')</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body" id="tableData">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.CREATED_AT')</th>
                                        <th>@lang('lang.ACCOUNT_NO')</th>
                                        <th>@lang('lang.CURRENT_AMOUNT')</th>
                                        <th>@lang('lang.ACCOUNT_NAME')</th>
                                        <th>@lang('lang.BANK_NAME')</th>
                                        <th>@lang('lang.BRANCH_NAME')</th>
                                        <th>@lang('lang.ACTION')</th>
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
                                        <td>{{$target->account_no}}</td>
                                        <td>{{$target->current_amount}}</td>
                                        <td>{{$target->account_name}}</td>
                                        <td>{{$target->bank_name}}</td>
                                        <td>{{$target->branch}}</td>
                                        <td width="20%">
                                            <div style="float: left;margin-right:4px;">
                                                <a class="btn btn-success btn-sm" title="@lang('lang.VIEW')" href="{{route('bankAccount.view',[$target->id,'page'=>$page])}}"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-warning btn-sm" title="@lang('lang.EDIT')" href="{{route('bankAccount.edit',[$target->id,'page'=>$page])}}"><i class="fa fa-edit"></i></a>
                                                <a type="button" class="btn btn-secondary btn-sm openCreateModal" data-id="{{$target->id}}" data-toggle="modal" title="@lang('lang.TRANSACTION')" data-target="#viewCreateModal"><i class="fa fa-exchange-alt"></i></a>
                                                <a type="button" class="btn btn-primary btn-sm openListModal" data-id="{{$target->id}}" data-toggle="modal" title="@lang('lang.TRANSACTION_LIST')" data-target="#viewListModal"><i class="fa fa-list"></i></a>
                                            </div>
                                            <div style="float: left;">
                                                {!!Form::open(['route'=>['bankAccount.destroy',$target->id]])!!}
                                                @method('DELETE')
                                                <button type="submit" title="@lang('lang.DELETE')" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i></button>
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
    <div class="modal-dialog">
        <div id="CreateModalShow">
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
    $(document).ready(function(){
        $('.select2').select2();
    });
    $(document).on('click', '.openCreateModal', function () {
        var id = $(this).attr('data-id');
        if (id != '') {
            $.ajax({
                url: "{{route('bankLedger.create')}}",
                type: "post",
                data: {bank_account_id: id},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#CreateModalShow').html(data.data);
                }
            });
        }
    });

    $(document).on('click', '#create', function () {
        var data = new FormData($('#createFormData')[0]);
        if (data != '') {
            $.ajax({
                url: "{{route('bankLedger.store')}}",
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
                    $("#amount_error").text('');
                    if (data.errors) {
                        $("#transaction_type_error").text(data.errors.transaction_type);
                        $("#amount_error").text(data.errors.amount);
                    }
                    if (data.response == "success") {
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                        $('#viewCreateModal').modal('hide');
                        toastr.success("@lang('lang.LEDGER_CREATED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
//                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
                    }
                }
            });
        }
    });

    $(document).on('click', '.openListModal', function () {
        var id = $(this).attr('data-id');
        if (id != '') {
            $.ajax({
                url: "{{route('bankLedger.ledgerList')}}",
                type: "post",
                data: {bank_account_id: id},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#listModalShow').html(data.data);
                }
            });
        }
    });
    $(document).on('change', '#transactionType', function () {
        var typeValue = $(this).val();
        if (typeValue != '' && typeValue == 'in') {
            $('#Target').hide();
            $('#outTarget').hide();
            $('#inTarget').show();
        } else if (typeValue != '' && typeValue == 'out') {
            $('#Target').hide();
            $('#inTarget').hide();
            $('#outTarget').show();
        } else {
            $('#Target').show();
            $('#inTarget').hide();
            $('#outTarget').hide();
        }
    });

    $(document).on('click', '.openTransEditModal', function () {
        var id = $(this).attr('data-id');
        if (id != '') {
            $.ajax({
                url: "{{route('bankLedger.edit')}}",
                type: "post",
                data: {bank_ledgers_id: id},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#viewListModal').modal('hide');
                    $('#viewTransEditModal').modal('show');
                    $('#showTrnData').html(data.data);
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
</script>
@endpush
