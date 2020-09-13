<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');
			
			
							   								
?>
<section class="content"> 
 
    <form name="user" action="" method="post">
        <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><strong>$ PPPOE Date List</strong><?php print $date_time_show;?>                            
                        </div>
						 <div class="panel-body">
						<span style="color:#ffffff;
float: left;
"><a href="index.php?page=pppoe_total_money" class="btn btn-default fa fa-arrow-left"></a>&nbsp;<a href="index.php?page=pppoe_date_list&id=<?php echo $_GET['id']; ?>&comment=<?php echo $_GET['comment']; ?>&date_money=<?php echo $_GET['date_money']; ?>" class="btn btn-default fa fa-rotate-right"></a> </span><br><br>
                            
                      
						<table class="table table-striped table-hover"  id="dataTables-example">
                                  <thead>
                                        <tr>   
											  
                                        	<th>NO.</th>                                                                         	
                                            <th>USERNAME</th>                                            
                                            <th>PROFILES</th>
											<th>COMMENT</th>
											<th ><strong>วันที่</strong></th>
											<th>ราคา</th>
                                             </tr>
                                    </thead>        
                                    <tbody>   
                                    <?php
					 $money_code=$_GET['id'];
						$comment=$_GET['comment'];
						   $month=array( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );
						    $date=$month[date('m')-1].date ("/d/").date ("Y");

													$query=mysql_query("SELECT * FROM pppoe_gen WHERE money_code='".$money_code."'");
												$i=0;
													while($result=mysql_fetch_array($query)){
														$i++;
														
														$count=mysql_fetch_array(mysql_query("SELECT COUNT(profile) as total FROM `pppoe_gen` WHERE money_code='".$result['money_code']."'"));
                                                           $conv= substr("".$result['comment']."",-30,11);
														echo "<tr>";
																	
															echo "<td>".$i."</td>";								
															echo "<td>".$result['user']."</td>";
															echo "<td>".$result['profile']."</td>";	
															echo "<td>".$result['comment']."</td>";
															//echo "<td>".$year."</td>";
															
															echo "<td>".Convert_time($conv)."</td>";
                                                             echo "<td >";

															$money=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$result['profile']."'"));
															 echo $money['pro_price'];
															echo "</td>";
															echo "</tr>";
															$total = $total + ($money['pro_price']);
                                                      
													
													}
												?>
												<tfoot>   
											  
                                        	<th></th>                                                                         	
                                            <th></th>                                            
                                            <th></th>
											<th></th>
											<th ><strong>ยอดรวม</strong></th>
											<th><?php echo $total;?></th>
                                             </tfoot>

												 </tbody>
                                                                                
                                 </table>
								 
    <?php
     
	 
      if($date!=$comment){
		  $id=$_SESSION['id'];
		  // <!--start update money to databases-->  //
			                                  
												   $id_code="-id".$id."";
												$year=substr("".$comment."",-4);
                                                    $month2=substr("".$comment."",-11,3);
                                               $exe=substr("".$comment."",-5,1);
											   	////new
$y_arr=substr("".$comment."",-4);//=2017
$m_arr=substr("".$comment."",-11,3);//may
$d_arr=substr("".$comment."",-7,2);//31
$month_arr=array("jan"=>"01","feb"=>"02","mar"=>"03","apr"=>"04","may"=>"05","jun"=>"06","jul"=>"07","aug"=>"08","sep"=>"09","oct"=>"10","nov"=>"11","dec"=>"12");
$con1_arr= $month_arr[$m_arr];
$con2_arr=($con1_arr)."/".($d_arr)."/".($y_arr);
				$date_utc = new DateTime(''.$con2_arr.'');
				$utc= $date_utc->format('U');
				///$utc_timezone=$utc+($timezone);
				$utc_data=($utc);
///end new
                                           $month_code="".$year."".$exe."".$month2."".$id_code."";

						mysql_query("INSERT INTO pppoe_money VALUE('".$utc_data."','".$money_code."','".$comment."','".$month_code."','".$month_code."','".$i."','".$total."','".$id."')");
						
						/*<!--End update --> */


      
		  }
		  if($date==$comment){
			  echo "<script>sweetAlert('NO!update...', 'จะ update ได้หลังจากวันนี้.!', 'error')</script>";
		  }
		  else{
			  $date_money=$_GET['date_money']; if($_GET['date_money']==""){$date_money =$total;}
		  if($date_money!=$total) {	
			echo "<script>sweetAlert(' ข้อมูลบางส่วนได้หายไป!','', 'question')</script>";
		}}
?>
                             </div>
							  </div>
							</form>
							
  </section>