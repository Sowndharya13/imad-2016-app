<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "gopharm");
if(isset($_POST["add"]))
{
 if(isset($_SESSION["cart"]))
 {
 $item_array_id1 = array_column($_SESSION["cart"], "product_id");
 if(!in_array($_GET["id"], $item_array_id1))
 {
 $count = count($_SESSION["cart"]);
 $item_array1 = array(
 'product_id' => $_GET["id"],
 'item_name' => $_POST["hidden_name"],
 'product_price' => $_POST["hidden_price"],
 'item_quantity' => $_POST["quantity"]
 );
 $_SESSION["cart"][$count] = $item_array1;
 echo '<script>window.location="index2sound.php"</script>';
 }
 else
 {
 echo '<script>alert("Products already added to cart")</script>';
 // echo '<script>window.location="index2.php"</script>';
 }
 }
 else
 {
 $item_array1 = array(
 'product_id' => $_GET["id"],
 'item_name' => $_POST["hidden_name"],
 'product_price' => $_POST["hidden_price"],
 'item_quantity' => $_POST["quantity"]
 );
 $_SESSION["cart"][0] = $item_array1;
 }
}
if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
 foreach($_SESSION["cart"] as $keys => $values)
 {
 if($values["product_id"] == $_GET["id"])
 {
 unset($_SESSION["cart"][$keys]);
 echo '<script>alert("Product has been removed")</script>';
 echo '<script>window.location="index2sound.php"</script>';
 }
 }
 }
}
?>