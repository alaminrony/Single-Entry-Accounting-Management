@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.SERVICE_CHARGE')</h1>
                </div>
                @if(!empty($accessArr['service_contract'][119]))
                <div class="col-sm-6">
                    <div class="float-right mr-2">
                        <a type="button" class="btn btn-success openProductCreateModal" data-toggle="modal" title="@lang('lang.CREATE')" data-target="#viewProductCreateModal"><i class="fa fa-plus-square"></i> {{__('lang.CREATE_SERVICE_CHARGE')}}</a>
                    </div>
                </div>
                @endif
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

    @if(!empty($accessArr['service_contract'][122]))
    <section class="content">
        <div class="container-fluid">
            {!!Form::open(['route'=>'serviceCharge.filter','method'=>'GET'])!!}
            <input type="hidden" name='filter' value="true">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('lang.TEXT'):</label>
                                {!!Form::text('search_value',Request::get('search_value'),['class'=>'form-control','id'=>'search_value','width'=>'100%']) !!}
                                @if($errors->has('search_value'))
                                <span class="text-danger">{{$errors->first('search_value')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label></label>
                                <div class="input-group">
                                    <div class="float-right mt-2">
                                        <button type="submit" class="btn btn-warning" title="submit" ><i class="fa fa fa-search"></i> @lang('lang.SUBMIT')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </section>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.SERVICE_CHARGE_LIST')</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.AGENT')</th>
                                        <th>@lang('lang.SERVICE_NAME')</th>
                                        <th>@lang('lang.CHARGE')</th>
                                        <th>@lang('lang.CREATED_AT')</th>
                                        <th>@lang('lang.ACTION')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($targets->isNotEmpty())
                                    <?php $i = 0; ?>
                                    @foreach($targets as $target)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$users[$target->agent_id]}}</td>
                                        <td>{{$target->service_name}}</td>
                                        <td>{{$target->charge}}</td>
                                        <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        <td>
                                            <div style="float: left;margin-right:4px;">
                                                @if(!empty($accessArr['service_contract'][123]))
                                                <a type="button" class="btn btn-success  openViewModal" data-toggle="modal" title="@lang('lang.VIEW_USER')" data-target="#viewModal" data-id="{{$target->id}}"><i class="fa fa-eye"></i></a>
                                                @endif

                                                @if(!empty($accessArr['service_contract'][120]))
                                                <a type="button" class="btn btn-warning openProductEditModal" data-toggle="modal" title="@lang('lang.EDIT')" data-target="#viewProductEditModal" data-id="{{$target->id}}"><i class="fa fa-edit"></i></a>
                                                @endif
                                            </div>
                                            @if(!empty($accessArr['service_contract'][121]))
                                            <div style="float: left;">
                                                {!!Form::open(['route'=>['serviceCharge.destroy',$target->id]])!!}
                                                @method('DELETE')
                                                <button type="submit" title="@lang('lang.DELETE')" class="btn btn-danger deleteBtn"><i class="fa fa-trash"></i></button>
                                                {!!Form::close()!!}
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>No Data Found</tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {!!$targets->links('pagination::bootstrap-4')!!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<!--view contact Number Modal -->
<div class="modal fade" id="viewProductCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div id="CreateProductModalShow">
        </div>
    </div>
</div>
<!--end view Modal -->
<!--view contact Number Modal -->
<div class="modal fade" id="viewProductEditModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div id="editProductModalShow">
        </div>
    </div>
</div>
<!--end view Modal -->

<div class="modal fade" id="viewUserCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="CreateUserModalShow">
        </div>
    </div>
</div>

<!--view  Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div id="viewModalShow">
        </div>
    </div>
</div>
<!--end view Modal -->
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();

        $(document).on('click', '.openProductCreateModal', function () {
            $.ajax({
                url: "{{route('serviceCharge.create')}}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#CreateProductModalShow').html(data.data);
                    $('.select2').select2();
                }
            });
        });

        $(document).on('click', '#createService', function () {
            var data = new FormData($('#createServiceFormData')[0]);
            if (data != '') {
                $.ajax({
                    url: "{{route('serviceCharge.store')}}",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $("#agent_id_error").text('');
                        $("#service_name_error").text('');
                        $("#charge_error").text('');
                        if (data.errors) {
                            $("#agent_id_error").text(data.errors.agent_id);
                            $("#service_name_error").text(data.errors.service_name);
                            $("#charge_error").text(data.errors.charge);
                        }
                        if (data.response == "success") {
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                            $('#viewProductCreateModal').modal('hide');
                            toastr.success("@lang('lang.SERVICE_CREATED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
//                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.openProductEditModal', function () {
            var id = $(this).attr('data-id');
            if (id != '') {
                $.ajax({
                    url: "{{route('serviceCharge.edit')}}",
                    type: "post",
                    data: {id: id},
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#editProductModalShow').html(data.data);
                        $('.select2').select2();
                    }
                });
            }
        });

        $(document).on('click', '#update', function () {
            var data = new FormData($('#editFormData')[0]);
            if (data != '') {
                $.ajax({
                    url: "{{route('serviceCharge.update')}}",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $("#agent_id_error").text('');
                        $("#service_name_error").text('');
                        $("#charge_error").text('');
                        if (data.errors) {
                            $("#agent_id_error").text(data.errors.agent_id);
                            $("#service_name_error").text(data.errors.service_name);
                            $("#charge_error").text(data.errors.charge);
                        }
                        if (data.response == "success") {
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                            $('#viewProductEditModal').modal('hide');
                            toastr.success("@lang('lang.SERVICE_UPDATED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
//                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
                        }
                    }
                });
            }
        });




        $('.deleteBtn').on('click', function (e) {
            event.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Are you sure?",
                text: "You want to delete this, you can't recover this data again.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, DELETE it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            form.submit();
                        } else {
                            swal("Cancelled", "Your Record is safe :)", "error");

                        }
                    });
        });


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
                $('#CreateUserModalShow').html(data.data);
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

    $(document).on('click', '.openViewModal', function () {
        var id = $(this).attr('data-id');
        if (id != '') {
            $.ajax({
                url: "{{route('serviceCharge.view')}}",
                type: "post",
                data: {id: id},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#viewModalShow').html(data.data);
                }
            });
        }
    });
</script>
@endpush
