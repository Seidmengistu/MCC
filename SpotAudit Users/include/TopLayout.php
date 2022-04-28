

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        <span class="badge badge-danger navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header"></span>
                        <div class="dropdown-divider"></div>
                        <a href="../profile/showprofile.php" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> Profile
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../../logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                            <span class="float-right text-muted text-sm"></span>
                        </a>

                </li>

        </nav>

        <aside class="main-sidebar sidebar-light-primary elevation-1">
            <div class="sidebar">

                <a class="brand-link text-center" href="#"><img src="../../includes/images/mojo_customs_commission.png"
                        alt="AdminLTE Logo" class="img-circle" width="80%"></a>
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="">

                            <p class="text-info nav-link"><?php $mydate=new DateTime(); echo $mydate->format('Y-m-d')?>
                            </p>
                        </li>
                        <a href="../SpotAuditUsersHome.php" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Users Home
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <span class="badge badge-danger navbar-badge"></span>
                                <p>
                                    New Messages
                                    <i class="right fas fa-angle-left"></i>
                                    <?php
                                    $username=$_SESSION['username'];
                                    $query=$dbh->prepare("SELECT id From Message WHERE status=0 && Sender_Name=:username  ORDER BY id");
                                    $query-> bindParam(':username', $username, PDO::PARAM_STR);
                                     $query->execute();
                                     
                                     
                                    $row=$query->rowCount();
                                    ?>
                                    <span class="right badge badge-danger"><?php echo $row;?></span>
                                </p>
                            </a>
                            <!-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../Message/SendMessage.php" class="nav-link">
                                        <i class="far fa-circle nav-icon text-danger"></i>
                                        <p>Send Message</p>
                                    </a>
                                </li>
                            </ul> -->

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../Message/ShowMessage.php" class="nav-link ">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Show Message</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../Message/Statistics.php" class="nav-link ">
                                        <i class="far fa-circle nav-icon text-warning"></i>
                                        <p>Statistics </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>