1<?php include ('../config.php');
session_start();
echo $id=$_GET['id'];
$sql = "select * FROM tbl_products where id='$id'";
$result = mysqli_query($conn, $sql);
$sq = "SELECT * from item_rating where itemId ='$id' ";
$resul = $conn->query($sq);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View products</title>
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="css/theme.css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
            #products {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            height:100px;
            }

            #products td, #products th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
            }

            /* #products tr:nth-child(even){background-color: #f2f2f2;} */

            #products tr:hover {background-color: #ddd;}

            #products th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
            }
            div.scrollit 
            {
                overflow-y:scroll; height:200px; overflow-x: hidden;
            }
            div.img
            {
                width:100px;
                /* aspect-ratio: 1/2; */
                object-fit:contain;
                mix-blent-mode:color-burn;
                /* height:200px; */

            }
    </style>
</head>
<body>
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="#">
                <img src="images/icon/admin logo1.png" alt="admin"/>
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="active has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="addproduct.php">Add Products</a>
                            </li>                               
                        </ul>
                    </li>
                    <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fa fa-address-book "></i>Officers</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="addofficer.php"><i class="fa fa-edit"></i>Add Officer</a>
                                    </li>
                                    <li>
                                        <a href="credentials.php"><i class="fa fa-envelope"></i>Send credentials</a>
                                    </li>
                                </ul>
                            </li>                       
                </ul>
            </nav>
        </div>
    </aside>
    <div class="page-container">            
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                        <form class="form-header" action="" method="POST">
                            <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for products...." />
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form> &nbsp;&nbsp;
                        <div class="header-button">
                            <div class="noti-wrap">
                                <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <!-- <span class="quantity"><?php echo"$rowcount2";?></span> -->
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__footer">
                                                <a href="notifications.php">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity">1</span>
                                        <div class="email-dropdown js-dropdown">
                                            
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div> -->
                                <!-- <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity"><?php echo"$rowcount2";?></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__footer">
                                                <a href="notifications.php">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <?php
                                                
                                                if(isset($_SESSION['username']))
                                                {
                                                    echo '<h2 class="js-acc-btn"><b>'.$_SESSION['username'].'</b></h6>';
                                                    
                                                }
                                            ?>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">Admin</a>
                                                    </h5>
                                                    <span class="email">Admin@gmail.com</span>
                                                </div>
                                            </div>                                       
                                            <div class="account-dropdown__footer">
                                                <a href="../Logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header><br><br><br>
