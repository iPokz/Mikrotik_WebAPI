

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
				           "14"=>" bg-aqua",
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
				
                   $panel_heading="box-header with-border";

				   $date_time_show="<span class=\"pull-right hidden-md hidden-sm hidden-xs  \"><span id=\"date_time\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				   <div class=\"box-tools pull-right\">
		 <button type=\"button\" class=\"btn btn-box-tool\" onclick=\"window.location='index.php?page=server'\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-close\"></i> </button></div>";
                 
				   ?>
