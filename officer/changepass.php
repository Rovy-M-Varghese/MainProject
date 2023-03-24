<?php
session_start();
 include("../config.php");
  $username=$_SESSION["username"];  
  $sql="SELECT * FROM tbl_login where username='$username'";
  $result=mysqli_query($conn,$sql);
  $display=mysqli_fetch_array($result);
  if(isset($_POST["submit"]))
{
    $curentpwd=$display['password'];
    $newpassword=$_POST['newpassword'];
    $confirmpassword=$_POST['confirmpassword'];
    $psswd=$_POST['currentpassword'];
    // echo($curentpwd);
    if($curentpwd==$psswd)
    {
        if($newpassword==$confirmpassword)
        {
                $sql1=mysqli_query($conn,"UPDATE tbl_officer SET password='$newpassword' where username='$username'");
                $sql2=mysqli_query($conn,"UPDATE tbl_login SET password='$newpassword' where username='$username'");
                // echo($sql);
                if($sql1)
                {
                // echo ;
                echo '<script type="text/javascript">alert("Congratulations You have successfully changed your password")</script>';
                // header("Location:../Login.php");

                }
                else
                {
                
                echo '<script type="text/javascript">alert("failed")</script>';

                }
        }
    }
    else
    {
        echo '<script type="text/javascript">alert("current password is not correct")</script>';
    }
        
//    echo($newpassword);
//    echo($confirmpassword);
//   $capassword=$_POST['pd'];
//   $cc=md5($capassword);
//     $curentpwd;
//   if($curentpwd==$cc)
//   {
//       $ccpassword=$_POST['npd'];
//       $ccpass=md5($ccpassword);
//       $sql=mysqli_query($conn,"UPDATE tbl_register SET password='$ccpass' WHERE username='$username'");
//       if($sql)
//       {
//           echo "<script>alert('Password Updated Succesfully!!Plase login again!!');window.location='../login/login.php'</script>";
//       }
//   }
//   else
//     echo "<script>alert('Please enter current password correctlty!!');window.location='changepasssw.php'</script>";
}
?>
<!DOCTYPE html>
<head>
  <title>change password</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
  <script>
      $(document).ready(function(){
      $('.pass_show').append('<span class="ptxt">Show</span>');  
      });
      

      $(document).on('click','.pass_show .ptxt', function(){ 

      $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

      $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

      });
  </script>
  <style>
      .pass_show{position: relative} 

      .pass_show .ptxt { 

      position: absolute; 

      top: 50%; 

      right: 10px; 

      z-index: 1; 

      color: #f36c01; 

      margin-top: 2px; 

      cursor: pointer; 

      transition: .3s ease all; 

      } 
      .pass_show .ptxt:hover{color: #333333;}
      form{
        width:50%;
        margin:0 auto;
        
      }
  </style>
</head>
<body><br><br>
<div>
  <a class="btn btn-info" href="index.php" style="margin-left:10px;">Back to Home</a>                                        
</div>
<form  method="POST" onsubmit="return changepass()">
  <div class="mb-3 pass_show">
    <label class="form-label">Current Password</label>
    <input type="password" class="form-control" placeholder="Current Password"  name="currentpassword" id="currentpassword"> 
  </div>
  <div class="mb-3 pass_show">
    <label class="form-label">New Password</label>
    <input type="password"  class="form-control" placeholder="New Password" name="newpassword" id="newpassword"> 
  </div>
  <div class="mb-3 pass_show">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" id="confirmpassword"> 
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Update</button>
</form> 
<script>
    function changepass()
    {
        var currentpassword=document.getElementById('currentpassword').value;
        var password=document.getElementById('newpassword').value;
        var cpassword=document.getElementById('confirmpassword').value;
        var passw = /^[a-zA-Z0-9!@#$%^&*]{8,15}$/;
        if(password!= "" && cpassword!= "")
        {
            if(cpassword != password)
                {
                  alert("Password are not Same");
                  return false;
                }
              if(!passw.test(password) || !passw.test(cpassword))
              {
                alert("password must contain these \nA Uppercase letter \nA lowercase letter \nA numeric \nA special characater \n must contain 8 to 15 characters");
                return false;
              }
              
        }
        else
        {
            if(currentpassword == "")
                            {
                              document.getElementById('currentpassword').placeholder="** please fill the field";
                              document.getElementById('currentpassword').style.border="1px solid red";
                              document.getElementById('currentpassword').focus();
                              return false;
                                
                            }
            if(password == "")
                            {
                              document.getElementById('newpassword').placeholder="** please fill the field";
                              document.getElementById('newpassword').style.border="1px solid red";
                              document.getElementById('newpassword').focus();
                              return false;
                                
                            }
                    if(cpassword == "")
                            {
                              document.getElementById('confirmpassword').placeholder="** please fill the field";
                              document.getElementById('confirmpassword').style.border="1px solid red";
                              document.getElementById('confirmpassword').focus();
                              return false;                                                           
                            }
        }
    }
</script>
  </body>
</html>
