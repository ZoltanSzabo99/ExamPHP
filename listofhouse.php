<a href="index.php">Add houses</a> <br>
<?php
include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn,$db_name);

if($db_found){
    $queryHousing = "SELECT * FROM housing;"; 
    $select = mysqli_query($conn,$queryHousing);
    
    while($db_record = mysqli_fetch_assoc($select)){ 
        $titleSelect =  $db_record['title']; 
        $addressSelect = $db_record['address']; 
        $citySelect = $db_record['city'];     
        echo($titleSelect.'<br>');  
        echo($addressSelect.'<br>'); 
        echo($citySelect).'<br>';  
        echo('------------------').'<br>'; ; 
    }   
}
?>