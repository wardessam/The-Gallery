<?php
require  '../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->TheGallery;
$collection = $db->Arts;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$path=$_POST['Img'];
$name = $_POST['ProductName'];
$price = $_POST['Price'];
$stock = $_POST['Stock'];
$artist = $_POST['Artist'];
$description = $_POST['Description'];
$discount = $_POST['Discount'];

$dataArray = [ 
    "ImgUrl"=>$path,
    "Name" => $name, 
    "Price" => $price,
    "Stock Amount" => $stock, 
    "Artist" => $artist, 
    "Description" => $description, 
    "Discount" => $discount
 ];
 

$insertResult = $collection->insertOne($dataArray);
if($insertResult->getInsertedCount()){
    echo 1;
    
}
else {
    echo 0;
}

}


else {
    echo 'Error Adding Art';
}
?>