<?php

	include dirname(__FILE__) . '/includes/connect.php';

	$username = mysqli_real_escape_string($con, $_POST[login]);
	$password = mysqli_real_escape_string($con, $_POST[password]);

	//
	$playerData = mysqli_query($con, "SELECT username, hash FROM players WHERE username ='" . $username . "';") or die("5\tRetrieving player data failed!");
	if(mysqli_num_rows($playerData) != 1)
	{
		die("6\tNo user with that name!");
	}

	$dbHash = mysqli_fetch_assoc($playerData)["hash"];

	if(!password_verify($password, $dbHash))
	{
		die("7\tInvalid password!");
	}

	//check if password is hashed with new algorithm or new cost
	if(password_needs_rehash($dbHash, PASSWORD_DEFAULT)) // , $options = [ 'cost' => 12 ]))
	{
		$newHash = password_hash($password, PASSWORD_DEFAULT); // , $options );
		mysqli_query($con, "UPDATE players SET hash ='" . $newHash . "' WHERE username ='" . $username . "';") or die("8\tRehashing password failed");
	}

	echo "0\tLOGINKEY";
	mysqli_close($con);

?>