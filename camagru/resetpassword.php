<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <title>ResetPassword</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
<div class="nev">   
        <nav style="background-color:green;padding:4%; margin:1%">
            <a href="index.php">Home</a>     
        </nav>  
</div>
    <div class="static" style="margin:10%">
    <form method="post" action="includes/send_resetlink.php">
    <div class="text" >
    <p style="font-size:15px">Enter Email Address To Send Password Link</p>
    <input style="width:250px;" type="text" name="email" placeholder="Enter your e-mail address...">
    <button style="height:20px;width:100px;text-align:50px"type="submit" name="reset-submit">Send Link</button>
    </div>
    <?php
            if(isset($_GET["newpwd"]))
            {
                if($_GET["newpwd"] == "passwordupdated")
                {
                    echo '<strong><p style="background-color:#73AD21; text-align:center">Your password has been reset!</p></strong>';
                }
            }
            else if(isset($_GET["reset"]))
            {
                if($_GET["reset"] == "success")
                {
                    echo '<strong><p style="background-color:#73AD21; text-align:center"><strong>Check your e-mail!</p></strong>';
                }
            }
    ?>
  </form>
</div>
</body>
<?php
    include "footer.php";
  ?>
</html>

