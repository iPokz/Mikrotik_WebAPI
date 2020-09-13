<?php


				function bg_color_modify($num_color){
					if($num_color!=""){
				          $set_hours=date('h');
						  $in_color=($set_hours+$num_color);
			$bg_arr=array(
				          "2"=>" bg-green",
				          "3"=>" bg-yellow",
				          "4"=>" bg-red",
				          "5"=>" bg-color-style3",
				           "6"=>" bg-color-style4",
				           "7"=>" bg-color-style7",
				          "8"=>" bg-color-style8",
				          "9"=>" bg-color-style5",
				          "10"=>" bg-color-style1",
				          "11"=>" bg-color-style2",
				         "12"=>" bg-color-style6",
			              "13"=>" bg-color-brown",
				          // "14"=>" bg-aqua",
			              "14"=>" bg-color-pink",
			              "15"=>" bg-green",
				          "16"=>" bg-yellow",
				          "17"=>" bg-red",
				          "18"=>" bg-color-style3",
				           "19"=>" bg-color-style4",
				           "20"=>" bg-color-style7",
				          "21"=>" bg-color-style8",
				          "22"=>" bg-color-style5",
				          "23"=>" bg-color-style1",
				          "24"=>" bg-color-style2",
				         "25"=>" bg-color-style6",
				         "26"=>" bg-color-brown");
			            $output_color=$bg_arr[$in_color];return $output_color;
				           
				}}
				
//<!-- ############################  box box-style ########################################## -->


                function panel_modify($minute_panel){
					          $minute=date('i');
								
				if($minute<=3){$minute_panel="box box-solid box-style1";return $minute_panel;}
				if($minute<=6){$minute_panel="box box-solid box-style2";return $minute_panel;}
				if($minute<=9){$minute_panel="box box-solid box-style3";return $minute_panel;}
				if($minute<=12){$minute_panel="box box-solid box-style4";return $minute_panel;}
				if($minute<=15){$minute_panel="box box-solid box-style5";return $minute_panel;}
				if($minute<=18){$minute_panel="box box-solid box-style6";return $minute_panel;}
				if($minute<=21){$minute_panel="box box-solid box-style7";return $minute_panel;}
				if($minute<=24){$minute_panel="box box-solid box-style8";return $minute_panel;}
				if($minute<=27){$minute_panel="box box-solid box-black";return $minute_panel;}
				if($minute<=30){$minute_panel="box box-solid box-default";return $minute_panel;}
				if($minute<=33){$minute_panel="box box-solid box-primary";return $minute_panel;}
				if($minute<=36){$minute_panel="box box-solid box-warning";return $minute_panel;}
				if($minute<=39){$minute_panel="box box-solid box-danger";return $minute_panel;}
				if($minute<=42){$minute_panel="box box-solid box-info";return $minute_panel;}
				if($minute<=45){$minute_panel="box box-solid box-success";return $minute_panel;}
				if($minute<=48){$minute_panel="box box-solid box-success-mid";return $minute_panel;}
				if($minute<=51){$minute_panel="box box-solid box-info-mid";return $minute_panel;}
				if($minute<=54){$minute_panel="box box-solid box-danger-mid";return $minute_panel;}
				if($minute<=57){$minute_panel="box box-solid box-warning-mid";return $minute_panel;}
				if($minute<=60){$minute_panel="box box-solid box-primary-mid";return $minute_panel;}
				}
               $clock_panel = $API->comm("/system/clock/print");
                $resource_panel = $API->comm("/system/resource/print");

				$date_time_show="<span class=\"pull-right hidden-md hidden-sm hidden-xs  \">Uptime : ".($resource_panel['0']['uptime'])."&nbsp;&nbsp;&nbsp;&nbsp;
				Date : ".($clock_panel['0']['date'])."&nbsp;&nbsp;&nbsp;&nbsp;
				Time : ".($clock_panel['0']['time'])."&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                   $panel_heading="box-header with-border";
