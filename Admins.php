<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login() ?>
<?php 
    if(isset($_POST["Submit"])){
        $Username = $Connection->real_escape_string($_POST["Username"]);
        $Password = $Connection->real_escape_string($_POST["Password"]);
        $ConfirmPassword = $Connection->real_escape_string($_POST["ConfirmPassword"]);
        
        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $Admin = $_SESSION["Username"];
        
        if(empty($Username) || empty($Password) || empty($ConfirmPassword)){
            $_SESSION["ErrorMessage"]="All fields must be filled out";
            Redirect_to("Admins.php");
        } elseif(strlen($Password)<4){
            $_SESSION["ErrorMessage"]="Maximum 4 Characters for Password";
            Redirect_to("Admins.php");
        } elseif($Password !== $ConfirmPassword){
            $_SESSION["ErrorMessage"]="Confirm Password does not match.";
            Redirect_to("Admins.php");
        } else{
            global $ConnectingDB;
            $Query = "INSERT INTO registration(datetime,addedby,username,password)
                        VALUES('$DateTime','$Admin','$Username','$Password')";
            $Execute = $Connection->query($Query);
            if($Execute){
                $_SESSION["SuccessMessage"] = "Admin Added Successfully";
                Redirect_to("Admins.php");
            } else{
                $_SESSION["ErrorMessage"] = "Failed to add Admin";
                Redirect_to("Admins.php");
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
                <li><a href="Dashboard.php">
                    <span class="glyphicon glyphicon-th"></span> Dashboard</a></li>
                <li><a href="AddNewPost.php">
                    <span class="glyphicon glyphicon-list-alt"></span> &nbsp; Add New Post</a></li>
                <li><a href="Categories.php">
                    <span class="glyphicon glyphicon-tags"></span> &nbsp; Categories</a></li>
                <li class="active"><a href="Admins.php">
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
        <div class="col-sm-10" style="background:#ffffff;">
            <h1>Manage Admin Access</h1>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            <div>
                <form action="Admins.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="username"><span class="FieldInfo">Username:</span></label>
                            <input class="form-control " type="text" name="Username" id="username" placeholder="Username"><br>
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="FieldInfo">Password:</span></label>
                            <input class="form-control " type="password" name="Password" id="password" placeholder="Password"><br>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword"><span class="FieldInfo">Confirm Password:</span></label>
                            <input class="form-control " type="password" name="ConfirmPassword" id="confirmpassword" placeholder="Confirm Password"><br>
                        </div>
                        <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Admin"><br>
                    </fieldset>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Sr No.</th>
                        <th>Date & Time</th>
                        <th>Admin Nam</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        global $ConnectingDB;
                        $ViewQuery = "SELECT * FROM registration ORDER BY id desc";
                        $Execute = $Connection->query($ViewQuery);
                        $SrNo = 0;

                        while($DataRows = $Execute->fetch_assoc()){
                            $Id = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $Name = $DataRows["username"];
                            $CreatorName = $DataRows["addedby"];
                            $SrNo++;
                    ?>
                    <tr>
                        <td><?php echo $SrNo; ?></td>
                        <td><?php echo $DateTime; ?></td>
                        <td><?php echo $Name; ?></td>
                        <td><?php echo $CreatorName; ?></td>
                        <td>
                            <a href="DeleteAdmin.php?id=<?php echo $Id; ?>">
                                <span class="btn btn-danger">Delete</span>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
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

