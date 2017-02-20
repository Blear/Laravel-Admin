<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">管理面板</li>


            <li class="{{active_class(if_route('admin.home'))}} treeview">
                <a href="">
                    <i class="fa fa-dashboard"></i>
                    <span>管理主页</span>
                </a>
            </li>
            @permissions(['manage-users', 'manage-roles'])
            <li class="{{active_class(if_controller(['App\Http\Controllers\Backend\User\UserController','App\Http\Controllers\Backend\Role\RoleController','App\Http\Controllers\Backend\User\UserStatusController']))}} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>权限管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" >
                    @permission('manage-users')
                    <li class="{{active_class(if_controller(['App\Http\Controllers\Backend\User\UserController','App\Http\Controllers\Backend\User\UserStatusController','App\Http\Controllers\Backend\User\UserPasswordController']))}}">
                        <a href="{{route('admin.user.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>用户管理</span>
                        </a>
                    </li>
                    @endauth
                    @permission('manage-roles')
                    <li class="{{active_class(if_controller(['App\Http\Controllers\Backend\Role\RoleController']))}}">
                        <a href="{{route('admin.role.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>角色管理</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </li>
            @endauth
            <li class=" treeview">
                <a href="">
                    <i class="fa fa-dashboard"></i>
                    <span>网站配置</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>