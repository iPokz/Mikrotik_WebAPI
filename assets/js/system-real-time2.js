$(document).ready(function(){
var timer;

  
       function requestMik() {
		$.ajax({
			url: '../system/data/data_dashboard.php',
              // cache: false,
			success: function(data) {
				var DATAMIK = JSON.parse(data);
				if( DATAMIK.length > 0 ) {
					var cpu_tem=(DATAMIK[0].data);
					var tem=(DATAMIK[1].data);
					var volt=(DATAMIK[2].data);
					var watt=(DATAMIK[3].data);
					var cpu_load=(DATAMIK[4].data);
					var current=(DATAMIK[5].data);
					var active_fan=(DATAMIK[6].data);
					var fan1_speed=(DATAMIK[7].data);
					var fan2_speed=(DATAMIK[8].data);
					var free_memory=(DATAMIK[9].data);
					var free_hdd_space=(DATAMIK[10].data);
					var uptime=(DATAMIK[11].data);
					var hotspot_active=(DATAMIK[12].data);
					var pppoe_active=(DATAMIK[13].data);
					var ap_online=(DATAMIK[14].data);
					var panal_uptime=(DATAMIK[15].data);
					var time=(DATAMIK[16].data);
					var date=(DATAMIK[17].data);
					
					
					var fan_mode=(DATAMIK[18].data);
					$('.fan_mode').text(fan_mode);

					var use_fan=(DATAMIK[19].data);
					$('.use_fan').text(use_fan);

					var platform=(DATAMIK[20].data);
					$('.platform').text(platform);

					var board_name=(DATAMIK[21].data);
					$('.board_name').text(board_name);

					var version=(DATAMIK[22].data);
					$('.version').text(version);

					var cpu_model=(DATAMIK[23].data);
					$('.cpu_model').text(cpu_model);

					var cpu_count=(DATAMIK[24].data);
					$('.cpu_count').text(cpu_count);

					var cpu_frequency=(DATAMIK[25].data);
					$('.cpu_frequency').text(cpu_frequency);

					var total_mem=(DATAMIK[26].data);
					$('.total_mem').text(total_mem);

					var total_hdd=(DATAMIK[27].data);
					$('.total_hdd').text(total_hdd);

					var architecture_name=(DATAMIK[28].data);
					$('.architecture_name').text(architecture_name);

					var build_time=(DATAMIK[29].data);
					$('.build_time').text(build_time);
					
					$('.cpu-temperature').text(cpu_tem);
					$('.temperature').text(tem);
					$('.voltage').text(volt);
					$('.power-consumption').text(watt);
					$('.cpu-load').text(cpu_load);
					$('.current').text(current);
					$('.active-fan').text(active_fan);
					$('.fan1-speed').text(fan1_speed);
					$('.fan2-speed').text(fan2_speed);
					$('.free-memory').text(free_memory);
					$('.free-hdd-space').text(free_hdd_space);
					$('.res-up-time').text(uptime);
					$('.user-online').text(hotspot_active);
					$('.pppoe-online').text(pppoe_active);
					$('.ap-online').text(ap_online);
					$('.up-time').text(panal_uptime);
					$('.time').text(time);
					$('.date').text(date);
					

}
			},
		});
					
	};	
var auto_refresh = setInterval(function () {
		requestMik();
     }, 3000);
});		