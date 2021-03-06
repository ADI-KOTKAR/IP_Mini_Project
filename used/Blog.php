<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
    if(isset($_GET["ClappedOn"])){  
        $ConnectingDB;
        $PostId = $_GET["ClappedOn"];
        $CountClapsQuery = "SELECT COUNT(*) FROM claps 
                            WHERE admin_panel_id='$PostId' ";
        $ExecuteClapQuery = $Connection->query($CountClapsQuery);
        $ClapsCount = $ExecuteApproved->fetch_assoc();
        $TotalClaps = $ExecuteClapQuery->fetch_assoc()['COUNT(*)'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--Jquery AJAX  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/search.js" ></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Blogs</title>
    <link rel="stylesheet" href="css/publicStyles.css">
</head>
<script>
    $(document).ready(function(){    
        $.ajax({
            type: "POST",
            url: "Search.php",
            data: {
                Search: 'everything',
            },
            success: function (html) {
                $("#display").html(html).show();

            },
        });
})
</script>
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
                    <input id="search" type="text" class="form-control" placeholder="Search" name="Search">
                </div>
            </form>
        </div>
    </div>
</nav>

<?php
    echo Message(); echo SuccessMessage();
?>

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
            <div id="display"></div>
            <div class="" id="pagination"></div>
        </div>
        <!-- Ending of Main Blog Area -->

        

        <!-- Sidebar -->
        <div class="col-sm-offset-1 col-sm-3" >
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

