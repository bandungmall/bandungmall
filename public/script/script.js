// JavaScript Document

$(document).ready(function() {
	
	
	$('.alamatbaru').hide();
	$("input[name=radioalamat]:radio").click(function() {
		if($(this).attr("value")=="alamatbaru") {
			$(".alamatbaru").slideDown('fast');
		}
		if($(this).attr("value")!="alamatbaru") {
			$(".alamatbaru").slideUp('fast');
		}
	});
	
	$('#subkatmkn').hide();
	$('select[name=pdkkat1]').click(function () {
		 var optionSelected = $(this);
		 var value = optionSelected.val();
		 if(value =="aksesoris-hp") {
				$("#subkatmkn").hide();
				$('#subkatacc').show();
		}else if(value =="makanan") {
				$('#subkatacc').hide();
				$("#subkatmkn").show();
		}
	   });

		$(".product_side_bar_child").each(function() {
		    $(this).hide();
		});

		$( ".product_side_bar" ).each(function() {
		    $(this).on("click", function(){
		        $(this).siblings("#product_side_bar_child").slideToggle('fast');
		    });
		});
	
	
	var width = $(window).width();
		if(width>='800'){
			$('.submenu').hide();
			$('.subsubmenu').hide();
			
			var a = 0;
			$(".hoverer").click(function(e){
			
			
				if(a==0){
					handler1();	
				}else if(a==1){
					handler2();	
				}
				
				function handler1() {
					$('.submenu').fadeIn('fast');
					$('#accsub').fadeIn('fast');
					a = 1;
				}
				
				function handler2() {
					$('.submenu').fadeOut('fast');
					$('.subsubmenu').fadeOut('fast');
					a = 0;		
				}
				
		});
			
		$("#acchover").hover(function(e) {
			$("#mknhover").css('background-color','transparent');
			$("#mknhover").css('color','#000');
			$("#mknsub").hide();
			$("#accsub").show();
			$("#acchover").css('background-color','#0099CC');
			$("#acchover").css('color','#FFF');
		},function(e){
			
			
		});
		
		$("#mknhover").hover(function(e) {
			$("#acchover").css('background-color','transparent');
			$("#acchover").css('color','#000');
			$("#accsub").hide();
			$("#mknsub").show();
			$("#mknhover").css('background-color','#0099CC');
			$("#mknhover").css('color','#FFF');
		},function(e){
			
		});
		
		$("#accsub").hover(function(e) {
			$("#mknhover").css('background-color','transparent');
			$("#mknhover").css('color','#000');
			$("#mknsub").hide();
			$("#accsub").show();
			$("#acchover").css('background-color','#0099CC');
			$("#acchover").css('color','#FFF');
			if(a==0){
				$('#accsub').hide();	
			}
		},function(e){
			 
		});
		
		$("#mknsub").hover(function(e) {
			$("#acchover").css('background-color','transparent');
			$("#acchover").css('color','#000'); 
			$("#accsub").hide();
			$("#mknsub").show(); 	
			$("#mknhover").css('background-color','#0099CC');
			$("#mknhover").css('color','#FFF');  
			if(a==0){
				$('#mknsub').hide();	
			}
		},function(e){
		
		});
				
			
		}else{
			$('.submenu').hide();
			$('.subsubmenu').hide();
			
			var a = 0;
			$(".hoverer").click(function(e){	
				if(a==0){
					handler1();	
				}else if(a==1){
					handler2();	
				}
				
				function handler1() {
					$('.submenu').fadeIn('fast');
					a = 1;
				}
				
				function handler2() {
					$('.submenu').fadeOut('fast');
					a = 0;		
				}
				
		});
			
		}
	var p = $('#menubar').position();
	var q = $('#downfooter').position();
	$('#scroller').affix({offset: {bottom: q.top + 250 ,top: p.top + 100} }); 
	
});