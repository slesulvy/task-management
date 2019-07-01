
@extends('layouts.master')

@section('customCss')
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">

    <style>
        .chosen-container-multi .chosen-choices{border-radius: 0px; }
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

        <div class="row">

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
                            <li task_id="{{$item->id}}" class="warning-element ui-sortable-handle" id="_{{$item->id}}" style="">
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
                                    
                                <span class="label label-warning"><i class="fa fa-clock-o"></i> {{date_format(date_create($item->due_date),'d-M-Y')}}</span>
                                    <a href="#" class="btn btn-xs btn-white">&nbsp;<i class="fa fa-user-o"></i><?php echo(count($item->handler)>=1)?'&nbsp;'.count($item->handler).'+':'&nbsp;'?></a>
                                <a href="#" class="btn btn-xs btn-white">&nbsp;<i class="fa fa-comments-o"></i>&nbsp;</a>
                                    <a href="javascript:void(0);" data-Id="{{$item->id}}" data-toggle="modal" data-target="#taskmodal" class="btn btn-xs btn-white btn-update-task">&nbsp;<i class="fa fa-tasks"></i>&nbsp;</a>
                                </div>
                            </li>
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
                            
                            
                        </ul>
                    </div>
                </div>
            </div>


        </div>
        

       
    </div>


    


<!-- task modal -->
    
<div class="modal  in" id="taskmodal" tabindex="-1" role="dialog" style="border-radius: 0px; display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-lg" style="border-radius:0px;">
            <div class="modal-content animated bounceInDown">
            <form method="post" enctype="multipart/form-data" action="">
                @csrf
                    <div class="modal-header" style="padding:7px 14px 5px 14px; ">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3><i class="fa fa-tasks"></i>&nbsp;&nbsp;<b id="tasktitle">Task Information</b></h3>
                    </div>
                    <!--<div class="modal-body">
                        <fieldset class="form-horizontal col-sm-12" style="padding:0 0px 0 0;">                                                    
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label class="col-sm-12">Description <span style="color:red"></span></label>
                                    <div class="col-sm-12">
                                        <input type="hidden" id="e_task_id" value="0">
                                        <textarea name="description" id="e_task_description" class="form-control" style="height:40px; " rows="3" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                
                                    <div class="col-sm-12">
                                        <div class="row">
                                            
                                            <div class="col-md-3" id="data_2" title="Start Date">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input readonly type="text" class="form-control" id="e_startdate" value="" placeholder="Due Date...">
                                                </div>
                                            </div>

                                            <div class="col-md-3" id="data_1" title="Due Date">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" id="e_duedate" value="" placeholder="Due Date...">
                                                </div>
                                            </div>
                                            <div class="col-md-2 control-label"><b>Priority:&nbsp;</b></div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="prior1" value="1" name="priority" checked>
                                                <label for="prior1"> Normal </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="prior2" value="2" name="priority">
                                                <label for="prior2"> Important </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="prior3" value="3" name="priority">
                                                <label for="prior3"> Critical </label>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                            <select data-placeholder="Add Member..." title="Add Member" class="chosen-select" multiple style="" tabindex="4">
                                            <option value="1">Select</option>
                                            <option value="2">United States</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
    
                            
    
                        </fieldset>
                        
                    </div>-->
                    

                    <div class="modal-body">
                            <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#tab-3" aria-expanded="true"> <i class="fa fa-laptop"></i></a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false"><i class="fa fa-desktop"></i></a></li>
                                        <li class=""><a data-toggle="tab" href="#tab-5" aria-expanded="false"><i class="fa fa-database"></i></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-3" class="tab-pane active">
                                            <div class="panel-body">
                                                <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>
            
                                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                                                    existence in this spot, which was created for the bliss of souls like mine.</p>
            
                                                <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                                                    the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                                            </div>
                                        </div>
                                        <div id="tab-4" class="tab-pane">
                                            <div class="panel-body">
                                                <strong>Donec quam felis</strong>
            
                                                <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>
            
                                                <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                            </div>
                                        </div>
                                        <div id="tab-5" class="tab-pane">
                                            <div class="panel-body">
                                                <strong>Donec quam felis</strong>
            
                                                <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>
            
                                                <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <div class="modal-footer" style="border:0px solid #000; padding-right:46px; margin-top:15px;">
                            &nbsp;<br>
                            <button type="reset" class="btn btn-white close_md" data-dismiss="modal" style="border-radius:0px;">Close</button>
                            <button id="update_task" type="button" class="btn btn-primary " style="border-radius:0px;"><i class="fa fa-save"></i> Save</button>
                            
                        </div>

                    

                </form>
            </div>
        </div>
    </div>
    
<!-- end task model -->


@endsection





@section('customJs')
    <script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script>

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

            $('#todo').delegate(".btn-update-task","click",function(){
                $.ajax({
                    type:"get",
                    url: "{{ url('board/edittask')}}/"+$(this).attr('data-Id'),
                    dataType:'json',
                    success: function(data){
                        $('#e_task_id').val(data['task'].id);
                        $('#e_task_description').val(data['task'].description);
                        $('#tasktitle').html(data['task'].taskname);
                        $('#prior'+data['task'].priority).prop('checked', true);
                        $('#e_startdate').val(data['task'].created_at);
                        $('#e_duedate').val(data['task'].due_date);
                        if(data['task'].due_date!=null)
                        {
                            $('#e_duedate').prop('disabled', true);
                        }
                        
                    }
                });
            });

            /*$("#todo, #inprogress, #completed").sortable({
                connectWith: ".connectList",
                update: function( event, ui ) {

                    var todo = $( "#todo" ).sortable( "toArray" );
                    var inprogress = $( "#inprogress" ).sortable( "toArray" );
                    var completed = $( "#completed" ).sortable( "toArray" );
                    $('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " + window.JSON.stringify(completed));
                }
            }).disableSelection();*/

            $("#todo, #inprogress, #completed").sortable({
                connectWith: ".connectList",
                update: function( event, ui ) {
                    var todo = $( "#todo" ).sortable( "toArray" );
                    var inprogress = $( "#inprogress" ).sortable( "toArray" );
                    var completed = $( "#completed" ).sortable( "toArray" );
                    //JSON.stringify(obj, replacer);
                    //console.log(window.JSON.stringify(todo));
                    $.each(window.JSON.stringify(todo), function(index, value){
                        console.log(value+'|'+index);
                    });
                    $.each(window.JSON.stringify(todo), function(i, country){
                       console.log('<span>' + country + (i += 1) + '</span> ');
                    });
                    //console.log((todo[0]));
                    //alert(window.JSON.stringify(todo));
                    //$('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " /*+ window.JSON.stringify(completed)*/);
                }
            }).disableSelection();

        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $(".chosen-select").change(function() {
            console.log("change");
            console.log("value:" + $(".chosen-select").val());
        });

        $('.chosen-select').chosen({width: "100%"});    

    </script>
    
@endsection