//<!-- ###################################################################### -->
//	<!--ฟังชั่น แปลง commentเป็นไทย  may/03/2017=>03/พฤษภาคม/2560-->
			function Convert_time($thai_conv){
					
				$year_arr=substr("".$thai_conv."",-4)+543;//=2560
                $month_comment_arr=substr("".$thai_conv."",-11,3); //jan
               $date_arr=substr("".$thai_conv."",-7,2);//=23
              ///$exe=substr("".$thai_conv."",-5,1);//=/
					
       $month_arr=array("jan"=>"มกราคม","feb"=>"กุมภาพันธ์","mar"=>"มีนาคม","apr"=>"เมษายน","may"=>"พฤษภาคม","jun"=>"มิถุนายน","jul"=>"กรกฎาคม","aug"=>"สิงหาคม","sep"=>"กันยายน","oct"=>"ตุลาคม","nov"=>"พฤศจิกายน","dec"=>"ธันวาคม");
       $thai= $month_arr[$month_comment_arr];
      $convert="".$date_arr."/".$thai."/".$year_arr.""; if($thai_conv==""){$convert = "";}
      $thai_conv=$convert;
	  return $thai_conv;}
##################################################################################################################

				   //	<!--ฟังชั่น แปลง commentเป็นไทย  may/03/2017=>พฤษภาคม/2560-->
			function Convert_time_min($thai_conv){
					
				$year_arr=substr("".$thai_conv."",-4)+543;//=2560
                $month_comment_arr=substr("".$thai_conv."",-11,3); //jan
               $date_arr=substr("".$thai_conv."",-7,2);//=23
              ///$exe=substr("".$thai_conv."",-5,1);//=/
					
       $month_arr=array("jan"=>"มกราคม","feb"=>"กุมภาพันธ์","mar"=>"มีนาคม","apr"=>"เมษายน","may"=>"พฤษภาคม","jun"=>"มิถุนายน","jul"=>"กรกฎาคม","aug"=>"สิงหาคม","sep"=>"กันยายน","oct"=>"ตุลาคม","nov"=>"พฤศจิกายน","dec"=>"ธันวาคม");
       $thai= $month_arr[$month_comment_arr];
      $convert="".$thai."/".$year_arr.""; if($thai_conv==""){$convert = "";}
      $thai_conv=$convert;
	  return $thai_conv;}
#################################################################################################################

