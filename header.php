<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
            <?php
            if (isset($_SESSION["loged"])) {
                if ($_SESSION["loged"] == "admin") {
                    ?>
                    <li class="active"><a href="diemdanh.php">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="admin.php">admin </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li><a href="user.php">User</a></li>
                    <li><a href="update.php">Cap nhat thong tin</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="listdiemdanh.php">Danh sach diem danh </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
            if (isset($_SESSION["loged"])) {
                if ($_SESSION["loged"] == "admin") {
                echo '<li><a href="../logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>';
                } else {
                echo '<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>';
                }
            } else {
                echo '<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
                echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>