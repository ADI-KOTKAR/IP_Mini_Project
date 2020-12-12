<style>
.alert {
  padding: 20px;
  background-color: #eed202;
  color: white;
}

.success {
  padding: 20px;
  background-color: #eed202;
  color: white;
}


.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>

<?php 
    session_start();
    function Message(){
        if(isset($_SESSION["ErrorMessage"])){
            $Output = '
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span> 
                <strong> '.htmlentities($_SESSION["ErrorMessage"]).'</strong>
            </div>
            ';
            $_SESSION["ErrorMessage"]=null;
            return $Output;
        }
    }

    function SuccessMessage(){
        if(isset($_SESSION["SuccessMessage"])){
            $Output = '
            <div class="success">
                <span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span> 
                <strong> '.htmlentities($_SESSION["SuccessMessage"]).'</strong>
            </div>
            ';
            $_SESSION["SuccessMessage"]=null;
            return $Output;
        }
    }
?>