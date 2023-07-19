@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.PENDING_CHEQUE')</h1>
                </div>
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

    @if(!empty($accessArr['bank'][64]))
    <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>'pendingCheque.filter','method'=>'GET'])!!}
            <input type="hidden" name='filter' value="true">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
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
                                <label>@lang('lang.USER'):</label>
                                {!!Form::select('status',$statusArr,Request::get('status'),['class'=>'select2 form-control','id'=>'status','width'=>'100%']) !!}
                                @if($errors->has('status'))
                                <span class="text-danger">{{$errors->first('status')}}</span>
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
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.PENDING_CHEQUE_LIST')</h3>
                        </div>

                        <!-- /.card-header -->
                        <div id='refreshDiv'>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>@lang('lang.BANK_INFO')</th>
                                            <th>@lang('lang.CHEQUE_NO')</th>
                                            <th>@lang('lang.TRANSACTION_TYPE')</th>
                                            <th>@lang('lang.CHEQUE_AMOUNT')</th>
                                            <th>@lang('lang.STATUS')</th>
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
                                            <td>{{$bankInfoArr[$target->transaction_id]??''}}</td>
                                            <td>{{$target->cheque_no}}</td>
                                            <td>Cash {{$target->transaction_type}}</td>
                                            <td>{{$target->cheque_amount}}</td>
                                            <td @if($target->status == '1')
                                                class="badge badge-pill badge-success mt-2 ml-2" @else  class="badge badge-pill badge-warning mt-2 ml-2" @endif>{{Helper::pendingCheque($target->status)}}
                                            </td>
                                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                                            <td width='10%'>

                                                <div style="float: left;margin-right:4px;">
                                                    @if( $target->status == '0')

                                                    @if(!empty($accessArr['bank'][63]))
                                                    <a class="btn btn-success btn-sm approveCheque" data-id="{{$target->id}}" title="@lang('lang.APPROVE_CHEQUE')"><i class="fa fa-check"></i></a>
                                                    @endif
                                                    
                                                    @if(!empty($accessArr['bank'][65]))
                                                    <a class="btn btn-danger btn-sm deleteCheque" data-id="{{$target->id}}" title="@lang('lang.DELETE')"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                    
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
@endsection
@push('script')
<script type="text/javascript">
    $(document).on('click', '.approveCheque', function () {
        var id = $(this).attr('data-id');
        if (id != '') {
            swal({
                title: "Are you sure?",
                text: "You want to approve this",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Approve it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{route('pendingCheque.approve')}}",
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
                                        toastr.success("@lang('lang.PENDING_CHEQUE_APPROVED')", 'Success', {timeOut: 5000});
                                    }
                                }
                            });
                        } else {
                            swal("Cancelled", "Your Record is safe :)", "error");

                        }
                    });
        }
    });

    $(document).on('click', '.deleteCheque', function (event) {
        event.preventDefault();
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
                                url: "{{route('pendingCheque.destroy')}}",
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
                                        toastr.success("@lang('lang.PENDING_CHEQUE_DELETED')", 'Success', {timeOut: 5000});
                                    }
                                }
                            });
                        } else {
                            swal("Cancelled", "Your Record is safe :)", "error");

                        }
                    });
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
</script>
@endpush
