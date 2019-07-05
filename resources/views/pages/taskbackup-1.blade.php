
@extends('layouts.master')

@section('customCss')
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">

    <style>
        

        body {
        width: 100%;
        height: 100%;
        }

        body {
        /*background-color: #2980b9;*/
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        }

        .card {
        display: flex;
       
        height: 500px;
        overflow-x: auto;
        overflow-y: hidden;
        }
        .card::-webkit-scrollbar {
        /*display: none;*/
        }
        .card--content {
        /*background-color: #ecf0f1;*/
        min-width: 360px;
        max-height: 300px;
        margin: 0px;
        padding: 0px;
        color: #34495e;
        overflow-y: auto;
        overflow-x: hidden;
        }

        .custom-scroll {
            position: relative;
            overflow-y: auto;
            padding-right:10px;
        }
        .custom-scroll::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 0;
            background-color: #ddd;
        }

        .custom-scroll::-webkit-scrollbar
        {
            width: 5px;
            height: 5px;
            background-color: #ddd;
        }

        .custom-scroll::-webkit-scrollbar-thumb
        {
            border-radius: 0;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #ddd;
        }
        

    </style>
@endsection

@section ('content')

<!--<div class="row wrapper border-bottom white-bg page-heading">
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
</div>  -->  


<div class="wrapper wrapper-content card animated fadeInRight">
  
        <!-- ting todo -->
        
           
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Things To-do</h3>
                    
                    <div class="input-group">
                        <input type="text" id="taskname" placeholder="Add new task. " class="input input-sm form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-white btn_add_task"> <i class="fa fa-plus"></i> Add task</button>
                        </span>
                    </div>
                    <br>

                    <ul class="sortable-list connectList agile-list custom-scroll card--content" id="todo">
                        
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
                            </div>
                            
                        </li>
                        @endif
                        @endforeach
                            
                    </ul>
                </div>
            </div>
          
            
        <!-- end things todo -->

        @for($cc=0; $cc<=1; $cc++)

        <div class="card--content">
               <div class="col-sm-12">
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

        @endfor
                    
    <!--</section>-->




</div>






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
                dataType:'text',
                data:{
                    'description': $('#e_task_description').val()
                },
                success: function(data){
                    $('.btn-edit-desc').css('display','inline');
                    $('#e_task_description').css('display','none');
                    $('#avatar_description').html($('#e_task_description').val());
                    $('#avatar_description').css('display','inline');
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
