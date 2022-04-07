const { defaultsDeep } = require("lodash");

$(document).ready(function() {
	$(window).scroll(function(){
		if($(window).scrollTop()>34){
			$('header').addClass('small');
		}
		else{
			$('header').removeClass('small');
		}
	});
	
	$('input,textarea').focus(function(){
	   $(this).data('placeholder',$(this).attr('placeholder'))
			  .attr('placeholder','');
	}).blur(function(){
	   $(this).attr('placeholder',$(this).data('placeholder'));
	});
	
	
		
	$('.about-li').mouseover(function(){
	  $('.menu-box-customer').fadeIn();
	  
	});
	$('.about-li').mouseleave(function(){
	  $('.menu-box-customer').fadeOut();
	  
	});
	$('.country-li').mouseover(function(){
	  $('.menu-box').fadeIn();
	  
	});
	$('.country-li').mouseleave(function(){
	  $('.menu-box').fadeOut();
	  
	});
	$('.menuIcon').click(function(){
	  $('nav').addClass("navRight");
	  $('.closeBtn').show();
	});
	$('.closeBtn').click(function(){
	  $('nav').removeClass("navRight");
	  $('.closeBtn').hide();
	});		
	$(".dropdown-menu li a").click(function(){
	  var selText = $(this).text();
	  $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="icon-angle-down"></span>');
	});		
	
	//


	 
});


// polyfill
 
var newsTicker=$(".news").ticker({speed:50,item:".news-item"}).data("ticker");
$("#news-toggle").on("click",function(){newsTicker.toggle()}),$(".speed-test").each(function(){$(this).ticker({speed:$(this).data("speed")||60})});

 
(function($) {

  var tabs =  $(".tabs li a");
  
  tabs.click(function() {
    var content = this.hash.replace('/','');
    tabs.removeClass("active");
    $(this).addClass("active");
    $("#content").find('.divHide').hide();
    $(content).fadeIn(200);
  });

})(jQuery);

 