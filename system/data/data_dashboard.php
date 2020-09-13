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
				$hotspot = $API->comm("/ip/hotspot/active/print");
				$pppoe = $API->comm("/ppp/active/print");
				$neighbor = $API->comm("/ip/neighbor/print");
				$clock = $API->comm("/system/clock/print");
				//$inter = $API->comm("/interface/print");
                
	$show0 = array(); $show1 = array();$show2 = array();$show3 = array();$show4 = array();$show5 = array();$show6 = array();$show7 = array();$show8 = array();$show9 = array();$show10 = array();
	$show11 = array();$show12 = array();$show13 = array();$show14 = array();$show15 = array();$show16 = array();$show17 = array();$show18 = array();$show19 = array();$show20 = array();$show21 = array();$show22 = array();$show23 = array();$show24 = array();$show25 = array();$show26 = array();$show27 = array();$show28 = array();$show29 = array();
				
				
				$show0['name'] = 'cpu_tem';
				$show0['data'][] = $health['0']['cpu-temperature']." C";

				$show1['name'] = 'tem';
				$show1['data'][] = $health['0']['temperature']." C";

				$show2['name'] = 'volt';
				$show2['data'][] = $health['0']['voltage']." Volt";

				$show3['name'] = 'watt';
				$show3['data'][] = $health['0']['power-consumption']." Watt";

				$show4['name'] = 'cpu_load';
				$show4['data'][] = $resource['0']['cpu-load']." %";

				$show5['name'] = 'current';
				$show5['data'][] = $health['0']['current']." mA";

				$show6['name'] = 'active-fan';
				$show6['data'][] = $health['0']['active-fan'];

				$show7['name'] = 'fan1-speed';
				$show7['data'][] = $health['0']['fan1-speed']." RPM";

				$show8['name'] = 'fan2-speed';
				$show8['data'][] = $health['0']['fan2-speed']." RPM";

				$show9['name'] = 'free-memory';
				$show9['data'][] = round(($resource['0']['free-memory']/1048576),1)." MB";

				$show10['name'] = 'free-hdd-space';
				$show10['data'][] = round(($resource['0']['free-hdd-space']/1048576),1)." MB";

				$show11['name'] = 'uptime';
				$show11['data'][] = $resource['0']['uptime'];

				$show12['name'] = 'hotspot-active';
				$show12['data'][] = count($hotspot)." Clients";

				$show13['name'] = 'pppoe-active';
				$show13['data'][] = count($pppoe)." Clients";
                
				$show14['name'] = 'ap-online';
				$show14['data'][] = count($neighbor)." Clients";

				$show15['name'] = 'panel-uptime';
				$show15['data'][] = "Uptime : ".($resource['0']['uptime']);

				$show16['name'] = 'time';
				$show16['data'][] = "Time : ".($clock['0']['time']);

				$show17['name'] = 'date';
				$show17['data'][] = "Date : ".($clock['0']['date']);

				$show18['name'] = 'fan_mode';
				$show18['data'][] = $health[0]["fan-mode"];

				$show19['name'] = 'use_fan';
				$show19['data'][] = $health[0]["use-fan"];

				$show20['name'] = 'platform';
				$show20['data'][] = $resource[0]['platform'];

				$show21['name'] = 'board_name';
				$show21['data'][] = $resource[0]['board-name'];

				$show22['name'] = 'version';
				$show22['data'][] = $resource[0]['version'];

				$show23['name'] = 'cpu_model';
				$show23['data'][] = $resource[0]['cpu'];

				$show24['name'] = 'cpu_count';
				$show24['data'][] = $resource[0]['cpu-count']." Core";

				$show25['name'] = 'cpu_frequency';
				$show25['data'][] = $resource[0]['cpu-frequency']." MHz";

				$show26['name'] = 'total_mem';
				$show26['data'][] = round(($resource[0]['total-memory']/1048576),1)." MB";

				$show27['name'] = 'total_hdd';
				$show27['data'][] = round(($resource[0]['total-hdd-space']/1048576),1)." MB";

				$show28['name'] = 'architecture_name';
				$show28['data'][] = $resource[0]['architecture-name'];

				$show29['name'] = 'build_time';
				$show29['data'][] = $resource[0]['build-time'];

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
	array_push($res,$show7);
	array_push($res,$show8);
	array_push($res,$show9);
	array_push($res,$show10);
	array_push($res,$show11);
	array_push($res,$show12);
	array_push($res,$show13);
	array_push($res,$show14);
	array_push($res,$show15);
	array_push($res,$show16);
	array_push($res,$show17);
	array_push($res,$show18);
	array_push($res,$show19);
	array_push($res,$show20);
	array_push($res,$show21);
	array_push($res,$show22);
	array_push($res,$show23);
	array_push($res,$show24);
	array_push($res,$show25);
	array_push($res,$show26);
	array_push($res,$show27);
	array_push($res,$show28);
	array_push($res,$show29);
	print json_encode($res, JSON_NUMERIC_CHECK);

?>
