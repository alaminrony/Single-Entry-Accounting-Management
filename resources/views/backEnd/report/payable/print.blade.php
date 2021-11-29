
<!doctype html>

<html>

    <head>

        <meta charset="utf-8">

        <title>Payable Transaction</title>

        <base href=""/>

        <meta http-equiv="cache-control" content="max-age=0"/>

        <meta http-equiv="cache-control" content="no-cache"/>

        <meta http-equiv="expires" content="0"/>

        <meta http-equiv="pragma" content="no-cache"/>

        <link rel="shortcut icon" href=""/>

        <link href="http://squadron.eposbd.com/themes/default/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <style type="text/css" media="all">

            body { color: #000; }
            #receipt-data {margin-top: 30px}

            #wrapper { max-width: 660px; margin: 0 auto; padding-top: 100px; }

            .btn { border-radius: 0; margin-bottom: 5px; }

            .table, .table tr, .table th, .table td{  
                border: 1px solid #000 !important;
            } 

            .table th {
                background: #f5f5f5;  
                font-size: 11px;
            }

            h3 { margin: 5px 0; }

            .signature {
                margin: 100px 0px 0px 0px;
            } 
            .authorized{
                border: 1px solid #efefef;
                float: right;
                height: 75px;
                padding: 5px 0 0 8px;
                width: 40%;
            }
            .customer{
                border: 1px solid #efefef;
                float: left;
                height: 75px;
                padding: 5px 8px 0 0 ;
                width: 40%;
                margin-left: 3px;
            }
            .authorized > span , .customer > span  {
                border-top: 1px solid #a0a0a1;
            }
            .authorized span { 
                float: right;
            }
            .warranty {
                font-size: 12px;
            }
            #word-of-amount {
                text-transform: uppercase;
                font-size: 11px;
            }
            .hrber {
                border-bottom: 1px solid #000;
                width: 100%; }
            .text{
                margin-top: -125px !important; 
                font-size:11px;
            }
            .inv-logo {
                text-align: center;
            }
            .inv-logo img {
                width: 100%; 
            }
            .row-item1 {
                height: 225px;
            }
            .text-center{
                text-align: center;
            }
            .text-left{
                text-align: left;
            }
            .text-right{
                text-align: right;
            }

            @media print {

                .no-print { display: none; }

                #wrapper { max-width: 680px; width: 100%; min-width: 330px; margin: 0 auto; }
            } 

        </style> 

    </head>



    <body>


        <div id="wrapper">

            <div id="receiptData"> 

                <div id="receipt-data">

                    <div class="text"> 
                        <!--                        <div class="inv-logo"> 
                                                    <img src="http://squadron.eposbd.com/themes/default/assets/images/chalan.png" alt="Computer Squadron" /> 
                                                </div>  -->
                        <h2 style="text-align: center;">@lang('lang.PAYABLE_TRANSACTION')</h2><br>

                        <div style="clear:both;"> </div>
                        <div class="card card-secondary">
                        <div class="card-header">
                            <h4 class="card-title">
                                    Supplier: {{$targets[0]['name']??''}}
                                    
                                    @if(!empty(Request::get('from_date')))
                                    <span class="ml-2">From date: {{Request::get('from_date')}}</span>
                                    @endif

                                    @if(!empty(Request::get('to_date')))
                                    <span class="ml-2">To date: {{Request::get('to_date')}}</span>
                                    @endif
                            </h4>
                        </div>

                        <table class="table table-striped table-bordered" width="800px"> 
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>@lang('lang.CREATED_AT')</th>
                                    <th>@lang('lang.TRANSACTION_TYPE')</th>
                                    <th>@lang('lang.ISSUE')</th>
                                    <th>@lang('lang.CASH_IN')</th>
                                    <th>@lang('lang.CASH_OUT')</th>
                                    <th>@lang('lang.AMOUNT')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($targets as $target)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{Helper::dateFormat($target->created_at)}}</td>
                                    <td>Cash {{$target->transaction_type}}</td>
                                    <td>{{$target->issue_title}}</td>
                                    <td>{{$target->transaction_type == 'in' ? $target->amount : '0.00' }}</td>
                                    <td>{{$target->transaction_type == 'out' ? $target->amount : '0.00'}}</td>
                                    <td>{{number_format($target->balance,2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="text-center"></p>  
                    </div>
                    <div class="signature" >
                        <div class="authorized" ><br><br><span>Authorized Signature</span></div>
                        <div class="customer"><br><br><span>Supplier Signature <span></div>
                                    </div>
                                    <div style="clear:both;"></div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="well well-sm"> 
                                        Thanks for being with <b>@lang('lang.COMPANY_NAME')</b> !!<br>
                                    </div>

                                    </div>

                                    <div style="clear:both;"></div>

                                    </div> 

                                    </div>

                                    <canvas id="hidden_screenshot" style="display:none;">

                                    </canvas>

                                    <div class="canvas_con" style="display:none;"></div>
                                    </body>
                                    </html>
                                    <script src="http://squadron.eposbd.com/themes/default/assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            window.print();
                                        });
                                    </script>