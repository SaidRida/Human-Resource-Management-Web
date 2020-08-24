<?php
include("../include/db.php");
include("auth.php");

$selectedFonct = $_SESSION['messenger_id'];
if(isset($_POST['submit'])){
	$msg = $_POST['msg'];

	mysql_query("insert into message values ('', $id, $selectedFonct, 'admin', 'fonct', 0, 0, '$msg', DEFAULT, 0)");
}

if(isset($_POST['send'])){
	$selectedFonct = $_POST['fonct'];
	$msg = $_POST['message'];

	mysql_query("insert into message values ('', $id, $selectedFonct, 'admin', 'fonct', 0, 0, '$msg', DEFAULT, 0)");
}



header("location: chat.php?id=$selectedFonct#location");

?>