<?php

class Config {

    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $db_name = "wallpaper_app";
    private $user_table = "users";
    private $wallpaper_table = "wallpapers";
    private $conn;

    public function __construct(){

    
        $this->conn = mysqli_connect($this-> host,$this-> username,$this->password,$this->db_name);

        if($this->conn){
            // echo "connected!!!";
        }
        else{
            echo "Not connected";
        }
    }

    public function registerUser($name,$email,$password){

        $query = "INSERT INTO $this->user_table(name,email,password) VALUES('$name','$email','$password')";
    
        $res = mysqli_query($this->conn,$query);
    
        return $res;
    }

    private function fetch_user_by_email($email){

        $query = "SELECT * FROM $this->user_table WHERE email='$email'";

        $user = mysqli_query($this->conn,$query);

        return $user;
    }

    public function logIn_user($email,$password){

        $user = $this->fetch_user_by_email($email);

        if(mysqli_num_rows($user)==1){
            $user_data = mysqli_fetch_assoc($user);

            $is_logged_in = password_verify($password,$user_data['password']);

            $data = array();

            if($is_logged_in){
                $data['user_data'] = json_encode($user_data);
            }
            else{
                $data['user_data'] = "Login failled!!";
            }
            return $data;
        }
        else{
            return "User doesn't exists!!";
        }
    }

    public function insert_wallpaper($name,$path){

        $query = "INSERT INTO $this->wallpaper_table(name,path) VALUES('$name','$path')";

        return mysqli_query($this->conn,$query);
    }

    public function get_wallpaper(){
        $query = "SELECT * FROM $this->wallpaper_table";
        
        return mysqli_query($this->conn,$query);
    }

}

?>