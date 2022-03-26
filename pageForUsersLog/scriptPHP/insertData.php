<?php
    include 'configDB.php';
    include 'connect.php';

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {
        $connectionDB = new connectionToDB();
        $connectionDB->connect($database, $host, $port, $user, $password);

    if (isset($_POST["username"]) && isset($_POST["pass"]) && isset($_POST["email"]) && isset($_POST["phone"])) {
        $username = $_POST["username"];
        $pass = md5($_POST["pass"]);
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $connectionDB->insertData($username, $pass, $email, $phone);
    }
}   
