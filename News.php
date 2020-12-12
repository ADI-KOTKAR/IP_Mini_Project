<?php require_once("include/NewsDB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
    if(!isset($_SESSION["Username"])){
        $_SESSION["ErrorMessage"] = "Please Register/Login to view content.";
        Redirect_to("Blog.php");
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
<!-- <script>
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
</script> -->
<body>
<?php require_once("include/Functions.php"); ?>
<div class="menu-btn">
        <i class="fas fa-bars fa-2x"></i>
</div>
<div class="container" id="news">
    <!-- NavBar -->
    <nav class="nav-main">
        <img src="images/icons8-bluestacks-240.png" alt="Techvents Logo" class="logo">
        <img src="images/Techvents-text-removebg-preview.png" alt="Techvents Logo" class="logo-text">

        <ul class="main-menu" style="margin-left: 36%;">
            <li style="margin-right: 15px;"><a href="Blog.php">Blogs</a></li>
            <li style="margin-right: 15px;"><a href="Events.php">Events</a></li>
            <li style="margin-right: 15px;"><a href="News.php">News</a></li>
            <?php
            if(User_Login() || Login()){
                echo '<li style="margin-right: 20px;"><a href="Logout.php">Logout</a></li>';
            }
            else{
                echo '<li style="margin-right: 20px;"><a href="Login.php">Login</a></li>';
            }
            ?>
            
            <li></li>
        </ul>

        <ul class="right-menu">
            
        </ul>
    </nav>
    
</div>

<script>
        document.querySelector('.menu-btn').addEventListener(
            'click',()=> document.querySelector('.main-menu').classList.toggle('show')
        );
</script>
  
    <div class="body-container">
    <div class="post-listing">
    <?php echo Message(); echo SuccessMessage(); ?>
    <?php 
                error_reporting(E_ERROR | E_PARSE);
                $Events = array();
                $eventsData;

                if(isset($_GET["Category"])){
                    //Category
                    $SearchCategory = $_GET["Category"];
                    $url = "http://newsapi.org/v2/everything?q=".$SearchCategory."&sources=techcrunch&language=en&apiKey=".$NEWS_API_KEY;
                    $url = preg_replace("/ /", "%20", $url);
                } else {
                    //Defualt
                    $url = "https://newsapi.org/v2/everything?domains=techcrunch.com,thenextweb.com&language=en&apiKey=".$NEWS_API_KEY;
                }

                $response = file_get_contents($url);
                $newsData = json_decode($response);

                foreach($newsData as $news){
                    foreach($news as $col){        
                
            ?>
        <!-- For loop idhar aayega -->
        <div class="post-container">
                <img src="<?php echo $col->urlToImage;?>" alt="">
                <div class="post-text" id="events">
                    <div class="first-line">
                        <h3 class="post-title">
                        <?php 
                        $Title;
                        if(strlen($col->title)>50){$Title = substr($col->title,0,50);}
                        else{$Title = $col->title;}
                        ?>
                            <a target="_blank" href="<?php echo $col->url?>">
                                <?php echo $Title?>...
                            </a>
                        </h3>
                        <?php 
                        $datePublished;
                        if(strlen($col->publishedAt)>11){$datePublished = substr($col->publishedAt,0,11);}
                        else{$datePublished = $col->publishedAt;}
                        ?>
                        <p class="read-time"><?php echo $datePublished;?></p>
                    </div>
                    <div class="third-line">
                        <h4> <?php echo $col->source->name;?></h4>
                    </div>
                    <div class="second-line">
                    <p>
                        <?php echo $col->description; ?>
                    </p>
                    </div>
                    
                </div>
            </div>
        
        <?php } }?>
            
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
                <?php
                if($_SESSION['Role']=="User"){
                    echo '<p><a href="dashboard_user.php"> My Dashboard </a></p>';
                    echo '<p><a href="AddNewPost_User.php"> Write a Post </a></p>';
                }
                if($_SESSION['Role']=="Admin"){
                    echo '<p><a href="dashboard.php"> My Dashboard </a></p>';
                    echo '<p><a href="AddNewPost.php"> Write a Post </a></p>';
                }
                ?>
                
            <?php } 
            ?>
            </div>
            <!-- Categories -->
            <div class="category-container">
                <h4>Domains</h4>
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
                        <button class="category">
                        <a href="News.php?Category=<?php echo $Category; ?>"><?php echo $Category; ?></a>
                        </button>
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