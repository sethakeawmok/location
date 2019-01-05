<?php
	header('Content-Type: application/json');
	//$objConnect = mysqli_connect("localhost","root","","location");
	$objConnect = mysqli_connect("localhost","root","","klungadmin_wp");
	mysqli_query($objConnect, "set names utf8");
	
	// $strSQL = "SELECT * FROM location  ";

	$strSQL = "SELECT t1.ID,t1.post_title,t3.taxonomy,t4.slug,t12.meta_key,t12.meta_value FROM `main_posts` t1 
	INNER JOIN main_term_relationships t2 on t1.ID = t2.object_id
	INNER JOIN main_term_taxonomy t3 ON t2.term_taxonomy_id = t3.term_taxonomy_id
	INNER JOIN main_terms t4 ON t3.term_id = t4.term_id
	INNER JOIN main_postmeta t12 ON t1.ID = t12.post_id
	WHERE  t1.post_type = 'property' and t1.post_status = 'publish' AND t3.taxonomy = 'property_state' AND t4.slug = 'chonburi' AND t12.meta_key = 'fave_property_location'";


	$objQuery = mysqli_query($objConnect,$strSQL);
	$resultArray = array();
	while($obResult = mysqli_fetch_assoc($objQuery))
	{
		array_push($resultArray,$obResult);
	}
	
	mysqli_close($objConnect);
	
	echo json_encode($resultArray);
?>