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
    <script src="https://kit.fontawesome.com/6d9f81a281.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Change Password</title>
</head>

<body>

<!-- Sidebar -->
<div class="mid">
    <div class="sidebar">
        <a href="dashboard_user.php"><i class="fas fa-th"></i> Dashboard</a>
        <a href="AddNewPost_User.php"><i class="fas fa-list-alt"></i> Add New Post</a>
        <a class="active" href="ChangePassword.php"><i class="fas fa-key"></i> Change Password</a>
        <a href="Applause_User.php"><i class="fas fa-sign-language"></i> Applauded Posts</a>
        <a href="Blog.php"><i class="fab fa-slack"></i> Live Blog</a>
        <a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="topp">
    <div class="content">
        <h2>Change Password</h2>
        <?php echo Message(); echo SuccessMessage(); ?>
        <form action="ChangePassword.php" method="post">
            <fieldset>
                <h4>New Password</h4>
                <input  type="password" name="NewPassword" id="New Password" placeholder="New Password">
                <h4>Confirm New Password</h4>
                <input  type="password" name="ConfirmNewPassword" id="Confirm Password" placeholder="Confirm New Password">
                <input id="Submit" type="Submit" name="Submit" value="Update Password">
            </fieldset>
        </form>
    </div>
</div>


</body>
</html>


<!-- CSS -->
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}
.mid{
    padding-top: 2px;
}
.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: absolute;
  height: 80%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #2ECC71;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: auto;
  margin-bottom: 140px;

}
h2{
    font-weight: 500;
    font-size: 30px;
}
input{
    height:30px;
    width:99%;
    margin-top: 6px;
    margin-bottom: 20px;
    text-indent: 2px;
}
h4{
    color: #2ECC71;
    margin:0;
}
#Submit{
    color: white;
    background-color: #2ECC71;
    border: none;
    border-radius: 30px;
    padding-bottom: 20px;
    text-align: center;
    padding-top: 8px;
    font-size: 15px;
}
#Submit:hover{
    background-color: #40822e;
}

footer{
  display:flex;
  width:100%;
  background-color:#3d3d3d;
  position: absolute;
  height:fit-content;
  margin-top: 80px;
  justify-content: center;
}

footer img{
  height:60px;
  width: 60px;
  margin-right: 10px;
  margin-top: 8px;
  float: left;
}
.ft{
  width: 90%;
}
footer h2{
  font-size: 180%;
  margin-top: 30px;
}
.txt{
  width:30%;
  display: inline-block;
  margin-right: 20px;
  margin-top: 0;
  margin-bottom: 10px;
  height: 130px;
}
.txt p{
  color:#f1f1f1;
  margin: 0;
}
.last_line{
  margin-top: 10px;
}
.last_line p{
  color:white;
  font-size: 22px;
  display: inline-block;
  margin-top: 27px;
}
.cpy{
  float:right;
  margin-right: 70px;
}
hr{
  margin-top: 30px;
  border-bottom: none;
}
@media screen and (max-width: 800px){
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
  
  footer{
    height:80px;
    margin-top: 10px;
  }
  div.txt, hr
    {
      display: none;
    }
  .last_line p{
    font-size: 15px;
  }
  .last_line{
    margin-top: 10px;
  }
  div.content{
    margin-bottom: 10px;
  }
  footer img{
    height: 30px;
    width:30px;
    margin-top: 20px;
  }
  .cpy{
    margin-right: 10px;
  } 
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: left;
    float: none;
  }
  
  footer{
    height:70px;
    margin-top: 10px;
  }
  div.txt, hr
    {
      display: none;
    }
  .last_line p{
    font-size: 15px;
  }
  .last_line{
    margin-top: 0px;
  }
  div.content{
    margin-bottom: 10px;
  }
  footer img{
    height: 30px;
    width:30px;
    margin-top: 20px;
  }
  .cpy{
    margin-right: 10px;
  }
}
</style>
