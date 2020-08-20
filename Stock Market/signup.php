<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$servername = "localhost";
$user_name = "root";
$pass_word = "root";
$db = 'stockmarket';
$port = 8888;

// Create connection
$conn = mysqli_connect($servername, $user_name, $pass_word, $db, $port);

// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}

if($conn)
{
	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
	$query = "SELECT * FROM userdata WHERE username='$email'";
	$query_run = mysqli_query($conn,$query);
	if (mysqli_num_rows($query_run)>0) 
	{
    	alert("e-mail is registered already. Please sign-in to continue");
    	header( 'refresh:0.5 ; URl= signin.html' ) ;
	}
	else
	{
   		$sql = "INSERT INTO userdata (username,password,firstname,lastname,type) VALUES ('$email', SHA1('$password'), '$firstname', '$lastname', 'user');";
		if (mysqli_query($conn, $sql))
		{
			//alert("Successfully registered sign-in to continue");
			header( 'refresh:0.5 ; URl= signin.html' ) ;
		}
		else
		{
 			header( 'refresh:0.5 ; URl= signup.html' ) ;
 			//alert("Registration: unsuccessful");
		}
	}
}
mysqli_close(conn);
?>