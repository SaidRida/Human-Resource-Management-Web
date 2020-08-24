<?php
include("../include/db.php");
include("auth.php");

$dem_id = $_GET['id'];

mysql_query("delete from demande_formation where form_id = $dem_id and fonct_id = $id");

setcookie('op', 'annuler',  time() + (60), '/');

header("location: dispformations.php");
?>