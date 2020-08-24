<?php
include("../include/db.php");
include("auth.php");

$cookie = "";
if(isset($_COOKIE['op'])){
    $cookie = $_COOKIE['op'];
    setcookie('op', '', time() - (60*60), "/");
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>FORMATION DISPONIBLE | SWAG</title>
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
                <li>
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li  class="dropdown active">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="ti-bag"></i>
                        <p>Mes formations <span class="caret"></span></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="formations.php">Formations</a></li>
                        <li><a href="dispformations.php"  style="color: #EB5E28; font-weight: bold;">Formations Disponibles</a></li>
                    </ul>
                </li>
                <li>
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
                    <a class="navbar-brand" href="#">Formations Disponible</a>
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
                        <div class="card" style="padding: 20px;">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover" id="formation">
                                    <thead>
                                        <tr style="font-size: 12px;">
                                            <th>Formation</th>
                                            <th>Formateur</th>
                                            <th>Departement</th>
                                            <th>Description</th>
                                            <th>Date Début</th>
                                            <th>Date Fin</th>
                                            <!-- <th>Durée</th> -->
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query1 = mysql_query("SELECT * FROM formation, location_details,stlocation WHERE location_details.fonct_id=$id and stlocation.stdev_id=location_details.stdev_id and formation.fonct_id=0");
                                    if(mysql_num_rows($query1)){
                                        while ($data = mysql_fetch_array($query1)) {
                                            echo "<tr>";
                                            ?>
                                            <td><?php echo $data['formation']; ?></td>
                                            <td><?php echo $data['formateur']; ?></td>           
                                            <td><?php echo $data['stdev_location_name']; ?></td>
                                            <td><?php echo html_entity_decode($data['description']); ?></td>
                                            <td><?php echo $data['date_deb']; ?></td>            
                                            <td><?php echo $data['date_fin']; ?></td>            
                                            <!-- <td><?php echo $data['duree']; ?></td> -->
                                            <td>
                                                <a href='demandeformation.php?id=<?php echo $data['form_id'];?>'><input type='button' value='Demander' class='btn btn-info'/></a>
                                                <a href='annulerDemForm.php?id=<?php echo $data['form_id'];?>'><input type='button' value='Annuler' class='btn btn-warning'/></a>
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
    <?php
    if($cookie){
        if($cookie == "success"){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " Formation bien demandée."

            },{
                type: 'success',
                timer: 4000
            });

        });
    </script>
    <?php
        }else if($cookie == "failed"){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-close',
                message: " Formation déjà demandée."

            },{
                type: 'danger',
                timer: 4000
            });

        });
    </script>
    <?php    
        }else if($cookie == "annuler"){
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
