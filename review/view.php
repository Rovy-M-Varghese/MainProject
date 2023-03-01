<?php 
$ress= mysqli_query($conn,"SELECT AVG(ratingNumber) AS average FROM item_rating where itemId='$id'");
$row = mysqli_fetch_assoc($ress); 
$average =round($row['average'], 2); 
$sql= "select * FROM tbl_products where id='$id'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>product</title>
            <style>
        textarea {
        border: none;
        outline: none;
        }
        div.scrollit 
        {overflow-y:scroll; height:300px; overflow-x: hidden;}
          
    </style>
</head>
<body>
<div class="container mt-4">
        <div class="row">
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-lg-4">
                <form action="manage_cart.php" method="POST">
                    <div class="card">
                        <!-- <img src="images/2.jpg" class="card-img-top" alt="image"> -->
                        <img src="<?php echo "../Admin/upload_image/".$row['image']; ?>" class="card-img-top" alt="image"  height="200px" alt="image">
                        <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $row['pname']; ?></h5>
                                <p class="card-text"><textarea id="desc" rows="4" cols="34"><?php echo $row['description']; ?></textarea></p>
                                <p class="card-text"><b>Price</b>(Incl GST) : <b><?php echo $row['total']; ?> Rs</b></p>
                                
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <?php 
            }
            ?>
            <div class="col-lg-8">
                <div class="card">
                    <div class='scrollit'>
                        
                    <table><tr><td><h1>Reviews</h1></td>&nbsp;<td>
                        
                    
                        <h3 style="background-color: #00cc00;color:white;border-radius:10px;"><?php
                    
                             echo $average;
         
                        ?>
                        </h3></td></tr></table>
                    <?php
                    $sq="SELECT * FROM `item_rating` WHERE itemId='$id'";
                    $resul=mysqli_query($conn, $sq);
                    while ($rows = mysqli_fetch_assoc($resul)) {
                    ?>
                    
                            <b><input class="form-control form-control-lg card-title" type="text" value="<?php echo $rows['userId']; ?>"></b>
                            <input type="hidden" value="<?php echo $rows['comments']; ?>" id="rated">
                            <input class="form-control form-control-lg" type="text" value="<?php echo $rows['comments']; ?>">
                            <input class="form-control form-control-lg" type="text" value="<?php echo $rows['curr_date'] . $rows['curr_time'] ; ?>">
                    <br><?php 
            }
            ?>
</div>
                    
                </div>
            </div>
            <br>
             
        </div>
        <div>

            <div class="container">
    	<h1 class="mt-5 mb-5">Review & Rating </h1>
    	<div class="card">
            <div class="wrapper">
  <div class="master">
    <h1>Review And rating</h1>
    <h2>How was your experience about our product?</h2>
    <form action="review.php" >
        <div class="rating-component">
        <div class="status-msg">
            <label>
                            <input  class="rating_msg" type="hidden" name="rating_msg" value=""/>
                        </label>
        </div>
        <div class="stars-box">
            <i class="star fa fa-star" title="1 star" data-message="Poor" data-value="1"></i>
            <i class="star fa fa-star" title="2 stars" data-message="Too bad" data-value="2"></i>
            <i class="star fa fa-star" title="3 stars" data-message="Average quality" data-value="3"></i>
            <i class="star fa fa-star" title="4 stars" data-message="Nice" data-value="4"></i>
            <i class="star fa fa-star" title="5 stars" data-message="very good qality" data-value="5"></i>
        </div>
        <div class="starrate">
            <label>
                            <input  class="ratevalue" type="hidden" name="rate_value" value=""/>
                        </label>
        </div>
        </div>

        <div class="feedback-tags">
        <div class="tags-container" data-tag-set="1">
            <div class="question-tag">
            Why was your experience so bad?
            </div>
        </div>
        <div class="tags-container" data-tag-set="2">
            <div class="question-tag">
            Why was your experience so bad?
            </div>

        </div>

        <div class="tags-container" data-tag-set="3">
            <div class="question-tag">
            Why was your average rating experience ?
            </div>
        </div>
        <div class="tags-container" data-tag-set="4">
            <div class="question-tag">
            Why was your experience good?
            </div>
        </div>

        <div class="tags-container" data-tag-set="5">
            <div class="make-compliment">
            <div class="compliment-container">
                Give a compliment
                <i class="far fa-smile-wink"></i>
            </div>
            </div>
        </div>
        
        <div class="tags-box">
            <input type="text" class="tag form-control" name="comment" id="inlineFormInputName" placeholder="please enter your review">
            <input type="hidden" name="product_id" value="<?php echo $id ?>" />
            <input type="hidden" name="username" value="<?php echo $user ?>" />
        </div>
        
        </div>

        <div class="button-box">
        <input type="submit" class=" done btn btn-warning" disabled="disabled" value="Add review" />
        <input type="hidden" id="rate" value="" />
        </div>
    </form>

    <div class="submited-box">
      <div class="loader"></div>
      <div class="success-message">
        Thank you!
      </div>
    </div>
  </div>

