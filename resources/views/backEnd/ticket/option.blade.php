<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> {!!__('lang.CREATE_OTHER_OPTION')!!}</h4>
    </div>
    <div class="modal-body">
        {!!Form::open(['class'=>'form-horizontal','enctype'=>'multipart/form-data','id'=>'saveOptionData'])!!}
        <input type="hidden" name="ticket_application_id" value="{{$target->id}}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="transaction_type" class="col-sm-4 col-form-label">@lang('lang.TICKET_TYPE') :</label>
                        <div class="col-sm-8">
                            {!!Form::select('ticket_type',$ticketType,'normal',['class'=>'form-control select2','id'=>'ticket_type'])!!}
                            <span class="text-danger" id="ticket_type_error"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('lang.CUSTOMER_CODE')</label>
                        {!!Form::text('customer_code',$target->customer_code ?? '',['class'=>'form-control','id'=>'customerCode','readonly'])!!}
                        @if($errors->has('customer_code'))
                        <span class="text-danger">{{$errors->first('customer_code')}}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('lang.NAME')</label>
                        {!!Form::text('name',$target->name ?? '',['class'=>'form-control','id'=>'name','placeholder'=>"Enter name",'readonly'])!!}
                        @if($errors->has('name'))
                        <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 d-none" id="preTicketField">
                    <div class="form-group">
                        <label>@lang('lang.PREVIOUS_TICKET_NO')</label>
                        {!!Form::text('previous_ticket_no',$target->ticket_no ?? '',['class'=>'form-control','id'=>'previous_ticket_no','readonly'])!!}
                        @if($errors->has('previous_ticket_no'))
                        <span class="text-danger">{{$errors->first('previous_ticket_no')}}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 d-none" id="selectTicket">
                    <div class="form-group">
                        <label>@lang('lang.PREVIOUS_TICKET_NO')</label>
                        {!!Form::select('refund_ticket_number',$anotherTicketNoArr,old('refund_ticket_number'),['class'=>'form-control select2','id'=>'refundTicketNumber','data-width'=>'100%','data-app-id'=>$target->id])!!}
                        <span class="text-danger" id="refund_ticket_number_error"></span>
                    </div>
                </div>
            </div>

            <div class="d-none" id="reIssueField">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.NEW_TICKET_NO')</label>
                            {!!Form::text('new_ticket_no',$target->new_ticket_no ?? '',['class'=>'form-control','id'=>'new_ticket_no','placeholder'=>"Enter New ticket no"])!!}
                            <span class="text-danger" id="new_ticket_no_error"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.REISSUE_DATE')</label>
                            <div class="input-group date" id="issue_date" data-target-input="nearest">
                                <input type="text" name='issue_date' class="form-control datetimepicker-input" data-target="#issue_date" value="{{old('issue_date')}}" placeholder="yyyy/mm/dd"/>
                                <div class="input-group-append" data-target="#issue_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @if($errors->has('issue_date'))
                            <span class="text-danger">{{$errors->first('issue_date')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group">
                            <label>@lang('lang.AGENT')</label>
                            <div class="input-group" data-target-input="nearest">
                                {!!Form::select('agent',$agentsArr,'',['class'=>'form-control select2','id'=>'User']) !!}
                                <div class="input-group-append">
                                    <a type="button" class="input-group-text bg-secondary openUserCreateModal" data-toggle="modal"  title="@lang('lang.CREATE_USER')" data-target="#viewUserCreateModal"><i class="fa fa-plus-square"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('lang.FLYING_FROM')</label>
                            {!!Form::select('fly_from',$airports,old('fly_from'),['class'=>'form-control select2','id'=>'fly_from'])!!}
                            @if($errors->has('fly_from'))
                            <span class="text-danger">{{$errors->first('fly_from')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('lang.FLYING_TO')</label>
                            {!!Form::select('fly_to',$airports,old('fly_to'),['class'=>'form-control select2','id'=>'fly_to'])!!}
                            @if($errors->has('fly_to'))
                            <span class="text-danger">{{$errors->first('fly_to')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('lang.CARRIER')</label>
                            {!!Form::text('carrier',old('carrier'),['class'=>'form-control','id'=>'carrier','placeholder'=>"Enter carrier"])!!}
                            @if($errors->has('carrier'))
                            <span class="text-danger">{{$errors->first('carrier')}}</span>
                            @endif
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.FLYING_DATE')</label>
                            <div class="input-group date" id="flying_date" data-target-input="nearest">
                                <input type="text" name='flying_date' placeholder="yyyy/mm/dd" class="form-control datetimepicker-input" data-target="#flying_date" value="{{old('flying_date')}}"/>
                                <div class="input-group-append" data-target="#flying_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @if($errors->has('flying_date'))
                            <span class="text-danger">{{$errors->first('flying_date')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.FLYING_TYPE')</label>
                            {!!Form::select('fly_type',[''=>'--Select Fly type--','one_way'=>'One Way','return'=>'return'],old('fly_type'),['class'=>'form-control select2','id'=>'fly_type'])!!}
                            @if($errors->has('fly_type'))
                            <span class="text-danger">{{$errors->first('fly_type')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.TAKE_OFF_TIME')</label>
                            <div class="input-group date" id="takeoff_time" data-target-input="nearest">
                                <input type="time" name='takeoff_time' class="form-control" data-target="#takeoff_time" value="{{old('takeoff_time')}}"/>
                                <div class="input-group-append" data-target="#takeoff_time"></div>
                            </div>
                            @if($errors->has('takeoff_time'))
                            <span class="text-danger">{{$errors->first('takeoff_time')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.LANDING_TIME')</label>
                            <div class="input-group date" id="landing_time" data-target-input="nearest">
                                <input type="time" name='landing_time' class="form-control" data-target="#landing_time" value="{{old('landing_time')}}"/>
                                <div class="input-group-append" data-target="#landing_time"></div>
                            </div>
                            @if($errors->has('landing_time'))
                            <span class="text-danger">{{$errors->first('landing_time')}}</span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>@lang('lang.FARE')</label>
                            <div class="input-group date" data-target-input="nearest">
                                {!!Form::number('fare','',['class'=>'form-control','id'=>'fare'])!!}
                            </div>
                            @if($errors->has('fare'))
                            <span class="text-danger">{{$errors->first('fare')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.TAX')</label>
                            <div class="input-group" id="landing_time" data-target-input="nearest">
                                {!!Form::number('tax',old('tax'),['class'=>'form-control','id'=>'tax'])!!}
                                {!!Form::select('tax_type',['1'=>'TK','2'=>'%'],'',['class'=>'input-group-append','id'=>'taxTypeId'])!!}
                            </div>
                            @if($errors->has('tax'))
                            <span class="text-danger">{{$errors->first('tax')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.FARE_WITH_TAX')</label>
                            {!!Form::number('fare_with_tax',old('fare_with_tax'),['class'=>'form-control','id'=>'fareWithTax','readonly' => 'true'])!!}
                            @if($errors->has('fare_with_tax'))
                            <span class="text-danger">{{$errors->first('fare_with_tax')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>@lang('lang.AIT')</label>
                            {!!Form::text('ait_percentage',old('ait_percentage'),['class'=>'form-control','id'=>'AitPer'])!!}
                            @if($errors->has('ait_percentage'))
                            <span class="text-danger">{{$errors->first('ait_percentage')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>@lang('lang.AIT_TAX')</label>
                            {!!Form::text('ait_tax',old('ait_tax'),['class'=>'form-control','id'=>'aitTax','readonly' => 'true'])!!}
                            @if($errors->has('ait_tax'))
                            <span class="text-danger">{{$errors->first('ait_tax')}}</span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.COMMISSION')</label>
                            <div class="input-group" id="commission" data-target-input="nearest">
                                {!!Form::text('commission',old('commission'),['class'=>'form-control','id'=>'Commission'])!!}
                                {!!Form::select('commission_type',['1'=>'TK','2'=>'%'],'',['class'=>'input-group-append','id'=>'CommissionType'])!!}
                            </div>
                            @if($errors->has('commission'))
                            <span class="text-danger">{{$errors->first('commission')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.SERVICE_CHARGE')</label>
                            {!!Form::text('service_charge',old('service_charge'),['class'=>'form-control','id'=>'serviceCharge'])!!}
                            @if($errors->has('service_charge'))
                            <span class="text-danger">{{$errors->first('service_charge')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.REISSUE_CHARGE')</label>
                            {!!Form::text('reissue_charge',old('reissue_charge'),['class'=>'form-control','id'=>'reissueCharge'])!!}
                            @if($errors->has('reissue_charge'))
                            <span class="text-danger">{{$errors->first('reissue_charge')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('lang.NET_FARE')</label>
                            {!!Form::text('net_fare',old('net_fare'),['class'=>'form-control','id'=>'netFare','readonly' => 'true'])!!}
                            @if($errors->has('net_fare'))
                            <span class="text-danger">{{$errors->first('net_fare')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="refundField" class="d-none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('lang.TICKET_RETURNING_DATE')</label>
                        <div class="input-group date" id="returning_ticket_date" data-target-input="nearest">
                            <input type="text" name='returning_ticket_date' class="form-control datetimepicker-input" data-target="#returning_ticket_date" value="{{old('returning_ticket_date')}}" placeholder="yyyy/mm/dd"/>
                            <div class="input-group-append" data-target="#returning_ticket_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        @if($errors->has('issue_date'))
                        <span class="text-danger">{{$errors->first('issue_date')}}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <label>@lang('lang.AGENT')</label>
                        <div class="input-group" data-target-input="nearest">
                            {!!Form::select('refund_agent',$agentsArr,'',['class'=>'form-control select2','id'=>'refundAgent']) !!}
                            <div class="input-group-append">
                                <a type="button" class="input-group-text bg-secondary openUserCreateModal" data-toggle="modal"  title="@lang('lang.CREATE_USER')" data-target="#viewUserCreateModal"><i class="fa fa-plus-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('lang.NOTE')</label>
                        {!! Form::textarea('notes', null, ['id' => 'notes', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                        @if($errors->has('notes'))
                        <span class="text-danger">{{$errors->first('notes')}}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('lang.RETURN_DEMURRAGE_CHARGE')</label>
                        {!!Form::number('demurrage_charge',old('demurrage_charge'),['class'=>'form-control','id'=>'demurrage_charge'])!!}
                        @if($errors->has('demurrage_charge'))
                        <span class="text-danger">{{$errors->first('demurrage_charge')}}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('lang.NET_FARE_RECEIVABLE')</label>
                        {!!Form::text('net_fare_refund',old('net_fare_refund'),['class'=>'form-control','id'=>'net_fare_refund','readonly' => 'true'])!!}
                        @if($errors->has('net_fare_refund'))
                        <span class="text-danger">{{$errors->first('net_fare_refund')}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div id="deportField" class="d-none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('lang.DEPORT_DATE')</label>
                        <div class="input-group date" id="deport_date" data-target-input="nearest">
                            <input type="text" name='deport_date' class="form-control datetimepicker-input" data-target="#deport_date" value="{{old('deport_date')}}" placeholder="yyyy/mm/dd"/>
                            <div class="input-group-append" data-target="#deport_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        @if($errors->has('issue_date'))
                        <span class="text-danger">{{$errors->first('issue_date')}}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <label>@lang('lang.AGENT')</label>
                        <div class="input-group" data-target-input="nearest">
                            {!!Form::select('refund_agent',$agentsArr,'',['class'=>'form-control select2','id'=>'refundAgent']) !!}
                            <div class="input-group-append">
                                <a type="button" class="input-group-text bg-secondary openUserCreateModal" data-toggle="modal"  title="@lang('lang.CREATE_USER')" data-target="#viewUserCreateModal"><i class="fa fa-plus-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('lang.DEPORT_DEMURRAGE_CHARGE')</label>
                        {!!Form::number('deport_demurrage_charge',old('deport_demurrage_charge'),['class'=>'form-control','id'=>'deport_demurrage_charge'])!!}
                        @if($errors->has('deport_demurrage_charge'))
                        <span class="text-danger">{{$errors->first('deport_demurrage_charge')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('lang.OTHER_CHARGE')</label>
                        {!!Form::number('other_charge',old('other_charge'),['class'=>'form-control','id'=>'other_charge'])!!}
                        @if($errors->has('other_charge'))
                        <span class="text-danger">{{$errors->first('other_charge')}}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('lang.NET_FARE')</label>
                        {!!Form::text('net_fare_deport',old('net_fare_deport'),['class'=>'form-control','id'=>'net_fare_deport','readonly' => 'true'])!!}
                        @if($errors->has('net_fare_deport'))
                        <span class="text-danger">{{$errors->first('net_fare_deport')}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="modal-footer">
            <fieldset class="w-100">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="saveOption" class="btn btn-secondary float-right" >Save</button>
            </fieldset>
        </div>
        {!!Form::close()!!}
    </div>
</div>





<script type="text/javascript">
    $('.select2').select2();

    $(document).on('click', '.toggle-password', function () {
        $('#hideShowIcon').toggleClass("fa-eye fa-eye-slash");
        var passType = $("#password");
        passType.attr('type') === 'password' ? passType.attr('type', 'text') : passType.attr('type', 'password');
    });

    $('#issue_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#flying_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#returning_ticket_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#deport_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $(document).on('change', '#ticket_type', function () {
        var typeName = $(this).val();
        if (typeName == 'reissue') {
            $('#reIssueField').removeClass('d-none');
            $('#preTicketField').removeClass('d-none');
            $('#selectTicket').addClass('d-none');
            $('#deportField').addClass('d-none');
            $('#refundField').addClass('d-none');
        } else if (typeName == 'refund') {
            $('#preTicketField').addClass('d-none');
            $('#reIssueField').addClass('d-none');
            $('#selectTicket').removeClass('d-none');
            $('#refundField').removeClass('d-none');
            $('#deportField').addClass('d-none');

        } else if (typeName == 'deport') {
            $('#preTicketField').addClass('d-none');
            $('#reIssueField').addClass('d-none');
            $('#refundField').addClass('d-none');
            $('#selectTicket').removeClass('d-none');
            $('#deportField').removeClass('d-none');
        }
    })

    $(document).on('blur', '#demurrage_charge', function () {
        var demurrage_charge = $(this).val();
        var net_fare_refund = $('#net_fare_refund').val();
        var actualFee = parseFloat(net_fare_refund) - parseFloat(demurrage_charge);
        $('#net_fare_refund').val(actualFee);
    })

    $(document).on('keyup blur', '#deport_demurrage_charge', function () {
        var deport_demurrage_charge = $(this).val();
        $('#net_fare_deport').val(deport_demurrage_charge);
    })
    $(document).on('keyup blur', '#other_charge', function () {
        var other_charge = $(this).val();
        var deport_demurrage_charge = $('#deport_demurrage_charge').val();
        if (other_charge != '') {
            $('#net_fare_deport').val(parseFloat(deport_demurrage_charge) + parseFloat(other_charge));
        } else {
            $('#net_fare_deport').val(parseFloat(deport_demurrage_charge));
        }

    })

    $(document).on('change', '#refundTicketNumber', function () {
        var ticketNo = $(this).val();
        var ticketAppId = $(this).attr('data-app-id');
//        alert(ticketAppId);return false;
        if (ticketNo != '') {
            $.ajax({
                url: "{{route('ticketEntry.getTicketPrice')}}",
                type: "post",
                data: {ticket_no: ticketNo, ticket_application_id: ticketAppId},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data.value);
                    $('#net_fare_refund').val(data.value);
                }
            });
        } else {
            $('#net_fare_refund').val('');
        }
    })


    $(document).on('change', '#typeId', function () {
        var typeId = $(this).val();
        var countryId = $('#countryId').val();
        var year = $('#year').val();
        if (countryId != '' && typeId != '' && year != '') {
            $.ajax({
                url: "{{route('ticketEntry.generateCusCode')}}",
                type: "post",
                data: {countryId: countryId, typeId: typeId, year: year},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#customerCode').val(data.data);
                }
            });
        } else {
            $('#customerCode').val('');
        }
    })
    $(document).on('change', '#year', function () {
        var countryId = $('#countryId').val();
        var typeId = $('#typeId').val();
        var year = $(this).val();
        if (countryId != '' && typeId != '' && year != '') {
            $.ajax({
                url: "{{route('ticketEntry.generateCusCode')}}",
                type: "post",
                data: {countryId: countryId, typeId: typeId, year: year},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#customerCode').val(data.data);
                }
            });
        } else {
            $('#customerCode').val('');
        }

    })



    $(document).on('keyup', '#tax', function () {
        var tax = parseFloat($(this).val());
        var taxType = $('#taxTypeId').val();
        var fare = parseFloat($('#fare').val());

        if (tax != '' && taxType != '' && fare != '') {
            if (taxType == '1') {
                var fareWithTax = tax + fare;
            } else {
                var fareWithTax = ((tax * fare) / 100) + fare;
            }
            $('#fareWithTax').val(fareWithTax);
        }
    });
    $(document).on('keyup', '#AitPer', function () {
        var aitPer = parseFloat($(this).val());
        var fareWithTax = parseFloat($('#fareWithTax').val());

        if (aitPer != '' && fareWithTax != '') {
            var aitTax = ((aitPer * fareWithTax) / 100);
            if (!isNaN(aitTax)) {
                $('#aitTax').val(aitTax);
            } else {
                $('#aitTax').val('');
            }
        }
    });


    $(document).on('change', '#taxTypeId', function () {
        var taxType = $(this).val();
        var tax = parseFloat($('#tax').val());
        var fare = parseFloat($('#fare').val());

        if (tax != '' && taxType != '' && fare != '') {
            if (taxType == '1') {
                var fareWithTax = tax + fare;
            } else if (taxType == '2') {
                var fareWithTax = ((tax * fare) / 100) + fare;
            }
            $('#fareWithTax').val(fareWithTax);
        }
    });


    $(document).on('keyup', '#Commission', function () {
        var commission = parseFloat($(this).val());
        var tax = parseFloat($('#tax').val());
        var fareWithTax = parseFloat($('#fareWithTax').val());
        var aitTax = parseFloat($('#aitTax').val());
        if (commission != '') {
            var netFare = (fareWithTax + aitTax) - commission;
            if (!isNaN(netFare)) {
                $('#netFare').val(netFare);
            } else {
                $('#netFare').val('');
            }
        }
    });

    $(document).on('keyup', '#AitPer', function () {
        var aitPer = parseFloat($(this).val());
        var commission = parseFloat($(this).val());
        var tax = parseFloat($('#tax').val());
        var fareWithTax = parseFloat($('#fareWithTax').val());

        if (commission != '') {
            var netFare = (fareWithTax + aitTax) - commission;
            if (!isNaN(netFare)) {
                $('#netFare').val(netFare);
            } else {
                $('#netFare').val('');
            }
        }
    });


    $(document).on('change', '#CommissionType', function () {
        var CommissionType = $(this).val();
        var commission = parseFloat($('#Commission').val());
        var fare = parseFloat($('#fare').val());
        var fareWithTax = parseFloat($('#fareWithTax').val());
        var aitTax = parseFloat($('#aitTax').val());

        if (CommissionType == '1') {
            var netFare = (fareWithTax + aitTax) - commission;
            if (!isNaN(netFare)) {
                $('#netFare').val(netFare);
            } else {
                $('#netFare').val('');
            }
        } else if (CommissionType == '2') {
            var commissionConvertedByTk = (commission * fare) / 100;
            //            console.log(commissionConvertedByTk);return false;
            var netFare = (fareWithTax + aitTax) - commissionConvertedByTk;
            if (!isNaN(netFare)) {
                $('#netFare').val(netFare);
            } else {
                $('#netFare').val('');
            }
        }
    });

    $(document).on('keyup', '#serviceCharge', function () {
        var serviceCharge = parseFloat($(this).val());
        var reissueCharge = parseFloat($('#reissueCharge').val());

        console.log(serviceCharge)
        console.log(reissueCharge)
        if (!isNaN(serviceCharge) && !isNaN(reissueCharge)) {
            var servicePlusReissue = serviceCharge + reissueCharge;
            totalNetFare(servicePlusReissue);
        } else if (!isNaN(serviceCharge)) {
            var servicePlusReissue = serviceCharge;
            totalNetFare(servicePlusReissue);
        } else if (!isNaN(reissueCharge)) {
            var servicePlusReissue = reissueCharge;
            totalNetFare(servicePlusReissue);
        } else {
            totalNetFare();
        }
    });

    $(document).on('keyup', '#reissueCharge', function () {
        var reissueCharge = parseFloat($(this).val());
        var serviceCharge = parseFloat($('#serviceCharge').val());
        if (!isNaN(serviceCharge) && !isNaN(reissueCharge)) {
            var servicePlusReissue = serviceCharge + reissueCharge;
            totalNetFare(servicePlusReissue);
        } else if (!isNaN(reissueCharge)) {
            var servicePlusReissue = reissueCharge;
            totalNetFare(servicePlusReissue);
        } else if (!isNaN(serviceCharge)) {
            var servicePlusReissue = serviceCharge;
            totalNetFare(servicePlusReissue);
        } else {
            totalNetFare();
        }
    });

    function totalNetFare(servicePlusReissue = 0) {

        var CommissionType = $('#CommissionType').val();
        var commission = parseFloat($('#Commission').val());
        var fare = parseFloat($('#fare').val());
        var fareWithTax = parseFloat($('#fareWithTax').val());
        var aitTax = parseFloat($('#aitTax').val());

        if (CommissionType == '1') {
            var netFare = (fareWithTax + aitTax) - commission;
//            console.log(netFare);
//            return false;
            if (!isNaN(netFare)) {
                $('#netFare').val(netFare + servicePlusReissue);
            } else {
                $('#netFare').val('');
            }
        } else if (CommissionType == '2') {
            var commissionConvertedByTk = (commission * fare) / 100;
//            console.log(commissionConvertedByTk);return false;
            var netFare = (fareWithTax + aitTax) - commissionConvertedByTk;
            if (!isNaN(netFare)) {
                $('#netFare').val(netFare + servicePlusReissue);
            } else {
                $('#netFare').val('');
            }
    }
    }

    $(document).on('click', '#saveOption', function () {
        $('#saveOption').prop('disabled', true);
        var data = new FormData($('#saveOptionData')[0]);
        if (data != '') {
            $.ajax({
                url: "{{route('ticketEntry.optionStore')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $("#new_ticket_no_error").text('');
                    $("#refund_ticket_number_error").text('');
                    if (data.errors) {
                        $("#new_ticket_no_error").text(data.errors.new_ticket_no);
                        $("#refund_ticket_number_error").text(data.errors.refund_ticket_number);
                    }
                    if (data.response == "success") {
                        $('#saveOption').prop('disabled', true);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                        $('#viewOptionCreateModal').modal('hide');
                        toastr.success("@lang('lang.TICKET_OPTION_ADDED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
                        //                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
                    }
                }
            });
        }
    });

</script>