<?php
if ($resul->num_rows > 0) {
    $texts = array();
    while ($row = $resul->fetch_assoc()) {
        $texts[] = $row["comments"];
    }
    $url = 'http://127.0.0.1:5000/sentiment';
    $data = json_encode(array('texts' => $texts));
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => $data,
        ),
    );
    $context  = stream_context_create($options);
    $resul = file_get_contents($url, false, $context);
    $resul = json_decode($resul, true);

    $positive =$resul['positive'];
    $negative = $resul['negative'];
    $neutral = $resul['neutral'];
    $total = $positive + $negative + $neutral;
  
    $pos= ($positive / $total) * 100;
    $neg = ($negative / $total) * 100;
    $neu= ($neutral / $total) * 100;
    $pos_percent = round($pos, 2); 
    $neg_percent = round($neg, 2); 
    $neu_percent = round($neu, 2); 
    $pos_accuracy = ($pos_percent >( $neu_percent+$neg_percent)) ? $pos_percent : (100 -( $neu_percent+$neg_percent));
      $neg_accuracy = ($neg_percent > ($neu_percent+$pos_percent)) ? $neg_percent : (100 - ($neu_percent+$pos_percent));
    $neutral_accuracy = ($neu_percent > ($pos_percent + $neg_percent)) ? $neu_percent : (100 - ($pos_percent + $neg_percent));
  
   } else {
    echo "No comments.";
    $pos_percent = 0;
    $neg_percent = 0;
    $neu_percent=0;
    $neu_percent = 0;
    $pos_accuracy = 0;
    $neg_accuracy = 0;
    $neu_accuracy = 0;
    $neutral_accuracy=0;
  }
  ?>
    <div class="container-fluid">        
        <!-- <h1>Sentiment Analysis </h1> -->
        <div class="chart-container" style="margin-left:10%; width: 50%;height: 50%;">
            <canvas id="sentiment-chart"></canvas>
        </div>
        <div>
            <table class="table text-center">
                <thead>
                    <tr>
                    <th scope="col">Positive</th>
                    <th scope="col">Negative</th>
                    <th scope="col">Neutral</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                    <td style="background-color:#90EE90;"><input type="text" value="<?php echo $pos_accuracy;?>%" style="background-color:lightgreen;" readonly></td>
                    <td style="background-color:#ffcccb;"><input type="text" value="<?php echo $neg_accuracy; ?>%" style="background-color: #ffcccb;" readonly></td>
                    <td style="background-color:#add8e6;"><input type="text" value="<?php echo $neutral_accuracy; ?>%" style="background-color:#add8e6;" readonly></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  
      <script>
          var ctx = document.getElementById('sentiment-chart').getContext('2d');
          var chart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: ['Positive<?php echo ""."(".$positive."/".$total.")".""?>', 'Negative<?php echo ""."(".$negative."/".$total.")".""?>', 'Neutral<?php echo ""."(".$neutral."/".$total.")".""?>'],
                  datasets: [{
                      label: ' Product Sentiment Analysis percentage',
                      data: [<?php echo $pos_percent; ?>, <?php echo $neg_percent; ?>, <?php echo $neu_percent; ?>],
                      backgroundColor: [
                          '#90EE90',
                          '#ffcccb',
                          '#add8e6'
                      ],
                      borderColor: [
                          '#90EE90',
                          '#ffcccb',
                          '#add8e6'
                      ],
                      borderWidth: 3,
                    
                  }]
              },
              
              options: {
                  scales: {
                      y: {
                          beginAtZero: true,
                          ticks: {
                              stepSize: 5,
                              max: 100
                          }
                      }
                  }
              }
          });
      </script>


<br>




                <div class="section__content section__content--p30">
                    <div class="container">
                        <table id="products">
                            <tr>
                                <th>id</th>
                                <th>image</th>
                                <th>name</th>
                                <th>comments</th>
                                <!-- <th>price</th>
                                <th>GST</th>
                                <th>Total price</th>
                                <th>Weight type</th> -->
                                <!-- <th colspan="2">Action</th> -->
                                <!-- <th>view comments</th> -->
                            </tr>
                            <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $e="SELECT * FROM `item_rating` where itemId='$id'";
                                    $ee=mysqli_query($conn,$e);
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td>
                                        <div class="img">
                                            <img src="<?php echo "upload_image/".$row['image']; ?>"alt="image">
                                        </div>
                                    </td>
                                    <td><?php echo $row['pname']; ?></td>
                                    <td>
                                        <div class="scrollit">
                                            <!-- Some content with a scrollbar if it's too big for the cell -->
                                            <?php
                                            while ($rows = mysqli_fetch_assoc($ee)) 
                                            {?>
                                            <li><?php
                                                echo $rows['comments']; ?>
                                            </li><?php
                                            }?>
                                        </div>
                                    </td>
                                    <!-- <td style="text-align: left;">
                                        <?php
                                            while ($rows = mysqli_fetch_assoc($ee)) 
                                            {?>
                                            <li><?php
                                                echo $rows['comments']; ?>
                                            </li><?php
                                            }?>
                                        
                                    </td> -->
                                    <!-- <td><?php echo $row['pprice']; ?></td>
                                    <td><?php echo $row['gst']; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                    <td><?php echo $row['tweight']; ?></td> -->
                                    <!-- <td> <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-info">EDIT</td>                                    
                                    <td> <a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">DELETE</td> -->
                                    <!-- <td> <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Comments</a></td> -->
                                </tr>
                                <?php
                                }
                                ?>
                        </table>
                    </div>         
                </div><br><br>
    </div>
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
