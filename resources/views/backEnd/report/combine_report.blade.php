@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="DivIdToPrint">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.COMBINE_REPORT') Of ({{$applicationDetails->customer_code??''}}) </h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right mr-2">
                        <a class="btn btn-secondary btn-sm openCreateModal" type="button" id='btn' onclick="printDiv();"><i class="fa fa-print"> @lang('lang.PRINT')</i></a>
                    </div>
                </div>
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-6">
                        <table class="table table-bordered bg-light">
                            <thead>
                                <tr>
                                    <td><label>@lang('lang.BILL_TO')</label></td>
                                    <td> <label>@lang('lang.INVOICE_NO')</label></td>
                                    <td> <label>@lang('lang.INVOICE_AMOUNT')</label></td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($invoices->isNotEmpty())
                                <?php
                                $total_invoice_amount = 0;
                                ?>
                                @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$users[$invoice->bill_to] ?? 'N/A'}} TK</td>
                                    <td>{{$invoice->invoice_code}} TK</td>
                                    <td>{{$invoice->total_amount}} TK</td>
                                </tr>
                                <?php
                                $total_invoice_amount = $total_invoice_amount + ($invoice->total_amount ?? 0);
                                ?>
                                @endforeach
                                @endif
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="3"><h5>Total Invoice Amount :{{$total_invoice_amount ?? 0}} TK</h5></td>
                                </tr>
                            </tbody>
                        </table>

                        </div>
                        <div class="col-md-6">
                        <table class="table table-bordered bg-light">
                            <thead>
                                <tr>
                                    <td><label>@lang('lang.PARTY')</label></td>
                                    <td><label>@lang('lang.TRANSACTION')</label></td>
                                    <td> <label>@lang('lang.AMOUNT')</label></td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($transactions->isNotEmpty())
                                <?php
                                $total_tr_in = 0;
                                $total_tr_out = 0;
                                ?>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$users[$transaction->user_id] ?? ''}} TK</td>
                                    <td>Cash {{$transaction->transaction_type}}</td>
                                    <td>{{$transaction->amount}} TK</td>
                                </tr>
                                <?php
                                if($transaction->transaction_type == 'in'){
                                    $total_tr_in = $total_tr_in + $transaction->amount;
                                }else{
                                    $total_tr_out = $total_tr_out + $transaction->amount;
                                }
                                ?>
                                @endforeach
                                @endif
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <h5>Total Cash In :{{$total_tr_in ?? 0}} TK</h5>
                                        <h5>Total Cash Out :{{$total_tr_out ?? 0}} TK</h5>
                                        <h5>Total Profit :{{($total_tr_in ?? 0) - ($total_tr_out ?? 0)}} TK</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('script')
<script>
    function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>
@endpush



