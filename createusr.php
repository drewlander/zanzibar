<!--
Billy Coss
ITEC 325--Web II
Project: 
Description:
-->

<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'utf-8'>
<style type="text/css">	
</style>
<script type="text/javascript">
window.onload=initpg;

}

	function initpg(){
	
	document.forms[0].reset();
}
</script>
</head>
<body>
<h1>Create An Account</h1>

<table><tr>
<form method="POST" action="home.php">
<td>First Name </td>
    <td><input type="text" name = "first"></td> 
</tr>
<tr>
<td>Last Name </td>
    <td><input type="text" name = "last"></td>
</tr>
<tr>
<td>Username </td>
    <td><input type="text" name = "username"></td>
</tr>
<tr>
<td>Password </td>
    <td><input type="password" name = "password"></td>
</tr>
<tr>
<td>Email Address</td> 
    <td><input type="text" name = "email"></td>
</tr>
<tr>

<td><input type ="submit" name = "submit" value="Submit"></td>

</tr>

</form>
</table>
</body>
</html>
