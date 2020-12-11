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
    <?php include("base.php"); ?>
    <div class="full-post-container">
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
        <div class="full-post-header">
            <div class="category-tags">
                <button class="btn-select"><?php echo $Category;?></button>
            </div>
            <h1><?php echo $Title;?></h1>
        </div>
        <div class="full-post-body">
            <div class="post-stats">
                <div class="date">
                    <i class="fas fa-calendar" aria-hidden="true"></i>
                    <p><?php echo $DateTime;?></p>
                </div>
                <?php
                    $ConnectingDB;
                    $UserId = $_SESSION["User_Id"];
                    $CheckClapQuery = "SELECT COUNT(*) FROM claps 
                                        WHERE clapedby='$UserId' 
                                        AND admin_panel_id='$PostId' ";
                    $ExecuteClapQuery = $Connection->query($CheckClapQuery);
                if($ExecuteClapQuery->fetch_assoc()['COUNT(*)']==0) 
                    {
                        print "
                        <a  href=\"FullPost.php?ClappedBy={$UserId}&OnPost={$PostId}\">
                            <img src=\"https://img.icons8.com/ios/25/000000/applause.png\"/>
                        </a>
                        ";
                    }
                    else 
                    {   
                        print "
                        <a  href=\"FullPost.php?UnClappedBy={$UserId}&OnThePost={$PostId}\">
                            <img src=\"https://img.icons8.com/ios-filled/25/000000/applause.png\"/>
                        </a>
                        ";
                    }
                    ?>
            </div>
            

            <div class="post-main-body">
                <img src="uploads/<?php echo $Image; ?>" alt="Post Image" class="post-img">
                <p>
                    <?php 
                        echo nl2br($Post); 
                    ?>
                </p>
            </div>
            <div class="post-source">
                <img src="images/icons8-bluestacks-48.png" alt="Source">
                <div class="source-info">
                    <h3>Author:</h3>
                    <p><?php echo $Admin; ?></p>
                </div>
            </div>
                <?php } ?>
            <!-- Comments -->
            <div class="comments">
                <p>Share your Thoughts about the post</p>
                <p>Comments</p>
                <form action="FullPost.php?id=<?php echo $PostId;?>" method="post" enctype="multipart/form-data">
                    <label for="name">Name:</label>
                    <input type="text" name="Name" placeholder="Name" id="name">
                    <label for="email">Email:</label>
                    <input type="text" name="Email" placeholder="Email" id="email">
                    <label for="comment">Comment:</label>
                    <textarea cols="100%" rows="6%" placeholder="Comment" name="Comment"  id="comment"></textarea>
                    <input type="Submit" name="Submit" value="Add New Comment" class = "btn-submit">
                </form>
            </div>
        </div>
        

    </div>
</body>
</html>