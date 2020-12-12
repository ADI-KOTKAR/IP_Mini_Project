<?php require_once("include/EventsDB.php"); ?>
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
<?php require_once("include/Functions.php"); ?>
<div class="menu-btn">
        <i class="fas fa-bars fa-2x"></i>
</div>
<div class="container"id="events">
    <!-- NavBar -->
    <nav class="nav-main" >
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
                $Events = array();
                $eventsData;

                if(isset($_GET["Type"])){
                    //Types
                    // echo "in types";
                    echo 'Type: <button style=" background-image: linear-gradient(to right top, #2ec771, #4dd163);; padding:8px; border-radius:20px; color:white; border:none; margin-bottom:10px"><b>'.$_GET['Type'].'</b></button>';
                    $SearchType = $_GET["Type"]." ";
                    foreach($eventsData as $event)
                    {
                        if($event->type1 == $SearchType || $event->type2 == $SearchType)
                        {
                            array_push($Events, $event);
                        }
                    }
                } elseif(isset($_GET["Domain"])) {
                    //Domain
                    echo 'Domain: <button style=" background-image: linear-gradient(to right top, #2ec771, #4dd163);; padding:8px; border-radius:20px; color:white; border:none; margin-bottom:10px"><b>'.$_GET['Domain'].'</b></button>';
                    $SearchDomain = $_GET["Domain"].' ';
                    foreach($eventsData as $event){
                        if($event->doamin1 == $SearchDomain || $event->domain2 == $SearchDomain)
                        {
                            array_push($Events, $event);
                        }
                    }
                } else {
                    //Defualt
                    $Events = $eventsData;
                }

                foreach($Events as $event){
                    if($event->urlToImage == null){
                        $Image = "uploads/IoT.jpg";
                    } else { $Image = $event->urlToImage; }

                    if(strlen($event->title)>75) { $Title = substr($event->title,0,75).".."; }
                    else { $Title = $event->title; }
                
            ?>
        <!-- For loop idhar aayega -->
        <div class="post-container">
                <img src="<?php echo $Image;?>" alt="">
                <div class="post-text" id="events">
                    <div class="first-line">
                        <h3 class="post-title"><a target="_blank" href="<?php echo $event->url?>"><?php echo $event->title?></a></h3>
                        <p class="read-time"><?php echo $event->publishedAt;?></p>
                    </div>
                    <div class="third-line">

                        <h4> <?php echo $event->conducted_by?></h4>
                    </div>
                    <div class="second-line">
                    <h6>
                        Type: 
                        <span class="btn-select"><?php echo $event->type1; ?></span>
                        <?php
                        if($event->type2){
                            echo '<span class="btn-select">'.$event->type2.'</span>';
                        }
                        ?>
                    </h6>
                    <h6>
                        Domain: 
                        <span class="btn-select"><?php echo $event->doamin1; ?></span>
                        <?php
                        if($event->domain2){
                            echo '<span class="btn-select">'.$event->domain2.'</span>';
                        }
                        ?>
                    </h6>
                    </div>
                    
                </div>
            </div>
        
        <?php } ?>
            
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
                <h4>Event Types</h4>
                <div class="category-content">
                <?php
                        $eventsData;
                        foreach($types as $type)
                        {
                            if($type){
                    ?>
                    <span>
                        <button class="category">
                        <a href="Events.php?Type=<?php echo $type; ?>"><?php echo $type; ?></a>
                        </button>
                    </span>
                    <?php }} ?>
                    
                </div>
            </div>
            <div class="category-container">
                <h4>Domains</h4>
                <div class="category-content">
                <?php
                        $eventsData;
                        foreach($domains as $domain)
                        {
                            if($domain){
                    ?>
                    <span>
                        <button class="category">
                        <a href="Events.php?Domain=<?php echo $domain; ?>"><?php echo $domain; ?></a>
                        </button>
                    </span>
                    <?php }} ?>
                    
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