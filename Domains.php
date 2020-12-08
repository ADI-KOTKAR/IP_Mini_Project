<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_User_Login() ?>
<?php 
    function Logout_User(){
        $_SESSION["User_Id"] = null;
        $_SESSION["Username"] = null;
        $_SESSION["Role"] = null;
        session_destroy();
        Redirect_to("Signup.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Select Domains</title>
</head>
<body>
    <a href="Logout_User.php">Logout</a>
    <?php echo SuccessMessage(); echo Message(); ?>
</body>
</html>