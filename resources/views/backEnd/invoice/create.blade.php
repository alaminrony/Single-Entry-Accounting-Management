@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.CREATE_INVOICE') for {{$issueArr[request()->route('issue_id')] ?? ''}}</h1>
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
                            <h3 class="card-title">@lang('lang.CREATE_INVOICE')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        {!!Form::open(['route'=>['invoice.store',request()->route('issue_id')],'class'=>'form-horizontal','enctype' => 'multipart/form-data'])!!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.INVOICE_ID') <span class="text-danger">*</span></label>
                                        {!!Form::text('invoice_code',$invoiceCode,['class'=>'form-control','id'=>'invoice_code','readonly'])!!}
                                        @if($errors->has('invoice_code'))
                                        <span class="text-danger">{{$errors->first('invoice_code')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.INVOICE_DATE')</label>
                                        <div class="input-group date" id="visa_issue_date" data-target-input="nearest">
                                            <input type="text" name='inv_date' class="form-control datetimepicker-input" data-target="#visa_issue_date" value="{{old('inv_date')}}" placeholder="yyyy/mm/yy" id="visaIssueDate"/>
                                            <div class="input-group-append" data-target="#visa_issue_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('inv_date'))
                                        <span class="text-danger">{{$errors->first('inv_date')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.DUE_DATE')</label>
                                        <div class="input-group date" id="passport_issue_date" data-target-input="nearest">
                                            <input type="text" name='due_date' class="form-control datetimepicker-input" data-target="#passport_issue_date" value="{{old('due_date')}}" placeholder="yyyy/mm/yy" id="visaIssueDate"/>
                                            <div class="input-group-append" data-target="#passport_issue_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if($errors->has('due_date'))
                                        <span class="text-danger">{{$errors->first('due_date')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if(request()->route('issue_id') == 0)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.ISSUE') <span class="text-danger">*</span></label>
                                        {!!Form::select('select_issue_id',$issueArr??'',old('select_issue_id'),['class'=>'form-control select2','id'=>'selectIssueId'])!!}
                                        @if($errors->has('select_issue_id'))
                                        <span class="text-danger">{{$errors->first('select_issue_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.CUSTOMER_CODE') <span class="text-danger">*</span></label>
                                        {!!Form::select('customer_code',$cusCode??'',old('customer_code'),['class'=>'form-control select2','id'=>'customerCode'])!!}
                                        @if($errors->has('customer_code'))
                                        <span class="text-danger">{{$errors->first('customer_code')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="bill_to" class="col-form-label">@lang('lang.BILL_TO') <span class="text-danger">*</span>:</label>
                                <div class="input-group date col-md-6"  data-target-input="nearest">
                                    {!!Form::select('bill_to',$users,'',['class'=>'form-control select2','id'=>'bill_to']) !!}
                                    <div class="input-group-append col-md-2">
                                        <a type="button" class="input-group-text bg-secondary openUserCreateModal" data-toggle="modal" title="@lang('lang.VIEW')" data-target="#viewUserCreateModal"><i class="fa fa-plus-square"></i></a>
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('bill_to'))
                            <span class="text-danger">{{$errors->first('bill_to')}}</span>
                            @endif

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.BILLING_STREET')</label>
                                        {!!Form::text('billing_street',old('billing_street'),['class'=>'form-control','id'=>'billing_street','placeholder'=>"Enter billing street"])!!}
                                        @if($errors->has('billing_street'))
                                        <span class="text-danger">{{$errors->first('billing_street')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.BILLING_CITY')</label>
                                        {!!Form::text('billing_city',old('billing_city'),['class'=>'form-control','id'=>'billing_city','placeholder'=>"Enter billing city"])!!}
                                        @if($errors->has('billing_city'))
                                        <span class="text-danger">{{$errors->first('billing_city')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang.BILLING_ZIP')</label>
                                        {!!Form::text('billing_zip',old('billing_zip'),['class'=>'form-control','id'=>'billing_zip','placeholder'=>"Enter billing zip"])!!}
                                        @if($errors->has('billing_zip'))
                                        <span class="text-danger">{{$errors->first('billing_zip')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="productId" class="col-form-label">@lang('lang.ADD_PRODUCT') :</label>
                                <div class="input-group date col-md-6"  data-target-input="nearest">
                                    {!!Form::select('product_id',$products,'',['class'=>'form-control select2','id'=>'productId']) !!}
                                    {!!Form::select('product_price',$productPrice,'',['class'=>'form-control d-none','id'=>'productPrice']) !!}
                                    <div class="input-group-append col-md-2">
                                        <a type="button" class="input-group-text bg-secondary openProductCreateModal" data-toggle="modal" title="@lang('lang.VIEW')" data-target="#viewProductCreateModal"><i class="fa fa-plus-square"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12">
                                    <!--<h4 style="text-align: center;margin-top: 0px;">Document Management</h4>-->
                                    <div class = "form-group">
                                        <div class ="table-responsive">
                                            <table class ="table table-bordered" id="dynamic_field">
                                                <thead>
                                                    <tr style="background-color: #3a75b5 !important;">
                                                        <th>Product</th>
                                                        <th>Description</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th>Tax(%)</th>
                                                        <th>Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="numbar">
                                                        <td style="display: none;"><input  name="dynamic_product_id[]" value="" id="pId-1"></td>
                                                        <td><textarea name="product_name[]" class="form-control" rows="2" cols="30" style="resize:none;" id="dProId-1"  readonly="readonly"></textarea></td>
                                                        <td><textarea name="description[]" class="form-control" rows="2" cols="30" style="resize:none;"></textarea></td>
                                                        <td><input type="number" name="quantity[]" value="" placeholder="Enter quantity" class="form-control quantity" id="qty-1" target-qty="1"></td>
                                                        <td><input type="number" name="unit_price[]"  placeholder="Enter unit price" class="form-control" id="productPrice-1"></td>
                                                        <td><input type="text" name="tax[]" class="form-control tax"  placeholder="Enter tax"  id="tax-1" target-tax="1"></td>
                                                        <td><input type="text" name="total[]"  class="form-control"  placeholder="Enter total"  id="total-1" required=""></td>
                                                        <td><button type ="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus font-red"></i></button></td>
                                                    </tr>
                                                <tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="2">Sub Total</td>
                                                        <td colspan="6" id="subTotal">0.00</td>
                                                        <td style="display: none;"><input type="text" name="sub_total" id="subTotalHiddenValue"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="2"><input type="text" class="form-control"  placeholder="Enter Discount(%)"  id="discountAmount"></td>
                                                        <td colspan="6" id="discountVal">0.00</td>
                                                        <td style="display: none;"><input type="text" name="discount" id="discountHiddenValue"/></td>
                                                        <td style="display: none;"><input type="text" name="discount_percent" id="discountPercentHiddenValue"/></td>
                                                    </tr>                                   
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td colspan="2">Total</td>
                                                        <td colspan="6" id="totalVal">0.00</td>
                                                        <td style="display: none;"><input type="text" name="amount_total" id="totalHiddenValue"/></td>
                                                    </tr>                                   
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="fieldCount" value="1" id="fieldCount">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.NOTE')</label>
                                        {!! Form::textarea('invoicenote', null, ['id' => 'invoicenote', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('invoicenote'))
                                        <span class="text-danger">{{$errors->first('invoicenote')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('lang.TERMS_AND_CONDITION')</label>
                                        {!! Form::textarea('terms', null, ['id' => 'note', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none','class'=>'form-control']) !!}
                                        @if($errors->has('terms'))
                                        <span class="text-danger">{{$errors->first('terms')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{route('visaEntry.index')}}" class="btn btn-default ">Cancel</a>
                                <input type="submit" name="status" value="Save" class="btn btn-primary float-right ml-1">
                                <input type="submit" name="status" value="Save as Draft" class="btn btn-info float-right">
                            </div>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
    </section>
</div>


<div class="modal fade" id="viewCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="CreateModalShow">
        </div>
    </div>
</div>

<!--view contact Number Modal -->
<div class="modal fade" id="viewCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div id="CreateModalShow">
        </div>
    </div>
</div>
<!--end view Modal -->
<!--view contact Number Modal -->
<div class="modal fade" id="viewEditModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div id="editModalShow">
        </div>
    </div>
</div>
<!--end view Modal -->

<!--view contact Number Modal -->
<div class="modal fade" id="viewProductCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div id="CreateProductModalShow">
        </div>
    </div>
</div>
<!--end view Modal -->

<!--create  Modal -->
<div class="modal fade" id="viewUserCreateModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="CreateUserModalShow">
        </div>
    </div>
</div>
<!--end create Modal -->
@endsection
@push('script')
<script type="text/javascript">

    let issueId = <?php echo request()->route('issue_id'); ?>;
    console.log(issueId);
    if (issueId != '') {
        $.ajax({
            url: "{{route('invoice.getCustomerCode')}}",
            data: {issueId: issueId},
            type: "post",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#customerCode').html(data.html);
            }
        });
    }

    var productObj = <?php echo json_encode($products) ?>;
    var productArr = [];
    Object.keys(productObj).forEach(function (index) {
        productArr[index] = productObj[index];
    });
    var productPriceObj = <?php echo json_encode($productPrice) ?>;
    var productPriceArr = [];
    Object.keys(productPriceObj).forEach(function (index) {
        productPriceArr[index] = productPriceObj[index];
    });
    $(document).ready(function () {
        $('.select2').select2();
        $('#passport_issue_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#visa_issue_date').datetimepicker({
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
//    var i = 1;
    let i = parseInt($('#fieldCount').val());
    $(document).on('click', '#add', function () {
        i++;
        $('#dynamic_field').append('<tr id="row' + i + '">' +
                '<td style="display: none;"><input  name="dynamic_product_id[]" value="" id="pId-' + i + '"></td>' +
                '<td><textarea name="product_name[]" class="form-control" rows="2" cols="30" style="resize:none;" id="dProId-' + i + '" required readonly></textarea></td>' +
                '<td><textarea name="description[]" class="form-control" rows="2" cols="30" style="resize:none;"></textarea></td>' +
                '<td><input type="number" name="quantity[]" value="" placeholder="Enter quantity" class="form-control quantity" id="qty-' + i + '" target-qty="' + i + '"></td>' +
                '<td><input type="number" name="unit_price[]"  placeholder="Enter unit price" class="form-control" id="productPrice-' + i + '"></td>' +
                '<td><input type="text" name="tax[]"  class="form-control tax"  placeholder="Enter tax" id="tax-' + i + '" target-tax="' + i + '"></td>' +
                '<td><input type="number" name="total[]" value=""  class="form-control"  placeholder="Enter total" id="total-' + i + '"></td>' +
                '<td><button type ="button"  name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fa fa-times font-red"></i></button></td>' +
                '</tr>')
        productName(i);
        let fCount = parseInt($('#fieldCount').val());
        $('#fieldCount').val(fCount + 1);
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();

        let fCount = parseInt($('#fieldCount').val());
        $('#fieldCount').val(fCount - 1);
    });

    $(document).on('click', '.openProductCreateModal', function () {
        $.ajax({
            url: "{{route('product.create')}}",
            type: "post",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#CreateProductModalShow').html(data.data);
            }
        });
    });

    $(document).on('click', '#createProduct', function () {
        var data = new FormData($('#createProductFormData')[0]);
        if (data != '') {
            $.ajax({
                url: "{{route('product.store')}}",
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
                    if (data.errors) {
                        $("#name_error").text(data.errors.name);
                    }
                    if (data.response == "success") {
//                        setTimeout(function () {
//                            location.reload();
//                        }, 1000);
                        $('#viewProductCreateModal').modal('hide');
                        toastr.success("@lang('lang.PRODUCT_CREATED_SUCCESSFULLY')", 'Success', {timeOut: 5000});
//                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
                        var newOption = new Option(data.name, data.id, true, true);

                        $('#productId').append(newOption).trigger('change');
                    }
                }
            });
        }
    });

    $(document).on('change', '#productId', function () {
        var productId = $(this).val();

        let fCount = parseInt($('#fieldCount').val());
        console.log(fCount);
//        alert(fCount);
//        return false;
        if (productId != '' && productArr[productId] != '') {
            $("#dProId-" + fCount).val(productArr[productId]);
            $("#pId-" + fCount).val(productId);
            $("#productPrice-" + fCount).val(productPriceArr[productId]);
        } else {
            $("#dProId-" + fCount).val('');
            $("#pId-" + fCount).val('');
            $("#productPrice-" + fCount).val('');
        }
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
//                            toastr["success"]("@lang('label.MEET_UP_HAS_BEEN_UPDATED_SUCCESSFULLY')");
                        var newOption = new Option(data.name, data.id, true, true);
                        // Append it to the select
                        $('#bill_to').append(newOption).trigger('change');
                    }
                }
            });
        }
    });
    function productName(i) {
        var productId = $('#productId').val();
        var productObj = <?php echo json_encode($products) ?>;
        var productArr = [];
        Object.keys(productObj).forEach(function (index) {
            productArr[index] = productObj[index];
        });
//        alert(productArr[productId]);
//        return false;

        if (productId != '' && productArr[productId] != '') {
            $("#dProId-" + i).val(productArr[productId]);
        } else {
            $("#dProId-" + i).val('');
        }
    }

    $(document).on('keyup', '.quantity', function () {
        let qtyId = $(this).attr('target-qty');
        var qtyValue = parseInt($("#qty-" + qtyId).val());
        var pPrice = parseFloat($("#productPrice-" + qtyId).val());
        if (qtyValue != '') {
            $("#total-" + qtyId).val(qtyValue * pPrice);
        } else {
            $("#total-" + qtyId).val();
        }
        totalSum();
    });
    $(document).on('blur', '.tax', function () {
        var taxId = $(this).attr('target-tax');
        var taxValue = parseFloat($("#tax-" + taxId).val());
        var totalPrice = parseFloat($("#total-" + taxId).val());
        var withTax = (((taxValue * totalPrice) / 100) + totalPrice);
        console.log(withTax);
        if (totalPrice != '' && taxValue != '') {
            $("#total-" + taxId).val(withTax);
        } else {
            $("#total-" + taxId).val('');
        }
        totalSum();
    });
    $(document).on('blur', '#discountAmount', function () {
        var discount = $(this).val();
        var subTotal = parseInt($('#subTotal').text());
        var discountPercent = (subTotal * discount) / 100;
        var withoutDiscount = subTotal - discountPercent;
        if (discount != '' && subTotal != '') {
            console.log(withoutDiscount);
            $("#discountVal").text(discountPercent);
            $("#totalVal").text(withoutDiscount);
            $("#totalHiddenValue").val(withoutDiscount);
            $("#discountHiddenValue").val(discountPercent);
            $("#discountPercentHiddenValue").val(discount);
        } else {
            $("#discountVal").text('');
            $("#totalVal").text('');
            $("#totalHiddenValue").val('');
            $("#discountHiddenValue").val('');
            $("#discountPercentHiddenValue").val('');
        }
    });

    $(document).on('change', '#selectIssueId', function () {
        var issueId = $(this).val();
        if (issueId != '') {
            $.ajax({
                url: "{{route('invoice.getCustomerCode')}}",
                data: {issueId: issueId},
                type: "post",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data);
//                    customerCode
                    $('#customerCode').html(data.html);
                }
            });
        }
    });
    function totalSum() {
        var test_qty = 0
        $("input[name^='total']").each(function () {
            test_qty += parseInt($(this).val(), 10)
        })
        $('#subTotal').text(test_qty);
        $('#subTotalHiddenValue').val(test_qty);
        $("#totalVal").text(test_qty);
        $("#totalHiddenValue").val(test_qty);
    }
</script>
@endpush


