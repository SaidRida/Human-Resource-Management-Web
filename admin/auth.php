<?php
if(!isset($_COOKIE['auth'])){
        header("location: ../");
}

$username = $_COOKIE['auth'];
setcookie('auth', $username, time() + (60*60*4), '/'); // for 4 hours
setcookie('type', 'admin', time() + (60*60*24), '/'); // for 1 day


$select = mysql_query("select * from admin where username = '$username'");
while($data = mysql_fetch_array($select)){
        $id = $data['admin_id'];
        $name = $data['firstname']." ".$data['lastname'];
        $fname = $data['firstname'];
        $lname = $data['lastname'];
        $username = $data['username'];
        $designation = $data['designation'];
        $email = $data['email'];
        $telephone = $data['telephone'];
        $password = $data['password'];
    
}

    
session_start();
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
$_SESSION['fname'] = $fname;
$_SESSION['lname'] = $lname;
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['email'] = $email;
$_SESSION['designation'] = $designation;
$_SESSION['telephone'] = $telephone;


?>