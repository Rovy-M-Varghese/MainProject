<div class="sidebar-wrapper mb-4">
    <?php
    session_start();
    $user = $_SESSION['user'];
    ?>
      <div class="card">
       <div class="card-header">
       <div class="message-to d-flex">
          <?php 

             $sql = "SELECT *FROM tbl_login WHERE username='$user'";
             $res = mysqli_query($conn,$sql);
             if($res){
             foreach($res as $user){ ?>
             <img src="<?php echo $user['img']; ?>"> 
             <i class="fa fa-circle"></i>
             <h6><?php echo $user['username']; ?></h6>
             <p>
                <?php
                 if($user['status'] == "Active"){
                     echo "Active Now";
                 }else{
                     echo "Offline";
                 } 
                ?> 
             </p>
          <?php } } ?>
       </div>
       <!-- <a href="?action=logout"><i class="fa fa-sign-out"></i> Logout</a> -->
       <div class="dropdown">
        <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
         <i class="fa fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
            <li><a class="dropdown-item" href="#">Change Password</a></li>
            <li><a class="dropdown-item" href="?action=logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
        </ul>
        </div>

       </div>
       <div class="card-body">
       <div class="user-list-box">
            <ul>
              <?php
              $user = $_SESSION['user'];
               $query  = "SELECT * FROM tbl_login WHERE username != '$user' and type='realtor'";
               $result =mysqli_query($conn, $query);
               if($result){
               foreach($result as $list){ ?>
                <li>
                    <a href="chat.php?sender=<?php echo $user; ?>&receiver=<?php echo $list['username']; ?>" class="d-flex align-items-center">
                        <img src="<?php echo $list['img']; ?>">
                        <?php 
                         if($list['status'] == "Active"){
                            echo "<i class='fa fa-circle'></i>";
                         }else{
                             echo "<i class='fa fa-circle offline'></i>";
                         }
                        ?>
                        <h6><?php echo $list['username']; ?></h6>
                    </a>
                </li>
                <?php } } ?>
                
                

                
            </ul>   
            
        </div>
       </div>
                        </div>
    </div>