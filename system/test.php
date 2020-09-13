<?php
	
					function panel_modify($minute_panel){
					          $minute=date('i');
								
				if($minute<=5){$minute_panel="panel panel-success";return $minute_panel;}
				if($minute<=10){$minute_panel="panel panel-info";return $minute_panel;}
				if($minute<=15){$minute_panel="panel panel-warning";return $minute_panel;}
				if($minute<=20){$minute_panel="panel panel-black";return $minute_panel;}
				if($minute<=25){$minute_panel="panel panel-danger";return $minute_panel;}
				if($minute<=30){$minute_panel="panel panel-style1";return $minute_panel;}
				if($minute<=35){$minute_panel="panel panel-style2";return $minute_panel;}
				if($minute<=40){$minute_panel="panel panel-style3";return $minute_panel;}
				if($minute<=45){$minute_panel="panel panel-style4";return $minute_panel;}
				if($minute<=50){$minute_panel="panel panel-style5";return $minute_panel;}
				if($minute<=55){$minute_panel="panel panel-style6";return $minute_panel;}
				if($minute<=60){$minute_panel="panel panel-style7";return $minute_panel;}
				}

				
						
							?>
							<section class="content"> 

<!--<style type="text/css">


    .bg-color-green {
background-color: #00CE6F;
color: #fff;
}
    .bg-color-green2 {
background-color: #99ff66;
color: #fff;
}
    .bg-color-blue {
background-color: #0000ff;
color: #fff;
}
    .bg-color-sky {
background-color: #00FFFF;
color: #fff;
}
 .bg-color-yellow {
background-color: #ffcc00;
color: #fff;
}
  .bg-color-red {
background-color: #DB0630;
color: #fff;
}
  .bg-color-brown {
background-color: #B94A00;
color: #fff;
}
  .bg-color-pink {
background-color: #FF00FF;
color: #fff;
}
  .bg-color-style1 {
background-color: #4A9922;
color: #fff;
}
  .bg-color-style2 {
background-color: #5247BF;
color: #fff;
}
  .bg-color-style3 {
background-color: #C22FD4;
color: #fff;
}
  .bg-color-style4 {
background-color: #166609;
color: #fff;
}
  .bg-color-style5 {
background-color: #C20000;
color: #fff;
}
  .bg-color-style6 {
background-color: #a8a8ff;
color: #fff;
}
  .bg-color-style7 {
background-color: #936f6c;
color: #fff;
}
  .bg-color-style8 {
background-color: #4154F0;
color: #fff;
}

</style> -->

 <section class="content">
                   
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>


<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


<div id="mik_show" style="height: 400px; min-width: 310px"></div>



<!--  -->

<!--######################################################################  -->
<script type="text/javascript">
	var chart1;
	function requestMik() {
		$.ajax({
			url: 'data/data_example.php',
			//datatype: "json",
			success: function(data) {
				var mikDATA = JSON.parse(data);
				if( mikDATA.length > 0 ) {
					var TemCPU=parseInt(mikDATA[0].data);
					var Tem=parseInt(mikDATA[1].data);
					var vol=parseInt(mikDATA[2].data);
					var power=parseInt(mikDATA[3].data);
					var load=parseInt(mikDATA[4].data);
					var current=parseInt(mikDATA[5].data);
					var x = (new Date()).getTime(); 
					shift=chart.series[0].data.length > 19;
					chart.series[0].addPoint([x, TemCPU], true, shift);
					chart.series[1].addPoint([x, Tem], true, shift);
					chart.series[2].addPoint([x, vol], true, shift);
					chart.series[3].addPoint([x, power], true, shift);
					chart.series[4].addPoint([x, load], true, shift);
					chart.series[5].addPoint([x, current], true, shift);
					//document.getElementById("trafico").innerHTML=TemCPU + " / " + Tem;
			//	}else{
			//		document.getElementById("trafico").innerHTML="- / -";
				}
			},
			//error: function(XMLHttpRequest, textStatus, errorThrown) { 
			//	console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
		//	}       
		});
	}	

	$(document).ready(function() {
			Highcharts.setOptions({
				global: {
					useUTC: false
				}
			});
	

           chart = new Highcharts.Chart({
			   chart: {
				renderTo: 'mik_show',
				animation: Highcharts.svg,
				type: 'spline',
		borderColor: '#EBBA95',
        borderRadius: 20,
        borderWidth: 2,
				events: {
					load: function () {
						setInterval(function () {
							requestMik();
						}, 6000);
					}				
			}
		 },
		 title: {
			text: 'กราฟแสดง Health - Resource'
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
					margin: 15
				}
		 },
            series: [{
                name: 'CPU-°C',
                data: []
            }, {
                name: 'Tem-°C',
                data: []
            },{
                name: 'Volt',
                data: []
            },{
                name: 'Power-watt',
                data: []
            },{
                name: 'CPU-Load%',
                data: []
            },{
                name: 'Current-mA.',
                data: []
            }]
	  });
  });



