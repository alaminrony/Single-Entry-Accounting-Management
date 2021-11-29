@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.VISA_ENTRY')</h1>
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
                            <h3 class="card-title">@lang('lang.CREATE_VISA')</h3>
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
                        {!!Form::open(['route'=>'visaEntry.store','class'=>'form-horizontal','enctype' => 'multipart/form-data'])!!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.COUNTRY_CODE')</label>
                                        {!!Form::select('country_id',$countries??'',old('country_id'),['class'=>'form-control select2','id'=>'countryId'])!!}
                                        @if($errors->has('country_id'))
                                        <span class="text-danger">{{$errors->first('country_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.ENTRY_TYPE')</label>
                                        {!!Form::select('type_id',$entryTypes??'',old('type_id'),['class'=>'form-control select2','id'=>'typeId'])!!}
                                        @if($errors->has('type_id'))
                                        <span class="text-danger">{{$errors->first('type_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.YEAR')</label>
                                        {!!Form::select('year',$years??'',old('year'),['class'=>'form-control select2','id'=>'year'])!!}
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
                                        {!!Form::text('customer_code','',['class'=>'form-control','id'=>'customerCode','readonly'])!!}
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
                                        {!!Form::text('name',old('name'),['class'=>'form-control','id'=>'name','placeholder'=>"Enter name"])!!}
                                        @if($errors->has('name'))
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.PASSPORT_NO')</label>
                                        {!!Form::text('passport_no',old('passport_no'),['class'=>'form-control','id'=>'passportNo','placeholder'=>"Enter passport no"])!!}
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
                                        {!!Form::text('father_name',old('father_name'),['class'=>'form-control','id'=>'father_name','placeholder'=>"Father/Husband/Wife name"])!!}
                                        @if($errors->has('father_name'))
                                        <span class="text-danger">{{$errors->first('father_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.PASSPORT_ISSUE_DATE')</label>
                                        <div class="input-group date" id="passport_issue_date" data-target-input="nearest">
                                            <input type="text" name='passport_issue_date' class="form-control datetimepicker-input" data-target="#passport_issue_date" value="{{old('passport_issue_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='passport_recieve_date' class="form-control datetimepicker-input" data-target="#passport_recieve_date" value="{{old('passport_recieve_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='passport_expiry_date' class="form-control datetimepicker-input" data-target="#passport_expiry_date" value="{{old('passport_expiry_date')}}" placeholder="yyyy/mm/dd"/>
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
                                        {!!Form::text('village',old('village'),['class'=>'form-control','id'=>'village','placeholder'=>"Enter village"])!!}
                                        @if($errors->has('village'))
                                        <span class="text-danger">{{$errors->first('village')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.POST')</label>
                                        {!!Form::text('post_office',old('post_office'),['class'=>'form-control','id'=>'post_office','placeholder'=>"Enter post office"])!!}
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
                                        {!!Form::select('police_station',$thanas,old('police_station'),['class'=>'form-control select2','id'=>'thana'])!!}
                                        @if($errors->has('police_station'))
                                        <span class="text-danger">{{$errors->first('police_station')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.DISTRICT')</label>
                                        {!!Form::select('district',$districts,old('district'),['class'=>'form-control select2','id'=>'district'])!!}
                                        @if($errors->has('district'))
                                        <span class="text-danger">{{$errors->first('district')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.PROFESSION')</label>
                                        {!!Form::text('profession',old('profession'),['class'=>'form-control','id'=>'profession','placeholder'=>"Enter profession"])!!}
                                        @if($errors->has('profession'))
                                        <span class="text-danger">{{$errors->first('profession')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.MOBILE_NO')</label>
                                        {!!Form::text('mobile_no',old('mobile_no'),['class'=>'form-control','id'=>'mobile_no','placeholder'=>"Enter mobile no"])!!}
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
                                        {!!Form::text('visa_no',old('visa_no'),['class'=>'form-control','id'=>'visa_no','placeholder'=>"Enter visa no"])!!}
                                        @if($errors->has('visa_no'))
                                        <span class="text-danger">{{$errors->first('visa_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.ID_NO')</label>
                                        {!!Form::text('id_no',old('id_no'),['class'=>'form-control','id'=>'id_no','placeholder'=>"Enter Id no"])!!}
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
                                            <input type="text" name='visa_issue_date' class="form-control datetimepicker-input" data-target="#visa_issue_date" value="{{old('visa_issue_date')}}" placeholder="yyyy/mm/yy" id="visaIssueDate"/>
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
                                            <input type="text" name='visa_expiry_date' class="form-control datetimepicker-input" data-target="#visa_expiry_date" value="{{old('visa_expiry_date')}}" placeholder="yyyy/mm/yy" id="visaExpiryDate"/>
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
                                            <input type="text" name='okala_date' class="form-control datetimepicker-input" data-target="#okala_date" value="{{old('okala_date')}}" placeholder="yyyy/mm/yy"/>
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
                                            <input type="text" name='medical_date' class="form-control datetimepicker-input" data-target="#medical_date" value="{{old('medical_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='medical_card_recieve_date' class="form-control datetimepicker-input" data-target="#medical_card_recieve_date" value="{{old('medical_card_recieve_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='medical_expiry_date' class="form-control datetimepicker-input" data-target="#medical_expiry_date" value="{{old('medical_expiry_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='police_clearence_recieve_date' class="form-control datetimepicker-input" data-target="#police_clearence_recieve_date" value="{{old('police_clearence_recieve_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='police_clearence_expiry_date' class="form-control datetimepicker-input" data-target="#police_clearence_expiry_date" value="{{old('police_clearence_expiry_date')}}" placeholder="yyyy/mm/dd"/>
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
                                        {!!Form::text('mofa_no',old('mofa_no'),['class'=>'form-control','id'=>'mofa_no','placeholder'=>"Enter mofa no"])!!}
                                        @if($errors->has('mofa_no'))
                                        <span class="text-danger">{{$errors->first('mofa_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.MOFA_DATE')</label>
                                        <div class="input-group date" id="mofa_date" data-target-input="nearest">
                                            <input type="text" name='mofa_date' class="form-control datetimepicker-input" data-target="#mofa_date" value="{{old('mofa_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='mofa_expiry_date' class="form-control datetimepicker-input" data-target="#mofa_expiry_date" value="{{old('mofa_expiry_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='em_submit_date' class="form-control datetimepicker-input" data-target="#em_submit_date" value="{{old('em_submit_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='stamping_date' class="form-control datetimepicker-input" data-target="#stamping_date" value="{{old('stamping_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='delivery_date' class="form-control datetimepicker-input" data-target="#delivery_date" value="{{old('delivery_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='stamping_expiry_date' class="form-control datetimepicker-input" data-target="#stamping_expiry_date" value="{{old('stamping_expiry_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='training_card_recieve_date' class="form-control datetimepicker-input" data-target="#training_card_recieve_date" value="{{old('training_card_recieve_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='finger_date' class="form-control datetimepicker-input" data-target="#finger_date" value="{{old('finger_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='man_power_submit_date' class="form-control datetimepicker-input" data-target="#man_power_submit_date" value="{{old('man_power_submit_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='man_power_expiry_date' class="form-control datetimepicker-input" data-target="#man_power_expiry_date" value="{{old('man_power_expiry_date')}}" placeholder="yyyy/mm/dd"/>
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
                                        {!!Form::text('rl_no',old('rl_no'),['class'=>'form-control','id'=>'rl_no','placeholder'=>"Enter RL no"])!!}
                                        @if($errors->has('rl_no'))
                                        <span class="text-danger">{{$errors->first('rl_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.DOCUMENT_SENDING_DATE')</label>
                                        <div class="input-group date" id="document_sending_date" data-target-input="nearest">
                                            <input type="text" name='document_sending_date' placeholder="yyyy/mm/dd" class="form-control datetimepicker-input" data-target="#document_sending_date" value="{{old('document_sending_date')}}"/>
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
                                        {!!Form::select('flying_form',$airports,old('flying_form'),['class'=>'form-control select2','id'=>'flyingForm'])!!}
                                        @if($errors->has('flying_form'))
                                        <span class="text-danger">{{$errors->first('flying_form')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FLYING_TO')</label>
                                        {!!Form::select('flying_to',$airports,old('flying_to'),['class'=>'form-control select2','id'=>'flyingTo'])!!}
                                        @if($errors->has('flying_to'))
                                        <span class="text-danger">{{$errors->first('flying_to')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.CARRIER')</label>
                                        {!!Form::text('carrier',old('carrier'),['class'=>'form-control','id'=>'carrier','placeholder'=>"Enter carrier"])!!}
                                        @if($errors->has('carrier'))
                                        <span class="text-danger">{{$errors->first('carrier')}}</span>
                                        @endif
                                    </div>
                                </div>
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
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.SUBMIT_AGENCY')</label>
                                        {!!Form::text('submit_agency',$target->account_no??'',['class'=>'form-control','placeholder'=>'Enter submit agency','id'=>'submit_agency'])!!}
                                        @if($errors->has('submit_agency'))
                                        <span class="text-danger">{{$errors->first('submit_agency')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.REF_AGENT')</label>
                                        {!!Form::text('ref_agent',$target->account_no??'',['class'=>'form-control','placeholder'=>'Enter ref agent','id'=>'ref_agent'])!!}
                                        @if($errors->has('ref_agent'))
                                        <span class="text-danger">{{$errors->first('ref_agent')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.OTHER_INFORMATION')</label>
                                        {!! Form::textarea('other_information', null, ['id' => 'other_information', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('other_information'))
                                        <span class="text-danger">{{$errors->first('other_information')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.NOTES')</label>
                                        {!! Form::textarea('note', null, ['id' => 'note', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('note'))
                                        <span class="text-danger">{{$errors->first('note')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10">
                                    <h4 style="text-align: center;margin-top: 0px;">Document Management</h4>
                                    <div class = "form-group">
                                        <div class ="table-responsive">
                                            <table class ="table table-bordered" id="dynamic_field">
                                                <thead>
                                                <th>File</th>
                                                <th>Caption</th>
                                                <th>Serial</th>
                                                <th>Status</th>
                                                <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="numbar">
                                                        <!--<td width='10%'><img id="blah0" class="img-thambnail" src="http://demo.kefuclav.com/assets/dist/img/products/product.png" alt="your image" height="70px" width="70px;"></td>-->
                                                        <td><input type="file" name="doc_name[]"></td>
                                                        <td><input type="text" name="title[]" value="" placeholder="Enter Caption" class="form-control"></td>
                                                        <td><input type="number" name="serial[]" value="1" class="form-control" required></td>
                                                        <td><input type="number" name="status[]" max="1" min="0" value="1" class="form-control" required></td>
                                                        <td><button type ="button" name="add" id="add" class="btn"><i class="fa fa-plus font-red"></i></button></td>
                                                    </tr>
                                                <tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{route('visaEntry.index')}}" class="btn btn-default ">Cancel</a>
                                <button type="submit" class="btn btn-info float-right">Save</button>
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

</script>
<script type="text/javascript">
    var i = 1;
    $(document).on('click', '#add', function () {
        i++;
        $('#dynamic_field').append('<tr id="row' + i + '">' +
                '<td><input type="file" name="doc_name[]"></td>' +
                '<td><input type="text" name="title[]" placeholder="Enter Caption" value="" class="form-control"></td>' +
                '<td><input type="number" name="serial[]" value="' + i + '" class="form-control" required></td>' +
                '<td><input type="number" name="status[]" max="1" min="0" value="1" class="form-control" required></td>' +
                '<td><button type ="button" name="remove" id="' + i + '" class="btn  btn_remove"><i class="fa fa-times font-red"></i></button></td>' +
                '</tr>')
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $(document).on('click', '#addBN', function () {
        $(this).addClass("active");
        $('#addEng').removeClass("active");
    });
    $(document).on('click', '#addEng', function () {
        $(this).addClass("active");
        $('#addBN').removeClass("active");
    });

</script>
@endpush


