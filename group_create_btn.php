<?php
include ('header.php');
include ('ipa-func.php');
if(!(empty($_POST['gname'])) && !(empty($_POST['owner'])) && !(empty($_POST['owner2'])) && !(empty($_POST['access'])) && !(empty($_POST['desc'])) && !(empty($_POST['appeal']))){
	// user has posted
	$n = escapeshellcmd($_POST['gname']);
        $o = escapeshellcmd($_POST['owner']);
        $p = escapeshellcmd($_POST['access']);
        $d = escapeshellcmd($_POST['desc']);
        $a = escapeshellcmd($_POST['appeal']);
	if ($o == $_POST['owner2']){
		if (addGroup($n, $o, $p, $d, $a, $_SESSION['sid'])){
			echo "Group has been created!<br/>";
			echo "Redirect in 3 seconds...<br/>";
			header( "refresh:3; url=home.php");
		} else {
			echo "Error: Group could not be created!<br/>";
			echo "Redirect in 3 seconds...<br/>";
		        header( "refresh:3; url=home.php");
		}
	} else echo "Emails do not match.";

} else {
	echo "Please use the form to submit this page.";
	var_dump($_POST);
}
include ('footer.php');
?>
