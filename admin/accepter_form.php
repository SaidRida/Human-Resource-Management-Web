<?php
include("../include/db.php");
include("auth.php");

$form_id=$_GET['form_id'];
$fonct_id=$_GET['fonct_id'];


if($id){
    $select = mysql_query("select * from formation where form_id=$form_id");
    $data = mysql_fetch_array($select);
    $content = 'Votre demande de formation '.$data['description'].' est acceptee';
    mysql_query("insert into notification values('', $fonct_id, 'fonct', 'formation', '$content', DEFAULT, 0)");
    //echo "update formation set fonct_id=$fonct_id where form_id='$form_id'";
	mysql_query("update formation set fonct_id=$fonct_id where form_id='$form_id'") ;
	mysql_query("delete from demande_formation where form_id='$form_id' and fonct_id=$fonct_id") ;
	setcookie('op', 'success',  time() + (60), '/');
}
else{
	setcookie('op', 'failed',  time() + (60), '/');
}

header("location: demandeformation.php");
?>
