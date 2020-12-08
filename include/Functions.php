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
        $Query = "SELECT * FROM registration WHERE username='$Username' ";
        $Execute = $Connection->query($Query);

        if($user = $Execute->fetch_assoc()){
            // print_r($admin);
            $PasswordCheck = password_verify($Password, $user['password']);
            if($PasswordCheck){ return $user; }
            else { return null; }
        } else {
            return null;
        }
    }

    function Login(){
        if(isset($_SESSION["User_Id"]) && $_SESSION["Role"] == "Admin"){
            return true;
        }
    }

    function Confirm_Login(){
        if(!Login()){
            $_SESSION["ErrorMessage"] = "Login Required";
            $_SESSION["User_Id"] = null;
            $_SESSION["Username"] = null;
            $_SESSION["Role"] = null;
            // session_destroy();
            Redirect_to("Login.php");
        }
    }

    function User_Login(){
        if(isset($_SESSION["User_Id"]) && $_SESSION["Role"] == "User"){
            return true;
        }
    }

    function Confirm_User_Login(){
        if(!User_Login()){
            $_SESSION["ErrorMessage"] = "Login Required";
            $_SESSION["User_Id"] = null;
            $_SESSION["Username"] = null;
            $_SESSION["Role"] = null;
            // session_destroy();
            Redirect_to("Login.php");
        }
    }

?>