<?php
include("../include/db.php");
include("auth.php");

mysql_query("update notification set seen=1 where link='conge' and person_id=$id and type_person='fonct'");

$cookie = "";
if(isset($_COOKIE['op'])){
    $cookie = $_COOKIE['op'];
    setcookie('op', '', time() - (60*60), "/");
}

$success = 0;
$fail = 0;
if(isset($_POST['submit'])){
    if ($_POST['sdate'] < $_POST['eddate']){
        $type_leave = $_POST['type'];
        $sdate = $_POST['sdate'];
        $eddate = $_POST['eddate'];

        $now = date("Y-m-d",strtotime("now"));

        $duree = ((strtotime($eddate) - strtotime($sdate)) / 86400) + 1;

        mysql_query("INSERT INTO vacation_log(`v_id`,`fonct_id`,`vdate`,`leavetype`,`sdate`,`eddate`,`nodays`,`hr_approve`,`prog_head`,`vp_operation`) values ('',$id,'$now','$type_leave','$sdate','$eddate','$duree','1','1','1')");
        $content = $name.' a demandé un congé';
        mysql_query("insert into notification values('', '', 'admin', 'conge', '$content', DEFAULT, 0)");

        $success = 1;
    }else{
        $fail = 1;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>CONGES | SWAG</title>
    <?php
    include("../include/header.php");
    ?>
    <style type="text/css">
        .nav .dropdown{
            cursor: pointer;
        }
        .nav .dropdown .dropdown-menu li a:hover{
            color: #EEE !important;
        }

        .card input{
            border: 1px solid #DDD;
        }
        .card select{
            border: 1px solid #DDD;
            padding: 5px !important;
        }
    </style>
    

</head>
<body>

<div class="wrapper">
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Demande Congé</h4>
      </div>
      <div class="modal-body">
        <form method="post">
            <div class="form-group">
                <label>Type :</label>
                <select name="type" class="form-control border-input">
                    <option>Maladie</option>
                    <option>Vacance</option>
                    <option>Deplacement</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date Effective :</label>
                <input type="date" name="sdate" class="form-control border-input" required="">
            </div>
            <div class="form-group">
                <label>Date Fin :</label>
                <input type="date" name="eddate" class="form-control border-input" required="">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Demander</button>
            </div>
        </form>
      </div>
    </div>

  </div>
</div>
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard.php" class="simple-text">
                    <img src="../images/logo-swag.jpg" style="width: 100%;">
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li  class="dropdown">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="ti-bag"></i>
                        <p>Mes formations <span class="caret"></span></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="formations.php">Formations</a></li>
                        <li><a href="dispformations.php">Formations Disponibles</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="conges.php">
                        <i class="ti-calendar"></i>
                        <p>Mes Congés</p>
                    </a>
                </li>
                <li>
                    <a href="profil.php">
                        <i class="ti-user"></i>
                        <p>Profil</p>
                    </a>
                </li>
                <li>
                    <a href="payslip.php">
                        <i class="ti-clipboard"></i>
                        <p>Fiche de Paie</p>
                    </a>
                </li>
                <li>
                    <a href="message.php">
                        <i class="ti-email"></i>
                        <?php
                        $cmp_msg = mysql_query("select * from message where fonct_id=$id and receiver='fonct' and del_from_fonct=0 and seen = 0");
                        $nbMsgNotSeen = mysql_num_rows($cmp_msg);
                        if($nbMsgNotSeen){
                            echo '<p>Messages <span class="label label-info">'.$nbMsgNotSeen.' new</span></p>';
                        }else{
                            echo '<p>Messages</p>';
                        }
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Congés</a>
                </div>
                <?php
                include("../include/top-bar.php");
                ?>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="" style="color: #333;">
                        <a href="#" type="button" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-plus"></span> Demander un congé
                        </a>
                        </div><br>
                        <div class="card" style="padding: 20px;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#en_attente">En attente</a></li>
                            <li><a data-toggle="tab" href="#approuver">Approuvé</a></li>
                            <li><a data-toggle="tab" href="#refuser">Refusé</a></li>
                        </ul>
      
                        <div class="tab-content">
                            <div id="en_attente" class="tab-pane fade in active">
                                <h3>Liste des Demandes de Congés en Attentes</h3>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover" id="attente">
                                        <thead>
                                            <tr style="font-size: 12px;">
                                                <th>Nom</th>
                                                <th>Departement</th>
                                                <th>Date Depos</th>
                                                <th>Durée</th>
                                                <th>Type</th>
                                                <th>Etat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query1 = mysql_query("SELECT * FROM fonctionnaire, vacation_log, location_details,stlocation, approve_hr WHERE fonctionnaire.fonct_id = vacation_log.fonct_id and fonctionnaire.fonct_id=location_details.fonct_id and stlocation.stdev_id = location_details.stdev_id AND approve_hr.hr_approve = vacation_log.hr_approve AND vacation_log.hr_approve = '1'  and vacation_log.fonct_id='$id'");
                                        if(mysql_num_rows($query1)){
                                            while ($data = mysql_fetch_array($query1)) {
                                                echo "<tr>";
                                                ?>
                                                <td><?php echo $data['firstname']." ".$data['lastname']; ?></td>
                                                <td><?php echo $data['stdev_location_name']; ?></td>
                                                <td><?php echo $data['vdate']; ?></td>
                                                <td><?php echo $data['nodays']; ?></td>
                                                <td><?php echo $data['leavetype']; ?></td>
                                                <td><?php echo $data['name_stat']; ?></td>
                                                <td>
                                                    <a type="button" data-id="<?php echo $data['v_id'];?>" id="but<?php echo $data['v_id'];?>" href="javascript:void(0)" class='btn btn-info consulter'>
                                                        Consulter
                                                    </a>
                                                    <a href='annulerDemConge.php?id=<?php echo $data['v_id'];?>' class='btn btn-warning'/>
                                                        Annuler
                                                    </a>
                                                </td>
                                                <?php
                                                echo "</tr>";
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="10" align="center">No data found.</td>
                                            </tr>
                                            <?php
                                        }

                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="approuver" class="tab-pane fade">
                                <h3>Liste des Demandes de Congés Approuvées</h3>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover" id="attente">
                                        <thead>
                                            <tr style="font-size: 12px;">
                                                <th>Nom</th>
                                                <th>Departement</th>
                                                <th>Date Depos</th>
                                                <th>Durée</th>
                                                <th>Type</th>
                                                <th>Etat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query2 = mysql_query("SELECT * FROM fonctionnaire, vacation_log, location_details,stlocation, approve_hr WHERE fonctionnaire.fonct_id = vacation_log.fonct_id and fonctionnaire.fonct_id=location_details.fonct_id and stlocation.stdev_id = location_details.stdev_id AND approve_hr.hr_approve = vacation_log.hr_approve AND vacation_log.hr_approve = '2'  and vacation_log.fonct_id='$id'");
                                        if(mysql_num_rows($query2)){
                                            while ($data = mysql_fetch_array($query2)) {
                                                echo "<tr>";
                                                ?>
                                                <td><?php echo $data['firstname']." ".$data['lastname']; ?></td>
                                                <td><?php echo $data['stdev_location_name']; ?></td>
                                                <td><?php echo $data['vdate']; ?></td>
                                                <td><?php echo $data['nodays']; ?></td>
                                                <td><?php echo $data['leavetype']; ?></td>
                                                <td><?php echo $data['name_stat']; ?></td>
                                                <td>
                                                    <a type="button" data-id="<?php echo $data['v_id'];?>" id="but<?php echo $data['v_id'];?>" href="javascript:void(0)" class='btn btn-info consulter'>
                                                        Consulter
                                                    </a>
                                                </td>
                                                <?php
                                                echo "</tr>";
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="10" align="center">No data found.</td>
                                            </tr>
                                            <?php
                                        }

                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="refuser" class="tab-pane fade">
                                <h3>Liste des Demandes de Congés Refusées</h3>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover" id="attente">
                                        <thead>
                                            <tr style="font-size: 12px;">
                                                <th>Nom</th>
                                                <th>Departement</th>
                                                <th>Date Depos</th>
                                                <th>Durée</th>
                                                <th>Type</th>
                                                <th>Etat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query3 = mysql_query("SELECT * FROM fonctionnaire, vacation_log, location_details,stlocation, approve_hr WHERE fonctionnaire.fonct_id = vacation_log.fonct_id and fonctionnaire.fonct_id=location_details.fonct_id and stlocation.stdev_id = location_details.stdev_id AND approve_hr.hr_approve = vacation_log.hr_approve AND vacation_log.hr_approve = '3'  and vacation_log.fonct_id='$id'");
                                        if(mysql_num_rows($query3)){
                                            while ($data = mysql_fetch_array($query3)) {
                                                echo "<tr>";
                                                ?>
                                                <td><?php echo $data['firstname']." ".$data['lastname']; ?></td>
                                                <td><?php echo $data['stdev_location_name']; ?></td>
                                                <td><?php echo $data['vdate']; ?></td>
                                                <td><?php echo $data['nodays']; ?></td>
                                                <td><?php echo $data['leavetype']; ?></td>
                                                <td><?php echo $data['name_stat']; ?></td>
                                                <td>
                                                    <a type="button" data-id="<?php echo $data['v_id'];?>" id="but<?php echo $data['v_id'];?>" href="javascript:void(0)" class='btn btn-info consulter'>
                                                        Consulter
                                                    </a>
                                                </td>
                                                <?php
                                                echo "</tr>";
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="10" align="center">No data found.</td>
                                            </tr>
                                            <?php
                                        }

                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright pull-right">
                    Copyright &copy; <script>document.write(new Date().getFullYear())</script>, All Right Reserved.</a>
                </div>
            </div>
        </footer>

    </div>
</div>

    <?php
    include("../include/scripts.php");

    $query4 = mysql_query("SELECT * FROM fonctionnaire, vacation_log, location_details,stlocation, approve_hr WHERE fonctionnaire.fonct_id = vacation_log.fonct_id and fonctionnaire.fonct_id=location_details.fonct_id and stlocation.stdev_id = location_details.stdev_id AND approve_hr.hr_approve = vacation_log.hr_approve and vacation_log.fonct_id='$id'");
    while($data=mysql_fetch_array($query4)){
    ?>
        <script>
            $(document).ready(function(){
                
                $('#but<?php echo $data['v_id']; ?>').click(function(e){
                    
                    e.preventDefault();
                    
                    var pid = $(this).attr('data-id');
                    var parent = $(this).parent("td").parent("tr");
                    
                    bootbox.dialog({
                      message: "<p>Fonctionnaire: <b><?php echo $data['firstname']." ".$data['lastname']; ?></b></p>\
                                <p>Date déposition: <b><?php echo $data['vdate']; ?></b></p>\
                                <p>Date de congé: <b><?php echo " de ".$data['sdate']." à ".$data['eddate']; ?></b></p>\
                                <p>Type: <b><?php echo $data['leavetype']; ?></b></p>\
                                <p>Nombre de jours: <b><?php echo $data['nodays']; ?></b></p>",
                      title: "<i class='glyphicon glyphicon-list-alt'></i> Information sur le congé !",
                      buttons: {
                        success: {
                          label: "Close",
                          className: "btn-info",
                          callback: function() {
                             $('.bootbox').modal('hide');
                          }
                        }
                      }
                    });
                    
                    
                });
                
            });
        </script>
    <?php
    }
    ?>
    <script>
        $('#attente').dataTable();
    </script>
    <?php
        if($success){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " Demande envoyée."

            },{
                type: 'success',
                timer: 4000
            });

        });
    </script>
    <?php
        }else if($fail){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-close',
                message: " Date fin < Date Effective."

            },{
                type: 'danger',
                timer: 4000
            });

        });
    </script>
    <?php    
        }
    ?>

    <?php
    if($cookie){
        if($cookie == "success"){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " Demande annulée."

            },{
                type: 'success',
                timer: 4000
            });

        });
    </script>
    <?php
        }
    }
    ?>

</body>


</html>