<?php
include("../include/db.php");

$dem_id = $_GET['id'];

mysql_query("delete from vacation_log where v_id = $dem_id");

setcookie('op', 'success',  time() + (60), '/');

header("location: conges.php");
?>