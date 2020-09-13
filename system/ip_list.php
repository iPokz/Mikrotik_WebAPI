<?php
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');

			$ARRAY = $API->comm("/ip/address/print");			
									   								
?>
                
<section class="content"> 
 
                    <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-bar-chart-o"></i>
                           <strong> All Addresses List</strong>
                       <?php print $date_time_show;?> </div>
						 <div class="panel-body">
                        <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>     
                                        	<th><center>NO.</center></th>                                                                     	
                                            <th><center>ADDRESS</center></th>
                                            <th><center>NETWORK</center></th>                                            
                                            <th><center>INTERFACE</center></th>
											<th><center>COMMENT</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                
												<?php
                                                    $num =count($ARRAY);                                                    
                                                    for($i=0; $i<$num; $i++){   
                                                    $no=$i+1;
                                                    echo "<tr>";
                                                        echo "<td><center>".$no."</center></td>";                    
                                                        echo "<td><center>".$ARRAY[$i]['address']."</center></td>";
                                                        echo "<td><center>".$ARRAY[$i]['network']."</center></td>";
                                                        echo "<td><center>".$ARRAY[$i]['interface']."</center></td>";
                                                        echo "<td><center>".$ARRAY[$i]['comment']."</center></td>";
                                                        
                      
                                                    echo "</center></tr>";
                                                    }
                                                ?>
                                                                                                   
                                                                               
                                    </tbody>
                                </table>
                            </div> 
                        </div>
						
  </section>
                   