</script>

       
</section>  

<!--###################################################################################################  -->










<div class="expir-user"> </div>


 <div class="row"> 
 <div class="col-lg-12">


<div class="row">
  <div class="col-lg-3 col-xs-6">

<div class="box box-style1 box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-style1</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-style1
           </div>   
             </div>

	
	 <div class="box box-style2 box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-style2</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-style2
           </div>   
             </div>



			 <div class="box box-style3 box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-style3</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-style3
           </div>   
             </div>



			 <div class="box box-style4 box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-style4</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-style4
           </div> 
		   </div>


		    <div class="box box-style5 box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-style5</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-style5
           </div>   
             </div>
		  
		   </div><!--  -->

            

			
			<div class="col-lg-3 col-xs-6">
			
			<div class="box box-style6 box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-style6</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
              <div class="box-body">
              box box-style6
           </div>   
             </div>

			 
			 <div class="box box-style7 box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-style7</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-style7
           </div>   
             </div>


			  <div class="box box-black box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-black</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-black
           </div>   
             </div>


			 <div class="box box-default box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-default</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             
              <div class="box-body">
              box box-default
           </div>   
             </div>

			  <div class="box box-primary box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-primary</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             
              <div class="box-body">
              box box-primary
           </div>   
             </div>

             </div><!--  --> 


           <div class="col-lg-3 col-xs-6">
			 
			 <div class="box box-warning box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-warning</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             
              <div class="box-body">
              box box-warning
           </div>   
             </div>
       
	   <div class="box box-danger box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-danger</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-danger
           </div>   
             </div>


			  <div class="box box-info box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-info</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-info
           </div>   
             </div>


			 <div class="box box-success box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-success</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
             <div class="box-body">
              box box-success
           </div>   
             </div>


			 <div class="box box-success-mid box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-success-mid</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
              <div class="box-body">
              box box-success-mid
           </div>   
             </div>


			 </div><!--  -->




           <div class="col-lg-3 col-xs-6">
			<div class="box box-info-mid box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-info-mid</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
              <div class="box-body">
              box box-info-mid
           </div>   
             </div>


			 <div class="box box-danger-mid box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-danger-mid</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
              <div class="box-body">
              box box-danger-mid
           </div>   
             </div>


			 <div class="box box-warning-mid box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-warning-mid</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
              <div class="box-body">
              box box-warning-mid
           </div>   
             </div>


			 <div class="box box-primary-mid box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-primary-mid</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
              <div class="box-body">
              box box-primary-mid
           </div>   
             </div>

			 <div class="box box-style8 box-solid">
      <div class="box-header with-border">
          <i class="fa fa-wrench"></i>
          <h3 class="box-title">box box-style8</h3>
             <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
            </div>
              <div class="box-body">
              box box-style8
           </div>   
             </div>

         
		  </div><!-- /col -->
			 </div><!-- /row -->
             </div><!-- /col -->
			 </div><!-- row -->

			 <!-- panel group -->
			 <div class="row"> 
 <div class="col-lg-12">


