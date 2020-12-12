<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>
<?php Confirm_Login() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/6d9f81a281.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Manage Comments</title>
    <link rel="stylesheet" href="css/adminStyles.css">
</head>
<body style="background:#f5f5f5;">
   
<!-- Sidebar -->
<div class="mid">
    <div class="sidebar">
        <a href="dashboard.php"><i class="fas fa-th"></i> Dashboard</a>
        <a href="AddNewPost.php"><i class="fas fa-list-alt"></i> Add New Post</a>
        <a href="Categories.php"><i class="fas fa-tags"></i> Categories</a>
        <a href="Admins.php"><i class="fas fa-cog"></i></i> Admins</a>
        <a href="Applause.php"><i class="fas fa-sign-language"></i> Applauded Posts</a>
        <a class="active" href="Comments.php">
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
        <h2>Un-Approved Comments</h2>
        <?php echo Message(); echo SuccessMessage(); ?>
        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Approve</th>
                <th>Delete Comment</th>
                <th>Details</th>
            </tr>
            <?php
                $ConnectingDB;
                $Query = "SELECT * FROM comments WHERE status='OFF' ";
                $Execute = $Connection->query($Query);
                $SrNo = 0;

                while($DataRows = $Execute->fetch_Assoc()){
                    $CommentId = $DataRows["id"];
                    $DateTimeofComment = $DataRows["datetime"];
                    $PersonName = $DataRows["name"];
                    if(strlen($PersonName)>10){ $PersonName = substr($PersonComment,0,10).".."; }
                    $PersonComment = $DataRows["comment"];
                    $CommentId = $DataRows["id"];
                    $CommentedPostId = $DataRows["admin_panel_id"];
                    $SrNo++;
                
            ?>
            <tr>
                <td><?php echo htmlentities($SrNo); ?></td>
                <td><?php echo htmlentities($PersonName); ?></td>
                <td><?php echo htmlentities($DateTimeofComment); ?></td>
                <td>
                    <?php 
                        echo htmlentities($PersonComment); 
                    ?>
                </td>
                <td>
                  <button class="approve">
                    <a href="ApproveComments.php?id=<?php echo $CommentId; ?>">Approve</a>
                  </button>
                </td>
                <td>
                  <button class="del">
                    <a href="DeleteComments.php?id=<?php echo $CommentId; ?>">Delete</a>
                  </button> 
                </td>
                <td>
                  <button class="live_preview">
                    <a href="FullPost.php?id=<?php echo $CommentedPostId; ?>">Live Preview</a>
                  </button>
                </td>
            </tr>
            <?php } ?>
        </table>
        <h2>Approved Comments</h2>
        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Approved By</th>
                <th>Approve</th>
                <th>Delete Comment</th>
                <th>Details</th>
            </tr>
            <?php
                $ConnectingDB;
                $Query = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc ";
                $Execute = $Connection->query($Query);
                $SrNo = 0;
                $Admin = $_SESSION["Username"];

                while($DataRows = $Execute->fetch_Assoc()){
                    $CommentId = $DataRows["id"];
                    $DateTimeofComment = $DataRows["datetime"];
                    $PersonName = $DataRows["name"];
                    if(strlen($PersonName)>10){ $PersonName = substr($PersonComment,0,10).".."; }
                    $PersonComment = $DataRows["comment"];
                    $ApprovedBy = $DataRows["approvedby"];
                    $CommentId = $DataRows["id"];
                    $CommentedPostId = $DataRows["admin_panel_id"];
                    $SrNo++;
                
            ?>
            <tr>
                <td><?php echo htmlentities($SrNo); ?></td>
                <td style="color: #5e5eff"><?php echo htmlentities($PersonName); ?></td>
                <td><?php echo htmlentities($DateTimeofComment); ?></td>
                <td>
                    <?php 
                        echo htmlentities($PersonComment); 
                    ?>
                </td>
                <td><?php echo htmlentities($ApprovedBy); ?></td>
                <td>
                  <button class="disapprove">
                    <a href="DisApproveComments.php?id=<?php echo $CommentId; ?>">Disapprove</a>
                  </button>
                </td>
                <td>
                  <button class="del">
                    <a href="DeleteComments.php?id=<?php echo $CommentId; ?>">Delete</a>
                  </button>
                </td>
                <td>
                  <button class="live_preview">
                    <a href="FullPost.php?id=<?php echo $CommentedPostId; ?>">Live Preview</a>
                  </button>
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
.cmt_y{
    background-color: #fdcb6e;
    border: none;
    border-radius: 40px;
    height: 20px;
    width:20px;
    color: white;
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
th:first-child, td:first-child {
  text-align: left;
}

tr:nth-child(odd) {
  background-color: #f2f2f2
}
.approve{
    background-color: #2ECC71;
    border: none;
    border-radius: 30px;
    height: 30px;
    width:75px;
    color: white;
    font-size: 15px;
    margin-right: 4px;
}
.approve a {
  text-decoration: none;
  color: white;
}
.del{ 
    background-color: #d63031;
    border: none;
    border-radius: 30px;
    height: 30px;
    width:65px;
    color: white;
    font-size: 15px;
}
.del a {
  text-decoration: none;
  color: white;
}
.live_preview{
    background-color: #a29bfe;
    border: none;
    border-radius: 30px;
    height: 30px;
    width:105px;
    color: white;
    font-size: 15px;
}
.live_preview a{
  text-decoration: none;
  color: white;
}
.disapprove{
    background-color: #fdcb6e;
    border: none;
    border-radius: 30px;
    height: 30px;
    width:105px;
    color: white;
    font-size: 15px;
}
.disapprove a{
  text-decoration: none;
  color: white;
}
.disapprove:hover{
    background-color: #755c07;
}
.approve:hover{
    background-color: #088a13;
}
.del:hover{
    background-color: #800913;
}
.live_preview:hover{
    background-color: #1b0a64;
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
    height:80px;
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
    margin-top: 10px;
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