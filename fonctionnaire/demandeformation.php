<?php
include("../include/db.php");
include("auth.php");

$form_id = $_GET['id'];

$test = mysql_query("select * from demande_formation where form_id=$form_id and fonct_id=$id");
if(!$rows = mysql_num_rows($test)){
	mysql_query("insert into demande_formation values($form_id, $id, DEFAULT)");
	$content = $name.' a demandé une formation';
    mysql_query("insert into notification values('', '', 'admin', 'formation', '$content', DEFAULT, 0)");
	setcookie('op', 'success',  time() + (60), '/');
}else{
	setcookie('op', 'failed',  time() + (60), '/');
}

header("location: dispformations.php");

?>