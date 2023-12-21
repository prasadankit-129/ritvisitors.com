<?php
date_default_timezone_set('Asia/Kolkata');
if (isset($_POST["submit"])) {
    $path = 'uploads/';
    $target_file = $path . basename($_FILES["file"]["name"]);
    
    $visitor_name = $_POST["visitor_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $purpose = $_POST["purpose"];
    
    $con = @mysqli_connect("localhost", "root", "", "gatepass");
    if (!$con) {
        $errorMessage = mysqli_connect_error();
        echo '<script>alert("Connection failed: ' . $errorMessage . '");</script>';
        die();
    }
    
    $qry = "INSERT INTO visitor_data (visitor_name, email, phone, gender, file, purpose) 
    VALUES ('$visitor_name', '$email', '$phone', '$gender', '$target_file', '$purpose')";
    
    if (mysqli_query($con, $qry)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            header("Location: Greeting.php");
        } else {
            $errorMessage = $_FILES["file"]["error"];
            echo '<script>alert("Error : ' . $errorMessage . '");</script>';
        }
    } else {
        $errorMessage = mysqli_error($con);
        echo '<script>alert("Error : ' . $errorMessage . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>RITEE | Visitors Detail Form</title>
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png" />
</head>
<body>
    <a href="https://rit.edu.in/" target="_blank">
        <center style="padding-top: 10px;"><img src="img/rit-1.png" alt="Raipur Institute of Technology Logo"></center>
    </a>
    <p>Please fill out the following information :- </p>
    
    <form method="POST" enctype="multipart/form-data">
        <label for="file">
            <span>Choose File :- </span>
            <input type="file" id="file" name="file" accept="image/*" capture="camera" required><br><br>
        </label>

        <label for="full_name">Full Name :-</label>
        <input type="text" id="visitor_name" name="visitor_name" required><br><br>

        <label for="email">Email :-</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone Number :-</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required title="Please enter a 10-digit phone number"><br><br>

        <label for="purpose">Purpose of Visit :-</label>
        <textarea id="purpose" name="purpose" rows="4" cols="50" required></textarea><br><br>

        <label> Gender : </label>
        <input type="radio" name="gender" value="Male" >Male
        <input type="radio" name="gender" value="Female" >Female
        <input type="radio" name="gender" value="Other" >Other<br><br>

        <input type="submit" value="Submit" name="submit">
        <input type="reset" value="Reset" name="reset">
    </form>
</body>
</html>
