<?php
include("../include/db.php");
include("auth.php");

$selectedAdmin = $_SESSION['messenger_id'];
if(isset($_POST['submit'])){
	$msg = $_POST['msg'];

	mysql_query("insert into message values ('', $selectedAdmin, $id, 'fonct', 'admin', 0, 0, '$msg', DEFAULT, 0)");
}

if(isset($_POST['send'])){
	$selectedAdmin = $_POST['admin'];
	$msg = $_POST['message'];

	mysql_query("insert into message values ('', $selectedAdmin, $id, 'fonct', 'admin', 0, 0, '$msg', DEFAULT, 0)");
}



header("location: chat.php?id=$selectedAdmin#location");

?>