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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Blogs</title>
    <link rel="stylesheet" href="css/publicStyles.css">
</head>
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
            <?php 
                global $ConnectingDB;
                
                //Search
                if(isset($_GET["Search"])){
                    $Search = $_GET["Search"];
                    $ViewQuery = "SELECT * FROM admin_panel 
                                    WHERE datetime LIKE '%$Search%' 
                                    OR title LIKE '%$Search%'
                                    OR category LIKE '%$Search%' 
                                    OR post LIKE '%$Search%'
                                    OR author LIKE '%$Search%' 
                                    ORDER BY id desc";
                    
                } elseif(isset($_GET["Category"])){
                    //Category
                    $Category = $_GET["Category"];
                    $ViewQuery = "SELECT * FROM admin_panel WHERE category='$Category' ORDER BY id desc";

                } elseif(isset($_GET["Page"])) {
                    //Pagination
                    $Page = $_GET["Page"];
                    $PostsLimit = 5;

                    if($Page==0 || $Page<1){
                        $ShowPostFrom = 0;
                    } else {
                        $ShowPostFrom = ($Page*$PostsLimit)-$PostsLimit;
                    }
                    $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc LIMIT $ShowPostFrom, $PostsLimit";

                } else {
                    //Default
                    $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc";
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
                    <p class="description">
                        Category: <?php echo htmlentities($Category); ?> | Published on <?php echo htmlentities($DateTime); ?>  
                        <?php
                            $ConnectingDB;

                            $QueryApproved = "SELECT COUNT(*) from comments WHERE admin_panel_id='$PostId' AND status='ON' ";
                            $ExecuteApproved = $Connection->query($QueryApproved);

                            $RowsApproved = $ExecuteApproved->fetch_assoc();
                            $TotalApproved = array_shift($RowsApproved);

                            if($TotalApproved){
                        ?> | 
                        <span class="badge">
                            Comments: <?php echo $TotalApproved;?> 
                        </span>
                        <?php
                            }
                            $ConnectingDB;
                            $UserId = $_SESSION["User_Id"];
                            $CheckClapQuery = "SELECT COUNT(*) FROM claps 
                                                WHERE admin_panel_id='$PostId' ";
                            $ExecuteClapQuery = $Connection->query($CheckClapQuery);
                            $ClapsCount = $ExecuteApproved->fetch_assoc();
                            $TotalClaps = $ExecuteClapQuery->fetch_assoc()['COUNT(*)'];

                            if($TotalClaps){
                        ?>
                         | <img src="https://img.icons8.com/ios/20/000000/applause.png"/> <?php echo $TotalClaps;?> 
                        <?php }
                            
                        ?>
                    </p>
                    <p class="post">
                        <?php 
                            if(strlen($Post)>150){ $Post=substr($Post,0,150).'.....'; }
                            echo $Post; 
                        ?>
                    </p>
                </div>
                <a href="FullPost.php?id=<?php echo $PostId; ?>">
                    <span class="btn btn-success">Read More &rsaquo;&rsaquo;</span>
                </a>
            </div>
            <?php } ?>
            <nav>
                <ul class="pagination pull-left">
                    <!-- previous button -->
                    <?php 
                    if(isset($Page)){
                        if($Page>1){ ?>
                            <li>
                                <a href="Blog.php?Page=<?php echo $Page-1; ?>">&lsaquo;&lsaquo;</a>
                            </li>
                    <?php }} ?>
                    <!-- Pagination -->
                    <?php
                        global $ConnectingDB;
                        $QueryPagination = "SELECT COUNT(*) FROM admin_panel";
                        $ExecutePagination = $Connection->query($QueryPagination);
                        $RowPagination = $ExecutePagination->fetch_assoc();
                        $TotalPosts = array_shift($RowPagination);

                        if(isset($Page)){
                            $PostPagination = ceil($TotalPosts/$PostsLimit);
                        
                            for($i=1; $i<=$PostPagination; $i++)
                            {
                                if(isset($Page) >= 1){
                                    if($i==$Page){ ?>
                                        <li class="active">
                                            <a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                            <?php   } else { ?>
                                        <li>
                                            <a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>  
                            <?php   }
                                }
                            }
                        }
                    ?>
                    <!-- next button -->
                    <?php 
                    if(isset($Page)){
                        if($Page+1<=$PostPagination){ ?>
                            <li>
                                <a href="Blog.php?Page=<?php echo $Page+1; ?>">&rsaquo;&rsaquo;</a>
                            </li>
                    <?php }} ?>       
                </ul>
            </nav>
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

