@extends('layouts.master')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2></h2>
            <ol class="breadcrumb">
                <li>
                    <a>Profile</a>
                </li>
                <li class="active">
                    <strong>Update</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>


    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="x_content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Update Profile</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('profile') }}"> Back</a>
                    </div>
                </div>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($profile, ['method' => 'post','enctype' => 'multipart/form-data','route' => ['update.profile', $profile->id]]) !!}
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-mdd-4">
                    <div class="col-sm-12" style="padding: 10px 0;">
                        <img id="preview"
                             src="{{asset("images/".$profile->img)}}" width="100%" height="auto"/>
                        {!! Form::file("profile",["class"=>"form-control","style"=>"display:none","id"=>'image']) !!}
                        <br/>
                        <p style="padding: 10px 0; text-align: center;">
                            <a class="btn btn-primary" href="javascript:changeProfile();"><i class="fa fa-exchange"></i>Change</a> |
                            <a class="btn btn-danger" href="javascript:removeImage()"><i class="fa fa-trash"></i>Remove</a>
                        </p>
                        <input type="hidden" style="display: none" value="0" name="remove" id="remove">
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8">
                    <div class="form-group">
                        <strong>Password:</strong>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-8 col-sm-8 col-md-8">
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script type="text/javascript">

        function changeProfile() {
            $('#image').click();
        }
        $('#image').change(function () {
            var imgPath = $(this)[0].value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                    $('#remove').val(0);
                }
            }
        }
        function removeImage() {
            $('#preview').attr('src', '{{url('http://placehold.it/200x200')}}');
            $('#remove').val(1);
        }
    </script>
@endsection