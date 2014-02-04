<?php

##########################################################
##################  Cool IPA Functions  ##################
##########################################################

// isValidSession(String) => Boolean
function isValidSession($sessid){
	$sessionJSON = json_decode(getUserBySession($sessid));
	if($sessionJSON->{'result'}->{'count'}){
		return true;
	} else {
		return false;
	}
}

// getJoinableGroupsByUID(String) => Array
function getJoinableGroupsByUID($uid){
        return getGroupArray(json_decode(findAllJoinableGroupsByLogin(getLoginByUID($uid))));
}

// getAllGroups() => Array
function getAllGroups(){
        return getGroupArray(json_decode(findAllGroups()));
}

// getGroupsByUID(String) => Array
function getGroupsByUID ($uid){
        return getGroupArray(json_decode(findGroupsByLogin(getLoginByUID($uid))));
}

// getGroupArray(JSONObject) => Array
function getGroupArray($jsonOBJ){
        $groups = array();

        foreach($jsonOBJ->{'result'}->{'result'} as $key => $value) {
                $gname = $value->{'cn'}[0];
                $description = $value->{'description'}[0];
                $gid = $value->{'gidnumber'}[0];


                $groups[] = array('name'=>ucwords(str_replace("-"," ",$gname))." Group",'rawname'=>$gname,'description'=>str_replace("-"," ",$description),'gid'=>$gid);

        }
        return $groups;
}

// getLoginByUID(String) => String
function getLoginByUID ($uid){
        $userJSON = preg_replace('/\s+/', '', findUserByUID($uid));

        //Find Login
        $start = strpos($userJSON, 'uid') + 4;
        $end = strpos(substr($userJSON,$start), ',');
        $login = substr($userJSON,$start, $end);

        return $login;
}

// getUIDByLogin(String) => String
function getUIDByLogin($username){
	$userJSON = json_decode(findUserByLogin($username));
	return $userJSON->{"result"}->{"result"}[0]->{"gidnumber"}[0];
}

// getUIDbySession(ipasession) => String
function getUIDBySession($sessid) {
        $userJSON = preg_replace('/\s+/', '', getUserBysession($sessid));
        
        //Find uidnumber
        $start = strpos($userJSON, 'uidnumber') + 13;
        $end = strpos(substr($userJSON,$start), '"]');
        $uid = substr($userJSON,$start, $end);

	return $uid;
}

// getUserBySession(ipasession) => JSONObject
function getUserBySession($sessid) {
	$json = '{"method": "user_find","params": [ [],{"whoami":"true"}]}';
        $output = runJSON($json, $sessid);

        return $output;
}

// getNameByUID(String) => JSONObject
function getNameByUID ($uid){
	$userJSON = preg_replace('/\s+/', '', findUserByUID($uid));
	
	//Find FirstName
	$start = strpos($userJSON, 'givenname') + 13;
	$end = strpos(substr($userJSON,$start), '"],');
	$first = substr($userJSON,$start, $end);


	//Find LastName
	$start = strpos($userJSON, 'sn') + 6;
        $end = strpos(substr($userJSON,$start), '"],');
	$last = substr($userJSON,$start, $end);
	
	if(strpos($first, '"') !== false) {
		return $last;
	} else {
		return $first." ".$last;
	}
}

// findUserByUID(String) => JSONObject
function findUserByUID ($uid){
        $json = '{"method":"user_find","params":[[""],{"uidnumber":'.$uid.'}]}';
        $output = runJSON($json);
        return $output;

}

// findUserByLogin(String) => JSONObject
function findUserByLogin ($username){
        $json = '{"method":"user_find","params":[[""],{"uid":"'.$username.'"}]}';
        $output = runJSON($json);
        return $output;

}

// findAllJoinableGroupsByLogin(String) => JSONObject
function findAllJoinableGroupsByLogin ($login){
        $json = '{"method":"group_find","params":[[""],{"no_user":"'.$login.'"}]}';
        $output = runJSON($json);
        return $output;

}

// findGroupsByLogin(String) => JSONObject
function findGroupsByLogin ($login){
        $json = '{"method":"group_find","params":[[""],{"user":"'.$login.'"}]}';
        $output = runJSON($json);
        return $output;

}

// findGroupByName(String) => JSONObject
function findGroupByName($groupName){
        $json = '{"method":"group_find","params":[[""],{"cn":"'.$groupName.'"}]}';
        $output = runJSON($json);
        return $output;


}

// findAllGroups() => JSONObject
function findAllGroups (){
        $json = '{"method":"group_find","params":[[""],{}]}';
        $output = runJSON($json);
        return $output;

}

// isAdmin(ipasession) => boolean
function isAdmin($sessid){
	$IS_STRICT = true;

	if (!(empty($sessid))){
		$username = getLoginByUID(getUIDBySession($sessid));
		
		$userJSON = json_decode(findGroupByName('admins'));
		$member_user = $userJSON -> {"result"} -> {"result"}[0]->{"member_user"};
	
		return in_array($username, $member_user, $IS_STRICT);
	} else return false;

}

