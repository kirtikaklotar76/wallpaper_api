<?php

    header("Access-Control-Allowed-Method: POST");
    header("Content-Type: application/json");

    include("../config/config.php");

    $res = array();
    $config = new Config();

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $data = $_FILES;

        $name = $data['name']['name'];
        $path = $data['name']['tmp_name'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        $destination = "../upload/" . uniqid("img-"). $name;

        if($id == "admin@gmail.com" && $password == "admin@123"){
            $uploaded = move_uploaded_file($path,$destination);

            if($uploaded){

                $config->insert_wallpaper($name,$destination);

                $res['msg'] = "wallpaper successfully uploaded..";
            
            }else{
                $res['msg'] = "failled to upload..";
            
            }
        } else{
            $res['msg'] ="Wrong admin Userid and password..";
        }
    }else{

        $res['msg'] = "Only POST method is allowed...";
    }
    
    echo json_encode($res);

?>