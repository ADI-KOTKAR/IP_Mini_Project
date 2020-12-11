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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Blog</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/search.js" ></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
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
    <?php include("base.php"); ?>
    <?php
    echo Message(); echo SuccessMessage();
?>
    <div class="body-container">
        <div class="post-listing">
<div class="" id="display"></div>

        <!-- For loop idhar aayega -->
            
 
        </div>
        <!-- Right Panel -->
        <div class="right-panel">
            <!-- About Me -->
            
            <div class="about-me">
            <?php
            if(isset($_SESSION["Username"])){ ?>

                <img src="https://img.icons8.com/ios-filled/150/000000/user-male-circle.png" alt="user-img"/>
                <p><b><?php echo $_SESSION["Username"] ?></b></p>
                <hr>
                <p><a href="dashboard_user.php"> My Dashboard </a></p>
                <p><a href="AddPost.php"> Write a Post </a></p>
            <?php } 
            ?>
            </div>
            <!-- Categories -->
            <div class="category-container">
                <h4>Categories</h4>
                <div class="category-content">
                <?php
                        $ConnectingDB;
                        $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
                        $Execute = $Connection->query($ViewQuery);

                        while($DataRows = $Execute->fetch_assoc()){
                            $Id = $DataRows['id'];
                            $Category = $DataRows['name'];
                    ?>
                    <span>
                        <a href="Blog.php?Category=<?php echo $Category; ?>"><?php echo $Category; ?></a>
                    </span>
                    <?php } ?>
                </div>
            </div>
            <!-- Recent Posts -->
            <div class="recent-posts-container">
                <h4>Recent Posts</h4>
                <div class="recent-posts-content">
                <?php
                        $ConnectingDB;
                        $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
                        $Execute = $Connection->query($ViewQuery);

                        while($DataRows = $Execute->fetch_assoc()){
                            $Id = $DataRows["id"];
                            $Title = $DataRows["title"];
                            $DateTime = $DataRows["datetime"];
                            $Image = $DataRows["image"];
                            if(strlen($DateTime)>11){ $DateTime = substr($DateTime,0,17);} 
                            if(strlen($Title)>11){ $Title = substr($Title,0,40).'...'; }
                    ?>
                    <div class="recent-postt">
                    <img src="./uploads/<?php echo htmlentities($Image); ?>" alt="Post-Image">
                    <div class="recent-post">
                        <p><a href="FullPost.php?id=<?php echo $Id; ?>"><?php echo htmlentities($Title); ?></a></p>
                        <p id="time"><?php echo htmlentities($DateTime) ?></p>
                    </div>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
        
    </div>
    
</body>
</html>