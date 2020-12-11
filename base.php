<?php require_once("include/Functions.php"); ?>
<div class="menu-btn">
        <i class="fas fa-bars fa-2x"></i>
</div>
<div class="container">
    <!-- NavBar -->
    <nav class="nav-main">
        <img src="images/icons8-bluestacks-240.png" alt="Techvents Logo" class="logo">
        <img src="images/Techvents-text-removebg-preview.png" alt="Techvents Logo" class="logo-text">

        <ul class="main-menu">
            <li><a href="#">Blogs</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">News</a></li>
            <?php
            if(User_Login() || Login()){
                echo '<li><a href="Logout.php">Logout</a></li>';
            }
            else{
                echo '<li><a href="Login.php">Login</a></li>';
            }
            ?>
            <li>
                <form action="Blog.php" class="">
                    <input type="text" class="" placeholder="Search" name="Search">
                    <!-- <button class="btn" name="SearchButton">Go</button> -->
                </form>
            </li>
            
            
        </ul>

        <ul class="right-menu">
            
        </ul>
    </nav>
    <hr>
</div>

<script>
        document.querySelector('.menu-btn').addEventListener(
            'click',()=> document.querySelector('.main-menu').classList.toggle('show')
        );
</script>