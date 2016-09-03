"use strict";
$(function() {

  function createColorpickers() {

/********************************** HEADLINE - CHANGE TEXT COLOR *************************************/	
	var index_headline_text = $('#index_headline')[0];  
	$('#index_color_pickerHeadline').colorpicker({
		color: index_headline_text.style.color
    }).on('changeColor', function(ev) {
        index_headline_text.style.color  = ev.color;
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

/********************************** FIRST DIV - CONTENT FONT COLOR *************************************/
    var first_div_content = $('#first_div_text')[0];
    $('#index_color_picker_firstDiv').colorpicker({
		color: first_div_content.style.color
    }).on('changeColor', function(ev) {
        first_div_content.style.color  = ev.color;
    });
	
/********************************** FIRST DIV - BACKGROUND COLOR *************************************/
    var first_div_background = $('#change_first_div_background')[0];
    $('#index_color_picker_background_firstDiv').colorpicker({
		color: first_div_background.style.color
    }).on('changeColor', function(ev) {
        first_div_background.style.backgroundColor  = ev.color;
    });
	
/********************************** SECOND DIV - HEADLINE FONT COLOR *************************************/
    var second_div_headline = $('#second_div')[0];
    $('#index_color_picker_secondDiv').colorpicker({
		color: second_div_headline.style.color
    }).on('changeColor', function(ev) {
        second_div_headline.style.color  = ev.color;
    });

/********************************** SECOND DIV - HEADLINE FONT COLOR *************************************/
    var second_div_content = $('#second_div_content')[0];
    $('#index_color_picker_content_secondDiv').colorpicker({
		color: second_div_content.style.color
    }).on('changeColor', function(ev) {
        second_div_content.style.color  = ev.color;
    });
	
/********************************** SECOND DIV - BACKGROUND COLOR *************************************/
    var second_div_background = $('#second_div_background')[0];
    $('#index_color_picker_background_secondDiv').colorpicker({
		color: second_div_background.style.color
    }).on('changeColor', function(ev) {
        second_div_background.style.backgroundColor  = ev.color;
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

