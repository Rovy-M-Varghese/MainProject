<?php 
include("header.php");
$user=$_SESSION['username'];
if(isset($_POST['approve']))
{
    // echo"dthdrth";
    $time=$_POST['selected-time'];
    $id=$_POST['id'];
    $dt     = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $date   = $dt->format('j-m-Y');
    $sqll=mysqli_query($conn,"UPDATE `tbl_appoint` SET `accepted_on` = '$date', `time`='$time' , `status` = 'approved' WHERE `tbl_appoint`.`id` = '$id'");
}
if(isset($_POST['reject']))
{
    // echo"sfgedfg";
    $id=$_POST['id'];
    $dt     = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $date   = $dt->format('j-m-Y');
    $sqll=mysqli_query($conn,"UPDATE `tbl_appoint` SET `accepted_on` = '$date', `status` = 'rejected' WHERE `tbl_appoint`.`id` = '$id'");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>appoinments</title>
        <style>
            .table{
                width:80%;
                margin-left:10%;
                margin-top:10%;
                border-collapse:separate;
                border:solid black 2px;
                border-radius:6px;
            }
        </style>
    </head>
    <body>
        <?php
            $sql=mysqli_query($conn,"SELECT * FROM `tbl_appoint` where officer_name='$user' and status='pending'");
            $count=mysqli_num_rows($sql);
            if($count>0)
            { ?>
 
                <table class=" table table-warning text-center">
                    <thead>
                        <tr>
                        <th scope="col">sl no</th>
                        <th scope="col">requested user</th>
                        <th scope="col">location</th>
                        <th scope="col">date</th>
                        <th scope="col">time</th>
                        <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sl=1;
                        while($row=mysqli_fetch_assoc($sql))
                        {?>
                            <tr>
                                <th scope="row"><?php echo $sl ?></th>
                                <td><?php echo $row['requested_user'] ?></td>
                                <td><?php echo $row['location'] ?></td>
                                <td><?php echo $row['requested_date'] ?></td>
                                <form method="post" name="form">
                                    <td>
                                        <label for="time-input">Select a time between 10 AM and 4 PM:</label>
                                        <input type="time" id="time-input" name="time-input" min="10:00" max="16:00" style="border:none;">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success" onclick="approveTime(event)" name="approve">✓</button>
                                        <button type="submit" class="btn btn-danger" name="reject" onclick="blah()">x</button>
                                        <input type="hidden" id="selected-time" name="selected-time" value="">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    </td>
                                </form>
                            </tr><?php $sl++;
                        }
                        ?>
                    </tbody>
                </table><?php 
            }
            else
            {?>
                <div class="text-center">
                    <h1>No new appoinments</h1>
                </div><?php 
            } 
        ?> 
        <hr><br><br>
            <div class="text-center">previous appoinmnets ⬇</div>
            <?php
                $sqll=mysqli_query($conn,"SELECT * FROM `tbl_appoint` where officer_name='$user' and status='approved'");
                $cc=mysqli_num_rows($sqll);
                if($cc>0)
                {?>
                    <!-- <label for="reject"></label> -->
                    <table class=" table table-primary text-center">
                        <caption>accepted appoinments</caption>
                        <thead>
                            <tr>
                            <th scope="col">sl no</th>
                            <th scope="col">requested user</th>
                            <th scope="col">location</th>
                            <th scope="col">date</th>
                            <th scope="col">time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sl=1;
                            while($row=mysqli_fetch_assoc($sqll))
                            {?>
                                <tr>
                                    <th scope="row"><?php echo $sl ?></th>
                                    <td><?php echo $row['requested_user'] ?></td>
                                    <td><?php echo $row['location'] ?></td>
                                    <td><?php echo $row['requested_date'] ?></td>
                                    <td><?php echo $row['time'] ?></td>
                                    
                                </tr><?php $sl++;
                            }
                            ?>
                        </tbody>
                    </table><?php 
                }
            ?>
                <?php
                $sqll=mysqli_query($conn,"SELECT * FROM `tbl_appoint` where officer_name='$user' and status='rejected'");
                $cc=mysqli_num_rows($sqll);
                if($cc>0)
                {?>
                    <!-- <label for="reject">rejected appoinments</label> -->
                    <table class=" table table-danger text-center">
                    <caption>rejected appoinments</caption>
                        <thead>
                            <tr>
                            <th scope="col">sl no</th>
                            <th scope="col">requested user</th>
                            <th scope="col">location</th>
                            <th scope="col">date</th>
                            <!-- <th scope="col">time</th> -->
                            <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sl=1;
                                while($row=mysqli_fetch_assoc($sqll))
                                {?>
                                    <tr>
                                        <th scope="row"><?php echo $sl ?></th>
                                        <td><?php echo $row['requested_user'] ?></td>
                                        <td><?php echo $row['location'] ?></td>
                                        <td><?php echo $row['requested_date'] ?></td>
                                        <!-- <td><?php echo $row['time'] ?></td> -->
                                        <td><?php echo $row['status'] ?></td>
                                        
                                    </tr><?php $sl++;
                                }?>
                        </tbody>
                    </table><?php 
                }?>
                <br><br>
        <script>
            function approveTime(event) {
                const timeInput = document.querySelector('#time-input');
                const selectedTime = new Date(`2000-01-01T${timeInput.value}`);
                const startTime = new Date(`2000-01-01T10:00:00`);
                const endTime = new Date(`2000-01-01T16:00:00`);
                // alert(timeInput.value);
                // if(selectedTime =='Invalid Date')
                if(timeInput.value =='')
                {
                    event.preventDefault();
                    alert('Please select a time');
                    timeInput.style.border = "2px solid red"; 
                    // return false;
                }
                else if (selectedTime < startTime || selectedTime > endTime) 
                {
                    event.preventDefault();
                    alert('Please select a time between 10 AM and 4 PM.');
                    timeInput.style.border = "2px solid red"; 

                } else {
                    const selectedTimeInput = document.querySelector('#selected-time');
                    const formattedTime = selectedTime.toLocaleTimeString('en-US', {hour: 'numeric', minute: 'numeric', hour12: true});
                    selectedTimeInput.value = formattedTime;
                    // alert(selectedTimeInput.value);


                }
            }
            function blah()
            {
                // alert("hi");
            }
        </script>
    </body>
</html>