<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
    if(isset($_SESSION["Username"])){
        $_SESSION["ErrorMessage"] = "Already in a Session. Please Logout!";
        Redirect_to("Blog.php");
    }
?>
<?php 
    if(isset($_POST["Submit"])){
        $Username = $Connection->real_escape_string($_POST["Username"]);
        $Password = $Connection->real_escape_string($_POST["Password"]);
        $ConfirmPassword = $Connection->real_escape_string($_POST["ConfirmPassword"]);
        
        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $Admin = "Aditya Kotkar";

        if(empty($Username) || empty($Password) || empty($ConfirmPassword)){
            $_SESSION["ErrorMessage"]="All fields must be filled out";
            Redirect_to("Signup.php");
        } elseif(strlen($Password)<4){
            $_SESSION["ErrorMessage"]="Maximum 4 Characters for Password";
            Redirect_to("Signup.php");
        } elseif($Password !== $ConfirmPassword){
            $_SESSION["ErrorMessage"]="Confirm Password does not match.";
            Redirect_to("Signup.php");
        } else {
            global $ConnectingDB;
            $HashPassword = password_hash($Password, PASSWORD_BCRYPT);
            $Query = "INSERT INTO registration(datetime,addedby,username,password,role)
                        VALUES('$DateTime','$Admin','$Username','$HashPassword','User')";
            $Execute = $Connection->query($Query);
            if($Execute){    
                $Found_Account = Login_Attempt($Username, $HashPassword);
                $_SESSION["User_Id"] = $Found_Account["id"];
                $_SESSION["Username"] = $Found_Account["username"];
                $_SESSION["Role"] = $Found_Account["role"];
                $_SESSION["SuccessMessage"] = "User Added Successfully";
                Redirect_to("dashboard_user.php");
            } else{
                $_SESSION["ErrorMessage"] = "Failed to add User";
                Redirect_to("Signup.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Register</title>
    <link rel="stylesheet" href="css/adminStyles.css">
</head>

<style>
    body {
        background: #ffffff;
    }
    .FieldInfo {
        color: rgb(251, 174, 44);
        font-family: Bitter,Georgia,"Times New Roman",Times,serif;
        font-size: 1.2rem;
    }
</style>

<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse" role="navigation" style="background:#ffffff; border:0; margin:0">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" style="background:black;" data-toggle="collapse" data-target="#collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="Blog.php">
                <img src="images/Techvents-text-removebg-preview.png" width=150 height=35 alt="" style="">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="collapse">
            
        </div>
    </div>
    <br>
</nav>

<!-- Ending of Navbar -->


<!-- Main Container -->
<div class="container-fluid">

    <!--Row-->
    <div class="row">

        <!-- Main area -->
        <div class="col-sm-4 col-sm-offset-4" style="background:#ffffff;">
        <br><br><br><br>
            <h2>Welcome To TechVents</h2>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            <div>
                <form action="Signup.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="username"><span class="FieldInfo">Username:</span></label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input class="form-control " type="text" name="Username" id="username" placeholder="Username"><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="FieldInfo">Password:</span></label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input class="form-control " type="password" name="Password" id="password" placeholder="Password"><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="FieldInfo">Confirm Password:</span></label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input class="form-control " type="password" name="ConfirmPassword" id="confirmpassword" placeholder="Confirm Password"><br>
                            </div>
                        </div>
                        <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Register"><br>
                    </fieldset>
                </form>
            </div>
            
            </div>
        </div>
        <!-- Ending of Main area -->

    </div>
    <!-- Ending of row -->

</div>
<!-- Ending of Container -->



</body>
</html>

