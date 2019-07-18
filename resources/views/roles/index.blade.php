@extends('layouts.master')
@section('customCss')

    <link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">

@endsection

@section ('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Role</a>
                </li>
                <li class="active">
                    <strong>list</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>
    </div>


    <div class="wrapper wrapper-content  animated fadeInRight">


            <div class="row">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>View list Roles</h5>
                            <div class="ibox-tools">
                                @can('role-delete')
                                <a class="btn btn-sm btn-primary" tyle="border-radius: 0px;" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Create New</a>
                                @endcan
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>

                            <?php $i=1;?>

                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <a href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye"></i></a>
                                                    @can('role-edit')
                                                        <a href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-edit"></i></a>
                                                    @endcan

                                                    @can('role-delete')
                                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                            <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} -->
                                                            <button type="submit" class="delete"><i class="fa fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                            </table>


                        </div>
                </div>
            </div>
    </div>
@endsection