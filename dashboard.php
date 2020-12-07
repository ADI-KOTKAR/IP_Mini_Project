<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>
<?php Confirm_Login() ?>
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
    <title>TechVents | Admin Panel</title>
    <link rel="stylesheet" href="css/adminStyles.css">
</head>
<body style="background:#f5f5f5;">

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
                <li><a href="Blog.php?Page=1" target="blank">Blog</a></li>
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
                <li><a href="AddNewPost.php">
                    <span class="glyphicon glyphicon-list-alt"></span> &nbsp; Add New Post</a></li>
                <li><a href="Categories.php">
                    <span class="glyphicon glyphicon-tags"></span> &nbsp; Categories</a></li>
                <li><a href="Admins.php">
                    <span class="glyphicon glyphicon-user"></span> &nbsp; Manage Admins</a></li>
                <li><a href="Comments.php">
                    <span class="glyphicon glyphicon-comment"></span> 
                    &nbsp; Comments
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
            <h1>Admin Dashboard</h1>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            <div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Post Title</th>
                        <th>Date & Time</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Banner</th>
                        <th>Comments</th>
                        <th>Action</th>
                        <th>Details</th>
                    </tr>
                    <?php
                        global $ConnectingDB;
                        $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc";
                        $Execute = $Connection->query($ViewQuery);
                        $SrNo = 0;
                        
                        while($DataRows = $Execute->fetch_assoc()){
                            $Id = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $Title = $DataRows["title"];
                            $Category = $DataRows["category"];
                            $Admin = $DataRows["author"];
                            $Image = $DataRows["image"];
                            $Post = $DataRows["post"];
                            $SrNo++;
                    ?>
                    <tr>
                        <td><?php echo $SrNo; ?></td>
                        <td style="color: blue;">
                            <?php 
                                if(strlen($Title)>20){ $Title = substr($Title,0,20).".."; };
                                echo $Title; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                if(strlen($DateTime)>20){ $DateTime = substr($DateTime,0,11).".."; };
                                echo $DateTime; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                if(strlen($Admin)>20){ $Admin = substr($Admin,0,6).".."; };
                                echo $Admin; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                if(strlen($Category)>9){ $Category = substr($Category,0,8).".."; };
                                echo $Category; 
                            ?>
                        </td>
                        <td><img src="uploads/<?php echo $Image; ?>" alt="" width="150px" height="50px"></td>
                        <td>
                            <?php
                                $ConnectingDB;
                                $QueryApproved = "SELECT COUNT(*) from comments WHERE admin_panel_id='$Id' AND status='ON' ";
                                $ExecuteApproved = $Connection->query($QueryApproved);

                                $QueryDisApproved = "SELECT COUNT(*) from comments WHERE admin_panel_id='$Id' AND status='OFF' ";
                                $ExecuteDisApproved = $Connection->query($QueryDisApproved);

                                $RowsApproved = $ExecuteApproved->fetch_assoc();
                                $TotalApproved = array_shift($RowsApproved);

                                $RowsDisApproved = $ExecuteDisApproved->fetch_assoc();
                                $TotalDisApproved = array_shift($RowsDisApproved);

                                if($TotalApproved){
                            ?>
                            <span class="label label-success pull-right">
                                <?php echo $TotalApproved; ?>
                            </span>
                            <?php
                                 } 
                                 if($TotalDisApproved){
                            ?>
                            <span class="label label-danger pull-left">
                                <?php echo $TotalDisApproved; ?>
                            </span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="EditPost.php?Edit=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a>
                            <a href="DeletePost.php?Delete=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
                        </td>
                        <td>
                            <a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary"> Live Preview</span></a>
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

</body>
</html>

