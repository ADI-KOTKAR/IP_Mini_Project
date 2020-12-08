<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>
<?php Confirm_User_Login() ?>
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
    <title>TechVents | User Panel</title>
    <link rel="stylesheet" href="css/adminStyles.css">
</head>
<body style="background:#f5f5f5;">
    
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
                <li><a href="AddNewPost_User.php">
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
        <div class="col-sm-10" style="background:#ffffff;">
            <h1>User Dashboard</h1>
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
                        <th>Details</th>
                    </tr>
                    <?php
                        global $ConnectingDB;
                        $Username = $_SESSION["Username"];
                        $ViewQuery = "SELECT * FROM admin_panel WHERE author='$Username' ORDER BY id desc";
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

