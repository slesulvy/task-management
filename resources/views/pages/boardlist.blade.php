
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
                    <a href="{{ url ('board') }}">Task Manager</a>
                </li>
                <li class="active">
                    <strong>Project List</strong>
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
                            <h5>Projects List</h5>
                            <div class="ibox-tools">
                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal5" style="border-radius: 0px;">
                                    <i class="fa fa-plus"></i> New Project
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
                                                <th>Project Name</th>
                                                <th>Description</th>
                                                <th>Member</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach ($board as $item)
                                                <tr class="gradeX">
                                                    <td align="center">{{$i}}</td>
                                                    <td>
                                                        {{$item->projectname}}
                                                        <div class="progress  progress-small project-{{ $item->project_id }}">
                                                            <div class="progress-bar progress-bar-striped progress-bar-info project-progress" role="progressbar" style="background-color: {{ $item->back_color }}; width: {{ $item->progress  }}%" aria-valuenow="{{ $item->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>{{substr($item->description,0,60).'...'}}</td>
                                                    <td align="center">
                                                        <a data-toggle="modal" data-target="#addmember" data-Id="{{$item->project_id}}" class="btn-sm btn-white btn-addmember-project"><i class="fa fa-user-o"></i></a> 
                                                    </td>
                                                    <td align="center" class="center"><?php echo ($item->status==1?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>')?></td>
                                                    <td align="center" class="center">
                                                    
                                                        @if(Auth::user()->id==$item->created_by) 
                                                        <?php 
                                                            $status = $item->status == 1 ? 0: 1;
                                                        ?>
                                                         
                                                        <a title="{{$item->status == 1 ? 'Achive':'Restore'}}"  onclick="return confirm('Are you sure you to disable this item?')" href="{{ url('board/restore/'.$item->project_id.'/'.$status)}}" class="btn-sm btn-white"><?php echo ($item->status==1?'<i class="fa fa-archive"></i>':'<i class="fa fa-paper-plane"></i>')?></a> |
                                                        <a title="Delete" onclick="return confirm('Are you sure you to archive this board?')" href="{{ url('board/close/'.$item->project_id)}}" class="btn-sm btn-white"><i class="fa fa-trash"></i></a> 
                                                        @endif
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
    
    <div class="modal in" id="addmember" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-md" style="border-radius:0px;">
            <div class="modal-content animated bounceInDown">
            
                    <div class="modal-header" style="padding:7px 14px 5px 14px; ">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3><i class="fa fa-user-o"></i>&nbsp;&nbsp;<b id="tasktitle">Project Members</b></h3>
                    </div>
                    <div class="modal-body">
                        <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <input type="hidden" id="md_project_id">
                                        
                                        <select data-placeholder="Add Member..." title="Add Member" class="chosen-select form-control member-select" style="width:50%;" tabindex="4">
                                            <!-- ajax will fills option here -->
                                        </select>
                                        <span id="reqired-member" class="text-danger" style="display:none;">* Please select a member from selection above!</span>
                                    </div>
                                    <div class="col-sm-3" style="padding:0px;">
                                        <button type="button"  id="btn_addmember" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> Add Member</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <table width="100%" class="table table-bordered" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <td align="center" width="10%"><b>No</b></td>
                                            <td><b>Member</b></td>
                                            <td align="center" width="10%"><i class="fa fa-bolt"></i></td>
                                        </tr>
                                    </thead>
                                    <tbody id="member">
                                        <!-- ajax will fills table row here -->
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                        
                    </div>
                    <div class="modal-footer" style="border:0px solid #000; padding-right:46px; margin-top:15px;">
                        <!-- modal footer -->
                    </div>
                
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
