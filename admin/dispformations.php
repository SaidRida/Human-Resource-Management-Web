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

        select option{
            text-transform: capitalize;
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
                <li  class="dropdown active">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="ti-bag"></i>
                        <p>Gérer formations <span class="caret"></span></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="formations.php" >Formations</a></li>
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
                    <a class="navbar-brand" href="#">Formations Disponible</a>
                </div>
                <?php
                include("../include/admin_notif.php");
                ?>
            </div>
        </nav>

  <?php
$success = 0;
$fail = 0;
if (isset($_POST['affect'])){
    
    $idd=$_POST['selector'];
 	$sid  = $_POST['fonct'];
    

	if ($idd != '' ){
        $N = count($idd);
        for($i=0; $i < $N; $i++){
            $form_id = $idd[$i];
            $select = mysql_query("select * from formation where form_id='$form_id'");
            $data = mysql_fetch_array($select);
            $content = 'Vous avez une formation pour '.$data['description'];
            mysql_query("insert into notification values('', $sid, 'fonct', 'formation', '$content', DEFAULT, 0)");
            mysql_query("update formation set fonct_id='$sid' where form_id='$idd[$i]'")or die(mysql_error());
            $success=1;
        }
    ?>
        
        <script>
            var delay = 0;		
			setTimeout(function(){ window.location = 'formations.php'  }, delay);  
		</script>
	<?php		
    }
    $fail=1 ;
} 
            ?>  
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                                
                        <form method="post">
                        <div class="card" style="padding: 20px;">
                            <div class="control-group">
                                <label class="control-label">Fonctionnaire</label>
                                <div class="controls">
                                    <select name="fonct" class="form-control" style="width: 200px; float: left;" required/>
                                        <?php
                                        $result =  mysql_query("select * from fonctionnaire")or die(mysql_error()); 
                                        while ($row=mysql_fetch_array($result)){
                                        ?>
                                            <option value="<?php echo $row['fonct_id']; ?>"><?php echo $row['lastname']; ?>            
                                            </option>
                                        <?php
                                        } 
                                        ?>
                                    </select>
                                    <button  class="btn btn-primary" name="affect" data-placement="right" title="Clicker Pour l Envoyer"><i class="icon-share">Affecter</i></button>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover" id="formation">
                                    <thead>
                                        <tr style="font-size: 12px;">
                                            <th></th>
                                            <th>Formation</th>
                                            <th>Formateur</th>
                                            <th>Description</th>
                                            <th>Date Début</th>
                                            <th>Date Fin</th>
                                            <!-- <th>Durée</th> -->
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query1 = mysql_query("SELECT * FROM formation WHERE fonct_id=0");
                                    if(mysql_num_rows($query1)){
                                        while ($data = mysql_fetch_array($query1)) {
                                            $form=$data['form_id'];
                                            echo "<tr>";
                                            ?>
                                            <td>
                                                <div class="form-group" style="padding-top: 15px;">
                                                    <label for="select<?php echo $form; ?>" class="control control--checkbox checkbox">
                                                        <input type="checkbox" name="selector[]" value="<?php echo $form; ?>"/>
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><?php echo $data['formation']; ?></td>
                                            <td><?php echo $data['formateur']; ?></td>           
                                            <td><?php echo html_entity_decode($data['description']); ?></td>
                                            <td><?php echo $data['date_deb']; ?></td>            
                                            <td><?php echo $data['date_fin']; ?></td>            
                                            <!-- <td><?php echo $data['duree']; ?></td> -->
                                        <td>
                                            <a href="edit_form_disp.php?form_id=<?php echo $form; ?>" class="btn btn-info">
                                                <i class="ti-pencil" title="Modifier"></i></a></td>
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
                         </form>
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
if($success){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " Formation bien affecté."

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
                message: " Formation non affecté."

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
