<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            
            <li class="{{(Request::segment(1)=='board')?'active':''}}">
                <a href="{{url('/board')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Projects</span></a>
                
            </li>

            <li class="{{(Request::segment(1)=='profile')?'active':''}}">
                <a href="{{route('profile')}}"><i class="fa fa-user-o"></i> <span class="nav-label">My Profile</span></a>
            </li>
            
            <li class="{{(Request::segment(1)=='boards' || Request::segment(1)=='tasks' || Request::segment(1)=='category')?'active':''}}">
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Control Pannel</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{(Request::segment(1)=='boards')?'active':''}}"><a href="{{route('boards')}}">Projects List</a></li>
                    <li class="{{(Request::segment(1)=='tasks')?'active':''}}"><a href="{{route('tasks')}}">Tasks List</a></li>
                    <li class="{{(Request::segment(1)=='category')?'active':''}}"><a href="{{route('category')}}">Category</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-slideshare"></i> <span class="nav-label">System Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('user-list')
                    <li><a href="{{route('users.index')}}">Staffs Management</a></li>
                    @endcan
                    @can('role-list')
                    <li><a href="{{route('roles.index')}}">Role Management</a></li>
                        @endcan
                </ul>
            </li>
            
        </ul>

    </div>
</nav>