<?php
    include 'configDB.php';
    include 'connect.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {
        $loginDB = new connectionToDB();
        $loginDB->connect($database, $host, $port, $user, $password);
        
        if (isset($_POST["username"]) && isset($_POST["pass"])){
            $username = $_POST["username"];
            $pass = md5($_POST["pass"]);
            $stateLogin = $loginDB->verifyLogin($username,$pass);
            if ($stateLogin==1){
                echo "<script>alert('Login realizado');window.location.href='http://localhost:8080/pageForUsersLog/index.html';</script>";
            }else{
                echo "<script>alert('Usuario não encontrado');window.location.href='http://localhost:8080/pageForUsersLog/index.html';</script>";
            }
        }
    }


?> 