<?php
require_once('key.php');

$ipRouteros = $ip;
$Username=$user;
$Pass=$pass;
$api_puerto=8728;
$interface = $_GET["interface"]; //"<pppoe-nombreusuario>";

	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {
		$rows = array(); $rows2 = array();	
		   $API->write("/interface/monitor-traffic",false);
		   $API->write("=interface=".$interface,false);  
		   $API->write("=once=",true);
		   $READ = $API->read(false);
		   $ARRAY = $API->parse_response($READ);

				$rx = number_format($ARRAY[0]["rx-bits-per-second"]/1048576,2);
				$tx = number_format($ARRAY[0]["tx-bits-per-second"]/1048576,2);
				$rows['name'] = 'Tx';
				$rows['data'][] = $tx;
				$rows2['name'] = 'Rx';
				$rows2['data'][] = $rx;
			

	}
	$API->disconnect();

	$result = array();
	array_push($result,$rows);
	array_push($result,$rows2);
	
	print json_encode($result, JSON_NUMERIC_CHECK);

?>
