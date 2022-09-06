@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.INVOICE_LIST') for {{$issueArr[request()->route('issue_id')] ?? ''}}</h1>
                </div>
                @if(!empty($accessArr['invoice'][67]))
                <div class="col-sm-6">
                    <div class="float-right mr-2">
                        <a href="{{route('invoice.create',$issue_id)}}" class="btn btn-success"  title="@lang('lang.CREATE_VISA')"><i class="fa fa-plus-square"></i> @lang('lang.CREATE_INVOICE')</a>
                    </div>
                </div>
                @endif
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

<!--    <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>['invoice.filter',$issue_id],'method'=>'GET'])!!}
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
    </section>-->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.INVOICE_LIST')</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body" id="tableData">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.INVOICE_DATE')</th>
                                        <th>@lang('lang.INVOICE_ID')</th>
                                        <th>@lang('lang.BILL_TO')</th>
                                        <th>@lang('lang.QUANTITY')</th>
                                        <th>@lang('lang.DISCOUNT')(%)</th>
                                        <th>@lang('lang.DISCOUNT') (TK)</th>
                                        <th>@lang('lang.TOTAL')</th>
                                        <th>@lang('lang.ISSUE')</th>
                                        <th>@lang('lang.STATUS')</th>
                                        <th>@lang('lang.ACTION')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($targets->isNotEmpty())
                                    <?php $i = 0; ?>
                                    @foreach($targets as $target)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <!--<td>{{Helper::dateFormat($target->created_at)}}</td>-->
                                        <td>{{!empty($target->inv_date) ? Helper::dateFormat2($target->inv_date) : ''}}</td>
                                        <td>{{$target->invoice_code}}</td>
                                        <td>{{$target->bill_to_name}}</td>
                                        <td>{{$target->total_quantity}}</td>
                                        <td>{{$target->discount_percent}}</td>
                                        <td>{{$target->discount_total}}</td>
                                        <td>{{$target->total_amount}}</td>
                                        <td>{{$issueArr[$target->issue_id] ?? ''}}</td>
                                        <td>{{$target->status}}</td>
                                        <td>
                                            <div style="float: left;margin-right:4px;">
                                                @if(!empty($accessArr['invoice'][69]))
                                                <a href="{{url('admin/invoice/'.$issue_id.'/'.$target->id.'/details')}}" target="_blank" class="btn btn-primary btn-sm"  title="@lang('lang.PRINT_INVOICE')"><i class="fas fa-file-invoice"></i></a>
                                                @endif
                                                @if(!empty($accessArr['invoice'][68]))
                                                <a href="{{url('admin/invoice/'.$issue_id.'/'.$target->id.'/edit')}}" class="btn btn-secondary btn-sm"  title="@lang('lang.EDIT')"><i class="fas fa-edit"></i></a>
                                                @endif
                                            </div>

                                            @if(!empty($accessArr['invoice'][70]))
                                            <div style="float: left;">
                                                {!!Form::open(['route'=>['invoice.destroy',[$issue_id,'id'=>$target->id]]])!!}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm deleteBtn" title="@lang('lang.DELETE')"><i class="fa fa-trash"></i></button>
                                                {!!Form::close()!!}
                                            </div> 
                                            @endif
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
