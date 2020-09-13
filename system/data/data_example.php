<?php
require_once('key.php');
$ipRouteros = $ip;
$Username=$user;
$Pass=$pass;
$api_puerto=8728;
$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {

	
                $resource = $API->comm("/system/resource/print");
				$health = $API->comm("/system/health/print");
                $cpu=$health['0']['cpu-temperature'];
				$tem=$health['0']['temperature'];
				$volt=$health['0']['voltage'];
				$watt=$health['0']['power-consumption'];
				$current=$health['0']['current'];
				$load=$resource['0']['cpu-load'];
				$show0 = array(); $show1 = array();$show2 = array();$show3 = array();$show4 = array();$show5 = array();
				$show0['name'] = 'cpu';
				$show0['data'][] = $cpu;
				$show1['name'] = 'tem';
				$show1['data'][] = $tem;
				$show2['name'] = 'volt';
				$show2['data'][] = $volt;
				$show3['name'] = 'watt';
				$show3['data'][] = $watt;
				$show4['name'] = 'load';
				$show4['data'][] = $load;
				$show5['name'] = 'current';
				$show5['data'][] = $current;
	}
	$API->disconnect();
    $res = array();
	array_push($res,$show0);
	array_push($res,$show1);
	array_push($res,$show2);
	array_push($res,$show3);
	array_push($res,$show4);
	array_push($res,$show5);
	array_push($res,$show6);
	print json_encode($res, JSON_NUMERIC_CHECK);

?>
