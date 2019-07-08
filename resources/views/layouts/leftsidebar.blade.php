<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            
            <li>
                <a href="{{url('/board')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Projects</span></a>
                
            </li>

            <li>
                <a href="{{route('profile')}}"><i class="fa fa-user-o"></i> <span class="nav-label">My Profile</span></a>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Control Pannel</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{route('boards')}}">Projects List</a></li>
                    <li><a href="{{route('tasks')}}">Tasks List</a></li>
                    <li><a href="{{route('category')}}">Category</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-slideshare"></i> <span class="nav-label">System Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{route('users')}}">User</a></li>
                    <li><a href="{{route('role')}}">Role</a></li>
                    <li><a href="#">Role Permission</a></li>
                </ul>
            </li>
            
        </ul>

    </div>
</nav>