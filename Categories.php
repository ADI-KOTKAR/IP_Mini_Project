<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login() ?>
<?php 
    if(isset($_POST["Submit"])){
        $Category = $Connection->real_escape_string($_POST["Category"]);
        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $Admin = $_SESSION["Username"];
        
        if(empty($Category)){
            $_SESSION["ErrorMessage"]="All fields must be filled out";
            Redirect_to("Categories.php");
            exit;
        } elseif(strlen($Category)>99){
            $_SESSION["ErrorMessage"]="Too long Name for Category";
            Redirect_to("Categories.php");
        } else{
            global $ConnectingDB;
            $Query = "INSERT INTO category(datetime,name,creatorname)
                        VALUES('$DateTime','$Category','$Admin')";
            $Execute = $Connection->query($Query);
            if($Execute){
                $_SESSION["SuccessMessage"] = "Category Added Successfully";
                Redirect_to("Categories.php");
            } else{
                $_SESSION["ErrorMessage"] = "Failed to add Category";
                Redirect_to("Categories.php");
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
    <title>TechVents | Add Category</title>
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
                <li><a href="Dashboard.php">
                    <span class="glyphicon glyphicon-th"></span> Dashboard</a></li>
                <li><a href="AddNewPost.php">
                    <span class="glyphicon glyphicon-list-alt"></span> &nbsp; Add New Post</a></li>
                <li class="active"><a href="Categories.php">
                    <span class="glyphicon glyphicon-tags"></span> &nbsp; Categories</a></li>
                <li><a href="Admins.php">
                    <span class="glyphicon glyphicon-user"></span> &nbsp; Manage Admins</a></li>
                <li><a href="Applause.php">
                    <img src="https://img.icons8.com/ios-filled/15/000000/applause.png" alt=""> &nbsp; Applauded Posts</a></li>
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
                <li><a href="Blog.php?Page=0" target="_blank">
                    <span class="glyphicon glyphicon-equalizer"></span> &nbsp; Live Blog</a></li>
                <li><a href="Logout.php">
                    <span class="glyphicon glyphicon-log-out"></span> &nbsp; Log Out</a></li>
            </ul>
        </div>
        <!-- Ending of Side area -->


        <!-- Main area -->
        <div class="col-sm-10" style="background:#ffffff;">
            <h1>Manage Categories</h1>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            <div>
                <form action="Categories.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="categoryname"><span class="FieldInfo">Name:</span></label>
                            <input class="form-control " type="text" name="Category" id="categoryname" placeholder="Name"><br>
                            <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category"><br>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Sr No.</th>
                        <th>Date & Time</th>
                        <th>Category Name</th>
                        <th>Creator Name</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        global $ConnectingDB;
                        $ViewQuery = "SELECT * FROM category ORDER BY id desc";
                        $Execute = $Connection->query($ViewQuery);
                        $SrNo = 0;

                        while($DataRows = $Execute->fetch_assoc()){
                            $Id = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $Name = $DataRows["name"];
                            $CreatorName = $DataRows["creatorname"];
                            $SrNo++;
                    ?>
                    <tr>
                        <td><?php echo $SrNo; ?></td>
                        <td><?php echo $DateTime; ?></td>
                        <td><?php echo $Name; ?></td>
                        <td><?php echo $CreatorName; ?></td>
                        <td>
                            <a href="DeleteCategory.php?id=<?php echo $Id; ?>">
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

