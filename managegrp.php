<?php include ("header.php"); ?>

<h1> Create A Group</h1>

<form action="MAILTO:someone@example.com" method="post" 

enctype="text/plain">
 Group Name: <br /> 
 <input type="text" name = "groupName" value = ""> </input>
 <br />
 Description: <br />
<input type="textarea" name = "Description" value = ""> </input>
<br />
 Name:<br>
 <input type="text" name="name" value=""><br>
 E-mail:<br>
 <input type="text" name="mail" value=""><br>
  <br><br>
 <input type="submit" value="Send">
 <input type="reset" value="Reset">
 </form>

<?php include("footer.php"); ?>
