// JavaScript Document

$(document).ready(function(e) {
    
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
	   
	 $('.jawab').hide();
	 $('.jawabbtn').click(function(e){
		$(this).closest('.question-line').children('.jawab').slideDown('fast'); 
		$(this).hide();
	 });
	 
	 
	$('.customersub').hide();
	$('.merchantsub').hide();
	var x=0;
	
	$('.customertoggle').click(function(e) {
		if(z==1){
			$('.merchantsub').slideUp('fast');
			$('.merchanttoggle > li > span').removeClass('glyphicon-minus');
			$('.merchanttoggle > li > span').addClass('glyphicon-plus');
			z=0;
		}
        if(x==0){
			showit();
		}else if(x==1){
			hideit();	
		}
		
		function showit(){
			$('.customersub').slideDown('fast');
			$('.customertoggle > li > span').removeClass('glyphicon-plus');
			$('.customertoggle > li > span').addClass('glyphicon-minus');
			x=1;
		}
		
		function hideit(){
			$('.customersub').slideUp('fast');	
			$('.customertoggle > li > span').removeClass('glyphicon-minus');
			$('.customertoggle > li > span').addClass('glyphicon-plus');
			x=0;
		}
		
    });
	
	var z=0;
	$('.merchanttoggle').click(function(e) {
		if(x==1){
			$('.customersub').slideUp('fast');
			$('.customertoggle > li > span').removeClass('glyphicon-minus');
			$('.customertoggle > li > span').addClass('glyphicon-plus');
			x=0;
		}
        if(z==0){
			showit();
		}else if(z==1){
			hideit();	
		}
		
		function showit(){
			$('.merchantsub').slideDown('fast');
			$('.merchanttoggle > li > span').removeClass('glyphicon-plus');
			$('.merchanttoggle > li > span').addClass('glyphicon-minus');
			z=1;
		}
		
		function hideit(){
			$('.merchantsub').slideUp('fast');	
			$('.merchanttoggle > li > span').removeClass('glyphicon-minus');
			$('.merchanttoggle > li > span').addClass('glyphicon-plus');
			z=0;
		}
    });
});