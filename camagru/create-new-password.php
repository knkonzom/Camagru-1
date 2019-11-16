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
</div>
    <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if(empty($selector) || empty($validator))
        {
            echo "Could not validate your request";
        }
        else
        {
            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false)
            {
                ?>
                    <form action="includes/reset-password.inc.php" method="post">
                        <input type="hidden" name="selector" value="<?php echo $selector?>">
                        <input type="hidden" name="validator" value="<?php echo $validator?>">
                        <input type="password" name="pwd" placeholder=" Enter a new password...">
                        <input type="password" name="pwd-repeat" placeholder=" Repeat new password...">
                        <input type="submit" name="reset-password-submit">Reset Password</button>
                    </form>
                <?php
            }
        }
    ?>
</body>
<?php
    include "footer.php";
  ?>
</html>