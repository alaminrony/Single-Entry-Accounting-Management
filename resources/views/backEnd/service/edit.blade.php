<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> {!!__('lang.EDIT_SERVICE_CHARGE')!!}</h4>
    </div>
    <div class="modal-body">
        {!!Form::open(['id'=>'editFormData','class'=>'form-horizontal'])!!}
        <div class="card-body">
            {!!Form::hidden('id',$target->id)!!}
            
            <div class="form-group row">
                <label for="user_id" class="col-sm-4 col-form-label">@lang('lang.PARTY') :</label>
                <div class="input-group date col-md-8"  data-target-input="nearest">
                    {!!Form::select('agent_id',$users,$target->agent_id,['class'=>'form-control select2','id'=>'User']) !!}
                    <div class="input-group-append">
                        <a type="button" class="input-group-text bg-secondary openUserCreateModal" data-toggle="modal" title="@lang('lang.VIEW_ISSUE')" data-target="#viewUserCreateModal"><i class="fa fa-plus-square"></i></a>
                    </div>
                    <span class="text-danger" id="agent_id_error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="service_name" class="col-sm-4 col-form-label">@lang('lang.SERVICES_NAME') :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="service_name" placeholder="Enter service name" name="service_name" value="{{$target->service_name??''}}" required/>
                    <span class="text-danger" id="service_name_error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="charge" class="col-sm-4 col-form-label">@lang('lang.CHARGE') :</label>
                <div class="col-sm-8">
                    <input type="number" value="{{$target->charge??''}}" class="form-control" id="charge" placeholder="Enter charge" name="charge"/>
                    <span class="text-danger" id="charge_error"></span>
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



