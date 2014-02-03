<div id = "header-wrapper">
	<div id = "header">
		<table width="100%">
			<tr>
				<td>
					<div id = "logo"><h1> Workforce Group Registration Site</h1></div>
				</td>
				<td>
					<span class="header-right"><span><?php echo 'Logged in as: '.getNameByUID(getUIDBySession($_SESSION['sid'])).' | <span id="logout"><a href="'.$mainlink.'logout.php">[Logout]</a></span>';?></span></span>
				</td>
			</tr>
		</table>
	</div>
	<div id = "bar">
		<p></p>
	</div>
</div>

<div id = "outer">
	<ul id="tabs">
		<li><a href="#mygroups">My Groups</a></li>
		<li><a href="#joingroups">Join Groups</a></li>
		<li><a href="#managegroups">Manage Groups</a></li>
		<li><a href="#creategroups">Create Groups</a></li>
	</ul>

	<div class="tabContent" id="mygroups">
			<h2>My Groups</h2>
			<div><p> This page shows a listing of all the groups that you have joined and are currently enrolled in.</p></div>
			<table>
					<th style = "text-decoration: underline; text-align: left;"> Current Groups Listing: <br /><br /> </th>
					<th style = "text-decoration: underline;"> Leave Group? <br /> <br /></th>
					<?php
							foreach(getMyGroups() as $key => $garray){
									echo "<tr><td>";
									echo "<strong>".$garray['name']."</strong>";
									echo "</td>";
									echo "<td>";
									echo '<form action = "group_leave_btn.php" method = "post">';
									echo "<input type = 'hidden' name = 'leaveGroup' value = '".$garray['rawname']."'/>";
									echo "<input type = 'submit' value = 'Leave Group'>";
									echo "</td></tr>";
									echo "</form>";
									echo "<tr><td>";
									echo $garray['description'];
									echo "</td></tr>";
							}
					?>
			</table>
			<br />
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
					<table>
							<tr>
									<th style = "text-decoration: underline; text-align: left;"><strong> Group Name </strong> <br /> <br /></th>
									<th style = "text-decoration: underline;"><strong> Choose Your Group(s) </strong> <br /> <br /></th>
							</tr>
							<?php
									foreach(getMyJoinableGroups() as $key => $garray){
											echo "<tr><td>";
											echo "<strong>".$garray['name']."</strong>";
											echo "</td>";
											echo "<td style = 'text-align: right;'>";
											echo '<form action = "group_join_btn.php" method = "post">';
											echo "<input type = 'hidden' name = 'joinGroup' value = '".$garray['rawname']."'/>";
											echo "<input type = 'submit' value = 'Join a Group'>";
											echo "</td></tr>";
											echo "</form>";
											echo "<tr><td>";
											echo $garray['description'];
											echo "</td></tr>";

									}
							?>
					</table>
			<br /><br />
			</div>
	</div>
	<div class="tabContent" id="managegroups">
			<h2>Admin Manage Groups Page</h2>
			<table>
			<th style = "text-decoration: underline; text-align: left;"> Current Groups Listing: <br /> <br /></th>
			<th style = "text-decoration: underline;"> Delete Group? <br /> <br /></th>
			<?php
					foreach(getManagableGroups($_SESSION['sid']) as $key => $garray){
							echo "<tr><td>";
							echo "<strong>".$garray['name']."</strong><br/>";
							echo $garray['description'];
							echo "</td>";
							echo "<td>";
							echo '<form action = "group_del_btn.php" method = "post">';
							echo "<input type = 'hidden' name = 'deleteGroup' value = '".$garray['rawname']."'/>";
							echo "<input type = 'submit' value = 'Delete Group'>";
							echo "</td></tr>";
							echo "</form>";
					}
			?>
			</table>
			<br /><br /> <br />
	</div>
	<div class="tabContent" id="creategroups">
			<div>
					<h2>Create A Group </h2>
					<form action = "group_create_btn.php" method = "post">
					<table>
							<tr><th style = "text-align: left;"></th></tr>
							<tr> </tr>
							<tr><td>Group Name: <br /><input type="text" name="gname" value="" /> </td></tr>
							<tr><td>Group Owner Email: <br /><input type="text" name = "owner" value = "" /> </td> </tr>
							<tr><td>Group Owner Email (Confirmation): <br /><input type="text" name="owner2" value = "" /> </td> </tr>
							<tr><td>Group Access: <br /><input type = "radio" name = "access" value = "join" /> Public </td></tr>
							<tr><td><input type = "radio" name = "access" value = "request" /> By Request Only</td></tr>
							<tr><td>Group Description:  <br /><textarea name = "desc" rows = "3" cols = "50"></textarea></td></tr>
							<tr><td>Reason for Creating Group:  <br /><textarea name = "appeal" rows = "3" cols = "50"></textarea></td></tr>
					</table>
					<br /> <br />
					<input type="submit" name='submit' value='Send'>
					<input type="reset">
					</form>
			</div>
	</div>
</div>
<?php
#Dummy Data
function getMyGroups(){
        $groups = getGroupsByUID(getUIDBySession($_SESSION['sid']));
        return $groups;
}
function getMyJoinableGroups(){
	$groups = getJoinableGroupsByUID(getUIDBySession($_SESSION['sid']));
	return $groups;
}
function getManagableGroups($session){
	if(isAdmin($session)){
		return getAllGroups();
	} else {
		$groups = array();
		/*$result = mysqli_query($db, "");
		while ($row = mysqli_fetch_array($result)){
	                $groups[] = array('name'=>ucwords(str_replace("-"," ",$))." Group",'rawname'=>$gname,'description'=>str_replace("-"," ",$description),'gid'=>$gid);

		}*/
	
	
		return $groups;
	}


}

/*function getAllGroups(){
$groups = array(array ("name" => "Application Development Group",
                "gid" => "1001",
                "description" => "The Application Development Group.",
                "permission" => "Join",
                "admin" => "admin@localhost.com"),
                array ("name" => "Production Development Group",
                "gid" => "1002",
                "description" => "This is the Production Development group.",
                "permission" => "Join",
                "admin" => "admin@localhost.com"),
                array ("name" => "Social Networking Group",
                "gid" => "1003",
                "description" => "This group is for socializing with coworkers.",
                "permission" => "Join",
                "admin" => "admin@localhost.com"),
                array ("name" => "Professional Development Group",
                "gid" => "1004",
                "description" => "This group is for the Professional Development Group.",
                "permission" => "Join",
                "admin" => "admin@localhost.com"),
                array ("name" => "Kan Ban Group",
                "gid" => "1005",
                "description" => "This is the Kan Ban Group.",
                "permission" => "Join",
                "admin" => "admin@localhost.com"));
        return $groups;
}*/
?>

