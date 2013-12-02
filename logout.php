<?php
include('header.php');
session_destroy();
#destroy session ID in database
echo "Successfully Logged Out! You will now be redirected back to the home page.";
header( "refresh:3; url=index.php");
include('footer.php');
?>
