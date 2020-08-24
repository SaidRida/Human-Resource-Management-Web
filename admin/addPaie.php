<?php
include("../include/db.php");
include("auth.php");

$success = 0;
if(isset($_POST['submit'])){
    $fonct_id = htmlentities(trim($_POST['fonct']));
    $month = htmlentities(trim($_POST['month']));
    $year = htmlentities(trim($_POST['year']));
    $indm_l = htmlentities(trim($_POST['indm_l']));
    $indm_t = htmlentities(trim($_POST['indm_t']));
    $indm_h = htmlentities(trim($_POST['indm_h']));
    $indemnite = htmlentities(trim($_POST['indm']));
    $abs_p = htmlentities(trim($_POST['abs_p']));
    $abs_sp = htmlentities(trim($_POST['abs_sp']));
    
   
    $ext = mysql_query("SELECT * FROM fonctionnaire where fonct_id='$fonct_id'");
    $donnees = mysql_fetch_array($ext);
    $level = $donnees['grade'];
     
    $extract = mysql_query("SELECT basic_salary FROM grade where grade='$level'");
    $lv = mysql_fetch_array($extract);
    $basic_salary = $lv['basic_salary'];
    $salary_per_day = $basic_salary / 30;

    $deduction = $salary_per_day * $abs_sp;
    
    $net_salary = $basic_salary + $indemnite - $deduction;
    
    mysql_query("INSERT INTO paie (fonct_id, mois, annee, date, basic_salary, indemnite, salaire_jour, nbr_conge, nbr_sans_per, deduction, net_salary) VALUES($fonct_id, '$month', '$year', NOW(), $basic_salary, $indemnite, $salary_per_day, $abs_p, $abs_sp, $deduction, $net_salary)");
    $sql = mysql_query("SELECT * FROM paie ORDER BY ID_paie desc");
    $data = mysql_fetch_array($sql);
    $payslip_id = $data['ID_paie'];
    
    mysql_query("INSERT INTO deduction (ID_paie,fonct_id,nbr_conge,TYPE_LEAVES) VALUES($payslip_id,$fonct_id,$abs_p,'PERMISSION')");
    mysql_query("INSERT INTO deduction (ID_paie,fonct_id,nbr_conge,TYPE_LEAVES) VALUES($payslip_id,$fonct_id,$abs_sp,'SANS PERMI')");
    
    mysql_query("INSERT INTO indemnite (indm_long,indm_trn,indm_hr,fonct_id,ID_paie) VALUES($indm_l,$indm_t,$indm_h,$fonct_id,$payslip_id)");

    $content = 'Votre fiche de paie pour '.$month.' '.$year.' est generee';
    mysql_query("insert into notification values('', $fonct_id, 'fonct', 'payslip', '$content', DEFAULT, 0)");
    
    $success = 1;
    //header ("location: payslip.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>AJOUTER FICHE DE PAIE | SWAG</title>
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
                <li class="">
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
        
               
                <li class="active">
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
                    <a class="navbar-brand" href="#">Fiche de paie</a>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="payslip.php">&laquo; retourner aux fiches de paie</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="text-center">Générer une fiche de paie</h3>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <form method="post" role="form">
                                          <div class="row">
                                              <div class="form-group col-sm-12">
                                                <label for="id">Fonctionnaire:</label>
                                                <select class="form-control" id="id" name="fonct" required>
                                                <?php
                                                    $sql = mysql_query("select * from fonctionnaire");
                                                    while ($dt = mysql_fetch_array($sql)) {
                                                        echo "<option value='".$dt['fonct_id']."'>".$dt['firstname'].' '.$dt['lastname']."</option>";
                                                    }
                                                ?>
                                                </select>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="form-group col-sm-6">
                                                <label for="month">Month:</label>
                                                  <select class="form-control col-sm-3" id="month" name="month">
                                                    <?php
                                                        $month = ['january','february','march','april','may','june','july','august','september','october','november','december'];
                                                        $i = 0;
                                                       while($i < 12){
                                                           echo '<option>'.$month[$i].'</option>';
                                                           $i++;
                                                       }
                                                    ?>
                                                  </select>
                                              </div>
                                              <div class="form-group col-sm-6">
                                                <label for="year">Year:</label>
                                                  <select class="form-control col-sm-3" id="year" name="year">
                                                    <?php
                                                        $year = date('Y');
                                                       while($year >= 1980){
                                                           echo '<option>'.$year.'</option>';
                                                           $year--;
                                                       }
                                                    ?>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="form-group col-sm-4">
                                                <label>Indemnite Longement:</label>
                                                <input type="number" min="0" value="0" class="form-control" name="indm_l" id="i_l" onkeyup="calcul()" required>
                                              </div>
                                              <div class="form-group col-sm-4">
                                                <label>Indemnite Transport:</label>
                                                <input type="number" min="0" value="0" class="form-control" name="indm_t" id="i_t" onkeyup="calcul()" required>
                                              </div>
                                              <div class="form-group col-sm-4">
                                                <label>Indemnite Horaire:</label>
                                                <input type="number" min="0" value="0" class="form-control" name="indm_h" id="i_h" onkeyup="calcul()" required>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="form-group col-sm-12">
                                                <label>Total Indemnite:</label>
                                                <input class="form-control" name="indm" id="indm" readonly>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="form-group col-sm-6">
                                                <label>Absence avec permission:</label>
                                                <input type="number" min="0" max="30" value="0" id="abs_p" class="form-control" name="abs_p" required>
                                              </div>
                                              <div class="form-group col-sm-6">
                                                <label>Absence sans permission:</label>
                                                <input type="number" min="0" max="30" value="0" id="abs_sp" class="form-control" name="abs_sp" required>
                                              </div>
                                          </div>
                                          <div class="pull-right btn-group">
                                            <a href="payslip.php" class="btn btn-info">annuler</a>
                                            <button type="submit" name="submit" class="btn btn-primary">ajouter</button>
                                          </div>
                                        </form>
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

    if($success){
    ?>
    <script>
        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " Fiche de paie générée."

            },{
                type: 'success',
                timer: 4000
            });

        });
    </script>
    <?php
    }
    ?>
    <script type="text/javascript">
        function calcul(){
            var i_l = document.getElementById("i_l").value;
            var i_t = document.getElementById("i_t").value;
            var i_h = document.getElementById("i_h").value;
            
            if(i_l == ''){
                document.getElementById("i_l").value = 0;
            }
            if(i_t == ''){
                document.getElementById("i_t").value = 0;
            }
            if(i_h == ''){
                document.getElementById("i_h").value = 0;
            }
            
            var indm = parseInt(i_l) + parseInt(i_t) + parseInt(i_h);
            document.getElementById("indm").value = indm;
            
        }
        $(document).ready(function(){
            $("#abs_p").on({
                keyup: function(){
                    var abs_p = parseInt($("#abs_p").val());
                    var abs_sp = parseInt($("#abs_sp").val());

                    test_p(abs_p, abs_sp);
                } 
            });
        });
        function test_p(abs_p, abs_sp){
            if(abs_p > (30 - abs_sp)){
                document.getElementById("abs_sp").value = 30 - abs_p;
            }
        }
        $(document).ready(function(){
            $("#abs_sp").on({
                keyup: function(){
                    var abs_p = parseInt($("#abs_p").val());
                    var abs_sp = parseInt($("#abs_sp").val());

                    test_sp(abs_p, abs_sp);
                } 
            });
        });
        function test_sp(abs_p, abs_sp){
            if(abs_sp > (30 - abs_p)){
                document.getElementById("abs_p").value = 30 - abs_sp;
            }
        }
    </script>

</body>


</html>
