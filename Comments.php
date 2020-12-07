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
    <title>TechVents | Manage Comments</title>
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
                <li class=""><a href="Admins.php">
                    <span class="glyphicon glyphicon-user"></span> &nbsp; Manage Admins</a></li>
                <li class="active"><a href="Comments.php">
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
            <h1>Un-Approved Comments</h1>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Approve</th>
                        <th>Delete Comment</th>
                        <th>Details</th>
                    </tr>
                    <?php
                        $ConnectingDB;
                        $Query = "SELECT * FROM comments WHERE status='OFF' ";
                        $Execute = $Connection->query($Query);
                        $SrNo = 0;

                        while($DataRows = $Execute->fetch_Assoc()){
                            $CommentId = $DataRows["id"];
                            $DateTimeofComment = $DataRows["datetime"];
                            $PersonName = $DataRows["name"];
                            if(strlen($PersonName)>10){ $PersonName = substr($PersonComment,0,10).".."; }
                            $PersonComment = $DataRows["comment"];
                            $CommentId = $DataRows["id"];
                            $CommentedPostId = $DataRows["admin_panel_id"];
                            $SrNo++;
                        
                    ?>
                    <tr>
                        <td><?php echo htmlentities($SrNo); ?></td>
                        <td style="color: #5e5eff"><?php echo htmlentities($PersonName); ?></td>
                        <td><?php echo htmlentities($DateTimeofComment); ?></td>
                        <td>
                            <?php 
                                echo htmlentities($PersonComment); 
                            ?>
                        </td>
                        <td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
                        <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                        <td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>  

            <h1>Approved Comments</h1>
            <?php 
                echo Message(); echo SuccessMessage();
            ?> 
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Approved By</th>
                        <th>Approve</th>
                        <th>Delete Comment</th>
                        <th>Details</th>
                    </tr>
                    <?php
                        $ConnectingDB;
                        $Query = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc ";
                        $Execute = $Connection->query($Query);
                        $SrNo = 0;
                        $Admin = "Aditya Kotkar";

                        while($DataRows = $Execute->fetch_Assoc()){
                            $CommentId = $DataRows["id"];
                            $DateTimeofComment = $DataRows["datetime"];
                            $PersonName = $DataRows["name"];
                            if(strlen($PersonName)>10){ $PersonName = substr($PersonComment,0,10).".."; }
                            $PersonComment = $DataRows["comment"];
                            $ApprovedBy = $DataRows["approvedby"];
                            $CommentId = $DataRows["id"];
                            $CommentedPostId = $DataRows["admin_panel_id"];
                            $SrNo++;
                        
                    ?>
                    <tr>
                        <td><?php echo htmlentities($SrNo); ?></td>
                        <td style="color: #5e5eff"><?php echo htmlentities($PersonName); ?></td>
                        <td><?php echo htmlentities($DateTimeofComment); ?></td>
                        <td>
                            <?php 
                                echo htmlentities($PersonComment); 
                            ?>
                        </td>
                        <td><?php echo htmlentities($ApprovedBy); ?></td>
                        <td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-warning">Disapprove</span></a></td>
                        <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                        <td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
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

