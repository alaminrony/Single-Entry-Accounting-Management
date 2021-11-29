@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.VISA')</h1>
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
                            <h3 class="card-title">@lang('lang.VIEW_VISA')</h3>
                            <div class="float-right">
                                <a href="{{url('admin/visa-entry/'.$target->id.'/view?view=print')}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/visa-entry/'.$target->id.'/view?view=pdf')}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>
                                <a href="{{url('admin/visa-entry/'.$target->id.'/view?view=excel')}}" class="btn btn-success"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
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
                                            <td>{{$entryTypes[$target->type_id]}}</td>
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

                                        @if(!empty($target->passport_no))
                                        <tr>
                                            <td><strong>@lang('lang.PASSPORT_NO')</strong> </td>
                                            <td>{{$target->passport_no}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->father_name))
                                        <tr>
                                            <td><strong>@lang('lang.FAW')</strong> </td>
                                            <td>{{$target->father_name}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->passport_issue_date))
                                        <tr>
                                            <td><strong>@lang('lang.PASSPORT_ISSUE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->passport_issue_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->passport_recieve_date))
                                        <tr>
                                            <td><strong>@lang('lang.PASSPORT_RECEIVE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->passport_recieve_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->passport_expiry_date))
                                        <tr>
                                            <td><strong>@lang('lang.PASSPORT_EXPIRY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->passport_expiry_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->village))
                                        <tr>
                                            <td><strong>@lang('lang.VILLAGE')</strong> </td>
                                            <td>{{$target->village}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->post_office))
                                        <tr>
                                            <td><strong>@lang('lang.POST')</strong> </td>
                                            <td>{{$target->post_office}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->police_station))
                                        <tr>
                                            <td><strong>@lang('lang.POLICE_STATION')</strong> </td>
                                            <td>{{$thanas[$target->police_station]??''}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->district))
                                        <tr>
                                            <td><strong>@lang('lang.DISTRICT')</strong> </td>
                                            <td>{{$districts[$target->district]??''}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->profession))
                                        <tr>
                                            <td><strong>@lang('lang.PROFESSION')</strong> </td>
                                            <td>{{$target->profession}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->mobile_no))
                                        <tr>
                                            <td><strong>@lang('lang.MOBILE_NO')</strong> </td>
                                            <td>{{$target->mobile_no}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->visa_no))
                                        <tr>
                                            <td><strong>@lang('lang.VISA_NO')</strong> </td>
                                            <td>{{$target->visa_no}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->id_no))
                                        <tr>
                                            <td><strong>@lang('lang.ID_NO')</strong> </td>
                                            <td>{{$target->id_no}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->visa_issue_date))
                                        <tr>
                                            <td><strong>@lang('lang.VISA_ISSUE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->visa_issue_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->visa_expiry_date))
                                        <tr>
                                            <td><strong>@lang('lang.VISA_EXPIRY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->visa_expiry_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->okala_date))
                                        <tr>
                                            <td><strong>@lang('lang.OKALA_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->okala_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->medical_date))
                                        <tr>
                                            <td><strong>@lang('lang.MEDICAL_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->medical_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->medical_card_recieve_date))
                                        <tr>
                                            <td><strong>@lang('lang.MEDICAL_CARD_RECEIVE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->medical_card_recieve_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->medical_expiry_date))
                                        <tr>
                                            <td><strong>@lang('lang.MEDICAL_EXPIRY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->medical_expiry_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->police_clearence_recieve_date))
                                        <tr>
                                            <td><strong>@lang('lang.POLICE_CLEARANCE_RECEIVE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->police_clearence_recieve_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->police_clearence_expiry_date))
                                        <tr>
                                            <td><strong>@lang('lang.POLICE_CLEARANCE_EXPIRY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->police_clearence_expiry_date)}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->mofa_no))
                                        <tr>
                                            <td><strong>@lang('lang.MOFA_NO')</strong> </td>
                                            <td>{{$target->mofa_no}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->mofa_date))
                                        <tr>
                                            <td><strong>@lang('lang.MOFA_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->mofa_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->mofa_expiry_date))
                                        <tr>
                                            <td><strong>@lang('lang.MOFA_EXPIRY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->mofa_expiry_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->delivery_date))
                                        <tr>
                                            <td><strong>@lang('lang.DELIVERY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->delivery_date)}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->delivery_date))
                                        <tr>
                                            <td><strong>@lang('lang.DELIVERY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->delivery_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->man_power_submit_date))
                                        <tr>
                                            <td><strong>@lang('lang.MAN_POWER_SUBMIT_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->man_power_submit_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->man_power_expiry_date))
                                        <tr>
                                            <td><strong>@lang('lang.MAN_POWER_DELIVERY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->man_power_expiry_date)}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->document_sending_date))
                                        <tr>
                                            <td><strong>@lang('lang.DOCUMENT_SENDING_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->document_sending_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->em_submit_date))
                                        <tr>
                                            <td><strong>@lang('lang.EM_SUBMIT_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->em_submit_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->stamping_date))
                                        <tr>
                                            <td><strong>@lang('lang.STAMPING_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->stamping_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->stamping_expiry_date))
                                        <tr>
                                            <td><strong>@lang('lang.STAMPING_EXPIRY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->stamping_expiry_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->training_card_recieve_date))
                                        <tr>
                                            <td><strong>@lang('lang.TRANING_CARD_RECEIVE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->training_card_recieve_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->finger_date))
                                        <tr>
                                            <td><strong>@lang('lang.FINGER_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->finger_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->rl_no))
                                        <tr>
                                            <td><strong>@lang('lang.RL_NO')</strong> </td>
                                            <td>{{$target->rl_no}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->flying_form))
                                        <tr>
                                            <td><strong>@lang('lang.FLYING_FROM')</strong> </td>
                                            <td>{{$target->flying_form}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->flying_to))
                                        <tr>
                                            <td><strong>@lang('lang.FLYING_TO')</strong> </td>
                                            <td>{{$target->flying_to}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->flying_date))
                                        <tr>
                                            <td><strong>@lang('lang.FLYING_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->flying_date)}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->carrier))
                                        <tr>
                                            <td><strong>@lang('lang.CARRIER')</strong> </td>
                                            <td>{{$target->carrier}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->submit_agency))
                                        <tr>
                                            <td><strong>@lang('lang.SUBMIT_AGENCY')</strong> </td>
                                            <td>{{$target->submit_agency}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->ref_agent))
                                        <tr>
                                            <td><strong>@lang('lang.REF_AGENT')</strong> </td>
                                            <td>{{$target->ref_agent}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->other_information))
                                        <tr>
                                            <td><strong>@lang('lang.OTHER_INFORMATION')</strong> </td>
                                            <td>{{$target->other_information}}</td>
                                        </tr>
                                        @endif

                                        @if($notes->isNotEmpty())
                                        @php $i = 0; @endphp
                                        @foreach($notes as $note)
                                        @php $i++; @endphp
                                        <tr>
                                            <td><strong>@lang('lang.NOTE') {{$i}}</strong> </td>
                                            <td>{{$note->note}}</td>
                                        </tr>
                                        @endforeach
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

