<?php include ('../config.php');
include("header.php");
$name=$_SESSION['username'];
$sql="select * FROM tbl_officer where username='$name'";
$result1 = mysqli_query($conn, $sql);

if(isset($_POST['submit']))
{
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
    $email=$_POST['email'];
	$phonenumber=$_POST['phone'];

    $select="UPDATE tbl_officer SET firstname='$firstname',lastname='$lastname',email='$email',pno='$phonenumber' WHERE username='$name'";
    // echo($select);
	$result= mysqli_query($conn,$select);
  
  if ($result) {
    echo "<script>alert('Record updated successfully')
    window.location='profile.php'</script>";
    } 
    else 
    {
    echo "Error updating record: " . $conn->error;
    }

  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Page</title>
    <link href="../realtor/css/main.css" rel="stylesheet" media="all">

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">
    <script class="u-script" type="text/javascript" src="../form.js"  defer=""></script>


    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <style>
      .form
      {
        width:60%;
        margin: 0 auto;
        margin-top: 5%;
        margin-bottom: 10%;
        /* border-style: solid;
         border-color: coral; */
      }
      #btn1
      {
        /* background-color: white; 
         color: black; 
        border: 2px solid #008CBA; */
        margin-left:10px;
        }
        a:visited {
            text-decoration: none;
            }
            a:link {
            text-decoration: none;
            }
            
    </style>
</head>
<body> 
    <div class="form">
        <?php
        while($row1 = mysqli_fetch_assoc($result1)) 
        {
            ?>
            <form method="POST" onsubmit="return validation()" action="#">
                <div class="input-group">
                    <label class="label">User name</label>
                    <label class="label" style="color:black;"><b><h4>&nbsp;
                    <?php                                               
                                                if(isset($_SESSION['username']))
                                                {
                                                    echo ($_SESSION['username']);                                                                                     
                                                }
                                            ?></h4></b></label>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name<b style="color:red;">*</b></label>
                                    <input class="input--style-4" type="text" name="firstname" id="firstname" value="<?php echo $row1['firstname']; ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name<b style="color:red;">*</b></label>
                                    <input class="input--style-4" type="text" name="lastname" id="lastname" value="<?php echo $row1['lastname']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email<b style="color:red;">*</b></label>
                                    <input class="input--style-4" type="text" name="email" id="email" value="<?php echo $row1['email']; ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number<b style="color:red;">*</b></label>
                                    <input class="input--style-4" type="text" name="phone" id="phone" value="<?php echo $row1['pno']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">Alloted city<b style="color:red;">*</b></label>
                            <input class="input--style-4" type="text" name="building_name" id="building_name" value="<?php echo $row1['city']; ?>" readonly>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">District<b style="color:red;">*</b></label>
                                    <input class="input--style-4" type="text" name="street_no" id="street_no" value="<?php echo $row1['district']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Sate<b style="color:red;">*</b></label>
                                    <input class="input--style-4" type="text" name="zip_code" id="zip_code" value="<?php echo $row1['state']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" id="submit" name="submit">Submit</button>
                        </div>
                    </form>
                  <?php 
                    }
                  ?>
                  
</div>

    <script type="text/javascript">
    function validation()
    {
		var firstname=document.getElementById('firstname').value;
        var lastname=document.getElementById('lastname').value;
		var email=document.getElementById('email').value;
		var phone=document.getElementById('phone').value;
        var phoneno = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
        var regName = /^[a-zA-Z]+$/;
        var regNamee = /^(([A-Za-z]+[\-\']?)*([A-Za-z]+)?\s)+([A-Za-z]+[\-\']?)*([A-Za-z]+)?$/;
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    if(firstname == "")
                    {
                        document.getElementById('firstname').placeholder="** please fill the field";
                        document.getElementById('firstname').style.border="1px solid red";
                        // document.getElementById('firstname').style.color="red";
                        document.getElementById('firstname').focus();
                        return false;
                    }
                    if(!regName.test(firstname))
                    {
                        alert('Name contain only Alphabets');
                        document.getElementById('firstname').style.color="red";
                        document.getElementById('firstname').focus();
                        return false;
                    }
                    if(lastname == "")
                    {
                        document.getElementById('lastname').placeholder="** please fill the field";
                        document.getElementById('lastname').style.border="1px solid red";
                        document.getElementById('lastname').focus();
                        return false;
                    }
                    if(!regName.test(lastname))
                    {
                        alert('Name contain only Alphabets');
                        document.getElementById('lastname').style.border="1px solid red";
                        document.getElementById('lastname').focus();
                        return false;
                    }
                    if(email == "")
                    {
                      document.getElementById('email').placeholder="** please fill the field";
                      document.getElementById('email').style.border="1px solid red";
                      document.getElementById('email').focus();
                      return false;
                    }
                    if(!email.match(mailformat))
                    {
                      alert("Invalid email address!");
                      document.getElementById('email').style.border="1px solid red";
                      document.getElementById('email').focus();
                      return false;
                    }
                    if(phone == "")
                    {
                        document.getElementById('phone').placeholder="** please fill the field";
                        document.getElementById('phone').style.border="1px solid red";
                        document.getElementById('phone').focus();
                        return false;
                    }
                    else
                    {
                        
                        if(!phoneno.test(phone))
                        {
                            alert('Please enter your phone number in the requested format');
                            document.getElementById('phone').focus();
                            return false;
                        }
                    }                          
      }
</script>
</body>
</html>