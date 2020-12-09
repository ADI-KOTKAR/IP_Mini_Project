<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php 
                global $ConnectingDB;
                
                //Search
                if(isset($_POST["Search"]) && $_POST["Search"]!="everything"){
                    $Search = $_POST["Search"];
                    $ViewQuery = "SELECT * FROM admin_panel 
                                    WHERE datetime LIKE '%$Search%' 
                                    OR title LIKE '%$Search%'
                                    OR category LIKE '%$Search%' 
                                    OR post LIKE '%$Search%'
                                    OR author LIKE '%$Search%' 
                                    ORDER BY id desc";
                    
                } elseif(isset($_POST["Category"])){
                    //Category
                    $Category = $_POST["Category"];
                    $ViewQuery = "SELECT * FROM admin_panel WHERE category='$Category' ORDER BY id desc";

                } elseif(isset($_POST["Page"])) {
                    //Pagination
                    $Page = $_POST["Page"];
                    $PostsLimit = 5;

                    if($Page==0 || $Page<1){
                        $ShowPostFrom = 0;
                    } else {
                        $ShowPostFrom = ($Page*$PostsLimit)-$PostsLimit;
                    }
                    $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc LIMIT $ShowPostFrom, $PostsLimit";

                } elseif($_POST["Search"]="everything") {
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

            
                
            echo '
            <div class="blogpost thumbnail">
                <img class="img-responsive img-rounded" src="uploads/'.$Image.'" alt="">
                <div class="caption">
                    <h1 id="heading">'.$Title.'</h1>
                    <p class="description">
                        Category: '.$Category.' | Published on '.$DateTime;
                    
                            $ConnectingDB;

                            $QueryApproved = "SELECT COUNT(*) from comments WHERE admin_panel_id='$PostId' AND status='ON' ";
                            $ExecuteApproved = $Connection->query($QueryApproved);

                            $RowsApproved = $ExecuteApproved->fetch_assoc();
                            $TotalApproved = array_shift($RowsApproved);

                            if($TotalApproved){
                        
            echo'       |     <span class="badge">
                            Comments: '.$TotalApproved.' 
                        </span>';
                        
                            }
                            $ConnectingDB;
                            // $UserId = $_SESSION["User_Id"];
                            $CheckClapQuery = "SELECT COUNT(*) FROM claps 
                                                WHERE admin_panel_id='$PostId' ";
                            $ExecuteClapQuery = $Connection->query($CheckClapQuery);
                            $ClapsCount = $ExecuteApproved->fetch_assoc();
                            $TotalClaps = $ExecuteClapQuery->fetch_assoc()['COUNT(*)'];

                            if($TotalClaps){
                    
            echo'             | <img src="https://img.icons8.com/ios/20/000000/applause.png"/>'.$TotalClaps;
                    }
                            
                        
            echo'        </p>
                    <p class="post">';
                            if(strlen($Post)>150){ $Post=substr($Post,0,150).'.....'; }
                            echo $Post; 
            echo'        </p>
                </div>
                <a href="FullPost.php?id='.$PostId.'">
                    <span class="btn btn-success">Read More &rsaquo;&rsaquo;</span>
                </a>
            </div>';
            }
         } else {
            echo "No Matching Results";
         } 

?>