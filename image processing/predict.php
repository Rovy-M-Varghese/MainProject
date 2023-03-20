<?php 
include("header.php");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = new CURLFile($image_path, mime_content_type($image_path), basename($image_path));
    $post_fields = array('image' => $file);
    $ch = curl_init('http://localhost:5000/predict');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    echo $response;
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prediction</title>
</head>
<body>
    <div class="col-md-8 col-lg-4 col-xl-4 offset-xl-4">
        <form method="POST" enctype="multipart/form-data" >
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3"><h1>Upload the photo</h1></label>
            </div>
            <div class="form-outline mb-3">
                <input type="file" accept="image/*" name="image">
            </div>
            <div>
                <input type="hidden" id="demo" name="demo" />
            </div>
            <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" id="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>