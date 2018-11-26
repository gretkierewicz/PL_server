<?php

	include dirname(__FILE__) . '/includes/connect.php';

	$username = mysqli_real_escape_string($con, $_POST[login]);
	$password = mysqli_real_escape_string($con, $_POST[password]);

	//check if name exists
	$nameCheck = mysqli_query($con, "SELECT username FROM players WHERE username ='" . $username . "';") or die("3\tLogin check fail!");
	if(mysqli_num_rows($nameCheck) > 0)
	{
		die("4\tThat login is already taken!");	
	}

	//add user to the table
	$hash = password_hash($password, PASSWORD_DEFAULT);
	mysqli_query($con, "INSERT INTO players (username, hash) VALUES ('".$username."', '" . $hash . "');") or die("5\tRegistering player failed!");

	echo "0"; //success!
	mysqli_close($con);

?>