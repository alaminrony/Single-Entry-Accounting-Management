@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.EDIT_VISA')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.EDIT_VISA')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        {!!Form::open(['route'=>['visaEntry.update',$target->id],'class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
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
                                        <label>@lang('lang.PASSPORT_NO')</label>
                                        {!!Form::text('passport_no',!empty($target->passport_no) ? $target->passport_no : old('passport_no'),['class'=>'form-control','id'=>'passportNo','placeholder'=>"Enter passport no"])!!}
                                        @if($errors->has('passport_no'))
                                        <span class="text-danger">{{$errors->first('passport_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FAW')</label>
                                        {!!Form::text('father_name',!empty($target->father_name) ? $target->father_name : old('father_name'),['class'=>'form-control','id'=>'father_name','placeholder'=>"Father/Husband/Wife name"])!!}
                                        @if($errors->has('father_name'))
                                        <span class="text-danger">{{$errors->first('father_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.PASSPORT_ISSUE_DATE')</label>
                                        <div class="input-group date" id="passport_issue_date" data-target-input="nearest">
                                            <input type="text" name='passport_issue_date' class="form-control datetimepicker-input" data-target="#passport_issue_date" value="{{!empty($target->passport_issue_date) ? $target->passport_issue_date : old('passport_issue_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#passport_issue_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('passport_issue_date'))
                                        <span class="text-danger">{{$errors->first('passport_issue_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.PASSPORT_RECEIVE_DATE')</label>
                                        <div class="input-group date" id="passport_recieve_date" data-target-input="nearest">
                                            <input type="text" name='passport_recieve_date' class="form-control datetimepicker-input" data-target="#passport_recieve_date" value="{{!empty($target->passport_recieve_date) ? $target->passport_recieve_date : old('passport_recieve_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#passport_recieve_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('from_date'))
                                        <span class="text-danger">{{$errors->first('from_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.PASSPORT_EXPIRY_DATE')</label>
                                        <div class="input-group date" id="passport_expiry_date" data-target-input="nearest">
                                            <input type="text" name='passport_expiry_date' class="form-control datetimepicker-input" data-target="#passport_expiry_date" value="{{!empty($target->passport_expiry_date) ? $target->passport_expiry_date : old('passport_expiry_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#passport_expiry_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('passport_expiry_date'))
                                        <span class="text-danger">{{$errors->first('passport_expiry_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.VILLAGE')</label>
                                        {!!Form::text('village',!empty($target->village) ? $target->village : old('village'),['class'=>'form-control','id'=>'village','placeholder'=>"Enter village"])!!}
                                        @if($errors->has('village'))
                                        <span class="text-danger">{{$errors->first('village')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.POST')</label>
                                        {!!Form::text('post_office',!empty($target->post_office) ? $target->post_office : old('post_office'),['class'=>'form-control','id'=>'post_office','placeholder'=>"Enter post office"])!!}
                                        @if($errors->has('post_office'))
                                        <span class="text-danger">{{$errors->first('post_office')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.POLICE_STATION')</label>
                                        {!!Form::select('police_station',$thanas,!empty($target->police_station) ? $target->police_station : old('police_station'),['class'=>'form-control select2','id'=>'thana'])!!}
                                        @if($errors->has('police_station'))
                                        <span class="text-danger">{{$errors->first('police_station')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.DISTRICT')</label>
                                        {!!Form::select('district',$districts,!empty($target->district) ? $target->district : old('district'),['class'=>'form-control select2','id'=>'district'])!!}
                                        @if($errors->has('district'))
                                        <span class="text-danger">{{$errors->first('district')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.PROFESSION')</label>
                                        {!!Form::text('profession',!empty($target->profession) ? $target->profession : old('profession'),['class'=>'form-control','id'=>'profession','placeholder'=>"Enter profession"])!!}
                                        @if($errors->has('profession'))
                                        <span class="text-danger">{{$errors->first('profession')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.MOBILE_NO')</label>
                                        {!!Form::text('mobile_no',!empty($target->mobile_no) ? $target->mobile_no : old('mobile_no'),['class'=>'form-control','id'=>'mobile_no','placeholder'=>"Enter mobile no"])!!}
                                        @if($errors->has('mobile_no'))
                                        <span class="text-danger">{{$errors->first('mobile_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.VISA_NO')</label>
                                        {!!Form::text('visa_no',!empty($target->visa_no) ? $target->visa_no : old('visa_no'),['class'=>'form-control','id'=>'visa_no','placeholder'=>"Enter visa no"])!!}
                                        @if($errors->has('visa_no'))
                                        <span class="text-danger">{{$errors->first('visa_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.ID_NO')</label>
                                        {!!Form::text('id_no',!empty($target->id_no) ? $target->id_no : old('id_no'),['class'=>'form-control','id'=>'id_no','placeholder'=>"Enter Id no"])!!}
                                        @if($errors->has('id_no'))
                                        <span class="text-danger">{{$errors->first('id_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.VISA_ISSUE_DATE')</label>
                                        <div class="input-group date" id="visa_issue_date" data-target-input="nearest">
                                            <input type="text" name='visa_issue_date' class="form-control datetimepicker-input" data-target="#visa_issue_date" value="{{!empty($target->visa_issue_date) ? $target->visa_issue_date : old('visa_issue_date')}}" placeholder="yyyy/mm/yy"/>
                                            <div class="input-group-append" data-target="#visa_issue_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('visa_issue_date'))
                                        <span class="text-danger">{{$errors->first('visa_issue_date')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.VISA_EXPIRY_DATE')</label>
                                        <div class="input-group date" id="visa_expiry_date" data-target-input="nearest">
                                            <input type="text" name='visa_expiry_date' class="form-control datetimepicker-input" data-target="#visa_expiry_date" value="{{!empty($target->visa_expiry_date) ? $target->visa_expiry_date : old('visa_expiry_date')}}" placeholder="yyyy/mm/yy"/>
                                            <div class="input-group-append" data-target="#visa_expiry_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('visa_expiry_date'))
                                        <span class="text-danger">{{$errors->first('visa_expiry_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.OKALA_DATE')</label>
                                        <div class="input-group date" id="okala_date" data-target-input="nearest">
                                            <input type="text" name='okala_date' class="form-control datetimepicker-input" data-target="#okala_date" value="{{!empty($target->okala_date) ? $target->okala_date : old('okala_date')}}" placeholder="yyyy/mm/yy"/>
                                            <div class="input-group-append" data-target="#okala_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('okala_date'))
                                        <span class="text-danger">{{$errors->first('okala_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.MEDICAL_DATE')</label>
                                        <div class="input-group date" id="medical_date" data-target-input="nearest">
                                            <input type="text" name='medical_date' class="form-control datetimepicker-input" data-target="#medical_date" value="{{!empty($target->medical_date) ? $target->medical_date : old('medical_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#medical_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('medical_date'))
                                        <span class="text-danger">{{$errors->first('medical_date')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.MEDICAL_CARD_RECEIVE_DATE')</label>
                                        <div class="input-group date" id="medical_card_recieve_date" data-target-input="nearest">
                                            <input type="text" name='medical_card_recieve_date' class="form-control datetimepicker-input" data-target="#medical_card_recieve_date" value="{{!empty($target->medical_card_recieve_date) ? $target->medical_card_recieve_date : old('medical_card_recieve_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#medical_card_recieve_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('medical_card_recieve_date'))
                                        <span class="text-danger">{{$errors->first('medical_card_recieve_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.MEDICAL_EXPIRY_DATE')</label>
                                        <div class="input-group date" id="medical_expiry_date" data-target-input="nearest">
                                            <input type="text" name='medical_expiry_date' class="form-control datetimepicker-input" data-target="#medical_expiry_date" value="{{!empty($target->medical_expiry_date) ? $target->medical_expiry_date : old('medical_expiry_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#medical_expiry_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('medical_expiry_date'))
                                        <span class="text-danger">{{$errors->first('medical_expiry_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.POLICE_CLEARANCE_RECEIVE_DATE')</label>
                                        <div class="input-group date" id="police_clearence_recieve_date" data-target-input="nearest">
                                            <input type="text" name='police_clearence_recieve_date' class="form-control datetimepicker-input" data-target="#police_clearence_recieve_date" value="{{!empty($target->police_clearence_recieve_date) ? $target->police_clearence_recieve_date : old('police_clearence_recieve_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#police_clearence_recieve_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('police_clearence_recieve_date'))
                                        <span class="text-danger">{{$errors->first('police_clearence_recieve_date')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.POLICE_CLEARANCE_EXPIRY_DATE')</label>
                                        <div class="input-group date" id="police_clearence_expiry_date" data-target-input="nearest">
                                            <input type="text" name='police_clearence_expiry_date' class="form-control datetimepicker-input" data-target="#police_clearence_expiry_date" value="{{!empty($target->police_clearence_expiry_date) ? $target->police_clearence_expiry_date : old('police_clearence_expiry_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#police_clearence_expiry_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('police_clearence_expiry_date'))
                                        <span class="text-danger">{{$errors->first('police_clearence_expiry_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.MOFA_NO')</label>
                                        {!!Form::text('mofa_no',!empty($target->mofa_no) ? $target->mofa_no : old('mofa_no'),['class'=>'form-control','id'=>'mofa_no','placeholder'=>"Enter mofa no"])!!}
                                        @if($errors->has('mofa_no'))
                                        <span class="text-danger">{{$errors->first('mofa_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.MOFA_DATE')</label>
                                        <div class="input-group date" id="mofa_date" data-target-input="nearest">
                                            <input type="text" name='mofa_date' class="form-control datetimepicker-input" data-target="#mofa_date" value="{{!empty($target->mofa_date) ? $target->mofa_date : old('mofa_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#mofa_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('mofa_date'))
                                        <span class="text-danger">{{$errors->first('mofa_date')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.MOFA_EXPIRY_DATE')</label>
                                        <div class="input-group date" id="mofa_expiry_date" data-target-input="nearest">
                                            <input type="text" name='mofa_expiry_date' class="form-control datetimepicker-input" data-target="#mofa_expiry_date" value="{{!empty($target->mofa_expiry_date) ? $target->mofa_expiry_date : old('mofa_expiry_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#mofa_expiry_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('mofa_expiry_date'))
                                        <span class="text-danger">{{$errors->first('mofa_expiry_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.EM_SUBMIT_DATE')</label>
                                        <div class="input-group date" id="em_submit_date" data-target-input="nearest">
                                            <input type="text" name='em_submit_date' class="form-control datetimepicker-input" data-target="#em_submit_date" value="{{!empty($target->em_submit_date) ? $target->em_submit_date : old('em_submit_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#em_submit_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('em_submit_date'))
                                        <span class="text-danger">{{$errors->first('em_submit_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.STAMPING_DATE')</label>
                                        <div class="input-group date" id="stamping_date" data-target-input="nearest">
                                            <input type="text" name='stamping_date' class="form-control datetimepicker-input" data-target="#stamping_date" value="{{!empty($target->stamping_date) ? $target->stamping_date : old('stamping_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#stamping_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('stamping_date'))
                                        <span class="text-danger">{{$errors->first('stamping_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.DELIVERY_DATE')</label>
                                        <div class="input-group date" id="delivery_date" data-target-input="nearest">
                                            <input type="text" name='delivery_date' class="form-control datetimepicker-input" data-target="#delivery_date" value="{{!empty($target->delivery_date) ? $target->delivery_date : old('delivery_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#delivery_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('delivery_date'))
                                        <span class="text-danger">{{$errors->first('delivery_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.STAMPING_EXPIRY_DATE')</label>
                                        <div class="input-group date" id="stamping_expiry_date" data-target-input="nearest">
                                            <input type="text" name='stamping_expiry_date' class="form-control datetimepicker-input" data-target="#stamping_expiry_date" value="{{!empty($target->stamping_expiry_date) ? $target->stamping_expiry_date : old('stamping_expiry_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#stamping_expiry_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('stamping_expiry_date'))
                                        <span class="text-danger">{{$errors->first('stamping_expiry_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.TRANING_CARD_RECEIVE_DATE')</label>
                                        <div class="input-group date" id="training_card_recieve_date" data-target-input="nearest">
                                            <input type="text" name='training_card_recieve_date' class="form-control datetimepicker-input" data-target="#training_card_recieve_date" value="{{!empty($target->training_card_recieve_date) ? $target->training_card_recieve_date : old('training_card_recieve_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#training_card_recieve_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('training_card_recieve_date'))
                                        <span class="text-danger">{{$errors->first('training_card_recieve_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FINGER_DATE')</label>
                                        <div class="input-group date" id="finger_date" data-target-input="nearest">
                                            <input type="text" name='finger_date' class="form-control datetimepicker-input" data-target="#finger_date" value="{{!empty($target->finger_date) ? $target->finger_date : old('finger_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#finger_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('finger_date'))
                                        <span class="text-danger">{{$errors->first('finger_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.MAN_POWER_SUBMIT_DATE')</label>
                                        <div class="input-group date" id="man_power_submit_date" data-target-input="nearest">
                                            <input type="text" name='man_power_submit_date' class="form-control datetimepicker-input" data-target="#man_power_submit_date" value="{{!empty($target->man_power_submit_date) ? $target->man_power_submit_date : old('man_power_submit_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#man_power_submit_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('man_power_submit_date'))
                                        <span class="text-danger">{{$errors->first('man_power_submit_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.MAN_POWER_DELIVERY_DATE')</label>
                                        <div class="input-group date" id="man_power_expiry_date" data-target-input="nearest">
                                            <input type="text" name='man_power_expiry_date' class="form-control datetimepicker-input" data-target="#man_power_expiry_date" value="{{!empty($target->man_power_expiry_date) ? $target->man_power_expiry_date : old('man_power_expiry_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#man_power_expiry_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('man_power_expiry_date'))
                                        <span class="text-danger">{{$errors->first('man_power_expiry_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.RL_NO')</label>
                                        {!!Form::text('rl_no',!empty($target->rl_no) ? $target->rl_no : old('rl_no'),['class'=>'form-control','id'=>'rl_no','placeholder'=>"Enter RL no"])!!}
                                        @if($errors->has('rl_no'))
                                        <span class="text-danger">{{$errors->first('rl_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.DOCUMENT_SENDING_DATE')</label>
                                        <div class="input-group date" id="document_sending_date" data-target-input="nearest">
                                            <input type="text" name='document_sending_date' placeholder="yyyy/mm/dd" class="form-control datetimepicker-input" data-target="#document_sending_date" value="{{!empty($target->document_sending_date) ? $target->document_sending_date : old('document_sending_date')}}"/>
                                            <div class="input-group-append" data-target="#document_sending_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('document_sending_date'))
                                        <span class="text-danger">{{$errors->first('document_sending_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FLYING_FROM')</label>
                                        {!!Form::select('flying_form',$airports,!empty($target->flying_form) ? $target->flying_form : old('flying_form'),['class'=>'form-control select2','id'=>'flyingForm'])!!}
                                        @if($errors->has('flying_form'))
                                        <span class="text-danger">{{$errors->first('flying_form')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FLYING_TO')</label>
                                        {!!Form::select('flying_to',$airports,!empty($target->flying_to) ? $target->flying_to : old('flying_to'),['class'=>'form-control select2','id'=>'flyingTo'])!!}
                                        @if($errors->has('flying_to'))
                                        <span class="text-danger">{{$errors->first('flying_to')}}</span>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.SUBMIT_AGENCY')</label>
                                        {!!Form::text('submit_agency',!empty($target->submit_agency) ? $target->submit_agency : old('submit_agency'),['class'=>'form-control','placeholder'=>'Enter submit agency','id'=>'submit_agency'])!!}
                                        @if($errors->has('submit_agency'))
                                        <span class="text-danger">{{$errors->first('submit_agency')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.REF_AGENT')</label>
                                        {!!Form::text('ref_agent',!empty($target->ref_agent) ? $target->ref_agent : old('ref_agent'),['class'=>'form-control','placeholder'=>'Enter ref agent','id'=>'ref_agent'])!!}
                                        @if($errors->has('ref_agent'))
                                        <span class="text-danger">{{$errors->first('ref_agent')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('lang.OTHER_INFORMATION')</label>
                                        {!! Form::textarea('other_information', !empty($target->other_information) ? $target->other_information : old('other_information'), ['id' => 'other_information', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('other_information'))
                                        <span class="text-danger">{{$errors->first('other_information')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('lang.NOTE')</label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field">
                                                <tr>
                                                    <td ><textarea  class="form-control name_list"  type="text" name="note[]" placeholder="Enter note"></textarea></td>
                                                    <td width="10%"><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                                </tr>
                                            </table>
                                            <input type="hidden" name="" id="counter" value="1">
                                        </div>
                                        @foreach($notes as $note)
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field">
                                                <tr>
                                                    <td ><textarea  class="form-control name_list"  type="text" name="note[]" placeholder="Enter note">{{$note->note}}</textarea></td>
                                                    <td width="10%"><button type="button" name="remove"  class="btn btn-danger btn_remove">X</button></td>
                                                </tr>
                                            </table>
                                        </div>
                                        @endforeach
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
                                                        <!--<td width='10%'><img id="blah0" class="img-thambnail" src="http://demo.kefuclav.com/assets/dist/img/products/product.png" alt="your image" height="70px" width="70px;"></td>-->
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
                                <a href="{{route('visaEntry.index')}}" class="btn btn-default ">Cancel</a>
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
@endsection
@push('script')
<script type="text/javascript">
    var i = <?php echo $i ?? 0 ?>;
    $(document).on('click', '#add', function () {
//        alert(i);return false;
        i++;
        $('#dynamic_field_file').append('<tr id="row' + i + '">' +
                '<td><img id="blah' + i + '" class="img-thambnail" src="{{asset('backend / dist / img / file.jpg')}}" alt="your image" height="70px" width="70px;"></td>' +
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
    const lb = lightbox();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
        $('#passport_issue_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#passport_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#passport_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#visa_issue_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#visa_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#okala_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#medical_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#medical_card_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#medical_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#police_clearence_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#police_clearence_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#mofa_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#mofa_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#delivery_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#man_power_submit_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#man_power_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#document_sending_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#em_submit_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#stamping_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#stamping_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#training_card_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#finger_date').datetimepicker({
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
                url: "{{route('generateCusCode.create')}}",
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
                url: "{{route('generateCusCode.create')}}",
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
                url: "{{route('generateCusCode.create')}}",
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


    $(document).ready(function () {
        $('#add').click(function () {
            var counter = $('#counter').val();
            // alert(counter);return false;
            counter++;

            $('#dynamic_field').append('<tr id="row' + counter + '" class="numbar"><td><textarea type="text" name="note[]" placeholder="Enter note" class="form-control name_list"></textarea></td><td><button type="button" name="remove" id="' + counter + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            $('#counter').val(counter);

        });


        $(document).on('click', '.btn_remove', function () {
            var counter = $('#counter').val();
            var row = $(this).closest("tr");
            var siblings = row.siblings();
            row.remove();
            refresh(siblings);
            counter--;
            $('#counter').val(counter);
        });

//        function refresh(siblings) {
//            siblings.each(function (index) {
//                $(this).children().children().first().val(index + 1);
//                $(this).attr("id", "row" + (index + 1));
//            });
//        }

    });


</script>
@endpush


