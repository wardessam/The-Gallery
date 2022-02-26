<?php

require '../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->TheGallery;
$collection = $db->Arts;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$name=$_POST['Name'];

$res = $collection->findOne(['Name' => $name]);

if($res){
   echo json_encode($res);
    
}
else {
    echo 0;
}

}

?>