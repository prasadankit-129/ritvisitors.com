<?php session_start();
    date_default_timezone_set('Asia/Kolkata');
    if(isset($_SESSION["id"]) && isset($_SESSION["file"]) && isset($_SESSION["full_name"]) && isset($_SESSION["email"]) && isset($_SESSION["phone_no"]) && isset($_SESSION["user_type"]) )
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RITEE | Visitors</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png" />
    <link href="../plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../css/style.min.css" rel="stylesheet" />
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php
        include('../include/header.php');
        include('../include/aside.php');        
        ?>
        <div class="page-wrapper" style="min-height: 250px">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">RITEE</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"></div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">RIT Web Site</h3>
                            <div>
                                <div>
                                    <iframe src="https://rit.edu.in/" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../js/app-style-switcher.js"></script>
        <script src="../js/waves.js"></script>
        <script src="../js/sidebarmenu.js"></script>
        <script src="../js/custom.js"></script>
        <footer class="footer text-center">Copyright &copy; <script>
                            document.write(new Date().getFullYear());
                        </script> All Rights Reserved | <i class="fa-solid fa-heart"></i> by <a href="https://www.prasadankit.in/">Ankit Prasad</a></footer>
    </body>
</html>
<?php
}
else
{
    header("Location: ../login.php");
}
?>