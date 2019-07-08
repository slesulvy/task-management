
@extends('layouts.master')

@section('customCss')
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <link href="{{asset('css/interface.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">

    <style>

        .wrapper-content {
            padding: 0px 0px 40px;
        }

        .popover {
            z-index:3333;
            border-radius: 2px;
        }
          .test:hover{
            color: red;
        }
        .caretss {
          
          box-shadow: 0 0 2000px #000000;
          width: 100%;
       
        }
    
        .ibox-content{width: 300px; max-height:70vh; overflow-y: hidden;}
        
        .ibox-content-ul{ max-height:62vh; overflow-y: auto; padding-right:5px; }
        .ibox-content-ul-first{ max-height:60vh; overflow-y: auto; padding-right:5px; }
        .ibox-content-ul::-webkit-scrollbar, .ibox-content-ul-first::-webkit-scrollbar
        {
            width: 2px;
            height: 4px;
            background-color: #F5F5F5;
        }
        .ibox-content-ul::-webkit-scrollbar-thumb
        {
            border-radius: 8px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #eaeaea;
        }

        /* custom scroll bar */

        .custom-scroll {
            position: relative;
            overflow-y: hidden;
            overflow-x: auto;
            padding-right:10px;
            height:75vh;
        }
        .custom-scroll::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 8px;
            background-color: #fff;
        }

        .custom-scroll::-webkit-scrollbar
        {
            width: 4px;
            height: 8px;
            background-color: #fff;
        }

        .custom-scroll::-webkit-scrollbar-thumb
        {
            border-radius: 8px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #eee;
        }

        /* end custom scroll bar */

    </style>
@endsection

