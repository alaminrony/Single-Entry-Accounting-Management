@if($request->view == 'print' || $request->view == 'pdf')
<html>
    <head>
        <title>@lang('lang.PACKAGE_ENTRY')</title>

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
                    <th>@lang('lang.PACKAGE_NAME')</th>
                    <th>@lang('lang.TOTAL_PACKAGE_COST')</th>
                    <th>@lang('lang.HOTEL')</th>
                    <th>@lang('lang.TRANSPORTATION')</th>
                    <th>@lang('lang.TOTAL_DAYS')</th>
                    <th>@lang('lang.TOTAL_PERSON')</th>
                </tr>
            </thead>
            <tbody>
                @if($targets->isNotEmpty())
                <?php $i = 0; ?>
                @foreach($targets as $target)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$target->name}}</td>
                    <td>{{$target->total_package_cost ?? 0}}</td>
                    <td>{{$target->hotel}}</td>
                    <td>{{$target->transportation}}</td>
                    <td>{{$target->total_dayes}}</td>
                    <td>{{$target->adult + $target->children}}</td>
                </tr>
                @endforeach
                @else
                <tr>No Data Found</tr>
                @endif
            </tbody>
        </table>


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








