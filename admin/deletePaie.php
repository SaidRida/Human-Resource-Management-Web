<?php
include("../include/db.php");
		

	if ($_REQUEST['delete']) {
		$pid = $_REQUEST['delete'];
		
		$stmt = mysql_query("UPDATE paie SET deleted=1 WHERE ID_paie=$pid");
		
		if ($stmt) {
			echo "Demande Annulée ..."; 
            
		}
	}
		 

?>