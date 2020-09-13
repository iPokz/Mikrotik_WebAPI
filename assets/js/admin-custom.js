$(document).ready(function(){
// ping btn 
$('.ping-btn').click(function(){
	$('.box-ping').hide();
	$('.ping-monitor').show();
});

	$('.no1').hover(function(){
	$(this).tooltip('show');
	});
	$('.no2').hover(function(){
	$(this).tooltip('show');
	});
	$('.no3').hover(function(){
	$(this).tooltip('show');
	});


		  $('#numuser,#numuser').keydown(function(event) {
                
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) 
                    || (event.keyCode >= 35 && event.keyCode <= 39)){
                        return;
                }else {
       
                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault(); 
                    }   
                }
            });


//test connect
	$('.test-btn').click(function(){
		var ip = $('#ip').val();
		var user = $('#username').val();
		var pass = $('#password').val();
		var portapi = $('#portapi').val();
		var portweb = $('#portweb').val();
		$.ajax({
					type:"POST",
					url: "setup_server.php?cmd=testcon",
					cache: false,
					data:{ip:ip,user:user,pass:pass,portapi:portapi,portweb:portweb},
						success:function(data){
						$('.test-connect').html(data);
					}
			});

	});
	


	$('#search_user').keyup(function(){
		var txt =  $(this).val();
		if(txt.lenght<3){
			return false;
		}	
			$.ajax({
					type:"POST",
					url: "all_user.php",
					cache: false,
					data:{txt:txt},
						success:function(data){
						$('.responsive').html(data);
						return false;
					}
			});
	});

////new
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });///

	   $('#selecctall1').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });///

	$("#sidebar-show-btn").click(function() {
   
	//$('#sidebar-show-btn').block();
    $('#mapDiv').removeClass('col-lg-9');
    $('#mapDiv').addClass('col-lg-12');
});
	$("#sidebar-hide-btn").click(function() {
   // $('#sidebar-show-btn').hide();
    $('#mapDiv').removeClass('col-lg-12');
    $('#mapDiv').addClass('col-lg-9');
});//

});//docu

 function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
///////////1////////
function toggle_visibility_double(id) {
    var list = document.getElementsByClassName("alist");
    for (var i = 0; i < list.length; i++) {
        list[i].style.display = 'none';
    }
    var e = document.getElementById(id);
    if(e.style.display == 'block') {
        e.style.display = 'none';
    } else {
        e.style.display = 'block';
    }
}
///////////////2/////////////

function toggle_visibility_size(id) {
    var list = document.getElementsByClassName("allsize");
    for (var i = 0; i < list.length; i++) {
        list[i].style.display = 'none';
    }
    var e = document.getElementById(id);
    if(e.style.display == 'block') {
        e.style.display = 'none';
    } else {
        e.style.display = 'block';
    }
}
////////////////3////////////		










