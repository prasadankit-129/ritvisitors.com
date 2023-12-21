<?php session_start();
    date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png" />
    <link rel="stylesheet" href="css/Admin.css">
</head>
<body>
    <div class="center">
            <?php
            if(isset($_REQUEST["Login"]))
            {	
                $email=$_REQUEST["email"];
                $password=$_REQUEST["password"];
            
                $con = @mysqli_connect("localhost", "root", "", "gatepass");
                if (!$con) {
                    $errorMessage = mysqli_connect_error();
                    echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                    die();
                }
            
                $qry="SELECT * FROM users WHERE email='$email' ";
                $result=mysqli_query($con,$qry);
                if (!$result) {
                    $errorMessage = mysqli_error($con);
                    echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                    die();
                }
                
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $hashed_password_from_db = $row['password'];
                
                    if (password_verify($password, $hashed_password_from_db)) { 
                        $_SESSION["id"] = $row['id'];
                        $_SESSION["file"]=$row["file"];
                        $_SESSION["full_name"]=$row["full_name"];
                        $_SESSION["email"]=$row["email"];
                        $_SESSION["phone_no"]=$row["phone_no"];
                        $_SESSION["user_type"]=$row["user_type"];
                        header("Location: admin/index.php");
                    } else {                
                        echo "<h3>Invalid email or password</h3>";
                    }
                } else {            
                    echo "<h3>Email not found ! Please contact Administrator</h3>";
                }
            }
        ?>
        
        <form method="post">
        <h1>Login</h1>
        <div class="txt_field">
                <input type="email" name="email" required>
                <span></span>
                <label>email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <p><a href="Forgot.php">Forgot Password?</a></p>
            <button type="submit" name="Login">Login</button>
        </form>
    </div>
</body>
</html>
