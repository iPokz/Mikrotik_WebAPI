<?php
						include_once('../include/convert.php');

	$ARRAY = $API->comm("/ip/hotspot/user/print");
$ARRAY2 = $API->comm("/tool/user-manager/user/print");
 $ARRAY3 = $API->comm("/ip/hotspot/active/print");
  $ARRAY4 = $API->comm("/ppp/secret/print");
  $ARRAY5 = $API->comm("/ppp/active/print");
  ##########################################################################
                $resource_dash = $API->comm("/system/resource/print");
				$health_dash = $API->comm("/system/health/print");
				$hotspot_dash = $API->comm("/ip/hotspot/active/print");
				$pppoe_dash = $API->comm("/ppp/active/print");
				$neighbor_dash = $API->comm("/ip/neighbor/print");
				$clock_dash = $API->comm("/system/clock/print");
###########################################################################
                               
												$id=$_SESSION['id'];
													$num =count($ARRAY);
													$num2 =count($ARRAY2);
													$num3 =count($ARRAY3);
													$num4 =count($ARRAY4);
													$num5 =count($ARRAY5);
                                                  /// iconv("utf-8", "tis-620",$str)//".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."
												   //iconv("tis-620", "utf-8",$str)
					 ///<!--start update comment from hotspot user to databases-->
													for($i=0; $i<$num; $i++){
									mysql_query("UPDATE mt_gen SET comment='".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."' WHERE user='".$ARRAY[$i]['name']."'");}
                                        //<!--start update comment from pppoe user to databases-->
										for($i=0; $i<$num4; $i++){
									mysql_query("UPDATE pppoe_gen SET comment='".iconv("tis-620", "utf-8",$ARRAY4[$i]['comment'])."' WHERE user='".$ARRAY4[$i]['name']."'");}
													
						//--start update comment from usermanager to databases-->
					for($i=0; $i<$num2; $i++){	
					 mysql_query("UPDATE mt_gen SET comment='".$ARRAY2[$i]['comment']."' WHERE user='".$ARRAY2[$i]['username']."'");}
			          //<!--End update comment-->

					  // <!--start update mac-address and ip-address from user online to databases-->  //	
													for($i=0; $i<$num3; $i++){
													
						mysql_query("UPDATE mt_gen SET mac_address='".$ARRAY3[$i]['mac-address']."', ip_address='".$ARRAY3[$i]['address']."' WHERE user='".$ARRAY3[$i]['user']."'");}
						// <!--start update caller-id and address from pppoe online to databases-->  //	
													for($i=0; $i<$num5; $i++){
													
						mysql_query("UPDATE pppoe_gen SET caller_id='".$ARRAY5[$i]['caller-id']."', address='".$ARRAY5[$i]['address']."' WHERE user='".$ARRAY5[$i]['name']."'");}
						/*<!--End update --> */
					
                    $num_check=0;
                if(!empty($_REQUEST['active'])){
                 if($_REQUEST['active']=="hotspot"){
                $query=mysql_query("SELECT * FROM mt_gen WHERE mt_id='".$id."'");
	              while($resu=mysql_fetch_array($query)){
                  $conv_comment=substr("".$resu['comment']."",-30,11);
                     $id_code="-id".$id.""; if($conv_comment==""){$id_code = "";}
		         $comment_str="".$conv_comment."".$id_code."";
                     if($resu['money_code']!=$comment_str){
			         $run="hotspot";}}}else{
	                  $query=mysql_query("SELECT * FROM pppoe_gen WHERE mt_id='".$id."'");
	                   while($resu=mysql_fetch_array($query)){
						    $conv_comment=substr("".$resu['comment']."",-30,11);
                       $id_code="-id".$id.""; if($conv_comment==""){$id_code = "";}
		              $comment_str="".$conv_comment."".$id_code."";
                        if($resu['money_code']!=$comment_str){
			               $run="pppoe";}}}}

	
	 
	 if(!empty($run)){
                    if($run=="hotspot"){   
						
						
                                 //<!--start update money_code to databases-->
										
								$query=mysql_query("SELECT * FROM mt_gen WHERE mt_id='".$id."'");
	                             while($resu=mysql_fetch_array($query)){
	                  ###รอบที่1###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$resu['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment เพื่อจะนับจำนวนเงิน ###
                           if((($check_profile) && ($check_price))>0){

						 $check_comment1=substr("".$resu['comment']."",-30,11);//////jan/16/2017/////

						  $comm1_check_arr=substr("".$check_comment1."",-5,1); //jan/16/2017อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment1."",-8,1); //jan/16/2017อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>"normal");
			              $check2_comment=array("/"=>"normal");
		                $for_school1=$check1_comment[$comm1_check_arr];
		                  $for_school2=$check2_comment[$comm2_check_arr];
                         ###ถ้า commentมาจากที่ระบบสร้างให้จะเขียน ใส่ money_code###
		                   if(!empty($for_school1 && $for_school2)){
						###หลังจากคัดแล้ว ที่เหลือคือเขียนลง database ##### }} ###จบสคริปคัดกรอง comment ###

                            $id_code="-id".$id.""; if($check_comment1==""){$id_code = "";}
							mysql_query("UPDATE mt_gen SET money_code='".$check_comment1."".$id_code."' WHERE user='".$resu['user']."'");}}}
						//<!--End update money_code to databases-->
													
													
													

                          //<!--start update mt_money to hotspot databases-->
                          $query=mysql_query("SELECT * FROM mt_gen WHERE mt_id='".$id."'");
                          while($part1=mysql_fetch_array($query)){
   ###รอบที่ 2###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$part1['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment เพื่อจะนับจำนวนเงิน ###
                           if((($check_profile) && ($check_price))>0){
						   $check_comment2=substr("".$part1['comment']."",-30,11);
						  $comm1_check_arr=substr("".$check_comment2."",-5,1); //jan/16/2017อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment2."",-8,1); //jan/16/2017อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>"normal");
			              $check2_comment=array("/"=>"normal");
		                   $for_school1=$check1_comment[$comm1_check_arr];
		                  $for_school2=$check2_comment[$comm2_check_arr];
                         ###ถ้า commentมาจากที่ระบบสร้างให้จะเขียน ใส่ mt_money###
		                   if(!empty($for_school1 && $for_school2)){
							###หลังจากคัดแล้ว ที่เหลือคือเขียนลง database ##### }} ######จบสคริปคัดกรอง comment ###

////new
$y_arr=substr("".$check_comment2."",-4);//=2017
$m_arr=substr("".$check_comment2."",-11,3);//may
$d_arr=substr("".$check_comment2."",-7,2);//31
$month_arr=array("jan"=>"01","feb"=>"02","mar"=>"03","apr"=>"04","may"=>"05","jun"=>"06","jul"=>"07","aug"=>"08","sep"=>"09","oct"=>"10","nov"=>"11","dec"=>"12");
$con1_arr= $month_arr[$m_arr];
$con2_arr=($con1_arr)."/".($d_arr)."/".($y_arr);
				$date_utc = new DateTime(''.$con2_arr.'');
				$utc= $date_utc->format('U');
				//$utc_timezone=$utc+($timezone);
			$utc_data=($utc);
///end new
$id_code="-id".$id."";
$month=array( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );
$date=$month[date('m')-1].date ("/d/").date ("Y");
$year=substr("".$check_comment2."",-4);
$month2=substr("".$check_comment2."",-11,3);
$exe=substr("".$check_comment2."",-5,1);
$date2="".$year."".$exe."".$month2."".$id_code."";
$money_code=$part1['money_code'];
$check="SELECT money_code FROM mt_money WHERE money_code='".$money_code."'";
		                   $query2=mysql_query($check);
		                  $rows=mysql_num_rows($query2);
						 // echo "".$rows."//";
		 //<!--start update mt_money to hotspot databases step1-->

if($rows==0){
if($check_comment2!=$date){

	//echo "".$rows."/rows/";
	mysql_query("INSERT INTO mt_money VALUE('".$utc_data."','".$money_code."','".$check_comment2."','".$date2."','".$date2."','','','".$id."')");
$part2=mysql_fetch_array(mysql_query("SELECT * FROM mt_money WHERE money_code='".$money_code."'"));
if($part2['tickets']==""){
$sql="SELECT * FROM mt_gen WHERE money_code='".$money_code."'";
$query3=mysql_query($sql);
$rows2=mysql_num_rows($query3);
//echo "".$rows2."/rows2/";
//echo "".$part2['money_code']."//";
mysql_query("UPDATE mt_money SET tickets='".$rows2."'WHERE money_code='".$part2['money_code']."'");
           $new_update=$new_update+($num_check+1);
}}}
         
}}}
//<!--start update mt_money to hotspot databases step2-->
$query4=mysql_query("SELECT * FROM mt_money WHERE mt_id ='".$id."'");
	           while($part3=mysql_fetch_array($query4)){
				$count=0;
		$query5=mysql_query("SELECT * FROM mt_gen WHERE money_code='".$part3['money_code']."'");
	            while($part4=mysql_fetch_array($query5)){
					
	$money2=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$part4['profile']."'"));
				$count=$count+($money2['pro_price']);
				
				}
if($part3['money']==""){
               // echo "".$count."//";
mysql_query("UPDATE mt_money SET money='".$count."'WHERE money_code='".$part3['money_code']."'");}}
//<!--end update mt_money to hotspot databases-->


  //<!--start update mt_money_month,mt_money_year to hotspot databases step1-->
         $query6=mysql_query("SELECT * FROM mt_money WHERE mt_id='".$id."' GROUP BY month_code ");
           while($part6=mysql_fetch_array($query6)){
			   $count_y=0;
	 
           
              $yearmoney_data=$part6['month'];
               $y_data=substr("".$yearmoney_data."",-8,4);//=2017
			   $m_data=substr("".$yearmoney_data."",-3);//=jan
            // echo "".$y_data."".$m_data."<br>";//2017/jan-id1
  mysql_query("INSERT INTO mt_money_month VALUE('".$part6['month_code']."','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','".$id."')");

  mysql_query("INSERT INTO mt_money_year VALUE('".$y_data."','','','','','','','','','','','','','".$id."')");
  //<!--start update mt_money_year to hotspot databases step2-->
            $query7=mysql_query("SELECT * FROM mt_money WHERE month_code='".$part6['month_code']."'");
           while($part7=mysql_fetch_array($query7)){
		   $count_y=$count_y+($part7['money']);
		   
		 $add_mt_money_month=substr("".$part7['date']."",-7,2);

if($add_mt_money_month=="01"){mysql_query("UPDATE mt_money_month SET day_01='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="02"){mysql_query("UPDATE mt_money_month SET day_02='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="03"){mysql_query("UPDATE mt_money_month SET day_03='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="04"){mysql_query("UPDATE mt_money_month SET day_04='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="05"){mysql_query("UPDATE mt_money_month SET day_05='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="06"){mysql_query("UPDATE mt_money_month SET day_06='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="07"){mysql_query("UPDATE mt_money_month SET day_07='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="08"){mysql_query("UPDATE mt_money_month SET day_08='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="09"){mysql_query("UPDATE mt_money_month SET day_09='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="10"){mysql_query("UPDATE mt_money_month SET day_10='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="11"){mysql_query("UPDATE mt_money_month SET day_11='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="12"){mysql_query("UPDATE mt_money_month SET day_12='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="13"){mysql_query("UPDATE mt_money_month SET day_13='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="14"){mysql_query("UPDATE mt_money_month SET day_14='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="15"){mysql_query("UPDATE mt_money_month SET day_15='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="16"){mysql_query("UPDATE mt_money_month SET day_16='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="17"){mysql_query("UPDATE mt_money_month SET day_17='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="18"){mysql_query("UPDATE mt_money_month SET day_18='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="19"){mysql_query("UPDATE mt_money_month SET day_19='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="20"){mysql_query("UPDATE mt_money_month SET day_20='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="21"){mysql_query("UPDATE mt_money_month SET day_21='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="22"){mysql_query("UPDATE mt_money_month SET day_22='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="23"){mysql_query("UPDATE mt_money_month SET day_23='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="24"){mysql_query("UPDATE mt_money_month SET day_24='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="25"){mysql_query("UPDATE mt_money_month SET day_25='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="26"){mysql_query("UPDATE mt_money_month SET day_26='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="27"){mysql_query("UPDATE mt_money_month SET day_27='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="28"){mysql_query("UPDATE mt_money_month SET day_28='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="29"){mysql_query("UPDATE mt_money_month SET day_29='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="30"){mysql_query("UPDATE mt_money_month SET day_30='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_mt_money_month=="31"){mysql_query("UPDATE mt_money_month SET day_31='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}
		   
		   }
		  
		
		if($m_data=="jan"){mysql_query("UPDATE mt_money_year SET jan='".$count_y."/jan' WHERE year='".$y_data."'");}
		if($m_data=="feb"){mysql_query("UPDATE mt_money_year SET feb='".$count_y."/feb' WHERE year='".$y_data."'");}
		if($m_data=="mar"){mysql_query("UPDATE mt_money_year SET mar='".$count_y."/mar' WHERE year='".$y_data."'");}
		if($m_data=="apr"){mysql_query("UPDATE mt_money_year SET apr='".$count_y."/apr' WHERE year='".$y_data."'");}
		if($m_data=="may"){mysql_query("UPDATE mt_money_year SET may='".$count_y."/may' WHERE year='".$y_data."'");}
		if($m_data=="jun"){mysql_query("UPDATE mt_money_year SET jun='".$count_y."/jun' WHERE year='".$y_data."'");}
		if($m_data=="jul"){mysql_query("UPDATE mt_money_year SET jul='".$count_y."/jul' WHERE year='".$y_data."'");}
		if($m_data=="aug"){mysql_query("UPDATE mt_money_year SET aug='".$count_y."/aug' WHERE year='".$y_data."'");}
		if($m_data=="sep"){mysql_query("UPDATE mt_money_year SET sep='".$count_y."/sep' WHERE year='".$y_data."'");}
		if($m_data=="oct"){mysql_query("UPDATE mt_money_year SET oct='".$count_y."/oct' WHERE year='".$y_data."'");}
		if($m_data=="nov"){mysql_query("UPDATE mt_money_year SET nov='".$count_y."/nov' WHERE year='".$y_data."'");}
		if($m_data=="dec"){mysql_query("UPDATE mt_money_year SET december='".$count_y."/dec' WHERE year='".$y_data."'");}
	  	
		 
		 
		 
			
}}
 if($run=="pppoe"){
	//<!--start update money_code to pppoe user on databases-->

                            $query=mysql_query("SELECT * FROM pppoe_gen WHERE mt_id='".$id."'");
                                               while($resu=mysql_fetch_array($query)){
						 ###รอบที่1###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$resu['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment เพื่อจะนับจำนวนเงิน ###
                           if((($check_profile) && ($check_price))>0){

						 $check_comment1=substr("".$resu['comment']."",-30,11);//////jan/16/2017/////

						  $comm1_check_arr=substr("".$check_comment1."",-5,1); //jan/16/2017อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment1."",-8,1); //jan/16/2017อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>"normal");
			              $check2_comment=array("/"=>"normal");
		                $for_school1=$check1_comment[$comm1_check_arr];
		                  $for_school2=$check2_comment[$comm2_check_arr];
                         ###ถ้า commentมาจากที่ระบบสร้างให้จะเขียน ใส่ money_code###
		                   if(!empty($for_school1 && $for_school2)){
						###หลังจากคัดแล้ว ที่เหลือคือเขียนลง database ##### }} ###จบสคริปคัดกรอง comment ###

                            $id_code="-id".$id.""; if($check_comment1==""){$id_code = "";}
							mysql_query("UPDATE pppoe_gen SET money_code='".$check_comment1."".$id_code."' WHERE user='".$resu['user']."'");}}}

                                 //<!--End update money_code-->  */


	                   
					   
					   //<!--start update pppoe_money to pppoe databases-->
                         $query=mysql_query("SELECT * FROM pppoe_gen WHERE mt_id='".$id."'");
                             while($part1=mysql_fetch_array($query)){
	                      ###รอบที่ 2###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$part1['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment เพื่อจะนับจำนวนเงิน ###
                           if((($check_profile) && ($check_price))>0){
						   $check_comment2=substr("".$part1['comment']."",-30,11);
						  $comm1_check_arr=substr("".$check_comment2."",-5,1); //jan/16/2017อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment2."",-8,1); //jan/16/2017อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>"normal");
			              $check2_comment=array("/"=>"normal");
		                   $for_school1=$check1_comment[$comm1_check_arr];
		                  $for_school2=$check2_comment[$comm2_check_arr];
                         ###ถ้า commentมาจากที่ระบบสร้างให้จะเขียน ใส่ mt_money###
		                   if(!empty($for_school1 && $for_school2)){
							###หลังจากคัดแล้ว ที่เหลือคือเขียนลง database ##### }} ######จบสคริปคัดกรอง comment ###

////new
$y_arr=substr("".$check_comment2."",-4);//=2017
$m_arr=substr("".$check_comment2."",-11,3);//may
$d_arr=substr("".$check_comment2."",-7,2);//31
$month_arr=array("jan"=>"01","feb"=>"02","mar"=>"03","apr"=>"04","may"=>"05","jun"=>"06","jul"=>"07","aug"=>"08","sep"=>"09","oct"=>"10","nov"=>"11","dec"=>"12");
$con1_arr= $month_arr[$m_arr];
$con2_arr=($con1_arr)."/".($d_arr)."/".($y_arr);
				$date_utc = new DateTime(''.$con2_arr.'');
				$utc= $date_utc->format('U');
				////$utc_timezone=$utc+($timezone);
			$utc_data=($utc);
///end new

$id_code="-id".$id."";
$month=array( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );
$date=$month[date('m')-1].date ("/d/").date ("Y");
$year=substr("".$check_comment2."",-4);
$month2=substr("".$check_comment2."",-11,3);
$exe=substr("".$check_comment2."",-5,1);
$date2="".$year."".$exe."".$month2."".$id_code."";
$money_code=$part1['money_code'];
$check="SELECT money_code FROM pppoe_money WHERE money_code='".$money_code."'";
		                   $query2=mysql_query($check);
		                  $rows=mysql_num_rows($query2);
						 // echo "".$rows."//";
		 //<!--start update pppoe_money to pppoe databases step1-->

if($rows==0){
if($check_comment2!=$date){

	//echo "".$rows."/rows/";
	mysql_query("INSERT INTO pppoe_money VALUE('".$utc_data."','".$money_code."','".$check_comment2."','".$date2."','".$date2."','','','".$id."')");
$part2=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_money WHERE money_code='".$money_code."'"));
if($part2['tickets']==""){
$sql="SELECT * FROM pppoe_gen WHERE money_code='".$money_code."'";
$query3=mysql_query($sql);
$rows2=mysql_num_rows($query3);
//echo "".$rows2."/rows2/";
//echo "".$part2['money_code']."//";
mysql_query("UPDATE pppoe_money SET tickets='".$rows2."'WHERE money_code='".$part2['money_code']."'");
                          $new_update=$new_update+($num_check+1);
 }}}
}}}
//<!--start update pppoe_money to pppoe databases step2-->
$query4=mysql_query("SELECT * FROM pppoe_money WHERE mt_id ='".$id."'");
	           while($part3=mysql_fetch_array($query4)){
				$count=0;
		$query5=mysql_query("SELECT * FROM pppoe_gen WHERE money_code='".$part3['money_code']."'");
	            while($part4=mysql_fetch_array($query5)){
					
	$money2=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$part4['profile']."'"));
				$count=$count+($money2['pro_price']);
				
				}
if($part3['money']==""){
               // echo "".$count."//";
mysql_query("UPDATE pppoe_money SET money='".$count."'WHERE money_code='".$part3['money_code']."'");}}

				///<!--End update pppoe_money-->///	
				 
				 
				 //<!--start update ppoe_money_month,pppoe_money_year to pppoe databases step1-->
         $query6=mysql_query("SELECT * FROM pppoe_money WHERE mt_id='".$id."' GROUP BY month_code ");
           while($part6=mysql_fetch_array($query6)){
			   $count_y=0;
	 
           
              $yearmoney_data=$part6['month'];
               $y_data=substr("".$yearmoney_data."",-8,4);//=2017
			   $m_data=substr("".$yearmoney_data."",-3);//=jan
            // echo "".$y_data."".$m_data."<br>";//2017/jan-id1
  mysql_query("INSERT INTO pppoe_money_month VALUE('".$part6['month_code']."','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','".$id."')");

  mysql_query("INSERT INTO pppoe_money_year VALUE('".$y_data."','','','','','','','','','','','','','".$id."')");
  //<!--start update pppoe_money_year to hotspot databases step2-->
            $query7=mysql_query("SELECT * FROM pppoe_money WHERE month_code='".$part6['month_code']."'");
           while($part7=mysql_fetch_array($query7)){
		   $count_y=$count_y+($part7['money']);
		   
		 $add_pppoe_money_month=substr("".$part7['date']."",-7,2);

if($add_pppoe_money_month=="01"){mysql_query("UPDATE pppoe_money_month SET day_01='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="02"){mysql_query("UPDATE pppoe_money_month SET day_02='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="03"){mysql_query("UPDATE pppoe_money_month SET day_03='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="04"){mysql_query("UPDATE pppoe_money_month SET day_04='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="05"){mysql_query("UPDATE pppoe_money_month SET day_05='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="06"){mysql_query("UPDATE pppoe_money_month SET day_06='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="07"){mysql_query("UPDATE pppoe_money_month SET day_07='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="08"){mysql_query("UPDATE pppoe_money_month SET day_08='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="09"){mysql_query("UPDATE pppoe_money_month SET day_09='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="10"){mysql_query("UPDATE pppoe_money_month SET day_10='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="11"){mysql_query("UPDATE pppoe_money_month SET day_11='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="12"){mysql_query("UPDATE pppoe_money_month SET day_12='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="13"){mysql_query("UPDATE pppoe_money_month SET day_13='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="14"){mysql_query("UPDATE pppoe_money_month SET day_14='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="15"){mysql_query("UPDATE pppoe_money_month SET day_15='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="16"){mysql_query("UPDATE pppoe_money_month SET day_16='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="17"){mysql_query("UPDATE pppoe_money_month SET day_17='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="18"){mysql_query("UPDATE pppoe_money_month SET day_18='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="19"){mysql_query("UPDATE pppoe_money_month SET day_19='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="20"){mysql_query("UPDATE pppoe_money_month SET day_20='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="21"){mysql_query("UPDATE pppoe_money_month SET day_21='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="22"){mysql_query("UPDATE pppoe_money_month SET day_22='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="23"){mysql_query("UPDATE pppoe_money_month SET day_23='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="24"){mysql_query("UPDATE pppoe_money_month SET day_24='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="25"){mysql_query("UPDATE pppoe_money_month SET day_25='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="26"){mysql_query("UPDATE pppoe_money_month SET day_26='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="27"){mysql_query("UPDATE pppoe_money_month SET day_27='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="28"){mysql_query("UPDATE pppoe_money_month SET day_28='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="29"){mysql_query("UPDATE pppoe_money_month SET day_29='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="30"){mysql_query("UPDATE pppoe_money_month SET day_30='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}

if($add_pppoe_money_month=="31"){mysql_query("UPDATE pppoe_money_month SET day_31='".$part7['money']."' WHERE month_code='".$part7['month_code']."'");}
		   
		   }
		  
		
		if($m_data=="jan"){mysql_query("UPDATE pppoe_money_year SET jan='".$count_y."/jan' WHERE year='".$y_data."'");}
		if($m_data=="feb"){mysql_query("UPDATE pppoe_money_year SET feb='".$count_y."/feb' WHERE year='".$y_data."'");}
		if($m_data=="mar"){mysql_query("UPDATE pppoe_money_year SET mar='".$count_y."/mar' WHERE year='".$y_data."'");}
		if($m_data=="apr"){mysql_query("UPDATE pppoe_money_year SET apr='".$count_y."/apr' WHERE year='".$y_data."'");}
		if($m_data=="may"){mysql_query("UPDATE pppoe_money_year SET may='".$count_y."/may' WHERE year='".$y_data."'");}
		if($m_data=="jun"){mysql_query("UPDATE pppoe_money_year SET jun='".$count_y."/jun' WHERE year='".$y_data."'");}
		if($m_data=="jul"){mysql_query("UPDATE pppoe_money_year SET jul='".$count_y."/jul' WHERE year='".$y_data."'");}
		if($m_data=="aug"){mysql_query("UPDATE pppoe_money_year SET aug='".$count_y."/aug' WHERE year='".$y_data."'");}
		if($m_data=="sep"){mysql_query("UPDATE pppoe_money_year SET sep='".$count_y."/sep' WHERE year='".$y_data."'");}
		if($m_data=="oct"){mysql_query("UPDATE pppoe_money_year SET oct='".$count_y."/oct' WHERE year='".$y_data."'");}
		if($m_data=="nov"){mysql_query("UPDATE pppoe_money_year SET nov='".$count_y."/nov' WHERE year='".$y_data."'");}
		if($m_data=="dec"){mysql_query("UPDATE pppoe_money_year SET december='".$count_y."/dec' WHERE year='".$y_data."'");}
	  	
		 
		 
		 
			
}}

if(($new_update)>0){
echo "<script language='javascript'>swal('Save Done!','UPDATE ข้อมูล ".$run." จำนวน ".$new_update." รายการสำเร็จแล้ว','success').then(function () {
   }, function (dismiss) {
  if (dismiss === 'overlay') {
    
   }})</script>";
}else{
	echo "<script language='javascript'>swal('NO! UPDATE',' ไม่มีข้อมูล ".$run." ใหม่ ','question').then(function () {
   }, function (dismiss) {
  if (dismiss === 'overlay') {
    
   }})</script>";
}
}
								
									 
									
								    
										?>

<section class="content"> 
				
		 <div class="row">
		 <!--row 1  -->

        <div class="col-lg-3 col-xs-6">
        <div class="small-box <?php print bg_color_modify(1);?>">
            <div class="inner">
             <h3><span class="cpu-load"><?php print $resource_dash['0']['cpu-load']." %";?></span></h3>
              <p>CPU Load</p>
            </div>
            <div class="icon">
              <i class="ion-ios-speedometer"></i>
            </div>
            <a href="#" class="small-box-footer">
              สถานะ CPU <i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
        <!-- ./box1 col -->

        <div class="col-lg-3 col-xs-6">
        <div class="small-box <?php print bg_color_modify(2);?>">
            <div class="inner">
             <h3><span class="ap-online"><?php print count($neighbor_dash)." Clients"; ?></span></h3>
			  <p>Access Points Online</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="javascript:popup('index.php?page=Access_Points_online')" class="small-box-footer">
              อุปกรณ์ ปล่อยสัญญาณ<i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
        <!-- ./box2 col -->


        <div class="col-lg-3 col-xs-6">
         <div class="small-box <?php print bg_color_modify(3);?>">
            <div class="inner">
            <h3><span class="user-online"><?php print  count($hotspot_dash)." Clients"; ?></span></h3>
			  <p>Hotspot User Online</p>
            </div>
            <a href="javascript:popup('index.php?page=useronline')">
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            </a>
            <a href="javascript:popup('index.php?page=mikrotikuser')"  class="small-box-footer">
              Hotspot <?php $ARRAY = $API->comm("/ip/hotspot/user/print", array(
																			"count-only"=> "",
																			"~active-address" => "1.1.",
																		));
																			print_r($ARRAY)?> User    <i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
        <!-- ./box3 col -->


        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php print bg_color_modify(4);?>">
            <div class="inner">
              <h3><span class="pppoe-online"><?php print count($pppoe_dash)." Clients";?></span></h3>
              <p>PPPOE Secret Online</p>
            </div>
			<a href="javascript:popup('index.php?page=pppoe_online')">
            <div class="icon">
              <i class="ion-android-globe"></i>
            </div>
            </a>
            <a href="javascript:popup('index.php?page=pppoe_mik_user')"  class="small-box-footer">
              PPPoe <?php $ARRAY = $API->comm("/ppp/secret/print", array(
																			"count-only"=> "",
																			"~active-address" => "1.1.",
																		));
																			print_r($ARRAY)?> User    <i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
        <!-- ./box4 col -->

      </div>
	  <!-- ./row 1 -->
  <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->                                     
                                            
		                           <div class="row">  
                                <!-- row 2 -->
                                      <div id="mapDiv" class="col-lg-9 col-md-12">
                                              <div class="<?php print panel_modify();?>">
                                                        <div class="<?php print $panel_heading;?>">
                                                               
                     <span class="hidden-md hidden-sm hidden-xs">    
                    <div id="maximize" class="allsize" style="display:block;float: left;" >
						<button  id="sidebar-show-btn" type="button" class="btn btn-box-tool" data-toggle="tooltip" title= "คลิก เพื่อขยาย มอนิเตอร์" onclick="toggle_visibility('pull-right-on'),toggle_visibility('pull-right-off'),toggle_visibility_size('restore')"><h3 class="box-title"><i class="fa fa-window-maximize"></i>&nbsp;&nbsp;&nbsp;MONITOR</h3></button></div>
						</span>
						
						<div id="restore" class="allsize" style="display:none;float: left;" >
						<button  id="sidebar-hide-btn" type="button" class="btn btn-box-tool" data-toggle="tooltip"  title= "คลิก เพื่อลดขนาด มอนิเตอร์" onclick="toggle_visibility('pull-right-off'),toggle_visibility('pull-right-on'),toggle_visibility_size('maximize')"><h3 class="box-title"><i class="fa fa-window-restore"></i>&nbsp;&nbsp;&nbsp;MONITOR</h3></button>
						<span class="hidden-md hidden-sm hidden-xs">
						<button  id="sizeplus" class="btn btn-box-tool"><h3 class="box-title">+</h3></button>
						 <button  id="sizeminus" class="btn btn-box-tool"><h3 class="box-title">-</h3></button>
						 <button  id="sizenormal" class="btn btn-box-tool"><h3 class="box-title">1:1</h3></button>
						 </span>
						 </div>
                        
                                                        

                   
				   
				   
				   
				<span style="float: right;"> 
				  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Interface Traffic" onclick="toggle_visibility_double('Traffic-on');"><h3 class="box-title"><i class="fa fa-line-chart"></i></h3></button>&nbsp;&nbsp;
				    <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Log Detail" onclick="toggle_visibility_double('log-on');"><h3 class="box-title"><i class="fa fa-edit"></i></h3></button>&nbsp;&nbsp;
					 <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Hotspot User Profile Chart" onclick="toggle_visibility_double('hotspot-on');"><h3 class="box-title"><i class="fa fa-wifi"></i></h3></button>&nbsp;&nbsp;
					  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="PPPOE User Profile Chart" onclick="toggle_visibility_double('pppoe-on');"><h3 class="box-title"><i class="fa fa-podcast"></i></h3></button>&nbsp;&nbsp;
					   <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Harddisk Detail" onclick="toggle_visibility_double('hd-on');"><h3 class="box-title"><i class="fa fa-pie-chart"></i></h3></button>&nbsp;&nbsp;
					    <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Memory Detail" onclick="toggle_visibility_double('mem-on');"><h3 class="box-title"><i class="fa fa-microchip"></i></h3></button>&nbsp;&nbsp;
						 <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Hotspot Money Chart" onclick="toggle_visibility_double('hotspot_money-on');"><h3 class="box-title">H <i class="fa fa-bar-chart"></i></h3></button>&nbsp;&nbsp;
						  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="PPPOE Money Chart" onclick="toggle_visibility_double('pppoe_money-on');"><h3 class="box-title">P <i class="fa fa-bar-chart"></i></h3></button>&nbsp;&nbsp;
						  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Hotspot TxRx bytes Chart" onclick="toggle_visibility_double('hotspot_load-on');"><h3 class="box-title">H <i class="fa fa-exchange "></i></h3></button>&nbsp;&nbsp;
						  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Interface TxRx bytes Chart" onclick="toggle_visibility_double('interface_load-on');"><h3 class="box-title">IF <i class="fa fa-exchange "></i></h3></button>&nbsp;&nbsp;
						 <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Mikrotik Resource" onclick="toggle_visibility_double('mikrotik-resource');"><h3 class="box-title"><i class="fa fa-thermometer-half"></i></h3></button>&nbsp;&nbsp;
						 <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Bookmarks" onclick="toggle_visibility_double('bookmarks');"><h3 class="box-title"><i class="fa fa-star"></i></h3></button>&nbsp;&nbsp;
                        
						</span>
                                                          <!--/.pull-right  -->
                                                        </div>
                                                <!-- /.box-header -->
                            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                 
                                                <div class="box-body">
                                                  <div class="box-body">

						<div class="col-lg-12 col-md-12">


                            <div id="Traffic-on" class="alist" style="display:block;" >
							<div class="chart">
                             <!-- <div id="resizer" style="max-height: 400px; width: 730px; max-width: 860px;"> -->
							 <!-- <div id="resizer" style="max-height: 400px; width: 730px; max-width: 860px;"> -->
                            <!-- <div id="inner-resizer"> -->
							<div id="monitor-traffic" style="height: 400px;"></div>
							</div>
							<!-- </div>
							</div> -->
							<select  name="interface"  id="interface" >
	             <?php
				$ARRAY = $API->comm("/interface/print");
				$num =count($ARRAY);
				for($i=0; $i<$num; $i++){
				$seleceted = ($i == 0) ? 'selected="selected"' : '';
				echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
				}?></select>&nbsp;&nbsp;&nbsp;
				
			    </div> 
				<!-- /.Traffic -->


			                 <div id="log-on" class="alist" style="display:none;" >
							<div class="chart">
							<!-- <div class="text-box" > -->
							<p class="text-muted">
                     <span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i> Log from Mikrotik</span></p>
				            <div class="logs" style="height: 330px;"></div>
							<br>
							<br>
							<br>
							<!-- </div> -->
							<!-- /.text-box -->
							 </div>
							 </div>
							  <!-- /.log -->

							   <div id="hotspot-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="pro_hotspot"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.hotspot -->

							   <div id="pppoe-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="pro_pppoe"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.pppoe -->
                    
							  <div id="hd-on" class="alist" style="display:none;">
							<div class="chart">
							<div id="hddchart"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.hd -->

							   <div id="mem-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="memchart"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.mem -->

                             <form name="name" action="" method="post">
							  <div id="hotspot_money-on" class="alist" style="display:none;" >
							 




							<div class="chart">
							<div id="hotspot_money"  style="height: 400px;"></div>
							
							</div>
							
							 <!-- /.chart -->
							 </div>
							  <!-- /.hotspot_money -->

							  <div id="pppoe_money-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="pppoe_money"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.pppoe_money -->
                            </form>
							    <div id="hotspot_load-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="hotspot_load"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.hotspot_load -->

							  <div id="interface_load-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="interface_load"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.interface_load -->


							  <div id="mikrotik-resource" class="alist" style="display:none;" >
							<div class="chart">
							<div class="row">
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}
.style3 {color: #009900}
.style4 {color: #ff8000}
-->
</style>
							<div class="col-md-6 col-xs-12">
                               <div class="text-center"><h3><strong>Mikrotik Resources</strong></h3></div><br><br>
							 <div class="row">
                                  <span class="style1"><div class="col-xs-6">Uptime </div>
                                  <div class="col-xs-6">
                                       <div class="res-up-time"></div></span>
                                  </div>
                          </div>
                          <div class="row">
                                 <span class="style2"><div class="col-xs-6">Device Name </div>
                                  <div class="col-xs-6">
                                       <div class="platform"></div>
                                  </div></span>
                          </div>
                          <div class="row">
                                 <span class="style1"> <div class="col-xs-6">Model</div>
                                  <div class="col-xs-6">
                                       <div class="board_name"></div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">Version  </div>
                                  <div class="col-xs-6">
                                       <div class="version"></div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">CPU </div>
                                  <div class="col-xs-6">
                                      <div class="cpu_model"></div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">CPU Count </div>
                                  <div class="col-xs-6">
                                      <div class="cpu_count"> Core</div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">CPU Frequency </div>
                                  <div class="col-xs-6">
                                      <div class="cpu_frequency"> MHz</div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">CPU Load </div>
                                  <div class="col-xs-6">
                                      <div class="cpu-load"> %</div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">Free Memory </div>
                                  <div class="col-xs-6">
                                      <div class="free-memory"> MB</div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">Total Memory </div>
                                  <div class="col-xs-6">
                                      <div class="total_mem"> MB</div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">Free HDD Space </div>
                                  <div class="col-xs-6">
                                      <div class="free-hdd-space"> MB</div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">Total HDD Size </div>
                                  <div class="col-xs-6">
                                      <div class="total_hdd"> MB</div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">Architecture Name</div>
                                  <div class="col-xs-6">
                                      <div class="architecture_name"></div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">Build Time</div>
                                  <div class="col-xs-6">
                                      <div class="build_time"></div>
                                  </div></span>
                          </div><br>
						 
						  </div>
						  <!-- /.col-->



                           <div class="col-md-6 col-xs-12">
							<div class="text-center"><h3><strong>Mikrotik Health</strong></h3></div><br><br>
							<div class="row">
                            <span class="style3"><div class="col-xs-6">Fan Mode</div>
                            <div class="col-xs-6">
                              <div class="fan_mode"><?=$fan_mode?></div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">Use Fan</div>
                            <div class="col-xs-6">
                              <div class="use_fan"><?=$use_fan?></div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style3"><div class="col-xs-6">Active Fan</div>
                            <div class="col-xs-6">
                              <div class="active-fan"></div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">Voltage. </div>
                            <div class="col-xs-6">
                              <div class="voltage"> Volt</div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style3"><div class="col-xs-6">Temperature</div>
                            <div class="col-xs-6">
                              <div class="temperature"> C</div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">CPU Temperature</div>
                            <div class="col-xs-6">
                              <div class="cpu-temperature"> C</div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style3"><div class="col-xs-6">Current. </div>
                            <div class="col-xs-6">
                              <div class="current"> mA</div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">Power Consumption</div>
                            <div class="col-xs-6">
                              <div class="power-consumption"> Watt</div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style3"><div class="col-xs-6">Fan1 Speed</div>
                            <div class="col-xs-6">
                              <div class="fan1-speed"> RPM</div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">Fan2 Speed</div>
                            <div class="col-xs-6">
                              <div class="fan2-speed"> RPM</div>
                            </div></span>
                      </div>

					  </div>
					  <!-- /.col-->
					
					  </div>
					  <!--/.row  -->
					  </div>
					<!-- /.chart -->
					 </div>
				<!-- /.mikrotik-resource -->

				<div id="bookmarks" class="alist" style="display:none;" >
							<div class="chart">
							<div class="row">
							
							
							<div class="col-md-6 col-xs-12">
							<div class="text-center"><h3><strong>Hotspot Bookmarks</strong></h3></div>
							<div class="row">
							<div class="col-md-4 col-xs-12">
			<a href="index.php?page=interface" class="btn btn-app">
			  <span class="badge <?php print bg_color_modify(12);?>"><?php $ARRAY = $API->comm("/interface/print", array(
												"count-only"=> "",));
			  echo($ARRAY)?></span> <i class="fa fa-signal"></i> Interface</a>



				 <a href="index.php?page=dhcp"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(11);?>"><?php $ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
												"count-only"=> "",
												"~active-address" => "1.1.",));
				print_r($ARRAY)?></span> <i class="fa fa-laptop"></i> Dhcp lease</a>
             
              
			  
              <a href="index.php?page=profilelist"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(10);?>"><?php $ARRAY = $API->comm("/ip/hotspot/user/profile/print", array(
				                                "count-only"=> "",
												"~active-address" => "1.1.",));
				print_r($ARRAY)?></span><i class="fa fa-folder-open"></i> Profile List</a>
			 
			  
			  
			  <a href="index.php?page=mikrotikuser"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(9);?>"><?php $ARRAY = $API->comm("/ip/hotspot/user/print", array(
												"count-only"=> "",
												"~active-address" => "1.1.",));
				$user_total=($ARRAY);print_r($ARRAY);?></span></span><i class="fa fa-users"></i>Mik Users</a>


				 <a href="index.php?page=listuser"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(8);?>"><?php $sql="SELECT * FROM mt_gen WHERE mt_id='".$id."'";
                  $query=mysql_query($sql); $rows=mysql_num_rows($query); echo $rows;?></span>
                <i class="fa fa-database"></i> Database users</a>
				</div>
				<!--./col -->
				
                
				
                <div class="col-md-4 col-xs-12">

				<a href="index.php?page=useronline"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(7);?>"><?php $ARRAY = $API->comm("/ip/hotspot/active/print", array(
				                                "count-only"=> "",
												"~active-address" => "1.1.",));
				print_r($ARRAY)?></span><i class="fa fa-flash"></i> User online</a>


				 <a href="index.php?page=money_month"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(6);?>">1</span><i class="fa fa-bar-chart"></i> Money Chart</a>

				<a href="index.php?page=manuser"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(5);?>">0</span><i class="fa fa-user-plus"></i> Add Mik User</a>

				<a href="index.php?page=add_usermanager"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(4);?>">0</span><i class="fa fa-user-plus"></i> Add Userman</a>

				<a href="#"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(3);?>">0</span><i class="fa fa-question-circle-o"></i> Empty</a>
                </div>
				<!--./col -->
				</div>
				<!-- row -->
				</div>
				<!--./col -->

               
				
				 <div class="col-md-6 col-xs-12">
				<div class="text-center"><h3><strong>PPPOE Bookmarks</strong></h3></div>
				<div class="row">
				
				
				<div class="col-md-4 col-xs-12">
                 <a href="index.php?page=pppoe_profile_list"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(2);?>"><?php $ARRAY = $API->comm("/ppp/profile/print", array(
												"count-only"=> "",
												"~active-address" => "1.1.",
											));
											print_r($ARRAY)?></span>
                <i class="fa fa-folder-open"></i> PPPOE Profile
              </a>
			  <a href="index.php?page=pppoe_mik_user"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(13);?>"><?php $ARRAY = $API->comm("/ppp/secret/print", array(
												"count-only"=> "",
												"~active-address" => "1.1.",
											));
											$pppuser_total=($ARRAY);print_r($ARRAY);?></span></span>
                <i class="fa fa-users"></i> PPPOE Users
              </a>
			  <a href="index.php?page=pppoe_dtb_user"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(12);?>"><?php $sql="SELECT * FROM pppoe_gen WHERE mt_id='".$id."'";
                                             $query=mysql_query($sql);
                                              $rows=mysql_num_rows($query); echo $rows;?></span>
                <i class="fa fa-database"></i> Database users
              </a>
			  
			   
			   <a href="index.php?page=pppoe_money_month"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(11);?>">1</span>
                <i class="fa fa-bar-chart"></i> Money Chart</a>


				<a href="#"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(10);?>">0</span><i class="fa fa-question-circle-o"></i> Empty</a>
			  
			  </div>
			  <div class="col-md-4 col-xs-12">
			  <a href="#"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(9);?>">0</span><i class="fa fa-question-circle-o"></i> Empty</a>

				<a href="#"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(8);?>">0</span><i class="fa fa-question-circle-o"></i> Empty</a>

				<a href="#"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(7);?>">0</span><i class="fa fa-question-circle-o"></i> Empty</a>

				<a href="#"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(6);?>">0</span><i class="fa fa-question-circle-o"></i> Empty</a>

				<a href="#"class="btn btn-app">
                <span class="badge <?php print bg_color_modify(5);?>">0</span><i class="fa fa-question-circle-o"></i> Empty</a>
			  </div>

               
				
				</div>
               <!-- row -->
				</div>
				<!-- /col -->
							
					         </div>
							<!-- row -->
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.bookmarks -->
							  
							  
							  
							  
					 </div> 
			        <!-- /.col -->
              </div>           
			  <!-- /.box-body -->
			                                         
                      </div>                                         
					  <!-- /.box-body -->

					  
				
                         </div> 
                          <!-- /.box-panel_modify -->
                                      </div>
									  <!-- /col-lg-9 col-md-12 -->
        <!-- ปิดส่วน แสดงแถบกราฟ -->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

                      <!-- เปิดส่วน แสดงแถบด้านขวาของจอแสดงสถานะ -->
					    
                          <div id="pull-right-on" style="display:block;">
						                   <?php $color_account="style=\"color: #00ff00;\"";
											if($account=="write"){$color_account="style=\"color: #f7d13c;\"";}
											if($account=="read"){$color_account="style=\"color: #ff1c15;\"";}?>
                                              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">     
											<div class="info-box <?php print bg_color_modify(5);?>">
												<span class="info-box-icon">
												<a href="#" data-toggle="modal" data-target="#Detail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด">
												<i class="ion ion-ios-people-outline"  style="color: #ffffff;"></i></a></span>
										            <div class="info-box-content">
														<span class="info-box-text">Group Account</span>
														<span class="info-box-number">
														<a href="#" data-toggle="modal" data-target="#Detail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด">
														<i class="fa fa-circle " <?php print $color_account;?>></i> </a>
														
														<?php echo "<td>". $account."</td>";?></span>
															<div class="progress">
																<div class="progress-bar" style="width: 100%"></div>
															</div>
																<span class="progress-description">
																	<?php echo "<td>".$result['mt_location']."</td>";?>
																</span>
																</div>
																</div>
																</div>
																<!--./ box1 col -->

											 <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
											 
											<div class="info-box <?php print bg_color_modify(6);?>">
											<span class="info-box-icon">
											<a href="javascript:popup('index.php?page=listuser')">
											<i class="ion-ios-pricetags-outline" style="color: #ffffff;"></i></a></span>
													<div class="info-box-content">
														<span class="info-box-text">Hotspot Database</span>
														<span class="info-box-number">
					<?php $sql="SELECT * FROM mt_gen WHERE mt_id='".$id."'";
                  $query=mysql_query($sql); $rows=mysql_num_rows($query); echo $rows;?> Users</span>
														<div class="progress">
														    <div class="progress-bar" style="width: 100%"></div>
														</div>
														    </div>
															</div>
															</div>
															<!--./ box2 col-->
														         
											<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
											<div class="info-box <?php print bg_color_modify(7);?>">
												<span class="info-box-icon">
												<a href="javascript:popup('index.php?page=pppoe_dtb_user')">
												<i class="ion ion-ios-cloud-download-outline" style="color: #ffffff;"></i></a></span>
													<div class="info-box-content">
														<span class="info-box-text">PPPOE Database</span>
														<span class="info-box-number"><?php $sql="SELECT * FROM pppoe_gen WHERE mt_id='".$id."'";
                                             $query=mysql_query($sql);
                                              $rows=mysql_num_rows($query); echo $rows;?> Users</span>
														<div class="progress">
															<div class="progress-bar" style="width: 70%"></div>
														</div>
														<!-- <span class="progress-description">โปรไฟล์  
																<?php $ARRAY = $API->comm("/ppp/profile/print", array(
																						"count-only"=> "",
																						"~active-address" => "1.1.",
																					));
																						print_r($ARRAY)?> Profile
														</span> -->
													</div>
													</div>
													</div>
													<!--./col box3 -->

                                           <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
											<div class="info-box <?php print bg_color_modify(8);?>">
												<span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
													<div class="info-box-content">
														<span class="info-box-text">วันเวลาใช้งาน</span>
														<span class="date"> <?php print "Date : ".($clock_dash['0']['date']);?></span>
														   
														        <div class="progress">
														            <div class="progress-bar" style="width: 100%"></div>
														        </div>
																<span class="time"> <?php print "Time : ".($clock_dash['0']['time']);?>
														        </span>
																</div>
																</div>
																</div>
													<!--./ box4 col -->
											
                                               <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
											<div class="info-box <?php print bg_color_modify(9);?>">
												<span class="info-box-icon"><i class="ion-ios-timer-outline"></i></span>
													<div class="info-box-content">
														<span class="info-box-text">Mikrotik Uptime</span>
														<div class="progress">
														            <div class="progress-bar" style="width: 100%"></div>
														        </div>
														        <span class="res-up-time"><?php print "Uptime : ".($resource_dash['0']['uptime']);?>
														        </span>
																</div>
																</div>
																</div>
									             <!--./ box5 col-->
      
	   <div class="row">  
                   <!-- row 4 -->
				  <div class="col-lg-12">
				   <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
				   <div class="info-box">
            <span class="info-box-icon <?php print bg_color_modify(10);?>"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text" >IP ROUTER</span>
              <span class="info-box-number" >
              		<?php echo $ip;?></span>
                  </div>
                 </div>
				   </div>
					<!-- ./col info-box1-->


					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
					<div class="info-box">
            <span class="info-box-icon <?php print bg_color_modify(11);?>">
			<a href="javascript:popup('index.php?page=dhcp')">
			<i class="ion ion-arrow-graph-up-right"  style="color: #ffffff;"></i> </a></span>
      
            <div class="info-box-content">
              <span class="info-box-text">DHCP LEASE</span>
              <span class="info-box-number">
              		<?php $ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
								"count-only"=> "",
								"~active-address" => "1.1.",
							));
								print_r($ARRAY)?></span>
            </div>
          </div>
				   </div>
					<!-- ./col info-box2-->

					
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="info-box">
            <span class="info-box-icon <?php print bg_color_modify(12);?>">
			<a href="javascript:popup('index.php?page=interface')">
			<i class="ion ion-archive"  style="color: #ffffff;"></i> </a></span>
            <div class="info-box-content">
              <span class="info-box-text">INTERFACE</span>
              <span class="info-box-number"><?php $ARRAY = $API->comm("/interface/print", array(
												"count-only"=> "",));
			  echo($ARRAY)?></span>
            </div>
          </div>
				   </div>
					<!-- ./col info-box3-->

					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">

					 
					 <div class="info-box">
            <span class="info-box-icon <?php print bg_color_modify(13);?>"><i class="ion-ios-person-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">ADMIN WINBOX</span>
              <span class="info-box-number"><?php echo $user;?></span>
            </div>
          </div>
				   </div>
					<!-- ./col info-box4-->


                   </div>
				   <!--  -->
				   </div>
				    <!-- ./row 4 -->
                                    </div>
									<!--./pull-right-on  -->
									
							<!-- ปิดส่วน แสดงแถบด้านขวาของจอแสดงสถานะ -->
								</div>
									<!-- ./row 2-->
	<!-- ################################################################################################ -->
				<div id="pull-right-off" style="display:none;">
				 <div class="row">  
                   <!-- row 3 -->
                   
				   <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="info-box <?php print bg_color_modify(8);?>">
											<span class="info-box-icon">
											<a href="javascript:popup('index.php?page=listuser')">
											<i class="ion-ios-pricetags-outline" style="color: #ffffff;"></i></a></span>
													<div class="info-box-content">
														<span class="info-box-text">Hotspot Database</span>
														<span class="info-box-number">
					<?php $sql="SELECT * FROM mt_gen WHERE mt_id='".$id."'";
                  $query=mysql_query($sql); $rows=mysql_num_rows($query); echo $rows;?> Users</span>
														<div class="progress">
														    <div class="progress-bar" style="width: 100%"></div>
														</div>
														    </div>
															</div>
															
																</div>
																<!-- ./col box1-->
				
				    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="info-box <?php print bg_color_modify(7);?>">
												<span class="info-box-icon">
												<a href="javascript:popup('index.php?page=pppoe_dtb_user')">
												<i class="ion ion-ios-cloud-download-outline" style="color: #ffffff;"></i></a></span>
													<div class="info-box-content">
														<span class="info-box-text">PPPOE Database</span>
														<span class="info-box-number"><?php $sql="SELECT * FROM pppoe_gen WHERE mt_id='".$id."'";
                                             $query=mysql_query($sql);
                                              $rows=mysql_num_rows($query); echo $rows;?> Users</span>
														<div class="progress">
															<div class="progress-bar" style="width: 70%"></div>
														</div>
														<!-- <span class="progress-description">โปรไฟล์  
																<?php $ARRAY = $API->comm("/ppp/profile/print", array(
																						"count-only"=> "",
																						"~active-address" => "1.1.",
																					));
																						print_r($ARRAY)?> Profile
														</span> -->
													</div>
													</div>
					</div>
					<!-- ./col box2-->


					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="info-box <?php print bg_color_modify(6);?>">
												<span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
													<div class="info-box-content">
														<span class="info-box-text">วันเวลาใช้งาน</span>
														<span class="date"><?php print "Date : ".($clock_dash['0']['date']);?></span>
														   
														        <div class="progress">
														            <div class="progress-bar" style="width: 100%"></div>
														        </div>
																<span class="time"><?php print "Time : ".($clock_dash['0']['time']);?>
														        </span>
																</div>
																</div>
					</div>
					<!-- ./col box3-->

					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="info-box <?php print bg_color_modify(5);?>">
												<span class="info-box-icon"><i class="ion-ios-timer-outline"></i></span>
													<div class="info-box-content">
														<span class="info-box-text">Mikrotik Uptime</span>
														<div class="progress">
														            <div class="progress-bar" style="width: 100%"></div>
														        </div>
														        <span class="up-time"><?php print "Uptime : ".($resource_dash['0']['uptime']);?>
														        </span>
																</div>
																</div>
					</div>
					<!-- ./col box4-->
					</div>
				    <!-- ./row 3 -->
                

				    
				   </div>
				   <!--./pull-right-off  -->

 <!-- #################################################################### -->
                     
	 <!-- Modal -->
        <div class="modal fade" id="Detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document" style="height: 600px; width: 800px;">
 <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">รายละเอียด ที่ User Account สามารถจัดการได้ในระบบ</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Group Detail Account</th>
                                            <th><i class="fa fa-circle" style="color: #ff1c15;"></i> Read Group</th>
                                            <th><i class="fa fa-circle" style="color: #f7d13c;"></i> Write Group</th>
                                             <th><i class="fa fa-circle" style="color: #00ff00;"></i> Full Group</th>
											 <th><i class="fa fa-circle" style="color: #00ff00;"></i> Other Group</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Add user , Profile</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Delete user , Profile</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>3</td>
                                            <td>Edit user , Profile</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Import user</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>3</td>
                                            <td>Transfer user , Profile</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                         <tr>
                                            <td>5</td>
                                            <td>Export user</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Print Card</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        </center></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>


          </div>				
		<!-- ##################################### -->	
		

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
 <script src="../assets/js/log.js"></script><!--real-time  -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

<!-- new -->
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>


 <script type="text/javascript">
$(document).ready(function() {
	///////
   chart,
    origChartWidth = 1000,
    origChartHeight = 400,
    chartWidth = origChartWidth,
    chartHeight = origChartHeight;
	////
		var chart;
	function requestDatta(interface) {
		$.ajax({
			url: 'data/data_interface.php?interface='+interface,
			datatype: "json",
			success: function(data) {
				var midata = JSON.parse(data);
				if( midata.length > 0 ) {
					var TX=JSON.parse(midata[0].data);
					var RX=JSON.parse(midata[1].data);
					//var ATemCPU=JSON.parse(midata[2].data);
					//var ATem=JSON.parse(midata[3].data);
					//var AVolt=JSON.parse(midata[4].data);
					//var ACurrent=JSON.parse(midata[5].data);
					//var ALoad=JSON.parse(midata[6].data);
					var x = (new Date()).getTime();
					     
					shift=chart.series[0].data.length > 19;
					chart.series[0].addPoint([x, TX], true, shift);
					chart.series[1].addPoint([x, RX], true, shift);
					//chart.series[2].addPoint([x, ATemCPU], true, shift);
					//chart.series[3].addPoint([x, ATem], true, shift);
					//chart.series[4].addPoint([x, AVolt], true, shift);
					//chart.series[5].addPoint([x, ACurrent], true, shift);
					//chart.series[6].addPoint([x, ALoad], true, shift);
					
				}
			},
      
		});
	}	
			Highcharts.setOptions({
				global: {
					useUTC: false
				}
			});
	

           chart = new Highcharts.Chart({
			   chart: {
				renderTo: 'monitor-traffic',
				animation: Highcharts.svg,
				type: 'spline',

				events: {
					load: function () {
						setInterval(function () {
							requestDatta(document.getElementById("interface").value);
						}, 5000);
					},
	            addSeries: function () {
                var label = this.renderer.label('A series was added, about to redraw chart', 100, 120)
                    .attr({
                        fill: Highcharts.getOptions().colors[0],
                        padding: 10,
                        r: 5,
                        zIndex: 8
                    })
                    .css({
                        color: '#FFFFFF'
                    })
                    .add();

                setTimeout(function () {
                    label.fadeOut();
                }, 3000);
            }
						
			}
		 },
		 title: {
			text: 'Monitor-Traffic & System-Health'
		 },

		   tooltip: {
       headerFormat: '<span style="font-size:10px">{point.key}</span><br>',
        pointFormat: '<span  style="font-size:18px">{point.y: ,.2f}</span> <span style="font-size:14px"> {series.name}</span>',
        
    },
		 xAxis: {
			type: 'datetime',
				tickPixelInterval: 150,
				maxZoom: 20 * 1000
		 },
		 yAxis: {
			minPadding: 0.2,
				maxPadding: 0.2,
				title: {
					text: 'Mikrotik Thailand',
					margin: 10
				}
		 },
            series: [{
                name: 'Mbps-TX',
                data: []
            }, {
                name: 'Mbps-RX',
                data: []
            }]
	  });
// activate the button
/*$('<button class="btn btn-success2 btn-xs" id="series">Add Series</button>').insertBefore('#monitor-traffic').click(function () {
});
$('#series').click(function () {
    chart.addSeries({
                name: '°C-CPU',
                data: []
            });
	  chart.addSeries({
                name: '°C-Temp',
                data: []
            });
	    chart.addSeries({
                name: 'Volt',
                data: []
            });
	  chart.addSeries({
                name: 'mA-Current',
                data: []
            });
	    chart.addSeries({
                name: '% CPU-Load',
                data: []
            });

    $(this).attr('disabled', true);
});*/

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
///// 
  });
</script>



<!-- ############################# data_Hotspot_profile ############################# -->
<script type="text/javascript">

$(document).ready(function() {
	Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return {
        radialGradient: {
            cx: 0.5,
            cy: 0.3,
            r: 0.7
        },
        stops: [
            [0, color],
            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
        ]
    };
});
///////
   chart,
    origChartWidth = 1000,
    origChartHeight = 400,
    chartWidth = origChartWidth,
    chartHeight = origChartHeight;
	////
var chart;
var options = { 
chart: {
renderTo: 'pro_hotspot',
      plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
},
    title: {
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y: ,.0f}',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
  
	series: []
};
		        $.getJSON("data/data_hotspotuser_profile.php", function(json) {
                if(json[0]!=null){
			    options.series = json[0].series;}
				options.title = json[1].title;
                 chart = new Highcharts.Chart(options);
            });

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
});
</script>
<!-- ############################# data_pppoeuser_profile ############################# -->
<script type="text/javascript">

