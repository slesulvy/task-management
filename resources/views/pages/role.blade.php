
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
                    <strong>Role</strong>
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
                            <h5>Roles</h5>
                            <div class="ibox-tools">
                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addrole" style="border-radius: 0px;">
                                    <i class="fa fa-plus"></i> New Role
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
                                                <th>Role Name</th>
                                                <th>Description</th>
                                                <th>Created Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach ($role as $item)
                                                <tr class="gradeX">
                                                    <td align="center">{{$i}}</td>
                                                    <td>{{$item->role_name}}</td>
                                                    <td>{{$item->description}}</td>
                                                    <td>{{$item->created_at}}</td>
                                                    <td align="center" class="center"><?php echo ($item->status==1?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>')?></td>
                                                    <td align="center" class="center">
                                                        <a onclick="edit_role({{$item->id}})" href="javascript:void(0)" data-toggle="modal" data-target="#edit_role" class="btn-sm btn-success"><i class="fa fa-pencil"></i></a> | 
                                                        <a onclick="return confirm('Are you sure you to disable it?')" href="{{ url('role/disable/'.$item->id)}}" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

    
    
    <div class="modal inmodal in" id="addrole" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-md" style="border-radius:0px;">
            <div class="modal-content animated bounceInDown">
            <form id="pr" method="post" enctype="multipart/form-data" action="{{ route('role/add') }}">
                @csrf
                    <div class="modal-header" style="padding:7px 14px 5px 14px; ">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class=""><b>Add Role</b></h3>
                    </div>
                    <div class="modal-body">
                        <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-12">Role Name <span style="color:red">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" name="role_name" id="role_name" class="form-control" required>
                                        <input type="hidden" name="role_id" id="role_id" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Description <span style="color:red">*</span></label>
                                    <div class="col-sm-12">
                                        <textarea name="role_description" style="width:100%; height:105px; border:1px solid #eee; padding:10px; " rows="3" required></textarea>
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
    
    <div class="modal inmodal in" id="edit_role" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
            <div class="modal-dialog  modal-md" style="border-radius:0px;">
                <div class="modal-content animated bounceInDown">
                <form id="pr" method="post" enctype="multipart/form-data" action="{{ route('role/update') }}">
                    @csrf
                        <div class="modal-header" style="padding:7px 14px 5px 14px; ">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class=""><b>Edit Role</b></h3>
                        </div>
                        <div class="modal-body">
                            <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-12">Role Name <span style="color:red">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="role_name" id="e_role_name" class="form-control" required>
                                            <input type="hidden" name="role_id" id="e_role_id" value="">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label class="col-sm-12">Description <span style="color:red">*</span></label>
                                        <div class="col-sm-12">
                                            <textarea id="e_description" name="role_description" style="padding:10px; width:100%; height:105px; border:1px solid #eee;" rows="3" required></textarea>
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


        function edit_role(role_id) {
            $.ajax({
                type: 'get',
                url: "{{ url('role/edit')}}/"+role_id,
                cache: false,
                contentType: false,
                processData: false,
                dataType:'json',
                success: function(data){
                
                    console.log(data);
                    $("#e_role_id").val(data.id);
                    $("#e_role_name").val(data.role_name);
                    $("#e_description").val(data.description);
                }
            });
        }


    </script>
    
@endsection
