<?php 
  include_once '../config/config.php';
//   include_once '../lib/database.php';
//   $db = new Database;
?>
<?php 
// function select($query){
//     $select_row = $this->pdo->prepare($query);
//     $select_row->execute();
//     if($select_row->rowCount() > 0){ 
//     // Alt count -> count($select_row);
//          return $select_row->fetchAll(PDO::FETCH_ASSOC);
//     }
// }
    $receiver = $_GET['receive'];
    $sender   = $_GET['send'];
    $sql = "SELECT *FROM tbl_message LEFT JOIN tbl_login ON tbl_login.username = tbl_message.outgoing_msg_id 
    WHERE incoming_msg_id='$receiver' AND outgoing_msg_id='$sender' || outgoing_msg_id='$receiver' AND 
    incoming_msg_id='$sender' ORDER BY msg_id ASC";
    $res = $conn->query($sql);
    if($res){
    foreach($res as $msg){ 
    if($receiver == $msg['username']){
    ?>
    <div class="item-group-you d-flex">
        <!-- <img src="<?php echo $msg['img']; ?>"> -->
        <div class="text-message-you">
        <?php echo $msg['text_message']; ?>
        </div>
        <p class="time-track-you">
        <?php echo $msg['curr_date'] . $msg['curr_time'] ; ?>
        </p>
    </div>
    <?php }else{ ?>

    <div class="item-group-other d-flex">
        <!-- <img src="<?php echo $msg['img']; ?>"> -->
        <div class="text-message-other">
        <?php echo $msg['text_message']; ?>
        </div>
        <p class="time-track-other">
        <?php echo $msg['curr_date'] . $msg['curr_time'] ; ?>
        </p>
    </div> 

    <?php } ?>
    <?php } } ?>