$(document).ready(function() {
	
	////
var chart;
var options = { 
chart: {
renderTo: 'pro_pppoe',
      plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
},
    title: {
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y: ,.0f}',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
  
	series: []
};
		                    $.getJSON("data/data_pppoeuser_profile.php", function(json) {
                if(json[0]!=null){
			    options.series = json[0].series;}
				options.title = json[1].title;
                 chart = new Highcharts.Chart(options);
            });

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
});
</script>

<!-- ############################# data_memory ############################# -->
<script type="text/javascript">

$(document).ready(function() {
var chart;
var options = { 
chart: {
renderTo: 'memchart',
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
},
    title: {

    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
	
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
  
	series: []
};
		                    $.getJSON("data/data_memory.php", function(json) {
                if(json[0]!=null){
			    options.series = json[0].series;}
				options.title = json[1].title;
                 chart = new Highcharts.Chart(options);
            });

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
});
</script>
<!-- ############# harddisk ######################## -->
<script type="text/javascript">
    $(document).ready(function() {
var chart;
var options = { 
chart: {
renderTo: 'hddchart',
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {

    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
	
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: []
};
		       $.getJSON("data/data_harddisk.php", function(json) {
				    if(json[0]!=null){
               options.series = json[0].series;}
				options.title = json[1].title;
                 chart = new Highcharts.Chart(options);
            });

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
});
</script>
<!-- ########################data_hotspot_money####################################### -->
<script type="text/javascript">
$(document).ready(function() {
var chart;
var options = { 
chart: {
renderTo: 'hotspot_money',
        type: 'column',
        options3d: {
           // enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        },
		zoomType: 'xy',
	        resetZoomButton: {
            position: {
              // align: 'right', // by default
              // verticalAlign: 'top', // by default
               x: -50,
                y: -20
            }
        },
},
    title: {
},
    subtitle: {
},
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },
  
	xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',

        pointFormat: '<span style="font-size:18px">{point.y: ,.0f} บาท</span>',

    },
series: [],
	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
    
		series:[]
	}
};
             $.getJSON("data/data_hotspot_money.php", function(json) {
				  if(json[0]!=null){
                options.series = json[0].series;
                 options.drilldown.series = json[1].drilldown;}
				 options.title = json[2].title;
				 options.subtitle = json[3].subtitle;
                 chart = new Highcharts.Chart(options);
            });
 
 $('<button   value="hotspot" title= "click update" name="active" class="btn btn-primary btn-xs" type="submit">update money</button>').insertBefore('#hotspot_money').click(function () {
});
/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
});

</script>
<!-- #############################pppoe money################################################ -->
<script type="text/javascript">
$(document).ready(function() {
var chart;
var options = { 
chart: {
renderTo: 'pppoe_money',
        type: 'column',
        options3d: {
           // enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        },
		zoomType: 'xy',
	        resetZoomButton: {
            position: {
              // align: 'right', // by default
              // verticalAlign: 'top', // by default
               x: -50,
                y:-20
            }
        },
},
    title: {
    },
    subtitle: {
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },
     xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',
	  pointFormat: '<span style="font-size:18px">{point.y: ,.0f} บาท</span>',
        //footerFormat: '</table>',
      //  shared: true,
      //  useHTML: true
    },
series: [],
	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
       series:[]
	}
}///option
             $.getJSON("data/data_pppoe_money.php", function(json) {
               if(json[0]!=null){
			     options.series = json[0].series;
                 options.drilldown.series = json[1].drilldown; }
				  options.title = json[2].title;
				 options.subtitle = json[3].subtitle;
              
                chart = new Highcharts.Chart(options);
            });
 //////////////////////////////////////////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
$('<button   value="pppoe" title= "click update" name="active" class="btn btn-success btn-xs" type="submit">update money</button>').insertBefore('#pppoe_money').click(function () {
});
});


