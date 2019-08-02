
@extends('layouts.master')

@section('customCss')


@endsection

@section ('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Task Manager</a>
                </li>
                <li>
                    <a href="#">User</a>
                </li>
                <li class="active">
                    <strong>Profile</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


    <div class="wrapper wrapper-content  animated fadeInRight">

      
        
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-4">

                   
               
                <div class="profile-image">
                    <a href="{{asset('images/'.$profile->img)}}"><img src="{{asset('images/'.$profile->img)}}" class="img-circle circle-border m-b-md" alt="profile"></a>
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                {{$profile->name}}
                            </h2>
                            <h4>
                                @if(!empty($profile->getRoleNames()))
                                    @foreach($profile->getRoleNames() as $v)
                                        <label class="badge badge-primary">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </h4>
                            <small>
                                There are many variations of passages of Lorem Ipsum available, but the majority
                                have suffered alteration in some form Ipsum available.
                            </small>
                            <p>
                                <a href="{{route('edit.profile',$profile->id)}}" class="badge badge-success" style="padding: 8px;"><i class="fa fa-edit"></i> Update profile</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table small m-b-xs">
                    <tbody>
                    <tr>
                        <td>
                            <strong>{{count($profile->board)}}</strong> Projects
                        </td>
                        <td>
                            <strong>Top 10</strong>  Urgent Tasks
                        </td>

                    </tr>

                    <tr>
                        <td>
                                <div class="ibox-content">
                                        <h3>Project List</h3>
                                        <ul class="list-unstyled file-list">
                                            @foreach ($profile->board as $item)
                                            <li><a href="#"><i class="fa fa-folder-o"></i>&nbsp;&nbsp; {{$item->board->projectname}}</a></li>
                                            @endforeach
                                            
                                            
                                        </ul>
                                    </div>
                        </td>
                        <td>
                                <div class="ibox-content">
                                        <h3>Task List</h3>
                                        <ul class="list-unstyled file-list">
                                            @foreach ($toptenurgenttask as $item)
                                                <li class="progress-border-{{$item->danger_level}}" style="background: linear-gradient(to right, #f7f7f7 {{$item->progress}}%,white 0%,#f7f7f7 {{$item->progress}}%,white 0%,white 100%);"><i class="fa fa-tasks"></i>&nbsp;&nbsp; {{$item->taskname}}<span class="pull-right">{{$item->progress}}%</span></li>
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                        </td>

                    </tr>
                    
                    
                    </tbody>
                </table>
            </div>
            


        </div>
        

       
    </div>

    

@endsection

@section('customJs')

    <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>

    
@endsection
