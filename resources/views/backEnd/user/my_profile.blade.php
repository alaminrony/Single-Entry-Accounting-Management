@extends('backEnd.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Profile</h1>
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
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">My Profile </h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('my.profile.edit') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-6 float-left"  >
                                            <label for="">Username</label>
                                            <input type="text" name="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6 float-left"  >
                                            <label for="">Email</label>
                                            <input type="text" name="email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" class="form-control">
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 float-left"  >
                                            <label for="">Phone</label>
                                            <input type="text" name="phone" value="{{ \Illuminate\Support\Facades\Auth::user()->phone }}" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6 float-left"  >
                                            <label for="">Address</label>
                                            <textarea  class="form-control" name="address">{{ \Illuminate\Support\Facades\Auth::user()->address }}</textarea>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 float-left"  >
                                            <label for="">Photo</label>
                                            <input type="file" name="profile_photo" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6 float-left"  >
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>

                                    </div>
<button type="submit" class="btn btn-success"> Update </button>
                                </form>
                            </div>
                            <!-- /.card-body -->

                        </div>
                    </div>
                </div>
        </section>
    </div>



@endsection
@push('script')
    <script type="text/javascript">

        @if (Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}", 'Success', {timeOut: 5000});
        @elseif(Session::has('success'))
        toastr.success("{{Session::get('success')}}", 'Success', {timeOut: 5000});
        @endif

        $(document).ready(function () {

            const lb = lightbox();
        });
    </script>
@endpush
