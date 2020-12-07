<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>

<?php 

    if(isset($_GET["id"])){
        $IdFromUrl = $_GET["id"];
        $Admin = $_SESSION["Username"];
        $ConnectingDB;
        $Query = "UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$IdFromUrl' ";
        $Execute = $Connection->query($Query);

        if($Execute){
            $_SESSION["SuccessMessage"] = "Comment Approved Successfully";
            Redirect_to("Comments.php");
        } else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again!";
            Redirect_to("Comments.php");
        }
    }

?>