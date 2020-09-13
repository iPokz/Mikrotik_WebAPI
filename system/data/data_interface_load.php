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

			$ARRAY = $API->comm("/interface/print");
			$num =count($ARRAY);
			for($i=0; $i<$num; $i++){
		$num_tx=(round($ARRAY[$i]['tx-byte']/1073741824,2));
	   $num_rx=(round($ARRAY[$i]['rx-byte']/1073741824,2));
	 
	  if(($num_tx+$num_rx)>0){
	   $rows_tx[]= array('name' =>''.$ARRAY[$i]['name'].'','y' =>$num_tx,'drilldown'=>null);
	   $rows_rx[]= array('name' =>''.$ARRAY[$i]['name'].'','y' =>$num_rx,'drilldown'=>null);
	   $series['series']= array(array('name'=>'TX','data'=>$rows_tx),array('name'=>'RX','data'=>$rows_rx));
	   
	  }
			
			}
	//$series1['drilldown']='';		
    $data_title['title']=array('text'=>'INTERFACE TX,RX BYTES');
    $data_subtitle['subtitle']=array('text'=>'แสดงค่า tx/rx interface');
	   
	}
$result = array();
array_push($result,$series);
///array_push($result,$series1);
array_push($result,$data_title);
array_push($result,$data_subtitle);
//print json_encode($result, JSON_NUMERIC_CHECK);
print json_encode($result);
				?>