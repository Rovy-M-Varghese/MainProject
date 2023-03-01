<?php
include("../config.php");
 $user=$_GET['username'];
 $rate_value=$_GET['rate_value'];
$product_id=$_GET['product_id'];
 $comment=$_GET['comment'];
$dt     = new DateTime('now', new DateTimezone(''));
$date   = $dt->format('F j, Y');
$tm     = new DateTime('now', new DateTimezone(''));
$time   = $tm->format('g:i a');

echo $sql="INSERT INTO `item_rating`(`itemId`, `userId`, `ratingNumber`, `comments`, `curr_date`, `curr_time`) 
VALUES ('$product_id','$user','$rate_value','$comment','$date','$time')";
$result = mysqli_query($conn, $sql);
if($result){
    echo '<script>alert("Success")</script>';
    // echo$_SESSION['product_id']=$product_id;
    header("location:review.php?product_id=".$product_id."");
}
else
{
    echo '<script>alert("fail")</script>';
    // header("location:index.php");
}

?>