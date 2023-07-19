@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.REPORT_RECEIVABLE') for {{$customerName->name ??''}}</h1>
                </div>
            </div>
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
                                    <td> <label>@lang('lang.TOTAL_INVOICED')</label></td>
                                    <td> <label>@lang('lang.TOTAL_CONTRACT')</label></td>
                                    <td> <label>@lang('lang.TOTAL_PAYABLE')</label></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$totalInvoiced ?? 0}} TK</td>
                                    <td>{{$totalContract ?? 0}} TK</td>
                                    <td>{{$totalInvoiced -$totalContract }} TK</td>
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
            {!!Form::open(['route'=>'receivable.detailsFilter','method'=>'GET'])!!}
            <input type="hidden" name='filter' value="true">
            <input type="hidden" name='customer_id' value="{{$customer_id}}">
            <div class="row">
                <div class="col-md-12 offset-md-1">
                    <div class="row">
                        <div class="col-3">
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
                        <div class="col-3">
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
                                <label></label>
                                <div class="input-group">
                                    <div class="float-right mt-2">
                                        <button type="submit" class="btn btn-warning" title="submit" ><i class="fa fa fa-search"></i> @lang('lang.SUBMIT')</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label></label>
                                <div class="input-group">
                                    <div class="float-right mt-2" style="margin-left: 45%;">
                                        <?php
                                        $from_date = Request::get('from_date');
                                        $to_date = Request::get('to_date');
                                        if (!empty($from_date) && !empty($to_date)) {
                                            $url = 'filter=true' . '&from_date=' . $from_date . '&to_date=' . $to_date;
                                        } else {
                                            $url = '';
                                        }
                                        ?>
                                        <a class="btn btn-warning text-right" href="{{url('admin/account-receivable/'.$customer_id.'/details?'.$url.'&print=true')}}"><i class="fa fa-print"></i></a>
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
                            <h3 class="card-title">
                                <b>
                                    Customer: {{$targets[0]['name']??''}}

                                    @if(!empty(Request::get('from_date')))
                                    <span class="ml-2">From date: {{Request::get('from_date')}}</span>
                                    @endif

                                    @if(!empty(Request::get('to_date')))
                                    <span class="ml-2">To date: {{Request::get('to_date')}}</span>
                                    @endif
                                </b>
                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.CREATED_AT')</th>
                                        <th>@lang('lang.TRANSACTION_TYPE')</th>
                                        <th>@lang('lang.ISSUE')</th>
                                        <th>@lang('lang.CASH_IN')</th>
                                        <th>@lang('lang.CASH_OUT')</th>
                                        <th>@lang('lang.AMOUNT')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($targets as $target)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        <td>Cash {{$target->transaction_type}}</td>
                                        <td>{{$target->issue_title}}</td>
                                        <td>{{$target->transaction_type == 'in' ? $target->amount : '0.00' }}</td>
                                        <td>{{$target->transaction_type == 'out' ? $target->amount : '0.00'}}</td>
                                        <td>{{number_format($target->balance,2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">

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
            format: 'YYYY-MM-DD'
        });
        $('#toDate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
@endpush
