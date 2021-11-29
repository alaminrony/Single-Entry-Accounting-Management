<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> {!!__('lang.UPDATE_TRANSACTION')!!}</h4>
    </div>
    <div class="modal-body">
        {!!Form::open(['id'=>'updateFormData','class'=>'form-horizontal'])!!}
        {!!Form::hidden('bank_ledgers_id',$target->id)!!}
        <div class="card-body">
            <div class="form-group row">
                <label for="transaction_type" class="col-sm-4 col-form-label">@lang('lang.TRANSACTION_TYPE') :</label>
                <div class="col-sm-8">
                    {!!Form::text('transaction_type_dummy',$transactionTypeArr[$target->transaction_type],['class'=>'form-control','readonly'])!!}
                    {!!Form::select('transaction_type',$transactionTypeArr,$target->transaction_type,['class'=>'form-control d-none'])!!}
                    <span class="text-danger" id="edit_transaction_type_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="amount" class="col-sm-4 col-form-label">@lang('lang.AMOUNT') :</label>
                <div class="col-sm-8">
                    {!!Form::text('amount',$target->amount,['class'=>'form-control','id'=>'amount'])!!}
                    <span class="text-danger" id="edit_amount_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="note" class="col-sm-4 col-form-label">@lang('lang.NOTE') :</label>
                <div class="col-sm-8">
                    {!!Form::textarea('note',$target->note,['class'=>'form-control','id'=>'note','style'=>'height:100px;'])!!}
                    <span class="text-danger" id="note_error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <fieldset class="w-100">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" id="update" class="btn btn-secondary float-right" >Update</button>
        </fieldset>
    </div>
    {!!Form::close()!!}
</div>



