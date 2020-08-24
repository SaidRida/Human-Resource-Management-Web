<?php
include("../include/db.php");
include("auth.php");
?>
<?php $stdev_id = $_GET['stdev_id']; ?>
<?php $get_id = $_GET['fonct_id']; ?>

<!doctype html>
<html lang="en">
<head>
    <title>TRANSFERER | SWAG</title>
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
    form{
margin-left: 35%;
margin-right:15%;
width: 70%;
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
                    <a class="navbar-brand" href="#">Departement</a>
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
                                <?php
                                if(isset($_SERVER['HTTP_REFERER'])) {
                                    echo "<a href=".$_SERVER['HTTP_REFERER'].">&laquo; retourner</a>";
                                }
                                ?>
                            </div>
                        </div>
                         
                            <div class="content table-responsive table-full-width">
                               	<?php
									$query = mysql_query("select * from fonctionnaire where fonct_id =$get_id ")or die(mysql_error());
									$row = mysql_fetch_array($query);
                                        // select departement id
                                        $query_test = mysql_query("select * from location_details where fonct_id=$get_id");
                                        $dept = mysql_fetch_array($query_test);
									?>
									
									 <form class="form-horizontal" method="post">
									 <div class="row">
									           <div class="col-md-4">

											
											<div class="form-group">
                                                <label class="control-label" >Fonctionnaire</label>
												<select  name="dev_id" class="form-control border-input" readonly>
                                                    <option value="<?php echo $row['fonct_id']; ?>" ><?php echo $row['firstname'].' '.$row['lastname']; ?></option>
												</select>
											</div>
										</div>
											</div>
                                          <div class="row">
										  <div class="col-md-4">
		                                  <div class="form-group">
			                                <label class="control-label">Transferer A</label>
				                              <select name="dep" class="form-control border-input">
                                                    <?php $sql=mysql_query("select * from stlocation")or die(mysql_error()); 
                                                    while ($depa=mysql_fetch_array($sql)){
                                                        if($depa['stdev_id'] == $dept['stdev_id']){
                                                            echo '<option value="'.$depa['stdev_id'].'" selected>'.$depa['stdev_location_name'].'</option>';
                                                        }else{
                                                            echo '<option value="'.$depa['stdev_id'].'">'.$depa['stdev_location_name'].'</option>';
                                                        }
                                                    } 
                                                    ?>
                                                </select>
		                                </div>
	                                   </div>
                             </div>
										
								
										<div class="control-group">
										<div class="controls">
										
										<button  data-placement="right" title="Clicker pour transferer equipement" name="transfer" type="submit" class="btn btn-info">
                                            <i class="ti ti-location-arrow"></i> Transferer
                                        </button>
										</div>
										</div>
                                </form>
                                
                                	<?php
										if (isset($_POST['transfer'])){	
										$oras = strtotime("now");
										$ora = date("Y-m-d",$oras);
										$stdev_id = $_POST['dep'];										
										mysql_query("update location_details set date_deployment = '$ora', stdev_id = '$stdev_id' where fonct_id = '$get_id' ")or die(mysql_error());
                                        $data = mysql_fetch_array(mysql_query("select * from stlocation where stdev_id=$stdev_id"));
                                        $content = 'Vous etes transfere au Departement '.$data['stdev_location_name'];
                                        mysql_query("insert into notification values('', $get_id, 'fonct', 'formation', '$content', DEFAULT, 0)");
                                        ?>
										<script>
										window.location = "Departement.php<?php echo '?stdev_id='.$stdev_id; ?>"; 
										$.jGrowl("Fonctionnaire est bien transferé", { header: 'Transferer Fonctionnaire ' });
										</script>
										<?php
										}
										
										?>
									
                        
<?php
    include("../include/scripts.php");
?>

   
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


    <script>
        $('#formation').dataTable();
    </script>

</body>


</html>