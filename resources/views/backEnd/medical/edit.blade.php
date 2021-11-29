@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.EDIT_MEDICAL')</h1>
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
                            <h3 class="card-title">@lang('lang.EDIT_MEDICAL')</h3>
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
                        {!!Form::open(['route'=>['medicalEntry.update',$target->id],'class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
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
                                        <label>@lang('lang.CONTACT_NO')</label>
                                        {!!Form::text('contact_no',!empty($target->contact_no) ? $target->contact_no : old('contact_no'),['class'=>'form-control','id'=>'contact_no','placeholder'=>"Enter contact no"])!!}
                                        @if($errors->has('contact_no'))
                                        <span class="text-danger">{{$errors->first('contact_no')}}</span>
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
                                        @if($errors->has('passport_recieve_date'))
                                        <span class="text-danger">{{$errors->first('passport_recieve_date')}}</span>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.FIT_DATE')</label>
                                        <div class="input-group date" id="fit_date" data-target-input="nearest">
                                            <input type="text" name='fit_date' class="form-control datetimepicker-input" data-target="#fit_date" value="{{!empty($target->fit_date) ? $target->fit_date : old('fit_date')}}" placeholder="yyyy/mm/dd"/>
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
                                            <input type="text" name='unfit_date' class="form-control datetimepicker-input" data-target="#unfit_date" value="{{!empty($target->unfit_date) ? $target->unfit_date : old('unfit_date')}}" placeholder="yyyy/mm/dd"/>
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
                                        {!!Form::text('center_name',!empty($target->center_name) ? $target->center_name : old('center_name'),['class'=>'form-control','id'=>'center_name','placeholder'=>"Enter Center name"])!!}
                                        @if($errors->has('center_name'))
                                        <span class="text-danger">{{$errors->first('center_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.REF')</label>
                                        {!!Form::text('ref',!empty($target->ref) ? $target->ref : old('ref'),['class'=>'form-control','id'=>'ref','placeholder'=>"Enter REF"])!!}
                                        @if($errors->has('ref'))
                                        <span class="text-danger">{{$errors->first('ref')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.CONTACT_PERSON')</label>
                                        {!! Form::textarea('contact_person',!empty($target->contact_person) ? $target->contact_person : old('contact_person'), ['id' => 'contact_person', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('contact_person'))
                                        <span class="text-danger">{{$errors->first('contact_person')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.CONTACT_PURPOSE')</label>
                                        {!! Form::textarea('contact_purpose',!empty($target->contact_purpose) ? $target->contact_purpose : old('contact_purpose'), ['id' => 'contact_purpose', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
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
                                <a href="{{route('medicalEntry.index')}}" class="btn btn-default ">Cancel</a>
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
    });


</script>

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
@endpush


