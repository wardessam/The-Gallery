<?php
require '../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->TheGallery;
$collection = $db->Arts;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$path=$_POST['Img']; 
$id=$_POST['ID'];
$stock = $_POST['Stock'];
$name = $_POST['ProductName'];
$artist = $_POST['Artist'];
$description = $_POST['Description'];
$price = $_POST['Price'];
$discount = $_POST['Discount'];

$dataArray = [
    '_id' => new MongoDB\BSON\ObjectId($id),
    "ImgUrl"=>$path,
    "Name" => $name, 
    "Price" => $price,
    "StockAmount" => $stock,
    "Artist" => $artist,
    "Description" => $description, 
    "Discount" => $discount, 
   
 ];
$res = $collection->UpdateOne(
    [ '_id' => new MongoDB\BSON\ObjectId($id)],
    ['$set' => [  
        "ImgUrl"=>$path,
        "Name" => $name, 
        "Price" => $price,
        "StockAmount" => $stock,
        "Artist" => $artist,
        "Description" => $description, 
        "Discount" => $discount, 
     
        ]
    ]
        
);

if($res){
   echo 1;
    
}
else {
    echo 0;
}

}


else {
    echo 'Error Cant Editing Art';
}

