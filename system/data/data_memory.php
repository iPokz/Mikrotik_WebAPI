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
				$total_mem_chart=round(($res[0]['total-memory']/1048576),1);
               $free_mem_chart=round(($res[0]['free-memory']/1048576),1);
               $used_mem_chart=round(($total_mem_chart-$free_mem_chart),1);
			   $data_free=array("Free-Memory ".$free_mem_chart." MB",$free_mem_chart);
			   $data_used=array("Used-Memory ".$used_mem_chart." MB",$used_mem_chart);
	           $data_total['series'][]=array('name'=>'MEMORY chart','data'=>array($data_free,$data_used));
			   $data_title['title']=array('text'=>'แสดง Chart MEMORY Total '.$total_mem_chart.' Mb.'); 
	}
	$API->disconnect();
   $data = array();
	array_push($data,$data_total);
	array_push($data,$data_title);
	print json_encode($data, JSON_NUMERIC_CHECK);
   
?>
