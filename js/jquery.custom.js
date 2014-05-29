$(document).ready(function(){	

	$("#rotate").cycle({ fx: 'fade', speed: 3000, timeout: 6000});
	
	$("nav ul li a").css({"opacity": "1"});
	$("nav ul li a").mouseover(function(){ $(this).animate({"opacity": "0.8"}) });
	$("nav ul li a").mouseout(function(){ $(this).animate({"opacity": "1"}) });
	
	$("#bottominfo .social ul li a").css({"opacity": "1"});
	$("#bottominfo .social ul li a").mouseover(function(){ $(this).animate({"opacity": "0.8"}) });
	$("#bottominfo .social ul li a").mouseout(function(){ $(this).animate({"opacity": "1"}) });
	
	$("#content .links ul li a").css({"opacity": "1"});
	$("#content .links ul li a").mouseover(function(){ $(this).animate({"opacity": "0.9"}) });
	$("#content .links ul li a").mouseout(function(){ $(this).animate({"opacity": "1"}) });

});	