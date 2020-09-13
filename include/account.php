<?php	
include_once('../config/routeros_api.class.php');
include_once("../include/conn.php");
$acc = $API->comm("/user/print");

$numuser =count($acc);
for($i=0; $i<$numuser; $i++){
	if($acc[$i]['name']=="".$user.""){$account=$acc[$i]['group'];}
	//if($result['mt_id']!=$result['mt_num']){$account="read";}

	
	
	}
?>