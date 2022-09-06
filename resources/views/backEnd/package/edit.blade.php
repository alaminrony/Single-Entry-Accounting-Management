@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.PACKAGE_ENTRY')</h1>
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
                            <h3 class="card-title">@lang('lang.CREATE_PACKAGE')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>


                        {!!Form::open(['route'=>['packageEntry.update',$target->id],'class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
                        <div class="card-body">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.PACKAGE_NAME')</label>
                                        {!!Form::text('name',!empty($target->name)? $target->name : old('name'),['class'=>'form-control','id'=>'name','placeholder'=>"Enter package name"])!!}
                                        @if($errors->has('name'))
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.FROM')</label>
                                        {!!Form::text('from',!empty($target->from)? $target->from : old('from'),['class'=>'form-control','id'=>'from','placeholder'=>"Enter from"])!!}
                                        @if($errors->has('from'))
                                        <span class="text-danger">{{$errors->first('from')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.TO')</label>
                                        {!!Form::text('to',!empty($target->to)? $target->to : old('to'),['class'=>'form-control','id'=>'to','placeholder'=>"Enter to"])!!}
                                        @if($errors->has('to'))
                                        <span class="text-danger">{{$errors->first('to')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.NUM_OF_ADULT')</label>
                                        {!!Form::number('adult',!empty($target->adult)? $target->adult : old('adult'),['class'=>'form-control','id'=>'adult','placeholder'=>"Enter adult number"])!!}
                                        @if($errors->has('adult'))
                                        <span class="text-danger">{{$errors->first('adult')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.NUM_OF_CHILDREN')</label>
                                        {!!Form::number('children',!empty($target->children)? $target->children : old('children'),['class'=>'form-control','id'=>'children','placeholder'=>"Enter children number"])!!}
                                        @if($errors->has('children'))
                                        <span class="text-danger">{{$errors->first('children')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.HOTEL')</label>
                                        {!!Form::select('hotel',['yes'=>'Yes','no'=>'No'],!empty($target->hotel)? $target->hotel : old('hotel'),['class'=>'form-control','id'=>'hotel'])!!}
                                        @if($errors->has('hotel'))
                                        <span class="text-danger">{{$errors->first('hotel')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.HOTEL_TYPE')</label>
                                        {!!Form::select('hotel_type',[''=>__('lang.SELECT_HOTEL_TYPE'),'3'=>'3 Star','4'=>'4 Star','5'=>'5 Star'],!empty($target->hotel_type)? $target->hotel_type : old('hotel_type'),['class'=>'form-control','id'=>'hotel_type'])!!}
                                        @if($errors->has('hotel_type'))
                                        <span class="text-danger">{{$errors->first('hotel_type')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.HOTEL_COST')</label>
                                        {!!Form::number('hotel_cost',!empty($target->hotel_cost)? $target->hotel_cost : old('hotel_cost'),['class'=>'form-control','id'=>'hotelCost','placeholder'=>"Enter hotel cost"])!!}
                                        @if($errors->has('hotel_cost'))
                                        <span class="text-danger">{{$errors->first('hotel_cost')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.AIR')</label>
                                        {!!Form::select('air',['yes'=>'Yes','no'=>'No'],!empty($target->air)? $target->air : old('air'),['class'=>'form-control','id'=>'air'])!!}
                                        @if($errors->has('air'))
                                        <span class="text-danger">{{$errors->first('air')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.TICKET_COST')</label>
                                        {!!Form::number('ticket_cost',!empty($target->ticket_cost)? $target->ticket_cost : old('ticket_cost'),['class'=>'form-control','id'=>'ticketCost','placeholder'=>"Enter ticket cost"])!!}
                                        @if($errors->has('ticket_cost'))
                                        <span class="text-danger">{{$errors->first('ticket_cost')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.CARRIER')</label>
                                        {!!Form::text('carrier',!empty($target->carrier)? $target->carrier : old('carrier'),['class'=>'form-control','id'=>'carrier','placeholder'=>"Enter carrier"])!!}
                                        @if($errors->has('carrier'))
                                        <span class="text-danger">{{$errors->first('carrier')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.TOUR_GUIDE')</label>
                                        {!!Form::select('tour_guide',['yes'=>'Yes','no'=>'No'],!empty($target->tour_guide)? $target->tour_guide : old('tour_guide'),['class'=>'form-control','id'=>'tour_guide'])!!}
                                        @if($errors->has('tour_guide'))
                                        <span class="text-danger">{{$errors->first('tour_guide')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.GUIDE_COST')</label>
                                        {!!Form::number('guide_cost',!empty($target->guide_cost)? $target->guide_cost : old('guide_cost'),['class'=>'form-control','id'=>'guideCost','placeholder'=>"Enter guide cost"])!!}
                                        @if($errors->has('guide_cost'))
                                        <span class="text-danger">{{$errors->first('guide_cost')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.TOTAL_DAYS')</label>
                                        {!!Form::text('total_dayes',!empty($target->total_dayes)? $target->total_dayes : old('total_dayes'),['class'=>'form-control','id'=>'totalDayes','placeholder'=>"Enter Duration"])!!}
                                        @if($errors->has('total_dayes'))
                                        <span class="text-danger">{{$errors->first('total_dayes')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.TRANSPORTATION')</label>
                                        {!!Form::select('transportation',['yes'=>'Yes','no'=>'No'],!empty($target->transportation)? $target->transportation : old('transportation'),['class'=>'form-control','id'=>'transportation'])!!}
                                        @if($errors->has('transportation'))
                                        <span class="text-danger">{{$errors->first('transportation')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('lang.TRANSPORT_COST')</label>
                                        {!!Form::number('transport_cost',!empty($target->transport_cost)? $target->transport_cost : old('transport_cost'),['class'=>'form-control','id'=>'transportCost','placeholder'=>"Enter transport cost"])!!}
                                        @if($errors->has('transport_cost'))
                                        <span class="text-danger">{{$errors->first('transport_cost')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('lang.ADD_MORE_COST')</label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field">
                                                <tr>
                                                    <td><input class="form-control name_list"  type="text" name="more_cost[0][title]" placeholder="Enter Title"/></td>
                                                    <td><input class="form-control amountArr"  type="number" name="more_cost[0][amount]" placeholder="Enter Amount"/></td>
                                                    <td width="10%"><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                                </tr>
                                            </table>
                                            <input type="hidden" name="" id="counter" value="{{$counter ?? 0}}">
                                        </div>
                                        <?php $i = 0; ?>
                                        @foreach($moreCostArr as $cost)
                                        @if(!empty($cost->title) && !empty($cost->amount))
                                        <?php $i++; ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td><input class="form-control name_list" value="{{$cost->title}}" type="text" name="more_cost[{{$i}}][title]" placeholder="Enter Title"/></td>
                                                    <td><input class="form-control amountArr" value="{{$cost->amount}}" type="number" name="more_cost[{{$i}}][amount]" placeholder="Enter Amount"/></td>
                                                    <td width="10%"><button type="button" name="remove"  class="btn btn-danger btn_remove">X</button></td>
                                                </tr>
                                            </table>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.TOTAL_PACKAGE_COST')</label>
                                        {!! Form::number('total_package_cost',!empty($target->total_package_cost)? $target->total_package_cost : old('total_package_cost'),['id' => 'totalPackageCost','class'=>'form-control','readonly']) !!}
                                        @if($errors->has('total_package_cost'))
                                        <span class="text-danger">{{$errors->first('total_package_cost')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.NOTE')</label>
                                        {!! Form::textarea('note',!empty($target->note)? $target->note : old('note'), ['id' => 'note', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
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
                                <a href="{{route('packageEntry.index')}}" class="btn btn-default ">Cancel</a>
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
    });
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
    });
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
    });


    $('#add').click(function () {
        var counter = $('#counter').val();
        counter++;
        $('#dynamic_field').append('<tr id="row' + counter + '" class="numbar"><td><input type="text" name="more_cost[' + counter + '][title]" placeholder="Enter Title" class="form-control name_list"/></td><td><input type="number" name="more_cost[' + counter + '][amount]" placeholder="Enter Amount" class="form-control amountArr"/></td><td><button type="button" name="remove" id="' + counter + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        $('#counter').val(counter);
    });
    $(document).on('click', '.btn_remove', function () {
        var counter = $('#counter').val();
        var row = $(this).closest("tr");
//        var siblings = row.siblings();
        row.remove();
//        refresh(siblings);
        counter--;
        $('#counter').val(counter);
    });


    $(document).on('keyup', '#hotelCost, #ticketCost, #guideCost, #transportCost,.amountArr', function () {
        var hotelCost = Number($('#hotelCost').val());
        var ticketCost = Number($('#ticketCost').val());
        var guideCost = Number($('#guideCost').val());
        var transportCost = Number($('#transportCost').val());

        var amountArr = [];
        $(".amountArr").each(function (index) {
            amountArr.push(parseFloat($(this).val()));
        });


        var sumOfDynamicInput = amountArr.reduce((a, b) => a + b);
        if (!isNaN(sumOfDynamicInput)) {
            sumOfDynamicInput = sumOfDynamicInput;
        } else {
            sumOfDynamicInput = 0;
        }


        var sumOfCostArr = [hotelCost, ticketCost, guideCost, transportCost];
        var sumOfCost = sumOfCostArr.reduce((a, b) => a + b);
        var SumOFtotal = sumOfCost + sumOfDynamicInput;
        $('#totalPackageCost').val(SumOFtotal);
    });

</script>

<script type="text/javascript">
    var i = <?php echo $i ?? 0 ?>;
    $(document).on('click', '#add', function () {
//        alert(i);return false;
        i++;
        $('#dynamic_field_file').append('<tr id="row' + i + '">' +
                '<td><img id="blah' + i + '" class="img-thambnail" src="{{asset('backend/dist/img/no_file.png')}}" alt="No file image" height="70px" width="70px;"></td>' +
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


