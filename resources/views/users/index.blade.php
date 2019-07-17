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
                    <a href="index-2.html">Staff</a>
                </li>
                <li class="active">
                    <strong>List</strong>
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
                            <h5>View list all of staffs</h5>
                            <div class="ibox-tools">
                                @can('user-create')
                                    <a class="btn btn-sm btn-primary" tyle="border-radius: 0px;" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Create New</a>
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
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                 <tr>
                                   <th>No</th>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Profile</th>
                                   <th>Roles</th>
                                   <th>Action</th>
                                 </tr>
                                </thead>
                                <tbody>
                                 @foreach ($data as $key => $user)
                                  <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                      @if(!empty($user->img))
                                          <td><img src="{{asset("images/".$user->img)}}" class="img-circle" width="30" height="30"> </td>
                                          @else
                                    <td><img src="{{asset("images/none-bg.png")}}" class="img-circle" width="30" height="30"> </td>
                                      @endif
                                    <td>
                                      @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                           <label class="badge badge-primary">{{ $v }}</label>
                                        @endforeach
                                      @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show',Crypt::encrypt($user->id)) }}"><i class="fa fa-eye"></i></a>
                                        @can('user-edit')
                                        <a href="{{ route('users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('user-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                            <!-- {!! Form::submit('delete', ['class' => 'btn btn-danger']) !!} -->
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
{{--{!! $data->render() !!}--}}
@endsection