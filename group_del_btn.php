<?php
include ('header.php');
include ('ipa-func.php');
if(!(empty($_POST['deleteGroup']))){
	// user has posted
	$id = escapeshellcmd($_POST['deleteGroup']);
	if (deleteGroup($id)){
		echo "Group has been deleted!<br/>";
		echo "Redirect in 3 seconds...<br/>";
		header( "refresh:3; url=home.php");
	} else {
		echo "Error: Group could not be deleted!<br/>";
		echo "Redirect in 3 seconds...<br/>";
	        header( "refresh:3; url=home.php");
	}
} else {
	echo "Please use the form to submit this page.";
	var_dump($_POST);
}
include ('footer.php');
?>
