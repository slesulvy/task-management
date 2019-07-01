
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
                    <strong>Task List</strong>
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
                                <!--<a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal5" style="border-radius: 0px;">
                                    <i class="fa fa-plus"></i> New Task
                                </a>-->
        
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
                                                <th>Task Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach ($task as $item)
                                                <tr class="gradeX">
                                                    <td align="center">{{$i}}</td>
                                                    <td>{{$item->board->projectname}}</td>
                                                    <td>{{substr($item->taskname,0,60)}}</td>
                                                    <td align="left">
                                                            {{substr($item->description,0,60)}}
                                                    </td>
                                                    <td align="center" class="center"><?php echo ($item->status==1?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>')?></td>
                                                    <td align="center" class="center">
                                                                 
                                                        <!--<a onclick="edit_user({{$item->id}})" href="javascript:void(0)" data-toggle="modal" data-target="#edit_user" class="btn-sm btn-warning"><i class="fa fa-pencil"></i></a> | -->
                                                        <a title="Restore" onclick="return confirm('Are you sure you to disable this user?')" href="{{ url('task/restore/'.$item->id)}}" class="btn-sm btn-white"><i class="fa fa-paper-plane"></i></a> |
                                                        <a title="Archive" onclick="return confirm('Are you sure you to archive this board?')" href="{{ url('task/close/'.$item->id)}}" class="btn-sm btn-white"><i class="fa fa-trash"></i></a> 
                                                    
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

    </script>
    
@endsection
