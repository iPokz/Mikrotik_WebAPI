<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');
			$ARRAY = $API->comm("/ip/hotspot/user/print");
          $ARRAY2 = $API->comm("/tool/user-manager/user/print");
             $ARRAY3 = $API->comm("/ip/hotspot/active/print");
             $ARRAY4 = $API->comm("/ppp/secret/print");
             $ARRAY5 = $API->comm("/ppp/active/print");
             $id=$_SESSION['id'];
			 
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- new -->
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

        <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><strong>$ PPPOE Money Month</strong>
						 <span class=" hidden-md hidden-sm hidden-xs" >&nbsp;&nbsp;&nbsp;
						<span class="up-time"></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="date"></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="time"></span></span>
						<div class="box-tools pull-right">
		<button class="btn btn-box-tool"   title="PPPOE Chart" onclick="toggle_visibility_double('chart-on');"><h3 class="box-title"><i class="fa fa-bar-chart"></i></h3></button>&nbsp;&nbsp;
	     <button class="btn btn-box-tool"   title="Table Total Money " onclick="toggle_visibility_double('table-on');"><h3 class="box-title"><i class="fa fa-list"></i></h3></button>&nbsp;&nbsp;

		  </div>
                        </div>
						 <div class="panel-body">
						<span style="color:#ffffff;
float: left;
"><a href="index.php?page=pppoe_total_money" class="btn btn-default fa fa-arrow-left"></a>&nbsp;<a href="index.php?page=pppoe_money_month" class="btn btn-default fa fa-rotate-right"></a> </span><br><br>

                        <div id="table-on" class="alist" style="display:block;" >
                        <table class="table table-striped table-hover"  id="dataTables-example">
                                  <thead>
                                        <tr>   
											  
                                        	<th>NO.</th>
											<th>COMMENT</th>  
                                            <th>ปี/เดือน</th>                                            
                                            <th>จำนวนวัน</th>
											<th>ACTION</th>
                                             </tr>
                                    </thead>        
                                      <tbody>  
                                    <?php
													$id=$_SESSION['id'];
													$sql="SELECT * FROM pppoe_money WHERE mt_id='".$id."' GROUP BY month_code ";
													$query=mysql_query($sql);	
													$no==1;
													While($result=mysql_fetch_array($query)){	
													$no++;
													$thai_conv= $result['date'];
                                                    echo "<tr>";
																	
															echo "<td>".$no."</td>";								
															echo "<td>".$result['month']."</td>";
															echo "<td>".Convert_time_min($thai_conv)."</td>";
															echo "<td>";
															$count=mysql_fetch_array(mysql_query("SELECT COUNT(month_code) as total FROM `pppoe_money` WHERE month_code='".$result['month_code']."'"));
															echo $count['total'];
															echo "</td>";
															echo "<td>";
														 echo"<a class=\"btn btn-black btn-xs\"  title= \"click to view\" href='index.php?page=pppoe_month_list&id=".$result['month_code']."'><span class=\"fa fa-list\"></span> ดูรายการ </a></td>";
															echo "</td>";
															echo "</tr>";
															$total = $total + ($count['total']);
													
													}
												?>


												</tbody>
												 <tfoot>   
											  
                                        	<th></th>
											<th></th>  
                                            <th><strong>ยอดรวม</strong></th>                                            
                                            <th><?php echo $total;?></th>
											<th></th>
                                             </tfoot>
											                                  
                                 </table>
								  </div>
								  <!-- ./table-on -->

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
							<div class="row">
            <div id="pppoe_money" style="width: 1000px; height: 500px;"></div>
			</div>
<div id="sliders">
    <table>
        <tr>
        	<td>Alpha Angle</td>
        	<td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
        </tr>
        <tr>
        	<td>Beta Angle</td>
        	<td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
        </tr>
        <tr>
        	<td>Depth</td>
        	<td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
        </tr>
    </table>
</div> 
							
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.chart-on -->


								 </div>
								 </div>
	<script type="text/javascript">


$(document).ready(function() {
	var $pppoe = $('#pppoe_money'),
	//var chart;
	 chart,
    origChartWidth = 1000,
    origChartHeight = 500,
    chartWidth = origChartWidth,
    chartHeight = origChartHeight;
	var options = { 
chart: {
        renderTo: 'pppoe_money',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 0,
            beta: 0,
            depth: 50,
            viewDistance: 25
        }
    },
    title: {
    },
    subtitle: {
    },
    plotOptions: {
     series: {
            //borderWidth: 0,
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
        series: []
	}
};//option
             $.getJSON("data/data_pppoe_money.php", function(json) {
				  if(json[0]!=null){
                options.series = json[0].series;
                 options.drilldown.series = json[1].drilldown;}
				 options.title = json[2].title;
				 options.subtitle = json[3].subtitle;
                 chart = new Highcharts.Chart(options);
            });

//});
//});

 

//
function showValues() {
    $('#alpha-value').html(chart.options.chart.options3d.alpha);
    $('#beta-value').html(chart.options.chart.options3d.beta);
    $('#depth-value').html(chart.options.chart.options3d.depth);
}

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
 
//});
$(function () {
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
});

});
</script>



								 
  </section>
								 
    
                            