<?php
if(!isset($_COOKIE['auth'])){
        header("location: ../");
}

$username = $_COOKIE['auth'];
setcookie('auth', $username, time() + (60*60*4), '/'); // for 4 hours
setcookie('type', 'user', time() + (60*60*24), '/'); // for 1 day


$select = mysql_query("select * from user where username = '$username'");
while($data = mysql_fetch_array($select)){
        $id = $data['id'];
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $hire_d = $data['hire_date'];
        $level = $data['level_id'];
        $cin = $data['cin'];
        $designation = $data['designation'];
}
$select = mysql_query("select * from level where level_id = $level");
$data = mysql_fetch_array($select);
$salary = $data['salary'];
    
session_start();
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['designation'] = $designation;
$_SESSION['level'] = $level;
$_SESSION['email'] = $email;
$_SESSION['hire_d'] = $hire_d;
$_SESSION['salary'] = $salary;
$_SESSION['cin'] = $cin;

?>