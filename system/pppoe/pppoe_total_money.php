<?php
include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');
			$ARRAY = $API->comm("/ip/hotspot/user/print");
$ARRAY2 = $API->comm("/tool/user-manager/user/print");
 $ARRAY3 = $API->comm("/ip/hotspot/active/print");
  $ARRAY4 = $API->comm("/ppp/secret/print");
  $ARRAY5 = $API->comm("/ppp/active/print");
                                
												
													$num =count($ARRAY);
													$num2 =count($ARRAY2);
													$num3 =count($ARRAY3);
													$num4 =count($ARRAY4);
													$num5 =count($ARRAY5);

									//<!--start update comment from hotspot user to databases-->
													for($i=0; $i<$num; $i++){
									mysql_query("UPDATE mt_gen SET comment='".$ARRAY[$i]['comment']."' WHERE user='".$ARRAY[$i]['name']."'");}
                                        //<!--start update comment from pppoe user to databases-->
										for($i=0; $i<$num4; $i++){
									mysql_query("UPDATE pppoe_gen SET comment='".$ARRAY4[$i]['comment']."' WHERE user='".$ARRAY4[$i]['name']."'");}
													
						//--start update comment from usermanager to databases-->
					for($i=0; $i<$num2; $i++){	
					 mysql_query("UPDATE pppoe_gen SET comment='".$ARRAY2[$i]['comment']."' WHERE user='".$ARRAY2[$i]['username']."'");}
			                  //<!--End update comment-->

				// <!--start update mac-address and ip-address from user online to mt_gen databases-->  //	
													for($i=0; $i<$num3; $i++){
													
						mysql_query("UPDATE mt_gen SET mac_address='".$ARRAY3[$i]['mac-address']."', ip_address='".$ARRAY3[$i]['address']."' WHERE user='".$ARRAY3[$i]['user']."'");}
						
						
						// <!--start update caller-id and address from pppoe online to databases-->  //	
													for($i=0; $i<$num5; $i++){
													
						mysql_query("UPDATE pppoe_gen SET caller_id='".$ARRAY5[$i]['caller-id']."', address='".$ARRAY5[$i]['address']."' WHERE user='".$ARRAY5[$i]['name']."'");}
						/*<!--End update --> */
													
                   



         	
							
							
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

########################################################################################################
if(($new_update)>0){
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
  //<!--start update pppoe_money_year to pppoe databases step2-->
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
	  	
		 
		 
		 
			
}

echo "<script language='javascript'>swal('Save Done!','UPDATE ข้อมูลจำนวน ".$new_update." รายการสำเร็จแล้ว','success').then(function () {
   }, function (dismiss) {
  if (dismiss === 'overlay') {
    
   }})</script>";
}
   
											
						
                                       


	
			
			
?>
<section class="content"> 
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>


<div class="<?php print panel_modify();?>">
<div class="<?php print $panel_heading;?>"><strong>$ PPPOE Total Money</strong>
                 <span class=" hidden-md hidden-sm hidden-xs" >&nbsp;&nbsp;&nbsp;
						<span class="up-time"></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="date"></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="time"></span></span>
						<div class="box-tools pull-right">
		<button class="btn btn-box-tool"   title="PPPOE Chart" onclick="toggle_visibility_double('chart-on');"><h3 class="box-title"><i class="fa fa-line-chart"></i></h3></button>&nbsp;&nbsp;
	     <button class="btn btn-box-tool"   title="Table Total Money " onclick="toggle_visibility_double('table-on');"><h3 class="box-title"><i class="fa fa-list"></i></h3></button>&nbsp;&nbsp;
		 
		 </div>  
		</div>
						 <div class="panel-body">
						 <span style="color:#ffffff;
