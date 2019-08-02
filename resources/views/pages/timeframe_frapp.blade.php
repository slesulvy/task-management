
@extends('layouts.master')
@section('customCss')
    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
    <link href="{{asset('css/frappe-gantt.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    
    <style>
        .fc-time {
            display: none;
        }
        .fc-event, .fc-agenda .fc-event-time, .fc-event a {
            border: none;
            border-radius:0px;
        }
        .userProfile {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
        .gantt .today-highlight {
            fill: #ff000c7d; 
        }
    </style> 
@endsection

@section ('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h4> </h4>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('board')}}">Board</a>
                </li>
                <li class="active">
                    <strong>Project timeframe</strong>
                </li>
            </ol>
        </div>
    </div>

    
    <!-- @foreach($tasktodo as $item)
    {{$item}}
        @foreach($item->handler as $v)
            {{$v->getUser->img}}
        @endforeach

    @endforeach -->

    <div class="wrapper wrapper-content">
        <div class="row animated fadeInDown">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Project timeframe</h5>
                    </div>
                    <div class="ibox-content">
                        <svg id="gantt"></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var task = [];
            var tasks = {};
            var allTaskArray = [];
            task = <?php echo $tasktodo ?>;
            var tmp = "";
            var val1 = 0;
            task.map((item, index) => {
                tasks['start'] = item.start_date;
                tasks['id'] = ''+item.id+'';
                tasks['title'] = item.taskname;
                tasks['end'] = item.due_date;
                tasks['index'] = index;
                tasks['progress'] = item.progress;

                if(index==0)
                {
                    val1=item.id;
                    allTaskArray.push({
                            id: tasks['id'], 
                            name: tasks['title'],
                            start: tasks['start'],
                            end: tasks['end'],
                            progress: tasks['progress'],
                            handler: item.handler,
                            dependencies: '0'
                            
                            
                    });
                }
                
                if(index>0)
                {
                    tmp = val1;
                    val1=item.id;

                        allTaskArray.push({
                            id: tasks['id'], 
                            name: tasks['title'],
                            start: tasks['start'],
                            end: tasks['end'],
                            handler: item.handler,
                            progress: tasks['progress'],
                            dependencies: ''+ tmp + ''
                            
                    });

                }
            })

            console.log('all task: ', allTaskArray);
            var gantt = new Gantt("#gantt", allTaskArray, {
            header_height: 50,
            column_width: 30,
            step: 24,
            view_modes: ['Quarter Day', 'Half Day', 'Day', 'Week', 'Month'],
            bar_height: 20,
            bar_corner_radius: 3,
            arrow_curve: 5,
            padding: 18,
            view_mode: 'Day',   
            date_format: 'YYYY-MM-DD',
            language: 'en',
            custom_popup_html: function(task) {
                // the task object will contain the updated
                // dates and progress value
                //const end_date = task.end.format('MMM D');
                
                return `
                    <div class="details-container" style="width:200px; padding: 10px 15px; background:#fff; box-shadow:0px 0px 3px #eee;">
                    <h5>${task.name}</h5>
                    <hr/>
                    <p>Start: ${new Date(task.start).toLocaleDateString('en-GB')}  </p>
                    <p>End: ${new Date(task.end).toLocaleDateString('en-GB')} </p>
                    <p>${task.progress}% completed!</p>
                    ${task.handler.map(user => {
                        return ('<img title="'+user.get_user.name+'" class="userProfile" src="<?php echo asset('') ?>images/'+ user.get_user.img +'"/>');
                    })} 

                    </div>
                `;
            }
        });
        });

    </script>

@endsection

@section('customJs')
    <!-- Mainly scripts -->
    <script src="{{asset('js/plugins/fullcalendar/moment.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Full Calendar -->
    <!-- frapp.io -->
    <script src="{{asset('js/plugins/frappe-gantt.min.js')}}" ></script>
@endsection
