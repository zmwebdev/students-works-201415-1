$(document).ready(function(){

		$.ajax({
				
				type: "GET",
				url: "/partaideak",
				dataType: "json",
				
				success: function(data){
					
					 $("#box1").css('background-image','url("../images/'+data[0].url+'")');
					 $("#box2").css('background-image','url("../images/'+data[1].url+'")');					 
					 $("#box3").css('background-image','url("../images/'+data[2].url+'")');					 
					 $("#box4").css('background-image','url("../images/'+data[3].url+'")');					 
					 $("#box5").css('background-image','url("../images/'+data[4].url+'")');					 
					 $("#box6").css('background-image','url("../images/'+data[5].url+'")');
					 
					 
				}
			});

		/*$.ajax({
				
				type: "GET",
				url: "/bideoak",
				dataType: "json",
				
				success: function(data){
					
					 $("#box1").css('background-image','url("../images/'+data[0].url+'")');
					 $("#box2").css('background-image','url("../images/'+data[1].url+'")');					 
					 $("#box3").css('background-image','url("../images/'+data[2].url+'")');					 
					 $("#box4").css('background-image','url("../images/'+data[3].url+'")');					 
					 $("#box5").css('background-image','url("../images/'+data[4].url+'")');					 
					 $("#box6").css('background-image','url("../images/'+data[5].url+'")');
					 
					 
				}
			});*/
	});