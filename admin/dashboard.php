<?php
include("../include/db.php");
include("auth.php");

?>
<!doctype html>
<html lang="en">
<head>
	<title>DASHBOARD | SWAG</title>
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
    </style>
	

</head>
<body>

<div class="wrapper">
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
                <li class="active">
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li  class="dropdown">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="ti-bag"></i>
                        <p>Gérer formations <span class="caret"></span></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="formations.php">Formations</a></li>
                        <li><a href="dispformations.php">Affecter Formations</a></li>
                     <li><a href="demandeformation.php" > Formations Demandés</a></li>

                    </ul>
                </li>
                <li>
                    <a href="location.php">
                        <i class="ti-desktop"></i>
                        <p>Gérer Département</p>
                    </a>
                </li>
                <li  class="dropdown">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="ti-user"></i>
                        <p>Gérer Utilisateurs <span class="caret"></span></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admins.php">Admin</a></li>
                        <li><a href="fonctionnaire.php">Fonctionnaire</a></li>
                    </ul>
                </li> 
               <li >
                    <a href="conges.php">
                        <i class="ti-calendar"></i>
                        <p>Gérer Congés</p>
                    </a>
                </li>
        
               
                <li>
                    <a href="payslip.php">
                        <i class="ti-clipboard"></i>
                        <p>Gérer Fiche de Paie</p>
                    </a>
                </li>
                <li>
                    <a href="message.php">
                        <i class="ti-email"></i>
                        <?php
                        $cmp_msg = mysql_query("select * from message where admin_id=$id and receiver='admin' and del_from_admin=0 and seen = 0");
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
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <?php
                include("../include/admin_notif.php");
                ?>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Fonctionnaire</p>
                                            <?php
                                            echo mysql_num_rows(mysql_query("select * from fonctionnaire"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-desktop"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Departement</p>
                                            <?php
                                            echo mysql_num_rows(mysql_query("select * from stlocation"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Congé</p>
                                            <?php
                                            echo mysql_num_rows(mysql_query("select * from vacation_log where hr_approve=1"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Demande de congé
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="ti-bag"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Formation</p>
                                            <?php
                                            echo mysql_num_rows(mysql_query("select * from demande_formation"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Demande de formation
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Statistiques des departement</h4>
                                <p class="category">Nombre de fonctionnaire par departement</p>
                            </div>
                            <div class="content">
                                <div>
                                    <canvas id="chartPref" width="400" height="400"></canvas>
                                </div>

                                <div class="footer">
                                    <div class="chart-legend">
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
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


</body>

    <?php
    include("../include/scripts.php");
    ?>

    <script>
    var chrt = document.getElementById("chartPref").getContext("2d");
    var myarr = [<?php
            $sqlDept = mysql_query("select * from stlocation");
            $countDept = mysql_num_rows($sqlDept);
            $counter = 1;
            while($data = mysql_fetch_array($sqlDept)){
                $stdev_id = $data['stdev_id'];
                include('count_fonct.php');
                echo $not_count;
                if($counter != $countDept){
                    echo ", ";
                }
            }
        ?>];
    var data = {
        labels: [<?php
            $sqlDept = mysql_query("select * from stlocation");
            $countDept = mysql_num_rows($sqlDept);
            $counter = 1;
            while($data = mysql_fetch_array($sqlDept)){
                echo '"'.$data['stdev_location_name'].'"';
                if($counter != $countDept){
                    echo ", ";
                }
            }
        ?>], //x-axis
        datasets: [
            {
                label: "My Second dataset", //optional
                fillColor: "rgba(220,120,220,0.8)",
                strokeColor: "rgba(220,120,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: myarr
            }
        ]
    };

    var myFirstChart = new Chart(chrt).Bar(data);
</script>

	<script type="text/javascript">

    	$(document).ready(function(){

        	demo.initChartist();


    	});
	</script>

</html>
