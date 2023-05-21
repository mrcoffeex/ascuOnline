<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #4fdcf7; color: #fff;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand text-uppercase text-dark" href="index"><?= $my_project_name." ".$my_project_title; ?> - <?= $user_info ?></a>
    </div>
    <!-- /.navbar-header -->
    <div class="full-right">
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" id="navi" href="#">
                <i class="fa fa-user text-dark"></i>  <i class="fa fa-caret-down text-dark"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li>
                    <a href="" data-toggle="modal" data-target="#changepass"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
    </div>
        <?php include("side-panel.php"); ?>
</nav>