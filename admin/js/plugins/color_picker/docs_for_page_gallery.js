"use strict";
$(function() {

  function createColorpickers() {  
	  
/********************************** HEADLINE - change text color *************************************/  
	var gallery_headline_text = $('#gallery_headline')[0];  
	$('#gallery_color_pickerHeadline').colorpicker({
		color: gallery_headline_text.style.color
    }).on('changeColor', function(ev) {
        gallery_headline_text.style.color  = ev.color;
    });
	  
/********************************** MAIN MENU - CHANGE TEXT COLOR *************************************/
    var first = $('.change_text_color')[0];
    var second = $('.change_text_color')[1];
    var third = $('.change_text_color')[2];
    var fourth = $('.change_text_color')[3];
    $('#change_text_color_main_menu').colorpicker({
		color: first.style.color
    }).on('changeColor', function(ev) {
        first.style.color  = ev.color;
        second.style.color  = ev.color;
        third.style.color  = ev.color;
        fourth.style.color  = ev.color;
    });
/********************************** MAIN MENU - CHANGE DIV COLOR *************************************/
    var main_menu_background = $('#top_menu')[0];
    $('#color_pickerBgTopmenu').colorpicker({
		color: main_menu_background.style.color
    }).on('changeColor', function(ev) {
        main_menu_background.style.backgroundColor  = ev.color;
    });

/********************************** CAROUSEL SLIDER - change text color *************************************/  
	var gallery_carousel_text = $('#carousel_container')[0];  
	$('#color_picker_CarouselFontColor').colorpicker({
		color: gallery_carousel_text.style.color
    }).on('changeColor', function(ev) {
        gallery_carousel_text.style.color  = ev.color;
    });
	
/********************************** CAROUSEL SLIDER - change background color *************************************/  
	var gallery_carousel_background = $('#ocarousel_slider')[0];  
	$('#color_picker_CarouselBackgroundColor').colorpicker({
		color: gallery_carousel_background.style.color
    }).on('changeColor', function(ev) {
        gallery_carousel_background.style.backgroundColor  = ev.color;
    });
	
/********************************** FIRST DIV HEADLINE - change font color *************************************/  	
	var gallery_firstDiv_color = $('#mainDiv_headline')[0];  
	$('#color_picker_first_div_fontColor').colorpicker({
		color: gallery_firstDiv_color.style.color
    }).on('changeColor', function(ev) {
        gallery_firstDiv_color.style.color  = ev.color;
    });

/********************************** FIRST DIV CONTENT - change font color *************************************/  	
	var gallery_firstDiv_content_color = $('#text_offer')[0];  
	$('#color_picker_first_div_content_fontColor').colorpicker({
		color: gallery_firstDiv_content_color.style.color
    }).on('changeColor', function(ev) {
        gallery_firstDiv_content_color.style.color  = ev.color;
    });

/********************************** FIRST DIV CONTENT - change background color *************************************/  	
	var gallery_firstDiv_background_color = $('#div_all_content')[0];  
	$('#color_picker_first_div_background_fontColor').colorpicker({
		color: gallery_firstDiv_background_color.style.color
    }).on('changeColor', function(ev) {
        gallery_firstDiv_background_color.style.backgroundColor  = ev.color;
    });	
	

/********************************** OUR TEAM - change background color *************************************/  	
	
  
}

  createColorpickers();
/********************************** MAIN MENU - MAKE COLOR PICKER BIGGER *************************************/
    $('.demo_forceformat').colorpicker({
      customClass: 'colorpicker-2x',
      sliders: {
        saturation: {
          maxLeft: 200,
          maxTop: 200
        },
        hue: {
          maxTop: 200
        },
        alpha: {
          maxTop: 200
        }
      }
    });

/********************************** Create / destroy instances *************************************/
  $('.demo-destroy').click(function(e) {
    e.preventDefault();
    $('.demo').colorpicker('destroy');
    $(".disable-button, .enable-button").off('click');
  });

  $('.demo-create').click(function(e) {
    e.preventDefault();
    createColorpickers();
  });
});

