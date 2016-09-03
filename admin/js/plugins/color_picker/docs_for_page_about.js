"use strict";
$(function() {

  function createColorpickers() {  
	  
/********************************** HEADLINE - change text color *************************************/  
	var headline_text = $('#headline')[0];  
	$('#color_pickerHeadline').colorpicker({
		color: headline_text.style.color
    }).on('changeColor', function(ev) {
        headline_text.style.color  = ev.color;
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

/********************************** BUSINESS INFO - change HEADLINE text color *************************************/  	
	var headline_bi_text_color = $('#info_head')[0];  
	$('#color_pickerBusinessInfoHeadline').colorpicker({
		color: headline_bi_text_color.style.color
	}).on('changeColor', function(ev) {
		headline_bi_text_color.style.color  = ev.color;
	});
	
/********************************** BUSINESS INFO - change CONTENT text color *************************************/  	
	var bi_text_color = $('#business_info_base')[0];  
	$('#color_pickerBusinessInfoBg').colorpicker({
		color: bi_text_color.style.color
	}).on('changeColor', function(ev) {
		bi_text_color.style.color = ev.color;
	});

/********************************** BUSINESS INFO - change BACKGROUND color *************************************/  	
	var business_info_background_color = $('#box_business_info')[0];  
	$('#color_pickerBusinessInfo').colorpicker({
		color: business_info_background_color.style.color
	}).on('changeColor', function(ev) {
		business_info_background_color.style.backgroundColor  = ev.color;
	});
	
/********************************** OUR TEAM - change headline color *************************************/  	
	var our_team_headline_color = $('#headline2')[0];  
	$('#sub_headline_colorOurTeam').colorpicker({
		color: our_team_headline_color.style.color
	}).on('changeColor', function(ev) {
		our_team_headline_color.style.color  = ev.color;
	});
/********************************** OUR TEAM - change content font color *************************************/  	
	var our_team_text_content_color = $('#our_team_container_for_font_color')[0];  
	$('#sub_text_content_colorOurTeam').colorpicker({
		color: our_team_text_content_color.style.color
	}).on('changeColor', function(ev) {
		our_team_text_content_color.style.color  = ev.color;
	}); 

/********************************** OUR TEAM - change background color *************************************/  	
	var our_team_text_background_color = $('#our_team_container')[0];  
	$('#sub_content_background_colorOurTeam').colorpicker({
		color: our_team_text_background_color.style.color
	}).on('changeColor', function(ev) {
		our_team_text_background_color.style.backgroundColor  = ev.color;
	}); 
  
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

