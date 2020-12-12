<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>
<?php Confirm_User_Login() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/6d9f81a281.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | User Dashboard</title>
    <link rel="stylesheet" href="css/adminStyles.css">
</head>
<body >

<!-- Sidebar -->
<div class="mid">
    <div class="sidebar">
        <a class="active" href="dashboard_user.php"><i class="fas fa-th"></i> Dashboard</a>
        <a href="AddNewPost_User.php"><i class="fas fa-list-alt"></i> Add New Post</a>
        <a href="ChangePassword.php"><i class="fas fa-key"></i> Change Password</a>
        <a href="Applause_User.php"><i class="fas fa-sign-language"></i> Applauded Posts</a>
        <a href="Blog.php"><i class="fab fa-slack"></i> Live Blog</a>
        <a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- Main -->
<div class="topp">
    <div class="content">
        <h2>User Dashboard</h2>
        <?php echo Message(); echo SuccessMessage(); ?>
        <table>
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
                    $SrNo++; ?>
            <tr>
                <td><?php echo $SrNo; ?></td>
                <td>
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
                <td>
                    <img src="uploads/<?php echo $Image; ?>" alt="" class="banner_image">
                </td>
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
                    <button class="cmt_g">
                        <?php echo $TotalApproved; ?>
                    </button>
                    <?php
                            } 
                            if($TotalDisApproved){
                    ?>
                    <button class="cmt_r">
                        <?php echo $TotalDisApproved; ?>
                    </button>
                    <?php } ?>
                </td>
                <td>
                    <a href="FullPost.php?id=<?php echo $Id; ?>" ><button class="live_preview"> Live Preview</button></a>
                </td>
            </tr>
            <?php } ?>
        </table>
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
.mid{
    padding: 2px;
}
.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: absolute;
  height: 80%;
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
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}
th{
    text-align: left;
    padding: 10px 8px 10px 0;
}
 td {
  text-align: left;
  padding: 4px;
}
.banner_image{
    width:130px;
    height:60px;
    margin: 0;
    padding: 0;
}
th:first-child, td:first-child {
  text-align: left;
}

tr:nth-child(odd) {
  background-color: #f2f2f2
}
.edit{
    background-color: #d4a217;
    border: none;
    border-radius: 30px;
    height: 30px;
    width:55px;
    color: white;
    font-size: 15px;
    margin-right: 4px;
}
.del{ 
    background-color: #c71215;
    border: none;
    border-radius: 30px;
    height: 30px;
    width:65px;
    color: white;
    font-size: 15px;
}
.live_preview{
    background-color: #2ECC71;
    border: none;
    border-radius: 30px;
    height: 30px;
    width:105px;
    color: white;
    font-size: 15px;
}
.edit:hover{
    background-color: #755c07;
}
.del:hover{
    background-color: #800913;
}
.live_preview:hover{
    background-color: #128709;
}
.cmt_g{
    background-color: #2ECC71;
    border: none;
    border-radius: 100%;
    height: 20px;
    width:20px;
    color: white;
}
.cmt_r{
    background-color: #c71215;
    border: none;
    border-radius: 40px;
    height: 20px;
    width:20px;
    color: white;
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
  .sidebar a {
    text-align: left;
    float: none;
  }
  table{
    overflow-x: auto;
    display: inline-block;    
}
    th{
        padding-right: 90px;
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