<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php 
                global $ConnectingDB;
                
                if (isset($_POST["Category"]) && $_POST["Category"]!="all"){
                    echo 'Categories: <mark><b>'.$_POST['Category'].'</b></mark>';
                    $Category = $_POST["Category"];
                    $ViewQuery = "SELECT * FROM admin_panel WHERE category='$Category' ORDER BY id desc";
                }
                elseif(isset($_POST["Search"]) && $_POST["Search"]!="everything"){
                    echo 'IN Serch';
                    echo $_POST['Search'];
                    $Search = $_POST["Search"];
                    $ViewQuery = "SELECT * FROM admin_panel 
                                    WHERE datetime LIKE '%$Search%' 
                                    OR title LIKE '%$Search%'
                                    OR category LIKE '%$Search%' 
                                    OR post LIKE '%$Search%'
                                    OR author LIKE '%$Search%' 
                                    ORDER BY id desc";
                    
                } elseif(isset($_POST["Page"])) {
                    echo 'IN Page';
                    //Pagination
                    $Page = $_POST["Page"];
                    $PostsLimit = 5;

                    if($Page==0 || $Page<1){
                        $ShowPostFrom = 0;
                    } else {
                        $ShowPostFrom = ($Page*$PostsLimit)-$PostsLimit;
                    }
                    $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc LIMIT $ShowPostFrom, $PostsLimit";

                } elseif($_POST["Search"]="everything" || $_POST["Category"]="all") {
                    echo 'Categories: <mark><b>All</b></mark>';
                    //Default
                    $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc";
                    $CountQuery = "SELECT COUNT(*) FROM admin_panel ORDER BY id desc";
                } 

                $Execute = $Connection->query($ViewQuery);
            
            if(mysqli_num_rows($Execute)>0){
                // echo mysqli_num_rows($Execute);
                while($DataRows = $Execute->fetch_assoc()){
                    $PostId = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $Title = $DataRows["title"];
                    $Category = $DataRows["category"];
                    $Admin = $DataRows["author"];
                    $Image = $DataRows["image"];
                    $Post = $DataRows["post"];

                    if(strlen($DateTime)>11){$DateTime = substr($DateTime,0,11);}
                    if(strlen($Title)>28){$Title = substr($Title,0,28).'..' ;}


            
                
            echo '
            <div class="post-container">
                <img src="./uploads/'.$Image.'" alt="">
                <div class="post-text">
                    <div class="first-line">
                        <h3 class="post-title"><a href="FullPost.php?id='.$PostId.'">'.$Title.'</a></h3>
                        <p class="read-time">'.$DateTime.'</p>
                    </div>
                    <div class="second-line">
                        <p class="post-descp">';
                            if(strlen($Post)>400){$Post = substr($Post,0,400);}
                            echo $Post;
                            $ConnectingDB;
                            // $UserId = $_SESSION["User_Id"];
                            $CheckClapQuery = "SELECT COUNT(*) FROM claps 
                                                WHERE admin_panel_id='$PostId' ";
                            $ExecuteClapQuery = $Connection->query($CheckClapQuery);
                            // $ClapsCount = $ExecuteClapQuery->fetch_assoc();
                            $TotalClaps = $ExecuteClapQuery->fetch_assoc()['COUNT(*)'];
                        
                        echo '</p>
                    </div>
                    <div class="third-line">
                        <img src="https://img.icons8.com/ios/25/000000/applause.png" alt=""> ';
                        if($TotalClaps){
                            echo ' '.$TotalClaps;
                        }
                        else{
                            echo '  0';
                        }
                        $ConnectingDB;

                        $QueryApproved = "SELECT COUNT(*) from comments WHERE admin_panel_id='$PostId' AND status='ON' ";
                        $ExecuteApproved = $Connection->query($QueryApproved);

                        $RowsApproved = $ExecuteApproved->fetch_assoc();
                        $TotalApproved = array_shift($RowsApproved);

                        if($TotalApproved){
                            echo ' | Comments: '.$TotalApproved;
                        }
                        else{
                            echo ' | Comments: 0';
                        }
                        echo'
                    </div>
                </div>
            </div>
            ';
                            
                            
                            

                            
                            

            }
         } else {
            echo "No Matching Results";
         } 

?>