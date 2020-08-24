<?php
include("../include/db.php");
include("auth.php");
 $get_id = $_GET['stdev_id']; 
?>
<!doctype html>
<html lang="en">
<head>
    <title>DEPARTEMENT | SWAG</title>
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
                <li >
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
                <li class="active">
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
                <li>
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
                    <a class="navbar-brand" href="#">
                        <?php
                        $selectDep = mysql_query("select * from stlocation where stdev_id=$get_id");
                        $selectedDep = mysql_fetch_array($selectDep);
                        echo "Departement ".$selectedDep['stdev_location_name'];
                        ?>
                    </a>
                </div>
                <?php
                include("../include/admin_notif.php");
                ?>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="card" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="location.php">&laquo; retourner aux départements</a>
                            </div>
                        </div>
                         
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover" id="formation">
                                    <thead>
                                        <tr style="font-size: 12px;">
                                           <th>Fonctionnaire</th>
                                            <th>Bureau </th>
                                            <th>Designation</th>
                                            <th>Email </th>
                                            <th>Date Entree</th>
                                            <th></th>	
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query1 = mysql_query("select fonctionnaire.fonct_id, fonctionnaire.firstname,fonctionnaire.lastname,fonctionnaire.bureau,fonctionnaire.designation,fonctionnaire.email,fonctionnaire.grade,fonctionnaire.date_entre,fonctionnaire.telephone from fonctionnaire , stlocation , location_details where fonctionnaire.fonct_id=location_details.fonct_id and stlocation.stdev_id=location_details.stdev_id and stlocation.stdev_id = '$get_id'	order by date_deployment DESC");
                                    if(mysql_num_rows($query1)){
                                        while ($row = mysql_fetch_array($query1)) {
                                            $id=$row['fonct_id'] ;
                                            echo "<tr>";
                                            ?>
                                            <td><?php echo $row['firstname'].' ' .$row['lastname'].' '; ?></td>			
                                            <td><?php echo html_entity_decode(trim($row['bureau'])); ?></td>
                                            <td><?php echo $row['designation']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['date_entre']; ?></td>
                                            <td>
                                                <a class="btn btn-info" href="transfer.php<?php echo '?fonct_id='.$id; ?>&<?php echo 'stdev_id='.$get_id; ?>">
                                                    <i class="ti ti-location-arrow"></i> Transferer
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
?>
    <script>
        $('#formation').dataTable();
    </script>

</body>


</html>
