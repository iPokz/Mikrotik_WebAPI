$(document).ready(function(){
		var timer;



		var auto_refresh = setInterval(
		function ()
		{
		$('.logs').load('../real-time/logs.php').fadeIn("fast");
		$(".logs").animate({ scrollTop: $(".logs")[0].scrollHeight}, 100);
		}, 3000); // refresh every 10000 milliseconds
});

