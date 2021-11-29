<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> {!!__('lang.EDIT_TRANSACTION')!!}</h4>
    </div>
    <div class="modal-body">
        {!!Form::open(['id'=>'updateFormData','class'=>'form-horizontal'])!!}
        {!!Form::hidden('id',$target->id)!!}
        {!!Form::hidden('application_id',$target->application_id)!!}
        {!!Form::hidden('issue_id',$target->issue_id)!!}

        <div class="card-body">
            @if($target->issue_id == '4')
            <div class="form-group row">
                <label for="transaction_type" class="col-sm-4 col-form-label">@lang('lang.TICKET_TYPE') :</label>
                <div class="col-sm-8">
                    {!!Form::select('ticket_type',$ticketType,$target->ticket_type ?? 'normal',['class'=>'form-control select2','id'=>'ticket_type'])!!}
                    <span class="text-danger" id="ticket_type_error"></span>
                </div>
            </div>
            @endif
            
            @if($issue_id == '5')
            <div class="form-group row">
                <label for="package_id" class="col-sm-4 col-form-label">@lang('lang.PACKAGE_NAME') :</label>
                <div class="col-sm-8">
                    {!!Form::text('package_name',$packageDetails->name,['class'=>'form-control','id'=>'packageId','readonly'])!!}
                    <span class="text-danger" id="package_id_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="passport" class="col-sm-4 col-form-label">@lang('lang.PASSPORT') :</label>
                <div class="col-sm-8">
                    {!!Form::text('passport',$target->passport ?? '',['class'=>'form-control','id'=>'passport'])!!}
                    <span class="text-danger" id="passport_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="mobile" class="col-sm-4 col-form-label">@lang('lang.MOBILE_NO') :</label>
                <div class="col-sm-8">
                    {!!Form::text('mobile',$target->mobile ?? '',['class'=>'form-control','id'=>'mobile'])!!}
                    <span class="text-danger" id="mobile_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">@lang('lang.EMAIL') :</label>
                <div class="col-sm-8">
                    {!!Form::text('email',$target->email ?? '',['class'=>'form-control','id'=>'email'])!!}
                    <span class="text-danger" id="email_error"></span>
                </div>
            </div>
            @endif

            <!-- Reissue Ticket extra field -->
            <div style="display: none;" id='reIssueField'>
                <div class="form-group row">
                    <label for="old_ticket_no" class="col-sm-4 col-form-label">@lang('lang.OLD_TICKET') :</label>
                    <div class="col-sm-8">
                        {!!Form::text('old_ticket_no',$target->old_ticket_no ?? old('old_ticket_no'),['class'=>'form-control','id'=>'old_ticket_no','readonly'])!!}
                        <span class="text-danger" id="old_ticket_no_error"></span>
                    </div>
                </div>
                <div class="form-group row" >
                    <label for="new_ticket_no" class="col-sm-4 col-form-label">@lang('lang.NEW_TICKET') :</label>
                    <div class="col-sm-8">
                        {!!Form::text('new_ticket_no',$target->new_ticket_no ?? old('new_ticket_no'),['class'=>'form-control','id'=>'new_ticket_no'])!!}
                        <span class="text-danger" id="new_ticket_no_error"></span>
                    </div>
                </div>
            </div>
            <!-- End Reissue Ticket extra field -->

            <!-- Deport Ticket extra field -->
            <div style="display: none;" id='deportField'>
                <div class="form-group row">
                    <label for="first_issue_date" class="col-sm-4 col-form-label">@lang('lang.FIRST_ISSUE_DATE') :</label>
                    <div class="col-sm-8">
                        <div class="input-group date" id="first_issue_date" data-target-input="nearest">
                            <input type="text" name='first_issue_date' class="form-control datetimepicker-input" data-target="#first_issue_date" value="{{$target->first_issue_date ?? ''}}" placeholder="yyyy/mm/dd"/>
                            <div class="input-group-append" data-target="#first_issue_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <span class="text-danger" id="first_issue_date_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fly_date" class="col-sm-4 col-form-label">@lang('lang.FLY_DATE') :</label>
                    <div class="col-sm-8">
                        <div class="input-group date" id="fly_date" data-target-input="nearest">
                            <input type="text" name='fly_date' class="form-control datetimepicker-input" data-target="#fly_date" value="{{$target->fly_date ?? ''}}" placeholder="yyyy/mm/dd"/>
                            <div class="input-group-append" data-target="#fly_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <span class="text-danger" id="fly_date_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="return_date" class="col-sm-4 col-form-label">@lang('lang.RETURN_DATE') :</label>
                    <div class="col-sm-8">
                        <div class="input-group date" id="return_date" data-target-input="nearest">
                            <input type="text" name='return_date' class="form-control datetimepicker-input" data-target="#return_date" value="{{$target->return_date ?? ''}}" placeholder="yyyy/mm/dd"/>
                            <div class="input-group-append" data-target="#return_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <span class="text-danger" id="return_date_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="flied_to" class="col-sm-4 col-form-label">@lang('lang.FLIED_TO') :</label>
                    <div class="col-sm-8">
                        {!!Form::text('flied_to',$target->flied_to ?? '',['class'=>'form-control','id'=>'flied_to'])!!}
                        <span class="text-danger" id="flied_to_error"></span>
                    </div>
                </div>
                <div class="form-group row" >
                    <label for="ticket_no" class="col-sm-4 col-form-label">@lang('lang.TICKET_NO') :</label>
                    <div class="col-sm-8">
                        {!!Form::text('ticket_no',$target->ticket_no ?? '',['class'=>'form-control','id'=>'ticket_no'])!!}
                        <span class="text-danger" id="ticket_no_error"></span>
                    </div>
                </div>
                <div class="form-group row" >
                    <label for="deport_ticket_no" class="col-sm-4 col-form-label">@lang('lang.DEPORT_TICKET_NO') :</label>
                    <div class="col-sm-8">
                        {!!Form::text('deport_ticket_no',$target->deport_ticket_no ?? '',['class'=>'form-control','id'=>'deport_ticket_no'])!!}
                        <span class="text-danger" id="deport_ticket_no_error"></span>
                    </div>
                </div>
                <div class="form-group row" >
                    <label for="fare" class="col-sm-4 col-form-label">@lang('lang.FARE') :</label>
                    <div class="col-sm-8">
                        {!!Form::text('fare',$target->fare ?? '',['class'=>'form-control','id'=>'fare'])!!}
                        <span class="text-danger" id="fare_error"></span>
                    </div>
                </div>
            </div>
            <!--End Deport Ticket extra field -->

            <!-- Refund Ticket extra field -->
            <div style="display: none;" id='refundIssueField'>
                <div class="form-group row">
                    <label for="refund_charge" class="col-sm-4 col-form-label">@lang('lang.REFUND_CHARGE') :</label>
                    <div class="col-sm-8">
                        {!!Form::text('refund_charge',$target->refund_charge?? '',['class'=>'form-control','id'=>'refund_charge'])!!}
                        <span class="text-danger" id="refund_charge_error"></span>
                    </div>
                </div>
            </div>
            <!-- End Refund Ticket extra field -->

            <div class="form-group row">
                <label for="transaction_type" class="col-sm-4 col-form-label">@lang('lang.TRANSACTION_TYPE') :</label>
                <div class="col-sm-8">
                    {!!Form::select('transaction_type',$transactionTypeArr,$target->transaction_type??'',['class'=>'form-control select2','id'=>'transactionType'])!!}
                    <span class="text-danger" id="transaction_type_error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="user_id" class="col-sm-4 col-form-label">@lang('lang.PARTY') :</label>
                <div class="input-group date col-md-8"  data-target-input="nearest">
                    {!!Form::select('user_id',$users,$target->user_id??'',['class'=>'form-control','id'=>'User']) !!}
                    <div class="input-group-append">
                        <a type="button" class="input-group-text bg-secondary openUserCreateModal" data-toggle="modal" title="@lang('lang.VIEW_ISSUE')" data-target="#viewUserCreateModal"><i class="fa fa-plus-square"></i></a>
                    </div>
                    <span class="text-danger" id="user_id_error"></span>
                </div>
            </div>
            
            @if($issue_id == '5')
            <div class="form-group row">
                <label for="num_of_package" class="col-sm-4 col-form-label">@lang('lang.NUMBER_OF_PACKAGE') :</label>
                <div class="col-sm-8">
                    {!!Form::text('num_of_package',$target->num_of_package ?? '',['class'=>'form-control','id'=>'numOfPackage'])!!}
                    <span class="text-danger" id="num_of_package_error"></span>
                </div>
            </div>
            @endif
            
            <div class="form-group row">
                <label for="amount" class="col-sm-4 col-form-label">@lang('lang.AMOUNT') :</label>
                <div class="col-sm-8">
                    {!!Form::text('amount',$target->amount??'',['class'=>'form-control','id'=>'amount'])!!}
                    <span class="text-danger" id="amount_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="paymentMode" class="col-sm-4 col-form-label">@lang('lang.PAYMENT_MODE') :</label>
                <div class="col-sm-8">
                    {!!Form::select('payment_mode',$paymentMode,$target->payment_mode??'',['class'=>'form-control','id'=>'paymentMode','data-width'=>'100%']) !!}
                    <span class="text-danger" id="payment_mode_error"></span>
                </div>
            </div>
            <div class="form-group row"  style="display: none;" id="bankAccount">
                <label for="backAccount" class="col-sm-4 col-form-label">@lang('lang.BANK_ACCOUNT') :</label>
                <div class="col-sm-8">
                    {!!Form::select('bank_account_id',$bankAccountArr,$target->bank_account_id??'',['class'=>'form-control select2','data-width'=>'100%']) !!}
                    <span class="text-danger" id="bank_account_id_error"></span>
                </div>
            </div>
            <div class="form-group row"  style="display: none;" id="chequeNo">
                <label for="amount" class="col-sm-4 col-form-label">@lang('lang.CHEQUE_NO') :</label>
                <div class="col-sm-8">
                    {!!Form::text('cheque_no',$target->cheque_no??'',['class'=>'form-control','id'=>'checkNumber','data-width'=>'100%'])!!}
                    <span class="text-danger" id="cheque_no_error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="note" class="col-sm-4 col-form-label">@lang('lang.NOTE') :</label>
                <div class="col-sm-8">
                    {!!Form::textarea('note',$target->note??'',['class'=>'form-control','id'=>'note','style'=>'height:100px;'])!!}
                    <span class="text-danger" id="note_error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <fieldset class="w-100">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" id="update" class="btn btn-secondary float-right" >Save</button>
        </fieldset>
    </div>
    {!!Form::close()!!}
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#first_issue_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#fly_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#return_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        @if($issue_id == '5')
        var totalPackageCost = "{{$packageDetails->total_package_cost}}";
        var numOfPachage = $('#numOfPackage').val();
        if (numOfPachage > '0') {
            var totalAmount = parseFloat(totalPackageCost) * parseFloat(numOfPachage);
            $('#amount').val(totalAmount);
        } else {
            $('#amount').val('');
        }

        $(document).on('keyup', '#numOfPackage', function () {
            var numOfPachage = $('#numOfPackage').val();
            if (numOfPachage > '0') {
                var totalAmount = parseFloat(totalPackageCost) * parseFloat(numOfPachage);
                $('#amount').val(totalAmount);
            } else {
                $('#amount').val('');
            }
        });
        @endif
    });
</script>



