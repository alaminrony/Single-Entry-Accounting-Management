<div class="modal-content">
    <div class="modal-header clone-modal-header bg-secondary">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> {!!__('lang.VIEW_SERVICE_CONTRACT')!!}</h4>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>@lang('lang.PARTY')</strong> </td>
                            <td>{{$users[$target->agent_id]}}</td>
                        </tr>
                        <tr>
                            <td><strong>@lang('lang.SERVICES_NAME')</strong> </td>
                            <td>{{$target->service_name}}</td>
                        </tr>
                        <tr>
                            <td><strong>@lang('lang.CHARGE')</strong> </td>
                            <td>{{$target->charge}}</td>
                        </tr>
                        <tr>
                            <td><strong>@lang('lang.CREATED_AT')</strong> </td>
                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <fieldset class="w-100">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </fieldset>
    </div>
    {!!Form::close()!!}
</div>



