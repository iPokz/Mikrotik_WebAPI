<?php
require_once('key.php');
$ipRouteros = $ip;
$Username=$user;
$Pass=$pass;
$api_puerto=8728;
$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {

 #############################################################################################
$user_chart = $API->comm("/ip/hotspot/user/print");
			$profile_chart = $API->comm("/ip/hotspot/user/profile/print");
			$num_prochart =count($profile_chart);
			$num_userchart =count($user_chart);
			$chart_count=0;


			for($ch=0; $ch<$num_prochart; $ch++){
       $pro1=$profile_chart[0][name];$pro2=$profile_chart[1][name];$pro3=$profile_chart[2][name];
		$pro4=$profile_chart[3][name];$pro5=$profile_chart[4][name];$pro6=$profile_chart[5][name];
		$pro7=$profile_chart[6][name];$pro8=$profile_chart[7][name];$pro9=$profile_chart[8][name];
		$pro10=$profile_chart[9][name];$pro11=$profile_chart[10][name];$pro12=$profile_chart[11][name];
		$pro13=$profile_chart[12][name];$pro14=$profile_chart[13][name];$pro15=$profile_chart[14][name];
		$pro16=$profile_chart[15][name];$pro17=$profile_chart[16][name];$pro18=$profile_chart[17][name];
		$pro19=$profile_chart[18][name];$pro20=$profile_chart[19][name];$pro21=$profile_chart[20][name];
		$pro22=$profile_chart[21][name];$pro23=$profile_chart[22][name];$pro24=$profile_chart[23][name];
		$pro25=$profile_chart[24][name];}
			
			                for($ch=0; $ch<$num_userchart; $ch++){
                           $user_total=$user_total+($chart_count+1);
	           if($user_chart[$ch][profile]==$pro1){
				$user_up1=$user_up1+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down1=$user_down1+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro2){
				$user_up2=$user_up2+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down2=$user_down2+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro3){
				$user_up3=$user_up3+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down3=$user_down3+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro4){
				$user_up4=$user_up4+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down4=$user_down4+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro5){
				$user_up5=$user_up5+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down5=$user_down5+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro6){
				$user_up6=$user_up6+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down6=$user_down6+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro7){
				$user_up7=$user_up7+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down7=$user_down7+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro8){
				$user_up8=$user_up8+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down8=$user_down8+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro9){
				$user_up9=$user_up9+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down9=$user_down9+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro10){
				$user_up10=$user_up10+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down10=$user_down10+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro11){
				$user_up11=$user_up11+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down11=$user_down11+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro12){
				$user_up12=$user_up12+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down12=$user_down12+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro13){
				$user_up13=$user_up13+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down13=$user_down13+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro14){
				$user_up14=$user_up14+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down14=$user_down14+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro15){
				$user_up15=$user_up15+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down15=$user_down15+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro16){
				$user_up16=$user_up16+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down16=$user_down16+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro17){
				$user_up17=$user_up17+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down17=$user_down17+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro18){
				$user_up18=$user_up18+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down18=$user_down18+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro19){
				$user_up19=$user_up19+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down19=$user_down19+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro20){
				$user_up20=$user_up20+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down20=$user_down20+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro21){
				$user_up21=$user_up21+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down21=$user_down21+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro22){
				$user_up22=$user_up22+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down22=$user_down22+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro23){
				$user_up23=$user_up23+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down23=$user_down23+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro24){
				$user_up24=$user_up24+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down24=$user_down24+(round($user_chart[$ch]['bytes-out']/1073741824,2));}
				
				 if($user_chart[$ch][profile]==$pro25){
				$user_up25=$user_up25+(round($user_chart[$ch]['bytes-in']/1073741824,2));
				$user_down25=$user_down25+(round($user_chart[$ch]['bytes-out']/1073741824,2));}}


       $upload_user_arr=array("0"=>($user_up1),"1"=>($user_up2),"2"=>($user_up3),"3"=>($user_up4),"4"=>($user_up5),"5"=>($user_up6),"6"=>($user_up7),"7"=>($user_up8),"8"=>($user_up9),"9"=>($user_up10),"10"=>($user_up11),"11"=>($user_up12),"12"=>($user_up13),"13"=>($user_up14),"14"=>($user_up15),"15"=>($user_up16),"16"=>($user_up17),"17"=>($user_up18),"18"=>($user_up19),"19"=>($user_up20),"20"=>($user_up21),"21"=>($user_up22),"22"=>($user_up23),"23"=>($user_up24),"24"=>($user_up25));
	   
	   $download_user_arr=array("0"=>($user_down1),"1"=>($user_down2),"2"=>($user_down3),"3"=>($user_down4),"4"=>($user_down5),"5"=>($user_down6),"6"=>($user_down7),"7"=>($user_down8),"8"=>($user_down9),"9"=>($user_down10),"10"=>($user_down11),"11"=>($user_down12),"12"=>($user_down13),"13"=>($user_down14),"14"=>($user_down15),"15"=>($user_down16),"16"=>($user_down17),"17"=>($user_down18),"18"=>($user_down19),"19"=>($user_down20),"20"=>($user_down21),"21"=>($user_down22),"22"=>($user_down23),"23"=>($user_down24),"24"=>($user_down25));
	   
	   
	       
			for($ch=0; $ch<$num_prochart; $ch++){
			 $pro=$profile_chart[$ch]['name'];
				$num_up=$upload_user_arr[$ch];
				$num_down=$download_user_arr[$ch];
				if(($num_up||$num_down)!=0){
				$rows[]= array('name' =>$pro,'y' =>$num_up,'drilldown'=>$pro.'_up');
				$rows1[]= array('name' =>$pro,'y' =>$num_down,'drilldown'=>$pro.'_down');
				
				$series0['series']=array(array('name'=>'UPLOAD','data'=>$rows),array('name'=>'DOWNLOAD','data'=>$rows1));
               }
				
				
				
				
				
				}
			
	############################################END#####################################################
			 
			
		 for($ch=0; $ch<$num_userchart; $ch++){
       
			if(($user_chart[$ch]['bytes-in']+$user_chart[$ch]['bytes-out'])!=0){
		 $user_up=round($user_chart[$ch]['bytes-in']/1073741824,2);
		 $user_down=round($user_chart[$ch]['bytes-out']/1073741824,2);
		 $prof=$user_chart[$ch]['profile'];
		 $us=$user_chart[$ch]['name'];
	    $nameus='drilldown';
		
		if($prof==$pro1){
		$ee1[]=array(''.$us.'',$user_up);
		$dd1[]=array(''.$us.'',$user_down);
        $data_upload1=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee1);
		$data_download1=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd1);}
		
		if($prof==$pro2){
		$ee2[]=array(''.$us.'',$user_up);
		$dd2[]=array(''.$us.'',$user_down);
        $data_upload2=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee2);
		$data_download2=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd2);}

		if($prof==$pro3){
		$ee3[]=array(''.$us.'',$user_up);
		$dd3[]=array(''.$us.'',$user_down);
        $data_upload3=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee3);
		$data_download3=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd3);}

		if($prof==$pro4){
		$ee4[]=array(''.$us.'',$user_up);
		$dd4[]=array(''.$us.'',$user_down);
        $data_upload4=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee4);
		$data_download4=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd4);}

		if($prof==$pro5){
		$ee5[]=array(''.$us.'',$user_up);
		$dd5[]=array(''.$us.'',$user_down);
        $data_upload5=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee5);
		$data_download5=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd5);}

		if($prof==$pro6){
		$ee6[]=array(''.$us.'',$user_up);
		$dd6[]=array(''.$us.'',$user_down);
        $data_upload6=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee6);
		$data_download6=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd6);}

		if($prof==$pro7){
		$ee7[]=array(''.$us.'',$user_up);
		$dd7[]=array(''.$us.'',$user_down);
        $data_upload7=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee7);
		$data_download7=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd7);}

		if($prof==$pro8){
		$ee8[]=array(''.$us.'',$user_up);
		$dd8[]=array(''.$us.'',$user_down);
        $data_upload8=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee8);
		$data_download8=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd8);}

		if($prof==$pro9){
		$ee9[]=array(''.$us.'',$user_up);
		$dd9[]=array(''.$us.'',$user_down);
        $data_upload9=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee9);
		$data_download9=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd9);}

		if($prof==$pro10){
		$ee10[]=array(''.$us.'',$user_up);
		$dd10[]=array(''.$us.'',$user_down);
        $data_upload10=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee10);
		$data_download10=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd10);}

		if($prof==$pro11){
		$ee11[]=array(''.$us.'',$user_up);
		$dd11[]=array(''.$us.'',$user_down);
        $data_upload11=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee11);
		$data_download11=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd11);}

		if($prof==$pro12){
		$ee12[]=array(''.$us.'',$user_up);
		$dd12[]=array(''.$us.'',$user_down);
        $data_upload12=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee12);
		$data_download12=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd12);}

		if($prof==$pro13){
		$ee13[]=array(''.$us.'',$user_up);
		$dd13[]=array(''.$us.'',$user_down);
        $data_upload13=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee13);
		$data_download13=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd13);}

		if($prof==$pro14){
		$ee14[]=array(''.$us.'',$user_up);
		$dd14[]=array(''.$us.'',$user_down);
        $data_upload14=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee14);
		$data_download14=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd14);}

		if($prof==$pro15){
		$ee15[]=array(''.$us.'',$user_up);
		$dd15[]=array(''.$us.'',$user_down);
        $data_upload15=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee15);
		$data_download15=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd15);}

		if($prof==$pro16){
		$ee16[]=array(''.$us.'',$user_up);
		$dd16[]=array(''.$us.'',$user_down);
        $data_upload16=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee16);
		$data_download16=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd16);}

		if($prof==$pro17){
		$ee17[]=array(''.$us.'',$user_up);
		$dd17[]=array(''.$us.'',$user_down);
        $data_upload17=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee17);
		$data_download17=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd17);}

		if($prof==$pro18){
		$ee18[]=array(''.$us.'',$user_up);
		$dd18[]=array(''.$us.'',$user_down);
        $data_upload18=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee18);
		$data_download18=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd18);}

		if($prof==$pro19){
		$ee19[]=array(''.$us.'',$user_up);
		$dd19[]=array(''.$us.'',$user_down);
        $data_upload19=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee19);
		$data_download19=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd19);}

		if($prof==$pro20){
		$ee20[]=array(''.$us.'',$user_up);
		$dd20[]=array(''.$us.'',$user_down);
        $data_upload20=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee20);
		$data_download20=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd20);}

		if($prof==$pro21){
		$ee21[]=array(''.$us.'',$user_up);
		$dd21[]=array(''.$us.'',$user_down);
        $data_upload21=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee21);
		$data_download21=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd21);}

		if($prof==$pro22){
		$ee22[]=array(''.$us.'',$user_up);
		$dd22[]=array(''.$us.'',$user_down);
        $data_upload22=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee22);
		$data_download22=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd22);}

		if($prof==$pro23){
		$ee23[]=array(''.$us.'',$user_up);
		$dd23[]=array(''.$us.'',$user_down);
        $data_upload23=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee23);
		$data_download23=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd23);}

		if($prof==$pro24){
		$ee24[]=array(''.$us.'',$user_up);
		$dd24[]=array(''.$us.'',$user_down);
        $data_upload24=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee24);
		$data_download24=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd24);}

		if($prof==$pro25){
		$ee25[]=array(''.$us.'',$user_up);
		$dd25[]=array(''.$us.'',$user_down);
        $data_upload25=array('name'=>$prof.' UPLOAD', 'id'=>$prof.'_up','data'=>$ee25);
		$data_download25=array('name'=>$prof.' DOWNLOAD', 'id'=>$prof.'_down','data'=>$dd25);}
      }}
	
		$rrr = array();
		if($data_upload1!=null){array_push($rrr,$data_upload1,$data_download1);}
	    if($data_upload2!=null){array_push($rrr,$data_upload2,$data_download2);}
		if($data_upload3!=null){array_push($rrr,$data_upload3,$data_download3);}
		if($data_upload4!=null){array_push($rrr,$data_upload4,$data_download4);}
		if($data_upload5!=null){array_push($rrr,$data_upload5,$data_download5);}
		if($data_upload6!=null){array_push($rrr,$data_upload6,$data_download6);}
		if($data_upload7!=null){array_push($rrr,$data_upload7,$data_download7);}
		if($data_upload8!=null){array_push($rrr,$data_upload8,$data_download8);}
		if($data_upload9!=null){array_push($rrr,$data_upload9,$data_download9);}
		if($data_upload10!=null){array_push($rrr,$data_upload10,$data_download10);}
		if($data_upload11!=null){array_push($rrr,$data_upload11,$data_download11);}
		if($data_upload12!=null){array_push($rrr,$data_upload12,$data_download12);}
		if($data_upload13!=null){array_push($rrr,$data_upload13,$data_download13);}
		if($data_upload14!=null){array_push($rrr,$data_upload14,$data_download14);}
		if($data_upload15!=null){array_push($rrr,$data_upload15,$data_download15);}
		if($data_upload16!=null){array_push($rrr,$data_upload16,$data_download16);}
		if($data_upload17!=null){array_push($rrr,$data_upload17,$data_download17);}
		if($data_upload18!=null){array_push($rrr,$data_upload18,$data_download18);}
		if($data_upload19!=null){array_push($rrr,$data_upload19,$data_download19);}
		if($data_upload20!=null){array_push($rrr,$data_upload20,$data_download20);}
		if($data_upload21!=null){array_push($rrr,$data_upload21,$data_download21);}
		if($data_upload22!=null){array_push($rrr,$data_upload22,$data_download22);}
		if($data_upload23!=null){array_push($rrr,$data_upload23,$data_download23);}
		if($data_upload24!=null){array_push($rrr,$data_upload24,$data_download24);}
		if($data_upload25!=null){array_push($rrr,$data_upload25,$data_download25);}
		
	
	$series1[$nameus]=$rrr;
	 $data_title['title']=array('text'=>'Hotspot TxRx Bytes');
	 $nodata_title['title']=array('text'=>'NO DATA USER IN HOTSPOT');
    $data_subtitle['subtitle']=array('text'=>'แสดงค่า upload/download users');
	}
	if(!empty($series0)){
	$result = array();
array_push($result,$series0);
array_push($result,$series1);
array_push($result,$data_title);
array_push($result,$data_subtitle);
//print json_encode($result, JSON_NUMERIC_CHECK);
print json_encode($result);
	}else{
$result = array();
array_push($result,$series0);
array_push($result,$series1);
array_push($result,$nodata_title);
array_push($result,$data_subtitle);
//print json_encode($result, JSON_NUMERIC_CHECK);
print json_encode($result);	
	
	
	}
				?>