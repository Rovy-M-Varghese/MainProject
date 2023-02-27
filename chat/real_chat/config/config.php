<?php
$servername = "localhost"; 
$username = "root"; 
$password = "";
$database = "fa";
$conn=mysqli_connect($servername,$username,$password,$database);
if($conn == TRUE)
{
// echo("sucessfull");
// echo '<script> alert("Database connected Successfully")</script>';
// echo '<script type="text/javascript">';
// echo ' <script>alert("Connected to the Database Sucessfully")</script>'; 
// echo '</script>';
}
else
{
    echo '<script type="text/javascript">';
    echo ' alert("Connected to the Database Failed")';
    echo '</script>';
}
?>
	 