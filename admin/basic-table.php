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
    <link href="../css/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/style.min.css" rel="stylesheet" />
    <style>
        .dataTables_wrapper .btn{
            color: #ffffff; 
            background-color: #2cabe3; 
            border: 1px solid #2cabe3; 
        }
        .dataTables_wrapper .btn:hover{
            color: #2cabe3; 
            background-color: #ffffff; 
            border: 1px solid #2cabe3;
        }            
        .table img {
          transition: all 0.5s;
        }
        .table td:hover img {
          transform: scale(10);
        }
    </style>
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
        <div class="page-wrapper">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Visitors Table</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"></div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="table-responsive">
                            <table id="example" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>E-mail</th>
                                            <th>Photo</th>
                                            <th>Gender</th>
                                            <th>Visit Time</th>
                                            <th>Pupose</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $con = @mysqli_connect("localhost", "root", "", "gatepass");
                                    if (!$con) {
                                        $errorMessage = mysqli_connect_error();
                                        echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                                        die();
                                    }
                                    $qry="SELECT * FROM visitor_data ORDER BY id";
                                    $result=mysqli_query($con,$qry);
                                    if (!$result) {
                                        $errorMessage = mysqli_error($con);
                                        echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                                        die();
                                    }
                                    $i=1;
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        $visit_time = date("d-m-Y, h:i A", strtotime($row["visit_time"]));
                                        echo "<tr>
                                        <td>$i</td>
                                        <td>" . $row["visitor_name"] . "</td>
                                        <td>" . $row["phone"] . "</td>
                                        <td>" . $row["email"] . "</td>";
                                        $filePath = "../".$row["file"]; // Adjust the file path here
                                        if (file_exists($filePath)) {
                                            echo "<td><img src='$filePath' style='width:20px;height:20px;'></td>";
                                        } else {
                                            echo "<td><img src='img/Default.jpg' style='width:20px;height:20px;'></td>";
                                        }
                                        echo "<td>" . $row["gender"] . "</td>
                                        <td>" . $visit_time . "</td>
                                        <td>" . $row["purpose"] . "</td>
                                        </tr>";
                                        $i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>     
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
        <script src="../js/jquery-3.7.0.js"></script>
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables.bootstrap5.min.js"></script>
        <script src="../js/pdfmake.min.js"></script>
        <script src="../js/vfs_fonts.js"></script>
        <script src="../js/datatables.min.js"></script>
        <script src="../js/buttons.colVis.min.js"></script>                                        
        <script src="../js/buttons.print.min.js"></script>                                        
        <script src="../js/dataTables.buttons.min.js"></script>                                        
        <script>
            $(document).ready(function(){
                $('#example').DataTable({
                    dom: "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-4'f>>" +
                                    "<'row'<'col-sm-12'tr>>" +
                                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: ['excel', 'pdf', 
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },'colvis'],

                    columnDefs: [ {
                        targets: -1,
                        visible: false
                    } ]
                });
                table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
            });
        </script>   
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