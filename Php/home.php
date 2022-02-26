<?php
require '../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->TheGallery;
$collection = $db->Arts;
$returnAll = $collection->find();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery</title>
    <link href="../styles.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
      <!-- load MUI -->
      <link href="//cdn.muicss.com/mui-0.10.3/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.10.3/js/mui.min.js"></script>
</head>

<body>
<div class="container">
<div id="navLoad">
</div>
        <div class="mui-container">
        <div class="mui-container mui--text-center">
            <h2>Search an Art</h2>
        </div>
                    <form class="mui-form" action="../Php/search_art.php" id="form" method="post" >

                    <div class="mui-textfield mui-textfield--float-label">
                                <input type="text" id="name" name="name" >
                                <label for="name">Art Name</label>
                    </div>     

           
                    <button  class="mui-btn mui-btn--raised mui-btn--accent" type="submit">
                           Search
                        </button>
                             
                    </form>
               
                <table id="arts" class="mui-table mui-table--bordered">
                <thead>
                    <tr>
                        <th>Art Image</th>
                        <th>Art Name</th>
                        <th>Art Price</th>
                        <th>Art Stock Amount</th>
                        <th>Art Artist</th>
                        <th>Art Discount</th>
                        <th>Art Description</th>
                    </tr>
              </thead>
              <tbody>
                    <?php
                    error_reporting(0);
                        foreach ( $returnAll as $id => $value )
                        {
                        echo "<tr>";
                        echo "<td><img src='../Images/". $value['ImgUrl']."' width='100' height='100'></img></td>";
                         echo "<td>". $value['Name']."</td>";
                         echo "<td>". $value['Price']."</td>";
                         echo "<td>". $value['Stock Amount']."</td>";
                         echo "<td>". $value['Artist']."</td>";
                         echo "<td>". $value['Discount']."</td>";
                         echo "<td>". $value['Description']."</td>";
                         echo "</tr>";
                        }
                    ?>
                   </tbody> 
                    </table>
                   
             
                    
                    
              
        </div>
        </div>
       <div id="footerLoad"></div>


<script>
     $(function(){
       $("#footerLoad").load("../Components/footer.html");
      });
     $(function(){
       $("#navLoad").load("../Components/navbar.html");
      }); 
   
    $("#form").submit(function(e){
     e.preventDefault();
    $.ajax({
        method: 'POST',
        type: "POST",
        url: "../Php/search_art.php",
         data:{
            Name: $("#name").val()
            },
        dataType:'json',
        success: function(data){
            if (data){
                $('td').remove();
               $("#arts").append("<tr><td><img src='../Images/" 
               + data['ImgUrl'] + "' width='100' height='100'></img></td><td>"
               + data['Name'] + '</td><td>' 
               + data['Price'] + '</td><td>' 
               + data['Stock Amount'] +'</td><td>' 
               + data['Artist'] + '</td><td>'
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