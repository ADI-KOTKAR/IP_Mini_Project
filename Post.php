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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Post</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
</head>
<body>
    <?php include("base.php") ?>
    <div class="full-post-container">
        <div class="full-post-header">
            <div class="category-tags">
                <button class="btn-select">Web Development</button>
            </div>
            <h1>How to get started with Web Development?</h1>
        </div>
        <div class="full-post-body">
            <div class="post-stats">
                <div class="date">
                    <i class="fas fa-calendar" aria-hidden="true"></i>
                    <p>10 Oct 2020 11:59 AM IST</p>
                </div>
                <img src="https://img.icons8.com/ios/25/000000/applause.png" alt="">
            </div>

            <div class="post-main-body">
                <img src="uploads/AI.jpg" alt="Post Image" class="post-img">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque debitis corrupti vitae. Quae mollitia eos praesentium quasi pariatur id officiis nulla obcaecati impedit amet voluptatibus veritatis, iure, voluptates et, vero animi cupiditate consequuntur. Nisi sit quos officia quasi ea blanditiis, illo aspernatur soluta debitis dolores, consectetur reprehenderit cupiditate. Maiores cumque perspiciatis ratione hic, ducimus porro doloribus veniam. Optio nam inventore odit quas nobis consectetur eaque corrupti maiores distinctio, laudantium sint harum. Laborum voluptates quisquam eius quidem, ut, in cupiditate sint porro eligendi nam vitae ad est velit libero numquam iusto necessitatibus cum assumenda excepturi sapiente dolorem, nemo pariatur. Voluptas numquam expedita necessitatibus atque rerum repellendus reiciendis quo accusantium dolorum iste fugiat nostrum voluptate beatae, earum veritatis voluptatibus perspiciatis eos, cupiditate facere! Ea illo laudantium vel tempora eaque esse, optio molestias voluptatibus reiciendis recusandae sunt pariatur nostrum alias, exercitationem cupiditate numquam reprehenderit similique aspernatur eum, natus repellendus suscipit consequatur maxime. Atque. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto quos, minima laudantium aspernatur ratione omnis, quidem ex eos esse ducimus dolor aut, exercitationem illo quisquam consequuntur voluptatem illum quis nam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque dolor, odio facere inventore iusto accusantium ipsam, dolorum, ratione sequi ullam nisi nam fugit? Quia similique sunt corporis velit! A sit consectetur maiores alias quo id at voluptates doloremque tempora enim atque repudiandae aperiam quam, velit, dolore error maxime deleniti eveniet odio et fugiat libero hic molestias. Provident nesciunt unde earum impedit odio inventore nisi, magni porro repudiandae necessitatibus voluptate tempore doloribus incidunt maxime fugiat velit amet minima eius maiores ducimus quos, nemo odit consequuntur reiciendis! Nesciunt magnam dignissimos quod consectetur aut neque, recusandae nemo officiis vero dolores veritatis commodi ad.</p>
            </div>
            <div class="post-source">
                <img src="uploads/AI.jpg" alt="Source">
                <div class="source-info">
                    <h3>Source 1</h3>
                    <p>Source 1 publishes event related to web Development</p>
                </div>
            </div>
        </div>
        

    </div>
</body>
</html>