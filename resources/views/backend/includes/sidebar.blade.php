<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>UserName</p>
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

            <li class="{{active_class(if_controller(['App\Http\Controllers\Backend\User\UserController']))}} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>权限管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" >

                    <li class="{{active_class(if_controller(['App\Http\Controllers\Backend\User\UserController']))}}">
                        <a href="{{route('admin.user.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>用户管理</span>
                        </a>
                    </li>



                    <li class="">
                        <a href="">
                            <i class="fa fa-circle-o"></i>
                            <span>角色管理</span>
                        </a>
                    </li>

                </ul>
            </li>

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