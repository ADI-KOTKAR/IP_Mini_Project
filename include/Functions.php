<?php require_once(__DIR__."\DB.php"); ?>
<?php require_once(__DIR__."\Sessions.php"); ?>
<?php
    function Redirect_to($New_Location){
        header("Location:".$New_Location);
        exit;
    }

    function Login_Attempt($Username, $Password){
        global $ConnectingDB;
        global $Connection;
        $Query = "SELECT * FROM registration WHERE username='$Username' AND password='$Password' ";
        $Execute = $Connection->query($Query);

        if($admin = $Execute->fetch_assoc()){
            // print_r($admin);
            return $admin;
        } else {
            return null;
        }
    }

    function Login(){
        if(isset($_SESSION["User_Id"])){
            return true;
        }
    }

    function Confirm_Login(){
        if(!Login()){
            $_SESSION["ErrorMessage"] = "Login Required";
            Redirect_to("Login.php");
        }
    }

    Login_Attempt('Shreyas', '12345');
?>