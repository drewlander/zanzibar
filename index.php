<?php 
include("header.php");
include("ipa-func.php");

if (!(checkSID())){
	echo '<center>';
	echo '<h1>PROJECT ZANZIBAR</h1>';

	echo '<form method="post" action="home.php">';
	echo '<table>';
	echo '<tr>';
	echo '<td>username: </td>';
	    echo '<td><input type="text" name ="username"><td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>password: </td>';
	echo '<td> <input type = "password" name = "password"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td><input type = "submit"  name="submit" value = "login"></td>';
	echo '</tr>';
	echo '</table>';
	echo '</form>';
	echo '<a href = "createusr.php">New User</a>';
	echo '</center>';
} else {
	header( "refresh:0; url=home.php");
}
include("footer.php");

function checkSID(){

        #check sessionid against database
        if(!empty($_SESSION['sid'])){
                return isValidSession($_SESSION['sid']);
        } else return false;
}
