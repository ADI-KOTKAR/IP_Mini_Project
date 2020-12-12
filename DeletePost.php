<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login() ?>
<?php 
    if(isset($_POST["Submit"])){
        $Title = $Connection->real_escape_string($_POST["Title"]);
        $Category = $Connection->real_escape_string($_POST["Category"]);
        $Post = $Connection->real_escape_string($_POST["Post"]);

        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $Admin = $_SESSION["Username"];
        $Image = $_FILES["Image"]["name"]; 
        $Target = "uploads/".basename($_FILES["Image"]["name"]);

        global $ConnectingDB;
        $DeleteFromURL = $_GET["Delete"];
        $Query = "DELETE FROM admin_panel WHERE id='$DeleteFromURL ' ";
        $Execute = $Connection->query($Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
        if($Execute){
            $_SESSION["SuccessMessage"] = "Post Deleted Successfully";
            Redirect_to("dashboard.php");
        } else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong, Try Again!";
            Redirect_to("dashboard.php");
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/6d9f81a281.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Delete Post</title>
    <link rel="stylesheet" href="css/adminStyles.css">
</head>
<body>

<!-- Sidebar -->
<div class="mid">
    <div class="sidebar">
        <a href="dashboard.php"><i class="fas fa-th"></i> Dashboard</a>
        <a class="active" href="AddNewPost.php"><i class="fas fa-list-alt"></i> Add New Post</a>
        <a href="Categories.php"><i class="fas fa-tags"></i> Categories</a>
        <a href="Admins.php"><i class="fas fa-cog"></i></i> Admins</a>
        <a href="Applause.php"><i class="fas fa-sign-language"></i> Applauded Posts</a>
        <a href="Comments.php">
            <i class="fas fa-comments"></i> Comments
            <?php
                $ConnectingDB;

                $QueryDisApproved = "SELECT COUNT(*) from comments WHERE status='OFF' ";
                $ExecuteDisApproved = $Connection->query($QueryDisApproved);

                $RowsDisApproved = $ExecuteDisApproved->fetch_assoc();
                $TotalDisApproved = array_shift($RowsDisApproved);

                if($TotalDisApproved){
            ?>
            <button class="cmt_y">
                <?php echo $TotalDisApproved; ?>
            </button>
            <?php } ?>
        </a>
        <a href="Blog.php"><i class="fab fa-slack"></i> Live Blog</a>
        <a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="topp">
    <div class="content">
        <h2>Delete Post</h2>
        <?php echo Message(); echo SuccessMessage(); ?>
        <?php 
            $SearchQueryParameter = $_GET["Delete"];
            $ConnectingDB;
            $Query = "SELECT * FROM admin_panel WHERE id='$SearchQueryParameter' ";
            $ExecuteQuery = $Connection->query($Query);

            while($DataRows = $ExecuteQuery->fetch_assoc()){
                $TitleToBeUpdated = $DataRows["title"];
                $CategoryToBeUpdated = $DataRows["category"];
                $ImageToBeUpdated = $DataRows["image"];
                $PostToBeUpdated = $DataRows["post"];
            }
        ?>
        <form action="DeletePost.php?Delete=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
            <h4>Title:</h4>
            <input disabled value="<?php echo $TitleToBeUpdated; ?>" type="text" id="title" name="Title" placeholder="Title" >
            <h5>Existing Category: <b><mark> <?php echo $CategoryToBeUpdated; ?> </mark></b></h5>
            </select>
            <h5>Existing Image:</h5>
            <img src="uploads/<?php echo $ImageToBeUpdated; ?>" width="150px" height="70px"> 
            <h4>Select Image: </h4>
            <input disabled type="file" class="image_input" name="Image" id="imageSelect">
            <h4>Post:</h4>
            <textarea disabled name="Post" id="post">
                <?php echo $PostToBeUpdated; ?>
            </textarea>
            <input id="add" type="Submit" name="Submit" value="Delete Post"><br>
        </form>
    </div>
</div>


        
</body>
</html>


<!-- CSS -->
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}
.cmt_y{
    background-color: #fdcb6e;
    border: none;
    border-radius: 40px;
    height: 20px;
    width:20px;
    color: white;
} 
textarea {
    width: 99%;
    rows: 100;
}
.mid{
    padding: 2px;
}
.sidebar {
  margin: 0;
  padding: 0;
  height: 80%;
  width: 200px;
  background-color: #f1f1f1;
  position: absolute;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #2ECC71;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: auto;
  margin-bottom: 40px;
}
h2{
    font-weight: 500;
    font-size: 30px;
    color: black;
}
input{
    height:30px;
    width:99%;
    margin-top: 6px;
    margin-bottom: 20px;
    text-indent: 2px;
}
.image_input{
    border: 0.5px solid #444544;
    padding: 8px;
    margin-bottom: 20px;
    padding-bottom: 0;
    width: 99%;
}
select{
    height: 35px;
    width:100%;
    margin-top: 6px;
    margin-bottom: 20px;
}
h4{
    /* color: #2ECC71; */
    margin:0;
}
#post{
    height: 60px;
    vertical-align:top;
    margin-top: 10px;
}
#add{
    color: white;
    background-color: #d63031;
    border: none;
    border-radius: 30px;
    padding-bottom: 20px;
    text-align: center;
    padding-top: 8px;
    font-size: 15px;
}
#add:hover{
    background-color: #40822e;
}
footer{
  display:flex;
  width:100%;
  background-color:#3d3d3d;
  position: absolute;
  height:fit-content;
  margin-top: 80px;
  justify-content: center;
}

footer img{
  height:60px;
  width: 60px;
  margin-right: 10px;
  margin-top: 8px;
  float: left;
}
.ft{
  width: 90%;
}
footer h2{
  font-size: 180%;
  margin-top: 30px;
}
.txt{
  width:30%;
  display: inline-block;
  margin-right: 20px;
  margin-top: 0;
  margin-bottom: 10px;
  height: 130px;
}
.txt p{
  color:#f1f1f1;
  margin: 0;
}
.last_line{
  margin-top: 10px;
}
.last_line p{
  color:white;
  font-size: 22px;
  display: inline-block;
  margin-top: 27px;
}
.cpy{
  float:right;
  margin-right: 70px;
}
hr{
  margin-top: 30px;
  border-bottom: none;
}
@media screen and (max-width: 800px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
  footer{
    height:70px;
    margin-top: 10px;
  }
  div.txt, hr
    {
      display: none;
    }
  .last_line p{
    font-size: 15px;
  }
  .last_line{
    margin-top: 0px;
  }
  div.content{
    margin-bottom: 10px;
  }
  footer img{
    height: 30px;
    width:30px;
    margin-top: 20px;
  }
  .cpy{
    margin-right: 10px;
  }

}

@media screen and (max-width: 400px) {
  textarea {
    height:500px;
  }
  .sidebar a {
    text-align: left;
    float: none;
  }

  footer{
    height:70px;
    margin-top: 10px;
  }
  div.txt, hr
    {
      display: none;
    }
  .last_line p{
    font-size: 15px;
  }
  .last_line{
    margin-top: 0px;
  }
  div.content{
    margin-bottom: 10px;
  }
  footer img{
    height: 30px;
    width:30px;
    margin-top: 20px;
  }
  .cpy{
    margin-right: 10px;
  }

}
</style>