#########################
#  Modifying Functions  #
#########################
// addUser(String, String, String, String, String) => Boolean
function addUser ($username, $first, $last, $email, $password){
	$json = '{"method": "user_add", "params": [ [], {"uid":"'.$username.'","givenname":"'.$first.'","sn":"'.$last.'","userpassword":"'.$password.'","mail":"'.$email.'"} ] }';
	$output = runJSON($json);

	if(strpos($output,"Added user")){
		return true;
	} else {
		return false;
	}
	
	return false;
}

// addGroup(String, String, String, String, String) => Boolean
function addGroup ($groupName, $groupOwner, $permission, $description, $requestAppeal, $session){
	// transform data
        $uid = getUIDBySession($session);
	if ($permission == 'request'){
		$p = 0;
	} else if ($permission == 'join'){
		$p = 1;
	} else return false;
	
	// insert into database
        $db = getMYSQLConnection();
        if($db){
                mysqli_query($db, "INSERT INTO `Zanzibar`.`Groups` (`groupID`, `ownerID`, `isJoinable`) VALUES ('".$groupName."', '".$uid."', '".$p."');");
        } else return false;

	// inser into freeipa
	$json = '{"method": "group_add", "params": [ [], {"cn":"'.$groupName.'","description":"'.$description.'"} ] }';
	$output = runJSON($json);
	
	if(strpos($output,"Added group")){
		// if successful commit database insert
		mysqli_commit($db);
		return true;
        } else {
                return false;
        }
	
	return false;
}

// joinGroup(String, String) => Boolean
function joinGroup ($username, $groupName){

        $json = '{"method": "group_add_member", "params": [ [], {"cn":"'.$groupName.'","user":"'.$username.'"} ] }';
        $output = runJSON($json);

        if(json_decode($output) -> {'result'} -> {'completed'}){
                return true;
        } else {
                return false;
        }

        return false;

}

// deleteGroup(String) => Boolean
function deleteGroup ($groupName){
        $json = '{"method": "group_del", "params": [ [], {"cn":"'.$groupName.'"} ] }';
        $output = runJSON($json);

        if(strpos($output,"Deleted group")){
                ##TODO: add owner and permissions to DB
                return true;
        } else {
                return false;
        }

        return false;
}

// leaveGroup(String, String) => Boolean
function leaveGroup ($username, $groupName){
        $json = '{"method": "group_remove_member", "params": [ [], {"cn":"'.$groupName.'","user":"'.$username.'"} ] }';
        $output = runJSON($json);

        if(json_decode($output) -> {'result'} -> {'completed'}){
                ##TODO: add owner and permissions to DB
                return true;
        } else {
                return false;
        }
}

#######################
#  Session Functions  #
#######################
//getSESSID(String, String) => String (ipasessid)
function getSESSID($username, $password){
        $password = stripslashes($password);
        exec('curl -v -H referer:https://freeipa.sudoscript.net/ipa/ui/index.html -H "Content-Type:application/x-www-form-urlencoded" -H "Accept:*/*" --negotiate -u : --cacert /tmp/ipa.ca.cert -d "user='.$username.'" -d "password='.$password.'" -D /tmp/cookie.txt -X POST -k https://freeipa.sudoscript.net/ipa/session/login_password 2>&1 | grep -o "ipa_session=[a-zA-Z0-9]*"', $sessid, $returnval);
        return $sessid[0];
}
// getServiceAccountSESSID() => String (ipasessid)
function getServiceAccountSESSID(){
        exec('curl -v -H referer:https://freeipa.sudoscript.net/ipa/ui/index.html -H "Content-Type:application/x-www-form-urlencoded" -H "Accept:*/*" --negotiate -u : --cacert /tmp/ipa.ca.cert -d "user=admin" -d "password=passpass" -D /tmp/cookie.txt -X POST -k https://freeipa.sudoscript.net/ipa/session/login_password 2>&1 | grep -o "ipa_session=[a-zA-Z0-9]*"', $sessid, $returnval);
        return $sessid[0];
}
// runJSON(JSONObject[,ipasession]) => JSONObject
function runJSON($json, $sessid = null){
        if (is_null($sessid)){
                $sessid = getServiceAccountSESSID();
        }
        exec('curl -v -H referer:https://freeipa.sudoscript.net/ipa/ui/index.html -H "Content-Type:application/json" -H "Accept:applicaton/json" -negotiate -u : --cacert /etc/ipa.ca.cert --cookie '.$sessid.' -d \''.$json.'\' -X POST -k https://freeipa.sudoscript.net/ipa/session/json', $output, $returnval);
        return implode($output);

}
######################
# Database Functions #
######################
function getMYSQLConnection(){
	$db = mysqli_connect(localhost, 'root', 'root', 'Zanzibar');
	mysqli_autocommit($db, FALSE);
	if (mysqli_connect_errno()) {
		return false;
	} else return $db;	
}
