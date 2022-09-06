@extends('backEnd.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.TICKET')</h1>
                </div>
            </div>
            @include('backEnd.layouts.message')
        </div>
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
                                            <td>{{$users[$target->agent] ?? ''}}</td>
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
                                            <td>{{$flyingTypes[$target->fly_type] ?? ''}}</td>
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
                                            <td>{{$taxTypes[$target->tax_type] ?? ''}}</td>
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
                                            <td>{{$commissionTypes[$target->commission_type] ?? ''}}</td>
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
                                        <h4 style="margin-top: 0px;">Document Management</h4>
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

                                @if($target->reissue->isNotEmpty())
                                <h4 style="margin-top: 0px;">@lang('lang.REISSUE')</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>@lang('lang.REISSUE_DATE')</th>
                                            <th>@lang('lang.CUSTOMER_CODE')</th>
                                            <th>@lang('lang.NAME')</th>
                                            <th>@lang('lang.PREVIOUS_TICKET')</th>
                                            <th>@lang('lang.NEW_TICKET')</th>
                                            <th>@lang('lang.SERVICE_CHARGE')</th>
                                            <th>@lang('lang.REISSUE_CHARGE')</th>
                                            <th>@lang('lang.NET_FARE')</th>
                                            <th>@lang('lang.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($target->reissue as $reissue)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{Helper::dateFormat($reissue->issue_date)}}</td>
                                            <td>{{$reissue->customer_code}}</td>
                                            <td>{{$reissue->name}}</td>
                                            <td>{{$reissue->previous_ticket_no}}</td>
                                            <td>{{$reissue->new_ticket_no}}</td>
                                            <td>{{$reissue->service_charge}}</td>
                                            <td>{{$reissue->reissue_charge}}</td>
                                            <td>{{$reissue->net_fare}}</td>
                                            <td width="20%">
                                                <div class="btn-group">
                                                    <!--<a type="button" class="mr-1 btn btn-secondary btn-sm openOptionCreateModal" data-id="{{$target->id}}" data-issue="4" data-toggle="modal"  title="@lang('lang.DETAILS')" data-target="#viewOptionCreateModal"><i class="fa fa-eye"></i></a>-->
                                                    {!!Form::open(['route'=>['ticketEntry.optionDelete',['ticket_type'=>'reissue','option_id'=>$reissue->id]]])!!}
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm deleteBtn" title="@lang('lang.DELETE')"><i class="fa fa-trash"></i></button>
                                                    {!!Form::close()!!}
                                                </div>  
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif


                                @if($target->refund->isNotEmpty())
                                <h4 style="margin-top: 0px;">@lang('lang.REFUND')</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>@lang('lang.REFUND_TICKET_DATE')</th>
                                            <th>@lang('lang.CUSTOMER_CODE')</th>
                                            <th>@lang('lang.NAME')</th>
                                            <th>@lang('lang.REFUND_TICKET_NO')</th>
                                            <th>@lang('lang.NET_FARE_RECEIVABLE')</th>
                                            <th>@lang('lang.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($target->refund as $refund)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{Helper::dateFormat($refund->returning_ticket_date)}}</td>
                                            <td>{{$refund->customer_code}}</td>
                                            <td>{{$refund->name}}</td>
                                            <td>{{$refund->refund_ticket_number}}</td>
                                            <td>{{$refund->net_fare_refund}}</td>
                                            <td width="20%">
                                                <div class="btn-group">
                                                    <!--<a type="button" class="mr-1 btn btn-secondary btn-sm openOptionCreateModal" data-id="{{$target->id}}" data-issue="4" data-toggle="modal"  title="@lang('lang.DETAILS')" data-target="#viewOptionCreateModal"><i class="fa fa-eye"></i></a>-->
                                                    {!!Form::open(['route'=>['ticketEntry.optionDelete',['ticket_type'=>'refund','option_id'=>$refund->id]]])!!}
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm deleteBtn" title="@lang('lang.DELETE')"><i class="fa fa-trash"></i></button>
                                                    {!!Form::close()!!}
                                                </div>  
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif


                                @if($target->deport->isNotEmpty())
                                <h4 style="margin-top: 0px;">@lang('lang.DEPORTED')</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>@lang('lang.DEPORT_DATE')</th>
                                            <th>@lang('lang.CUSTOMER_CODE')</th>
                                            <th>@lang('lang.NAME')</th>
                                            <th>@lang('lang.DEPORT_TICKET_NO')</th>
                                            <th>@lang('lang.NET_FARE')</th>
                                            <th>@lang('lang.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($target->deport as $deport)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{Helper::dateFormat($deport->deport_date)}}</td>
                                            <td>{{$deport->customer_code}}</td>
                                            <td>{{$deport->name}}</td>
                                            <td>{{$deport->deport_ticket_number}}</td>
                                            <td>{{$deport->net_fare_deport}}</td>
                                            <td width="20%">
                                                <div class="btn-group">
                                                    <!--<a type="button" class="mr-1 btn btn-secondary btn-sm openOptionCreateModal" data-id="{{$target->id}}" data-issue="4" data-toggle="modal"  title="@lang('lang.DETAILS')" data-target="#viewOptionCreateModal"><i class="fa fa-eye"></i></a>-->
                                                    {!!Form::open(['route'=>['ticketEntry.optionDelete',['ticket_type'=>'deport','option_id'=>$deport->id]]])!!}
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm deleteBtn" title="@lang('lang.DELETE')"><i class="fa fa-trash"></i></button>
                                                    {!!Form::close()!!}
                                                </div>  
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                                <!-- /.card-body -->
                                <a type="button" href="#" onclick="window.history.back()" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
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

