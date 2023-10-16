<?php

header("Access-Control-Allowed-Method: GET");
header("Content-Type: application/json");

include("../config/config.php");

$res = array();

$config = new Config();

if($_SERVER['REQUEST_METHOD']== "GET"){

    $data = $config->get_wallpaper();

    $all_media = array();
    $res['data'] = array();

    while($record = mysqli_fetch_assoc($data)){
        array_push($all_media,$record['path']);
    }
    $res['data']=$all_media;
    $res['length'] = mysqli_num_rows($data);
    
    echo json_encode($res);
}
else{
    $res['msg'] = "Only GET method is allowed...";
}

?>