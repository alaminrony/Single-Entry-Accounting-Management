<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> {!!__('lang.CREATE_BANK_LEDGER')!!}</h4>
    </div>
    <div class="modal-body">
        {!!Form::open(['id'=>'createFormData','class'=>'form-horizontal'])!!}
        {!!Form::hidden('bank_account_id',$bank_account_id)!!}
        <div class="card-body">
            <div class="form-group row">
                <label for="transaction_type" class="col-sm-4 col-form-label">@lang('lang.TRANSACTION_TYPE') :</label>
                <div class="col-sm-8">
                    {!!Form::select('transaction_type',$transactionTypeArr,$target->transaction_type??'',['class'=>'form-control'])!!}
                    <span class="text-danger" id="transaction_type_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="amount" class="col-sm-4 col-form-label">@lang('lang.AMOUNT') :</label>
                <div class="col-sm-8">
                    {!!Form::text('amount','',['class'=>'form-control','id'=>'amount'])!!}
                    <span class="text-danger" id="amount_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="note" class="col-sm-4 col-form-label">@lang('lang.NOTE') :</label>
                <div class="col-sm-8">
                    {!!Form::textarea('note','',['class'=>'form-control','id'=>'note','style'=>'height:100px;'])!!}
                    <span class="text-danger" id="note_error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <fieldset class="w-100">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" id="create" class="btn btn-secondary float-right" >Save</button>
        </fieldset>
    </div>
    {!!Form::close()!!}
</div>



