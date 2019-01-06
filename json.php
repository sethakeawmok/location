<?php
	header('Content-Type: application/json');
	//$objConnect = mysqli_connect("localhost","root","","location");
	$objConnect = mysqli_connect("localhost","root","","klungadmin_wp");
	mysqli_query($objConnect, "set names utf8");
	
	$state = 'chonburi';
	$city = 'si-racha';

	$strSQL = "SELECT * FROM ( 
					SELECT t1.ID,t1.post_title,t1.post_status,t2.meta_key,t2.meta_value
						,(SELECT main_terms.slug FROM main_term_relationships
							INNER JOIN main_term_taxonomy on main_term_relationships.term_taxonomy_id = main_term_taxonomy.term_taxonomy_id
							INNER JOIN main_terms on main_term_taxonomy.term_id = main_terms.term_id
							WHERE  main_term_taxonomy.taxonomy = 'property_state' and main_term_relationships.object_id = t1.ID) as state
						,(SELECT main_terms.slug FROM main_term_relationships
							INNER JOIN main_term_taxonomy on main_term_relationships.term_taxonomy_id = main_term_taxonomy.term_taxonomy_id 
							INNER JOIN main_terms on main_term_taxonomy.term_id = main_terms.term_id 
							WHERE main_term_taxonomy.taxonomy = 'property_city' and main_term_relationships.object_id = t1.ID ) as city		
					FROM main_posts t1
					INNER JOIN main_postmeta t2 ON t1.ID = t2.post_id
					WHERE t1.post_type = 'property' and t1.post_status = 'publish'  AND t2.meta_key = 'fave_property_location' 
		   		) o1 WHERE state = '$state' AND city = '$city'";


	$objQuery = mysqli_query($objConnect,$strSQL);
	$resultArray = array();
	while($obResult = mysqli_fetch_assoc($objQuery))
	{
		array_push($resultArray,$obResult);
	}
	
	mysqli_close($objConnect);
	
	echo json_encode($resultArray);

?>