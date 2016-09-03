"use strict";
$(function() {

  function createColorpickers() {  
	  
// HEADLINE - change text color  
	var headline_text = $('#first_div_contact_text_container')[0];  
	$('#contact_color_pickerHeadline').colorpicker({
		color: headline_text.style.color
    }).on('changeColor', function(ev) {
        headline_text.style.color  = ev.color;
    })
	
// MAIN MENU - CHANGE TEXT COLOR
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

// MAIN MENU - CHANGE DIV COLOR 
    var main_menu_background = $('#top_menu')[0];
    $('#color_pickerBgTopmenu').colorpicker({
		color: main_menu_background.style.color
    }).on('changeColor', function(ev) {
        main_menu_background.style.backgroundColor  = ev.color;
    });

// FIRST DIV HEADLINE - change text color
	var first_div_headline = $('#first_div_contact')[0];  
	$('#contact_headline_color_picker_firstDiv').colorpicker({
		color: first_div_headline.style.color
    }).on('changeColor', function(ev) {
        first_div_headline.style.color  = ev.color;
    })
	
// FIRST DIV CONTENT - change text color
	var first_div_content_color = $('#address_info_div_load')[0];  
	$('#contact_color_picker_contentFontColor').colorpicker({
		color: first_div_content_color.style.color
    }).on('changeColor', function(ev) {
        first_div_content_color.style.color  = ev.color;
    })

// FIRST DIV CONTENT - change BACKGROUND color
	var first_div_content_background_color = $('#all_first_div')[0];  
	$('#content_color_picker_background_firstDiv').colorpicker({
		color: first_div_content_background_color.style.color
    }).on('changeColor', function(ev) {
        first_div_content_background_color.style.backgroundColor  = ev.color;
    })	
	
	
	
	
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

