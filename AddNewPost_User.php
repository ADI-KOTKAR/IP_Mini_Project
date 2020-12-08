<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_User_Login() ?>
<?php 
    if(isset($_POST["Submit"])){
        $Title = $Connection->real_escape_string($_POST["Title"]);
        $Category = $Connection->real_escape_string($_POST["Category"]);
        $Post = $Connection->real_escape_string($_POST["Post"]);

        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $Admin = $_SESSION["Username"];
        $Image = $_FILES["Image"]["name"]; 
        $Target = "uploads/".basename($_FILES["Image"]["name"]);

        if(empty($Title)){
            $_SESSION["ErrorMessage"]="Title cannot be Empty!";
            Redirect_to("AddNewPost_User.php");
            exit;
        } elseif(strlen($Title)<2){
            $_SESSION["ErrorMessage"]="Title should be atleast 2 characters long";
            Redirect_to("AddNewPost_User.php");
        } elseif(empty($Category)){
            $_SESSION["ErrorMessage"]="Category cannot be Empty!";
            Redirect_to("AddNewPost_User.php");
        } else{
            global $ConnectingDB;
            $Query = "INSERT INTO admin_panel(datetime,title,category,author,image,post)
                        VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
            $Execute = $Connection->query($Query);
            move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
            if($Execute){
                $_SESSION["SuccessMessage"] = "Post Added Successfully";
                Redirect_to("AddNewPost_User.php");
            } else{
                $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!";
                Redirect_to("AddNewPost_User.php");
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
    <title>TechVents | Add New Post</title>
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
                <li class="active"><a href="AddNewPost_User.php">
                    <span class="glyphicon glyphicon-list-alt"></span> &nbsp; Add New Post</a></li>
                <li><a href="ChangePassword.php">
                    <span class="glyphicon glyphicon-cog"></span> &nbsp; Change Password</a></li>
                <li><a href="Applause_User.php">
                    <img src="https://img.icons8.com/ios-filled/15/000000/applause.png" alt=""> &nbsp; Applauded Posts</a></li>
                <li><a href="Blog.php?Page=0">
                    <span class="glyphicon glyphicon-equalizer"></span> &nbsp; Live Blog</a></li>
                <li><a href="Logout.php">
                    <span class="glyphicon glyphicon-log-out"></span> &nbsp; Log Out</a></li>
            </ul>
        </div>
        <!-- Ending of Side area -->


        <!-- Main area -->
        <div class="col-sm-10" style="background: #ffffff;">
            <h1>Add New Post</h1>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            <div>
                <form action="AddNewPost_User.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Title:</span></label>
                            <input class="form-control " type="text" name="Title" id="title" placeholder="Title"><br>
                            <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
                            <div class="form-group">
                                <select class="form-control" name="Category" id="categoryselect">
                                    <?php
                                        global $ConnectingDB;
                                        $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
                                        $Execute = $Connection->query($ViewQuery);

                                        while($DataRows = $Execute->fetch_assoc()){
                                            $Id = $DataRows["id"];
                                            $CategoryName = $DataRows["name"];
                
                                    ?>
                                    <option><?php echo $CategoryName; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="imageSelect"><span class="FieldInfo">Select Image:</span></label>
                                <input type="file" class="form-control" name="Image" id="imageSelect">
                            </div>
                            <div class="form-group">
                                <label for="postarea"><span class="FieldInfo">Post:</span></label>
                                <textarea class="form-control" name="Post" id="post"></textarea>
                            </div>
                            <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Post"><br>
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

