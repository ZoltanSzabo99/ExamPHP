<?php
if(!empty($_POST["price"])){

$target_dir = "photos/";
$target_file = $target_dir . basename($_FILES["photoToUp"]["name"]);
$uploadOk = 1;
$photoName;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

if(isset($_POST["addHouse"])) {
    $check = getimagesize($_FILES["photoToUp"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.".'<br>';
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.".'<br>';
    $uploadOk = 0;
}
// Check file size
if ($_FILES["photoToUp"]["size"] > 5000000) {
    echo "Sorry, your file is too large.".'<br>';
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.".'<br>';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.".'<br>';
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["photoToUp"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["photoToUp"]["name"]). " has been uploaded.".'<br>';
        $photoName = $_FILES["photoToUp"]["name"];
    } else {
        echo "Sorry, there was an error uploading your file.".'<br>';
    }
}

}


?>