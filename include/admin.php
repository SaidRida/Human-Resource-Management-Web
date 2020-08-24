<?php

$id = $_COOKIE['user'];
setcookie('user', $id, time() + (60*60), '/'); // for 1 hour
setcookie('type', 'admin', time() + (60*60*24), '/'); // for 1 day


$select = mysql_query("SELECT * FROM admin WHERE ID='$id'");
while($donnees = mysql_fetch_array($select)){
        $id = $donnees['ID'];
        $login = $donnees['LOGIN'];
        $fname = $donnees['FIRST_NAME'];
        $lname = $donnees['LAST_NAME'];
        $email = $donnees['EMAIL'];
        $password = $donnees['PASSWORD'];
        $date_e = $donnees['DATE_EMBAUCHE'];
        $date_n = $donnees['DATE_NAISSANCE'];
        $city = $donnees['CITY'];
        $phone = $donnees['PHONE'];
        $cin = $donnees['CIN'];
}
    
session_start();
$_SESSION['id'] = $id;
$_SESSION['fname'] = $fname;
$_SESSION['lname'] = $lname;
$_SESSION['login'] = $login;
$_SESSION['password'] = $password;
$_SESSION['email'] = $email;
$_SESSION['date_e'] = $date_e;
$_SESSION['date_n'] = $date_n;
$_SESSION['city'] = $city;
$_SESSION['phone'] = $phone;
$_SESSION['cin'] = $cin;
$_SESSION['type'] = 'admin';
?>