////<!--ฟังชั่น แปลง commentเป็นไทย+คำนวนวันหมดอายุุุ  jan/31/2017 23:00:01 , +0=>31มกราคม2560-->jan/31/2017 23:00:01 ,+10=10กุมภาพันธ์2560
////$time_conv=jan/31/2017 23:00:01,$offset=7,$time_on=""(เวลาไม่แสดง)$time_on=1(แสดงเวลา)31มกราคม2560 23:00:01
	         function expdate($time_conv,$offset,$time_on){
             if($time_conv!=""){
               $year_arr=substr("".$time_conv."",-13,4);//=2017 ปี
              $month_comment_arr=substr("".$time_conv."",-20,3); //jan เดือน
               $date_arr=substr("".$time_conv."",-16,2);//=23 วัน
              $hh_arr=substr("".$time_conv."",-8,2);
			  $mm_arr=substr("".$time_conv."",-5,2);
			  $ss_arr=substr("".$time_conv."",-2);
 $month_arr=array("jan"=>(0),"feb"=>(31),"mar"=>(59),"apr"=>(90),"may"=>(120),"jun"=>(151),"jul"=>(181),"aug"=>(212),"sep"=>(243),"oct"=>(273),"nov"=>(304),"dec"=>(334));
       $month_num= ($month_arr[$month_comment_arr]);
      $convert=(($year_arr-2000)*365+($month_num-1)+$date_arr);
	  $tocon=(($hh_arr*3600) + ($mm_arr*60) + ($ss_arr));
	  $convert2=(($convert*86400)+$tocon);
	 $check_offset=($offset*3600);
      $convert3=($convert2+$check_offset);
       $seconds=$convert3;
    $years = floor($seconds / 31536000);
	$days = floor($seconds % 31536000 / 86400);
    $hours = floor($seconds % 86400 / 3600); 
    $minutes = floor($seconds % 3600 / 60); 
    $seconds = $seconds % 60;
	$return=sprintf("%dy%03dd%02d:%02d:%02d", ($years+2000),($days), $hours, $minutes, $seconds);
   $output= "".$return."";
   $month_com=substr("".$output."",-12,3)+1;
$year_com=substr("".$output."",-17,4)+543;
$time_com=substr("".$output."",-8);
if($offset!=""){
$time="";if($time_on!=""){$time=" ".$time_com."";}
if($month_com<=31){$rew="".($month_com)." มกราคม ".$year_com."".$time."";return  $rew;}
if($month_com<=59){$rew="".($month_com-31)." กุมภาพันธ์ ".$year_com."".$time.""; return  $rew;}
if($month_com<=90){$rew="".($month_com-59)." มีนาคม ".$year_com."".$time."" ;return  $rew;}
if($month_com<=120){$rew="".($month_com-90)." เมษายน ".$year_com."".$time."";return  $rew;}
if($month_com<=151){$rew="".($month_com-120)." พฤษภาคม ".$year_com."".$time."";return  $rew;}
if($month_com<=181){$rew="".($month_com-151)." มิถุนายน ".$year_com."".$time."";return  $rew;}
if($month_com<=212){$rew="".($month_com-181)." กรกฎาคม ".$year_com."".$time."";return  $rew;}
if($month_com<=243){$rew="".($month_com-212)." สิงหาคม ".$year_com."".$time."";return  $rew;}
if($month_com<=273){$rew="".($month_com-243)." กันยายน ".$year_com."".$time."";return  $rew;}
if($month_com<=304){$rew="".($month_com-273)." ตุลาคม ".$year_com."".$time."";return  $rew;}
if($month_com<=334){$rew="".($month_com-304)." พฤศจิกายน ".$year_com."".$time."";return  $rew;}
if($month_com>=335){$rew="".($month_com-334)." ธันวาคม ".$year_com."".$time."";return  $rew;}}
}}
############################################################################################################

                                        $now_time = $API->comm("/system/clock/print");
											 $now_date = $API->comm("/system/clock/print");
											  $miktime=($now_time['0']['time']);
											  $mikdate=($now_date['0']['date']);
											 $hh_arr=substr("".$miktime."",-8,2);
			                                 $mm_arr=substr("".$miktime."",-5,2);
			                                 $ss_arr=substr("".$miktime."",-2);
							$todaytime_con=(($hh_arr*3600) + ($mm_arr*60) + ($ss_arr));
							// echo "".$todaytime_con."";
							//  echo "".$mikdate."";
							   $year_arr=substr("".$mikdate."",-4);
                               $month_arr=substr("".$mikdate."",-11,3);
                                $date_arr=substr("".$mikdate."",-7,2);
								// echo "".$date_arr."";
								 $month_arr_con=array("jan"=>(0),"feb"=>(31),"mar"=>(59),"apr"=>(90),"may"=>(120),"jun"=>(151),"jul"=>(181),"aug"=>(212),"sep"=>(243),"oct"=>(273),"nov"=>(304),"dec"=>(334));
                               $month_num= ($month_arr_con[$month_arr]);
							  // echo "".$month_num."";
							$convert=(($year_arr-2000)*365+($month_num-1)+$date_arr);
	                       $tocon=(($hh_arr*3600) + ($mm_arr*60) + ($ss_arr));
	                      $convert_total=(($convert*86400)+$tocon);
                          
