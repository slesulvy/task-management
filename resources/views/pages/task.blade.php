
@extends('layouts.master')

@section('customCss')
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">

    <style>
        .popover {
            z-index:3333;
            border-radius: 2px;
        }

        .chosen-container-multi .chosen-choices{border-radius: 0px; }
        .no-scroll::-webkit-scrollbar {display:none;}
        .no-scroll::-moz-scrollbar {display:none;}
        .no-scroll::-o-scrollbar {display:none;}
        .no-scroll::-google-ms-scrollbar {display:none;}
        .no-scroll::-khtml-scrollbar {display:none;}
    </style>
@endsection

@section ('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Task Manager</a>
                </li>
                <li>
                    <a href="{{url('board')}}">Board</a>
                </li>
                <li class="active">
                <strong>{{@$board->projectname}} </strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            
        </div>
    </div>


    <div class="wrapper wrapper-content  animated fadeInRight">

        <div class="row" id="dashboard">

            <!-- task to do -->

            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Things To-do</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>

                        <div class="input-group">
                            <input type="text" id="taskname" placeholder="Add new task. " class="input input-sm form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-white btn_add_task"> <i class="fa fa-plus"></i> Add task</button>
                            </span>
                        </div>

                        <ul class="sortable-list connectList agile-list" id="todo">
                            
                            @foreach ($tasktodo as $item)
                            @if($item->step==1)
                            <li task_id="{{$item->id}}" class="warning-element ui-sortable-handle btn-update-task" id="_{{$item->id}}" style="" data-Id="{{$item->id}}" data-toggle="modal" data-target="#taskmodal">
                                <div class="agile-detail" style="padding:0 0 5px 0; text-align:left; margin-top:0px;">
                                <?php $j=3;?>
                                @for ($i = 1; $i <= $item->priority; $i++)
                                    <i class="fa fa-star"></i>&nbsp;
                                <?php $j--;?>
                                @endfor
                                @for ($j; $j >= 1; $j--)
                                    <i class="fa fa-star-o"></i>&nbsp;
                                @endfor
                                <i class="fa fa-thumb-tack pull-right" aria-hidden="true"></i>
                                </div>
                                {{$item->taskname}}
                                <div class="agile-detail">   
                                    
                                <span title="Due Date" class="label label-warning"><i class="fa fa-clock-o"></i> {{($item->due_date!=null?date_format(date_create($item->due_date),'d-M-Y'):'')}}</span>
                                    <a href="#" class="btn btn-xs pull-right" style="border:none;">
                                        <?php $inc_member=0;?>
                                        @foreach ($item->handler as $val)
                                            @if($inc_member<5)
                                            <img title="{{$val->getUser->name}}" src="<?php echo asset("img/".$val->getUser->img."")?>" width="17px;" class="img img-circle">
                                            @endif
                                        <?php $inc_member++;?>
                                        @endforeach
                                        @if($inc_member>=5)
                                            {{$inc_member}}+
                                        @endif
                                    </a>    
                                       <!--<img src="" width="17px;" class="img img-circle">
                                        <img src="" width="17px;" class="img img-circle">&nbsp;<?php //echo(count($item->handler)>=1)?'&nbsp;'.count($item->handler).'+':'&nbsp;'?></a>-->
                                
                                    <!--<a href="javascript:void(0);"  class="btn btn-xs btn-white btn-update-task">&nbsp;<i class="fa fa-tasks"></i>&nbsp;</a>-->
                                </div>
                                
                            </li>
                            @endif
                            @endforeach
                                
                        </ul>
                    </div>
                </div>
            </div>

            <!-- in progress -->

            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>In Progress</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                        <ul class="sortable-list connectList agile-list" id="inprogress">
                            @foreach ($tasktodo as $item)
                            @if($item->step==2)
                            <li progres_id="{{$item->id}}" class="info-element ui-sortable-handle btn-update-task" id="_{{$item->id}}" style="" data-Id="{{$item->id}}" data-toggle="modal" data-target="#taskmodal">
                                <div class="agile-detail" style="padding:0 0 5px 0; text-align:left; margin-top:0px;">
                                <?php $j=3;?>
                                @for ($i = 1; $i <= $item->priority; $i++)
                                    <i class="fa fa-star"></i>&nbsp;
                                <?php $j--;?>
                                @endfor
                                @for ($j; $j >= 1; $j--)
                                    <i class="fa fa-star-o"></i>&nbsp;
                                @endfor
                                <i class="fa fa-thumb-tack pull-right" aria-hidden="true"></i>
                                </div>
                                {{$item->taskname}}
                                <div class="agile-detail">   
                                    
                                <span title="Due Date" class="label label-success"><i class="fa fa-clock-o"></i> {{($item->due_date!=null?date_format(date_create($item->due_date),'d-M-Y'):'')}}</span>
                                    <a href="#" class="btn btn-xs pull-right" style="border:none;">
                                        <?php $inc_member=0;?>
                                        @foreach ($item->handler as $val)
                                            @if($inc_member<5)
                                            <img title="{{$val->getUser->name}}" src="<?php echo asset("img/".$val->getUser->img."")?>" width="17px;" class="img img-circle">
                                            @endif
                                        <?php $inc_member++;?>
                                        @endforeach
                                        @if($inc_member>=5)
                                            {{$inc_member}}+
                                        @endif
                                    </a>    
                                        <!--<img src="" width="17px;" class="img img-circle">
                                        <img src="" width="17px;" class="img img-circle">&nbsp;<?php //echo(count($item->handler)>=1)?'&nbsp;'.count($item->handler).'+':'&nbsp;'?></a>-->
                                
                                    <!--<a href="javascript:void(0);"  class="btn btn-xs btn-white btn-update-task">&nbsp;<i class="fa fa-tasks"></i>&nbsp;</a>-->
                                </div>
                                
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- completed or done -->

            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Done</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                        <ul class="sortable-list connectList agile-list" id="completed">
                            @foreach ($tasktodo as $item)
                            @if($item->step==3)
                            <li progres_id="{{$item->id}}" class="success-element ui-sortable-handle btn-update-task" id="_{{$item->id}}" style="" data-Id="{{$item->id}}" data-toggle="modal" data-target="#taskmodal">
                                <div class="agile-detail" style="padding:0 0 5px 0; text-align:left; margin-top:0px;">
                                <?php $j=3;?>
                                @for ($i = 1; $i <= $item->priority; $i++)
                                    <i class="fa fa-star"></i>&nbsp;
                                <?php $j--;?>
                                @endfor
                                @for ($j; $j >= 1; $j--)
                                    <i class="fa fa-star-o"></i>&nbsp;
                                @endfor
                                <i class="fa fa-thumb-tack pull-right" aria-hidden="true"></i>
                                </div>
                                {{$item->taskname}}
                                <div class="agile-detail">   
                                    
                                <span title="Due Date" class="label label-primary"><i class="fa fa-clock-o"></i> {{($item->due_date!=null?date_format(date_create($item->due_date),'d-M-Y'):'')}}</span>
                                    <a href="#" class="btn btn-xs pull-right" style="border:none;">
                                        <?php $inc_member=0;?>
                                        @foreach ($item->handler as $val)
                                            @if($inc_member<5)
                                            <img title="{{$val->getUser->name}}" src="<?php echo asset("img/".$val->getUser->img."")?>" width="17px;" class="img img-circle">
                                            @endif
                                        <?php $inc_member++;?>
                                        @endforeach
                                        @if($inc_member>=5)
                                            {{$inc_member}}+
                                        @endif
                                    </a>    
                                        <!--<img src="" width="17px;" class="img img-circle">
                                        <img src="" width="17px;" class="img img-circle">&nbsp;<?php //echo(count($item->handler)>=1)?'&nbsp;'.count($item->handler).'+':'&nbsp;'?></a>-->
                                
                                    <!--<a href="javascript:void(0);"  class="btn btn-xs btn-white btn-update-task">&nbsp;<i class="fa fa-tasks"></i>&nbsp;</a>-->
                                </div>
                                
                            </li>
                            @endif
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>


        </div>
        

       
    </div>


    


<!-- task modal -->
    
<div class="modal in" id="taskmodal" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-md" style="border-radius:0px;">
            <div class="modal-content animated bounceInDown">
                            
                    <div class="modal-body" style="padding:10px;">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <!--<li class="active"><a data-toggle="tab" href="#general" aria-expanded="true"><b id="tasktitle" style="text-transform:uppercase;">Task Information</b></a></li>
                                -->
                            </ul>
                            <div class="tab-content">
                                
                                <div id="general" class="tab-pane active">
                                    <div class="panel-body">
                                        
                                        <form method="post" enctype="multipart/form-data" action="">
                                            @csrf
                                            <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                                                <div class="col-sm-12">

                                                    <div class="form-group">
                                                        <label class="col-sm-12"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;<b id="tasktitle" style="text-transform:uppercase;">Task Information</b></label>
                                                        <span style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i id="im_where">in List Done</i></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Due Date &nbsp;&nbsp;&nbsp;
                                                        </label>
                                                        <div class="date col-sm-5" style="padding:0px; margin-top:-5px; margin-left:-30px;">
                                                            <input type="text" id="setduedate" class="form-control input-sm" style="border:none; font-size:12px;" data-mask="99/99/9999" placeholder="mm/dd/yyyy">
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-12" style="height:30px;">
                                                            <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
                                                                <i class="fa fa-user-o"></i>&nbsp;&nbsp;Members &nbsp;<span style="color:#555; border-radius:0px; margin-top:-5px;" class="pull-right btn btn-sm btn-white gray-bg btn_add_member" onclick="$('#member_add_area').toggle();">+</span> 
                                                            </div>
                                                            <div class="col-sm-5" style="padding:0px; display:none; margin-top:-5px;" id="member_add_area">
                                                                <select data-placeholder="Add Member..." title="Add Member" class="chosen-select form-control member-select" style="width:50%;" tabindex="4">
                                                                    @foreach ($projectmember as $item)
                                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        
                                                        </label>
                                                        <div class="col-sm-12" style="padding:7px 0 0 35px;">
                                                            <div class="col-sm-6" style="padding-left:0; padding-right:0;">
                                                                <div class="col-sm-12" id="e_member" style="padding-left:0; padding-right:0;">
                                                                    <!-- member will display by ajax -->
                                                                </div>
                                                            </div>

                                                        </div>
                                    

                                                    </div>
                    
                                                    <div class="form-group">
                                                        <label class="col-sm-12"><i class="fa fa-align-right"></i>&nbsp;&nbsp;Description &nbsp;<span style="color:#555; border-radius:0px;" class="btn btn-sm btn-white gray-bg btn-edit-desc">Edit</span></label>
                                                        <div class="col-sm-12" style="padding:7px 0 0 35px;">
                                                            <input type="hidden" id="e_task_id" value="0">
                                                            <p id="avatar_description">Add a more detailed description...</p>
                                                            <textarea name="description" id="e_task_description" class="form-control" style="height:80px; overflow: hidden; overflow-wrap: break-word; resize: none; display:none; font-size:11px;" rows="3" required></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-12"><i class="fa fa-star"></i>&nbsp;&nbsp;Priority &nbsp;&nbsp;&nbsp;
                                                            <a class="btn btn-xs  btn-bitbucket star-1" href="javascript:void(0)" onclick="priority_rate(1)">
                                                                <i class="fa fa-star-o"></i> Normal
                                                            </a>
                                                            <a class="btn btn-xs  btn-bitbucket star-2" href="javascript:void(0)" onclick="priority_rate(2)">
                                                                <i class="fa fa-star-half-o"></i> Important
                                                            </a>
                                                            <a class="btn btn-xs  btn-bitbucket star-3" href="javascript:void(0)" onclick="priority_rate(3)">
                                                                <i class="fa fa-star"></i> Critical
                                                            </a>
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-12"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;&nbsp;Attachments &nbsp;&nbsp;&nbsp;   
                                                        </label>
                                                        <div class="col-sm-12" style="padding:7px 0 0 35px;">
                                                            
                                                            <div class="file-box">
                                                                <div class="file">
                                                                    <a href="#">
                                                                        <span class="corner"></span>
                                
                                                                        <div class="icon">
                                                                            <i class="fa fa-file"></i>
                                                                        </div>
                                                                        <div class="file-name">
                                                                            Document_2014.doc
                                                                            <br>
                                                                            <small>Added: Jan 11, 2014</small>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-12"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;Add Comment &nbsp;</label>
                                                        <div class="col-sm-12" style="padding:7px 0 0 35px;">
                                                            <textarea name="description" id="comments" class="form-control" style="height:40px; overflow: hidden; overflow-wrap: break-word; resize: none; border:1px solid #eee; border-bottom:none; font-size:11px;" rows="3" required></textarea>
                                                            <div class="col-sm-12" style="border:1px solid #eee; border-top:none; padding:5px;">
                                                                <a id="lunchcomment" class="btn btn-sm btn-primary btn-bitbucket " style="border:none; margin:0 2px;">
                                                                    <i class="fa fa-send-o"></i> Send
                                                                </a>

                                                                <a  data-toggle="popover" class=" popper btn btn-sm btn-default btn-bitbucket pull-right" style="border:none; margin:0 2px;">
                                                                    <b>@</b>
                                                                </a>
                                                                <a class="btn btn-sm btn-default btn-bitbucket pull-right" style="border:none; margin:0 2px;">
                                                                    <i class="fa fa-picture-o"></i>
                                                                </a>
                                                                
                                                            </div>
                                                            
                                                        </div>


                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-12" style="padding-right:0px;"><i class="fa fa-list-ul"></i>&nbsp;&nbsp;Activities &nbsp;<span style="color:#555; border-radius:0px;" class="btn btn-xs btn-white gray-bg pull-right" onclick="$('#_activities').toggle()">Hide Details</span></label>
                                                        <div class="col-sm-12" style="padding:7px 0 0 35px; display:none;" id="_activities"> 
                                                                
                                                            <div class="feed-activity-list">
                                                                <!-- comments display here -->
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                    
                              
                                                </div>
                        
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>

                                <!--<div id="tab-4" class="tab-pane">
                                    <div class="panel-body">
                                    </div>
                                </div>
                                <div id="tab-5" class="tab-pane">
                                    <div class="panel-body">
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="border:0px solid #000; padding-right:10px; margin-top:1px; padding-top:0px;">
                        &nbsp;<br>
                        <button type="reset" class="btn btn-white close_md" data-dismiss="modal" style="border-radius:0px;">Close</button>
                        <!--<button id="update_task" type="button" class="btn btn-primary " style="border-radius:0px;"><i class="fa fa-save"></i> Save</button>-->
                        
                    </div>

            </div>
        </div>
    </div>
    
<!-- end task model -->

<!-- popover -->



<div class="popper-content hide" style="max-height:170px; border-radius:1px;">
    <div style="width:150px; border: 1px solid #eee; max-height:160px; z-index:9999999;">
            
       <div class="col-sm-12" style="border-bottom:1px solid #eee; padding-top:5px; padding-bottom:5px"><b>Mention</b>...</div>
        
        <select multiple="multiple" id=" bootstrap-duallistbox-selected-list_" class="mention form-control no-scroll" name="_helper2" style="height: 132px; border:none; overflow:none;">
            @foreach ($projectmember as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>

</div>    

<!-- end popover -->


@endsection


@section('customJs')
    <script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script>

       

        $('.popper').popover({
            placement: 'right',
            container: 'body',
            html: true,
            content: function () {
                return $('.popper-content').html();
            }
        });

        /*$('#dashboard').delegate(".mention","change",function(){
            $('#mention').change(function(){
            alert($('.mention').val());
        });*/

        //--------------------------
        // Update description

        $('.btn-edit-desc').click(function(){
            $('#e_task_description').css('display','block');
            $('.btn-edit-desc').css('display','none');
            $('#e_task_description').focus();
            $('#avatar_description').css('display','none');
        });

        $('#e_task_description').blur(function(){
            
            var task_id = $('#e_task_id').val();
            $.ajax({
                type:"get",
                url: "{{ url('setdescription')}}/"+task_id,
                dataType:'json',
                data:{
                    'description': $('#e_task_description').val()
                },
                success: function(data){
                    $('.btn-edit-desc').css('display','inline');
                    $('#e_task_description').css('display','none');
                    $('#avatar_description').html($('#e_task_description').val());
                    $('#avatar_description').css('display','inline');
                    //console.log(data.user);
                    updatedDescMsg(data.user, data.taskname);
                }
            });

            
        });

        function updatedDescMsg(user, msgStr)
        {
            $.ajax({
                type:"get",
                url: "{{ url('api/updateDescription')}}",
                dataType:'text',
                data:{
                    'user': user,
                    'taskName' :msgStr
                },
                success: function(data){
                   
                }
            });
        }
        
        //--------------------------
        // Add task

        $('#taskname').keypress(function(event){       
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                addtask();
            }

        });

        $('.btn_add_task').click(function(){
            addtask();
        });

        $('#update_task').click(function(){
            $.ajax({
                type:"get",
                url: "{{ url('board/updatetask')}}/"+$('#e_task_id').val(),
                data:{
                    'description':$('#e_task_description').val(),
                    'due_date': $('#e_duedate').val(),
                    'priority': $("input[name='priority']:checked").val()
                },
                success: function(data){
                    swal({
                        title: "Success!",
                        text: "Task has been update!",
                        type: "success"
                    });        
                }
            });

        });

        function addtask()
        {
            if($('#taskname').val().length>0){
                $.ajax({
                    type:"get",
                    url: "{{ url('newtask')}}",
                    data:{
                        'taskname':$('#taskname').val(),
                        'project_id':{{Request::segment(2)}}
                    }, 
                    success: function(result){
                        $('#todo').prepend(result);
                        $('#taskname').val('');
                    }
                });
            }
        }    
        

        $(document).ready(function(){

            $('#dashboard').delegate(".btn-update-task","click",function(){

                $('.star-1, .star-2, .star-3').removeClass('btn-success');

                $.ajax({
                    type:"get",
                    url: "{{ url('board/edittask')}}/"+$(this).attr('data-Id'),
                    dataType:'json',
                    success: function(data){
                        $('#e_member img').remove();
                        $('#setduedate').val('');
                        data['handler'].map(item =>{
                            $('#e_member').append("<img title='"+item.get_user.name+"' src='<?php echo asset('img/"+item.get_user.img+"')?>' width='25px;' style='margin-right:2px;' class='img img-circle' />");
                        });
                        
                        $('.feed-activity-list .feed-element').remove();
                        data['comment'].map(item =>{

                            //var comment_date = new Date(item.created_at);
                
                            $('.feed-activity-list').append("<div class='feed-element'>"+
                                            "<a class='pull-left'><img alt='image' class='img-circle' src='<?php echo asset('img/"+item.get_user.img+"')?>' width='35px;'></a>"+
                                            "<div class='media-body'>"+
                                                "<small class='pull-right'>1m ago</small>"+
                                                "<strong>"+item.get_user.name+"</strong> commented on task <strong>"+item.task.taskname+"</strong><br>"+
                                                "<small class='text-muted'>"+item.created_at+"</small>"+
                                                "<div class='well'>"+item.comments+"</div>"+"</div>"+"</div>");
                        });                     
                        
                        $('.star-'+data['task'].priority).addClass('btn-success');
                        if(data['task'].step==1){
                            $('#im_where').html('in List Task');
                        }else if(data['task'].step==2){
                            $('#im_where').html('in List Progress');
                        } else{ $('#im_where').html('in List Done'); }
                        $('#e_task_id').val(data['task'].id);
                        $('#avatar_description').html(data['task'].description);
                        $('#e_task_description').val(data['task'].description);
                        $('#tasktitle').html(data['task'].taskname);
                        $('#prior'+data['task'].priority).prop('checked', true);
                        
                        if(data['task'].due_date!=null)
                        {
                            var du_date = new Date(data['task'].due_date);
                            $('#setduedate').val(du_date.toLocaleDateString());
                        }
                        
                    }
                });
            });

            var inc_update_drag = 0;

            $("#todo, #inprogress, #completed").sortable({
                connectWith: ".connectList",
                update: function( event, ui ) {
                    var todo = $( "#todo" ).sortable( "toArray" );
                    var inprogress = $( "#inprogress" ).sortable( "toArray" );
                    var completed = $( "#completed" ).sortable( "toArray" );
    
                    inc_update_drag+=1;
                    var idtodo ='';
                    var idprog ='';
                    var iddone ='';

                    //console.log(idtodo);

                    for(var i=0; i<todo.length;i++){
                        
                        idtodo+=todo[i].replace('_','');
                        if(i<=todo.length-2){
                            idtodo+=',';
                        }
                    }
                    //console.log(idtodo);
                    
                    for(var i=0; i<inprogress.length;i++){
                        idprog+=inprogress[i].replace('_','');
                        if(i<=inprogress.length-2){
                            idprog+=',';
                        }
                    }

                    for(var i=0; i<completed.length;i++){
                        iddone+=completed[i].replace('_','');
                        if(i<=completed.length-2){
                            iddone+=',';
                        }
                    }

                    if(inc_update_drag==2)
                    {
                        $.ajax({
                            type:"get",
                            url: "{{ url('movestep')}}",
                            data:{
                                'step_a': idtodo,
                                'step_b': idprog,
                                'step_c': iddone
                            },
                            success: function(data){
                                //console.log(data);      
                            }
                        });
                        
                    }
                }
               
            }).disableSelection();

        });

        //--------------------------
        // Task handler

        $(".chosen-select").change(function() {    
            var task_id = $('#e_task_id').val();
            $.ajax({
                type:"get",
                url: "{{ url('addtaskmember')}}/"+task_id,
                dataType:'json',
                data:{
                    'user_id': $(".chosen-select").val()
                },
                success: function(data){
                    $('#e_member img').remove();
                    data['handler'].map(item =>{
                        $('#e_member').append("<img title='"+item.get_user.img+"' src='<?php echo asset('img/"+item.get_user.img+"')?>' width='25px;' style='margin-right:2px;' class='img img-circle' />");
                    });                   
                }
            });
        });

        $('.chosen-select').chosen({width: "100%"});    

        //---------------------------
        // Priority

        function priority_rate(var_priority)
        {
            var task_id = $('#e_task_id').val();
            $('.star-1, .star-2, .star-3').removeClass('btn-success');
            $.ajax({
                type:"get",
                url: "{{ url('setpriority')}}/"+task_id,
                dataType:'text',
                data:{
                    'priority': var_priority
                },
                success: function(data){
                    $('.star-'+var_priority).addClass('btn-success');
                }
            });
        }

        //---------------------------
        // Due Date

        $("#setduedate").datepicker({
            dateFormat: 'dd-mm-yy',
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        }).on("changeDate", function (e) {
            var task_id = $('#e_task_id').val();
            $.ajax({
                type:"get",
                url: "{{ url('setduedate')}}/"+task_id,
                dataType:'text',
                data:{
                    'due_date': $(this).val()
                },
                success: function(data){
                    
                }
            });
        });

        //---------------------------
        // Comment

        $('#lunchcomment').click(function(){
            if($('#comments').val()!=''){
                $('#_activities').css('display','block');
                var task_id = $('#e_task_id').val();
                $.ajax({
                    type:"get",
                    url: "{{ url('comment')}}",
                    dataType:'text',
                    data:{
                        'task_id': task_id,
                        'comment': $('#comments').val()
                    },
                    success: function(data){
                        $('.feed-activity-list').prepend(data);
                        $('#comments').val('');
                    }
                });
            }    
        })
        

    </script>
    
@endsection
