@if($request->view == 'print' || $request->view == 'pdf')
<html>
    <head>
        <title>@lang('lang.PACKAGE_DETAILS')</title>

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
        <table>
            <tbody>
                @if(!empty($target->name))
                <tr>
                    <td><strong>@lang('lang.PACKAGE_NAME')</strong> </td>
                    <td>{{$target->name}}</td>
                </tr>
                @endif

                @if(!empty($target->from))
                <tr>
                    <td><strong>@lang('lang.FROM')</strong> </td>
                    <td>{{$target->from}}</td>
                </tr>
                @endif

                @if(!empty($target->to))
                <tr>
                    <td><strong>@lang('lang.TO')</strong> </td>
                    <td>{{$target->to}}</td>
                </tr>
                @endif

                @if(!empty($target->adult))
                <tr>
                    <td><strong>@lang('lang.NUM_OF_ADULT')</strong> </td>
                    <td>{{$target->adult}}</td>
                </tr>
                @endif

                @if(!empty($target->children))
                <tr>
                    <td><strong>@lang('lang.NUM_OF_CHILDREN')</strong> </td>
                    <td>{{$target->children}}</td>
                </tr>
                @endif

                @if(!empty($target->hotel))
                <tr>
                    <td><strong>@lang('lang.HOTEL')</strong> </td>
                    <td>{{$target->hotel}}</td>
                </tr>
                @endif

                @if(!empty($target->hotel_type))
                <tr>
                    <td><strong>@lang('lang.HOTEL_TYPE')</strong> </td>
                    <td>{{$hotelType[$target->hotel_type]??''}}</td>
                </tr>
                @endif

                @if(!empty($target->hotel_cost))
                <tr>
                    <td><strong>@lang('lang.HOTEL_COST')</strong> </td>
                    <td>{{$target->hotel_cost}}</td>
                </tr>
                @endif 

                @if(!empty($target->air))
                <tr>
                    <td><strong>@lang('lang.AIR')</strong> </td>
                    <td>{{$target->air}}</td>
                </tr>
                @endif 

                @if(!empty($target->ticket_cost))
                <tr>
                    <td><strong>@lang('lang.TICKET_COST')</strong> </td>
                    <td>{{$target->ticket_cost}}</td>
                </tr>
                @endif   

                @if(!empty($target->carrier))
                <tr>
                    <td><strong>@lang('lang.CARRIER')</strong> </td>
                    <td>{{$target->carrier}}</td>
                </tr>
                @endif   


                @if(!empty($target->tour_guide))
                <tr>
                    <td><strong>@lang('lang.TOUR_GUIDE')</strong> </td>
                    <td>{{$target->tour_guide}}</td>
                </tr>
                @endif

                @if(!empty($target->guide_cost))
                <tr>
                    <td><strong>@lang('lang.GUIDE_COST')</strong> </td>
                    <td>{{$target->guide_cost}}</td>
                </tr>
                @endif


                @if(!empty($target->total_dayes))
                <tr>
                    <td><strong>@lang('lang.TOTAL_DAYS')</strong> </td>
                    <td>{{$target->total_dayes}}</td>
                </tr>
                @endif

                @if(!empty($target->transportation))
                <tr>
                    <td><strong>@lang('lang.TRANSPORTATION')</strong> </td>
                    <td>{{$target->transportation}}</td>
                </tr>
                @endif


                @if(!empty($target->transport_cost))
                <tr>
                    <td><strong>@lang('lang.TRANSPORT_COST')</strong> </td>
                    <td>{{$target->transport_cost}}</td>
                </tr>
                @endif

                @if(!empty($target->other_cost))
                <tr>
                    <td><strong>@lang('lang.OTHER_COST')</strong> </td>
                    <td>{{$target->other_cost}}</td>
                </tr>
                @endif

                @if(count($moreCosts) > 0)
                <?php $i = 0; ?>
                @foreach($moreCosts as $cost)
                <?php $i++; ?>
                <tr>
                    <td><strong>@lang('lang.MORE_COST') {{$i}}</strong> </td>
                    <td>
                        <strong>Title:</strong> {{$cost->title}} <strong>Amount:</strong> {{$cost->amount}}
                    </td>
                </tr>
                @endforeach
                @endif

                @if(!empty($target->total_package_cost))
                <tr>
                    <td><strong>@lang('lang.TOTAL_PACKAGE_COST')</strong> </td>
                    <td>{{$target->total_package_cost}}</td>
                </tr>
                @endif
                @if(!empty($target->note))
                <tr>
                    <td><strong>@lang('lang.NOTE')</strong> </td>
                    <td>{{$target->note}}</td>
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








