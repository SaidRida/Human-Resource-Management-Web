<?php
include("../include/db.php");

$dem_id = $_GET['id'];

mysql_query("update vacation_log  set hr_approve='3' where  v_id= $dem_id");

$select = mysql_query("select * from vacation_log where v_id = $dem_id");
$data = mysql_fetch_array($select);
$fonct_id = $data['fonct_id'];
$content = 'Votre demande de conge de '.$data['sdate'].' a '.$data['eddate'].' est refusee';
mysql_query("insert into notification values('', $fonct_id, 'fonct', 'conge', '$content', DEFAULT, 0)");

setcookie('op', 'failed',  time() + (60), '/');

header("location: conges.php");
?>