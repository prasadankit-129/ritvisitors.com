<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png" />
    <link rel="stylesheet" href="css/Admin.css">
</head>
<body>

    <div class="center">
        <?php
            if(isset($_REQUEST["submit"])) {
                $token = $_REQUEST["token"];
                $new_password = $_REQUEST["new_password"];

                $con = @mysqli_connect("localhost", "root", "", "gatepass");
                if (!$con) {
                    $errorMessage = mysqli_connect_error();
                    echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                    die();
                }
            
                // Check if the token exists in the database
                $qry = "SELECT * FROM users WHERE reset_token='$token'";
                $result = mysqli_query($con, $qry);
            
                if (!$result) {
                    $errorMessage = mysqli_error($con);
                    echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                    die();
                }
            
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['id'];

                    // Update the password and reset token in the database
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_qry = "UPDATE users SET password='$hashed_password', reset_token=NULL WHERE id=$user_id";
                    $update_result = mysqli_query($con, $update_qry);
                
                    if ($update_result) {
                        echo "<h3>Password reset successfully. Click Here to <a href='login.php'>login</a> with your new password.</h3>";
                    } else {
                        echo "<h3>Error updating password. Please try again.</h3>";
                    }
                } else {
                    echo "<h3>Invalid or expired reset token. Please try the <a href='forgot.php'>password reset</a> process again.</h3>";
                }
            }
        ?>
        <form method="post">
            <h1>Reset Password</h1>
            <div class="txt_field">
                <input type="password" name="new_password" required>
                <span></span>
                <label>New Password</label>
            </div>
            <input type="hidden" name="token" value='<?php echo $_GET["token"]; ?>'>
            <button type="submit" name="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
