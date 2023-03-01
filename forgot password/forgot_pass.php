<?php
session_start();
include ('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader

function sendMail($code)
  {
    // require ("PHPMailer.php");
    // require ("SMTP.php");
    // require ("Exception.php");
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    try {
        $email = $_SESSION['email'];
      //Server settings
    //   $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'example@gmail.com';                     //SMTP username
      $mail->Password   = 'FHGgtt342$%5';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      $mail->setFrom('example@gmail.com','Admin');
      $mail->addAddress($email);    
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Farmers Assistant';
      $mail->Body    = "Welcome to be a part of Farmers Assistant group.We look forward to your services.<br> 
                        You can change the password using<br>$code";
      $mail->send();
    //   header("otp.php");
      return true;
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      return false;
  }
}
if(isset($_POST['send_otp'])){
    $mail = $_POST['email'];
    $checkMail = "SELECT * FROM tbl_register WHERE email='$mail'";
    $result = mysqli_query($conn,$checkMail);
    $rsltCheck = mysqli_num_rows($result);
    $fetch = mysqli_fetch_array($result);
    if($rsltCheck>0)
    {
        $_SESSION['email'] = $fetch['email'];
        $email = $_SESSION['email'];
        $code = rand(999999, 111111);
        $insert_otp = "UPDATE `tbl_register` SET `otp_code`='$code' WHERE `email`='$email'";
        // $insert_otp1="UPDATE `tbl_login` SET `otp_code`='$code' WHERE `email`='$email'";
        $data_check = mysqli_query($conn, $insert_otp);
        if($data_check){
            sendMail($code);
            echo "<script> alert('OTP is sent to the mail');</script>";
            header('location:otp.php');
        }
        else{
            echo "<script> alert('Wrong'); </script>";
        }
    }
    else{
        echo "<script> alert('No email found'); </script>";
        //header('location:forgot_password.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forgot Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "segoe ui", verdana, helvetica, arial, sans-serif;
            font-size: 16px;
            transition: all 500ms ease; 
        }

        body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
        -moz-font-feature-settings: "liga" on; }

        .row {
        background-color: rgba(20, 120, 200, 0.6);
        color: #fff;
        text-align: center;
        padding: 2em 2em 0.5em;
        width: 90%;
        margin: 2em	auto;
        border-radius: 5px; }
        .row h1 {
            font-size: 2.5em; }
        .row .form-group {
            margin: 0.5em 0; }
            .row .form-group label {
            display: block;
            color: #fff;
            text-align: left;
            font-weight: 600; }
            .row .form-group input, .row .form-group button {
            display: block;
            padding: 0.5em 0;
            width: 100%;
            margin-top: 1em;
            margin-bottom: 0.5em;
            background-color: inherit;
            border: none;
            border-bottom: 1px solid #555;
            color: #eee; }
            .row .form-group input:focus, .row .form-group button:focus {
                background-color: #fff;
                color: #000;
                border: none;
                padding: 1em 0.5em; animation: pulse 1s infinite ease;}
            .row .form-group button {
            border: 1px solid #fff;
            border-radius: 5px;
            outline: none;
            -moz-user-select: none;
            user-select: none;
            color: #333;
            font-weight: 800;
            cursor: pointer;
            margin-top: 2em;
            padding: 1em; }
            .row .form-group button:hover, .row .form-group button:focus {
                background-color: #fff; }
            .row .form-group button.is-loading::after {
                animation: spinner 500ms infinite linear;
                content: "";
                position: absolute;
                margin-left: 2em;
                border: 2px solid #000;
                border-radius: 100%;
                border-right-color: transparent;
                border-left-color: transparent;
                height: 1em;
                width: 4%; }
        .row .footer h5 {
            margin-top: 1em; }
        .row .footer p {
            margin-top: 2em; }
            .row .footer p .symbols {
            color: #444; }
        .row .footer a {
            color: inherit;
            text-decoration: none; }

        .information-text {
        color: #ddd; }

        @media screen and (max-width: 320px) {
        .row {
            padding-left: 1em;
            padding-right: 1em; }
            .row h1 {
            font-size: 1.5em !important; } }
        @media screen and (min-width: 900px) {
        .row {
            width: 50%; } }

    </style>
</head>
<body>
	<div class="row">
		<h1>Forgot Password</h1>
		<h6 class="information-text">Enter your registered email to reset your password.</h6>
        <form action="" method="POST">
		<div class="form-group">
			<input type="email" name="email" placeholder="Enter your email here" required pattern="/^[\w\+\'\.-]+@[\w\'\.-]+\.[a-zA-Z]{2,}$/" title="Please enter a valid email address">
			<button onclick="showSpinner()" name="send_otp" value="Send OTP">Reset Password</button>
		</div>
        </form> 
		<div class="footer">
			<h5>New here? <a href="Home.php">Sign Up.</a></h5>
			<h5>Already have an account? <a href="Login.php">Sign In.</a></h5>
		</div>
        <br>
	</div>
</body>
</html>
