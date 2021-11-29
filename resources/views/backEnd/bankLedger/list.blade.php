<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-list"></i> {!!__('lang.TRANSACTION_LIST')!!}</h4>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <div class="form-group row">
                <label for="transaction_type" class="col-sm-4 col-form-label">@lang('lang.TRANSACTION_TYPE') :</label>
                <div class="col-sm-8">
                    {!!Form::select('transaction_type',$transactionTypeArr,'',['class'=>'form-control','id'=>'transactionType'])!!}
                    <span class="text-danger" id="transaction_type_error"></span>
                </div>
            </div>
            <div>
                <table class="table table-bordered" id='Target'>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>@lang('lang.TRANSACTION_TYPE')</th>
                            <th>@lang('lang.AMOUNT')</th>
                            <th>@lang('lang.NOTE')</th>
                            <th>@lang('lang.CREATED_AT')</th>
                            <th>@lang('lang.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($allDatas->isNotEmpty())
                        <?php $i = 0; ?>
                        @foreach($allDatas as $target)
                        <?php $i++; ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$target->transaction_type}}</td>
                            <td>{{$target->amount}}</td>
                            <td>{{$target->note}}</td>
                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                            <td width='20%'>
                                <div>
                                    <a type="button" class="btn btn-warning openTransEditModal" data-toggle="modal" title="@lang('lang.TRANSACTION_EDIT')" data-target="#viewEditModal" data-id="{{$target->id}}"><i class="fa fa-edit"></i></a>
                                    <a type="button" class="btn btn-danger deleteTrBtn"  title="@lang('lang.TRANSACTION_DELETE')" data-id="{{$target->id}}"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9">No Data Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                
                <table class="table table-bordered" style="display: none;" id='inTarget'>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>@lang('lang.TRANSACTION_TYPE')</th>
                            <th>@lang('lang.AMOUNT')</th>
                            <th>@lang('lang.NOTE')</th>
                            <th>@lang('lang.CREATED_AT')</th>
                            <th>@lang('lang.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($in_targets->isNotEmpty())
                        <?php $i = 0; ?>
                        @foreach($in_targets as $target)
                        <?php $i++; ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$target->transaction_type}}</td>
                            <td>{{$target->amount}}</td>
                            <td>{{$target->note}}</td>
                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                            <td width='20%'>
                                <div>
                                    <a type="button" class="btn btn-warning openTransEditModal" data-toggle="modal" title="@lang('lang.TRANSACTION_EDIT')" data-target="#viewEditModal" data-id="{{$target->id}}"><i class="fa fa-edit"></i></a>
                                    <a type="button" class="btn btn-danger deleteTrBtn"  title="@lang('lang.TRANSACTION_DELETE')" data-id="{{$target->id}}"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9">No Data Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                
                <table class="table table-bordered" style="display: none;" id='outTarget'>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>@lang('lang.TRANSACTION_TYPE')</th>
                            <th>@lang('lang.AMOUNT')</th>
                            <th>@lang('lang.NOTE')</th>
                            <th>@lang('lang.CREATED_AT')</th>
                            <th>@lang('lang.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($out_targets->isNotEmpty())
                        <?php $i = 0; ?>
                        @foreach($out_targets as $target)
                        <?php $i++; ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$target->transaction_type}}</td>
                            <td>{{$target->amount}}</td>
                            <td>{{$target->note}}</td>
                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                            <td width='20%'>
                                <div>
                                    <a type="button" class="btn btn-warning openTransEditModal" data-toggle="modal" title="@lang('lang.TRANSACTION_EDIT')" data-target="#viewEditModal" data-id="{{$target->id}}"><i class="fa fa-edit"></i></a>
                                    <a type="button" class="btn btn-danger deleteTrBtn"  title="@lang('lang.TRANSACTION_DELETE')" data-id="{{$target->id}}"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9">No Data Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <fieldset class="w-100">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <a type="button" href="{{route('bankLedger.index',$bankAccountId)}}" id="update" class="btn btn-secondary float-right" >All Transaction</a>
        </fieldset>
    </div>
</div>




