<?php
include("../include/db.php");
include("auth.php");

mysql_query("update notification set seen=1 where link='payslip' and person_id=$id and type_person='fonct'");

?>
<!doctype html>
<html lang="en">
<head>
    <title>FICHE DE PAIE | SWAG</title>
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">Fiche de paie</a>
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
                                            <th>Pour</th>
                                            <th>Généré le</th>
                                            <th>Salaire de base</th>
                                            <th>Salaire par jour</th>
                                            <th>Nb jour congé</th>
                                            <th>Indemnité</th>
                                            <th>Déduction</th>
                                            <th>Salaire net</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query1 = mysql_query("select * from paie where fonct_id=$id and deleted=0");
                                    if(mysql_num_rows($query1)){
                                        while ($data = mysql_fetch_array($query1)) {
                                            echo "<tr>";
                                            ?>
                                            <td><?php echo $data['mois']." ".$data['annee']; ?></td>
                                            <td><?php echo $data['date']; ?></td>
                                            <td><?php echo $data['basic_salary']; ?></td>
                                            <td><?php echo $data['salaire_jour']; ?></td>
                                            <td><?php echo $data['nbr_conge']+$data['nbr_sans_per']; ?></td>
                                            <td><?php echo $data['indemnite']; ?></td>
                                            <td><?php echo $data['deduction']; ?></td>
                                            <td><?php echo $data['net_salary']; ?></td>
                                            <td>
                                                <a target="_blank" href='printPaie.php?id=<?php echo $data['ID_paie'];?>' class="btn btn-info">
                                                    <i class="ti-printer"></i>
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
