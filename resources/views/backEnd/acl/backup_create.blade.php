@extends('backEnd.layouts.master')
@section('content')
{!!Form::open(['route'=>['permission.store'],'class'=>'form-horizontal'])!!}
<!-- Content Wrapper. Contains page content -->
<input type="hidden" name="role_id" value="{{request()->route('role_id')}}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.ADD_PERMISSION')</h1>
                </div>
            </div>
            @include('backEnd.layouts.message')
        </div>
    </section>


    @if(!empty($operationArr))
    @foreach($operationArr as $moduleName => $operationsByModule)
    <?php echo "<pre>";print_r($operationArr[$moduleName]);exit;?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.DASHBOARD')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr[$moduleName]))
                                    @foreach($operationArr[$moduleName] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.DASHBOARD')</td>
                                    @if(!empty($operationArr['dashboard']))
                                    @foreach($operationArr['dashboard'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.USER')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered table-vcenter">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['user']))
                                    @foreach($operationArr['user'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!--[{{$operations['module_id']}}][{{$operations['id']}}]-->
                                    <td scope="row">@lang('lang.USER')</td>
                                    @if(!empty($operationArr['user']))
                                    @foreach($operationArr['user'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.USER_ROLE')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['user_role']))
                                    @foreach($operationArr['user_role'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.USER_ROLE')</td>
                                    @if(!empty($operationArr['user_role']))
                                    @foreach($operationArr['user_role'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.VISA')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['visa']))
                                    @foreach($operationArr['visa'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.VISA')</td>
                                    @if(!empty($operationArr['visa']))
                                    @foreach($operationArr['visa'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.PASSPORT')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['passport']))
                                    @foreach($operationArr['passport'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.PASSPORT')</td>
                                    @if(!empty($operationArr['passport']))
                                    @foreach($operationArr['passport'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.MEDICAL')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['medical']))
                                    @foreach($operationArr['medical'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.MEDICAL')</td>
                                    @if(!empty($operationArr['medical']))
                                    @foreach($operationArr['medical'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.TICKET')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['ticket']))
                                    @foreach($operationArr['ticket'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.TICKET')</td>
                                    @if(!empty($operationArr['ticket']))
                                    @foreach($operationArr['ticket'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.PACKAGE')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['package']))
                                    @foreach($operationArr['package'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.PACKAGE')</td>
                                    @if(!empty($operationArr['package']))
                                    @foreach($operationArr['package'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.BANK')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['bank']))
                                    @foreach($operationArr['bank'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.BANK')</td>
                                    @if(!empty($operationArr['bank']))
                                    @foreach($operationArr['bank'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.INVOICE')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['invoice']))
                                    @foreach($operationArr['invoice'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.INVOICE')</td>
                                    @if(!empty($operationArr['invoice']))
                                    @foreach($operationArr['invoice'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.ACL_REPORT')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['report']))
                                    @foreach($operationArr['report'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.ACL_REPORT')</td>
                                    @if(!empty($operationArr['report']))
                                    @foreach($operationArr['report'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.GENERAL_SETTING')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['general_setting']))
                                    @foreach($operationArr['general_setting'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.GENERAL_SETTING')</td>
                                    @if(!empty($operationArr['general_setting']))
                                    @foreach($operationArr['general_setting'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.ISSUE')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['issue']))
                                    @foreach($operationArr['issue'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.ISSUE')</td>
                                    @if(!empty($operationArr['issue']))
                                    @foreach($operationArr['issue'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>

    <!-- Product -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.PRODUCT')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['product']))
                                    @foreach($operationArr['product'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.PRODUCT')</td>
                                    @if(!empty($operationArr['product']))
                                    @foreach($operationArr['product'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Product -->


    <!--  Permission -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.PERMISSION')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['permission']))
                                    @foreach($operationArr['permission'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.PERMISSION')</td>
                                    @if(!empty($operationArr['permission']))
                                    @foreach($operationArr['permission'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Permission -->

    <!--  Transaction -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.TRANSACTION')</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!empty($operationArr['transaction']))
                                    @foreach($operationArr['transaction'] as $operations)
                                    <th class="text-center">{{$operations['operation']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">@lang('lang.TRANSACTION')</td>
                                    @if(!empty($operationArr['transaction']))
                                    @foreach($operationArr['transaction'] as $operations)
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline mx-auto">
                                            <input type="checkbox" name="accessArr[{{$operations['module_id']}}][{{$operations['id']}}]" id="checkboxPrimary{{$operations['id']}}" <?php if (in_array($operations['id'], $roleWisePermissionArr)) echo "checked" ?>>
                                            <label for="checkboxPrimary{{$operations['id']}}">
                                            </label>
                                        </div>
                                    </td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Transaction -->
    @endforeach
    @endif

    <div class="card-footer">
        <a href="{{route('permission.index')}}" class="btn btn-default ">Cancel</a>
        <button type="submit" class="btn btn-info float-right">Save</button>
    </div>
    {!!Form::close()!!}
</div>
@endsection




