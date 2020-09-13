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
				/////////////////////////////////////////////////
				$resource = $API->comm("/system/resource/print");
				$health = $API->comm("/system/health/print");
                $cpu=$health['0']['cpu-temperature'];
				$tem=$health['0']['temperature'];
				$volt=$health['0']['voltage'];
				$current=$health['0']['current'];
				$load=$resource['0']['cpu-load'];
				$show = array(); $show2 = array();$show3 = array();$show4 = array();$show5 = array();
				$show['name'] = 'cpu';
				//$show['data'][] = $cpu;
				$show['data'][] = "0";
				$show2['name'] = 'tem';
				//$show2['data'][] = $tem;
				$show2['data'][] = "0";
				$show3['name'] = 'volt';
				//$show3['data'][] = $volt;
				$show3['data'][] = "0";
				$show4['name'] = 'current';
				//$show4['data'][] = $current;
				$show4['data'][] = "0";
				$show5['name'] = 'load';
				$show5['data'][] = $load;

	}
	$API->disconnect();

	$result = array();
	array_push($result,$rows);
	array_push($result,$rows2);
	array_push($result,$show);
	array_push($result,$show2);
	array_push($result,$show3);
	array_push($result,$show4);
	array_push($result,$show5);
	print json_encode($result, JSON_NUMERIC_CHECK);

?>
