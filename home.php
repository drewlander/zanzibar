<?php
require_once('ipa-func.php');
##### Header #####
include ("header.php");
if(!(empty($_POST['username'])) && !(empty($_POST['password']))){
	if(!(empty($_POST['username'])) && !(empty($_POST['password'])) && !(empty($_POST['first'])) && !(empty($_POST['last'])) && !(empty($_POST['email']))){
	// user is registering
		$u = escapeshellcmd($_POST['username']);
		$p = escapeshellcmd($_POST['password']);
		$f = escapeshellcmd($_POST['first']);
		$l = escapeshellcmd($_POST['last']);
		$e = escapeshellcmd($_POST['email']);
		
		if(addUser($u,$f,$l,$e,$p)){
		        echo "User Created!";
		} else {
		        echo "User Already Exists!";
			include("footer.php");
			die();
		}

	}
	if (!(checkValidLogin($_POST['username'],$_POST['password']))){
		echo "Error: Invalid Username and Password.<br/>redirecting in 3 seconds..";
	        header( "refresh:3; url=index.php");
		include("footer.php");
		die();
	} 
} else {
	if (!(checkSID())){
		echo "Error: Invalid Session. <br/>redirecting in 3 seconds..";
	        header( "refresh:3; url=index.php");
		include("footer.php");
		die();
	}
}


$act = $_GET['act'];
$gid = $_GET['gid'];


# User is authenticated beyond here
include ('tabbedHome.php');

##### Functions #####
function checkValidLogin($username, $password){
	$u = escapeshellcmd($username);
        $p = escapeshellcmd($password);
	
	$sessid = getSESSID($u,$p);

	if(!(empty($sessid))){
		#TODO: add sid to database
		$_SESSION['sid'] = $sessid;
		return true;
	} else return false;
}
function checkSID(){

	#check sessionid against database
	if(!empty($_SESSION['sid'])){
	        return isValidSession($_SESSION['sid']);
	} else return false;
}


##### Footer #####
include ("footer.php");
?>
