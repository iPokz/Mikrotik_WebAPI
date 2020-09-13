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
 $sql="SELECT * FROM mt_money_year WHERE mt_id='".$id."'";

													$query=mysql_query($sql);	
													While($result=mysql_fetch_array($query)){	
     
    $thaiyear=($result['year']+0);
	$jan=$result['jan'];
	$money_jan=round(substr("".$jan."",-20),2);
	$drilldown_jan="".$result['year']."".substr("".$jan."",-4)."-id".$id."";
	if($money_jan==0){$drilldown_jan=null;$money_jan=null;}
	$data_jan=array('name'=>'January','y'=>$money_jan,'drilldown'=>$drilldown_jan);
    

	$feb=$result['feb'];
	$money_feb=round(substr("".$feb."",-20),2);
	$drilldown_feb="".$result['year']."".substr("".$feb."",-4)."-id".$id."";
	 if($money_feb==0){$drilldown_feb=null;$money_feb=null;}
	$data_feb=array('name'=>'February','y'=>$money_feb,'drilldown'=>$drilldown_feb);
   

	$mar=$result['mar'];
	$money_mar=round(substr("".$mar."",-20),2);
	$drilldown_mar="".$result['year']."".substr("".$mar."",-4)."-id".$id."";
	  if($money_mar==0){$drilldown_mar=null;$money_mar=null;}
	$data_mar=array('name'=>'March','y'=>$money_mar,'drilldown'=>$drilldown_mar);
   

	$apr=$result['apr'];
	$money_apr=round(substr("".$apr."",-20),2);
	$drilldown_apr="".$result['year']."".substr("".$apr."",-4)."-id".$id."";
	if($money_apr==0){$drilldown_apr=null;$money_apr=null;}
	$data_apr=array('name'=>'April','y'=>$money_apr,'drilldown'=>$drilldown_apr);
  

	$may=$result['may'];
	$money_may=round(substr("".$may."",-20),2);
	$drilldown_may="".$result['year']."".substr("".$may."",-4)."-id".$id."";
	if($money_may==0){$drilldown_may=null;$money_may=null;}
	$data_may=array('name'=>'May','y'=>$money_may,'drilldown'=>$drilldown_may);
  

	$jun=$result['jun'];
	$money_jun=round(substr("".$jun."",-20),2);
	$drilldown_jun="".$result['year']."".substr("".$jun."",-4)."-id".$id."";
	if($money_jun==0){$drilldown_jun=null;$money_jun=null;}
	$data_jun=array('name'=>'June','y'=>$money_jun,'drilldown'=>$drilldown_jun);
   

	$jul=$result['jul'];
	$money_jul=round(substr("".$jul."",-20),2);
	$drilldown_jul="".$result['year']."".substr("".$jul."",-4)."-id".$id."";
	if($money_jul==0){$drilldown_jul=null;$money_jul=null;}
	$data_jul=array('name'=>'July','y'=>$money_jul,'drilldown'=>$drilldown_jul);
  

	$aug=$result['aug'];
	$money_aug=round(substr("".$aug."",-20),2);
	$drilldown_aug="".$result['year']."".substr("".$aug."",-4)."-id".$id."";
	if($money_aug==0){$drilldown_aug=null;$money_aug=null;}
	$data_aug=array('name'=>'August','y'=>$money_aug,'drilldown'=>$drilldown_aug);


	$sep=$result['sep'];
	$money_sep=round(substr("".$sep."",-20),2);
	$drilldown_sep="".$result['year']."".substr("".$sep."",-4)."-id".$id."";
	if($money_sep==0){$drilldown_sep=null;$money_sep=null;}
	$data_sep=array('name'=>'September','y'=>$money_sep,'drilldown'=>$drilldown_sep);
   

	$oct=$result['oct'];
	$money_oct=round(substr("".$oct."",-20),2);
	$drilldown_oct="".$result['year']."".substr("".$oct."",-4)."-id".$id."";
	if($money_oct==0){$drilldown_oct=null;$money_oct=null;}
	$data_oct=array('name'=>'October','y'=>$money_oct,'drilldown'=>$drilldown_oct);
  

	$nov=$result['nov'];
	$money_nov=round(substr("".$nov."",-20),2);
	$drilldown_nov="".$result['year']."".substr("".$nov."",-4)."-id".$id."";
	 if($money_nov==0){$drilldown_nov=null;$money_nov=null;}
	$data_nov=array('name'=>'November','y'=>$money_nov,'drilldown'=>$drilldown_nov);
 

	$december=$result['december'];
	$money_december=round(substr("".$december."",-20),2);
	$drilldown_december="".$result['year']."".substr("".$december."",-4)."-id".$id."";
	if($money_december==0){$drilldown_december=null;$money_december=null;}
	$data_december=array('name'=>'December','y'=>$money_december,'drilldown'=>$drilldown_december);
   
    $year_money=(($money_jan)+($money_feb)+($money_mar)+($money_apr)+($money_may)+($money_jun)+($money_jul)+($money_aug)+($money_sep)+($money_oct)+($money_nov)+($money_december));

$data= array($data_jan,$data_feb,$data_mar,$data_apr,$data_may,$data_jun,$data_jul,$data_aug,$data_sep,$data_oct,$data_nov,$data_december);
    
	 $series0=array();///$series1=array();//$year_data=array();

	$year_data[]=array('name'=>$thaiyear,'y'=>$year_money,'drilldown'=>$result['year'].'-id'.$id);	
			
	
	$series0['series'][]=array('colorByPoint'=>true,'name'=>'YEARS ','data'=>$year_data);
	$series1['drilldown'][]=array('colorByPoint'=>true,'name'=>'Months '.$thaiyear,'id'=>$result['year'].'-id'.$id,'data'=>$data);

	}

