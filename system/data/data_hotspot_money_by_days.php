<?php
require_once('key.php');

$ipRouteros = $ip;
$Username=$user;
$Pass=$pass;
$api_puerto=8728;
$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {

 #############################################################################################
 $sql="SELECT * FROM mt_money WHERE mt_id='".$id."'";
													$query=mysql_query($sql);	
													
													$rows = array();
													While($result=mysql_fetch_array($query)){

						                   
				$rows[]=array(($result['utc_time_for_chart'])."000",$result['money']); //"000"=00:00:00 time
				}
	###################################################################################											
												}
	
//	$hot_days_money = array();
	//array_push($hot_days_money,$rows);
	//array_push($hot_days_money,$rows2);
	print json_encode($rows, JSON_NUMERIC_CHECK);

?>