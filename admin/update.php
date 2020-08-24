<?php
	

	$DBhost = "localhost";
	$DBuser = "root";
	$DBpass = "";
	$DBname = "grh";

	
		
		$DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
		$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		

	if ($_REQUEST['update']) {
		$name = $_REQUEST['name'];
		$pid   = $_REQUEST['update'];
		$query ="update  stlocation set stdev_location_name='$name' WHERE stdev_id=:pid";
		$stmt  = $DBcon->prepare( $query );
		$stmt  ->execute(array(':pid'=>$pid));
		
		if ($stmt) {
			echo "Departement Modifié ..."; 
            
		}
	}
		 

?>