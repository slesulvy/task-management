
@extends('layouts.master')

@section('customCss')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">

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
                    <strong>Category</strong>
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
                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcategory" style="border-radius: 0px;">
                                    <i class="fa fa-plus"></i> New Categoory
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
                                                <th>Category Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach ($category as $item)
                                                <tr class="gradeX">
                                                    <td align="center">{{$i}}</td>
                                                    <td>{{$item->category_name}}</td>
                                                    
                                                    <td align="center" class="center"><?php echo ($item->status==1?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>')?></td>
                                                    <td align="center" class="center">
                                                                 
                                                        <!--<a onclick="edit_user({{$item->id}})" href="javascript:void(0)" data-toggle="modal" data-target="#edit_user" class="btn-sm btn-warning"><i class="fa fa-pencil"></i></a> | -->
                                                        <a title="Restore" onclick="return confirm('Are you sure you to disable this user?')" href="{{ url('category/restore/'.$item->category_id)}}" class="btn-sm btn-white"><i class="fa fa-paper-plane"></i></a> |
                                                        <a title="Archive" onclick="return confirm('Are you sure you to archive this board?')" href="{{ url('category/close/'.$item->category_id)}}" class="btn-sm btn-white"><i class="fa fa-trash"></i></a> 
                                                    
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


    <!-- add member to project modal -->
    
    <div class="modal in" id="addcategory" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-md" style="border-radius:0px;">
            <div class="modal-content animated bounceInDown">
            
                <form id="pr" method="get" enctype="multipart/form-data" action="{{ url('addcategory') }}">
                    @csrf
                        <div class="modal-header" style="padding:7px 14px 5px 14px; ">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class=""><b>Add Category</b></h3>
                        </div>
                        <div class="modal-body">
                            <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-12">Category Name <span style="color:red">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="category_name" id="" class="form-control" required>
                            
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

    <!-- end add member to project model -->
    


@endsection

@section('customJs')
    <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>
    <script>
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true
        });

        $('.chosen-select').chosen({width: "100%"});

        $('.chosen-select').on('chosen:showing_dropdown', function (evt, params) {
            //alert('d');
            $.ajax({
                type:"get",
                dataType:'text',
                url: "{{ url('users_select_opt')}}",
                success: function(data){
                    $('.chosen-select').html(data); 
                    $('.chosen-select').trigger("chosen:updated");
                    $('#reqired-member').css('display','none');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log("Status: " + textStatus); 
                    console.log("Error: " + errorThrown); 
                } 
            });
        });

        $('.btn-addmember-project').click(function(){
            var project_id = $(this).attr('data-Id');
            $.ajax({
                type:"get",
                dataType:'text',
                url: "{{ url('getboardmember')}}/"+project_id,
                success: function(data){
                    $('#md_project_id').val(project_id);
                    $('#member').html(data); 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log("Status: " + textStatus); 
                    console.log("Error: " + errorThrown); 
                } 
                
            });
        });

        function rm_pro_member(id)
        {
            var project_id = $('#md_project_id').val();
            swal({
                title: "Are you sure?",
                text: "This member will no longer in this project!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Remove!",
                closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type:"get",
                        url: "{{ url('removemember')}}/"+project_id+"/"+id,
                        success: function(data){
                            swal("Deleted!", "Member has been removed.", "success"); 
                            //console.log(data);
                            $('#tr_'+id).remove();  
                            $.ajax({
                                type:"get",
                                dataType:'text',
                                url: "{{ url('getboardmember')}}/"+project_id,
                                success: function(data){
                                    $('#member').html(data); 
                                    //console.log(data);
                                }
                            });
                        }
                    });                    
            });
        }
        


    </script>
    
@endsection
