<?php
require '../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->TheGallery;
$collection = $db->Orders;
$returnAll = $collection->find();

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>The Gallery </title>
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
    <div class="mui-container ">
        <div class="mui-container mui--text-center">
            <h2>Delete Order</h2>
        </div>
                    <form id="form" action="delete_order.php" method="post">

                    <div class="mui-textfield mui-textfield--float-label">
                                <input type="text" id="order_id" name="order_id" placeholder=" ">
                                <label for="order-id">Order ID</label>
                    </div>

                    <button style="margin-top:20px; margin-bottom: 20px;" id="Login" class="mui-btn mui-btn--raised mui-btn--accent" type="submit" name="Login">
                         Delete Order
                    </button>
                    </form>
            <div class="mui-container mui--text-center" id="output">
            </div>
                <table id="orders" class="mui-table mui-table--bordered">
                    <tr>
                       
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>Customer Email</th>
                        <th>Order Purchase Date</th>
                        <th>Order Total Price</th>
                        <th>Order Discount</th>
                        
                    </tr>
                   
                    <?php
                        foreach ( $returnAll as $id => $value )
                        {
                        echo "<tr id=".$value['OrderID'].">";
                         echo "<td>". $value['OrderID']."</td>";
                         echo "<td>". $value['Status']."</td>";
                         echo "<td>". $value['CustomerInfo']['Email']."</td>";
                         echo "<td>". $value['PurchaseDate']."</td>";
                         echo "<td>". $value['TotalPrice']."</td>";
                         echo "<td>". $value['Discount']."</td>";
                         echo "</tr>";
                        }
                    ?>
                    
                    </table>
                    
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
        url: "delete_order.php",
         data:{
            order: $("#order_id").val()
            },
        dataType:'json',
        success: function(response){
            if (response==1){
                var id=$("#order_id").val();
                $('#'+id+'').remove();
                $('#output').val("Order Deleted")
            }
            else if(response==0){
                $('#output').val("Can't Delete Order")
            }
        } 
        
    
    
    })
        
});

</script>


</body>

</html>