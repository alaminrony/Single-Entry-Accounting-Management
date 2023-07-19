@if($request->view == 'print' || $request->view == 'pdf')
<html>
    <head>
        <title>@lang('lang.VISA_ENTRY')</title>

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
            <thead>
                <tr>
                    <th>SL</th>
                    <th>@lang('lang.CUSTOMER_CODE')</th>
                    <th>@lang('lang.COUNTRY')</th>
                    <th>@lang('lang.ENTRY_TYPE')</th>
                    <th>@lang('lang.YEAR')</th>
                    <th>@lang('lang.NAME')</th>
                    <th>@lang('lang.PASSPORT_NO')</th>
                    <th>@lang('lang.FAW')</th>
                    <th>@lang('lang.PASSPORT_ISSUE_DATE')</th>
                    <th>@lang('lang.PASSPORT_RECEIVE_DATE')</th>
                    <th>@lang('lang.PASSPORT_EXPIRY_DATE')</th>
                    <th>@lang('lang.SEND_DATE')</th>
                    <th>@lang('lang.VILLAGE')</th>
                    <th>@lang('lang.POST')</th>
                    <th>@lang('lang.POLICE_STATION')</th>
                    <th>@lang('lang.DISTRICT')</th>
                    <th>@lang('lang.PROFESSION')</th>
                    <th>@lang('lang.MOBILE_NO')</th>
                    <th>@lang('lang.DELIVERY_DATE')</th>
                    <th>@lang('lang.DATE_OF_BIRTH')</th>
                    <th>@lang('lang.NID')</th>
                    <th>@lang('lang.OTHER_INFORMATION')</th>
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
                    <td>{{$entryTypes[$target->type_id] ?? ''}}</td>
                    <td>{{$target->year ?? ''}}</td>
                    <td>{{$target->name?? ''}}</td>
                    <td>{{$target->passport_no?? ''}}</td>
                    <td>{{$target->father_name ?? ''}}</td>
                    <td>{{Helper::dateFormat2($target->passport_issue_date)}}</td>
                    <td>{{Helper::dateFormat2($target->passport_recieve_date)}}</td>
                    <td>{{Helper::dateFormat2($target->passport_expiry_date)}}</td>
                    <td>{{Helper::dateFormat2($target->passport_send_date)}}</td>
                    <td>{{$target->village ?? ''}}</td>
                    <td>{{$target->post_office ?? ''}}</td>
                    <td>{{$thanas[$target->police_station]??''}}</td>
                    <td>{{$districts[$target->district]??''}}</td>
                    <td>{{$target->profession ?? ''}}</td>
                    <td>{{$target->mobile_no ?? ''}}</td>
                    <td>{{Helper::dateFormat2($target->dob)}}</td>
                    <td>{{$target->nid_no ?? ''}}</td>
                    <td>{{$target->other_information ?? ''}}</td>
                    <td>{{Helper::dateFormat($target->created_at)}}</td>
                </tr>
                @endforeach
                @else
                <tr>No Data Found</tr>
                @endif
            </tbody>
        </table>
        <!--Laravel Excel does not supported  body & other tags, only Table tag accepted-->


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








