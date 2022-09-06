@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.TICKET_EDIT')</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.TICKET_EDIT')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>


                        {!!Form::open(['route'=>['ticketEntry.update',$target->id],'class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.COUNTRY_CODE')</label>
                                        {!!Form::select('country_id',$countries??'',!empty($target->country_id) ? $target->country_id : old('country_id'),['class'=>'form-control select2','id'=>'countryId'])!!}
                                        @if($errors->has('country_id'))
                                        <span class="text-danger">{{$errors->first('country_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.ENTRY_TYPE')</label>
                                        {!!Form::select('type_id',$entryTypes??'',!empty($target->type_id) ? $target->type_id : old('type_id'),['class'=>'form-control select2','id'=>'typeId'])!!}
                                        @if($errors->has('type_id'))
                                        <span class="text-danger">{{$errors->first('type_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.YEAR')</label>
                                        {!!Form::select('year',$years??'',!empty($target->year) ? $target->year : old('year'),['class'=>'form-control select2','id'=>'year'])!!}
                                        @if($errors->has('year'))
                                        <span class="text-danger">{{$errors->first('year')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.CUSTOMER_CODE')</label>
                                        {!!Form::text('customer_code',!empty($target->customer_code) ? $target->customer_code : old('customer_code'),['class'=>'form-control','id'=>'customerCode','readonly'])!!}
                                        @if($errors->has('customer_code'))
                                        <span class="text-danger">{{$errors->first('customer_code')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.NAME')</label>
                                        {!!Form::text('name',!empty($target->name) ? $target->name : old('name'),['class'=>'form-control','id'=>'name','placeholder'=>"Enter name"])!!}
                                        @if($errors->has('name'))
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.TICKET_NO')</label>
                                        {!!Form::text('ticket_no',!empty($target->ticket_no) ? $target->ticket_no : old('ticket_no'),['class'=>'form-control','id'=>'ticket_no','placeholder'=>"Enter ticket no"])!!}
                                        @if($errors->has('ticket_no'))
                                        <span class="text-danger">{{$errors->first('ticket_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.ISSUE_DATE')</label>
                                        <div class="input-group date" id="issue_date" data-target-input="nearest">
                                            <input type="text" name='issue_date' class="form-control datetimepicker-input" data-target="#issue_date" value="{{!empty($target->issue_date) ? $target->issue_date : old('issue_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#issue_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('issue_date'))
                                        <span class="text-danger">{{$errors->first('issue_date')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.REF_AGENT')</label>
                                        <div class="input-group date"  data-target-input="nearest">
                                            {!!Form::select('agent',$users,!empty($target->agent) ? $target->agent : old('agent'),['class'=>'form-control select2','id'=>'User','data-width'=>'80%']) !!}
                                            <div class="input-group-append">
                                                <a type="button" class="input-group-text bg-secondary openUserCreateModal" data-toggle="modal" title="@lang('lang.CREATE')" data-target="#viewUserCreateModal"><i class="fa fa-plus-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FLYING_FROM')</label>
                                        {!!Form::select('fly_from',$airports,!empty($target->fly_from) ? $target->fly_from : old('fly_from'),['class'=>'form-control select2','id'=>'fly_from'])!!}
                                        @if($errors->has('fly_from'))
                                        <span class="text-danger">{{$errors->first('fly_from')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FLYING_TO')</label>
                                        {!!Form::select('fly_to',$airports,!empty($target->fly_to) ? $target->fly_to : old('fly_to'),['class'=>'form-control select2','id'=>'fly_to'])!!}
                                        @if($errors->has('fly_to'))
                                        <span class="text-danger">{{$errors->first('fly_to')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.CARRIER')</label>
                                        {!!Form::text('carrier',!empty($target->carrier) ? $target->carrier : old('carrier'),['class'=>'form-control','id'=>'carrier','placeholder'=>"Enter carrier"])!!}
                                        @if($errors->has('carrier'))
                                        <span class="text-danger">{{$errors->first('carrier')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FLYING_DATE')</label>
                                        <div class="input-group date" id="flying_date" data-target-input="nearest">
                                            <input type="text" name='flying_date' placeholder="yyyy/mm/dd" class="form-control datetimepicker-input" data-target="#flying_date" value="{{!empty($target->flying_date) ? $target->flying_date : old('flying_date')}}"/>
                                            <div class="input-group-append" data-target="#flying_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('flying_date'))
                                        <span class="text-danger">{{$errors->first('flying_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FLYING_TYPE')</label>
                                        {!!Form::select('fly_type',[''=>'--Select Fly type--','one_way'=>'One Way','return'=>'return'],!empty($target->fly_type) ? $target->fly_type : old('fly_type'),['class'=>'form-control select2','id'=>'fly_type'])!!}
                                        @if($errors->has('fly_type'))
                                        <span class="text-danger">{{$errors->first('fly_type')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.TAKE_OFF_TIME')</label>
                                        <div class="input-group date" id="takeoff_time" data-target-input="nearest">
                                            <input type="time" name='takeoff_time' class="form-control" data-target="#takeoff_time" value="{{!empty($target->takeoff_time) ? $target->takeoff_time : old('takeoff_time')}}"/>
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
                                            <input type="time" name='landing_time' class="form-control" data-target="#landing_time" value="{{!empty($target->landing_time) ? $target->landing_time : old('landing_time')}}"/>
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
                                            {!!Form::number('fare',!empty($target->fare) ? $target->fare : '',['class'=>'form-control','id'=>'fare'])!!}
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
                                            {!!Form::text('tax',!empty($target->tax) ? $target->tax : '',['class'=>'form-control','id'=>'tax'])!!}
                                            {!!Form::select('tax_type',['1'=>'TK','2'=>'%'],!empty($target->tax_type) ? $target->tax_type : '',['class'=>'input-group-append','id'=>'taxTypeId'])!!}
                                        </div>
                                        @if($errors->has('tax'))
                                        <span class="text-danger">{{$errors->first('tax')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FARE_WITH_TAX')</label>
                                        {!!Form::number('fare_with_tax',!empty($target->fare_with_tax) ? $target->fare_with_tax : '',['class'=>'form-control','id'=>'fareWithTax','readonly' => 'true'])!!}
                                        @if($errors->has('fare_with_tax'))
                                        <span class="text-danger">{{$errors->first('fare_with_tax')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>@lang('lang.AIT')</label>
                                        {!!Form::text('ait_percentage',!empty($target->ait_percentage) ? $target->ait_percentage : '',['class'=>'form-control','id'=>'AitPer'])!!}
                                        @if($errors->has('ait_percentage'))
                                        <span class="text-danger">{{$errors->first('ait_percentage')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>@lang('lang.AIT_TAX')</label>
                                        {!!Form::text('ait_tax',!empty($target->ait_tax) ? $target->ait_tax : '',['class'=>'form-control','id'=>'aitTax','readonly' => 'true'])!!}
                                        @if($errors->has('ait_tax'))
                                        <span class="text-danger">{{$errors->first('ait_tax')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.COMMISSION')</label>
                                        <div class="input-group" id="commission" data-target-input="nearest">
                                            {!!Form::text('commission',!empty($target->commission) ? $target->commission : '',['class'=>'form-control','id'=>'Commission'])!!}
                                            {!!Form::select('commission_type',['1'=>'TK','2'=>'%'],!empty($target->commission_type) ? $target->commission_type : '',['class'=>'input-group-append','id'=>'CommissionType'])!!}
                                        </div>
                                        @if($errors->has('commission'))
                                        <span class="text-danger">{{$errors->first('commission')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.SERVICE_CHARGE')</label>
                                        {!!Form::text('service_charge',$target->service_charge ?? old('service_charge'),['class'=>'form-control','id'=>'serviceCharge'])!!}
                                        @if($errors->has('service_charge'))
                                        <span class="text-danger">{{$errors->first('service_charge')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.NET_FARE')</label>
                                        {!!Form::text('net_fare',!empty($target->net_fare) ? $target->net_fare : '',['class'=>'form-control','id'=>'netFare','readonly' => 'true'])!!}
                                        @if($errors->has('net_fare'))
                                        <span class="text-danger">{{$errors->first('net_fare')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10">
                                    <h4 style="text-align: center;margin-top: 0px;">Document Management</h4>
                                    <div class = "form-group">
                                        <div class ="table-responsive">
                                            <table class ="table table-bordered" id="dynamic_field_file">
                                                <thead>
                                                <th>Pre File</th>
                                                <th>File</th>
                                                <th>Caption</th>
                                                <th>Serial</th>
                                                <th>Status</th>
                                                <th></th>
                                                </thead>
                                                <?php
                                                $files = $target->attachments;
                                                $totalFile = count($files);
                                                ?>
                                                @if($totalFile > 0)
                                                <?php $i = 0; ?>
                                                @foreach($files as $file)
                                                <?php
                                                $i++;
                                                $fileExt = explode('.', $file->doc_name);
                                                ?>

                                                <tr id="row{{$i}}">
                                                    @if(!empty($file->doc_name) && end($fileExt) == 'pdf')
                                                    <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/pdf.png')}}" alt="your image" height="70px" width="70px;"></a></td>
                                                    @elseif(!empty($file->doc_name) && end($fileExt) == 'doc')
                                                    <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/doc.png')}}" alt="your image" height="70px" width="70px;"></a></td>
                                                    @else
                                                    <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah{{$i-1}}" class="img-thambnail" src="{{asset($file->doc_name)}}" alt="your image" height="70px" width="70px;"></a></td>
                                                    @endif
                                                    <td><input type="file"  name=doc_name[<?php echo $i - 1; ?>]  onchange="document.getElementById(`blah<?php echo $i - 1; ?>`).src = window.URL.createObjectURL(this.files[0])"></td>
                                                    <td style="display: none"><input type="text" value="{{$i-1}}" name=preImage[<?php echo $i - 1 ?>]"></td>
                                                    <td><input type="text" name="title[]" value="{{$file->title}}" placeholder="Enter Caption" class="form-control"></td>
                                                    <td><input type="number" name="serial[<?php echo $i - 1; ?>]"  value="{{$file->serial}}" class="form-control" required></td>
                                                    <td><input type="number" name="status[]" max="1" min="0" value="1" class="form-control" required></td>
                                                    @if($i == 1)
                                                    <td><button type ="button" name="add" id="add" class="btn"><i class="fa fa-plus font-red"></i></button></td>
                                                    @else
                                                    <td><button type ="button" name="remove" id="{{$i}}" class="btn btn_remove"><i class="fa fa-times font-red"></i></button></td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr class="numbar">
                                                    <td width='10%'><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/no_file.png')}}" alt="No file image" height="70px" width="70px;"></td>
                                                    <td><input type="file" name="doc_name[]"></td>
                                                    <td><input type="text" name="title[]" value="" placeholder="Enter Caption" class="form-control"></td>
                                                    <td><input type="number" name="serial[]" value="1" class="form-control" required></td>
                                                    <td><input type="number" name="status[]" max="1" min="0" value="1" class="form-control" required></td>
                                                    <td><button type ="button" name="add" id="add" class="btn"><i class="fa fa-plus font-red"></i></button></td>
                                                </tr>
                                                @endif
                                            </table>
                                            <div class="text-danger" id="errorTitle"></div>
                                            <div class="text-danger" id="errorFiles"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('ticketEntry.index')}}" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-info float-right">Update</button>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
    </section>
</div>

<div class="modal fade" id="viewUserCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="createModalShowData">
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">

    $(document).ready(function () {
        $('.select2').select2();
        $('#issue_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#flying_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $(document).on('change', '#countryId', function () {
        var countryId = $(this).val();
        var typeId = $('#typeId').val();
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
        var netFare = parseFloat($('#netFare').val());
        if (!isNaN(serviceCharge)) {
            totalNetFare(serviceCharge);
        } else {
            totalNetFare();
        }
    });

    function totalNetFare(serviceCharge = 0) {
        var CommissionType = $('#CommissionType').val();
        var commission = parseFloat($('#Commission').val());
        var fare = parseFloat($('#fare').val());
        var fareWithTax = parseFloat($('#fareWithTax').val());
        var aitTax = parseFloat($('#aitTax').val());

        if (CommissionType == '1') {
            var netFare = (fareWithTax + aitTax) - commission;
            if (!isNaN(netFare)) {
                $('#netFare').val(netFare + serviceCharge);
            } else {
                $('#netFare').val('');
            }
        } else if (CommissionType == '2') {
            var commissionConvertedByTk = (commission * fare) / 100;
            var netFare = (fareWithTax + aitTax) - commissionConvertedByTk;
            if (!isNaN(netFare)) {
                $('#netFare').val(netFare + serviceCharge);
            } else {
                $('#netFare').val('');
            }
    }
    }
</script>

<script type="text/javascript">
    var i = <?php echo $i ?? 0 ?>;
    $(document).on('click', '#add', function () {
//        alert(i);return false;
        i++;
        $('#dynamic_field_file').append('<tr id="row' + i + '">' +
                '<td><img id="blah' + i + '" class="img-thambnail" src="{{asset('backend / dist / img / no_file.png')}}" alt="No file image" height="70px" width="70px;"></td>' +
                '<td><input type="file" name="doc_name[' + i + ']" onchange="document.getElementById(`blah${i}`).src = window.URL.createObjectURL(this.files[0])"></td>' +
                '<td><input type="text" name="title[' + i + ']" value="" placeholder="Enter Caption" class="form-control"></td>' +
                '<td><input type="number" name="serial[' + i + ']" class="form-control" value="" required></td>' +
                '<td><input type="number" name="status[' + i + ']" max="1" min="0" value="1" class="form-control" required></td>' +
                '<td><button type ="button" name="remove" id="' + i + '" class="btn  btn_remove"><i class="fa fa-times font-red"></i></button></td>' +
                '</tr>')
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $(document).on('click', '.openUserCreateModal', function () {
        $.ajax({
            url: "{{route('user.create')}}",
            type: "post",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
//                console.log(data);return false;
                $('#createModalShowData').html(data.data);
            }
        });
    });
    $(document).on('click', '#create', function () {
        var data = new FormData($('#createFormData')[0]);
        if (data != '') {
            $.ajax({
                url: "{{route('user.store')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $("#name_error").text('');
                    $("#role_id_error").text('');
                    $("#email_error").text('');
                    $("#phone_error").text('');
                    $("#password_error").text('');
                    $("#balance_error").text('');
                    $("#profile_photo_error").text('');
                    $("#address_error").text('');
                    if (data.errors) {
                        $("#name_error").text(data.errors.name);
                        $("#role_id_error").text(data.errors.role_id);
                        $("#email_error").text(data.errors.email);
                        $("#phone_error").text(data.errors.phone);
                        $("#password_error").text(data.errors.password);
                        $("#balance_error").text(data.errors.balance);
                        $("#profile_photo_error").text(data.errors.profile_photo);
                        $("#address_error").text(data.errors.address);
                    }
                    if (data.response == "success") {
//                        setTimeout(function () {
//                            location.reload();
//                        }, 1000);
                        $('#viewUserCreateModal').modal('hide');
                        toastr.success("@lang('lang.USER_CREATED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
                        // Create a DOM Option and pre-select by default
                        var newOption = new Option(data.name, data.id, true, true);
                        // Append it to the select
                        $('#User').append(newOption).trigger('change');
                    }
                }
            });
        }
    });


    const lb = lightbox();
</script>
@endpush


