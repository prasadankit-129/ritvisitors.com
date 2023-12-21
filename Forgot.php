<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the autoloader for PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php'; 

session_start();
date_default_timezone_set('Asia/Kolkata');

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png" />
    <link rel="stylesheet" href="css/Admin.css">
</head>
<body>

    <div class="center">
        <?php
            if (isset($_POST["submit"])) {
                $email = $_POST["email"];

                $con = @mysqli_connect("localhost", "root", "", "gatepass");
                if (!$con) {
                    $errorMessage = mysqli_connect_error();
                    echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
                    die();
                }
            
                $qry = "SELECT * FROM users WHERE email='$email'";
                $result = mysqli_query($con, $qry);
                if (!$result) {
                    $errorMessage = mysqli_error($con);
                    echo '<script>alert("Error : ' . $errorMessage . '");</script>';
                    die();
                }
            
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['id'];
                
                    // Generate a unique token for password reset
                    $reset_token = md5(uniqid(rand(), true));
                
                    // Store the reset token in the database
                    $update_qry = "UPDATE users SET reset_token='$reset_token' WHERE id=$user_id";
                    $update_result = mysqli_query($con, $update_qry);
                
                    if ($update_result) {
                        // Send an email with the password reset link
                        $reset_link = "http://localhost/ritvisitors.com/reset_password.php?token=$reset_token";
                    
                        $mail = new PHPMailer(true);
                    
                        try {
                            //Server settings
                            $mail->isSMTP();
                            $mail->Host       = 'smtp.gmail.com';  // Specify the SMTP server
                            $mail->SMTPAuth   = true;
                            $mail->Username   = 'prasadankit129@gmail.com';  // SMTP username
                            $mail->Password   = 'odfq hlqq agxu acny';  // SMTP password
                            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                            $mail->Port       = 587;  // TCP port to connect to
                        
                            //Recipients
                            $mail->setFrom('prasadankit129@gmail.com', 'Ankit Prasad');
                            $mail->addAddress($email, $row['full_name']);  // Use the user's email and name
                        
                            //Content
                            $mail->isHTML(true);  // Set email format to HTML
                            $mail->Subject = 'Password Reset';
                            $mail->Body    = "Click the following link to reset your password: $reset_link <br><br> More About Me :- <a href='http://www.prasadankit.in/'>prasadankit.in</a> ";

                            $mail->send();
                            echo "<h3>Password reset link has been sent to your email. Please check your inbox.</h3>";
                        } catch (Exception $e) {
                            echo "<h3>Error sending email: {$mail->ErrorInfo}</h3>";
                        }
                    } else {
                        echo "<h3>Error generating reset token. Please try again.</h3>";
                    }
                } else {
                    echo "<h3>Email not found! Please enter a valid email.</h3>";
                }
            }    
        ?>
        <form method="post"> <!-- Change from GET to POST -->
            <h1>Forgot Password</h1>
            <div class="txt_field">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
