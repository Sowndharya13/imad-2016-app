<?php
    mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
   
    mysql_select_db("gopharm") or die(mysql_error());
    /* tutorial_search is the name of database we've created */
     
     
     
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
    $query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM products
            WHERE (`name` LIKE '%".$query."%') ") or die(mysql_error());
             
       
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results))
			{
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h3>".$results['name']."</h3>".$results['price']."</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            ?>
            <div class="col-md-3">
            <form method="post" action="shopsound.php?action=add&id=<?php echo $results["medid"]; ?>">
            <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding:10px;" align="center">
            <img src="<?php echo $results["image"]; ?>" class="img-responsive">
            <h5 class="text-info"><?php echo $results["name"]; ?></h5>
            <h5 class="text-danger">$ <?php echo $results["price"]; ?></h5>
            <input type="text" name="quantity" class="form-control" value="1">
            <input type="hidden" name="hidden_name" value="<?php echo $results["name"]; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $results["price"]; ?>">
            <input type="submit" name="add" style="margin-top:5px;" class="btn btn-default" value="Add to Bag">
            </div>
            </form>
            </div>
        <?php
			
			}
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
      }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
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
    if(isset($_POST["add"]))
{
 if(isset($_SESSION["cart"]))
 {
 $item_array_id = array_column($_SESSION["cart"], "product_id");
 if(!in_array($_GET["id"], $item_array_id))
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
 echo '<script>alert("Products are added to cart")</script>';
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
    </table>
    </div>
    </div>
 
</body>
</html>