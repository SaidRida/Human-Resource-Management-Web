<?php
include("../include/db.php");
include("auth.php");

mysql_query("update notification set seen=1 where person_id=$id and type_person='fonct'");

?>