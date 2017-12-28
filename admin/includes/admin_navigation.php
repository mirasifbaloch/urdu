<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/urdu/admin/">ایڈمن </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">


<!--            <li><a href="";>Users Online: --><?php //echo users_online(); ?><!--</a></li>-->


            <li><a href="";>آن لائن یوزرز: <span class="usersonline"></span></a></li>
            <li><a href="/../urdu/">فرنٹ پیج </a></li>
            <li><a href="../includes/logout.php">لوگ آوٹ <i class="fa fa-sign-out fa-hand-o-left"></i></a>
            </li>
            <!-- /.dropdown -->
        </ul>


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="/urdu/admin/"><i class="fa fa-dashboard fa-fw"></i>ڈیش بورڈ </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> پوسٹس  <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="posts.php">تمام پوسٹس </a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_posts">نئی پوسٹ </a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a href="categories.php"><i class="fa fa-fw fa-bar-chart-o"></i>کیٹگریز </a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-fw fa-edit"></i>کمنٹس </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-users"></i>یوزرز <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users_dropdown" class="collapse">
                            <li>
                                <a href="users.php">تمام یوزرز </a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">نئے یوزر</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="profile.php"><i class="fa fa-user fa-fw"></i>پروفائل </a>
                    </li>

                </ul>
                        <!-- /.nav-second-level -->

            </div>
            <!-- /.sidebar-collapse -->
        </div>
    </nav>