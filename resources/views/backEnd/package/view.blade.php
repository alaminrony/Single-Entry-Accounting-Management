@extends('backEnd.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('lang.VIEW_PACKAGE')</h1>
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
                            <h3 class="card-title">@lang('lang.VIEW_PACKAGE')</h3>
                            <div class="float-right">
                                <a href="{{url('admin/package-entry/'.$target->id.'/view?view=print')}}" class="btn btn-primary"  title="@lang('lang.PRINT')"><i class="fa fa-print"></i></a>
                                <a href="{{url('admin/package-entry/'.$target->id.'/view?view=pdf')}}" class="btn btn-warning"  title="@lang('lang.PDF')"><i class="fa fa-file-pdf"></i></a>
                                <a href="{{url('admin/package-entry/'.$target->id.'/view?view=excel')}}" class="btn btn-success"  title="@lang('lang.EXCEL')"><i class="fa fa-file-excel"></i></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <table class="table table-bordered" id='Target'>
                                    <tbody>
                                        @if(!empty($target->name))
                                        <tr>
                                            <td><strong>@lang('lang.PACKAGE_NAME')</strong> </td>
                                            <td>{{$target->name}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->from))
                                        <tr>
                                            <td><strong>@lang('lang.FROM')</strong> </td>
                                            <td>{{$target->from}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->to))
                                        <tr>
                                            <td><strong>@lang('lang.TO')</strong> </td>
                                            <td>{{$target->to}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->adult))
                                        <tr>
                                            <td><strong>@lang('lang.NUM_OF_ADULT')</strong> </td>
                                            <td>{{$target->adult}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->children))
                                        <tr>
                                            <td><strong>@lang('lang.NUM_OF_CHILDREN')</strong> </td>
                                            <td>{{$target->children}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->hotel))
                                        <tr>
                                            <td><strong>@lang('lang.HOTEL')</strong> </td>
                                            <td>{{$target->hotel}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->hotel_type))
                                        <tr>
                                            <td><strong>@lang('lang.HOTEL_TYPE')</strong> </td>
                                            <td>{{$hotelType[$target->hotel_type]??''}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->hotel_cost))
                                        <tr>
                                            <td><strong>@lang('lang.HOTEL_COST')</strong> </td>
                                            <td>{{$target->hotel_cost}}</td>
                                        </tr>
                                        @endif 

                                        @if(!empty($target->air))
                                        <tr>
                                            <td><strong>@lang('lang.AIR')</strong> </td>
                                            <td>{{$target->air}}</td>
                                        </tr>
                                        @endif 

                                        @if(!empty($target->ticket_cost))
                                        <tr>
                                            <td><strong>@lang('lang.TICKET_COST')</strong> </td>
                                            <td>{{$target->ticket_cost}}</td>
                                        </tr>
                                        @endif   

                                        @if(!empty($target->carrier))
                                        <tr>
                                            <td><strong>@lang('lang.CARRIER')</strong> </td>
                                            <td>{{$target->carrier}}</td>
                                        </tr>
                                        @endif   


                                        @if(!empty($target->tour_guide))
                                        <tr>
                                            <td><strong>@lang('lang.TOUR_GUIDE')</strong> </td>
                                            <td>{{$target->tour_guide}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->guide_cost))
                                        <tr>
                                            <td><strong>@lang('lang.GUIDE_COST')</strong> </td>
                                            <td>{{$target->guide_cost}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->total_dayes))
                                        <tr>
                                            <td><strong>@lang('lang.TOTAL_DAYS')</strong> </td>
                                            <td>{{$target->total_dayes}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->transportation))
                                        <tr>
                                            <td><strong>@lang('lang.TRANSPORTATION')</strong> </td>
                                            <td>{{$target->transportation}}</td>
                                        </tr>
                                        @endif


                                        @if(!empty($target->transport_cost))
                                        <tr>
                                            <td><strong>@lang('lang.TRANSPORT_COST')</strong> </td>
                                            <td>{{$target->transport_cost}}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($target->other_cost))
                                        <tr>
                                            <td><strong>@lang('lang.OTHER_COST')</strong> </td>
                                            <td>{{$target->other_cost}}</td>
                                        </tr>
                                        @endif

                                        @if(count($moreCosts) > 0)
                                        <?php $i = 0; ?>
                                        @foreach($moreCosts as $cost)
                                        <?php $i++; ?>
                                        <tr>
                                            <td><strong>@lang('lang.MORE_COST') {{$i}}</strong> </td>
                                            <td>
                                                <strong>Title:</strong> {{$cost->title}} <strong>Amount:</strong> {{$cost->amount}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        
                                        @if(!empty($target->total_package_cost))
                                        <tr>
                                            <td><strong>@lang('lang.TOTAL_PACKAGE_COST')</strong> </td>
                                            <td>{{$target->total_package_cost}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($target->note))
                                        <tr>
                                            <td><strong>@lang('lang.NOTE')</strong> </td>
                                            <td>{{$target->note}}</td>
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

