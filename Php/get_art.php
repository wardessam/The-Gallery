<?php
require '../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->TheGallery;
$collection = $db->Arts;

if(isset($_POST['selected'])){
 $selected = $_POST['selected'];
 $obj = $collection->findOne(array(
    '_id' => new MongoDB\BSON\ObjectId($selected)
));
 
echo json_encode($obj);
}
else{
    echo 0;
}

   

    

?>