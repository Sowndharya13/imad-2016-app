<?php  //Start the Session
session_start();
 require('connection.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['userid']) and isset($_POST['password'])){
//3.1.1 Assigning posted values to variables.
$username = $_POST['userid'];
$password = $_POST['password'];
	echo $username;
	echo $password;
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM `users` WHERE userid='$username' and password='$password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$_SESSION['userid'] = $username;
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
$fmsg = "Invalid Login Credentials.";
echo $fmsg;
echo "<center>Please register and proceed..<br><br><br>"; 
 echo "<b><a href ='/'>.go back to home.</a></b></center>";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['userid'])){ 
$username = $_SESSION['userid'];
echo "<center><font style='consolas' color='black' size='6'>  Hai " . $username . "
";
echo "<br><br> You can search for your medicines by clicking the below link... <br><br><br>
";

echo "
	<a href='/index2sound.php'>Go to shop</a><br>  <br> ";

echo "<a href='/logout.php'>Logout</a></center>";
 }
 //else{echo "<center>Please register and proceed..<br><br><br>";  echo "<b><a href ='ggpp1.html'>.go back to home.</a></b></center>";} 

//3.2 When the user visits the page first time, simple login form will be displayed.
?>
