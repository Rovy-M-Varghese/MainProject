<?php 
include ('../config.php');
session_start();
// $sql="SELECT * FROM tbl_notification";
// $result = mysqli_query($conn, $sql);
if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$pno=$_POST['pno'];
    $oname=$_POST['oname'];
    $city=$_POST['city'];
    $state=$_POST['inputState'];
	$district=$_POST['inputDistrict'];
	$username=$_POST['username'];
    $password=$_POST['password'];

    $select="SELECT * from tbl_register  WHERE username='$username'";
	$result= mysqli_query($conn,$select);
	if(mysqli_num_rows($result)> 0 )
	{
		echo '<script type="text/javascript"> alert("user alery exist")</script>';
		// $error[]='user already exist';
	}
    else
    {
        $sql="INSERT INTO tbl_officer(firstname,lastname,email,pno,officename,city,state,district,username,password,type)VALUES('$fname','$lname','$email','$pno','$oname','$city','$state','$district','$username','$password','officer')";
        $res=mysqli_query($conn,$sql);
                
        $resu="INSERT INTO tbl_login(username,password,type) VALUES ('$username','$password','officer')";
        mysqli_query($conn,$resu);
        if($res == TRUE)
                {
                    echo '<script>alert("Inserted to the Database Sucessfully")</script>';
                    // header("Location:../Login.php");
                }
                else
                {
                    // echo $sql="INSERT INTO tbl_register(firstname,lastname,dob,gender,email,phonenumber,landtype,measurement,units,building_name,street_no,city,zip_code,state,district,username,password,type)VALUES('$firstname','$lastname','$age','$gender','$email','$phonenumber','$landtype','$measurement','$units','$building_name','$street_no','$city','$zip_code',$statee,'$district','$username','$password','farmer')";

                    echo ' alert("failed")';
                }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add officer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="nstyle.css">
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all"> 
    <script class="u-script" type="text/javascript" src="../form.js"  defer=""></script>

    <style>
        .btn 
        {
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            cursor: pointer;
        }
        form
        {
            width:80%;
            margin: 0 auto;        
        }
    </style>
</head>
<body>
    <div class="section__content section__content--p30">
        <div class="container-fluid a-right">
            <div class="header-wrap">
                <div class="header-button">
                                <div class="noti-wrap">
                                    <div>
                                    <a class="btn" href="index.php"><i class="fa fa-home"></i> Home</a>                                        
                                    </div>
                                </div>&nbsp;
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar.jpg" alt="admin" />
                                        </div>
                                        <div class="content">
                                            <?php                                               
                                                if(isset($_SESSION['username']))
                                                {
                                                    echo '<h2 class="js-acc-btn"><b>'.$_SESSION['username'].'</b></h6>';                                                                                     
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center"><b><h1>ADD OFFICER</h1></b></div><br>
    <form onsubmit="return ovalidate()" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">firstname</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="first name" autocomplete="off">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">lastname</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="last name" autocomplete="off">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress">email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="email" autocomplete="off">
            </div>
            <div class="form-group col-md-6">
                    <label for="inputPassword4">phonenumber</label>
                    <input type="text" class="form-control" id="pno" name="pno" placeholder="phonenumber" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Office name</label>
            <input type="text" class="form-control" id="oname" name="oname" placeholder="Office name" autocomplete="off">
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="City" autocomplete="off">
            </div>
            <div class="form-group col-md-3">
                <label for="inputState">State</label>
                <select class="form-control " id="inputState" name="inputState">
                                                                        <option value="SelectState">Select State</option>
                                                                        <option value="Andra Pradesh">Andra Pradesh</option>
                                                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                        <option value="Assam">Assam</option>
                                                                        <option value="Bihar">Bihar</option>
                                                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                                                        <option value="Goa">Goa</option>
                                                                        <option value="Gujarat">Gujarat</option>
                                                                        <option value="Haryana">Haryana</option>
                                                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                                        <option value="Jharkhand">Jharkhand</option>
                                                                        <option value="Karnataka">Karnataka</option>
                                                                        <option value="Kerala">Kerala</option>
                                                                        <option value="Madya Pradesh">Madya Pradesh</option>
                                                                        <option value="Maharashtra">Maharashtra</option>
                                                                        <option value="Manipur">Manipur</option>
                                                                        <option value="Meghalaya">Meghalaya</option>
                                                                        <option value="Mizoram">Mizoram</option>
                                                                        <option value="Nagaland">Nagaland</option>
                                                                        <option value="Orissa">Orissa</option>
                                                                        <option value="Punjab">Punjab</option>
                                                                        <option value="Rajasthan">Rajasthan</option>
                                                                        <option value="Sikkim">Sikkim</option>
                                                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                                                        <option value="Telangana">Telangana</option>
                                                                        <option value="Tripura">Tripura</option>
                                                                        <option value="Uttaranchal">Uttaranchal</option>
                                                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                        <option value="West Bengal">West Bengal</option>
                                                                        <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                                                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                                        <option value="Chandigarh">Chandigarh</option>
                                                                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                                        <option value="Daman and Diu">Daman and Diu</option>
                                                                        <option value="Delhi">Delhi</option>
                                                                        <option value="Lakshadeep">Lakshadeep</option>
                                                                        <option value="Pondicherry">Pondicherry</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputZip">District</label>
                <select class="form-control" id="inputDistrict" name="inputDistrict">
                    <option value="-- select one --">-- select one -- </option>
                </select>
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit" id="submit">Add</button>
    </form>





    <script>
        function ovalidate()
        {
            var fname=document.getElementById('fname').value;
            var lname=document.getElementById('lname').value;
            var email=document.getElementById('email').value;
            var pno=document.getElementById('pno').value;
            var oname=document.getElementById('oname').value;
            var city=document.getElementById('city').value;
            var inputState=document.getElementById('inputState').value;
            var inputDistrict=document.getElementById('inputDistrict').value;
            var username=document.getElementById('username').value;
            var password=document.getElementById('password').value;


            if(fname=="")
            {
                document.getElementById('fname').placeholder="** please fill the field";
                document.getElementById('fname').style.border="1px solid red";
                document.getElementById('fname').focus();
                return false;
            }
            if(lname=="")
            {
                document.getElementById('lname').placeholder="** please fill the field";
                document.getElementById('lname').style.border="1px solid red";
                document.getElementById('lname').focus();
                return false;
            }
            if(email=="")
            {
                document.getElementById('email').placeholder="** please fill the field";
                document.getElementById('email').style.border="1px solid red";
                document.getElementById('email').focus();
                return false;
            }
            if(pno=="")
            {
                document.getElementById('pno').placeholder="** please fill the field";
                document.getElementById('pno').style.border="1px solid red";
                document.getElementById('pno').focus();
                return false;
            }
            if(isNaN(pno))
                    {
                      alert('please enter a numeric value');
                      document.getElementById('pno').style.border="1px solid red";
                      document.getElementById('pno').focus();
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
            if(inputState=="SelectState")
            {
                alert('Please select an item');
                document.getElementById('inputState').style.border="1px solid red";
                document.getElementById('inputState').focus();
                document.getElementById('inputDistrict').style.border="1px solid red";
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