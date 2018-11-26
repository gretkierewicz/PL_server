<?php

	include dirname(__FILE__) . '/config.php';

	$con = mysqli_connect(HOST, USER, PASSWORD);
	//check that connection to server happened
	if(mysqli_connect_errno())
	{
		die("1\tConnection to server failed!");
	}
	$db = mysqli_select_db($con, DATABASE);
	//check that connection to database happened
	if(!$db)
	{
		die("2\tConnection to database failed!");
	}

?>