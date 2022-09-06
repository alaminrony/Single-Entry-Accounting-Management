@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.PERMISSION')</h1>
                </div>
                <div class="col-sm-6">
                    <!--                    <div class="float-right mr-2">
                                            <a type="button" class="btn btn-success openCreateModal" data-toggle="modal" title="@lang('lang.VIEW_ISSUE')" data-target="#viewCreateModal"><i class="fa fa-plus-square"></i> Create role</a>
                                        </div>-->
                </div>
            </div>
            @include('backEnd.layouts.message')
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.ROLE_LIST')</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.USER_ROLE')</th>
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
                                        <td>{{$target->role_name}}</td>
                                        <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        <td>
                                            @if(!empty($accessArr['permission'][96]))
                                            <div style="float: left;margin-right:4px;">
                                                <a href="{{route('permission.create',$target->id)}}" class="btn btn-warning" title="@lang('lang.ADD_EDIT_PERMISSION')"><i class="fa fa-edit"></i></a>
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

@endsection

