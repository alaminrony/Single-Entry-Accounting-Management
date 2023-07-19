<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> {!!__('lang.EDIT_PRODUCT')!!}</h4>
    </div>
    <div class="modal-body">
        {!!Form::open(['id'=>'editFormData','class'=>'form-horizontal'])!!}
        <div class="card-body">
            {!!Form::hidden('id',$target->id)!!}
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">@lang('lang.PRODUCT_NAME') :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$target->name}}" required/>
                    <span class="text-danger" id="name_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-4 col-form-label">@lang('lang.PRICE') :</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{$target->price}}" />
                    <span class="text-danger" id="price_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-4 col-form-label">@lang('lang.STATUS') :</label>
                <div class="col-sm-8">
                    {!!Form::select('status',['1'=>'Active','2'=>'Inactive'],$target->status,['class'=>'form-control','id'=>'status']) !!}
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



