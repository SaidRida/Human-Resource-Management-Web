
<?php
include("../include/db.php");
include("auth.php");

$success = 0;
$fail ='';
if (isset($_POST['submit'])){
    
    $firstname = htmlentities (trim($_POST['fname']));
    $lastname = htmlentities (trim($_POST['lname']));
    $username = htmlentities (trim($_POST['username']));
    $designation = htmlentities (trim($_POST['designation']));
    $test1 = mysql_query("select * from admin where username = '" .mysql_real_escape_string($_POST['username']) ."'");
    if(mysql_num_rows($test1)){
        $fail = ' Username déja existe';
    }
    $password = md5(htmlentities (trim($_POST['pwd'])));
    $email=htmlentities (trim($_POST['email']));
    $test2 = mysql_query("select * from admin where email = '$email'");
    if(mysql_num_rows($test2)){
        $fail = ' Email déja existe';
    }
    $telephone=htmlentities (trim($_POST['tel']));
    $test3 = mysql_query("select * from admin where telephone = '$telephone'");
    if(mysql_num_rows($test3)){
        $fail = ' Telephone déja existe';
    }
        
    if(!$fail){
        mysql_query("insert into admin (username,password,firstname,lastname,designation,email,telephone) values('$username','$password','$firstname','$lastname','$designation','$email','$telephone')")or die(mysql_error());
        $success=1;
    }
}

?>







<!doctype html>
<html lang="en">
<head>
    <title>ADMINS | SWAG</title>
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
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter Admin</h4>
      </div>
      <div class="modal-body">
        <form method="post">
            <div class="form-group">
                <label>Prénom:</label>
        	   <input type="text" class="form-control border-input" name="fname" placeholder="Prénom" required>
            </div>
            <div class="form-group">
                <label >Nom</label>
                <input type="text" class="form-control border-input" name="lname" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control border-input" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label>Password :</label>
                <input type="password" name="pwd" class="form-control border-input" required="" placeholder="password">
            </div>
            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" class="form-control border-input" required="" placeholder="email">
            </div>
            <div class="form-group">
                <label>Designation</label>
                <input type="text" class="form-control border-input" name="designation" placeholder="Designation" required>
            </div>
            <div class="form-group">
                <label>Telephone :</label>
                <input type="number" name="tel" class="form-control border-input" required="" placeholder="telephone">
            </div>
     
            <div class="form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Ajouter</button>
            </div>
        </form>
   <?php
    include("../include/scripts.php");
    
    if($success){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " Admin bien ajouté."

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
                message: " <?php echo $fail; ?> !."

            },{
                type: 'danger',
                timer: 4000
            });

        });
    </script>
    <?php    
    }
    ?>
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
                <li >
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li  class="dropdown ">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="ti-bag"></i>
                        <p>Gérer formations <span class="caret"></span></p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="formations.php" >Formations</a></li>
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
                        <li><a href="admins.php" style="color: #EB5E28; font-weight: bold;">Admin</a></li>
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
                    <a class="navbar-brand" href="#">Gestions des Admins</a>
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
                            <a href="#" type="button" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-plus"></span> Ajouter un admin
                        </a>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover" id="formation">
                                    <thead>
                                        <tr style="font-size: 12px;">
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query1 = mysql_query("SELECT * FROM admin ");
                                    if(mysql_num_rows($query1)){
                                        while ($data = mysql_fetch_array($query1)) {
                                            $id=$data['admin_id'] ;
                                            echo "<tr>";
                                            ?>
                                            <td><?php echo $data['firstname']; ?></td>
                                            <td><?php echo $data['lastname']; ?></td>
                                            <td><?php echo $data['username']; ?></td>
                                            <td><?php echo $data['email']; ?></td>           
                                            <td><?php echo $data['designation']; ?></td>           
                                            <td>
                                            <div class="btn-group">
                                                <a href="edit_admin.php<?php echo '?admin_id='.$id; ?>" class="btn">
                                                    <i class="ti-pencil" title="Modifier"></i>
                                                </a>
                                                <a class="delete_product btn btn-danger" data-id="<?php echo $id; ?>" href="javascript:void(0)">
                                                    <i class="glyphicon glyphicon-trash" title="Supprimer"></i>
                                                </a>
                                            </div>
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
                                 <script src="js/jquery-1.12-0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootbox.min.js"></script>
<script>
	$(document).ready(function(){
		
		$('.delete_product').click(function(e){
			
			e.preventDefault();
			
			var pid = $(this).attr('data-id');
			var parent = $(this).parent("div").parent("td").parent("tr");
			
			bootbox.dialog({
			  message: "Vous etes sur de supprimer cet admin?",
			  title: "<i class='glyphicon glyphicon-trash'></i> Supprimer !",
			  buttons: {
				success: {
				  label: "Annuler",
				  className: "btn-success",
				  callback: function() {
					 $('.bootbox').modal('hide');
				  }
				},
				danger: {
				  label: "Oui!",
				  className: "btn-danger",
				  callback: function() {
					  
					
					  
					  $.post('delete_admin.php', { 'delete':pid })
					  .done(function(response){
						  bootbox.alert(response);
						  parent.fadeOut('slow');
					  })
					  .fail(function(){
						  bootbox.alert('Something Went Wrog ....');
					  })
					  					  
				  }
				}
			  }
			});
			
			
		});
		
	});
</script>
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
