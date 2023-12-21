<aside class="left-sidebar" style="transition: left 0.5s ease;" data-sidebarbg="skin6">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                        <i class="far fa-clock" aria-hidden="true"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="basic-table.php" aria-expanded="false">
                        <i class="fa fa-table" aria-hidden="true"></i>
                        <span class="hide-menu">Visitors Data</span>
                    </a>
                </li>
                <?php
                    if ($_SESSION["user_type"] == 'Administrator'){
                        echo "<li class='sidebar-item'>
                                <a class='sidebar-link waves-effect waves-dark sidebar-link' href='map-google.php' aria-expanded='false'>
                                    <i class='fa fa-globe' aria-hidden='true'></i>
                                    <span class='hide-menu'>Google Map</span>
                                </a>
                            </li>
                            <li class='sidebar-item'>
                                <a class='sidebar-link waves-effect waves-dark sidebar-link' href='blank.php' aria-expanded='false'>
                                    <i class='fa fa-columns' aria-hidden='true'></i>
                                    <span class='hide-menu'>RITEE Page</span>
                                </a>
                            </li>
                            ";
                    }
                ?>
                <li class='sidebar-item'>
                    <a class='sidebar-link waves-effect waves-dark sidebar-link' href='qrcode.php' aria-expanded='false'>
                        <i class='fa fa-qrcode' aria-hidden='true'></i>
                        <span class='hide-menu'>QR CODE</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>