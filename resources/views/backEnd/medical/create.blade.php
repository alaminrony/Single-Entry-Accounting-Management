@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.MEDICAL_ENTRY')</h1>
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
                            <h3 class="card-title">@lang('lang.CREATE_MEDICAL')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>


                        {!!Form::open(['route'=>'medicalEntry.store','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
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
                                        <label>@lang('lang.CONTACT_NO')</label>
                                        {!!Form::text('contact_no',old('contact_no'),['class'=>'form-control','id'=>'contact_no','placeholder'=>"Enter contact no"])!!}
                                        @if($errors->has('contact_no'))
                                        <span class="text-danger">{{$errors->first('contact_no')}}</span>
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
                                        @if($errors->has('passport_recieve_date'))
                                        <span class="text-danger">{{$errors->first('passport_recieve_date')}}</span>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.FIT_DATE')</label>
                                        <div class="input-group date" id="fit_date" data-target-input="nearest">
                                            <input type="text" name='fit_date' class="form-control datetimepicker-input" data-target="#fit_date" value="{{old('fit_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#fit_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('fit_date'))
                                        <span class="text-danger">{{$errors->first('fit_date')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.UNFIT_DATE')</label>
                                        <div class="input-group date" id="unfit_date" data-target-input="nearest">
                                            <input type="text" name='unfit_date' class="form-control datetimepicker-input" data-target="#unfit_date" value="{{old('unfit_date')}}" placeholder="yyyy/mm/dd"/>
                                            <div class="input-group-append" data-target="#unfit_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('unfit_date'))
                                        <span class="text-danger">{{$errors->first('unfit_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.CENTER_NAME')</label>
                                        {!!Form::text('center_name',old('center_name'),['class'=>'form-control','id'=>'center_name','placeholder'=>"Enter Center name"])!!}
                                        @if($errors->has('center_name'))
                                        <span class="text-danger">{{$errors->first('center_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.REF_AGENT')</label>
                                        <div class="input-group date"  data-target-input="nearest">
                                            {!!Form::select('ref',$users,'',['class'=>'form-control select2','id'=>'ref','data-width'=>'80%','placeholder'=>"Enter REF"]) !!}
                                            <div class="input-group-append">
                                                <a type="button" class="input-group-text bg-secondary openUserCreateModal" data-toggle="modal" title="@lang('lang.VIEW_ISSUE')" data-target="#viewUserCreateModal"><i class="fa fa-plus-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.CONTACT_PERSON')</label>
                                        {!! Form::textarea('contact_person',old('contact_person'), ['id' => 'contact_person', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('contact_person'))
                                        <span class="text-danger">{{$errors->first('contact_person')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.CONTACT_PURPOSE')</label>
                                        {!! Form::textarea('contact_purpose',old('contact_purpose'), ['id' => 'contact_purpose', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('contact_purpose'))
                                        <span class="text-danger">{{$errors->first('contact_purpose')}}</span>
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
        $('#passport_issue_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#passport_recieve_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#passport_expiry_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#fit_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#unfit_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $(document).on('change', '#countryId', function () {
        var countryId = $(this).val();
        var typeId = $('#typeId').val();
        var year = $('#year').val();
        if (countryId != '' && typeId != '' && year != '') {
            $.ajax({
                url: "{{route('medicalEntry.generateCusCode')}}",
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
                url: "{{route('medicalEntry.generateCusCode')}}",
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
                url: "{{route('medicalEntry.generateCusCode')}}",
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
</script>
@endpush


