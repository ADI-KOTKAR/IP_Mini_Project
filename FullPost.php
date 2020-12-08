<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
    if(!isset($_SESSION["Username"])){
        $_SESSION["ErrorMessage"] = "Please Register/Login to view content.";
        Redirect_to("Blog.php");
    }
?>
<?php 
    if(isset($_POST["Submit"])){
        $Name = $Connection->real_escape_string($_POST["Name"]);
        $Email = $Connection->real_escape_string($_POST["Email"]);
        $Comment = $Connection->real_escape_string($_POST["Comment"]);

        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $PostId = $_GET["id"];

        if(empty($Name) || empty($Email) || empty($Comment)){
            $_SESSION["ErrorMessage"]="All Fields are required.";
        } elseif(strlen($Comment)>500){
            $_SESSION["ErrorMessage"]="Maximum 500 characters are allowed.";
        } else{
            global $ConnectingDB;
            $PostIdFromUrl = $_GET["id"];
            $Query = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,admin_panel_id)
                        VALUES('$DateTime','$Name','$Email','$Comment','Pending','OFF','$PostIdFromUrl')";
            $Execute = $Connection->query($Query);
            if($Execute){
                $_SESSION["SuccessMessage"] = "Comment Submitted Successfully";
                Redirect_to("FullPost.php?id={$PostId}");
            } else{
                $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!";
                Redirect_to("FullPost.php?id={$PostId}");
            }
        }
    }

    if(isset($_GET["ClappedBy"]) && isset($_GET["OnPost"])){  
        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $ClappedBy = $_GET["ClappedBy"];
        $PostId = $_GET["OnPost"];

        $ConnectingDB;
        $Query = "INSERT INTO claps(datetime,clapedby,admin_panel_id)
                    VALUES('$DateTime','$ClappedBy','$PostId' )";
        $Execute = $Connection->query($Query);
        if($Execute){
            $_SESSION["SuccessMessage"] = "Applause Submitted Successfully";
            Redirect_to("FullPost.php?id={$PostId}");
        } else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!";
            Redirect_to("FullPost.php?id={$PostId}");
        }
    }

    if(isset($_GET["UnClappedBy"]) && isset($_GET["OnThePost"])){  
        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $UnClappedBy = $_GET["UnClappedBy"];
        $PostId = $_GET["OnThePost"];

        $ConnectingDB;
        $Query = "DELETE FROM claps WHERE
                    admin_panel_id='$PostId' AND clapedby='$UnClappedBy' ";
        $Execute = $Connection->query($Query);
        if($Execute){
            $_SESSION["SuccessMessage"] = "Applause Removed Successfully";
            Redirect_to("FullPost.php?id={$PostId}");
        } else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!";
            Redirect_to("FullPost.php?id={$PostId}");
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
    <title>TechVents | Full Post</title>
    <link rel="stylesheet" href="css/publicStyles.css">
</head>
<style>
    .FieldInfo {
        color: rgb(251, 174, 44);
        font-family: Bitter,Georgia,"Times New Roman",Times,serif;
        font-size: 1.2rem;
    }
    
    .CommentBlock {
        background-color: #f6f7f9;
    }

    .CommentInfo {
        color: #365899;
        font-family: sans-serif;
        font-size: 1.2rem;
        font-weight: bold;
        padding-top: 10px;
    }

    .description {
        color: darkgray;
        font-weight: bold;
        margin-top: -2px;
    }

    .comment {
        margin-top: -2px;
        padding-bottom: 10px;
        font-size: 1.2rem;
    }
</style>
<body>

<nav class="navbar navbar-inverse" role="navigation" style="background:#ffffff; border:0;">
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
                <li class="active"><a href="Blog.php">Blog</a></li>
                <li><a href="Events.php">Events</a></li>
                <li><a href="News.php">News</a></li>
                <li><a href="">Services</a></li>
                <?php
                    if(isset($_SESSION["Username"])){
                        print "<li><a href=\"Logout.php\">Logout</a></li>";
                    } else {
                        print "<li><a href=\"Login.php\">Login</a></li>";
                    }
                ?>
            </ul>
            <form action="Blog.php" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="Search">
                </div>
                <button class="btn btn-default" name="SearchButton">Go</button>
            </form>
        </div>
    </div>
</nav>

<!-- Container -->
<div class="container">
    <div class="blog-header">
        <h1>The Complete Responsive Blog Section</h1>
        <p class="lead">The Best Platform for Best Stuff!</p>
    </div>

    <!-- Row -->
    <div class="row">

        <!-- Main Blog area -->
        <div class="col-sm-8">
            <?php 
                echo Message(); echo SuccessMessage();
            ?>

            <?php 
                global $ConnectingDB;

                if(isset($_GET["Search"])){
                    $Search = $_GET["Search"];
                    $ViewQuery = "SELECT * FROM admin_panel 
                                    WHERE datetime LIKE '%$Search%' 
                                    OR title LIKE '%$Search%'
                                    OR category LIKE '%$Search%' 
                                    OR post LIKE '%$Search%'
                                    OR author LIKE '%$Search%'";
                    
                }else {
                    $PostIdFromUrl = $_GET["id"];
                    $ViewQuery = "SELECT * FROM admin_panel WHERE id='$PostIdFromUrl' ORDER BY id desc";
                }

                $Execute = $Connection->query($ViewQuery);

                while($DataRows = $Execute->fetch_assoc()){
                    $PostId = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $Title = $DataRows["title"];
                    $Category = $DataRows["category"];
                    $Admin = $DataRows["author"];
                    $Image = $DataRows["image"];
                    $Post = $DataRows["post"];
                
            ?>
            <div class="blogpost thumbnail">
                <img class="img-responsive img-rounded" src="uploads/<?php echo $Image; ?>" alt="">
                <div class="caption">
                    <h1 id="heading"><?php echo htmlentities($Title); ?></h1>
                    <p class="description">Category: <?php echo htmlentities($Category); ?> | Published on <?php echo htmlentities($DateTime); ?></p>
                    <p class="post">
                        <?php 
                            echo nl2br($Post); 
                        ?>
                    </p>
                </div>
                <br><hr>
                
            </div>
                Auhor: <b><?php echo $Admin; ?></b>
                
                <?php
                    $ConnectingDB;
                    $UserId = $_SESSION["User_Id"];
                    $CheckClapQuery = "SELECT COUNT(*) FROM claps 
                                        WHERE clapedby='$UserId' 
                                        AND admin_panel_id='$PostId' ";
                    $ExecuteClapQuery = $Connection->query($CheckClapQuery);
                    
                    // $DataRows = $ExecuteClapQuery->fetch_assoc();
                    if($ExecuteClapQuery->fetch_assoc()['COUNT(*)']==0) 
                    {
                        print "
                        <a class=\"pull-right\" href=\"FullPost.php?ClappedBy={$UserId}&OnPost={$PostId}\">
                            <button style=\"border:none; background: none\"><img src=\"https://img.icons8.com/ios/25/000000/applause.png\"/></button>
                        </a>
                        ";
                    }
                    else 
                    {   
                        print "
                        <a class=\"pull-right\" href=\"FullPost.php?UnClappedBy={$UserId}&OnThePost={$PostId}\">
                            <button class=\"pull-right\" style=\"border:none; background: none\"><img src=\"https://img.icons8.com/ios-filled/25/000000/applause.png\"/></button>
                        </a>
                        ";
                    }
                    // print($ExecuteClapQuery->fetch_assoc()['COUNT(*)']);
                ?>
                

            <?php } ?>

            <hr>

            <span class="FieldInfo">Share Your Thoughts about this post.</span> <br>
            <span class="FieldInfo">Comments</span>
            <?php
                $ConnectingDB;
                $PostIdForComments = $_GET["id"];
                $ExtractingCommentsQuery = "SELECT * FROM comments WHERE admin_panel_id='$PostIdForComments'
                                                AND status='ON' ";
                $Execute = $Connection->query($ExtractingCommentsQuery);

                while($DataRows = $Execute->fetch_assoc()){
                    $CommentDate = $DataRows["datetime"];
                    $CommenterName = $DataRows["name"];
                    $Comments = $DataRows["comment"];
                
            ?>
            <div class="CommentBlock">   
                <img class="pull-left" src="https://img.icons8.com/ios-filled/70/000000/user-male-circle.png" style="margin-left:10px; margin-top:10px;"/>
                <p class="CommentInfo" style="margin-left:90px;"><?php echo $CommenterName; ?></p>
                <p class="description" style="margin-left:90px;"><?php echo $CommentDate; ?></p>
                <p class="comment" style="margin-left:90px;"><?php echo nl2br($Comments); ?></p>
            </div>
            <?php } ?>
            <!-- Comment -->
            <div>
                <form action="FullPost.php?id=<?php echo $PostId;?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="Name"><span class="FieldInfo">Name:</span></label>
                            <input class="form-control " type="text" name="Name" id="name" placeholder="Name"><br>
                        </div>
                        <div class="form-group">
                            <label for="Email"><span class="FieldInfo">Email:</span></label>
                            <input class="form-control " type="text" name="Email" id="email" placeholder="Email"><br>
                        </div>
                        <div class="form-group">
                            <label for="postarea"><span class="FieldInfo">Comment:</span></label>
                            <textarea class="form-control" name="Comment" id="comment"></textarea> <br>
                            <input class="btn btn-primary" type="Submit" name="Submit" value="Add New Comment" style="float: left;"><br>
                        </div>
                    </fieldset>
                </form>
                <br>
            </div>


        </div>
        <!-- Ending of Main Blog Area -->

        <!-- Sidebar -->
        <div class="col-sm-offset-1 col-sm-3">
            <?php
                if(isset($_SESSION["Username"])){ ?>
                <h2>About Me</h2>
                <img src="https://img.icons8.com/ios-filled/150/000000/user-male-circle.png" class="img-responsive img-circle imageicon" alt="">
                 <p class="lead"><?php echo $_SESSION["Username"] ?></p> 
            <?php }
            ?>
            
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h2 class="panel-title">Categories</h2>
                </div>
                <div class="panel-body">
                    <?php
                        $ConnectingDB;
                        $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
                        $Execute = $Connection->query($ViewQuery);

                        while($DataRows = $Execute->fetch_assoc()){
                            $Id = $DataRows['id'];
                            $Category = $DataRows['name'];
                    ?>
                    <span id="heading"> <a href="Blog.php?Category=<?php echo $Category; ?>"><?php echo $Category; ?></a></span> <br>
                    <?php } ?>
                </div>
                <div class="panel-footer">

                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h2 class="panel-title">Recent Posts</h2>
                </div>
                <div class="panel-body">
                    <?php
                        $ConnectingDB;
                        $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
                        $Execute = $Connection->query($ViewQuery);

                        while($DataRows = $Execute->fetch_assoc()){
                            $Id = $DataRows["id"];
                            $Title = $DataRows["title"];
                            $DateTime = $DataRows["datetime"];
                            $Image = $DataRows["image"];
                            if(strlen($DateTime)>11){ $DateTime = substr($DateTime,0,17); }
                    ?>
                    <div>
                        <img class="pull-left" style="margin-top:10px, margin-left:10px" src="uploads/<?php echo htmlentities($Image); ?>" width="70px" height="70px" alt="">
                        <a href="FullPost.php?id=<?php echo $Id; ?>">
                            <p id="heading" style="margin-left:90px"><?php echo htmlentities($Title); ?></p>
                        </a>
                        <p class="description" style="margin-left:90px"><?php echo htmlentities($DateTime) ?></p> <hr>
                    </div>
                    <?php } ?>
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
        <!-- Ending of Sidebar -->

    </div>
    <!-- Ending of row -->

</div>
<!-- Ending of container -->

<!-- Footer -->
<div id="Footer" class="">
    <hr>
    <p>Theme By | TechVents | &copy;2020 --- All Rights reserved.</p>
    <a href="" style="color: white; text-decoration: none; cursor: pointer; font-weight: bold"></a>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti veritatis doloribus dolores esse eius? Ad, qui facere. Magni, aliquam in?
    </p>
</div>
</body>
</html>

