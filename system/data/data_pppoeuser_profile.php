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
           $user_chart = $API->comm("/ppp/secret/print");
			$profile_chart = $API->comm("/ppp/profile/print");
			$num_prochart =count($profile_chart);
			$num_userchart =count($user_chart);
			$chart_count=0;
			for($ch=0; $ch<$num_prochart; $ch++){
      
		$num_pro=0;
		for($i=0; $i<$num_userchart; $i++){
		if($user_chart[$i]['profile']==$profile_chart[$ch]['name']){
		  $num_pro=$num_pro+($chart_count+1);
		}}
		$rows[]= array('name' => $profile_chart[$ch]['name'],'y' =>(int) $num_pro);
		}
		
 $series['series'][]= array('name'=>'PPPOE','data'=>$rows);
$data_title['title']=array('text'=>'PPPOE USERS จากทั้งหมด '.$num_userchart.' users. ('.$num_prochart.' profile.)');
			}
$result = array();
array_push($result,$series);
array_push($result,$data_title);
print json_encode($result, JSON_NUMERIC_CHECK);
				?>