#################################################################################################################


	   function exp_time($mik_time,$com_time_conv,$offset) {
		                     
								  //// 1= $mik_time;//////from date+time mikrotik may/03/2017 and 15:28:09
                                 ///   
								///   2= $com_time_conv; ///from comment=may/03/2017 15:28:09
						       ///   3= = from number pro_expire=7
								 ///output=30d 24:45:00
							////////////////////////////////////////////////////
											 
					
						///////////////////////////////////////////////////////
						///comment function////
              $com_year_arr=substr("".$com_time_conv."",-13,4);//=2017 ปี
              $com_month_comment_arr=substr("".$com_time_conv."",-20,3); //jan เดือน
               $com_date_arr=substr("".$com_time_conv."",-16,2);//=23 วัน
              $com_hh_arr=substr("".$com_time_conv."",-8,2);
			  $com_mm_arr=substr("".$com_time_conv."",-5,2);
			  $com_ss_arr=substr("".$com_time_conv."",-2);
		$com_month_arr=array("jan"=>(0),"feb"=>(31),"mar"=>(59),"apr"=>(90),"may"=>(120),"jun"=>(151),"jul"=>(181),"aug"=>(212),"sep"=>(243),"oct"=>(273),"nov"=>(304),"dec"=>(334));
       $com_month_num= ($com_month_arr[$com_month_comment_arr]);
      
	  $com_convert=(($com_year_arr-2000)*365+($com_month_num-1)+$com_date_arr);
	  $com_tocon=(($com_hh_arr*3600) + ($com_mm_arr*60) + ($com_ss_arr));
	  $com_convert2=(($com_convert*86400)+$com_tocon);
	  $com_offset=($offset*3600);
	  $com_convert_total=($com_convert2+$com_offset);
	  $setexpi=($com_convert_total-$mik_time);
	  if(($setexpi)>0){
      
	   
	   
	   $seconds=$setexpi;
    $days = floor($seconds / 86400);
    $hours = floor($seconds % 86400/ 3600); 
    $minutes = floor($seconds % 3600 / 60); 
    $seconds = $seconds % 60; 
 //  return sprintf("%dd %02d:%02d:%02d", $days, $hours, $minutes, $seconds);
   $return=sprintf("%dd %02d:%02d:%02d", $days, $hours, $minutes, $seconds);
   return $return;
}}
##############################################################################################################
         
		  
			 function Expire_color($limit_uptimeA,$uptimeA,$status_userA,$profile_check){
		$pro="";		
        if($limit_uptimeA=="1s"){return $time="#ff0000";}
		if($status_userA=="true"){return $time="#ff0000";}
		if($uptimeA!=""){if($limit_uptimeA==$uptimeA){return $time="#ff0000";}}
        if($profile_check==$pro){return $time="#ff0000";}
        return $time="";
}