@section ('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Task Manager</a>
                </li>
                <li>
                    <a href="{{url('board')}}">Project</a>
                </li>
                <li class="active">
                <strong>{{@$board->projectname}} </strong>
                </li>
                <li class="pull-right">
                    
                    <a class="btn btn-white btn-xs" data-toggle="modal" data-target="#addlist" style="margin:0;" href="javascript:void(0);"><strong><i class="fa fa-plus"></i>&nbsp;&nbsp;New List&nbsp;&nbsp;</strong>&nbsp;&nbsp;</a>
                    
                </li>
            </ol>
        </div>
        
    </div>


    <div class="wrapper wrapper-content animated fadeInRight ">

        <div style="display: flex; min-width: 100%; overflow-x: auto;" id="dashboard" class="custom-scroll">

            <!-- task to do -->

            <div class="col-lg-4" style="width: 320px; margin: 5px;padding: 5px;color: #34495e">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Things To-do</h3>
                       
                        <div class="input-group">
                            <input type="text" id="taskname" placeholder="Add new task. " class="input input-sm form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-white btn_add_task"> <i class="fa fa-plus"></i> Add task</button>
                            </span>
                        </div>

                        <ul class="sortable-list connectList agile-list ibox-content-ul-first" id="todo">

                            @foreach ($tasktodo as $item)
                                @if($item->step==1)
                                    @include('partial._tasklist_dashboard')
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <!-- in progress -->

            <div class="col-lg-4" style="width: 320px; margin: 5px;padding: 5px; color: #34495e">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>In Progress</h3>
                        <ul class="sortable-list connectList agile-list ibox-content-ul" id="inprogress">
                            @foreach ($tasktodo as $item)
                                @if($item->step==2)
                                    @include('partial._tasklist_dashboard')
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- completed or done -->

            <div class="col-lg-4" style="width: 320px; margin: 5px; padding: 5px; color: #34495e">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Done</h3>
                        
                        <ul class="sortable-list connectList agile-list ibox-content-ul" id="completed">
                            @foreach ($tasktodo as $item)
                                @if($item->step==3)
                                    @include('partial._tasklist_dashboard')
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <!-- dynamic list -->

            <?php $list_id = "";?>
            @foreach($list as $li)

            <div class="col-lg-4" style="width: 320px; margin: 5px; padding: 5px; color: #34495e">
                <div class="ibox">
                    <div class="ibox-content">
                    <h3>{{$li->list_title}} <a href="{{url('removelist/'.$li->list_id)}}" onclick="return confirm('Are you sure want remove list?')" class="pull-right" style="right:-5px;"><i class="fa fa-times"></i></a></h3>
                        <?php $list_id.=',#box_'.$li->list_id?>
                        
                        <ul class="sortable-list connectList agile-list ibox-content-ul" id="box_{{$li->list_id}}">
                            @foreach ($tasktodo as $item)
                                @if($item->step==$li->list_id)
                                    @include('partial._tasklist_dashboard')
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            @endforeach
            

        </div>
        
       
    </div>


<!-- modal add list -->


<div class="modal in" id="addlist" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
    <div class="modal-dialog  modal-md" style="border-radius:0px;">
        <div class="modal-content animated bounceInDown">
        <form method="post" enctype="multipart/form-data" action="{{ route('addlist') }}">
            @csrf
                <div class="modal-header" style="padding:7px 14px 5px 14px; ">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class=""><b>Add List</b></h3>
                </div>
                <div class="modal-body">
                    <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12">List Name <span style="color:red">*</span> <small>max-length(30)</small></label>
                                <div class="col-sm-12">
                                    <input type="text" maxlength="30" name="list_title" id="list_title" class="form-control" required autocomplete="off">
                                    <input type="hidden" value="{{Request::segment(2)}}" name="project_id" class="form-control" required autocomplete="off">
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


<!-- end modal add list -->
    

<!-- task modal -->
<div class="modal in" id="taskmodal" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-md" style="border-radius:0px; width: 768px;">
            <div class="modal-content animated bounceInDown">
                    <div class="modal-body" style="padding:10px;">
                        <a class="icon-lg fa fa-close dialog-close-button js-close-window" data-dismiss="modal"  id="hello" href="#"></a>
                        <div class="tabs-container">
                            <div class="tab-content">
                                <div id="general" class="tab-pane active">
                                    <div class="panel-body">
                                        <form method="post" enctype="multipart/form-data" action="">
                                            @csrf
                                            <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                                                <div class="col-sm-9">

                                                    <div class="form-group">
                                                        <label class="col-sm-12">
                                                            <i class="fa fa-credit-card"></i>&nbsp;&nbsp;
                                                            <b id="tasktitle" style="text-transform:uppercase;">Task Information</b>
                                                        </label>
                                                        <span style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                          
                                                            <a href="#" style="font-size: 13px; color: #6b778c;" id="im_where" class="js-open-move-from-header">Done</a>
                                                        </span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-12" style="height:30px;">
                                                            <div class="col-sm-4" style="padding-left:0px;padding-right:0px;">
                                                                <i class="fa fa-user-o"></i>&nbsp;&nbsp;Members &nbsp;<span style="color:#555; border-radius:0px; margin-top:-5px;" class="pull-right btn btn-sm btn-white gray-bg btn_add_member" onclick="$('#member_add_area').toggle();">+</span> 
                                                            </div>
                                                            <div class="col-sm-3" style="padding:0px; display:none; margin-top:-5px;" id="member_add_area">
                                                                <select data-placeholder="Add Member..." title="Add Member" class="chosen-select form-control member-select" style="width:50%;" tabindex="4">
                                                                    @foreach ($projectmember as $item)
                                                                    <option style="cursor: pointer;" value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-4"> 
                                                                        <span class="fa fa-calendar"></span>
                                                                    </div>
                                                                    <div class="date col-sm-8">
                                                                        <input type="text" id="setduedate" style="border:none; font-size:12px;margin-left: -20px;" data-mask="99/99/9999" placeholder="mm/dd/yyyy"> 
                                                                    </div>
                                                                </div>
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
                                                            <input type="hidden" id="e_task_id" value="">
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
                                                        
                                                            <ul class="list-unstyled file-list">
                                                                <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                                                            </ul>
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

                                                <div class="col-sm-3">
                                                    <div class="u-clearfix">
                                                        <b>ACTIONS</b>

                                                        <input type="hidden" class="form-control" id="task-progress">
                                                        <div id="basic_slider" style="margin-top:10px"></div>

                                                        <a  onclick="$('#member_add_area').toggle();" class="button-link" href="#" title="Members">
                                                            <span class="fa fa-user-circle"></span>&nbsp;
                                                            <span>Members</span>
                                                        </a>
                                                        
                                                        <a class="button-link" onclick="$('#setduedate').focus();" id="setduedates__" href="#" title="Due Date">
                                                            <span class="fa fa-calendar"></span>&nbsp;
                                                            <span>Due Date</span>
                                                        </a>

                                                        <a class="button-link" class="date" title="Move">
                                                            <span class="fa fa-long-arrow-right"></span>&nbsp;
                                                            <span>Move</span>
                                                            
                                                        </a>
                                                        <a class="button-link" href="" id="memarchive" title="Archive">
                                                            <span class="fa fa-repeat"></span>&nbsp;
                                                            <span>Archive</span>
                                                        </a>
                                                         <a class="button-link" href="#" title="Attachment">
                                                            <span class="fa fa-paperclip"></span>&nbsp;
                                                            <span>Attachment</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="modal-footer" style="border:0px solid #000; padding-right:10px; margin-top:1px; padding-top:0px;">
                             &nbsp;<br>
                            <button type="reset" class="btn btn-white close_md btn_close" data-dismiss="modal" style="border-radius:0px;">Close</button>
                        </div>
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
    <script src="{{asset('js/plugins/nouslider/jquery.nouislider.min.js')}}"></script>
    <script>

        //PROGRESS SLIDER
        var basic_slider = document.getElementById('basic_slider');

        noUiSlider.create(basic_slider, {
            start: 0,
            step: 1,
            behaviour: 'tap',
            connect: 'lower',
            tooltips: true,
            range: {
                'min':  0,
                'max':  100
            },
            format: {
                to: function (value) {
                    return value;
                },
                from: function (value) {
                    return (value);
                }
            }
        });

        var taskProgress = document.getElementById('task-progress');

        basic_slider.noUiSlider.on('change', function (values, handle) {
            var value = values[handle];
            taskProgress.value = value;
            $.ajax({
                type: 'POST',
                url: '/task/progress/',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('#e_task_id').val(),
                    'progress': $('#task-progress').val()
                },
                success: function(data) {
                    $('li.' + data['task'].id + ' div.progress div.task-progress').attr({
                        'aria-valuenow': data['task'].progress,
                        'style': 'width:' + data['task'].progress + '%'
                    });
                    /*swal({
                        type: 'success',
                        title: 'The task has been set progress to ' + data['task'].progress + '%',
                        showConfirmButton: false,
                        timer: 1500
                    });*/
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    swal({
                        type: 'error',
                        title: xhr.responseJSON.error,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        });

        // END PROGRESS SLIDER

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
                dataType:'text',
                data:{
                    'description': $('#e_task_description').val()
                },
                success: function(data){
                    $('.btn-edit-desc').css('display','inline');
                    $('#e_task_description').css('display','none');
                    $('#avatar_description').html($('#e_task_description').val());
                    $('#avatar_description').css('display','inline');
                    var jsonData = JSON.parse(data);
                    updatedDescMsg(jsonData.user, jsonData.taskname);
                }
            });


        });

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

         $('#memarchive').click(function(){
           $.ajax({
                    type:"get",
                    url: "{{ url('board/destroy')}}/"+$('#e_task_id').val(),
                    success: function(result){
                        swal({
                        title: "Success!",
                        text: "Archive Successfully",
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

                        $('#task-progress').val(data['task'].progress);
                        basic_slider.noUiSlider.set(data['task'].progress);

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

            $("#todo, #inprogress, #completed <?php echo $list_id?>").sortable({
                connectWith: ".connectList",
                update: function( event, ui ) {
                    var todo = $( "#todo" ).sortable( "toArray" );
                    var inprogress = $( "#inprogress" ).sortable( "toArray" );
                    var completed = $( "#completed" ).sortable( "toArray" );

                    <?php foreach($list as $row){?>
                        var box_<?php echo $row->list_id?> = $( "#box_<?php echo $row->list_id?>" ).sortable( "toArray" );
                        var idbox_<?php echo $row->list_id?> ='';
                    <?php }?>


                    <?php foreach($list as $row){?>
                          for(var i=0; i<box_<?php echo $row->list_id?>.length;i++){
                            idbox_<?php echo $row->list_id?>+=box_<?php echo $row->list_id?>[i].replace('_','');
                            if(i<=box_<?php echo $row->list_id?>.length-2){
                                idbox_<?php echo $row->list_id?>+=',';
                            }
                          }
                    <?php } ?>

                    inc_update_drag+=1;
                    var idtodo ='';
                    var idprog ='';
                    var iddone ='';



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
                                'project_id':<?php echo Request::segment(2)?>,
                                'step_a': idtodo,
                                'step_b': idprog,
                                'step_c': iddone
                                <?php foreach($list as $row){?>
                                ,'step_<?php echo $row->list_id?>':idbox_<?php echo $row->list_id?>
                                <?php }?>
                            },
                            success: function(data){
                                inc_update_drag=0;
                                console.log(data);
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
