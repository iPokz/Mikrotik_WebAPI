<?php
	
	include_once('../config/routeros_api.class.php');
	include_once('../include/conn.php');
	$clock = $API->comm("/system/clock/print");
	$pro_no1=$_REQUEST['pro_no1'];
	$pro_no2=$_REQUEST['pro_no2'];
	$pro_no3=$_REQUEST['pro_no3'];
	$pro_no4=$_REQUEST['pro_no4'];
	$pro_no5=$_REQUEST['pro_no5'];
	$pro_no6=$_REQUEST['pro_no6'];
	$pro_no7=$_REQUEST['pro_no7'];
	$pro_no8=$_REQUEST['pro_no8'];
	$pro_no9=$_REQUEST['pro_no9'];
	$pro_no10=$_REQUEST['pro_no10'];
	
	
	$scr_no1=""; if($pro_no1!=""){$scr_no1="profile=".$pro_no1."";}
	$scr_no2=""; if($pro_no2!=""){$scr_no2=" || profile=".$pro_no2."";}
	$scr_no3=""; if($pro_no3!=""){$scr_no3=" || profile=".$pro_no3."";}
	$scr_no4=""; if($pro_no4!=""){$scr_no4=" || profile=".$pro_no4."";}
	$scr_no5=""; if($pro_no5!=""){$scr_no5=" || profile=".$pro_no5."";}
	$scr_no6=""; if($pro_no6!=""){$scr_no6=" || profile=".$pro_no6."";}
	$scr_no7=""; if($pro_no7!=""){$scr_no7=" || profile=".$pro_no7."";}
	$scr_no8=""; if($pro_no8!=""){$scr_no8=" || profile=".$pro_no8."";}
	$scr_no9=""; if($pro_no9!=""){$scr_no9=" || profile=".$pro_no9."";}
	$scr_no10=""; if($pro_no10!=""){$scr_no10=" || profile=".$pro_no10."";}
	
	$settotal_pro="".$scr_no1."".$scr_no2."".$scr_no3."".$scr_no4."".$scr_no5."".$scr_no6."".$scr_no7."".$scr_no8."".$scr_no9."".$scr_no10."";

	$offset_remove=$_REQUEST['after_expir'];

    $filter1_str_validity=substr("".$_REQUEST['expirepro_no1']."",-1);
	$filter1_num_validity=round("".$_REQUEST['expirepro_no1']."");
	$filter1_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter1_hour_validity= $filter1_validity_arr[$filter1_str_validity];
    $expirepro_no1=($filter1_num_validity*$filter1_hour_validity);
	
	$filter2_str_validity=substr("".$_REQUEST['expirepro_no2']."",-1);
	$filter2_num_validity=round("".$_REQUEST['expirepro_no2']."");
	$filter2_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter2_hour_validity= $filter2_validity_arr[$filter2_str_validity];
    $expirepro_no2=($filter2_num_validity*$filter2_hour_validity);

	$filter3_str_validity=substr("".$_REQUEST['expirepro_no3']."",-1);
	$filter3_num_validity=round("".$_REQUEST['expirepro_no3']."");
	$filter3_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter3_hour_validity= $filter3_validity_arr[$filter3_str_validity];
    $expirepro_no3=($filter3_num_validity*$filter3_hour_validity);

	$filter4_str_validity=substr("".$_REQUEST['expirepro_no4']."",-1);
	$filter4_num_validity=round("".$_REQUEST['expirepro_no4']."");
	$filter4_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter4_hour_validity= $filter4_validity_arr[$filter4_str_validity];
    $expirepro_no4=($filter4_num_validity*$filter4_hour_validity);

	$filter5_str_validity=substr("".$_REQUEST['expirepro_no5']."",-1);
	$filter5_num_validity=round("".$_REQUEST['expirepro_no5']."");
	$filter5_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter5_hour_validity= $filter5_validity_arr[$filter5_str_validity];
    $expirepro_no5=($filter5_num_validity*$filter5_hour_validity);

	$filter6_str_validity=substr("".$_REQUEST['expirepro_no6']."",-1);
	$filter6_num_validity=round("".$_REQUEST['expirepro_no6']."");
	$filter6_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter6_hour_validity= $filter6_validity_arr[$filter6_str_validity];
    $expirepro_no6=($filter6_num_validity*$filter6_hour_validity);

	$filter7_str_validity=substr("".$_REQUEST['expirepro_no7']."",-1);
	$filter7_num_validity=round("".$_REQUEST['expirepro_no7']."");
	$filter7_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter7_hour_validity= $filter7_validity_arr[$filter7_str_validity];
    $expirepro_no7=($filter7_num_validity*$filter7_hour_validity);

	$filter8_str_validity=substr("".$_REQUEST['expirepro_no8']."",-1);
	$filter8_num_validity=round("".$_REQUEST['expirepro_no8']."");
	$filter8_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter8_hour_validity= $filter8_validity_arr[$filter8_str_validity];
    $expirepro_no8=($filter8_num_validity*$filter8_hour_validity);

	$filter9_str_validity=substr("".$_REQUEST['expirepro_no9']."",-1);
	$filter9_num_validity=round("".$_REQUEST['expirepro_no9']."");
	$filter9_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter9_hour_validity= $filter9_validity_arr[$filter9_str_validity];
    $expirepro_no9=($filter9_num_validity*$filter9_hour_validity);

	$filter10_str_validity=substr("".$_REQUEST['expirepro_no10']."",-1);
	$filter10_num_validity=round("".$_REQUEST['expirepro_no10']."");
	$filter10_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter10_hour_validity= $filter10_validity_arr[$filter10_str_validity];
    $expirepro_no10=($filter10_num_validity*$filter10_hour_validity);



	

   $scr_exno1=""; if($expirepro_no1!=0){$scr_exno1=":if (\"\$prof\" = \"".$pro_no1."\") do={:set offset ".$expirepro_no1."}";}
   $scr_exno2=""; if($expirepro_no2!=0){$scr_exno2=" else={:if (\"\$prof\" = \"".$pro_no2."\") do={:set offset ".$expirepro_no2."}";}
   $scr_exno3=""; if($expirepro_no3!=0){$scr_exno3=" else={:if (\"\$prof\" = \"".$pro_no3."\") do={:set offset ".$expirepro_no3."}";}
   $scr_exno4=""; if($expirepro_no4!=0){$scr_exno4=" else={:if (\"\$prof\" = \"".$pro_no4."\") do={:set offset ".$expirepro_no4."}";}
   $scr_exno5=""; if($expirepro_no5!=0){$scr_exno5=" else={:if (\"\$prof\" = \"".$pro_no5."\") do={:set offset ".$expirepro_no5."}";}
   $scr_exno6=""; if($expirepro_no6!=0){$scr_exno6=" else={:if (\"\$prof\" = \"".$pro_no6."\") do={:set offset ".$expirepro_no6."}";}
   $scr_exno7=""; if($expirepro_no7!=0){$scr_exno7=" else={:if (\"\$prof\" = \"".$pro_no7."\") do={:set offset ".$expirepro_no7."}";}
   $scr_exno8=""; if($expirepro_no8!=0){$scr_exno8=" else={:if (\"\$prof\" = \"".$pro_no8."\") do={:set offset ".$expirepro_no8."}";}
   $scr_exno9=""; if($expirepro_no9!=0){$scr_exno9=" else={:if (\"\$prof\" = \"".$pro_no9."\") do={:set offset ".$expirepro_no9."}";}
   $scr_exno10=""; if($expirepro_no10!=0){$scr_exno10=" else={:if (\"\$prof\" = \"".$pro_no10."\") do={:set offset ".$expirepro_no10."}";}




   $scr_remno1=""; if($expirepro_no1!=0){$scr_remno1=":if (\"\$prof\" = \"".$pro_no1."\") do={:set offset ".($expirepro_no1+$offset_remove)."}";}
   $scr_remno2=""; if($expirepro_no2!=0){$scr_remno2=" else={:if (\"\$prof\" = \"".$pro_no2."\") do={:set offset ".($expirepro_no2+$offset_remove)."}";}
   $scr_remno3=""; if($expirepro_no3!=0){$scr_remno3=" else={:if (\"\$prof\" = \"".$pro_no3."\") do={:set offset ".($expirepro_no3+$offset_remove)."}";}
   $scr_remno4=""; if($expirepro_no4!=0){$scr_remno4=" else={:if (\"\$prof\" = \"".$pro_no4."\") do={:set offset ".($expirepro_no4+$offset_remove)."}";}
   $scr_remno5=""; if($expirepro_no5!=0){$scr_remno5=" else={:if (\"\$prof\" = \"".$pro_no5."\") do={:set offset ".($expirepro_no5+$offset_remove)."}";}
   $scr_remno6=""; if($expirepro_no6!=0){$scr_remno6=" else={:if (\"\$prof\" = \"".$pro_no6."\") do={:set offset ".($expirepro_no6+$offset_remove)."}";}
   $scr_remno7=""; if($expirepro_no7!=0){$scr_remno7=" else={:if (\"\$prof\" = \"".$pro_no7."\") do={:set offset ".($expirepro_no7+$offset_remove)."}";}
   $scr_remno8=""; if($expirepro_no8!=0){$scr_remno8=" else={:if (\"\$prof\" = \"".$pro_no8."\") do={:set offset ".($expirepro_no8+$offset_remove)."}";}
   $scr_remno9=""; if($expirepro_no9!=0){$scr_remno9=" else={:if (\"\$prof\" = \"".$pro_no9."\") do={:set offset ".($expirepro_no9+$offset_remove)."}";}
   $scr_remno10=""; if($expirepro_no10!=0){$scr_remno10=" else={:if (\"\$prof\" = \"".$pro_no10."\") do={:set offset ".($expirepro_no10+$offset_remove)."}";}
  
  
   
   $end2=""; if($expirepro_no2!=0){$end2="}";}
   $end3=""; if($expirepro_no3!=0){$end3="}";}
   $end4=""; if($expirepro_no4!=0){$end4="}";}
   $end5=""; if($expirepro_no5!=0){$end5="}";}
   $end6=""; if($expirepro_no6!=0){$end6="}";}
   $end7=""; if($expirepro_no7!=0){$end7="}";}
   $end8=""; if($expirepro_no8!=0){$end8="}";}
   $end9=""; if($expirepro_no9!=0){$end9="}";}
   $end10=""; if($expirepro_no10!=0){$end10="}";}

  $settotal_expire="".$scr_exno1."".$scr_exno2."".$scr_exno3."".$scr_exno4."".$scr_exno5."".$scr_exno6."".$scr_exno7."".$scr_exno8."".$scr_exno9."".$scr_exno10."".$end10."".$end9."".$end8."".$end7."".$end6."".$end5."".$end4."".$end3."".$end2."";
  $settotal_remove="".$scr_remno1."".$scr_remno2."".$scr_remno3."".$scr_remno4."".$scr_remno5."".$scr_remno6."".$scr_remno7."".$scr_remno8."".$scr_remno9."".$scr_remno10."".$end10."".$end9."".$end8."".$end7."".$end6."".$end5."".$end4."".$end3."".$end2."";


	//$name_expire=$_REQUEST['name'];
	$expire_name="HOTSPOTstep1_Expire_User";
	$disable_name="HOTSPOTstep2_Disable_Expire_User";
	$remove_name="HOTSPOTstep3_Remove_User_Disabled";
	
	$interval_expire="00:01:00";
	$interval_disable="1d";
	$interval_remove="1d";
	$startdate_expire="jan/01/2000";

	//$start_time_expire="startup";
    $start_time_expire=$clock['0']['time'];
	$start_time_disable="23:00:15";
	$start_time_remove="05:00:15";

    $on_event_expire="{:global offset;:global today;:global prof;{:local date [ /system clock get date ];:local time [/system clock get time ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local year [ :pick \$date 7 11 ];:local months ([ :find \$montharray \$monthtxt]);:local hours [:pick \$time 0 2];:local minutes [:pick \$time 3 5];:local seconds [:pick \$time 6 8];:local todaytime ((\$hours*3600) + (\$minutes*60) + (\$seconds));:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ]);:set daysmonth ( [ :pick \$monthdays \$nodays ] );};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:set today (( \$days * 86400 )+\$todaytime);};:foreach i in [ /ip hotspot user find where limit-uptime!=00:00:01 disabled=no(".$settotal_pro." )] do={:if ([ :find [ /ip hotspot user get \$i comment ] ] = 0 ) do={:local date [ /ip hotspot user get \$i comment ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local year [ :pick \$date 7 11 ];:local hours [:pick \$date 12 14];:local minutes [:pick \$date 15 17];:local seconds [:pick \$date 18 20];:local months ( [ :find \$montharray \$monthtxt ] );:local starttime ((\$hours*3600) + (\$minutes*60) + (\$seconds));:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ] );:set daysmonth ( [ :pick \$monthdays \$nodays ] );:set prof [/ip hotspot user get \$i profile ];".$settotal_expire."};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:set days ( \$days * 86400 );:local conoffset ( \$offset * 3600 );:local stoplogoff (\$days + \$conoffset+\$starttime);:if ( \$stoplogoff < \$today ) do={ :local nameEXP [/ip hotspot user get \$i name];:log error \"HOTSPOT EXPIRE SCRIPT: Profile \$prof Set expire user :\$nameEXP  first logged in \$date\";[ /ip hotspot user set \$i limit-uptime=1];[ /ip hotspot active remove [find where user=\$nameEXP] ];}}}}";

	$on_event_disable="{:global offset;:global today;:global prof;{:local date [ /system clock get date ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );:local days [ :pick \$date 4 6 ];:local daysmonth [:pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local year [ :pick \$date 7 11 ];:local months ([:find \$montharray \$monthtxt]);:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [:pick \$monthdays \$nodays ]);:set daysmonth ([:pick \$monthdays \$nodays ]);};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:set today ( \$days * 24 );};:foreach i in [ /ip hotspot user find where limit-uptime=00:00:01 disabled=no(".$settotal_pro." )] do={:if ([ :find [ /ip hotspot user get \$i comment ] ] = 0 ) do={:local date [ /ip hotspot user get \$i comment ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local year [ :pick \$date 7 11 ];:local months ( [ :find \$montharray \$monthtxt ] );:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ] );:set daysmonth ( [ :pick \$monthdays \$nodays ] );:set prof [/ip hotspot user get \$i profile ];".$settotal_expire."};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:if ( ((\$days*24) + \$offset) < \$today ) do={ :local nameDIS [/ip hotspot user get \$i name];:log info \"HOTSPOT DISABLE EXPIRE USERS SCRIPT:Disabling Hotspot user \$nameDIS first logged in \$date\"; [ /ip hotspot user disable \$i ];}}}}";

	$on_event_remove="{:global offset;:global today;:global prof;{:local date [ /system clock get date ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );:local days [ :pick \$date 4 6 ];:local daysmonth [:pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local year [ :pick \$date 7 11 ];:local months ([:find \$montharray \$monthtxt]);:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [:pick \$monthdays \$nodays ]);:set daysmonth ([:pick \$monthdays \$nodays ]);};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:set today ( \$days * 24 );};:foreach i in [ /ip hotspot user find where limit-uptime=00:00:01 disabled=yes(".$settotal_pro." )] do={:if ([ :find [ /ip hotspot user get \$i comment ] ] = 0 ) do={:local date [ /ip hotspot user get \$i comment ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local year [ :pick \$date 7 11 ];:local months ( [ :find \$montharray \$monthtxt ] );:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ] );:set daysmonth ( [ :pick \$monthdays \$nodays ] );:set prof [/ip hotspot user get \$i profile ];".$settotal_remove."};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:if ( ((\$days*24) + \$offset) < \$today ) do={ :local nameREM [/ip hotspot user get \$i name];:log error \"HOTSPOT REMOVE  USER DISABLED SCRIPT:remove Hotspot user \$nameREM first logged in \$date\"; [ /ip hotspot user remove \$i ];}}}}";
    

	if($pro_no1 != ""){

		//check script error//
		$ch_all=0;
	if(($pro_no1 != "")||($expirepro_no1 != 0)){
        if(($pro_no1 == "")||($expirepro_no1 == 0)){$ch_all=1;$show_error="Package No.1 ERROR ";}}
	if(($pro_no2 != "")||($expirepro_no2 != 0)){
        if(($pro_no2 == "")||($expirepro_no2 == 0)){$ch_all=1;$show_error="Package No.2 ERROR ";}}
	if(($pro_no3 != "")||($expirepro_no3 != 0)){
        if(($pro_no3 == "")||($expirepro_no3 == 0)){$ch_all=1;$show_error="Package No.3 ERROR ";}}
	if(($pro_no4 != "")||($expirepro_no4 != 0)){
        if(($pro_no4 == "")||($expirepro_no4 == 0)){$ch_all=1;$show_error="Package No.4 ERROR ";}}
	if(($pro_no5 != "")||($expirepro_no5 != 0)){
        if(($pro_no5 == "")||($expirepro_no5 == 0)){$ch_all=1;$show_error="Package No.5 ERROR ";}}
	if(($pro_no6 != "")||($expirepro_no6 != 0)){
        if(($pro_no6 == "")||($expirepro_no6 == 0)){$ch_all=1;$show_error="Package No.6 ERROR ";}}
	if(($pro_no7 != "")||($expirepro_no7 != 0)){
        if(($pro_no7 == "")||($expirepro_no7 == 0)){$ch_all=1;$show_error="Package No.7 ERROR ";}}
	if(($pro_no8 != "")||($expirepro_no8 != 0)){
        if(($pro_no8 == "")||($expirepro_no8 == 0)){$ch_all=1;$show_error="Package No.8 ERROR ";}}
	if(($pro_no9 != "")||($expirepro_no9 != 0)){
        if(($pro_no9 == "")||($expirepro_no9 == 0)){$ch_all=1;$show_error="Package No.9 ERROR ";}}
	if(($pro_no10 != "")||($expirepro_no10 != 0)){
        if(($pro_no10 == "")||($expirepro_no10 == 0)){$ch_all=1;$show_error="Package No.10 ERROR ";}}
         
		  //End//
    if($ch_all != 0){
				echo "<script language='javascript'>swal('".$show_error."!','กรุณาตรวจสอบความถูกต้อง!','error').then(function () {
               window.history.back();}, function (dismiss) {
             if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
            }else{
	$script = $API->comm("/system/scheduler/print");
	$i=0;
	     $num =count($script);
		for($i=0; $i<$num; $i++){
			if($script[$i]['name']==$expire_name){$error=$script[$i]['name']; }
			if($script[$i]['name']==$disable_name){$error=$script[$i]['name']; }
			if($script[$i]['name']==$remove_name){$error=$script[$i]['name']; }}
			if($error != ""){
				echo "<script language='javascript'>swal('Error Name!','มีชื่อ ".$error." แล้วใน scheduler               กรุณาลบหรือตั้งชื่อใหม่!','error').then(function () {
               window.history.back();}, function (dismiss) {
             if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
            }else{
	
	
	$ARRAY = $API->comm("/system/scheduler/add", array(
									"name" => $expire_name,
									 "interval" => $interval_expire,
									"on-event" => $on_event_expire,
				                    "start-time" => $start_time_expire
		                           
									
								));
    $ARRAY = $API->comm("/system/scheduler/add", array(
									"name" => $disable_name,
									 "interval" => $interval_disable,
									"on-event" => $on_event_disable,
				                    "start-time" => $start_time_disable
									
								));
	$ARRAY = $API->comm("/system/scheduler/add", array(
									"name" => $remove_name,
									 "interval" => $interval_remove,
									"on-event" => $on_event_remove,
				                    "start-time" => $start_time_remove
									
								));

		
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no1."'WHERE pro_name='".$pro_no1."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no2."'WHERE pro_name='".$pro_no2."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no3."'WHERE pro_name='".$pro_no3."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no4."'WHERE pro_name='".$pro_no4."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no5."'WHERE pro_name='".$pro_no5."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no6."'WHERE pro_name='".$pro_no6."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no7."'WHERE pro_name='".$pro_no7."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no8."'WHERE pro_name='".$pro_no8."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no9."'WHERE pro_name='".$pro_no9."'");
mysql_query("UPDATE mt_profile SET pro_expire='".$expirepro_no10."'WHERE pro_name='".$pro_no10."'");

			echo "<script language='javascript'>swal('Save Done!','เพิ่ม Script 1.".$expire_name." 2.".$disable_name." และ  3.".$remove_name." สำเร็จแล้ว','success').then(function () {
    window.location.href = '../system/index.php';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php';
   }})</script>";
			
			exit();
			}}}
		
?>