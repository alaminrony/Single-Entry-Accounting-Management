@if($request->view == 'print' || $request->view == 'pdf')
<html>
    <head>
        <title>@lang('lang.VISA_DETAILS')</title>

        @if(Request::get('view') == 'print')
        <link rel="shortcut icon" href="{{URL::to('/')}}/public/img/favicon.ico" />
        <link href="{{asset('backend/dist/css/downloadPdfPrint/print.css')}}" rel="stylesheet" type="text/css" />

        @elseif(Request::get('view') == 'pdf')
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" href="{!! base_path() !!}/public/img/favicon.ico" />
        <link href="{{ base_path().'/public/backend/dist/css/downloadPdfPrint/print.css'}}" rel="stylesheet" type="text/css"/>
        <link href="{{ base_path().'/public/backend/dist/css/downloadPdfPrint/pdf.css'}}" rel="stylesheet" type="text/css"/>
        @endif
    </head>
    <body>
        <!--        <div class="header">
                    <div class="logoRetail">
                        @if(Request::get('view') == 'pdf')
                        <img src="{!! base_path() !!}/public/img/retail_logo.png" /> 
                        @else
                        <img src="{!! asset('public/img/retail_logo.png') !!}"  /> 
                        @endif
                    </div>
                    <div class="logoTile">
                        <span>@lang('lang.VISA_ENTRY')</span>
                    </div>
                    <div class="logoCityBank">
                        @if(Request::get('view') == 'pdf')
                        <img src="{!! base_path() !!}/public/img/logo.png"/> 
                        @else
                        <img src="{!! asset('public/img/logo.png') !!}"  />
                        @endif
                    </div>
                </div>-->
        @endif
        <!--Laravel Excel not supported body & other tags, only Table tag accepted-->
        <table class="table table-bordered">
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
        <!--Laravel Excel not supported  body & other tags, only Table tag accepted-->


        @if($request->view == 'print' || $request->view == 'pdf')
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-4">
                    <p>@lang('lang.REPORT_GENERATED_ON') {{ Helper::dateFormat(date('Y-m-d H:i:s')).' by '.Auth::user()->name}}</p>
                </div>
            </div>
            <div class="col-md-8 print-footer">
                <p><b>Thanks for being with {{$settingArr['company_name'] ?? 'Rafiq & Sons'}}</b></p>
            </div>
        </div>

    </body>
    <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}" type="text/javascript"></script>
    <script>
$(document).ready(function () {
    window.print();
});
    </script>
</html>
@endif








