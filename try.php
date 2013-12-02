<!DOCTYPE HTML>
  <html lang="en">
     <head>
        <title> Workforce Group Registration </title>
           <meta charset="utf-8">
            <style type="text/css">
				  body { font-size: 80%; font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif; }
				  ul#tabs { list-style-type: none; margin: 30px 0 0 0; padding: 0 0 0.3em 0; }
				  ul#tabs li { display: inline; }
				  ul#tabs li a { color: #42454a; background-color: #dedbde; border: 1px solid #c9c3ba; 
				                 border-bottom: none; padding: 0.3em; text-decoration: none; }
				  ul#tabs li a:hover { background-color: #f1f0ee; }
				  ul#tabs li a.selected { color: #000; background-color: #f1f0ee; font-weight: bold; 
				                          padding: 0.7em 0.3em 0.38em 0.3em; }
				  div.tabContent { border: 1px solid #c9c3ba; padding: 0.5em; background-color: #f1f0ee; }
				  div.tabContent.hide { display: none; }
                  			  
			</style>

    

     </head>
     <body onload="init()">
        <h1> Workforce Group Registration Site</h1>

			<ul id="tabs">
			  <li><a href="#mygroups">My Groups</a></li>
			  <li><a href="#joingroups">Join Groups</a></li>
			  <li><a href="#managegroups">Manage Groups</a></li>
			</ul>

			<div class="tabContent" id="mygroups">
			  <h2>My Groups</h2>
			  <div>
				<p> This page shows a listing of all the groups that you have joined and are currently enrolled in.</p>
			  </div>
			   <form>
			  <table>
			     <th style = "text-decoration: underline; text-align: left;"> Current Groups Listing: <br /> <br /></th>
				 <th style = "text-decoration: underline;"> Leave Group? <br /> <br /></th>
			  <?php
						   $groups = array("App" => "Application Development Group",
										   "Prod" => "Production Development Group",
										   "Social" => "Social Networking Group",
										   "Prof" => "Professional Development Group",
										   "System" => "Kan Ban Group");
						   foreach($groups as $key => $gname)
						   {
								 echo "<tr>";
								 echo "<td>";
								 echo "<strong>".$gname."</strong>";
								 echo "</td>";
								 echo "<td style = 'text-align: center;'>";
								 echo "<input type = 'checkbox' id = '$gname' name = 'groups[]' value = '$gname'/> <br /><br />";
								 echo "</td>";
								 echo "</tr>";
						   }
			?>
			</table>
			<br />
			       <input type="submit" name='submit' value='Leave Group'>
			</form>
			</div>

			<div class="tabContent" id="joingroups">
			  <h2>Join Groups</h2>
			  <div>
				<p> This page shows a listing of all available groups. Some groups are all access groups which will automatically
				    enroll you into this group once you click "Join Group". Some groups require permission to join. For these groups, 
				    you will be required to fill out a group request form. This form will be sent along with the name of the group 
					that you are requesting to join. If the admin approves you for enrollment, this group will be displayed on your 
				    My Groups page once approved.
				</p>
				<form action = "Manage.php" method = "post">
					<table>
						<tr>
							<th style = "text-decoration: underline;"><strong> Group Name </strong> <br /> <br /></th>
							<th style = "text-decoration: underline;"><strong> Choose Your Group(s) </strong> <br /> <br /></th>
						</tr>
						
						<?php
						   $groups = array("App" => "Application Development Group",
										   "Prod" => "Production Development Group",
										   "Social" => "Social Networking Group",
										   "Prof" => "Professional Development Group",
										   "System" => "Kan Ban Group");
						   foreach($groups as $key => $gname)
						   {
								 echo "<tr>";
								 echo "<td>";
								 echo "<strong>".$gname."</strong>";
								 echo "</td>";
								 echo "<td style = 'text-align: center;'>";
								 echo "<input type = 'checkbox' id = '$gname' name = 'groups[]' value = '$gname'/> <br /><br />";
								 echo "</td>";
								 echo "</tr>";
						   }
						?>
			       </table>
				           <br />
				           <input type='submit' name='submit' value='Join Group' /> <br />
									<br />
			    </form>
			  </div>
			</div>
			<div class="tabContent" id="managegroups">
			  <h2>Admin Manage Groups Page</h2>
			  <div>
				<p> Admin only page for creating new groups, approving enrollment in restricted groups,
                    and for deleting groups.</p>
				<form>
				  <table>
				    <tr>
				      <th style = "text-align: left;"> Create Group <br /> <br /></th>
				    </tr>
					<tr> </tr>
				    <tr>
			          <td>Group Name: <input type = "text" id = "name" value = "" /> </td>
				    </tr>
				    <tr>
					  <td>Group Description:  <br />
				      <textarea id = "desc" rows = "3" cols = "50"></textarea></td>
					</tr>
				  </table>
				  <br /> <br />
				  <input type="submit" name='submit' value='Create Group'>
                  <input type="reset">
				</form>
			  </div>
			  <br />
			  <br />
			  <form style = "border-style:solid; border-color:black;">
			  <table>
			     <th style = "text-decoration: underline; text-align: left;"> Current Groups Listing: <br /> <br /></th>
				 <th style = "text-decoration: underline;"> Delete Group? <br /> <br /></th>
			  <?php
						   $groups = array("App" => "Application Development Group",
										   "Prod" => "Production Development Group",
										   "Social" => "Social Networking Group",
										   "Prof" => "Professional Development Group",
										   "System" => "Kan Ban Group");
						   foreach($groups as $key => $gname)
						   {
								 echo "<tr>";
								 echo "<td>";
								 echo "<strong>".$gname."</strong>";
								 echo "</td>";
								 echo "<td style = 'text-align: center;'>";
								 echo "<input type = 'checkbox' id = '$gname' name = 'groups[]' value = '$gname'/> <br /><br />";
								 echo "</td>";
								 echo "</tr>";
						   }
			?>
			</table>
			<br />
			       <input type="submit" name='submit' value='Delete Group'>
			<br /> <br />
			</form>
			</div>
	</body>
</html>
