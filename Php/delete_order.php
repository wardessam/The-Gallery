<?php
require '../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->TheGallery;
$collection = $db->Orders;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
$name=$_POST['order'];

$res = $collection->deleteOne(['OrderID' => $name]);

if($res){
   echo 1;
    
}
else {
    echo 0;
}

}

?>