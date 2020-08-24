<?php
include("../include/db.php");
include("auth.php");
 $get_id = $_GET['form_id']; 

$success = 0;
$fail = 0;
							if (isset($_POST['submit'])){
										  if ($_POST['sdate'] < $_POST['eddate']){
										$dev_serial =  htmlentities(trim($_POST['form']));
										$dev_brand = htmlentities(trim($_POST['format']));
										
										$dev_status =  htmlentities(trim($_POST['desc']));
									 $sdate = $_POST['sdate'];
                                        $eddate = $_POST['eddate'];
                                           
                                   
                                        $dat = strtotime("now");
                                        $da = date("Y-m-d",$dat);

                                         $duree = ((strtotime($eddate) - strtotime($sdate)) / 86400) + 1;
										
									
										mysql_query("update formation set 
																		formation  = '$dev_serial',
																		formateur = '$dev_brand',
																		description = '$dev_status',
																		date_deb = '$sdate',
																		date_fin = '$eddate',
                                                                        duree='$duree'
																		where form_id = '$get_id' ")or die(mysql_error());
                                        $success = 1;
																										
										
                                          } else{
            $fail = 1;
        }
										
                            }
										

?>
<!doctype html>
<html lang="en">
<head>
    <title>FORMATION | SWAG</title>
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
        
        .styled-select select {
   background: transparent;
   width: 268px;
   padding: 5px;
   font-size: 16px;
   line-height: 1;
   border: 0;
   border-radius: 0;
   height: 34px;
   -webkit-appearance: none;
   }
        .styled-select {
   width: 240px;
   height: 34px;
   overflow: hidden;
   background: url(new_arrow.png) no-repeat right #ddd;
   border: 1px solid #ccc;
   }
    </style>
    

</head>
<body>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter Formation</h4>
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
                <li  class="dropdown active">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="ti-bag"></i>
                        <p>Gérer formations <span class="caret"></span></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="formations.php">Formations</a></li>
                        <li><a href="dispformations.php" style="color: #EB5E28; font-weight: bold;">Affecter Formations</a></li>
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
                    <a class="navbar-brand" href="#">Formation</a>
                </div>
                <?php
                include("../include/admin_notif.php");
                ?>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-11">
                        <div class="card">
                        <a href="dispformations.php">
                            <tt>&laquo; retourner aux formations disponibles</tt>
                        </a>
                            <div class="header">
                                <h4 class="title text-center">Modifier Formation</h4>
                            </div>
                            <div class="content row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <?php
									$query = mysql_query("SELECT * FROM  formation 
									WHERE  form_id = '$get_id'")or die(mysql_error());
									$row = mysql_fetch_array($query);
									?>
                                <form method="post">

                                    

                                    <div class="row">
                                         <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Formation :</label>
                                                <input type="text" name="form" class="form-control border-input"  value="<?php echo $row['formation']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Formateur :</label>
                                                <input type="text" name="format" class="form-control border-input"  value="<?php echo $row['formateur']; ?>" required>
                                            </div>
                                        </div>
                                        
                                       
                                    </div>

                                    <div class="row">
                                         <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Date Début :</label>
                                                <input type="date" name="sdate" class="form-control border-input"  value="<?php echo $row['date_deb']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Date Fin :</label>
                                                <input type="date" name="eddate" class="form-control border-input"  value="<?php echo $row['date_fin']; ?>">
                                            </div>
                                        </div>
                                      
                                       
                                    </div>
                                    <div class="row">
                                <div class="col-md-10">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="5" name="desc" class="form-control border-input"  value="<?php echo $row['description']; ?>" style="text-align: left;" required>
                                                    <?php echo $row['description']; ?>
                                                </textarea>
                                            </div>
                                </div>
                                  </div>
                                    <div class="row">
                                <div class="col-md-10">
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-info btn-fill btn-wd">Modifier</button>
                                    </div>
                                    </div>
                                        </div>
                                    <div class="clearfix"></div>
                                </form>
                                </div>
                                <div class="col-md-2"></div>
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
                message: " Formation bien modifié."

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

</body>


</html>

