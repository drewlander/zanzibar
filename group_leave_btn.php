<?php
include ('header.php');
include ('ipa-func.php');
if(!(empty($_POST['leaveGroup']))){
	// user has posted
        $u = getLoginByUID(getUIDBySession(escapeshellcmd($_SESSION['sid'])));
	$g = escapeshellcmd($_POST['leaveGroup']);
	if (leaveGroup($u, $g)){
		echo "Group has been left!<br/>";
		echo "Redirect in 3 seconds...<br/>";
		header( "refresh:3; url=home.php");
	} else {
		echo "Error: Group could not be left!<br/>";
		echo "Redirect in 3 seconds...<br/>";
	        header( "refresh:3; url=home.php");
	}

} else {
	echo "Please use the form to submit this page.";
	var_dump($_POST);
}
include ('footer.php');
?>