float: left;
"><a href="index.php?page=pppoe_total_money" class="btn btn-default fa fa-rotate-right"></a>&nbsp;&nbsp;&nbsp;
<a class="btn btn-success btn-xs"  title="click to view" href='index.php?page=pppoe_money_month'><span class="fa fa-list"></span> รายเดือน </a></span><br><br>
<div id="table-on" class="alist" style="display:block;" >
                          <table class="table table-striped table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>     
                                        	<th>NO.</th>
											<th class="text-center">COMMENT</th>
											<th class="text-center">วันที่</th>
											<th >จำนานบัตรที่ขาย</th>
                                            <th>รวม/บาท</th>                                            
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            
												<?php

												  
													$sql="SELECT * FROM pppoe_gen WHERE mt_id='".$id."' GROUP BY money_code";
													$query=mysql_query($sql);	
													$no==1;
													While($result=mysql_fetch_array($query)){	
													$no++;
                                               if($result['money_code']!=""){
													$count=mysql_fetch_array(mysql_query("SELECT COUNT(money_code) as total FROM `pppoe_gen` WHERE money_code='".$result['money_code']."'"));
                                                    $no1==1;
                                                    $no1++;
													$conv=substr("".$result['comment']."",-30,11);
													$money=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$result['profile']."'"));
													$update=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_money WHERE money_code='".$result['money_code']."'"));
													echo "<tr>";
														echo "<td>".$no1."</td>";								
														echo "<td class=\"text-center\">".$conv."</td>";
													   echo "<td class=\"text-center\">".Convert_time($conv)."</td>";
													    echo "<td>";
														echo $update['tickets'];
                                                        echo "</td>";
                                                        echo "<td>";
                                                        echo $update['money'];
                                                        echo "</td>";
														echo "<td class=\"text-center\">";
														 echo"<a class=\"btn btn-black btn-xs\"  title= \"click to view\" href='index.php?page=pppoe_date_list&id=".$result['money_code']."&comment=".$conv."&date_money=".$update['money']."'><span class=\"fa fa-list\"></span> ดูรายการ </a></td>";
														  echo "</tr>";

													$tickets = $tickets + ($update['tickets']);
													$total = $total + ($update['money']);
													
												   }
													}
												?>
												
												<tfoot>     
                                        	<th></th>
											<th class="text-center"></th>
											<th class="text-center"><strong>ยอดรวม</strong></th>
											<th ><strong><?php echo $tickets;?></strong></th>
                                            <th><?php echo $total;?></th>                                            
                                            <th class="text-center"></th>
                                        </tfoot>
									</tbody>	
                                </table>
                            

							 </div>
							  <!-- /.table-on -->

							  <div id="chart-on" class="alist" style="display:none;" >
							  <span class="hidden-md hidden-sm hidden-xs">      
                    <div id="maximize" class="allsize" style="display:block;" >
						<button  id="sizeplus" class="sidebar-toggle"  role="button" data-toggle="offcanvas"   title= "คลิก เพื่อขยาย มอนิเตอร์" onclick="toggle_visibility_size('restore')">+</button>
						<button  id="sizenormal">1:1</button></div>
					</span>
						
						<div id="restore" class="allsize" style="display:none;" >
						<button  id="sizeminus" type="button"  class="sidebar-toggle"  role="button" data-toggle="offcanvas"     title= "คลิก เพื่อลดขนาด มอนิเตอร์" onclick="toggle_visibility_size('maximize')">-</button>
						<button  id="sizenormal2">1:1</button></div>
							<div class="chart">
			<!-- <div id="pppoe_money_by_days" style="min-width: 400px; width: 1000px; height: 500px; margin: 0 auto"></div> --> 
			<div id="pppoe_money_by_days" style="height: 500px; margin: 0 auto"></div>
							<!-- <div id="pppoe_money_by_days"></div> -->
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.chart-on -->


							</div>
							<!-- ./panel-body -->
							</div>

<script type="text/javascript">


$(function () {


var chart;
$(document).ready(function() {
var $pppoe = $('#pppoe_money_by_days'),
	//var chart;
	 chart,
    origChartWidth = 1000,
    origChartHeight = 500,
    chartWidth = origChartWidth,
    chartHeight = origChartHeight;	
Highcharts.setOptions({
 lang: {
	 
            loading: 'กำลังโหลด...',
            months: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
            weekdays: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
            shortMonths: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
		    //exportButtonTitle: "Exportar",
           // printButtonTitle: "Imprimir",
            rangeSelectorFrom: "จาก",
            rangeSelectorTo: "ถึง",
            rangeSelectorZoom: "เลือก เพื่อขยาย",
           // downloadPNG: 'Download imagem PNG',
          //  downloadJPEG: 'Download imagem JPEG',
          //  downloadPDF: 'Download documento PDF',
           // downloadSVG: 'Download imagem SVG',
			
            // resetZoom: "Reset",
            // resetZoomTitle: "Reset,
            // thousandsSep: ".",
            // decimalPoint: ','
            },
    global: {
        useUTC: false
    },
     
});
$.getJSON("data/data_pppoe_money_by_days.php", function(json) {
        chart = new Highcharts.stockChart({

        chart: {
			renderTo: 'pppoe_money_by_days',
           // height: 400
			
        },
/*		xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: {
           day: '%b/%d/%Y'    //ex- 01 Jan 2016
        }
},*/
   xAxis: {
        type: 'datetime',
        labels: {
            format: '{value:%d/%b/%Y}',
            rotation: 45,
            align: 'left'

        }
    },
		    plotOptions: {
        series: {
            color: '#00cc00'
        }
    },


        title: {
            text: 'PPPOE Money Chart'
        },

        subtitle: {
            text: 'แสดง รวมยอด รายรับ /วัน'
        },

        rangeSelector: {
            selected: 1
        },

        series: [{
            name: 'By Days',
            data: json, 
            type: 'area',

         //  threshold: null,
          //  tooltip: {
         //     valueDecimals: 2
       //   },
	   tooltip: {
       headerFormat: '<span style="font-size:14px">{point.key}</span><span style="font-size:10px"> {series.name}</span><br>',
        pointFormat: '<span  style="font-size:18px">{point.y: ,.0f} บาท</span>',
        
    },
fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                },
                stops: [
                    [0, Highcharts.getOptions().colors[2]],
                    [1, Highcharts.Color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                ]
            }
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    chart: {
                        height: 300
                    },
                    subtitle: {
                        text: null
                    },
                    navigator: {
                        enabled: false
                    }
                }
            }]
        }
    });


});
//
// Activate the sliders
$('#sliders input').on('input change', function () {
    chart.options.chart.options3d[this.id] = parseFloat(this.value);
    showValues();
    chart.redraw(false);
});

//showValues();
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    //chartWidth += (-30);
	chartWidth = 1000;
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
$('#sizenormal2').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
//

});
});
</script>
<!--  -->

							
  </section>
