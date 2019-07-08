
@extends('layouts.master')

@section('customCss')

    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">

@endsection

@section ('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Task Manager</a>
                </li>
                <li class="active">
                    <strong>Projects</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
                
        </div>
    </div>

    <div class="wrapper wrapper-content  animated fadeInRight">

        <div class="row" style="padding-bottom:20px;">
            <?php $i=0;?>
            @foreach ($board as $item)
            <div class="col-lg-3">
                    
                    <div class="navy-bg p-lg text-center">
                        <div class="m-b-md_change">
                        <h3 class="font-bold no-margins">
                            {{$item->projectname}} 
                        </h3>

                        </div>
                    </div>
                    <div class="widget-text-box" style="height: 130px; overflow:hidden;">
                    <h5 class="media-heading">{{$item->category_name}}</h5>
                        <p style="font-size:12px; word-break: break-all;">{{ substr($item->description,0,50).'...'}}</p>
                        <div class="text-right">
                            @if($item->created_by == Auth::user()->id)
                                <!--<a href="<?php //echo ($item->created_by == Auth::user()->id)? url('board/close/'.$item->project_id):'javascript:void(0);'?> " onclick="return confirm('Are you sure you want close this board?')" class="btn btn-xs btn-danger" style="border-radius:0px;">&nbsp;&nbsp;Archive&nbsp;&nbsp;</a>-->
                                <a href="javascript:void(0);" onclick="archive({{$item->project_id}})" class="btn btn-xs btn-default" style="border-radius:0px;">&nbsp;Archive&nbsp;</a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#addmember" data-Id="{{$item->project_id}}" class="btn btn-xs btn-default btn-addmember-project" style="border-radius:0px;"><i class="fa fa-plus"></i>&nbsp;<i class="fa fa-user-o"></i>&nbsp;&nbsp;</a>
                            @endif
                            
                            <a href="{{ url('board/'.$item->project_id)}}" class="btn btn-xs btn-primary" style="border-radius:0px;"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Task&nbsp;&nbsp;</a>
                        </div>
                        <div class="progress progress-small" style="margin-top:10px;">
                            <div class="progress-bar progress-bar-striped progress-bar-info task-progress" role="progressbar" style="width: {{$item->progress}}%" aria-valuenow="{{$item->project_id}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
            </div>

                <?php 
                    $i+=1;
                    if($i%4==0) { ?>
                    </div>
                    <div class="row" style="padding-bottom:20px;">
                <?php  }
                ?>

            @endforeach
            
        

        </div>

        
    </div>

<!-- add member to project modal -->
    
<div class="modal in" id="addmember" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
    <div class="modal-dialog  modal-md" style="border-radius:0px;">
        <div class="modal-content animated bounceInDown">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
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
            </form>
        </div>
    </div>
</div>

<!-- end add member to project model -->



@endsection

@section('customJs')
    
    <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>

    <script>
        $(document).ready(function () {
             
        });

        $('#btn_addmember').click(function(){
            var project_id = $('#md_project_id').val();
            var member_id = $('.chosen-select').val();
            if($('.chosen-select').val()!=null && project_id!='')
            {    
                
                $.ajax({
                    type:"get",
                    dataType:'text',
                    url: "{{ url('addmember')}}/"+project_id+"/"+member_id,
                    success: function(data){
                        $('#member').html(data); 
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        swal({
                            title: "Dupplicated Member!",
                            text: "This user already existed in this project",
                            type: "warning"
                        }); 
                    } 
                    
                });
            }
            else{
                $('#reqired-member').fadeOut('');
                $('#reqired-member').fadeIn('');
            }
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

        function archive(board)
        {
            swal({
                title: "Are you sure?",
                text: "This board will no longer in your dashboard!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Archive it!",
                closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type:"get",
                        url: "{{ url('board/close')}}/"+board,
                        success: function(data){
                            swal("Deleted!", "Your Project has been archived.", "success");  
                            location.reload();   
                        }
                    });                    
            });
        }

    </script>

@endsection
