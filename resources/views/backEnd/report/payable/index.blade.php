@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.REPORT')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
   

    @if(!empty($accessArr['report'][72]))
    <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>'payable.filter','method'=>'GET'])!!}
            <input type="hidden" name='filter' value="true">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.SUPPLIER'):</label>
                                {!!Form::select('supplier_id',$suppliers,Request::get('supplier_id'),['class'=>'select2 form-control','id'=>'trType','width'=>'100%']) !!}
                                @if($errors->has('supplier_id'))
                                <span class="text-danger">{{$errors->first('supplier_id')}}</span>
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
                            <h3 class="card-title">@lang('lang.TRANSACTION_LIST')</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.SUPPLIER_NAME')</th>
                                        <th>@lang('lang.GRAND_TOTAL')</th>
                                        <th>@lang('lang.PAID')</th>
                                        <th>@lang('lang.BALANCE')</th>
                                        <th>@lang('lang.ACTION')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 0 ?>
                                    @foreach($targets as $target)
                                    <?php $balanceArr = Helper::balanceCalculation($target->id); ?>
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$target->name}}</td>
                                        <td>{{$balanceArr['in_balances']}}</td>
                                        <td>{{$balanceArr['out_balances']}}</td>
                                        <td>{{number_format($balanceArr['payableBalance'],2)}}</td>
                                        <td>
                                            @if(!empty($accessArr['report'][73]))
                                            <a class="btn btn-warning btn-sm" title="Details" href="{{route('payable.details',$target->id)}}"><i class="fa fa-file"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
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
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();

        $('#fromDate').datetimepicker({
            format: 'YYYY-MM-DD H:i:s'
        });
        $('#toDate').datetimepicker({
            format: 'YYYY-MM-DD H:i:s'
        });
    });
</script>
@endpush
