
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
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                });

            /* initialize the external events
            -----------------------------------------------------------------*/


            $('#external-events div.external-event').each(function() {

                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1111999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
            -----------------------------------------------------------------*/
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

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
                //console.log('index: ', index);
                if(index==0)
                {
                    val1=item.id;
                    allTaskArray.push({
                            id: tasks['id'], 
                            name: tasks['title'],
                            start: tasks['start'],
                            end: tasks['end'],
                            progress: 60,
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
                            progress: 60,
                            dependencies: ''+ tmp + ''
                            
                    });

                }
                
           
            })

            /*if(allTaskArray.dependencies == 0) {
                delete allTaskArray.dependencies;
            }*/

            console.log('allTaskArray: ', allTaskArray);

            var tasks = [
			{
				start: '2018-10-01',
				end: '2018-10-08',
				name: 'Redesign website',
				id: "Task 0",
				progress: 20
			},
			{
				start: '2018-10-03',
				end: '2018-10-06',
				name: 'Write new content',
				id: "Task 1",
				progress: 5,
				dependencies: 'Task 0'
			},
			{
				start: '2018-10-04',
				end: '2018-10-08',
				name: 'Apply new styles',
				id: "Task 2",
				progress: 10,
				dependencies: 'Task 1'
			},
			{
				start: '2018-10-08',
				end: '2018-10-09',
				name: 'Review',
				id: "Task 3",
				progress: 5,
				dependencies: 'Task 2'
			},
			{
				start: '2018-10-08',
				end: '2018-10-10',
				name: 'Deploy',
				id: "Task 4",
				progress: 0,
				dependencies: 'Task 2'
			},
			{
				start: '2018-10-11',
				end: '2018-10-11',
				name: 'Go Live!',
				id: "Task 5",
				progress: 0,
				dependencies: 'Task 4',
				custom_class: 'bar-milestone'
			},
		];
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
                custom_popup_html: null,
			    language: 'en'
            });

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                views: {
                    timeGridFourDay: {
                    type: 'timeGrid',
                    duration: { days: 4 },
                    buttonText: '4 day'
                    }
                },
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar
                drop: function() {
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },
                events: allTaskArray,
                eventRender: function(event, eventElement) {
                    if (event.imageurl) {
                        eventElement.find("div.fc-content").prepend("<img src='" + event.imageurl +"' width='16' height='16'>");
                    }
                },
                 
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
    <script src="{{asset('js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
    <!-- frapp.io -->
    <script src="{{asset('js/plugins/frappe-gantt.min.js')}}" />
@endsection
