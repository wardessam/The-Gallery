<?php
require '../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->TheGallery;
$collection = $db->StoreArts;
$returnAll = $collection->find();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
      <!-- load MUI -->
      <link href="//cdn.muicss.com/mui-0.10.3/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.10.3/js/mui.min.js"></script>
</head>

<body>
<div id="navLoad">
</div>
        <div class="mui-container">
                    <form class="mui-form" action="/Php/search_art.php" id="form" method="post" >

                    <div class="mui-textfield mui-textfield--float-label">
                                <input type="text" id="product_name" name="product_name" placeholder=" ">
                                <label for="product_name">Product name</label>
                    </div>     

           
                    <button id="Login" class="mui-btn mui-btn--raised mui-btn--accent" type="submit" name="Login">
                           Search
                        </button>
                             
                    </form>
               
                <table id="arts">
                    <tr>
                        <th>Art Image</th>
                        <th>Art Name</th>
                        <th>Art Price</th>
                        <th>Art Amount Stock</th>
                        <th>Art Artist</th>
                        <th>Art Rating</th>
                        <th>Art Discount</th>
                        <th>Art Description</th>
                    </tr>
                   
                    <?php
                    error_reporting(0);
                        foreach ( $returnAll as $id => $value )
                        {
                        echo "<tr>";
                        echo "<td><img src='imgs/". $value['ImgUrl']."' width='100' height='100'></img></td>";
                         echo "<td>". $value['Name']."</td>";
                         echo "<td>". $value['Price']."</td>";
                         echo "<td>". $value['StockAmount']."</td>";
                         echo "<td>". $value['Artist']."</td>";
                         echo "<td>". $value['Rating']."</td>";
                         echo "<td>". $value['Discount']."</td>";
                         echo "<td>". $value['Description']."</td>";
                         echo "</tr>";
                        }
                    ?>
                    
                    </table>
                   
             
                    
                    
              
        </div>
       <div id="footerLoad"></div>


<script>
     $(function(){
       $("#footerLoad").load("Components/footer.html");
      });
     $(function(){
       $("#navLoad").load("Components/navbar.html");
      }); 
   
    $("#form").submit(function(e){
     e.preventDefault();
    $.ajax({
        method: 'POST',
        type: "POST",
        url: "Php/search_art.php",
         data:{
            ProductName: $("#art_name").val()
            },
        dataType:'json',
        success: function(data){
            if (data){
                $('td').remove();
               $("#arts").append("<tr><td><img src='imgs/" 
               + data['ImgUrl'] + "' width='100' height='100'></img></td><td>"
               + data['Name'] + '</td><td>' 
               + data['Price'] + '</td><td>' 
               + data['StockAmount'] +'</td><td>' 
               + data['Artist'] + '</td><td>'
               +data['Rating']+'</td><td>'
               +data['Discount']+'</td><td>'
               +data['Description']+'</td>'
               +'</tr>');
             
                
            }
            else{
               alert("Can't Find Data");
            }
        } 
        
    
    
    })
        
});

</script>
    
</body>

</html>