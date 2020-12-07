<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php 
    if(isset($_POST["Submit"])){
        $Username = $Connection->real_escape_string($_POST["Username"]);
        $Password = $Connection->real_escape_string($_POST["Password"]);
        
        if(empty($Username) || empty($Password)){
            $_SESSION["ErrorMessage"]="All fields must be filled out";
            Redirect_to("Login.php");
        } else {
            $Found_Account = Login_Attempt($Username, $Password);
            $_SESSION["User_Id"] = $Found_Account["id"];
            $_SESSION["Username"] = $Found_Account["username"];
            if($Found_Account){
                $_SESSION["SuccessMessage"] = "Welcome Back {$_SESSION["Username"]}!";
                Redirect_to("dashboard.php");
            } else {
               $_SESSION["ErrorMessage"] = "Invalid Credentials";
               Redirect_to("Login.php");
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
    <title>TechVents | Manage Admins</title>
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
            <h2>Welcome Back</h2>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            <div>
                <form action="Login.php" method="post">
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
                        <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Admin"><br>
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

