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
            <h2>Add an Art</h2>
        </div>
        <form id="form" action="edit_art.php" method="POST">
        
        <div class="dropdown">
                <select class="mui-dropdown" id="productId">
                   <option selected="true" disabled="disabled">Select Art Name</option>
                                <?php
                                 foreach ( $returnAll as $id => $value )
                                {
                                   echo "<option value=".$value['_id'].">". $value['Name']."</option>";
                                 }
                                ?>
                                </select>
        </div>
            <div class="mui-textfield mui-textfield">
                <input type="file" id="img" name="img" accept="image/*" onchange="loadFile()" >
                <label>Art Image</label>
                <img id="outputimg" width="200" height='200'style=" border: 3px solid #fff;"/>
            </div>
                
            <div class="mui-textfield">
                <input type="text" id="name" name="name" required>
                    <label for="name">Art name</label>
                   
           </div>
        
            <div class="mui-textfield">
            <input type="text" id="price" name="price" required>
                    <label for="price">Art price</label>
            </div>

            <div class="mui-textfield">
                <input type="text" id="stock_amount" name="stock_amount" required>
                <label for="stock_amount">Art stock amount</label>
            </div>  

            <div class="mui-textfield">
                    <input type="text" id="artist" name="artist" required>
                    <label for="reference">Art Artist</label>
            </div>
               
            <div class="mui-textfield">
            <input type="text" id="discount" name="discount" required>
            <label for="discount">Art Discount</label>    
            </div>

            <div class="mui-textfield">
            <textarea id="description" name="description" rows="4" cols="20" required></textarea>
            
            </div>
            <button style="width: 100%; margin-top:20px; margin-bottom: 20px;" id="Login" class="mui-btn mui-btn--raised mui-btn--accent" type="submit" name="Login">
                Edit Art
        </button>
        
        </form>
    </div>
</div>
<div id="footerLoad"></div>  

<script type="text/javascript" >
    $(function(){
       $("#footerLoad").load("../Components/footer.html");
      });
 $(function(){
       $("#navLoad").load("../Components/navbar.html");
}); 
   
function loadFile() {
var imgpath = $('#img').val();
var path = imgpath.replace("C:\\fakepath\\", "");
$('#outputimg').attr("src",'../Images/'+path);
};

        $("#productId").change(function(){
            var selected = $('#productId').val();
            $.ajax({
            method:"POST",
             url: "get_art.php",
             type: 'POST',
             data:{
                 selected:selected
             },
             dataType:"json",
            success:function(data) {
               if(data){
                $('#outputimg').attr("src",'../Images/'+data["ImgUrl"]);
                $('#name').val(data["Name"]);
                $('#price').val(data["Price"]);
                $('#stock_amount').val(data["Stock Amount"]);
                $('#artist').val(data["Artist"]);
                $('#description').val(data["Description"]);
                $('#discount').val(data["Discount"]);
               }
               else{
              alert("No Data")
               
               }
            }
       })        
        
        })
 
 //
 $("#form").submit(function(e){
     e.preventDefault();
    // alert($("#discount").val());
    var path =$("#outputimg").attr('src');
        if(path.includes('imgs/')){
            path= path.substring(5,path.length);
        }
    $.ajax({
        method: 'POST',
        type: "POST",
        url: "edit_art.php",
        dataType:'json',
        data:{
            ID:$('#productId').val(),
            Img:path,
            ProductName: $("#name").val(),
            Price: $("#price").val(),
            Stock: $("#stock_amount").val(),
            Artist: $("#artist").val(),
            Description: $("#description").val(),
            Discount: $("#discount").val()
            },
            
        success: function(response){
            if (response == 1){
                alert("Product Edited Successfully");
                window.location="/the-gallery/Php/home.php";
                
            }
            else if (response == 0){
                alert("Can't Edit Art");
            }
        } 
        
    
    
    })
        
});

    </script>
   
</body>

</html>