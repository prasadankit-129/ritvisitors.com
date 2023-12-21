<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin6">
                <a class="navbar-brand" href="https://rit.edu.in" target="_blank">
                    <img src="../plugins/images/logo.png" width="57" height="60" alt="">
                    <img src="../plugins/images/logo_text.png" width="170" alt="">
                </a>
            <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="fa-solid fa-bars"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li>
                    <a class="profile-pic" href="profile.php">
                        <?php
                        if (!empty($_SESSION["file"]) && file_exists($_SESSION["file"])) {
                            echo '<img src="' . $_SESSION["file"] . '" alt="user-img" width="36" height="36" class="img-circle" >';
                            } else {
                                echo '<img src="img/Default.jpg" alt="user-img" width="36" height="36" class="img-circle" >';
                        }
                        ?>
                        <span class="text-white font-medium">
                        <?php
                            echo($_SESSION["user_type"]);
                        ?>
                        </span>
                    </a>
                    <a href="../Logout.php"><span><button type="button" class="btn rounded-pill btn-light m-2">Logout</button></span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>