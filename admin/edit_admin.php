<?php
include("../include/db.php");
include("auth.php");

 $get_id = $_GET['admin_id']; 

$success = 0;
$fail = '';
if(isset($_POST['submit'])){
    $first = $_POST['fname'];   
    $last = $_POST['lname'];   
    $username = $_POST['username'];   
    $designation = $_POST['designation']; 
    $phone = $_POST['tel'];  
    $email = $_POST['email'];   
    $password = $_POST['pwd'];
    $cpassword = $_POST['confirm_pwd'];
    $test1 = mysql_query("select * from admin where username='$username' and admin_id != $get_id");
    if($rows=mysql_num_rows($test1)){
        $fail = ' Username exist deja.';
    }
    $test2 = mysql_query("select * from admin where email='$email' and admin_id != $get_id");
    if($rows=mysql_num_rows($test1)){
        $fail = ' Email exist deja.';
    }
    $test3 = mysql_query("select * from admin where telephone='$phone' and admin_id != $get_id");
    if($rows=mysql_num_rows($test3)){
        $fail = ' Telephone exist deja.';
    }
    if(!$fail){
        if($password == $cpassword){
            $password = md5($password);

            mysql_query("update admin set firstname='$first', lastname='$last', username='$username', designation='$designation', email='$email', telephone='$phone', password='$password' where admin_id = $get_id");
            $success = 1;
        }else{
            $fail = ' verifier votre mot de passe';
        }
    }
?>
        <script>
            //var delay = 0;		
			//setTimeout(function(){ window.location = 'admins.php'  }, delay);  
		</script>
  <?php 
}
						

?>
<!doctype html>
<html lang="en">
<head>
    <title>ADMIN | SWAG</title>
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
                <li>
                    <a href="location.php">
                        <i class="ti-desktop"></i>
                        <p>Gérer Département</p>
                    </a>
                </li>
                <li  class="dropdown active">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="ti-user"></i>
                        <p>Gérer Utilisateurs <span class="caret"></span></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admins.php"  style="color: #EB5E28; font-weight: bold;">Admin</a></li>
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
                    <a class="navbar-brand" href="#">Gesion des Admins</a>
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
                            <div class="header">
                                <h4 class="title text-center">Modifier Admin</h4>
                            </div>
                            <div class="content row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <?php
									$query = mysql_query("SELECT * from admin where admin_id= '$get_id'")or die(mysql_error());
									$row = mysql_fetch_array($query);
									?>
                                <form method="post">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Prénom:</label>

                                                <input name="fname" required type="text" class="form-control border-input" value="<?php echo $row['firstname'];?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Nom :</label>
                                                <input type="text" name="lname" class="form-control border-input"   value="<?php echo $row['lastname'];?>"  required >
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="row">
                                         <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Email :</label>
                                                <input type="email" name="email" class="form-control border-input"  value="<?php echo $row['email'];?>"   required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Telephone :</label>
                                                <input type="number" name="tel" class="form-control border-input" value="<?php echo $row['telephone'];?>" required>
                                            </div>
                                        </div>
                                        
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Username:</label>
                                                <input type="text" name="username" class="form-control border-input"  value="<?php echo $row['username'];?>"   required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Designation:</label>
                                                <input type="text" name="designation" class="form-control border-input"  value="<?php echo $row['designation'];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Mot de passe :</label>
                                                <input type="password" name="pwd" class="form-control border-input" placeholder="Password" >
                                            </div>
                                            <span class="help-block text-info">Si vous ne voulez pas changer le mot de passe laisser ces champs vide</span>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Confirmation de mot de passe :</label>
                                                <input type="password" name="confirm_pwd" class="form-control border-input" placeholder="Confirm password" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-4">
                                            <div class="text-center btn-group">
                                                <a href="admins.php" class="btn btn-info">Annuler</a>
                                                <button type="submit" name="submit" class="btn btn-primary btn-fill">Modifier</button>
                                            </div>
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
    
    if($success){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " admin bien modifié."

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
                message: " Vérifié les champs"

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

