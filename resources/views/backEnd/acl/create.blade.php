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
    <?php $module_name = !empty($moduleName) ? ucwords(str_replace('_', ' ', $moduleName)) : ''; ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">{{$module_name}}</h3>
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
                                    <td scope="row">{{$module_name}}</td>
                                    @if(!empty($operationArr[$moduleName]))
                                    @foreach($operationArr[$moduleName] as $operations)
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
    @endforeach
    @endif
    <div class="card-footer">
        <a href="{{route('permission.index')}}" class="btn btn-default ">Cancel</a>
        <button type="submit" class="btn btn-info float-right">Save</button>
    </div>
    {!!Form::close()!!}
</div>
@endsection




