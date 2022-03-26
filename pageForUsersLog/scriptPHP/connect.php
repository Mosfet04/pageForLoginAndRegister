<?php

class connectionToDB
{
    private $conn;
    private $row;

    public function connect($database, $host, $port, $user, $password)
    {

        try {
            $this->conn = new PDO("mysql:dbname=$database;host=$host;port=$port", $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertData($username, $pass, $email, $phone)
    {
        $this->row = $this->conn->query("SELECT username FROM users WHERE username = '$username'")->fetchAll();
        if (!isset($this->row[0]['username'])) {
            $this->row = $this->conn->query("SELECT email FROM users WHERE email = '$email'")->fetchAll();
            if (!isset($this->row[0]['email'])) {
                try {
                    $sql = "INSERT INTO `users` (`username`,`pass`,`email`,`phoneNumber`) VALUES ('$username', '$pass','$email','$phone')";
                    $this->conn->exec($sql);
                    echo "<script>alert('Cadastro realizado com sucesso');window.location.href='http://localhost:8080/pageForUsersLog/index.html';</script>";
                } catch (Exception $e) {
                    echo 'Faça a conexão primeiro';
                }
            } else {
                echo "<script>alert('Email já cadastrado');window.location.href='http://localhost:8080/pageForUsersLog/cadastro.html';</script>";
            }
        } else {
            echo "<script>alert('Nome de usuario já cadastrado');window.location.href='http://localhost:8080/pageForUsersLog/cadastro.html';</script>";
        }
    }

    public function verifyLogin($username, $pass)
    {
        $this->row = $this->conn->query("SELECT username FROM users WHERE username = '$username' AND pass = '$pass'")->fetchAll();
        if (!isset($this->row[0]['username'])) {
            return 1;
        } else {
            return 0;
        }
    }

}


