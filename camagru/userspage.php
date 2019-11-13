<?php
session_start();
?>
<body >
<main>
 <div class="nev">   
        <nav> 
            <ul>
                <form style="text-decoration-style:none" action="config/logout.inc.php" method="post">
                    <button style="width:90px;float:right;font-size:20px"type="submit" name="logout-submit"><a href="index.php">Logout</a></button>
                </form>
                <a style="float:right;font-size:30px;text-align:center;  padding:1px 1px" href="profile.php">Profile</a>
                <a style="float:right;font-size:30px; text-align:center; padding:1px 7px;" href="Gallery.php">Gallery</a>
            </ul>
        </nav>
    </div>  
</main>
</body>
<?php 
    include "footer.php";
?>