</script>
<!--#################### hotspot_up/down #######################-->
<script type="text/javascript">

$(document).ready(function() {
	var chart;
var options = { 

chart: {
renderTo: 'hotspot_load',
        type: 'column',
	zoomType: 'xy',
	        resetZoomButton: {
            position: {
              // align: 'right', // by default
              // verticalAlign: 'top', // by default
               x: -50,
                y:-20
            }
        },
        options3d: {
           // enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
},
    title: {
    },
    subtitle: {
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },

		 xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',
	 // headerFormat: '<span style="font-size:14px">{point.x} {series.name}</span><br>',
        pointFormat: '<span style="font-size:18px">{point.y: ,.2f} Gbps.</span>',
        //footerFormat: '</table>',
      //  shared: true,
      //  useHTML: true
    },
series:[],

	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
       
		series:[]
	}

 }

             $.getJSON("data/data_hotspot_load.php", function(json) {
				  if(json[0]!=null){
             options.series = json[0].series;
             options.drilldown.series = json[1].drilldown;}
			 options.title = json[2].title;
				 options.subtitle = json[3].subtitle;
            chart = new Highcharts.Chart(options);
            });

//////////////////////////////////////////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
});
</script>
<!-- #################### interface_up/down ################# -->

<script type="text/javascript">

$(document).ready(function() {
	var chart;
var options = { 

chart: {
renderTo: 'interface_load',
        type: 'column',
        options3d: {
           // enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        },
		zoomType: 'xy',
	        resetZoomButton: {
            position: {
              // align: 'right', // by default
              // verticalAlign: 'top', // by default
               x: -50,
                y:-20
            }
        },
},
    title: {
    },
    subtitle: {
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },

		 xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',
	 // headerFormat: '<span style="font-size:14px">{point.x} {series.name}</span><br>',
        pointFormat: '<span style="font-size:18px">{point.y: ,.2f} Gbps.</span>',
        //footerFormat: '</table>',
      //  shared: true,
      //  useHTML: true
    },
series:[],

	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
       
		series:[]
	}

 }

             $.getJSON("data/data_interface_load.php", function(json) {
				  if(json[0]!=null){
             options.series = json[0].series;}
          // options.drilldown.series = json[1].drilldown;
			 options.title = json[1].title;
			options.subtitle = json[2].subtitle;
            chart = new Highcharts.Chart(options);
            });

//////////////////////////////////////////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
});
</script>
	
 </section>  
 