<?php
//Include libraries
require '../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = new MongoDB\Client;

if($mongoClient){
//Select a database
$db = $mongoClient->TheGallery;

//Select a collection 
$collection = $db->EmployeesData;



if (isset($_POST['email']) && isset($_POST['password'])) {
$email = $_POST ["email"];
$password = $_POST ["password"];
$query = array("Name" => $email, "Password" => $password);
$result = $collection->findOne($query);


if(!empty($result)){
   echo 1; 
    }
else {
    echo 0;
    }
}
}


else{
    echo  "Database Connection Error";
}
?>