###########################################################################################################
function botton_account($account_user,$delete,$disable,$enable,$edit,$print,$export_csv){
        if($account_user!=""){
		if($account_user=="read"){
        if($delete=="on"){
            return $delete="<button  value=\"remove\" data-toggle=\"tooltip\" title= \"select to remove & kick user online\" name=\"active\" class=\"btn btn-danger disabled\" type=\"button\"><i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
	        if($disable=="on"){return $disable="<button value=\"disable\" data-toggle=\"tooltip\" title= \"select to disable & kick user online\" name=\"active\" class=\"btn btn-black disabled\" type=\"button\"><i class=\"fa fa-lock\"></i>&nbsp;Disable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($enable=="on"){return $enable="<button value=\"enable\" data-toggle=\"tooltip\" title= \"select to enable\" name=\"active\" class=\"btn btn-success disabled\" type=\"button\"><i class=\"fa fa-unlock\"></i>&nbsp;Enable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($edit=="on"){return $edit="<button value=\"set\" data-toggle=\"tooltip\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning disabled\" type=\"button\"><i class=\"fa fa-edit\"></i>&nbsp;Edit&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($print=="on"){return $print="<button  value=\"print\" name=\"active\" class=\"btn btn-info disabled\" data-toggle=\"tooltip\" title= \"select to print\" type=\"button\"><i class=\"fa fa-print\"></i>&nbsp;Print&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($export_csv=="on"){return $export_csv="<button  value=\"csv\" name=\"active\" class=\"btn btn-primary disabled\" data-toggle=\"tooltip\" title= \"select to download csv\" type=\"button\"><i class=\"fa fa-download\"></i>&nbsp;Export CSV&nbsp;</button>&nbsp;&nbsp;&nbsp;";}

}
		if($account_user=="write"){
            if($delete=="on"){return $delete="<button value=\"remove\" data-toggle=\"tooltip\" title=\"select to remove & kick user online\" name=\"active\" class=\"btn btn-danger disabled\" type=\"button\"><i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
	        if($disable=="on"){return $disable="<button data-toggle=\"tooltip\" value=\"disable\" title= \"select to disable & kick user online\" name=\"active\" class=\"btn btn-black\" type=\"submit\"><i class=\"fa fa-lock\"></i>&nbsp;Disable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($enable=="on"){return $enable="<button data-toggle=\"tooltip\" value=\"enable\" title= \"select to enable\" name=\"active\" class=\"btn btn-success\" type=\"submit\"><i class=\"fa fa-unlock\"></i>&nbsp;Enable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
		    if($edit=="on"){return $edit="<button data-toggle=\"tooltip\" value=\"set\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning\" type=\"submit\"><i class=\"fa fa-edit\"></i>&nbsp;Edit&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($print=="on"){return $print="<button data-toggle=\"tooltip\"  value=\"print\" name=\"active\" class=\"btn btn-info\" title= \"select to print\" type=\"submit\"><i class=\"fa fa-print\"></i>&nbsp;Print&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($export_csv=="on"){return $export_csv="<button data-toggle=\"tooltip\"  value=\"csv\" name=\"active\" class=\"btn btn-primary\" title= \"select to download csv\" type=\"submit\"><i class=\"fa fa-download\"></i>&nbsp;Export CSV&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
}else{
	        if($delete=="on"){return $delete="<button data-toggle=\"tooltip\"  value=\"remove\" title= \"select to remove & kick user online\" name=\"active\" class=\"btn btn-danger\" type=\"submit\"><i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
	        if($disable=="on"){return $disable="<button data-toggle=\"tooltip\" value=\"disable\" title= \"select to disable & kick user online\" name=\"active\" class=\"btn btn-black\" type=\"submit\"><i class=\"fa fa-lock\"></i>&nbsp;Disable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($enable=="on"){return $enable="<button data-toggle=\"tooltip\" value=\"enable\" title= \"select to enable\" name=\"active\" class=\"btn btn-success\" type=\"submit\"><i class=\"fa fa-unlock\"></i>&nbsp;Enable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
		    if($edit=="on"){return $edit="<button data-toggle=\"tooltip\" value=\"set\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning\" type=\"submit\"><i class=\"fa fa-edit\"></i>&nbsp;Edit&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($print=="on"){return $print="<button data-toggle=\"tooltip\"  value=\"print\" name=\"active\" class=\"btn btn-info\" title= \"select to print\" type=\"submit\"><i class=\"fa fa-print\"></i>&nbsp;Print&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($export_csv=="on"){return $export_csv="<button data-toggle=\"tooltip\"  value=\"csv\" name=\"active\" class=\"btn btn-primary\" title= \"select to download csv\" type=\"submit\"><i class=\"fa fa-download\"></i>&nbsp;Export CSV&nbsp;</button>&nbsp;&nbsp;&nbsp;";}

}
}}


#################################################################################################################

function botton_small_account($small_account_user,$small_delete,$small_disable,$small_enable,$small_edit,$small_transfer,$small_text){
        if($small_account_user!=""){
		if($small_account_user=="read"){
        if($small_delete=="on"){return $small_delete="<button value=\"remove\" data-toggle=\"tooltip\" title= \"select to remove & kick user online\" name=\"active\" class=\"btn btn-danger disabled fa fa-times\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
	        if($small_disable=="on"){return $small_disable="<button value=\"disable\" data-toggle=\"tooltip\" title= \"select to disable & kick user online\" name=\"active\" class=\"btn btn-black disabled fa fa-lock\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_enable=="on"){return $small_enable="<button value=\"enable\" data-toggle=\"tooltip\" title= \"select to enable\" name=\"active\" class=\"btn btn-success disabled fa fa-unlock\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_edit=="on"){return $small_edit="<button value=\"set\" data-toggle=\"tooltip\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning disabled fa fa-edit\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_transfer=="on"){return $small_transfer="<button  value=\"transfer\" data-toggle=\"tooltip\" name=\"active\" class=\"btn btn-default disabled fa fa-exchange \" title= \"".$small_text."\" type=\"button\"> Transfer </button>&nbsp;&nbsp;&nbsp;";}

}
		if($small_account_user=="write"){
             if($small_delete=="on"){return $small_delete="<button value=\"remove\" data-toggle=\"tooltip\" title= \"select to remove & kick user online\" name=\"active\" class=\"btn btn-danger disabled fa fa-times\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
	        if($small_disable=="on"){return $small_disable="<button data-toggle=\"tooltip\" value=\"disable\" title= \"select to disable & kick user online\" name=\"active\" class=\"btn btn-black fa fa-lock\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_enable=="on"){return $small_enable="<button data-toggle=\"tooltip\" value=\"enable\" title= \"select to enable\" name=\"active\" class=\"btn btn-success fa fa-unlock\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_edit=="on"){return $small_edit="<button data-toggle=\"tooltip\" value=\"set\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning fa fa-edit\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_transfer=="on"){return $small_transfer="<button  value=\"transfer\" name=\"active\" class=\"btn btn-default disabled fa fa-exchange \" data-toggle=\"tooltip\" title= \"".$small_text."\" type=\"button\"> Transfer </button>&nbsp;&nbsp;&nbsp;";}
}else{
             if($small_delete=="on"){
             return $small_delete="<button data-toggle=\"tooltip\"  value=\"remove\" title= \"select to remove & kick user online\" name=\"active\" class=\"btn btn-danger fa fa-times\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
	        if($small_disable=="on"){return $small_disable="<button data-toggle=\"tooltip\" value=\"disable\" title= \"select to disable & kick user online\" name=\"active\" class=\"btn btn-black fa fa-lock\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_enable=="on"){return $small_enable="<button data-toggle=\"tooltip\" value=\"enable\" title= \"select to enable\" name=\"active\" class=\"btn btn-success fa fa-unlock\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_edit=="on"){return $small_edit="<button data-toggle=\"tooltip\" value=\"set\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning fa fa-edit\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_transfer=="on"){return $small_transfer="<button data-toggle=\"tooltip\"  value=\"transfer\" name=\"active\" class=\"btn btn-default fa fa-exchange \" title= \"".$small_text."\" type=\"submit\"> Transfer </button>&nbsp;&nbsp;&nbsp;";}
}
}}
##################################################################################################################
function button_btn_xs_account($btn_xs_account_user,$action,$btn_xs_delete,$btn_xs_disable,$btn_xs_enable,$btn_xs_edit,$btn_xs_kick,$text,$btn_xs_print,$btn_xs_export){
        if($btn_xs_account_user!=""){
		if($btn_xs_account_user=="read"){
        	if($btn_xs_delete=="on"){return $btn_xs_delete="<a class=\"btn btn-danger disabled btn-xs\" title= \"click to remove\" ><span class=\"fa fa-times\"></span>ลบ</a>&nbsp;&nbsp;";}
			 if($btn_xs_disable=="on"){return $btn_xs_disable="<a class=\"btn btn-success disabled btn-xs\" title= \"click to disable\" ><span></span> Enable </a>&nbsp;&nbsp;";}
			 if($btn_xs_enable=="on"){return $btn_xs_enable="<a class=\"btn btn-black disabled btn-xs\" title= \"click to enable\" ><span></span>Disable</a>&nbsp;&nbsp;";}
			 if($btn_xs_edit=="on"){return $btn_xs_edit="<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" ".$action."><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";}
			 if($btn_xs_kick=="on"){return $btn_xs_kick="<a class=\"btn btn-success2 disabled btn-xs\" title= \"click to kick user online\" ><span class=\"fa fa-wifi\">".$text."</span></a>&nbsp;&nbsp;";}
			 if($btn_xs_print=="on"){return $btn_xs_print="<a class=\"btn btn-info disabled btn-xs\" title= \"click to print\"  ><span class=\"fa fa-print\"></span> พิมพ์บัตร </a>&nbsp;&nbsp;&nbsp;";}
			 if($btn_xs_export=="on"){return $btn_xs_export="<a class=\"btn btn-primary disabled btn-xs\" title= \"click to download\" ><span class=\"fa fa-download\"></span> Export CSV </a>&nbsp;&nbsp;&nbsp;";}

}
		if($btn_xs_account_user=="write"){
             if($btn_xs_delete=="on"){return $btn_xs_delete="<a class=\"btn btn-danger disabled btn-xs\" title= \"click to remove\" ><span class=\"fa fa-times\"></span>ลบ</a>&nbsp;&nbsp;";}
			 if($btn_xs_disable=="on"){return $btn_xs_disable="<a class=\"btn btn-success btn-xs\" title= \"click to disable\" ".$action."><span></span> Enable </a>&nbsp;&nbsp;";}
			 if($btn_xs_enable=="on"){return $btn_xs_enable="<a class=\"btn btn-black btn-xs\" title= \"click to enable\" ".$action."><span></span>Disable</a>&nbsp;&nbsp;";}
			 if($btn_xs_edit=="on"){return $btn_xs_edit="<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" ".$action."><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";}
			 if($btn_xs_kick=="on"){return $btn_xs_kick="<a class=\"btn btn-success2 btn-xs\" title= \"click to kick user online\" ".$action."><span class=\"fa fa-wifi\">".$text."</span></a>&nbsp;&nbsp;";}
			 if($btn_xs_print=="on"){return $btn_xs_print="<a class=\"btn btn-info btn-xs\" title= \"click to print\" ".$action." ><span class=\"fa fa-print\"></span> พิมพ์บัตร </a>&nbsp;&nbsp;&nbsp;";}
			 if($btn_xs_export=="on"){return $btn_xs_export="<a class=\"btn btn-primary btn-xs\" title= \"click to download\" ".$action."><span class=\"fa fa-download\"></span> Export CSV </a>&nbsp;&nbsp;&nbsp;";}
}else{
             
			 
			 if($btn_xs_delete=="on"){return $btn_xs_delete="<a class=\"btn btn-danger btn-xs\" title= \"click to remove\" ".$action."><span class=\"fa fa-times\"></span>ลบ</a>&nbsp;&nbsp;";}
			 if($btn_xs_disable=="on"){return $btn_xs_disable="<a class=\"btn btn-success btn-xs\" title= \"click to disable\" ".$action."><span></span> Enable </a>&nbsp;&nbsp;";}
			 if($btn_xs_enable=="on"){return $btn_xs_enable="<a class=\"btn btn-black btn-xs\" title= \"click to enable\" ".$action."><span></span>Disable</a>&nbsp;&nbsp;";}
			 if($btn_xs_edit=="on"){return $btn_xs_edit="<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" ".$action."><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";}
			 if($btn_xs_kick=="on"){return $btn_xs_kick="<a class=\"btn btn-success2 btn-xs\" title= \"click to kick user online\" ".$action."><span class=\"fa fa-wifi\"> ".$text."</span></a>&nbsp;&nbsp;";}
			 if($btn_xs_print=="on"){return $btn_xs_print="<a class=\"btn btn-info btn-xs\" title= \"click to print\" ".$action." ><span class=\"fa fa-print\"></span> พิมพ์บัตร </a>&nbsp;&nbsp;&nbsp;";}
			 if($btn_xs_export=="on"){return $btn_xs_export="<a class=\"btn btn-primary btn-xs\" title= \"click to download\" ".$action."><span class=\"fa fa-download\"></span> Export CSV </a>&nbsp;&nbsp;&nbsp;";}
	        
}
}}
#########################################################################################################

function button_btn_submit_account($btn_btn_account_user,$btn_text,$btn_success,$btn_danger,$btn_warning,$btn_primary,$btn_info,$btn_black){
        if($btn_btn_account_user!=""){
		if($btn_btn_account_user=="read"){
			 if($btn_success=="on"){return $btn_success="<button class=\"btn btn-success disabled \"  data-toggle=\"tooltip\" type=\"button\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}
			 if($btn_danger=="on"){return $btn_danger="<button class=\"btn btn-danger disabled \"  data-toggle=\"tooltip\" title=\"select to delete\" value=\"remove\"  name=\"active\" type=\"button\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}        	


}
		if($btn_btn_account_user=="write"){
			 if($btn_success=="on"){return $btn_success="<button data-toggle=\"tooltip\" class=\"btn btn-success \" type=\"submit\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}
			 if($btn_danger=="on"){return $btn_danger="<button class=\"btn btn-danger disabled \"  data-toggle=\"tooltip\" title=\"select to delete\" value=\"remove\"  name=\"active\" type=\"button\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}


}else{
			 if($btn_success=="on"){return $btn_success="<button data-toggle=\"tooltip\" class=\"btn btn-success \" name=\"active\" value=\"active\" type=\"submit\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}
			 if($btn_danger=="on"){return $btn_danger="<button data-toggle=\"tooltip\" class=\"btn btn-danger \" title=\"select to delete\" value=\"remove\"  name=\"active\" type=\"submit\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}             
}
}}
###################################

   

?>


