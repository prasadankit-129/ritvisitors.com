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
