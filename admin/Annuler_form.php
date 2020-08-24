<?php
include("../include/db.php");
		

	if ($_REQUEST['delete']) {
		$pid = $_REQUEST['delete'];
		$fonct = $_REQUEST['fonct'];
		// select formation
		$select = mysql_query("select * from formation where form_id=$pid");
		$data = mysql_fetch_array($select);
		// send notification
	    $content = 'Votre demande de formation '.$data['description'].' est refusee';
		mysql_query("insert into notification values('', $fonct, 'fonct', 'formation', '$content', DEFAULT, 0)");
		// delete demande
		$stmt = mysql_query("DELETE FROM demande_formation WHERE form_id=$pid and fonct_id=$fonct");
		
		if ($stmt) {
			echo "Demande Annulée ..."; 
            
		}
	}
		 

?>