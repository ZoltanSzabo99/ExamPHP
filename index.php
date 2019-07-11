<?php 
session_start();
include_once('uploadphoto.php');
include_once('database.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="listofhouse.php">List of houses</a> <br>

<form action="" method="POST" id="housing" enctype="multipart/form-data">
        <label for="title">Title</label><br>
        <input type="text" name="title" placeholder="tile" maxlength="30"><br>
        <label for="address">Address</label><br>
        <input type="text" name="address" placeholder="address" maxlength="50"><br>
        <label for="city">City</label><br>
        <input type="text" name="city" placeholder="city" maxlength="30"><br>
        <label for="pc">Postcode</label><br>
        <input type="text" name="pc" placeholder="postcode" maxlength="8"><br>
        <label for="area">Area</label><br>
        <input type="text" name="area" placeholder="area" maxlength="8"><br>
        <label for="price">Price</label><br>
        <input type="text" name="price" placeholder="price" maxlength="12"><br>
        <label for="type">Type</label><br>
        House<input type="radio" name="type" value="House" checked="checked" >
        Flat<input type="radio" name="type" value="Flat"><br>
        <label for="description">Description</label><br>
        <input type="text" name="description" placeholder="description" maxlength="50"><br>            
        <label for="photoToUp">Upload photo</label><br>
        <input type="hidden" name="photoToUp">
        <input type="file" name="photoToUp" id="photoToUp"><br> 
        <input type="submit" name="addHouse" value="Add House">
</form>
<!--
<form action="" method="POST" id="housing" enctype="multipart/form-data">
        <label for="photoToUp">Upload photo</label><br>
        <input type="file" name="photoToUp" id="photoToUp"><br> 
        <input type="submit" name="addPhoto" value="Add Poto">
</form>
-->
 
</body>
</html>
<?php


$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn,$db_name);




//
if (isset($_POST['addHouse'])){
    $title = $_POST['title'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postcode = $_POST['pc'];
    $area = $_POST['area'];
    $price = $_POST['price']; 
    $type = $_POST['type']; 
    $description = $_POST['description'];     
    $countedPostcode = strlen($postcode);

    var_dump($_POST);

    //echo($photoName );

    if($title == ''){echo('emty title'.'<br>');}else      
    if($address ==''){echo('empty address'.'<br>');}else
    if($city ==''){echo('empty city'.'<br>');}else
    if($postcode =='' or $countedPostcode < 4 ){echo('postcode should contain 4 characters at least'.'<br>');}else
    if($area =='' or !is_numeric($area)){echo('empty area or not number'.'<br>');} else 
    if($type ==''){echo('empty type'.'<br>');}else
    if($price =='' or !is_numeric($price) ){echo('empty price or not number'.'<br>');}    
    else{echo('Database part'.'<br>');
        
        
        $queryAddHouse = 
        "INSERT INTO`housing` (`id_housing`, `title`, `address`, `city`, `pc`, `area`, `price`, `photo`, `type`, `description`)
        VALUES              (NULL,'$title', '$address', '$city', '$postcode', ' $area', '$price',NULL, '$type', '$description')";



        if($db_found){
            //var_dump($queryAddHouse);
            mysqli_query($conn,$queryAddHouse);
            echo('Data inserted to DB'.'<br>'); 
        }
        else{
            echo("$db_name NOT found".'<br>');
        }  
    }
}


?>
