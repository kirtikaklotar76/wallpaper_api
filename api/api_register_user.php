<?php

    header("Access-Control-Allow-Method: POST");
    header("Content-Type: application/json");

    include("../config/config.php");

    $config = new Config();
    $res = array();

    if($_SERVER['REQUEST_METHOD']== "POST"){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $record = $config->registerUser($name,$email,$password);

        $res['msg'] = $record ? "User Registered successfully!!" : "Something Went Wrong!!";

        echo json_encode($res);
    }
    else{
        $res['msg'] = "Only POST method is allowed...";
        echo json_encode($res);
    }


?>