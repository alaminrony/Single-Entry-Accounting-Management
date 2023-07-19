@if($request->view == 'print' || $request->view == 'pdf')
<html>
    <head>
        <title>@lang('lang.TICKET_ENTRY')</title>

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
        <!--Laravel Excel not supported body & other tags, only Table tag accepted-->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>@lang('lang.CUSTOMER_CODE')</th>
                    <th>@lang('lang.COUNTRY')</th>
                    <th>@lang('lang.ENTRY_TYPE')</th>
                    <th>@lang('lang.YEAR')</th>
                    <th>@lang('lang.NAME')</th>
                    <th>@lang('lang.ISSUE_DATE')</th>
                    <th>@lang('lang.AGENT')</th>
                    <th>@lang('lang.TICKET_NO')</th>
                    <th>@lang('lang.FLYING_FROM')</th>
                    <th>@lang('lang.FLYING_TO')</th>
                    <th>@lang('lang.CARRIER')</th>
                    <th>@lang('lang.FLYING_DATE')</th>
                    <th>@lang('lang.FLYING_TYPE')</th>
                    <th>@lang('lang.TAKE_OFF_TIME')</th>
                    <th>@lang('lang.LANDING_TIME')</th>
                    <th>@lang('lang.FARE')</th>
                    <th>@lang('lang.TAX')</th>
                    <th>@lang('lang.TAX_TYPE')</th>
                    <th>@lang('lang.FARE_WITH_TAX')</th>
                    <th>@lang('lang.AIT')</th>
                    <th>@lang('lang.AIT_TAX')</th>
                    <th>@lang('lang.COMMISSION')</th>
                    <th>@lang('lang.COMMISSION_TYPE')</th>
                    <th>@lang('lang.NET_FARE')</th>
                    <th>@lang('lang.CREATED_AT')</th>
                </tr>
            </thead>
            <tbody>
                @if($targets->isNotEmpty())
                <?php $i = 0; ?>
                @foreach($targets as $target)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$target->customer_code ?? ''}}</td>
                    <td>{{$countries[$target->country_id] ?? ''}}</td>
                    <td>{{$entryTypes[$target->type_id]??''}}</td>
                    <td>{{$target->year}}</td>
                    <td>{{$target->name}}</td>
                    <td>{{Helper::dateFormat2($target->issue_date)}}</td>
                    <td>{{$users[$target->agent] ?? ''}}</td>
                    <td>{{$target->ticket_no}}</td>
                    <td>{{$target->fly_from}}</td>
                    <td>{{$target->fly_to}}</td>
                    <td>{{$target->carrier}}</td>
                    <td>{{Helper::dateFormat2($target->flying_date)}}</td>
                    <td>{{$flyingTypes[$target->fly_type] ?? ''}}</td>
                    <td>{{Helper::timeFormat($target->takeoff_time)}}</td>
                    <td>{{Helper::timeFormat($target->landing_time)}}</td>
                    <td>{{$target->fare}}</td>
                    <td>{{$target->tax}}</td>
                    <td>{{$taxTypes[$target->tax_type] ?? ''}}</td>
                    <td>{{$target->fare_with_tax}}</td>
                    <td>{{$target->ait_percentage}}</td>
                    <td>{{$target->ait_tax}}</td>
                    <td>{{$target->commission}}</td>
                    <td>{{$commissionTypes[$target->commission_type] ?? ''}}</td>
                    <td>{{$target->net_fare}}</td>
                    <td>{{Helper::dateFormat($target->created_at)}}</td>
                </tr>
                @endforeach
                @else
                <tr>No Data Found</tr>
                @endif
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








