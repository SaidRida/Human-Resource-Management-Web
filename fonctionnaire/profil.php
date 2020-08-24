<?php
include("../include/db.php");
include("auth.php");

$success = 0;
$fail = '';
if(isset($_POST['submit'])){
    $first = $_POST['fname'];   
    $last = $_POST['lname'];   
    $username = $_POST['username'];   
    $email = $_POST['email'];   
    $phone = $_POST['phone'];   
    $password = $_POST['pwd'];   
    $cpassword = $_POST['confirm_pwd'];
    $test1 = mysql_query("select * from fonctionnaire where username='$username' and fonct_id != $id");
    if($rows=mysql_num_rows($test1)){
        $fail += ' Username exist deja.';
    }
    $test2 = mysql_query("select * from fonctionnaire where email='$email' and fonct_id != $id");
    if($rows=mysql_num_rows($test1)){
        $fail += ' Email exist deja.';
    }
    if(!$fail){
        if($password == $cpassword){
            $password = md5($password);

            mysql_query("update fonctionnaire set firstname='$first', lastname='$last', username='$username', email='$email', telephone='$phone', password='$password' where fonct_id = $id");
            $success = 1;
        }else{
            $fail = ' verifier votre mot de passe';
        }
    }

    $select1 = mysql_query("select * from fonctionnaire where username = '$username'");
    while($data = mysql_fetch_array($select1)){
            $id = $data['fonct_id'];
            $name = $data['firstname']." ".$data['lastname'];
            $fname = $data['firstname'];
            $lname = $data['lastname'];
            $username = $data['username'];
            $email = $data['email'];
            $password = $data['password'];
            $designation = $data['designation'];
            $telephone = $data['telephone'];
            $grade = $data['grade'];
            $date_entre = $data['date_entre'];
    }
    $query = mysql_query("select basic_salary from grade where grade = $grade");
    $data = mysql_fetch_array($query);
    $basic_salary = $data['basic_salary'];
}


$cmp_msg = mysql_query("select * from message where fonct_id=$id and receiver='fonct' and del_from_fonct=0 and seen = 0");
$nbMsgNotSeen = mysql_num_rows($cmp_msg);

?>
<!doctype html>
<html lang="en">
<head>
    <title>PROFIL | SWAG</title>
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
                <li class="active">
                    <a href="profil.php">
                        <i class="ti-user"></i>
                        <p>Profil</p>
                    </a>
                </li>
                <li>
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
                    <a class="navbar-brand" href="#">Profil</a>
                </div>
                <?php
                include("../include/top-bar.php");
                ?>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-11">
                        <div class="card">
                            <div class="header">
                                <h4 class="title text-center">Modifier Profil</h4>
                            </div>
                            <div class="content row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="post">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Prénom :</label>
                                                <input type="text" name="fname" class="form-control border-input" placeholder="First name" value="<?php echo $fname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nom :</label>
                                                <input type="text" name="lname" class="form-control border-input" placeholder="Last name" value="<?php echo $lname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Username :</label>
                                                <input type="text" name="username" class="form-control border-input" placeholder="Username" value="<?php echo $username; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Telephone :</label>
                                                <input type="number" name="phone" maxlength="10" class="form-control border-input" placeholder="Phone number" value="<?php echo $telephone; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email :</label>
                                                <input type="email" name="email" class="form-control border-input" placeholder="Email" value="<?php echo $email; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Designation :</label>
                                                <input type="text" class="form-control border-input" disabled="" placeholder="Designation" value="<?php echo $designation; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Salaire de base :</label>
                                                <input type="text" class="form-control border-input" disabled="" placeholder="Salary" value="<?php echo $basic_salary.' $'; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date d'Embauche :</label>
                                                <input type="text" name="hire_d" class="form-control border-input" disabled placeholder="Hire Date" value="<?php echo $date_entre; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mot de passe :</label>
                                                <input type="password" name="pwd" class="form-control border-input" placeholder="Password">
                                            </div>
                                            <span class="help-block text-info">Si vous ne voulez pas changer le mot de passe laisser ces champs vides</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirmation de mot de passe :</label>
                                                <input type="password" name="confirm_pwd" class="form-control border-input" placeholder="Confirm password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-info btn-fill btn-wd">Modifier</button>
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
                message: " Profil bien modifié."

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

</body>


</html>