<div class="row">
  <div class="col-lg-3 col-xs-6">
			    
				

    <div class="panel panel-primary">
      <div class="panel-heading">Panel with panel-primary class</div>
      <div class="panel-body">Panel Content</div>
    </div>

    <div class="panel panel-success">
      <div class="panel-heading">Panel with panel-success class</div>
      <div class="panel-body">Panel Content</div>
    </div>

    <div class="panel panel-info">
      <div class="panel-heading">Panel with panel-info class</div>
      <div class="panel-body">Panel Content</div>
    </div>

    <div class="panel panel-warning">
      <div class="panel-heading">Panel with panel-warning class</div>
      <div class="panel-body">Panel Content</div>
    </div></div>

    
	<div class="col-lg-3 col-xs-6">
	
	<div class="panel panel-danger">
      <div class="panel-heading">Panel with panel-danger class</div>
      <div class="panel-body">Panel Content</div>
    </div>

	<div class="panel panel-black">
      <div class="panel-heading">Panel with panel-black class</div>
      <div class="panel-body">Panel Content</div>
    </div>

    <div class="panel panel-style1">
      <div class="panel-heading">Panel with panel-style1 class</div>
      <div class="panel-body">Panel Content</div>
    </div>

    <div class="panel panel-style2">
      <div class="panel-heading">Panel with panel-style2 class</div>
      <div class="panel-body">Panel Content</div>
    </div>

   </div>

	
	
	<div class="col-lg-3 col-xs-6">

	 <div class="panel panel-style3">
      <div class="panel-heading">Panel with panel-style3 class</div>
      <div class="panel-body">Panel Content</div>
    </div>

	<div class="panel panel-style4">
      <div class="panel-heading">Panel with panel-style4 class</div>
      <div class="panel-body">Panel Content</div>
    </div>

	<div class="panel panel-style5">
      <div class="panel-heading">Panel with panel-style5 class</div>
      <div class="panel-body">Panel Content</div>
    </div>

    <div class="panel panel-style6">
      <div class="panel-heading">Panel with panel-style6 class</div>
      <div class="panel-body">Panel Content</div>
    </div>

    </div>


	<div class="col-lg-3 col-xs-6">

    <div class="panel panel-default">
      <div class="panel-heading">Panel with panel-default class</div>
      <div class="panel-body">Panel Content</div>
	  </div>

	  <div class="panel panel-style7">
      <div class="panel-heading">Panel with panel-style7 class</div>
      <div class="panel-body">Panel Content</div>
    </div>
     

	<div class="<?php print panel_modify();?>">
      <div class="panel-heading"><?php print panel_modify();?> class</div>
      <div class="panel-body">Panel MODIFY</div>
    </div>

	<div> CHANGE COLOR <br><input class="jscolor"  value="#fff"></div>


	</div>
	</div><!-- row -->

    



    </div>
	</div>

    <!-- end -->

			 <div class="row">
		<div class="col-lg-3 col-xs-6">

	   <div class="small-box bg-color-pink">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-aqua <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>



 <div class="col-lg-3 col-xs-6">
 <div class="small-box bg-green">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-green <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>


         <div class="col-lg-3 col-xs-6">
		   <div class="small-box bg-yellow">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-yellow <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>

            <div class="col-lg-3 col-xs-6">
		   <div class="small-box bg-red">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-red <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>

		  </div><!-- row -->



         
		   <div class="row">
		<div class="col-lg-3 col-xs-6">

	   <div class="small-box bg-color-brown">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-brown <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>



 <div class="col-lg-3 col-xs-6">
 <div class="small-box bg-color-style1">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-style1 <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>


         <div class="col-lg-3 col-xs-6">
		   <div class="small-box bg-color-style2">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-style2 <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>

            <div class="col-lg-3 col-xs-6">
		   <div class="small-box bg-color-style3">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-style3 <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>

		  </div><!-- row -->


		   <div class="row">
		<div class="col-lg-3 col-xs-6">

	   <div class="small-box bg-color-style4"">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-style4 <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>



 <div class="col-lg-3 col-xs-6">
 <div class="small-box bg-color-style5">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-style5 <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>


         <div class="col-lg-3 col-xs-6">
		   <div class="small-box bg-color-style6">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-style6 <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>

            <div class="col-lg-3 col-xs-6">
		   <div class="small-box bg-color-style7">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-style7 <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>

		  </div><!-- row -->
		  <div class="row">
		          <div class="col-lg-3 col-xs-6">
		   <div class="small-box bg-color-style8">
            <div class="inner">
              <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Traffic</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <a href="#" class="small-box-footer">
              small-box bg-color-style8 <i class="fa fa-rocket"></i>
            </a>
          </div>
		   </div>
		   </div><!-- row -->


