@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.BANK_LEDGER')</h1>
                </div>
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">{{$bankAccountArr[$bank_account_id]??''}}</h3>
                        </div>

                        <div class="card-body">
                            <div>
                                <table class="table table-bordered" id='Target'>
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>@lang('lang.TRANSACTION_TYPE')</th>
                                            <th>@lang('lang.AMOUNT')</th>
                                            <th>@lang('lang.NOTE')</th>
                                            <th>@lang('lang.CREATED_AT')</th>
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
                                            <td>Cash {{$target->transaction_type}}</td>
                                            <td>{{$target->amount}}</td>
                                            <td>{{$target->note}}</td>
                                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                                            <td width='15%'>
                                                <div>
                                                    <a type="button" class="btn btn-warning openTransEditModal" data-toggle="modal" title="@lang('lang.TRANSACTION_EDIT')" data-target="#viewEditModal" data-id="{{$target->id}}"><i class="fa fa-edit"></i></a>
                                                    <a type="button" class="btn btn-danger deleteTrBtn"  title="@lang('lang.TRANSACTION_DELETE')" data-id="{{$target->id}}"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="9">No Data Found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {!!$targets->links('pagination::bootstrap-4')!!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<!--view contact Number Modal -->
<div class="modal fade" id="viewCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div id="CreateModalShow">
        </div>
    </div>
</div>
<!--end view Modal -->
<!--view contact Number Modal -->
<div class="modal fade" id="viewEditModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div id="editModalShow">
        </div>
    </div>
</div>

<div class="modal fade" id="viewTransEditModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="showTrnData">
        </div>
    </div>
</div>
<!--end view Modal -->
@endsection
@push('script')
<script type="text/javascript">
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
                    console.log(data);
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
