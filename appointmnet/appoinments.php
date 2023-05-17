<?php 
include("head.php");
$user=$_SESSION['username'];
$sql=mysqli_query($conn,"SELECT * FROM `tbl_appoint` where requested_user='$user'");
if(isset($_POST['appoint']))
{
    // echo"hi";
    $id=$_POST['apnt_id'];
    $trr=mysqli_query($conn,"DELETE FROM `tbl_appoint` WHERE id='$id'");
    if($trr){
        echo"<script>
            window.location='appoinments.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>appointment status</title>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
  <!-- <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> -->
</svg>
    <style>
        .table{
            width:80%;
            margin-left:10%;
            margin-top:10%;
            border-collapse:separate;
            border:solid black 1px;
            border-radius:6px;
        }
        .btn1
        {
            background-color: lightblue;
            border-radius: 800px;
            /* height:20%; */
            width:30px;
            border:none;
        }
    </style>
</head>
<body>
    <?php $count=mysqli_num_rows($sql);
    if($count>0)
    {?>
        <table class="table table-success table-striped text-center">
            <thead>
                <tr>
                <th scope="col">sl no</th>
                <th scope="col">officer name</th>
                <th scope="col">appointment date</th>
                <th scope="col">accepted/rejected on</th>
                <th scope="col">reply <button class="btn1" onclick="text()">i</button></th>
                <th scope="col">status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sl=1;
                while($row=mysqli_fetch_array($sql))
                {?>
                    <tr>
                    <th scope="row"><?php echo $sl ?></th>
                    <td><?php echo $row['officer_name'] ?></td>
                    <td><?php echo $row['requested_date'] ?></td>
                    <td><?php echo $row['accepted_on'] ?></td>
                    <?php
                    if($row['status']=='approved')
                    {?>
                        <td><?php echo $row['time1'] ."-".$row['time2']?></td>
                    <?php
                    }
                    else{?>
                        <td><?php echo $row['reason'] ?></td>

                    <?php }
                    ?>
                    <td>
                        <?php if($row['status']=='pending')
                        { ?>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                <?php echo $row['status'] ?>
                                <button type="submit" class="btn-close btn-danger" name="appoint" ></button>
                                <input type="hidden" name="apnt_id" value="<?php echo $row['id'] ?>">
                            </form>
                            <?php
                        }
                        else{
                            echo $row['status'];
                        }?>
                    </td>
                    </tr>
                    <?php $sl++;
                }?>
            </tbody>
        </table><?php
    }
    else
    {?>
        <div class="text-center"><label for="">no appoinments :(</label></div><?php
    }?>
    
    <script>
        function text()
        {
            alert("if the reply section shows a time period it means your request has been approved else means it's rejected by the officer");

        }
    </script>
</body>
</html>