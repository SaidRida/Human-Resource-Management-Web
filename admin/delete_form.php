<?php
	
	$DBhost = "localhost";
	$DBuser = "root";
	$DBpass = "";
	$DBname = "grh";
	
	
		
		$DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
		$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		

	if ($_REQUEST['delete']) {
		
		$pid = $_REQUEST['delete'];
		$query = "DELETE FROM formation WHERE form_id=:pid";
		$stmt = $DBcon->prepare( $query );
		$stmt->execute(array(':pid'=>$pid));
		
		if ($stmt) {
			echo "Formation Supprimée ..."; 
            
		}
	}
		 

?>