<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_User_Login() ?>
<?php 
    if(isset($_POST["Submit"])){
        $NewPassword = $Connection->real_escape_string($_POST["NewPassword"]);
        $ConfirmNewPassword = $Connection->real_escape_string($_POST["ConfirmNewPassword"]);

        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $UserId = $_SESSION["User_Id"];

        if(empty($NewPassword) || empty($ConfirmNewPassword)){
            $_SESSION["ErrorMessage"]="All fields must be filled out";
            Redirect_to("ChangePassword.php");
        } elseif(strlen($NewPassword)<4){
            $_SESSION["ErrorMessage"]="Maximum 4 Characters for Password";
            Redirect_to("ChangePassword.php");
        } elseif($NewPassword !== $ConfirmNewPassword){
            $_SESSION["ErrorMessage"]="Confirm New Password does not match.";
            Redirect_to("ChangePassword.php");
        } else {
            global $ConnectingDB;
            $HashNewPassword = password_hash($NewPassword, PASSWORD_BCRYPT);
            $Query = "UPDATE registration SET datetime='$DateTime', password='$HashNewPassword'
                        WHERE id='$UserId' ";
            $Execute = $Connection->query($Query);
            if($Execute){    
                $_SESSION["SuccessMessage"] = "Password Changed Successfully";
                Redirect_to("Logout.php");
            } else{
                $_SESSION["ErrorMessage"] = "Failed to Update Password";
                Redirect_to("ChangePassword.php");
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
    <title>TechVents | Edit Post</title>
    <link rel="stylesheet" href="css/adminStyles.css">
</head>

<style>
    body {
        background: #f5f5f5;
    }
    .FieldInfo {
        color: rgb(251, 174, 44);
        font-family: Bitter,Georgia,"Times New Roman",Times,serif;
        font-size: 1.2rem;
    }
</style>

<body>

<!-- Main Container -->
<div class="container-fluid">
    <!--Row-->
    <div class="row">

        <!-- Side Area -->
        <div class="col-sm-2" style="background: #f5f5f5;">
        <br>
        <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                <li><a href="dashboard_user.php">
                    <span class="glyphicon glyphicon-th"></span> Dashboard</a></li>
                <li><a href="AddNewPost_User.php">
                    <span class="glyphicon glyphicon-list-alt"></span> &nbsp; Add New Post</a></li>
                <li class="active"><a href="ChangePassword.php">
                    <span class="glyphicon glyphicon-cog"></span> &nbsp; Change Password</a></li>
                <li><a href="Blog.php?Page=0">
                    <span class="glyphicon glyphicon-equalizer"></span> &nbsp; Live Blog</a></li>
                <li><a href="Logout.php">
                    <span class="glyphicon glyphicon-log-out"></span> &nbsp; Log Out</a></li>
            </ul>
        </div>
        <!-- Ending of Side area -->


        <!-- Main area -->
        <div class="col-sm-10" style="background: #ffffff;">
            <h1>Change Password</h1>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            <div>
                <form action="ChangePassword.php" method="post" >
                    <fieldset>
                        <div class="form-group">
                            <label for="newpassword"><span class="FieldInfo">New Password:</span></label>
                            <input  class="form-control " type="password" name="NewPassword" id="newpassword" placeholder="New Password"><br>
                            
                            <label for="confirmnewpassword"><span class="FieldInfo">Confirm New Password:</span></label>
                            <input  class="form-control " type="password" name="ConfirmNewPassword" id="confirmnewpassword" placeholder="Confirm New Password"><br>
                            
                            <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update Password"><br>
                        </div>
                    </fieldset>
                </form>
            </div>
                    
        </div>
        <!-- Ending of Main area -->

    </div>
    <!-- Ending of row -->

</div>
<!-- Ending of Container -->


<!-- Footer -->
<div id="Footer">
    <hr>
    <p>Theme By | TechVents | &copy;2020 --- All Rights reserved.</p>
    <a href="" style="color: white; text-decoration: none; cursor: pointer; font-weight: bold"></a>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti veritatis doloribus dolores esse eius? Ad, qui facere. Magni, aliquam in?
    </p>
</div>
<div style="height: 10px; background: #27AAF1"></div>

</body>
</html>

