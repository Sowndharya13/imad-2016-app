
<?php include 'database.php'; ?>
<?php

// create a variable
$name=$_POST['name'];
$email=$_POST['email'];
$phone_no=$_POST['phone_no'];
$user_id=$_POST['user_id'];
$password=$_POST['password'];

//Execute the query
$sql = <<<SQL
    SELECT *
    FROM `users`
SQL;
if(!$result = $conn->query($sql)){
    die('There was an error running the query [' . $conn->error . ']');
}
// echo 'Total rows updated: ' . $conn->affected_rows;
// echo 'Total results: ' . $result->num_rows;
$sql = "INSERT INTO users(name, email, phoneno, userid, password)
VALUES ('".$name."', '".$email."' ,'". $phone_no ."',  '".$user_id."','".$password."')";

if ($conn->query($sql) === TRUE) {
    echo "<center> <p>
	You are registered successfully... <br></p></center>";
	echo "
	<center><b>Welcome... " .$name ."</b><br>";
	echo "
	<a href='index2.php'>Go to shop</a>";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
?> 