<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login() ?>
<?php 
    if(isset($_POST["Submit"])){
        $Username = $Connection->real_escape_string($_POST["Username"]);
        $Password = $Connection->real_escape_string($_POST["Password"]);
        $ConfirmPassword = $Connection->real_escape_string($_POST["ConfirmPassword"]);
        
        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
        $Admin = $_SESSION["Username"];
        
        if(empty($Username) || empty($Password) || empty($ConfirmPassword)){
            $_SESSION["ErrorMessage"]="All fields must be filled out";
            Redirect_to("Admins.php");
        } elseif(strlen($Password)<4){
            $_SESSION["ErrorMessage"]="Maximum 4 Characters for Password";
            Redirect_to("Admins.php");
        } elseif($Password !== $ConfirmPassword){
            $_SESSION["ErrorMessage"]="Confirm Password does not match.";
            Redirect_to("Admins.php");
        } else {
            global $ConnectingDB;
            $HashPassword = password_hash($Password, PASSWORD_BCRYPT);
            $Query = "INSERT INTO registration(datetime,addedby,username,password,role)
                        VALUES('$DateTime','$Admin','$Username','$HashPassword','Admin')";
            $Execute = $Connection->query($Query);
            if($Execute){
                $_SESSION["SuccessMessage"] = "Admin Added Successfully";
                Redirect_to("Admins.php");
            } else{
                $_SESSION["ErrorMessage"] = "Failed to add Admin";
                Redirect_to("Admins.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/6d9f81a281.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Manage Admins</title>
    <link rel="stylesheet" href="css/adminStyles.css">
</head>
<body>

   
<!-- Sidebar -->
<div class="mid">
    <div class="sidebar">
        <a href="dashboard.php"><i class="fas fa-th"></i> Dashboard</a>
        <a href="AddNewPost.php"><i class="fas fa-list-alt"></i> Add New Post</a>
        <a href="Categories.php"><i class="fas fa-tags"></i> Categories</a>
        <a class="active" href="Admins.php"><i class="fas fa-cog"></i></i> Admins</a>
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


<!-- Main -->
<div class="topp">
    <div class="content">
        <h2>Manage Categories</h2>
        <?php echo Message(); echo SuccessMessage(); ?> 
        <form action="Admins.php" method="post">
            <fieldset>
                <h4>Name:</h4>
                <input type="text" name="Username" id="Name" placeholder="Name">
                <h4>Password:</h4>
                <input type="password" name="Password" id="Name" placeholder="Password">
                <h4>Confirm Password:</h4>
                <input type="password" name="ConfirmPassword" id="Name" placeholder="Confirm Password">
                <input type="Submit" name="Submit" id="add" value="Add New Admin">
            </fieldset>
        </form>
        <table>
            <tr>
                <th>Sr No.</th>
                <th>Date & Time</th>
                <th>Account Name</th>
                <th>Added By</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
                global $ConnectingDB;
                $ViewQuery = "SELECT * FROM registration ORDER BY id desc";
                $Execute = $Connection->query($ViewQuery);
                $SrNo = 0;

                while($DataRows = $Execute->fetch_assoc()){
                    $Id = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $Name = $DataRows["username"];
                    $CreatorName = $DataRows["addedby"];
                    $Role = $DataRows["role"];
                    $SrNo++;
            ?>
            <tr>
                <td><?php echo $SrNo; ?></td>
                <td><?php echo $DateTime; ?></td>
                <td><?php echo $Name; ?></td>
                <td><?php echo $CreatorName; ?></td>
                <td><?php echo $Role; ?></td>
                <td>
                    <button class="del">
                        <a href="DeleteAdmin.php?id=<?php echo $Id; ?>">Delete</a>
                    </button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>



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
    padding-top: 2px;
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
    margin-top: 20px;
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
.del{ 
    background-color: #c71215;
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
.del:hover{
    background-color: #755c07;
}

  input{
    height:30px;
    width:99%;
    margin-top: 6px;
    margin-bottom: 20px;
    text-indent: 2px;
}
h4{
    color: #2ECC71;
    margin:0;
}
#add{
    color: white;
    background-color: #2ECC71;
    border: none;
    border-radius: 30px;
    padding-bottom: 20px;
    text-align: center;
    padding-top: 10px;
    height:35px;
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