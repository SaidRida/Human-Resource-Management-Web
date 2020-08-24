<?php
if(!isset($_COOKIE['auth'])){
        header("location: ../");
}

$username = $_COOKIE['auth'];
setcookie('auth', $username, time() + (60*60*4), '/'); // for 4 hours
setcookie('type', 'fonctionnaire', time() + (60*60*24), '/'); // for 1 day


$select = mysql_query("select * from fonctionnaire where username = '$username'");
while($data = mysql_fetch_array($select)){
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
    
session_start();
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['email'] = $email;
$_SESSION['designation'] = $designation;
$_SESSION['telephone'] = $telephone;
$_SESSION['grade'] = $grade;
$_SESSION['date_entre'] = $date_entre;
$_SESSION['basic_salary'] = $basic_salary;

?>