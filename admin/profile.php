<?php session_start();
    date_default_timezone_set('Asia/Kolkata');
    if(isset($_SESSION["id"]) && isset($_SESSION["file"]) && isset($_SESSION["full_name"]) && isset($_SESSION["email"]) && isset($_SESSION["phone_no"]) && isset($_SESSION["user_type"]) )
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>RITEE | Visitors</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png" />
    <link href="../plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../css/style.min.css" rel="stylesheet" />
    <style>
        .user-content img {
        transition: all 0.5s ease;
    }
    .user-content img:hover {
        transform: scale(4.9) translateY(10px); /* Increase the size to 1.2 times */
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
                    <div class="col col-md-4 ">
                        <h4 class="page-title">Profile</h4>
                    </div>
                    <div class="col col-md-8">
                        <a href="#edit"><button onclick="myFunction()" class="btn btn-primary px-4 rounded-pill"><i class="fa-solid fa-plus pe-2"></i>Create</button></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="row">
                        <div class="white-box">
                            <div class="user-bg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="profile.php">
                                            <?php
                                            if (!empty($_SESSION["file"]) && file_exists($_SESSION["file"])) {
                                                echo '<img src="' . $_SESSION["file"] . '" class="thumb-lg img-circle" alt="img" >';
                                            } else {
                                                echo '<img src="img/Default.jpg" class="thumb-lg img-circle" alt="img" >';
                                            }  
                                            ?>
                                        </a>
                                            <h4 class="text-white mt-2">
                                            <?php
                                                    echo($_SESSION["full_name"]);
                                            ?>
                                                </h4>
                                            <h5 class="text-white mt-2">
                                                <?php
                                                    echo($_SESSION["email"]);
                                                ?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-btm-box mt-5 d-md-flex">
                                    <div class="col-md-12 col-sm-12 text-center"><h2>
                                        <?php
                                        echo($_SESSION["phone_no"]);
                                        ?>
                                    </h2>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="white-box">
                                <div class="card">
                                    <div class="card">
                                        <div class="table-responsive">
                                        <h3 class="box-title mb-0">Users</h3>
                                            <table id="example" class="table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Name</th>
                                                        <th>Post</th>
                                                        <?php
                                                        if ($_SESSION["user_type"] == 'Administrator')
                                                        echo "<th>Action</th>";
                                                        ?>
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
                                                    $qry = "SELECT * FROM users";
                                                    $result = mysqli_query($con, $qry);
                                                    if (!$result) {
                                                        $errorMessage = mysqli_error($con);
                                                        echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                                                        die();
                                                    }
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo "<tr>
                                                                <td>$i</td>
                                                                <td>" . $row["full_name"] . "</td>
                                                                <td>" . $row["user_type"] . "</td>";
                                                                if ($_SESSION["user_type"] == 'Administrator' && $row["user_type"] != 'Administrator') {
                                                                    echo "<td>
                                                                            <form method='post'>
                                                                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                                                <button class='btn pt-0' name='delete'>
                                                                                    <i class='fa-solid fa-trash' style='color: #ff0000;'></i>
                                                                                </button>
                                                                            </form>
                                                                        </td>";
                                                                }
                                                                echo "</tr>";
                                                                $i++;
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php
                                                 if(isset($_POST['delete'])){
                                                    $id = $_POST['id'];
                                                    $qry = "DELETE FROM users WHERE id='$id'";
                                                    if (mysqli_query($con, $qry) === TRUE) {
                                                        echo "<script>alert('Deleted Successfully');</script>";
                                                    } else {
                                                        echo ("Error");
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div id="edit" class="card-body">
                                <form method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                                    <div class="form-group mb-4">
                                        <label for="example-file" class="col-md-12 p-0">Upload Photo</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="file" class="form-control p-0 border-0"  id="file" name="file" accept="image/*" capture="camera" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Full Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="full_name" class="form-control p-0 border-0" required/>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" class="form-control p-0 border-0" name="email" required/>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" name="password" class="form-control p-0 border-0" required/>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Phone No</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="phone_no" class="form-control p-0 border-0" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required/>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">User Type</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select name="user_type" class="form-control p-0 border-0" required>
                                                <option value="" disabled selected>Select an option</option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="Gatekeeper">Gatekeeper</option>
                                                <option value="Receptionist">Receptionist</option>
                                                <option value="Employee">Employee</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button id="update" class="btn btn-success rounded-pill px-4 me-1" name="Update">Update</button>
                                            <button id="create" class="btn btn-success rounded-pill px-4 me-1" name="Create" style="display: none;">Create</button>
                                            <button id="update" class="btn btn-success rounded-pill px-4 me-1" name="Update" type="reset">Reset</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                    if (isset($_POST["Update"])) {
                                        $path = 'img/';
                                        $target_file = $path . basename($_FILES["file"]["name"]);
                                    
                                        $full_name = $_POST["full_name"];
                                        $email = $_POST["email"];
                                        $password = $_POST["password"];
                                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                        $phone_no = $_POST["phone_no"];
                                        $user_type = $_POST["user_type"];
                                        $id = $_SESSION["id"];
                                    
                                        $con = @mysqli_connect("localhost", "root", "", "gatepass");
                                        if (!$con) {
                                            $errorMessage = mysqli_connect_error();
                                            echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                                            die();
                                        }
                                        $qry = "UPDATE users SET file='$target_file', full_name='$full_name', email='$email', password='$hashed_password', phone_no='$phone_no', user_type='$user_type' WHERE id='$id' ";
                                    
                                        if (mysqli_query($con,$qry)) {
                                            if (move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)) {
                                                echo "<script>alert('Updated Successfully');</script>";
                                            } else {
                                                echo ("Error Uploading File");
                                            }
                                        } else {
                                            echo '<script>alert("Error : ' . mysqli_error($con) . '");</script>';
                                        }
                                    }
                                    ?>
                                    <?php
                                    if (isset($_POST["Create"])) {
                                        $path = 'img/';
                                        $target_file = $path . basename($_FILES["file"]["name"]);
                                    
                                        $full_name = $_POST["full_name"];
                                        $email = $_POST["email"];
                                        $password = $_POST["password"];
                                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                        $phone_no = $_POST["phone_no"];
                                        $user_type = $_POST["user_type"];
                                        $id = $_SESSION["id"];
                                    
                                        $con = @mysqli_connect("localhost", "root", "", "gatepass");
                                        if (!$con) {
                                            $errorMessage = mysqli_connect_error();
                                            echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                                            die();
                                        }
                                        $qry = "INSERT INTO users (file, full_name, email, password, phone_no, user_type)
                                        VALUES ('$target_file','$full_name','$email','$hashed_password','$phone_no','$user_type')";
                                    
                                        if (mysqli_query($con,$qry)) {
                                            if (move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)) {
                                                echo "<script>alert('Created Successfully');</script>";
                                            } else {
                                                echo ("Error Uploading File");
                                            }
                                        } else {
                                            echo '<script>alert("Error : ' . mysqli_error($con) . '");</script>';
                                        }
                                    }
                                    ?>
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
    <script>
        function myFunction() {
            document.getElementById("update").style.display = "none";
            document.getElementById("create").style.display = "inline-block";
        }
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