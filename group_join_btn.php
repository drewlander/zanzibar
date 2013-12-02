<?php
include ('header.php');
include ('ipa-func.php');
if(!(empty($_POST['joinGroup']))){
	// user has posted
	$u = getLoginByUID(getUIDBySession(escapeshellcmd($_SESSION['sid'])));
	$g = escapeshellcmd($_POST['joinGroup']);
	
	if (joinGroup($u, $g)){
		echo "Group has been joined!<br/>";
		echo "Redirect in 3 seconds...<br/>";
		header( "refresh:3; url=home.php");
	} else {
		echo "Error: Group could not be joined!<br/>";
		echo "Redirect in 3 seconds...<br/>";
	        header( "refresh:3; url=home.php");
	}

} else {
	echo "Please use the form to submit this page.";
	var_dump($_POST);
}
include ('footer.php');
?>
