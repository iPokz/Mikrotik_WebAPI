<?php
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');

			$ARRAY = $API->comm("/ip/hotspot/print");			
									   								
?>
                
<section class="content"> 
 
                    <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-bar-chart-o"></i>
                           <strong> All HOTSPOT SERVER List</strong>
                       <?php print $date_time_show;?> </div>
						 <div class="panel-body">
                        <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th><center>NO.</center></th>                                                                     	
                                            <th><center>NAME</center></th>
                                            <th><center>INTERFACE</center></th>                                            
                                            <th><center>ADDRESS-POOL</center></th>
											<th><center>PROFILE</center></th>
											<th><center>STATUS</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                
												<?php
                                                    $num =count($ARRAY);                                                    
                                                    for($i=0; $i<$num; $i++){   
                                                    $no=$i+1;
                                                    echo "<tr>";
                                                        echo "<td><center>".$no."</center></td>";                    
                                                        echo "<td><center>".$ARRAY[$i]['name']."</center></td>";
                                                        echo "<td><center>".$ARRAY[$i]['interface']."</center></td>";
                                                        echo "<td><center>".$ARRAY[$i]['address-pool']."</center></td>";
                                                        echo "<td><center>".$ARRAY[$i]['profile']."</center></td>";
														echo "<td>";
												
														if($ARRAY[$i]['proxy-status']=="running")
														{
															echo "<center><span class=\"btn btn-success btn-xs\">ถูกเปิดใช้งาน</span></center>";
														}
														else
														{
															echo "<center><span class=\"btn btn-danger btn-xs\">ถูกปิดใช้งาน</span></center>";
														}
														echo "</td>";
														echo "</tr>";
                                                        
                      
                                                    echo "</center></tr>";
                                                    }
                                                ?>
                                                                                                   
                                                                               
                                    </tbody>
                                </table>
                            </div> 
                        </div>
						
  </section>
                   
