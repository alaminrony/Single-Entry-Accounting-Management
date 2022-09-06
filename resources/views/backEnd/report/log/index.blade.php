@extends('backEnd.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.LOG')</h1>
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
                            <h3 class="card-title">@lang('lang.LOG_LIST')</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>@lang('lang.ISSUE_TYPE')</th>
                                        <th>@lang('lang.ISSUE_ID')</th>
                                        <th>@lang('lang.ACTION')</th>
                                        <th>@lang('lang.IP_ADDRESS')</th>
                                        <th>@lang('lang.USER')</th>
                                        <th>@lang('lang.CREATED_AT')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($targets as $target)
                                    <?php
                                    $i++;
                                    ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$target->issue_type}}</td>
                                        <td>{{Helper::getIssueCode($target->issue_type,$target->issue_id) ?? ''}}</td>
                                        <td>{{$target->action}}</td>
                                        <td>{{$target->ip_address}}</td>
                                        <td>{{$users[$target->user_id]?? ''}}</td>
                                        <td>{{Helper::dateFormat($target->created_at)}}</td>
                                    </tr>
                                    @endforeach
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

