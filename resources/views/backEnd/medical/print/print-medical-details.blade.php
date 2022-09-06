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

                @if(!empty($target->fit_date))
                <tr>
                    <td><strong>@lang('lang.FIT_DATE')</strong> </td>
                    <td>{{Helper::dateFormat2($target->fit_date)}}</td>
                </tr>
                @endif

                @if(!empty($target->UNFIT_DATE))
                <tr>
                    <td><strong>@lang('lang.UNFIT_DATE')</strong> </td>
                    <td>{{Helper::dateFormat2($target->unfit_date)}}</td>
                </tr>
                @endif

                @if(!empty($target->contact_no))
                <tr>
                    <td><strong>@lang('lang.CONTACT_NO')</strong> </td>
                    <td>{{$target->contact_no}}</td>
                </tr>
                @endif

                @if(!empty($target->contact_purpose))
                <tr>
                    <td><strong>@lang('lang.CONTACT_PURPOSE')</strong> </td>
                    <td>{{$target->contact_purpose}}</td>
                </tr>
                @endif

                @if(!empty($target->contact_person))
                <tr>
                    <td><strong>@lang('lang.CONTACT_PERSON')</strong> </td>
                    <td>{{$target->contact_person}}</td>
                </tr>
                @endif
                @if(!empty($target->center_name))
                <tr>
                    <td><strong>@lang('lang.CENTER_NAME')</strong> </td>
                    <td>{{$target->center_name}}</td>
                </tr>
                @endif
                @if(!empty($target->ref))
                <tr>
                    <td><strong>@lang('lang.REF')</strong> </td>
                    <td>{{$users[$target->ref] ?? ''}}</td>
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








