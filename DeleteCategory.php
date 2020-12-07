<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>

<?php 

    if(isset($_GET["id"])){
        $IdFromUrl = $_GET["id"];
        $ConnectingDB;
        $Query = "DELETE from category WHERE id='$IdFromUrl' ";
        $Execute = $Connection->query($Query);

        if($Execute){
            $_SESSION["SuccessMessage"] = "Category Deleted Successfully";
            Redirect_to("Categories.php");
        } else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again!";
            Redirect_to("Categories.php");
        }
    }

?>