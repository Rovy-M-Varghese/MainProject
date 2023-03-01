<?php include ('../config.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$sql = "select * FROM tbl_officer where type='officer'";
$result = mysqli_query($conn, $sql);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>credentials</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .list{
            width:80%;
            /* margin: 0 auto;  */
            margin-left:23%;
            /* margin-right:10px; */
        }
    </style>
</head>
<body><br><br>
<div>
    <a href="index.php">Back to home</a>
</div>

    <form action="" method="POST" class="list">
        <div class="form-row">
            <div class="form-group col-md-7">
                <select class="form-control" id="officer" name="officer">
                    <option>-- select --</option>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['firstname']; ?>"><?php echo $row['firstname']; ?></option>
                        <?php
                        
                            }
                        ?>
                </select>
            </div><br>
            <div class="form-group col-md-4">
                <div class="btn-center">
                    <button type="submit" id="submit" name="submit1">Submit</button>
                </div>
            </div>
        </div>
        
        
        
    </form><br>
 
    <?php
    require '../Exception.php';
    require '../PHPMailer.php';
    require '../SMTP.php';
    function sendMail($e,$u,$p)
    {
        
        require '../vendor/autoload.php';
        $mail = new PHPMailer(true);
        try {
            $email = $e;
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
        $mail->Password   = 'ADSf#246FGfgt';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->setFrom('example@gmail.com','Admin');
        $mail->addAddress($email);    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Farmers Assistant';
        $mail->Body    = "Welcome to be a part of Farmers Assistant group.We look forward to your services.<br> 
                            You can change the password using<br>username:$u<br>password:$p";
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
    }
    if(isset($_POST['allot']))
    {
       
        $u=$_POST['username'];
        $p=$_POST['password'];
        $e=$_POST['email'];
        sendMail($e,$u,$p);
        echo "<script> alert('Details are sent to the mail');</script>";
    }
?>
       <?php if(isset($_POST['submit1']))
        {
            $username = $_POST['officer'];
            //   echo($value);
            $select="SELECT * from tbl_officer WHERE username='$username'";
            $ss= mysqli_query($conn,$select);
            while($rows = mysqli_fetch_assoc($ss)) {
            ?>
    <form class="list" onsubmit="return alot()" method="POST">
        
        <div class="form-row">
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="First name" name="firstname" id="firstname" value="<?php echo $rows['firstname']; ?>">
            </div>
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="Last name" name="lastname" id="lastname" value="<?php echo $rows['lastname']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="email" name="email" id="email" value="<?php echo $rows['email']; ?>">
            </div>
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="phonenumber" name="phonenumber" id="phonenumber" value="<?php echo $rows['pno']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="office location" name="officename" id="officename" value="<?php echo $rows['officename']; ?>">
            </div>
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="city" name="city" id="city" value="<?php echo $rows['city']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="state" name="state" id="state" value="<?php echo $rows['state']; ?>">
            </div>
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="district" name="district" id="district" value="<?php echo $rows['district']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="username" name="username" id="username" value="<?php echo $rows['username']; ?>">
            </div>
            <div class="form-group col-md-4">
            <input type="text" class="form-control" placeholder="password" name="password" id="password" value="<?php echo $rows['password']; ?>">
            </div>
        </div>
        <div >
            <button type="submit"  name="allot" id="allot" class="btn btn-primary">Allot</button>
        </div>
        
    </form>
    <?php
            // my_sqli_close($ss);
        }
    }
        ?>


<script>
    function alot()
    {
        var firstname=document.getElementById('firstname').value;
        var lastname=document.getElementById('lastname').value;
        var email=document.getElementById('email').value;
        var phonenumber=document.getElementById('phonenumber').value;
        var officename=document.getElementById('officename').value;
        var city=document.getElementById('city').value;
        var state=document.getElementById('state').value;
        var district=document.getElementById('district').value;
        var username=document.getElementById('username').value;
        var password=document.getElementById('password').value;


        if(firstname=="")
            {
                document.getElementById('firstname').placeholder="** please fill the field";
                document.getElementById('firstname').style.border="1px solid red";
                document.getElementById('firstname').focus();
                return false;
            }
            if(lastname=="")
            {
                document.getElementById('lastname').placeholder="** please fill the field";
                document.getElementById('lastname').style.border="1px solid red";
                document.getElementById('lastname').focus();
                return false;
            }
            if(email=="")
            {
                document.getElementById('email').placeholder="** please fill the field";
                document.getElementById('email').style.border="1px solid red";
                document.getElementById('email').focus();
                return false;
            }
            if(phonenumber=="")
            {
                document.getElementById('phonenumber').placeholder="** please fill the field";
                document.getElementById('phonenumber').style.border="1px solid red";
                document.getElementById('phonenumber').focus();
                return false;
            }
            if(isNaN(phonenumber))
                    {
                      alert('please enter a numeric value');
                      document.getElementById('phonenumber').style.border="1px solid red";
                      document.getElementById('phonenumber').focus();
                      return false;

                    }
            if(oname=="")
            {
                document.getElementById('oname').placeholder="** please fill the field";
                document.getElementById('oname').style.border="1px solid red";
                document.getElementById('oname').focus();
                return false;
            }
            if(city=="")
            {
                document.getElementById('city').placeholder="** please fill the field";
                document.getElementById('city').style.border="1px solid red";
                document.getElementById('city').focus();
                return false;
            }
            if(state=="")
            {
                alert('Please select an item');
                document.getElementById('state').style.border="1px solid red";
                document.getElementById('state').focus();
                document.getElementById('district').style.border="1px solid red";
                // document.getElementById('district').focus();
                return false;
            }
            if(username=="")
            {
                document.getElementById('username').placeholder="** please fill the field";
                document.getElementById('username').style.border="1px solid red";
                document.getElementById('username').focus();
                return false;
            }
            if(password=="")
            {
                document.getElementById('password').placeholder="** please fill the field";
                document.getElementById('password').style.border="1px solid red";
                document.getElementById('password').focus();
                return false;
            }
    }
</script>
</body>
</html>