</div>
<!-- <?php
if( isset($_GET['submit']) )
{
    // echo'<script>alert("1")</script>';
    echo$user=$_GET['username'];
    echo$rate_value=$_GET['rate_value'];
   echo $product_id=$_GET['product_id'];
    echo$comment=$_GET['comment'];
    $dt     = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $date   = $dt->format('F j, Y');
    $tm     = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $time   = $tm->format('g:i a');
    review($product_id,$user,$rate_value,$comment,$date,$time);

    function review($product_id,$user,$rate_value,$comment,$date,$time) 
    {
        echo $sql="INSERT INTO `item_rating`(`itemId`, `userId`, `ratingNumber`, `comments`, `curr_date`, `curr_time`) 
        VALUES ('$product_id','$user','$rate_value','$comment','$date','$time')";
        $result = mysqli_query($conn, $sql);
        if($result){
        echo '<script>alert("Success")</script>';
            // echo$_SESSION['product_id']=$product_id;
            //header("location:index.php");
        }
        else
        {
        echo '<script>alert("fail")</script>';
        // header("location:index.php");
        }
    }
}

    	</div>
        </div>
        </div><br><br>
        <script>
            $(".rating-component .star").on("mouseover", function () {
            var onStar = parseInt($(this).data("value"), 10); //
            // alert(onStar);
            $(this).parent().children("i.star").each(function (e) {
                if (e < onStar) {
                $(this).addClass("hover");
                } else {
                $(this).removeClass("hover");
                }
            });
            }).on("mouseout", function () {
            $(this).parent().children("i.star").each(function (e) {
                $(this).removeClass("hover");
            });
            });

            $(".rating-component .stars-box .star").on("click", function () {
            var onStar = parseInt($(this).data("value"), 10);
            // alert(onStar);
            document.getElementById("rate").value = onStar;
            var stars = $(this).parent().children("i.star");
            var ratingMessage = $(this).data("message");

            var msg = "";
            if (onStar > 1) {
                msg = onStar;
            } else {
                msg = onStar;
            }
            $('.rating-component .starrate .ratevalue').val(msg);
            

            
            $(".fa-smile-wink").show();
            
            $(".button-box .done").show();

            if (onStar === 5) {
                $(".button-box .done").removeAttr("disabled");
            } else {
                $(".button-box .done").attr("disabled", "true");
            }

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass("selected");
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass("selected");
            }

            $(".status-msg .rating_msg").val(ratingMessage);
            $(".status-msg").html(ratingMessage);
            $("[data-tag-set]").hide();
            $("[data-tag-set=" + onStar + "]").show();
            });

            $(".feedback-tags  ").on("click", function () {
            var choosedTagsLength = $(this).parent("div.tags-box").find("input").length;
            choosedTagsLength = choosedTagsLength + 1;

            if ($(this).hasClass("choosed")) {
                $(this).removeClass("choosed");
                choosedTagsLength = choosedTagsLength - 2;
            } else {
                $(this).addClass("choosed");
                $(".button-box .done").removeAttr("disabled");
            }

            console.log(choosedTagsLength);

            if (choosedTagsLength <= 0) {
                $(".button-box .done").attr("enabled", "false");
            }
            });



            $(".compliment-container .fa-smile-wink").on("click", function () {
            $(this).fadeOut("slow", function () {
                $(".list-of-compliment").fadeIn();
            });
            });



            $(".done").on("click", function () {
            $(".rating-component").hide();
            $(".feedback-tags").hide();
            $(".button-box").hide();
            $(".submited-box").show();
            $(".submited-box .loader").show();

            setTimeout(function () {
                $(".submited-box .loader").hide();
                $(".submited-box .success-message").show();
            }, 1500);
            });

        </script>
        <!-- <script>

        </script> -->
    <!-- </div> -->
</body>
</html>