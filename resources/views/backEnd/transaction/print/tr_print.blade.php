@if($request->view == 'print' || $request->view == 'pdf')
<html>
    <head>
        <title>@lang('lang.TRANSACTION_LIST')</title>

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
                    <th>@lang('lang.CREATED_AT')</th>
                    @if(isset($issue_id) && $issue_id == '4')
                    <th>@lang('lang.TICKET_TYPE')</th>
                    @endif
                    <th>@lang('lang.TRANSACTION_TYPE')</th>
                    <th>@lang('lang.AMOUNT')</th>
                    <th>@lang('lang.PARTY')</th>
                    <th>@lang('lang.PAYMENT_MODE')</th>
                    <th>@lang('lang.CHEQUE_NO')</th>
                    <th>@lang('lang.ISSUE')</th>
                    <th>@lang('lang.BANK_INFO')</th>
                    <th>@lang('lang.TR_BALANCE')</th>
                </tr>
            </thead>
            <tbody>
                @if($targets->isNotEmpty())
                <?php $i = 0; 
                $balance = 0;
                ?>
                @foreach($targets as $target)
                <?php $i++; 
                if($target->transaction_type == 'in'){
                    $balance = $balance + $target->amount;
                }else{
                    $balance = $balance - $target->amount;
                }
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{Helper::dateFormat($target->created_at)}}</td>
                    @if(isset($issue_id) && $issue_id == '4')
                    <td>{{$target->ticket_type}}</td>
                    @endif
                    <td>Cash {{$target->transaction_type}}</td>
                    <td>{{$target->amount}}</td>
                    <td>{{$users[$target->user_id]??''}}</td>
                    <td>{{$target->payment_mode}}</td>
                    <td>{{$target->cheque_no}}</td>
                    <td>{{$issues[$target->issue_id]}}</td>
                    <td>{{$bankAccountArr[$target->bank_account_id]??''}}</td>
                    <td>{{$balance}}</td>
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








