<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "gopharm");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
 <title> Online Shopping Cart </title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<div class="container" style="width:60%;">
 <h2 align="center">Shopping Cart</h2>
  
  <form action="search(copy)sound.php" method="GET">
    <input type="text" name="query" />
    <input type="submit" value="Search" />
</form>
	
	<br><br>
	
	<?php
    $query = "SELECT * FROM products ORDER BY medid ASC";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
 while($row = mysqli_fetch_array($result))
 {
 ?>
            <div class="col-md-3">
            <form method="post" action="shopsound.php?action=add&id=<?php echo $row["medid"]; ?>">
            <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding:10px;" align="center">
            <img src="<?php echo $row["image"]; ?>" class="img-responsive">
            <h5 class="text-info"><?php echo $row["name"]; ?></h5>
            <h5 class="text-danger">$ <?php echo $row["price"]; ?></h5>
            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
            </div>
            </form>
            </div>
        <?php
 }
 }
 ?>
 <div style="clear:both"></div>
    <h2>My Shopping Bag</h2>
    <div class="table-responsive">
    <table class="table table-bordered">
    <tr>
    <th width="40%">Product Name</th>
    <th width="10%">Quantity</th>
    <th width="20%">Price Details</th>
    <th width="15%">Order Total</th>
    <th width="5%">Action</th>
    </tr>
    <?php
 if(!empty($_SESSION["cart"]))
 {
 $total = 0;
 foreach($_SESSION["cart"] as $keys => $values)
 {
 ?>
            <tr>
            <td><?php echo $values["item_name"]; ?></td>
            <td><?php echo $values["item_quantity"] ?></td>
            <td>$ <?php echo $values["product_price"]; ?></td>
            <td>$ <?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?></td>
            <td><a href="shop.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">X</span></a></td>
            </tr>
            <?php 
 $total = $total + ($values["item_quantity"] * $values["product_price"]);
 }
 ?>
        <tr>
        <td colspan="3" align="right">Total</td>
        <td align="right">$ <?php echo number_format($total, 2); ?></td>
        <td></td>
        </tr>
        <?php
 }
 ?>

    </table>
    </div>
    </div>
    
 <center>  <button type="button" onclick="alert('Your order is placed...')">Place Order</button></center>
  <br><br>
 <center>  <a href="ggpp1.html"><button>Back to Home</button></a></center> 

 </body>
</html>