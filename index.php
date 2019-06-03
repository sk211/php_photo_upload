<?php

$msg = "";
// if upload button is pressed

if (isset($_POST['submit'])) {

    // the path to store the upload image
    $target = "images/".basename($_FILES['image']['name']);

    //connect to the database

    $db = mysqli_connect("localhost", "root", "", "photo_upload");

    $image = $_FILES['image']['name'];
    $text = $_POST['textarea'];

    $sql = "INSERT INTO images(image, text) VALUE('$image', '$text')";

    mysqli_query($db, $sql);

    // now lets move the upload the file image into the folder


    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {

          $msg = "Image uploaed successfully";
      
    }
    else{
        $msg = "There was a problem uploading images";
    }
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="style.css">
<title>php image file upload</title>
</head>
<body>





<div class="container">
<form method="post" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="size" value="10000">

 <div class="form-group card col-md-4 offset-4 mt-5">
     <label for="image">Image</label>
     <input id="image" class="form-control-file" type="file" name="image" required>
     
     <div class="form-group">
         <label for="my-textarea">Text</label>
         <textarea id="my-textarea" class="form-control" name="textarea" rows="3" required></textarea>
     </div>
     <input type="submit" value="Upload" name="submit" class="btn btn-primary">
 </div>    
</div>
    
</form>
<br>


<?php
// db connecton
    $db = mysqli_connect("localhost", "root", "", "photo_upload");
    $sql = "SELECT * FROM images ORDER BY id DESC ";
    $result =mysqli_query($db , $sql);
    while ($row =mysqli_fetch_array($result)): ?> 
    <div class="container">
    <div class="row">
        <div class="col-md-6 ">
        
            <img class="img-thumbnail" width="450" height="100" src="images/<?php echo $row['image']; ?>" >
         </div>
        <div class="col-md-6">
            <P><?php echo $row['text'] ; ?></P>
        </div>
        </div>
        </div>
    <?php 

   endwhile;

?>






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>