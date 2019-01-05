<?php
	header('Content-Type: application/json');
	$objConnect = mysqli_connect("localhost","root","","location");
	mysqli_query($objConnect, "set names utf8");
	
	$strSQL = "SELECT * FROM location  ";

	$objQuery = mysqli_query($objConnect,$strSQL);
	$resultArray = array();
	while($obResult = mysqli_fetch_assoc($objQuery))
	{
		array_push($resultArray,$obResult);
	}
	
	mysqli_close($objConnect);
	
	echo json_encode($resultArray);
?>