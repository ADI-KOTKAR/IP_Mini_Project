<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php 
    if(isset($_POST["Submit"])){
        $Username = $Connection->real_escape_string($_POST["Username"]);
        $Password = $Connection->real_escape_string($_POST["Password"]);
        
        if(empty($Username) || empty($Password)){
            $_SESSION["ErrorMessage"]="All fields must be filled out";
            Redirect_to("Login.php");
        } else {
            $Found_Account = Login_Attempt($Username, $Password);
            $_SESSION["User_Id"] = $Found_Account["id"];
            $_SESSION["Username"] = $Found_Account["username"];
            $_SESSION["Role"] = $Found_Account["role"];

            echo gettype($Found_Account["role"]);

            if($Found_Account){
                if($_SESSION["Role"] == "Admin"){
                    $_SESSION["SuccessMessage"] = "Welcome Back Boss - {$_SESSION["Username"]}!";
                    Redirect_to("dashboard.php");
                } else {
                    $_SESSION["SuccessMessage"] = "Welcome Back {$_SESSION["Username"]}!";
                    Redirect_to("dashboard_user.php");
                }
                
            } else {
               $_SESSION["ErrorMessage"] = "Invalid Credentials";
               Redirect_to("Login.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVents | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>


            <center>
                <div class="mid">
                <?php echo Message(); echo SuccessMessage(); ?> 
                    <img class="Logo" src="images/icons8-bluestacks-75.png" alt="">
                    <form action="Login.php" method="post">
                        <center>
                            <h1>SIGIN</h1>
                            <input type="text" name="Username" size="30" placeholder="Name" />
                            <br>
                            <input type="password" name="Password" size="30" placeholder="Password" />
                            <br>
                            <input class="b" type="submit" name="Submit" value="Login" />
                        </center>
                    </form>
                </div>
            </center>
            

</body>
</html>


<style>
        *{
            margin: 0;
        }
        .leftt{
            background-color:white;
            display: flex;
            float: left;
            width: 10%;
            height: 100vh;
            }
        .rightt{
            background-color:white;
            display: flex;
            float: right;
            width: 10%;
            height: 100vh;
            }
        .topp{
            background-color:white;
            display: flex;
            justify-content: center;
            width: 80%;
            height: 5vh;
            }
        input{
            width:300px;
            height: 40px;
            border-radius: 35px;
            border: none;
            background-color: #F2F2F2;
            text-indent: 17px;
            font-family: Montserrat;
            font-size: 15px;
            margin: 7px;
            outline: none;
        }
        h1{
            font-family: Montserrat;
            font-style: normal;
            font-weight: 700;
            font-size: 23px;
            line-height: 121.4%;
            color: #666666;
            padding-bottom: 15px;
            letter-spacing: 6px;
        }
        .b{
            background-color: #2ECC71;
            color: white;
            width:120px;
            text-align: center;
            text-indent: 0;
            font-family: Montserrat;
            font-weight: 600;
            font-size: 16px;
            margin-top: 20px;
            height:40px;
        }
        .b:hover{
            background-color: #29b765;
        }
        .Logo{
            margin-top: 140px;
            height:90px;
            width: 90px;
            margin-bottom: 20px;
        }
        @media (min-width: 1000px){
            input{
                width:285px;
                height: 40px;
            }
            .Logo{
                width:100px;
                height:100px;
            }
            .b{
                width: 120px;
                height: 40px;
            }
            h1{
                font-size: 23px;
                letter-spacing: 6px;
            }
        }
        @media (max-width: 800px){
            input{
                width:200px;
                height: 35px;
            }
            .Logo{
                width:80px;
                height:80px;
            }
            .b{
                width: 100px;
                height: 25px;
            }
            h1{
                font-size: 20px;
                letter-spacing: 5px;
            }
        }
        @media (max-width: 500px){
            input{
                width:150px;
                height:30px;
            }
            .Logo{
                width:60px;
                height:60px;
            }
            .b{
                width: 80px;
                height: 20px;
            }
            h1{
                font-size: 17px;
                letter-spacing: 4px;
            }
        }
        @media (max-width: 300px){
            input{
                width:100px;
                height: 25px;
            }
            .Logo{
                width:50px;
                height:50px;
            }
            .b{
                width: 60px;
                height: 15px;
                font-size: 10px;
            }
            h1{
                font-size: 14px;
                letter-spacing: 3px;
            }
    </style>
