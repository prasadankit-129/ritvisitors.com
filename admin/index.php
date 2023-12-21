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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
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
        <div class="page-wrapper">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"></div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Today Visitors</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash">
                                        <canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto">
                                    <span class="counter text-success">
                                        <?php
                                            $con = @mysqli_connect("localhost", "root", "", "gatepass");
                                            if (!$con) {
                                                $errorMessage = mysqli_connect_error();
                                                echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                                                die();
                                            }
                                            $qry = "SELECT * FROM visitor_data WHERE DATE(visit_time) = CURDATE()";
                                            $result=mysqli_query($con,$qry);
                                            if (!$result) {
                                                $errorMessage = mysqli_error($con);
                                                echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                                                die();
                                            }
                                            if ($result->num_rows > 0) 
                                            {
                                                echo "$result->num_rows";
                                            } else {
                                                echo "0";
                                            }
                                            $con->close();
                                        ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Monthly Visitors</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash3">
                                        <canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto">
                                    <span class="counter text-info">                      
                                        <?php                      
                                            $con=mysqli_connect("localhost","root","","gatepass");
                                            if (!$con) {
                                                $errorMessage = mysqli_connect_error();
                                                echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                                                die();
                                            }
                                            $qry="SELECT * FROM visitor_data WHERE YEAR(visit_time) = YEAR(CURDATE()) AND MONTH(visit_time) = MONTH(CURDATE()) ";
                                            $result=mysqli_query($con,$qry);                                          
                                            if (!$result) {
                                                $errorMessage = mysqli_error($con);
                                                echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                                                die();
                                            }
                                            if ($result->num_rows > 0) 
                                            {
                                                echo "$result->num_rows";
                                            } else {
                                                echo "0";
                                            }                      
                                            $con->close();
                                            ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Yearly Visitors</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2">
                                        <canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto">
                                    <span class="counter text-primary">                      
                                        <?php                      
                                            $con=mysqli_connect("localhost","root","","gatepass");
                                            if (!$con) {
                                                $errorMessage = mysqli_connect_error();
                                                echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                                                die();
                                            }
                                            $qry="SELECT * FROM visitor_data WHERE YEAR(visit_time) = YEAR(CURDATE())";
                                            $result=mysqli_query($con,$qry);                                          
                                            if (!$result) {
                                                $errorMessage = mysqli_error($con);
                                                echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                                                die();
                                            }
                                            if ($result->num_rows > 0) 
                                            {
                                                echo "$result->num_rows";
                                            } else {
                                                echo "0";
                                            }                      
                                            $con->close();
                                            ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">All Visitors</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash4">
                                        <canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto">
                                    <span class="counter text-danger">                      
                                        <?php                      
                                            $con=mysqli_connect("localhost","root","","gatepass");
                                            if (!$con) {
                                                $errorMessage = mysqli_connect_error();
                                                echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                                                die();
                                            }
                                            $qry="SELECT * FROM visitor_data";
                                            $result=mysqli_query($con,$qry);                                          
                                            if (!$result) {
                                                $errorMessage = mysqli_error($con);
                                                echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                                                die();
                                            }
                                            if ($result->num_rows > 0) 
                                            {
                                                echo "$result->num_rows";
                                            } else {
                                                echo "0";
                                            }                      
                                            $con->close();
                                            ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Visiting Report | Bar Chart</h3>
                            <div class="p-2">
                                 <canvas id="chartToday" width="300" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Visiting Report | Line Chart</h3>
                            <div class="p-2">
                                 <canvas id="chartToday1" width="300" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Recent Visitors :- 
                                    <?php
                                    $con=mysqli_connect("localhost","root","","gatepass");
                                    if (!$con) {
                                        $errorMessage = mysqli_connect_error();
                                        echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                                        die();
                                    }
                                    $qry = "SELECT * FROM visitor_data WHERE DATE(visit_time) = CURDATE() ORDER BY visit_time DESC LIMIT 10";
                                    $result=mysqli_query($con,$qry);
                                    if (!$result) {
                                        $errorMessage = mysqli_error($con);
                                        echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                                        die();
                                    }
                                    if ($result->num_rows > 0) {
                                        echo "$result->num_rows";
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap">
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
                                    <?php
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
                                        $con->close();
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                
                </div>
            </div>
        <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../js/app-style-switcher.js"></script>
        <script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../js/waves.js"></script>
        <script src="../js/sidebarmenu.js"></script>
        <script src="../js/custom.js"></script>
        <script src="../plugins/bower_components/chartist/dist/chartist.min.js"></script>
        <script src="../plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
        <script src="../js/pages/dashboards/dashboard1.js"></script>
        <?php
            $con = mysqli_connect("localhost", "root", "", "gatepass");

            // Today Visitors
            $qryToday = "SELECT * FROM visitor_data WHERE DATE(visit_time) = CURDATE()";
            $resultToday = mysqli_query($con, $qryToday);
            $todayCount = ($resultToday->num_rows > 0) ? $resultToday->num_rows : 0;

            // Monthly Visitors
            $qryMonth = "SELECT * FROM visitor_data WHERE YEAR(visit_time) = YEAR(CURDATE()) AND MONTH(visit_time) = MONTH(CURDATE())";
            $resultMonth = mysqli_query($con, $qryMonth);
            $monthCount = ($resultMonth->num_rows > 0) ? $resultMonth->num_rows : 0;

            // Yearly Visitors
            $qryYear = "SELECT * FROM visitor_data WHERE YEAR(visit_time) = YEAR(CURDATE())";
            $resultYear = mysqli_query($con, $qryYear);
            $yearCount = ($resultYear->num_rows > 0) ? $resultYear->num_rows : 0;

            // All Visitors
            $qryAll = "SELECT * FROM visitor_data";
            $resultAll = mysqli_query($con, $qryAll);
            $allCount = ($resultAll->num_rows > 0) ? $resultAll->num_rows : 0;
            

            $con->close();
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var ctxToday = document.getElementById('chartToday').getContext('2d');
                var data = {
                    labels: ['Today', 'Monthly', 'Yearly', 'All'],
                    datasets: [{
                        label: 'Visitor Count',
                        data: [<?php echo $todayCount; ?>, <?php echo $monthCount; ?>, <?php echo $yearCount; ?>, <?php echo $allCount; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
            
                var options = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
            
                var todayChart = new Chart(ctxToday, {
                    type: 'bar',
                    data: data,
                    options: options
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var ctxToday = document.getElementById('chartToday1').getContext('2d');
                var data = {
                    labels: ['Today', 'Monthly', 'Yearly', 'All'],
                    datasets: [{
                        label: 'Visitor Count',
                        data: [<?php echo $todayCount; ?>, <?php echo $monthCount; ?>, <?php echo $yearCount; ?>, <?php echo $allCount; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
            
                var options = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
            
                var todayChart = new Chart(ctxToday, {
                    type: 'line',
                    data: data,
                    options: options
                });
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