################################################
  $sql="SELECT * FROM mt_money_month WHERE mt_id='".$id."'";

													$query=mysql_query($sql);	
													While($result=mysql_fetch_array($query)){
			
		 $year_data=substr("".$result['month_code']."",-20,4);//2017
	  $month_data_sup=substr("".$result['month_code']."",-20,8);
	  $month_data=substr("".$month_data_sup."",-3);//jan
        $drilldown_arr01=array('01',(int)$result['day_01']); if($result['day_01']==""){$drilldown_arr01=null;}
		$drilldown_arr02=array('02',(int)$result['day_02']); if($result['day_02']==""){$drilldown_arr02=null;}
		$drilldown_arr03=array('03',(int)$result['day_03']); if($result['day_03']==""){$drilldown_arr03=null;}
		$drilldown_arr04=array('04',(int)$result['day_04']); if($result['day_04']==""){$drilldown_arr04=null;}
		$drilldown_arr05=array('05',(int)$result['day_05']); if($result['day_05']==""){$drilldown_arr05=null;}
		$drilldown_arr06=array('06',(int)$result['day_06']); if($result['day_06']==""){$drilldown_arr06=null;}
		$drilldown_arr07=array('07',(int)$result['day_07']); if($result['day_07']==""){$drilldown_arr07=null;}
		$drilldown_arr08=array('08',(int)$result['day_08']); if($result['day_08']==""){$drilldown_arr08=null;}
		$drilldown_arr09=array('09',(int)$result['day_09']); if($result['day_09']==""){$drilldown_arr09=null;}
		$drilldown_arr10=array('10',(int)$result['day_10']); if($result['day_10']==""){$drilldown_arr10=null;}
		$drilldown_arr11=array('11',(int)$result['day_11']); if($result['day_11']==""){$drilldown_arr11=null;}
		$drilldown_arr12=array('12',(int)$result['day_12']); if($result['day_12']==""){$drilldown_arr12=null;}
		$drilldown_arr13=array('13',(int)$result['day_13']); if($result['day_13']==""){$drilldown_arr13=null;}
		$drilldown_arr14=array('14',(int)$result['day_14']); if($result['day_14']==""){$drilldown_arr14=null;}
		$drilldown_arr15=array('15',(int)$result['day_15']); if($result['day_15']==""){$drilldown_arr15=null;}
		$drilldown_arr16=array('16',(int)$result['day_16']); if($result['day_16']==""){$drilldown_arr16=null;}
		$drilldown_arr17=array('17',(int)$result['day_17']); if($result['day_17']==""){$drilldown_arr17=null;}
		$drilldown_arr18=array('18',(int)$result['day_18']); if($result['day_18']==""){$drilldown_arr18=null;}
		$drilldown_arr19=array('19',(int)$result['day_19']); if($result['day_19']==""){$drilldown_arr19=null;}
		$drilldown_arr20=array('20',(int)$result['day_20']); if($result['day_20']==""){$drilldown_arr20=null;}
		$drilldown_arr21=array('21',(int)$result['day_21']); if($result['day_21']==""){$drilldown_arr21=null;}
		$drilldown_arr22=array('22',(int)$result['day_22']); if($result['day_22']==""){$drilldown_arr22=null;}
		$drilldown_arr23=array('23',(int)$result['day_23']); if($result['day_23']==""){$drilldown_arr23=null;}
		$drilldown_arr24=array('24',(int)$result['day_24']); if($result['day_24']==""){$drilldown_arr24=null;}
		$drilldown_arr25=array('25',(int)$result['day_25']); if($result['day_25']==""){$drilldown_arr25=null;}
		$drilldown_arr26=array('26',(int)$result['day_26']); if($result['day_26']==""){$drilldown_arr26=null;}
		$drilldown_arr27=array('27',(int)$result['day_27']); if($result['day_27']==""){$drilldown_arr27=null;}
		$drilldown_arr28=array('28',(int)$result['day_28']); if($result['day_28']==""){$drilldown_arr28=null;}
		$drilldown_arr29=array('29',(int)$result['day_29']); if($result['day_29']==""){$drilldown_arr29=null;}
		$drilldown_arr30=array('30',(int)$result['day_30']); if($result['day_30']==""){$drilldown_arr30=null;}
		$drilldown_arr31=array('31',(int)$result['day_31']); if($result['day_31']==""){$drilldown_arr31=null;}

		$drilldown_arr=array($drilldown_arr01,$drilldown_arr02,$drilldown_arr03,$drilldown_arr04,$drilldown_arr05,$drilldown_arr06,$drilldown_arr07,$drilldown_arr08,$drilldown_arr09,$drilldown_arr10,$drilldown_arr11,$drilldown_arr12,$drilldown_arr13,$drilldown_arr14,$drilldown_arr15,$drilldown_arr16,$drilldown_arr17,$drilldown_arr18,$drilldown_arr19,$drilldown_arr20,$drilldown_arr21,$drilldown_arr22,$drilldown_arr23,$drilldown_arr24,$drilldown_arr25,$drilldown_arr26,$drilldown_arr27,$drilldown_arr28,$drilldown_arr29,$drilldown_arr30,$drilldown_arr31,);

$series1['drilldown'][]=array('name'=>''.$month_data.' '.$year_data.'','id'=>$result['month_code'],'data'=>$drilldown_arr);
		

	}
##############################################
}
if(!empty($series0||$series1)){
$result = array();
array_push($result,$series0);
array_push($result,$series1);
print json_encode($result);
//print json_encode($result, JSON_NUMERIC_CHECK);	
}else{
$result = array();
$series0="";
$series1="";
array_push($result,$series0);
array_push($result,$series1);
print json_encode($result);
}
################################################	

				?>