<?php
include("../include/db.php");
include("auth.php");

mysql_query("update notification set seen=1 where link='formation' and type_person='admin'");

$cookie = "";
if(isset($_COOKIE['op'])){
    $cookie = $_COOKIE['op'];
    setcookie('op', '', time() - (60*60), "/");
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>DEMANDE FORMATION | SWAG</title>
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
                        <li><a href="dispformations.php">Affecter Formations</a></li>
                        <li><a href="demandeformation.php" style="color: #EB5E28; font-weight: bold;"> Formations Demandées</a></li>

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
                    <a class="navbar-brand" href="#">Formations Demandées</a>
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
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover" id="formation">
                                    <thead>
                                        <tr style="font-size: 12px;">
                                            <th>Fonctionnaire</th>
                                            <th>Formation</th>
                                            <th>Formateur</th>
                                            <th>Description</th>
                                            <th>Date Début</th>
                                            <th>Date Fin</th>
                                            <th>Durée</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query1 = mysql_query("SELECT * FROM demande_formation df, formation form, fonctionnaire fonc WHERE df.form_id = form.form_id and df.fonct_id = fonc.fonct_id");
                                    if(mysql_num_rows($query1)){
                                        while ($data = mysql_fetch_array($query1)) {
                                            $form=$data['form_id'];
                                            echo "<tr>";
                                            ?>
                                            <td><?php echo $data['firstname']." ".$data['lastname']; ?></td>
                                            <td><?php echo $data['formation']; ?></td>
                                            <td><?php echo $data['formateur']; ?></td>
                                            <td><?php echo html_entity_decode($data['description']); ?></td>
                                            <td><?php echo $data['date_deb']; ?></td>
                                            <td><?php echo $data['date_fin']; ?></td>
                                            <td><?php echo $data['duree']; ?></td>
                                            <td>
                                            <div class="btn-group">
                                                <a href="accepter_form.php?form_id=<?php echo $form; ?>&fonct_id=<?php echo $data['fonct_id']; ?>" class="btn btn-info">
                                                    <i class="ti ti-check"></i>
                                                </a>
                                                <a class="btn btn-danger delete_form" id="<?php echo $data['fonct_id']; ?>" data-id="<?php echo $form; ?>" href="javascript:void(0)">
                                                    <i class="ti ti-close"></i>
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
    ?>
<script>
    $(document).ready(function(){
        
        $('.delete_form').click(function(e){
            
            e.preventDefault();
            
            var pid = $(this).attr('data-id');
            var fonct = $(this).attr('id');
            var parent = $(this).parent("div").parent("td").parent("tr");
            
            bootbox.dialog({
              message: "Vous êtes sur de refuser cette demande ?",
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
                      
                    
                      
                      $.post('Annuler_form.php', { 'delete':pid, 'fonct':fonct })
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

    <script>
        $('#formation').dataTable();
    </script>
    <?php
    if($cookie == "success"){
    ?>
    <script>

        $(document).ready(function(){

            $.notify({
                icon: 'ti-check',
                message: " Demande de formation acceptée."

            },{
                type: 'success',
                timer: 4000
            });

        });
    </script>
    <?php
        }
    ?>

</body>


</html>
