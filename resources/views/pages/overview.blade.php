
@extends('layouts.master')

@section('customCss')
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <link href="{{asset('css/pages/dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">
    <style>
        .project-head-color{
            border-bottom: 1px solid {{$board->back_color}} !important;
        }
    </style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@endsection

@section ('content')

    <div class="row wrapper border-bottom white-bg page-heading project-head-color">
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
                <strong>Overview</strong>
                </li>
                <li class="pull-right">
                    
                    <a class="btn btn-white btn-xs" data-toggle="modal" data-target="#addlist" style="margin:0;" href="javascript:void(0);"><strong><i class="fa fa-plus"></i>&nbsp;&nbsp;New List&nbsp;&nbsp;</strong>&nbsp;&nbsp;</a>
                    
                </li>
            </ol>
        </div>
        
    </div>


    <div class="wrapper wrapper-content animated fadeInRight ">
            <div class="row  white-bg dashboard-header">

                    

                <div class="col-md-3">
                    <h2>{{@$board->projectname}} </h2>
                    <small>Task summary</small>
                    <ul class="list-group clear-list m-t">
                        <li class="list-group-item fist-item">
                            <span class="pull-right">
                               {{count($tasklate)}}
                            </span>
                            <span class="label label-danger">1</span> Overdue
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                                {{count($upcoming)}}
                            </span>
                            <span class="label label-warning">2</span> Close to Overdue
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                                {{count($starttask)}}
                            </span>
                            <span class="label label-info">3</span> Started
                        </li>
                        
                        <li class="list-group-item">
                            <span class="pull-right">
                                {{count($nodate)}}
                            </span>
                            <span class="label label-default">4</span> No date
                        </li>

                        <li class="list-group-item">
                            <span class="pull-right">
                                {{count($tastdone)}}
                            </span>
                            <span class="label label-primary">5</span> Task Completed
                        </li>
                        
                    </ul>
                </div>

                <div class="col-md-1">&nbsp;</div>
               
                <div class="col-md-3">
                    <div class="statistic-box">
                    
                    
                        <div class="row text-center">
                            
                            <div class="col-lg-6">
                                <canvas id="doughnutChart" width="180" height="180" style="margin: 18px auto 0"></canvas>
                                <h5>Task</h5>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-5" style="margin-top: 30px;">
                <br>
                    <div id="chart_div"></div>
                </div>

            </div>

            <div class="row  border-bottom white-bg dashboard-header">

                    <div class="container">
  <h2>Task Navigator</h2>
  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Overdue</a></li>
    <li><a data-toggle="tab" href="#nearoverdue">Close to Overdue</a></li>
    <li><a data-toggle="tab" href="#started">Started</a></li>
    <li><a data-toggle="tab" href="#nodate">No date</a></li>
    <li><a data-toggle="tab" href="#completed">Completed</a></li>
    <li><a data-toggle="tab" href="#alltask">All Tasks</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>&nbsp;</h3>
     
        <ul class="list-unstyled file-list">
            @foreach ($tasklate as $item)
                <li class="progress-border-{{$item->danger_level}}" style=" width:92%; background: linear-gradient(to right, #f7f7f7 {{$item->progress}}%,white 0%,#f7f7f7 {{$item->progress}}%,white 0%,white 100%);"><i class="fa fa-tasks"></i>&nbsp;&nbsp; {{$item->taskname}}<span class="pull-right">{{$item->progress}}%</span>&nbsp;&nbsp;&nbsp;
                    @foreach ($item->handler as $val)
                            <img title="{{$val->getUser->name}}" src="<?php echo asset("images/".$val->getUser->img."")?>" width="17px" height="17px" class="img img-circle">
                    @endforeach
                </li>
            @endforeach              
        </ul>

    </div>
    <div id="nearoverdue" class="tab-pane fade">
        <h3>&nbsp;</h3>
        <ul class="list-unstyled file-list">
            @foreach ($upcoming as $item)
            <li class="progress-border-{{$item->danger_level}}" style=" width:92%; background: linear-gradient(to right, #f7f7f7 {{$item->progress}}%,white 0%,#f7f7f7 {{$item->progress}}%,white 0%,white 100%);"><i class="fa fa-tasks"></i>&nbsp;&nbsp; {{$item->taskname}}<span class="pull-right">{{$item->progress}}%</span>&nbsp;&nbsp;&nbsp;
                    @foreach ($item->handler as $val)
                            <img title="{{$val->getUser->name}}" src="<?php echo asset("images/".$val->getUser->img."")?>" width="17px" height="17px" class="img img-circle">
                    @endforeach
                </li>
            @endforeach              
        </ul>
    
    </div>
    <div id="started" class="tab-pane fade">
      
        <h3>&nbsp;</h3>
        <ul class="list-unstyled file-list">
            @foreach ($starttask as $item)
            <li class="progress-border-{{$item->danger_level}}" style=" width:92%; background: linear-gradient(to right, #f7f7f7 {{$item->progress}}%,white 0%,#f7f7f7 {{$item->progress}}%,white 0%,white 100%);"><i class="fa fa-tasks"></i>&nbsp;&nbsp; {{$item->taskname}}<span class="pull-right">{{$item->progress}}%</span>&nbsp;&nbsp;&nbsp;
                    @foreach ($item->handler as $val)
                            <img title="{{$val->getUser->name}}" src="<?php echo asset("images/".$val->getUser->img."")?>" width="17px" height="17px" class="img img-circle">
                    @endforeach
                </li>
            @endforeach              
        </ul>

    </div>
    <div id="nodate" class="tab-pane fade">
    
        <h3>&nbsp;</h3>
        <ul class="list-unstyled file-list">
            @foreach ($nodate as $item)
            <li class="progress-border-{{$item->danger_level}}" style=" width:92%; background: linear-gradient(to right, #f7f7f7 {{$item->progress}}%,white 0%,#f7f7f7 {{$item->progress}}%,white 0%,white 100%);"><i class="fa fa-tasks"></i>&nbsp;&nbsp; {{$item->taskname}}<span class="pull-right">{{$item->progress}}%</span>&nbsp;&nbsp;&nbsp;
                    @foreach ($item->handler as $val)
                            <img title="{{$val->getUser->name}}" src="<?php echo asset("images/".$val->getUser->img."")?>" width="17px" height="17px" class="img img-circle">
                    @endforeach
                </li>
            @endforeach              
        </ul>

    </div>

    <div id="completed" class="tab-pane fade">
    
        <h3>&nbsp;</h3>
        <ul class="list-unstyled file-list">
            @foreach ($tastdone as $item)
            <li class="progress-border-{{$item->danger_level}}" style=" width:92%; background: linear-gradient(to right, #f7f7f7 {{$item->progress}}%,white 0%,#f7f7f7 {{$item->progress}}%,white 0%,white 100%);"><i class="fa fa-tasks"></i>&nbsp;&nbsp; {{$item->taskname}}<span class="pull-right">{{$item->progress}}%</span>&nbsp;&nbsp;&nbsp;
                    @foreach ($item->handler as $val)
                            <img title="{{$val->getUser->name}}" src="<?php echo asset("images/".$val->getUser->img."")?>" width="17px" height="17px" class="img img-circle">
                    @endforeach
                </li>
            @endforeach              
        </ul>

    </div>

    <div id="alltask" class="tab-pane fade">
    
        <h3>&nbsp;</h3>
        <ul class="list-unstyled file-list">
            @foreach ($tasktodo as $item)
            <li class="progress-border-{{$item->danger_level}}" style=" width:92%; background: linear-gradient(to right, #f7f7f7 {{$item->progress}}%,white 0%,#f7f7f7 {{$item->progress}}%,white 0%,white 100%);"><i class="fa fa-tasks"></i>&nbsp;&nbsp; {{$item->taskname}}<span class="pull-right">{{$item->progress}}%</span>&nbsp;&nbsp;&nbsp;
                    @foreach ($item->handler as $val)
                            <img title="{{$val->getUser->name}}" src="<?php echo asset("images/".$val->getUser->img."")?>" width="17px" height="17px" class="img img-circle">
                    @endforeach
                </li>
            @endforeach              
        </ul>

    </div>

  </div>
