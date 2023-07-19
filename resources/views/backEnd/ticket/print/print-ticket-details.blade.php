@if($request->view == 'print' || $request->view == 'pdf')
<html>
    <head>
        <title>@lang('lang.TICKET_DETAILS')</title>

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
        @endif
        <table>
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








