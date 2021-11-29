@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.MEDICAL')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('lang.VIEW_MEDICAL')</h3>
                            <div class="float-right">
                                <a href="{{url('admin/medical-entry/'.$target->id.'/view?view=print')}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/medical-entry/'.$target->id.'/view?view=pdf')}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>
                                <a href="{{url('admin/medical-entry/'.$target->id.'/view?view=excel')}}" class="btn btn-success"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <table class="table table-bordered" id='Target'>
                                    <tbody>
                                        <tr>
                                            <td><strong>@lang('lang.CUSTOMER_CODE')</strong> </td>
                                            <td>{{$target->customer_code ?? ''}}</td>
                                        </tr>

                                        @if(!empty($target->country_id))
                                        <tr>
                                            <td><strong>@lang('lang.COUNTRY')</strong> </td>
                                            <td>{{$countries[$target->country_id]}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->type_id))
                                        <tr>
                                            <td><strong>@lang('lang.ENTRY_TYPE')</strong> </td>
                                            <td>{{$entryTypes[$target->type_id]}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->year))
                                        <tr>
                                            <td><strong>@lang('lang.YEAR')</strong> </td>
                                            <td>{{$target->year}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->name))
                                        <tr>
                                            <td><strong>@lang('lang.NAME')</strong> </td>
                                            <td>{{$target->name}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->passport_no))
                                        <tr>
                                            <td><strong>@lang('lang.PASSPORT_NO')</strong> </td>
                                            <td>{{$target->passport_no}}</td>
                                        </tr>
                                        @endif



                                        @if(!empty($target->passport_issue_date))
                                        <tr>
                                            <td><strong>@lang('lang.PASSPORT_ISSUE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->passport_issue_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->passport_recieve_date))
                                        <tr>
                                            <td><strong>@lang('lang.PASSPORT_RECEIVE_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->passport_recieve_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->passport_expiry_date))
                                        <tr>
                                            <td><strong>@lang('lang.PASSPORT_EXPIRY_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->passport_expiry_date)}}</td>
                                        </tr>
                                        @endif




                                        @if(!empty($target->fit_date))
                                        <tr>
                                            <td><strong>@lang('lang.FIT_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->fit_date)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->UNFIT_DATE))
                                        <tr>
                                            <td><strong>@lang('lang.UNFIT_DATE')</strong> </td>
                                            <td>{{Helper::dateFormat2($target->UNFIT_DATE)}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->contact_no))
                                        <tr>
                                            <td><strong>@lang('lang.CONTACT_NO')</strong> </td>
                                            <td>{{$target->contact_no}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->contact_purpose))
                                        <tr>
                                            <td><strong>@lang('lang.CONTACT_PURPOSE')</strong> </td>
                                            <td>{{$target->contact_purpose}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->contact_person))
                                        <tr>
                                            <td><strong>@lang('lang.CONTACT_PERSON')</strong> </td>
                                            <td>{{$target->contact_person}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($target->center_name))
                                        <tr>
                                            <td><strong>@lang('lang.CENTER_NAME')</strong> </td>
                                            <td>{{$target->center_name}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($target->ref))
                                        <tr>
                                            <td><strong>@lang('lang.REF')</strong> </td>
                                            <td>{{$target->ref}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td><strong>@lang('lang.CREATED_AT')</strong> </td>
                                            <td>{{Helper::dateFormat($target->created_at)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group row">
                                    <div class="col-md-10">
                                         <h4 style="text-align: center;margin-top: 0px;">Document Management</h4>
                                        <div class = "form-group">
                                            <div class ="table-responsive">
                                                <table class ="table table-bordered" id="dynamic_field">
                                                    <thead>
                                                    <th>File</th>
                                                    <th>Caption</th>
                                                    <th>Serial</th>
                                                    <th>Status</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $files = $target->attachments;
                                                        $totalFile = count($files);
                                                        ?>
                                                        @if($totalFile > 0)
                                                        <?php $i = 0; ?>
                                                        @foreach($files as $file)
                                                        <?php
                                                        $i++;
                                                        $fileExt = explode('.', $file->doc_name);
                                                        ?>
                                                        <tr class="numbar">
                                                            @if(!empty($file->doc_name) && end($fileExt) == 'pdf')
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/pdf.png')}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @elseif(!empty($file->doc_name) && end($fileExt) == 'doc')
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah0" class="img-thambnail" src="{{asset('backend/dist/img/doc.png')}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @else
                                                            <td width='10%'><a href="{{asset($file->doc_name)}}" download><img id="blah{{$i-1}}" class="img-thambnail" src="{{asset($file->doc_name)}}" alt="your image" height="70px" width="70px;"></a></td>
                                                            @endif
                                                            <td>{{$file->title}}</td>
                                                            <td>{{$file->serial}}</td>
                                                            @if($file->status == '1')
                                                            <td><button  class="btn btn-success">Active</button></td>
                                                            @else
                                                            <td><button  class="btn btn-danger">Inactive</button></td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a type="button" href="#" onclick="window.history.back()" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

