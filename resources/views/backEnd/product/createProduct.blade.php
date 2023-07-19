<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-square"></i> {!!__('lang.CREATE_PRODUCT')!!}</h4>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" id="createProductFormData" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">@lang('lang.PRODUCT_NAME') :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required/>
                        <span class="text-danger" id="name_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-4 col-form-label">@lang('lang.PRICE') :</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="price" placeholder="Enter price" name="price"/>
                        <span class="text-danger" id="price_error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="issue_title" class="col-sm-4 col-form-label">@lang('lang.STATUS') :</label>
                    <div class="col-sm-8">
                        {!!Form::select('status',['1'=>'Active','2'=>'Inactive'],'',['class'=>'form-control','id'=>'status']) !!}
                    </div>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <fieldset class="w-100">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" id="createProduct" class="btn btn-secondary float-right" >Save</button>
        </fieldset>
    </div>
</form>
</div>



