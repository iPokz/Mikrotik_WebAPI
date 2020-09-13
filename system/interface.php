<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');

			$ARRAY = $API->comm("/interface/print");			
									   								
?>
                 <section class="content"> 
                     <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-bar-chart-o"></i>
                           <strong>INTERFACE</strong><?php print $date_time_show;?>
                        </div>
							<div class="panel-body">
                        <table class="table table-striped table-hover" id="dataTables-example">
                            <thead>
                                <tr>     
                                    <th>NO.</th>                                                                     	
                                    <th>NAME</th>
									<th>MAC-ADDRESS</th>
								    <th>Tx/Rx-BYTES</th>
                                    <th>COMMENT</th>                                            
                                    <th>TYPE</th>
                                    <th>STATUS</th>
                                 </tr>
                            <tbody>
                
<?php
			$num =count($ARRAY);
			
			for($i=0; $i<$num; $i++)
			{	
				$no=$i+1;
				echo "<tr>";
				echo "<td>".$no."</td>";	
				echo "<td>".$ARRAY[$i]['name']."</td>";
				echo "<td>".$ARRAY[$i]['mac-address']."</td>";
													
				if($ARRAY[$i]['tx-byte']<=1073741824)
				{
					$tx= (round($ARRAY[$i]['tx-byte']/1048576,1))." M/";
				}
				else
				{
					$tx= (round($ARRAY[$i]['tx-byte']/1073741824,2))." G/";
				}
			
				if($ARRAY[$i]['rx-byte']<=1073741824)
				{
					$rx= (round($ARRAY[$i]['rx-byte']/1048576,1))." M";
				}
				else
				{
					$rx= (round($ARRAY[$i]['rx-byte']/1073741824,2))." G";
				}
			
				if(($ARRAY[$i]['tx-byte'] == 0 && $ARRAY[$i]['rx-byte'] == 0))
				{
					$tx = null;
					$rx = null;
				}
				
				echo "<td>".$tx."".$rx."</td>";
				echo "<td>".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."</td>";
				echo "<td>".$ARRAY[$i]['type']."</td>";
				echo "<td>";
				
                if($ARRAY[$i]['running']=="true")
				{
                    echo "<span class=\"btn btn-success btn-xs\">CONNECT</span>";
                }
				else
				{
                    echo "<span class=\"btn btn-danger btn-xs\">DISCONNECT</span>";
                }
					echo "</td>";
					echo "</tr>";
				}
?>                                                                                                                                                            
							</tbody>
						</table>
					</div> 
				</div>       
			</section>