<div class="<?php print panel_modify();?>">
      <div class="panel-heading">
    
     <div class="row">
    <div class="col-lg-2 col-xs-6">

    <div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
    70%
  </div>
</div> 

</div>

 <div class="col-lg-2 col-xs-6">
    <div class="progress">
  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
    40%
  </div>
</div> 
</div>

   <div class="col-lg-2 col-xs-6">
    <div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
    40%
  </div>
</div> 
</div>

<div class="col-lg-2 col-xs-6">
    <div class="progress">
  <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
    50%
  </div>
</div> 
</div>

<div class="col-lg-2 col-xs-6">
    <div class="progress">
  <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
    50%
  </div>
</div> 
</div>


</div>
</div>
</div>
<!-- ####################### -->
                          <div class="row">
						  <div class="col-md-9 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Interface Tx/rx Traffic Chart
                        </div>
                        <div class="panel-body">
                            <div class="interface-traffic"></div>
                        </div>
                    </div>            
                </div>

                   
					<div class="col-md-3 col-sm-12 col-xs-12">                       
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>120 GB </h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                           Disk Space Available
                            
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-edit fa-5x"></i>
                            <h3>20,000 </h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Articles Pending
                            
                        </div>
                    </div>  
					
					 <div class="panel panel-primary text-center no-boder bg-color-pink">
                        <div class="panel-body">
                            <i class="fa fa-firefox  fa-5x"></i>
                            <h3>200 </h3>
                        </div>
                        <div class="panel-footer back-footer-pink">
                            Account
                            
                        </div>
                    </div>
                        </div>
						</div>
                 
					 
					 
					 <div class="row" >
                    <div class="col-md-3 col-sm-12 col-xs-12">
  <div class="panel panel-primary text-center no-boder bg-color-blue">
                        <div class="panel-body">
                            <i class="fa fa-comments-o fa-5x"></i>
                            <h4>200 New Comments </h4>
                             <h4>See All Comments  </h4>
                        </div>
                        <div class="panel-footer back-footer-blue">
                             <i class="fa fa-rocket fa-5x"></i>
                            Lorem ipsum dolor sit amet sit sit, consectetur adipiscing elitsit sit gthn ipsum dolor sit amet ipsum dolor sit amet
                            
                        </div>
                    </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12">
               
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Responsive Table Example
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                             <th>User No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>100090</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>100090</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            <td>100090</td>
                                        </tr>
                                         <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>100090</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            <td>100090</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            <td>100090</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                   
                    <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Chat Box
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i>Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i>Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i>Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i>Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i>Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <ul class="chat-box">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="assets/img/1.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body">                                        
                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                            </small>                                      
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">

                                        <img src="assets/img/2.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>
                                      
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                         <img src="assets/img/3.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        
                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>14 mins ago</small>
                                        
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                         <img src="assets/img/4.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                      
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>15 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>
                                       
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="assets/img/1.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body">                                        
                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                            </small>                                      
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                       <img src="assets/img/2.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>
                                      
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message to send..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>

                    </div>
                    
                </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                         <div class="panel panel-default">
                        <div class="panel-heading">
                           Label Examples
                        </div>
                        <div class="panel-body">
                            <span class="label label-default">Default</span>
<span class="label label-primary">Primary</span>
<span class="label label-success">Success</span>
<span class="label label-info">Info</span>
<span class="label label-warning">Warning</span>
<span class="label label-danger">Danger</span>
                        </div>
                    </div>
                         
                         <div class="panel panel-default">
                        <div class="panel-heading">
                            Donut Chart Example
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                        </div>
                    </div>


<img src='../img/winbox-logo.png' id='image' onclick="mouseOver()"></img>

<script type="text/javascript">
var image =  document.getElementById('image');

function mouseOver() {
    image.style.height="400px";
}

image.onclick = mouseOver;
</script>
<!-- ##################################### -->

       
  </section>
		
		
		