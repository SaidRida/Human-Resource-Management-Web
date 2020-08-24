<?php 
include('../include/header.php');
include("../include/db.php");
include("auth.php");

$payslip_id = $_GET['id'];
$test = mysql_query("SELECT * FROM paie WHERE ID_paie=$payslip_id");
$data = mysql_fetch_array($test);

$employe_id = $data['fonct_id'];
$extract = mysql_query("SELECT * FROM fonctionnaire WHERE fonct_id=$employe_id");
$donnees = mysql_fetch_array($extract);

$ext = mysql_query("select * from location_details ,stlocation,fonctionnaire where location_details.stdev_id=stlocation.stdev_id and fonctionnaire.fonct_id=location_details.fonct_id and fonctionnaire.fonct_id=$employe_id");
$don = mysql_fetch_array($ext);

$sql = mysql_query("SELECT * FROM deduction WHERE fonct_id=$employe_id AND ID_paie=$payslip_id");
$ded = mysql_fetch_array($sql);

?>
<!DOCTYPE html>
<html lang="en">

    <body class="text-center" style="margin: 20px;" onload="print()">
        <img src="../images/swag.jpg" align="middle" style="margin-bottom: 30px;">
        <?php
        echo '<div class="container"';
        
        echo '<h4 >Pour le Mois de  '.$data['mois'].' '.$data['annee'].'</h4>';
        echo '<hr size=2 color=gray>';
        echo '<br>';
        
        
        echo '<table class="table" style="width: 40%; margin-left: 30%;">';
        echo '<tr><th>Fonctionnaire: </th><td>'.$donnees['firstname'].' '.$donnees['lastname'].'</td></tr>';
        echo '<tr><th>Designation: </th><td>'.$donnees['designation'].'</td></tr>';
        echo '<tr><th>Departement: </th><td>'.$don['stdev_location_name'].'</td></tr>';
        echo '<tr><th>Bureau: </th><td>'.$donnees['bureau'].'</td></tr>';
        echo '<tr><th>Telephone: </th><td>'.$donnees['telephone'].'</td></tr>';
        echo '<tr><th>Grade: </th><td>'.$donnees['grade'].'</td></tr>';
        echo '<tr><th>Salaire de Base: </th><td>'.$data['basic_salary'].'</td></tr>';
        echo '<tr><th>Total indemnite: </th><td>'.$data['indemnite'].'</td></tr>';
        echo '<tr><th>Type de Conge: </th><td>'.$ded['TYPE_LEAVES'].'</td></tr>';
        echo '<tr><th>No. Jour d\'abscence avec permission: </th><td>'.$data['nbr_conge'].'</td></tr>';
        echo '<tr><th>No. Jour d\'abscence sans permission: </th><td>'.$data['nbr_sans_per'].'</td></tr>';
        echo '<tr><th>Deduction: </th><td>'.$data['deduction'].'</td></tr>';
        echo '<tr><th>Genere Le: </th><td>'.$data['date'].'</td></tr>';
        echo '</table>';
        echo '<hr size=4 color=darkgray>';
        echo '<h3>Salaire Net : &nbsp;&nbsp;&nbsp;'.$data['net_salary'].' DH</h3>';
        
        
        echo '</div>';
        ?>
    </body>
</html>