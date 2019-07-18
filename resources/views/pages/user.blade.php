
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
                    <a href="index-2.html">Task Manager</a>
                </li>
                <li class="active">
                    <strong>User</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


    <div class="wrapper wrapper-content  animated fadeInRight">

        
            <div class="row">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Users</h5>
                            <div class="ibox-tools">
                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#adduser" style="border-radius: 0px;">
                                    <i class="fa fa-plus"></i> New User
                                </a>
        
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
                                                <th>#</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach ($users as $item)
                                                <tr class="gradeX">
                                                    <td align="center">{{$i}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->role->role_name}}</td>
                                                    <td align="center" class="center"><?php echo ($item->status==1?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>')?></td>
                                                    <td align="center" class="center">
                                                        <a onclick="edit_user({{$item->id}})" href="javascript:void(0)" data-toggle="modal" data-target="#edit_user" class="btn-sm btn-success"><i class="fa fa-pencil"></i></a> | 
                                                        <a onclick="return confirm('Are you sure you to disable this user?')" href="{{ url('user/disable/'.$item->id)}}" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>

                                            <?php $i++;?>   
                                            @endforeach

                                            
                                        </tbody>
                            </table>
                            

                        </div>
                </div>
            </div>

       
    </div>

    
    
    <div class="modal inmodal in" id="adduser" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-md" style="border-radius:0px;">
            <div class="modal-content animated bounceInDown">
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

                            {!! Form::open(array('route' => 'users.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group  col-sm-4" style="padding: 0;">
                                        <strong>User's profile:</strong>
                                        <div class="file-loading">
                                            <input id="profile-up" type="file" name="profile" class="file" data-overwrite-initial="false" data-min-file-count="2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','required'=>'required')) !!}
                                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="is_active" value="1">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Position:</strong>
                                        <select data-placeholder="Choose a Position..." class="form-control select" class="form-control" name="position" >
                                            <option></option>
                                            @foreach($position as $key=>$value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','required'=>'required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Password:</strong>
                                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','required'=>'required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Confirm Password:</strong>
                                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','required'=>'required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Role:</strong>
                                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple','required'=>'required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
    <div class="modal inmodal in" id="edit_user" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
            <div class="modal-dialog  modal-md" style="border-radius:0px;">
                <div class="modal-content animated bounceInDown">
                <form id="pr" method="post" enctype="multipart/form-data" action="{{ route('users/update') }}">
                    @csrf
                        <div class="modal-header" style="padding:7px 14px 5px 14px; ">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class=""><b>Edit User</b></h3>
                        </div>
                        <div class="modal-body">
                            <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                                <div class="col-sm-12">
                            
                                        <div class="form-group">
                                            <label class="col-sm-12">Full Name <span style="color:red">*</span></label>
                                            <div class="col-sm-12">
                                                <input type="text" name="fullname" id="e_fullname" class="form-control" required autocomplete="off">
                                                <input type="hidden" name="id" id="e_id" value="">
                                            </div>
                                        </div>
        
                                        <div class="form-group">
                                            <label class="col-sm-12">Email <span style="color:red">*</span></label>
                                            <div class="col-sm-12">
                                                <input type="email" id="e_email" name="email" class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
        
                                        <div class="form-group">
                                            <label class="col-sm-12">Password <span style="color:red">*</span></label>
                                            <div class="col-sm-12">
                                                <input type="password" name="password" disabled class="form-control" required autocomplete="off">
                                            </div>
                                        </div>
        
                                        <div class="form-group">
                                            <label class="col-sm-12">Role <span style="color:red">*</span></label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="role_id" id="e_role_id">
                                                    @foreach ($role as $item)
                                                    <option value="{{$item->id}}">{{$item->role_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
          
                                </div>
        
                            </fieldset>
                            
                        </div>
                        <div class="modal-footer" style="border:0px solid #000; padding-right:46px; margin-top:15px;">
                            &nbsp;<br>
                            <button type="reset" class="btn btn-white close_md" data-dismiss="modal" style="border-radius:0px;">Close</button>
                            <button type="submit" class="btn btn-primary" style="border-radius:0px;">Save as</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    

@endsection

@section('customJs')

    <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>
    <script>
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true
        });


        function edit_user(id) {
            $.ajax({
                type: 'get',
                url: "{{ url('users/edit')}}/"+id,
                cache: false,
                contentType: false,
                processData: false,
                dataType:'json',
                success: function(data){
                
                    console.log(data);
                    $("#e_id").val(data.id);
                    $("#e_fullname").val(data.name);
                    $("#e_email").val(data.email);
                    $("#e_role_id").val(data.role_id);
    
                }
            });
        }


    </script>
    
@endsection
