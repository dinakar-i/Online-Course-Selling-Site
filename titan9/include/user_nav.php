<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form name="submit" action="search_user.php" method="POST"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" name='search' class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <form action="view_all_users.php" method="post">
        <select name="se_sel">
            <option value="email_id">user id</option>
            <option value="first_name">User name</option>
            <option value="phone_number">Mopile number</option>
            <option value="role">Role</option>
            <input type="submit" name="submit_sel" value="Submit" />
        </select>
    </form>
</nav>