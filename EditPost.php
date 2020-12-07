<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login() ?>
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
            Redirect_to("AddNewPost.php");
            exit;
        } elseif(strlen($Title)<2){
            $_SESSION["ErrorMessage"]="Title should be atleast 2 characters long";
            Redirect_to("AddNewPost.php");
        } elseif(empty($Category)){
            $_SESSION["ErrorMessage"]="Category cannot be Empty!";
            Redirect_to("AddNewPost.php");
        } else{
            global $ConnectingDB;
            $EditFromURL = $_GET["Edit"];
            $Query = "UPDATE admin_panel SET datetime='$DateTime', title='$Title', 
                        category='$Category', author='$Admin', image='$Image', post='$Post'
                        WHERE id='$EditFromURL' ";
            $Execute = $Connection->query($Query);
            move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
            if($Execute){
                $_SESSION["SuccessMessage"] = "Post Updated Successfully";
                Redirect_to("dashboard.php");
            } else{
                $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!";
                Redirect_to("dashboard.php");
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
            <ul class="nav navbar-nav">
                <li><a href="">Home</a></li>
                <li><a href="Blog.php" target="blank">Blog</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact Us</a></li>
                <li><a href="">Features</a></li>
            </ul>
            <form action="Blog.php" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="Search">
                </div>
                <button class="btn btn-default" name="SearchButton">Go</button>
            </form>
        </div>
    </div>
    <br>
</nav>

<!-- Ending of Navbar -->




<!-- Main Container -->
<div class="container-fluid">

    <!--Row-->
    <div class="row">

        <!-- Side Area -->
        <div class="col-sm-2" style="background: #f5f5f5;">
        <br>
            <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                <li class="active"><a href="Dashboard.php">
                    <span class="glyphicon glyphicon-th"></span> Dashboard</a></li>
                <li><a class="active" href="AddNewPost.php">
                    <span class="glyphicon glyphicon-list-alt"></span> &nbsp; Add New Post</a></li>
                <li><a href="Categories.php">
                    <span class="glyphicon glyphicon-tags"></span> &nbsp; Categoreies</a></li>
                <li><a href="Admins.php">
                    <span class="glyphicon glyphicon-user"></span> &nbsp; Manage Admins</a></li>
                <li><a href="Comments.php">
                    <span class="glyphicon glyphicon-comment"></span> &nbsp; Comments
                    <?php
                        $ConnectingDB;

                        $QueryDisApproved = "SELECT COUNT(*) from comments WHERE status='OFF' ";
                        $ExecuteDisApproved = $Connection->query($QueryDisApproved);

                        $RowsDisApproved = $ExecuteDisApproved->fetch_assoc();
                        $TotalDisApproved = array_shift($RowsDisApproved);

                        if($TotalDisApproved){
                    ?>
                    <span class="label label-warning pull-right">
                        <?php echo $TotalDisApproved;?>
                    </span>
                    <?php } ?>    
                </a></li>
                <li><a href="">
                    <span class="glyphicon glyphicon-equalizer"></span> &nbsp; Live Blog</a></li>
                <li><a href="Logout.php">
                    <span class="glyphicon glyphicon-log-out"></span> &nbsp; Log Out</a></li>
            </ul>
        </div>
        <!-- Ending of Side area -->


        <!-- Main area -->
        <div class="col-sm-10" style="background: #ffffff;">
            <h1>Update Post</h1>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            <div>
                <?php 
                    $SearchQueryParameter = $_GET["Edit"];
                    $ConnectingDB;
                    $Query = "SELECT * FROM admin_panel WHERE id='$SearchQueryParameter' ";
                    $ExecuteQuery = $Connection->query($Query);

                    while($DataRows = $ExecuteQuery->fetch_assoc()){
                        $TitleToBeUpdated = $DataRows["title"];
                        $CategoryToBeUpdated = $DataRows["category"];
                        $ImageToBeUpdated = $DataRows["image"];
                        $PostToBeUpdated = $DataRows["post"];
                    }
                ?>
                <form action="EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Title:</span></label>
                            <input value="<?php echo $TitleToBeUpdated; ?>" class="form-control " type="text" name="Title" id="title" placeholder="Title"><br>
                            <span class="FieldInfo">Existing Category: </span>
                            <?php echo $CategoryToBeUpdated; ?> <br>
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
                                <span class="FieldInfo">Existing Image: </span>
                                <img src="uploads/<?php echo $ImageToBeUpdated; ?>" width="150px" height="70px"> <br>
                                <label for="imageSelect"><span class="FieldInfo">Select Image:</span></label>
                                <input type="file" class="form-control" name="Image" id="imageSelect">
                            </div>
                            <div class="form-group">
                                <label for="postarea"><span class="FieldInfo">Post:</span></label>
                                <textarea class="form-control" name="Post" id="post">
                                    <?php echo $PostToBeUpdated; ?>
                                </textarea>
                            </div>
                            <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update Post"><br>
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

