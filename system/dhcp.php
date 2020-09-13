<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');

			$ARRAY = $API->comm('/ip/dhcp-server/lease/print');			
									   								
?>

                  
<section class="content"> 
 
                    <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-bar-chart-o"></i>
                           <strong> DHCP LEASES</strong>
                       <?php print $date_time_show;?> </div>
						 <div class="panel-body">
                        <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>     
                                        	<th>NO.</th>                                                                     	
                                            <th>ADDRESS</th>
                                            <th>MAC ADDRESS</th>                                            
                                            <th>HOSTNAME</th>
											<th>COMMENT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                
												<?php
													$num =count($ARRAY);													
													for($i=0; $i<$num; $i++){	
													$no=$i+1;
													echo "<tr>";
													echo "<td>".$no."</td>";	
														echo "<td>".$ARRAY[$i]['address']."</td>";
														echo "<td>".$ARRAY[$i]['mac-address']."</td>";
													    echo "<td>".$ARRAY[$i]['host-name']."</td>";
														 echo "<td>".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."</td>";
														
													echo "</tr>";
													}
												?>
                                                                                                   
                                                                               
                                    </tbody>
                                </table>
                            </div> 
                        </div>
						
  </section>
                   
