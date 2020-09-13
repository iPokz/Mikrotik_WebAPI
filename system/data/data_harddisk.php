<?php
require_once('key.php');
$ipRouteros = $ip;
$Username=$user;
$Pass=$pass;
$api_puerto=8728;
$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {

	             //$data = array();
                $res = $API->comm("/system/resource/print");
				$total_hdd_chart = round(($res[0]['total-hdd-space']/1048576),1);
               $free_hdd_chart = round(($res[0]['free-hdd-space']/1048576),1);
               $used_hdd_chart=round(($total_hdd_chart-$free_hdd_chart),1);
			   $data_free=array("Free-HDD ".$free_hdd_chart." MB",$free_hdd_chart);
			  $data_used=array("Used-HDD ".$used_hdd_chart." MB",$used_hdd_chart);
			   $data_total['series'][]=array('name'=>'Hard Disk chart','data'=>array($data_free,$data_used));
			   $data_title['title']=array('text'=>'แสดง Chart Hard Disk Total '.$total_hdd_chart.' Mb.');
	}
	$API->disconnect();
   $data = array();
	
	array_push($data,$data_total);
	array_push($data,$data_title);
	print json_encode($data, JSON_NUMERIC_CHECK);
   
?>
