<?php
$email = "bhadmuslekan@gmail.com";
$from = "From: no-reply@noreply.com";
$subject = "verify Account";
$body = "hello there";

if(mail("bhadmuslekan@gmail.com", $subject, $body))
{
    echo "success";
}
else
{
    echo "failvvv";
}
?>
