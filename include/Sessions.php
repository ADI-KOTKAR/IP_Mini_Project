<?php 
    session_start();
    function Message(){
        if(isset($_SESSION["ErrorMessage"])){
            $Output="<div><mark>";
            $Output.=htmlentities($_SESSION["ErrorMessage"]);
            $Output.="</mark></div>";
            $_SESSION["ErrorMessage"]=null;
            return $Output;
        }
    }

    function SuccessMessage(){
        if(isset($_SESSION["SuccessMessage"])){
            $Output="<div><mark>";
            $Output.=htmlentities($_SESSION["SuccessMessage"]);
            $Output.="</mark></div>";
            $_SESSION["SuccessMessage"]=null;
            return $Output;
        }
    }
?>