</div>

                    
 </div>
    
       
    </div>



@endsection


@section('customJs')
    <script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{asset('js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->
    <script src="{{asset('js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/demo/peity-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>

    <script src="{{asset('js/plugins/nouslider/jquery.nouislider.min.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

            }, 1300);
       

            var doughnutData = {
                labels: ["Overdue","Close to Overdue","Started", "No date", "Done"],
                datasets: [{
                    data: [<?php echo count($tasklate)?>,<?php echo count($upcoming)?>,<?php echo count($starttask)?>,<?php echo count($nodate)?>,<?php echo count($tastdone)?>],
                    backgroundColor: ["#ed5565","#f7ac59","#23c6c8","#d1dade","#1ab394"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });


        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

            var data = google.visualization.arrayToDataTable([
                ['', 'Task',],
                ['Overdue', <?php echo count($tasklate)?>],
                ['Close to overdue', <?php echo count($upcoming)?>],
                ['Started', <?php echo count($starttask)?>],
                ['No date', <?php echo count($nodate)?>],
                ['Task done', <?php echo count($tastdone)?>]
            ]);

            var options = {
                title: 'Task of "{{@$board->projectname}}"',
                chartArea: {width: '50%'},
                hAxis: {
                title: 'Total tasks',
                minValue: 0
                },
                vAxis: {
                title: ''
                }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

            chart.draw(data, options);
            }


    </script>

    

@endsection
