<?php
// session_start();
if ($_SESSION['zdk'] !== 'Admin') {
    header('location:../');
}
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['first_name']; ?>
            <sup>Admin</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="../">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Main page</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href='home_edit.php'>
            <i class="fa fa-home" class="fas fa-fw fa-chart-area" aria-hidden="true"></i>
            <span>Home</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Posts</h6>
                <a class="collapse-item" href="view_all_post.php">View All Posts</a>
                <a class="collapse-item" href="upload_post.php">Upload New Posts</a>
                <a class="collapse-item" href="view_all_users.php">View All Subscribers</a>
                <a class="collapse-item" href="recent-login.php">View Recent logins</a>
                <a class="collapse-item" href="otp_users.php">Not Complete users</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href='status.php'>
            <i class="fa fa-hourglass-start" class="fas fa-fw fa-chart-area" aria-hidden="true"></i>
            <span>Appliances</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="./categories.php">
            <i class="fa fa-book" class="fas fa-fw fa-chart-area" aria-hidden=" true"></i>
            <span>Categories</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="./cheak_buyers.php">
            <i class="fa fa-book" class="fas fa-fw fa-chart-area" aria-hidden=" true"></i>
            <span>Cheak Buyers</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="add_ons.php">
            <i class="fab fa-phoenix-squadron" class="fas fa-fw fa-chart-area" aria-hidden="true"></i>
            <span>Add Ons</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href='payments.php'>
            <i class="fas fa-shopping-cart" class="fas fa-fw fa-chart-area" aria-hidden="true"></i>
            <span>Payments</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="insert_conduct.php">
            <i class="fa fa-code" class="fas fa-fw fa-chart-area" aria-hidden="true"></i>
            <span>Conducte US*</span></a>
    </li>



    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
  <a class="nav-link" href="tables.html">
    <i class="fas fa-fw fa-table"></i>
    <span>Tables</span></a>
</li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>