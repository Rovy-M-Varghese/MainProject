<?php 
 include_once '../config/config.php';
//  include_once '../lib/database.php';
//  $db = new Database;

 $dt     = new DateTime('now', new DateTimezone('Asia/Dhaka'));
 $date   = $dt->format('F j, Y');
 $tm     = new DateTime('now', new DateTimezone('Asia/Dhaka'));
 $time   = $tm->format('g:i a');

 $msg      = str_replace("'", "", $_POST['message']);
 $receiver = $_POST['receive']; //incoming msg id
 $sender   = $_POST['send']; //outgoing msg id

 $sql = "INSERT INTO tbl_message(incoming_msg_id, outgoing_msg_id, text_message, curr_date, curr_time)
 VALUES('$receiver', '$sender', '$msg', '$date ','$time')";
   $result = $conn->query($sql);
   // $res = $db->insert($sql);
   if($result){
   //echo "Message Sent!";
  }else{
  echo "Message sending failed!";
 }
?>