<?php
include("../include/db.php");
include("auth.php");

$success = 0;
$fail ='';
if (isset($_POST['submit'])){
    $stdev_location_name = $_POST['dep'];
    $thumbnails = $_POST['thumbnails'];

    $query = mysql_query("SELECT COUNT(stdev_location_name) FROM stlocation WHERE stdev_location_name = '".mysql_real_escape_string($_POST['dep'])."'");
    $row = mysql_fetch_array($query);
    if ($row[0]) {
        $fail+= 'here is an element with the same name';
    }else{
        mysql_query("insert into stlocation (stdev_location_name,thumbnails) values('$stdev_location_name','images/thumbnails.jpg')")or die(mysql_error());
        $success=1;
    }
    $fail= 'département existe déja';
}
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

        .thumbnail a img{
            transition: 1s;
        }
        .thumbnail a img:hover{
            opacity: 0.5;
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
        <h4 class="modal-title">Ajouter Département</h4>
      </div>
      <div class="modal-body">
        <form method="post">
            <div class="form-group">
                <label >Département</label>
                <input type="text" class="form-control border-input" name="dep" placeholder="Département" required>
            </div> 
            <div  class="form-group">
                <input name="thumbnails" class="input focused" type="hidden" >
            </div>
            
          
            <div class="form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Ajouter</button>
            </div>
        </form>
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
                <li>
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
                        <li><a href="demandeformation.php"> Formations Demandés</a></li>
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
                            <a href="#" type="button" data-toggle="modal" data-target="#myModal">
                                <span class="glyphicon glyphicon-plus"></span> Ajouter un departement
                            </a><br><br>
                            <div class="row">
                                <?php 
                                    $query = mysql_query("select * from stlocation")or die(mysql_error());
                                    $count = mysql_num_rows($query);
                                        
                                    if ($count > 0){
                                        while($row = mysql_fetch_array($query)){
                                        $stdev_id = $row['stdev_id'];
                                        ?>
                                        <?php
                                            include('count_fonct.php'); ?>
                                            <div id="del<?php echo $id; ?>" class="col-sm-3">
                                                <div class="thumbnail">
                                                    <a href="Departement.php<?php echo '?stdev_id='.$stdev_id; ?>">
                                                    <img src ="<?php echo $row['thumbnails'] ?>" width="400" height="300">
                                                    </a>
                                                    <p>
                                                        <div class="btn-group pull-right">
                                                            <a type="button" data-id="<?php echo $row['stdev_id'];?>" id="but<?php echo $row['stdev_id'];?>" href="javascript:void(0)" class="btn btn-info"><i class="ti ti-pencil-alt"></i></a>
                                                            <a class="btn btn-danger delete_product" data-id="<?php echo $row['stdev_id'];?>" href="javascript:void(0)"><i class="ti ti-trash"></i></a>
                                                        </div>
                                                    </p>
                                                    <p><strong id="strong"><?php echo $row['stdev_location_name']; ?></strong>
                                                        <?php echo '('.$not_count.')'; ?></p>
                                                        <br>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        }else{
                                        ?>                                       
                                            <div class="alert alert-info"><i class="icon-info-sign"></i>Il n y a pas des emplacements</div>
                                        <?php  } ?>
                            </div>
<?php
    include("../include/scripts.php");
?> 
<?php
    $query4 = mysql_query("SELECT * from stlocation ");
    while($data=mysql_fetch_array($query4)){
        $nameDep=$data['stdev_location_name'];
    ?>
        <script>
            $(document).ready(function(){
                
                $('#but<?php echo $data['stdev_id']; ?>').click(function(e){
                    
                    e.preventDefault();
                    
                    var pid = $(this).attr('data-id');
                    var parent = $(this).parent("div").parent("div").parent("div").find("#strong");
                    
                    bootbox.dialog({
                      message: "<label>Departement:</label> <input name='name' class='form-control border-input' id='Dep<?php echo $data['stdev_id']; ?>' type='text' value='<?php echo $nameDep ; ?>'>", 
                                
                      title: "<i class='glyphicon glyphicon-list-alt'></i> Modifier un Département!",
                      buttons: {
                        success: {
                          label: "Annuler",
                          className: "btn-info",
                          callback: function() {
                             $('.bootbox').modal('hide');
                          }
                        },
                            danger: {
                  label: "Modifier!",
                  className: "btn-confirm",
                  callback: function() {
                      
                    
                      
                        var name = $("#Dep<?php echo $data['stdev_id']; ?>").val();
                      $.post('update.php', { 'update':pid, 'name':name })
                      .done(function(response){
                          bootbox.alert(response);
                          parent.text(name);
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
    <?php
    }
    ?>
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
    $(document).ready(function(){
        
        $('.delete_product').click(function(e){
            
            e.preventDefault();
            
            var pid = $(this).attr('data-id');
            var parent = $(this).parent("div").parent("div").parent("div");
            
            bootbox.dialog({
              message: "Vous etes sur de supprimer cette département ?",
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
                      
                    
                      
                      $.post('delete_dep.php', { 'delete':pid, 'name':name })
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
    <?php
    if($success){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " Departement bien ajouté."

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
                message: " <?php echo $fail; ?>."

            },{
                type: 'danger',
                timer: 4000
            });

        });
    </script>
    <?php    
    }
    ?>

    <script>
        $('#formation').dataTable();
    </script>

</body>


</html>
