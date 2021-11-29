@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.TRANSACTION_LIST') Of {{$applicationDetails->name??''}} @unless($issue_id == '5') ({{$applicationDetails->customer_code??''}}) @endunless</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right mr-2">
                        <a type="button" class="btn btn-secondary btn-sm openCreateModal" data-id="{{!empty($application_id)? $application_id : ''}}" data-issue="{{!empty($issue_id)? $issue_id : ''}}" data-toggle="modal" title="@lang('lang.TRANSACTION')" data-target="#viewCreateModal"><i class="fa fa-exchange-alt"> @lang('lang.CREATE_TRANSACTION')</i></a>
                    </div>
                </div>
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
            {!!Form::open(['route'=>[$searchFormRoute,$application_id],'method'=>'GET'])!!}
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
                                <a href="{{url('admin/'.$transactionListOf.'/'.$application_id.'/transaction-list?view=print')}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/'.$transactionListOf.'/'.$application_id.'/transaction-list?view=pdf')}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>
                                <a href="{{url('admin/'.$transactionListOf.'/'.$application_id.'/transaction-list?view=excel')}}" class="btn btn-success"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.CREATED_AT')</th>
                                        @if($issue_id == '4')
                                        <th>@lang('lang.TICKET_TYPE')</th>
<!--                                        <th>@lang('lang.NEW_TICKET_NO')</th>-->
                                        @endif
                                        <th>@lang('lang.TRANSACTION_TYPE')</th>
                                        <th>@lang('lang.AMOUNT')</th>
                                        <th>@lang('lang.PARTY')</th>
                                        <th>@lang('lang.PAYMENT_MODE')</th>
                                        <th>@lang('lang.CHEQUE_NO')</th>
                                        <th>@lang('lang.ISSUE')</th>
                                        <th>@lang('lang.BANK_INFO')</th>
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
                                        @if($issue_id == '4')
                                        <td>{{$target->ticket_type}}</td>
                                        <!--<td>{{$target->ticket_type == 'reissue' ? $target->new_ticket_no : $target->deport_ticket_no}}</td>-->
                                        @endif
                                        <td>Cash {{$target->transaction_type}}</td>
                                        <td>{{$target->amount}}</td>
                                        <td>{{$users[$target->user_id]??''}}</td>
                                        <td>{{$target->payment_mode}}</td>
                                        <td>{{$target->cheque_no}}</td>
                                        <td>{{$issues[$target->issue_id]}}</td>
                                        <td width='15%'>{{$bankAccountArr[$target->bank_account_id]??''}}</td>
                                        <td width='15%'>
                                            <div style="float: left;margin-right:4px;">
                                                <!--<a class="btn btn-success" href="{{route('transaction.view',$target->id)}}"><i class="fa fa-eye"></i></a>-->
                                                <a class="btn btn-success btn-sm" href="#" onclick="MyWindow = window.open('{{route('transaction.view',$target->id)}}', 'MyWindow', 'toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;" title="Print Voucher" class="tip btn btn-primary btn-xs" data-original-title="view collection"><i class="fa fa-eye"></i></a>
                                                <a type="button" class="btn btn-warning btn-sm openEditModal" data-id="{{$target->id}}"  data-toggle="modal" title="@lang('lang.TRANSACTION')" data-target="#viewEditModal"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <div style="float: left;">
                                                {!!Form::open(['route'=>['transaction.destroy',$target->id]])!!}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i></button>
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


