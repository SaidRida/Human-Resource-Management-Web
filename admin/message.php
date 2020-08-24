<?php
include("../include/db.php");
include("auth.php");

?>
<!doctype html>
<html lang="en">
<head>
    <title>MESSAGES | SWAG</title>
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
    </style>
    

</head>
<body>

<div class="wrapper">
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouveau message</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="sendMsg.php">
            <div class="form-group">
                <label>à :</label>
                <select name="admin" class="form-control border-input">
                <?php
                $sql = mysql_query("select * from fonctionnaire");
                while ($dt = mysql_fetch_array($sql)) {
                    echo "<option value='".$dt['fonct_id']."'>".$dt['firstname'].' '.$dt['lastname']."</option>";
                }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label>Message :</label>
                <textarea name="message" class="form-control border-input" required=""></textarea>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                <button type="submit" name="send" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Envoyer</button>
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">Messages</a>
                </div>
                <?php
                include("../include/admin_notif.php");
                ?>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-3 message-bar">
                                        <div class="row message-bar-header">
                                            <div class="col-sm-12">
                                                <a href="#" type="button" data-toggle="modal" data-target="#myModal" style="padding: 15px;"><i class="ti-pencil-alt"></i> nouveau message</a>
                                            </div>
                                        </div>
                                    <?php
                                    $fonctArray[0]=0;
                                    $select1 = mysql_query("select * from message where del_from_admin=0 order by time desc");
                                    while($data = mysql_fetch_array($select1)){
                                        $fonct_id = $data['fonct_id'];
                                        $i = 0;
                                        $access = 1;
                                        while($i < count($fonctArray)){
                                            if($fonct_id == $fonctArray[$i]){
                                                $access = 0;
                                            }
                                            $i++;
                                        }
                                        $fonctArray[$i] = $fonct_id;
                                        if(!$access){
                                            continue;
                                        }
                                        $query1 = mysql_query("select * from fonctionnaire where fonct_id = $fonct_id");
                                        $fonct_count = mysql_num_rows($query1);
                                        if($fonct_count){
                                            $fonct = mysql_fetch_array($query1);
                                        }

                                        $query2 = mysql_query("select * from message where fonct_id = $fonct_id and admin_id = $id and del_from_admin = 0 order by time desc");
                                        $adm = mysql_fetch_array($query2);
                                        if($adm['seen']){
                                            echo '<div class="col-sm-12 user-message" onclick="redirect('.$fonct_id.')">';
                                        }else{
                                            echo '<div class="col-sm-12 user-message message-not-seen" onclick="redirect('.$fonct_id.')">';
                                        }

                                        $cmp = mysql_query("select * from message where admin_id=$id and fonct_id=$fonct_id and receiver='admin' and del_from_admin=0 and seen = 0");
                                        $msgNotSeen = mysql_num_rows($cmp);
                                    ?>
                                            <div class="row">
                                                <div class="col-sm-9" style="text-transform: capitalize;">
                                                    <p>
                                                    <?php
                                                    if($msgNotSeen){
                                                    ?>
                                                        <span class="badge"><?php echo $msgNotSeen; ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                        <b style="font-size: 13px;"><?php
                                                        if($fonct_count){
                                                            echo $fonct['firstname'].' '.$fonct['lastname']; 
                                                        }else{
                                                            echo "fonctionnaire non disponible";
                                                        }
                                                        ?></b>
                                                    </p>
                                                </div>
                                                <div class="col-sm-3" style="font-size: 12px;">
                                                    <?php echo date("H:i",strtotime($adm['time'])); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p><?php echo $adm['message']; ?></p>
                                                </div>
                                            </div>
                                    <?php
                                        echo "</div>";
                                    }
                                    ?>
                                    </div>
                                    <div class="col-sm-9 message-content">
                                        <div class="row message-content-header">
                                            <div class="col-sm-12">
                                            </div>
                                        </div>
                                        <div class="row message-content-body">
                                            
                                        </div>
                                        <div class="row message-content-footer">
                                            <div class="col-sm-12">
                                            </div>
                                        </div>
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


</body>

    <?php
    include("../include/scripts.php");
    ?>

    <script>
        function redirect(id){
            window.location.href = "chat.php?id=" + id + "#location";
        }
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

</html>
