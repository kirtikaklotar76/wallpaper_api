<?php

    header("Access-Control-Allow-Method: POST");
    header("Content-Type: application/json");

    include("../config/config.php");

    $config = new Config();
    $res = array();

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $res['msg'] = $config-> logIn_user($email,$password);
        
    }
    else{
        $res['msg'] = "Only POST method is allowed!!";
    }

    echo json_encode($res);
?>