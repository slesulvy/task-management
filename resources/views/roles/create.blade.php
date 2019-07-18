@extends('layouts.master')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Role</a>
                </li>
                <li class="active">
                    <strong>create</strong>
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
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
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


                            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                            <div class="row">
                                <div class="col-xs-6col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                    <div class="form-group">
                                         <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group" style="overflow:auto;">
                                        <strong>Permission:</strong>
                                        <br/>
                                        @foreach($permission as $value)
                                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name flat')) }}
                                            {{ $value->name }}</label>
                                        <br/>
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                    </div>
   
    </div>
{!! Form::close() !!}
@endsection