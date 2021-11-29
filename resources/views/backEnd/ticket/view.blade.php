@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.TICKET')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.VIEW_TICKET')</h3>
                            <div class="float-right">
                                <a href="{{url('admin/ticket-entry/'.$target->id.'/view?view=print')}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/ticket-entry/'.$target->id.'/view?view=pdf')}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>
                                <a href="{{url('admin/ticket-entry/'.$target->id.'/view?view=excel')}}" class="btn btn-success"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <table class="table table-bordered" id='Target'>
                                    <tbody>
                                        <tr>
                                            <td><strong>@lang('lang.CUSTOMER_CODE')</strong> </td>
                                            <td>{{$target->customer_code ?? ''}}</td>
                                        </tr>

                                        @if(!empty($target->country_id))
                                        <tr>
                                            <td><strong>@lang('lang.COUNTRY')</strong> </td>
                                            <td>{{$countries[$target->country_id]}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->type_id))
                                        <tr>
                                            <td><strong>@lang('lang.ENTRY_TYPE')</strong> </td>
                                            <td>{{$entryTypes[$target->type_id]??''}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->year))
                                        <tr>
                                            <td><strong>@lang('lang.YEAR')</strong> </td>
                                            <td>{{$target->year}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->name))
                                        <tr>
                                            <td><strong>@lang('lang.NAME')</strong> </td>
                                            <td>{{$target->name}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->issue_date))
                                        <tr>
                                            <td><strong>@lang('lang.ISSUE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->issue_date)}}</td>
                                        </tr>
                                        @endif



                                        @if(!empty($target->agent))
                                        <tr>
                                            <td><strong>@lang('lang.AGENT')</strong> </td>
                                            <td>{{$target->agent}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->ticket_no))
                                        <tr>
                                            <td><strong>@lang('lang.TICKET_NO')</strong> </td>
                                            <td>{{$target->ticket_no}}</td>
                                        </tr>
                                        @endif 

                                        @if(!empty($target->fly_from))
                                        <tr>
                                            <td><strong>@lang('lang.FLYING_FROM')</strong> </td>
                                            <td>{{$target->fly_from}}</td>
                                        </tr>
                                        @endif 

                                        @if(!empty($target->fly_to))
                                        <tr>
                                            <td><strong>@lang('lang.FLYING_TO')</strong> </td>
                                            <td>{{$target->fly_to}}</td>
                                        </tr>
                                        @endif   

                                        @if(!empty($target->carrier))
                                        <tr>
                                            <td><strong>@lang('lang.CARRIER')</strong> </td>
                                            <td>{{$target->carrier}}</td>
                                        </tr>
                                        @endif   


                                        @if(!empty($target->flying_date))
                                        <tr>
                                            <td><strong>@lang('lang.FLYING_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->flying_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->fly_type))
                                        <tr>
                                            <td><strong>@lang('lang.FLYING_TYPE')</strong> </td>
                                            <td>{{$target->fly_type == 'one_way' ? 'one way' : 'return'}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->takeoff_time))
                                        <tr>
                                            <td><strong>@lang('lang.TAKE_OFF_TIME')</strong> </td>
                                            <td>{{Helper::timeFormat($target->takeoff_time)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->landing_time))
                                        <tr>
                                            <td><strong>@lang('lang.LANDING_TIME')</strong> </td>
                                            <td>{{Helper::timeFormat($target->landing_time)}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($target->fare))
                                        <tr>
                                            <td><strong>@lang('lang.FARE')</strong> </td>
                                            <td>{{$target->fare}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->tax))
                                        <tr>
                                            <td><strong>@lang('lang.TAX')</strong> </td>
                                            <td>{{$target->tax}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($target->tax_type))
                                        <tr>
                                            <td><strong>@lang('lang.TAX_TYPE')</strong> </td>
                                            <td>{{$target->tax_type == '1' ? 'TK' : 'Percentage' }}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($target->fare_with_tax))
                                        <tr>
                                            <td><strong>@lang('lang.FARE_WITH_TAX')</strong> </td>
                                            <td>{{$target->fare_with_tax}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($target->ait_percentage))
                                        <tr>
                                            <td><strong>@lang('lang.AIT')</strong> </td>
                                            <td>{{$target->ait_percentage}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->ait_tax))
                                        <tr>
                                            <td><strong>@lang('lang.AIT_TAX')</strong> </td>
                                            <td>{{$target->ait_tax}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->commission))
                                        <tr>
                                            <td><strong>@lang('lang.COMMISSION')</strong> </td>
                                            <td>{{$target->commission}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->commission_type))
                                        <tr>
                                            <td><strong>@lang('lang.COMMISSION_TYPE')</strong> </td>
                                            <td>{{$target->commission_type == '1' ? 'TK' : 'Percentage'}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($target->net_fare))
                                        <tr>
                                            <td><strong>@lang('lang.NET_FARE')</strong> </td>
                                            <td>{{$target->net_fare}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td><strong>@lang('lang.CREATED_AT')</strong> </td>
                                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <h4 style="text-align: center;margin-top: 0px;">Document Management</h4>
                                        <div class = "form-group">
                                            <div class ="table-responsive">
                                                <table class ="table table-bordered" id="dynamic_field">
                                                    <thead>
                                                    <th>File</th>
                                                    <th>Caption</th>
                                                    <th>Serial</th>
                                                    <th>Status</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $files = $target->attachments;
                                                        $totalFile = count($files);
                                                        ?>
                                                        @if($totalFile > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach($files as $file)
                                                        <?php
                                                        $i++;
                                                        $fileExt = explode('.', $file->doc_name);
                                                        ?>
                                                        <tr class="numbar">
                                                            @if(!empty($file->doc_name) && end($fileExt) == 'pdf')
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/pdf.png')}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @elseif(!empty($file->doc_name) && end($fileExt) == 'doc')
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/doc.png')}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @else
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah{{$i-1}}" class="img-thambnail" src="{{asset($file->doc_name)}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @endif
                                                            <td>{{$file->title}}</td>
                                                            <td>{{$file->serial}}</td>
                                                            @if($file->status == '1')
                                                            <td><button  class="btn btn-success">Active</button></td>
                                                            @else
                                                            <td><button  class="btn btn-danger">Inactive</button></td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a type="button" href="#" onclick="window.history.back()" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

