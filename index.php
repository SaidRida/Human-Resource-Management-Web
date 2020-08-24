<?php
include("include/db.php");
if(isset($_COOKIE['auth'])){
    header("location: ".$_COOKIE['type']."/dashboard.php");
}
$error = '';

if(isset($_POST['submit'])){
    $username = htmlentities(trim($_POST['username']));
    $password = md5(htmlentities(trim($_POST['password'])));

    $auth = '';

    $query = mysql_query("select * from fonctionnaire where username = '$username'");
    $rows = mysql_num_rows($query);
    if($rows){
        $auth = 'fonctionnaire';
    }
    if($auth){
        $data = mysql_fetch_array($query);
        if($password != $data['password']){
            $error = ' check your password';
        }else{
            $id = $data['id'];
            setcookie('auth', $username, time() + (60*60*4), '/'); // for 4 hours
            setcookie('type', $auth, time() + (60*60*24), '/'); // for 1 day

            header("location: ".$auth."/dashboard.php");
            echo $auth;
        }
    }else{
        $error = " check your username/password";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>W&exist;LCOME</title>
        <link rel="icon" type="image/x-icon" href="images/logo-swag.jpg" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="data/w3.css" />
        <link rel="stylesheet" href="data/style.css" />
        <script src="data/jquery-2.2.4.min.js"></script>
        <style type="text/css">
            #logo{
                width: 100%;
                height: 100%;
                padding: 0;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="w3-image w3-animate-opacity">
            <img src="images/bg_user.jpg" alt="Background" style="width:100%;min-height:550px;max-height:700px;" />
        </div>
        <div id="myDiv" class="w3-container w3-animate-top">
            <?php
                if($error){
            ?>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo "<strong>Accés non disponible !</strong>".$error; ?>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            <div class="w3-row">
                <div class="w3-card-8 w3-theme-d4">
                    <header class="w3-container w3-light-grey" id="header">
                        <!-- <div class="logodiv">
                            <img src="images/logo-swag.jpg" alt="logo" id="logo"/>
                        </div>
                        <div style="">
                            <h3>Ministere d'Economie et de Finance</h3>
                        </div> -->
                        <div class="thumbnail" style="margin: -0.01em -16px;">
                            <img src="images/swag.jpg" id="logo">
                        </div>
                    </header>
                    <form method="post" class="w3-form">
                        <div class="w3-input-group">
                            <input class="w3-input" type="text" name="username" id="username" required/>
                            <label class="w3-label w3-validate" for="username">Userame</label>                    
                        </div>
                        <div class="w3-input-group">
                            <input class="w3-input" type="password" name="password" id="password" required/>
                            <label class="w3-label w3-validate" for="password">Password</label>                
                        </div>
                        <br />
                        <center>
                        <div class="w3-input-group">
                            <input class="w3-btn w3-teal" type="submit" name="submit" id="submit" value="Sign In"/>
                        </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>