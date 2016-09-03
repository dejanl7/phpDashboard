"use strict";
$(function() {

  function createColorpickers() {  
	  
/********************************** HEADLINE - change text color *************************************/  
	var preview_headline_text = $('#preview_headline_container')[0];  
	$('#preview_color_pickerHeadline').colorpicker({
		color: preview_headline_text.style.color
    }).on('changeColor', function(ev) {
        preview_headline_text.style.color  = ev.color;
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

/********************************** FIRST (MAIN) DIV change background color *************************************/  
	var preview_headline_background = $('#preview_whole')[0];  
	$('#preview_color_pickerBackground').colorpicker({
		color: preview_headline_background.style.color
    }).on('changeColor', function(ev) {
        preview_headline_background.style.backgroundColor  = ev.color;
    });
	
/********************************** SPECIFICATIONS ("SPECIFIKACIJE") - change font color *************************************/  
	var preview_mainDiv_font_color = $('#edit_article_container')[0];  
	$('#preview_specifications_pickerFont').colorpicker({
		color: preview_mainDiv_font_color.style.color
    }).on('changeColor', function(ev) {
        preview_mainDiv_font_color.style.color  = ev.color;
    });

/********************************** SPECIFICATIONS ("SPECIFIKACIJE") - change background color *************************************/  
	var preview_specifications_bg_color = $('#edit_article_container')[0];  
	$('#preview_specifications_pickerBackground').colorpicker({
		color: preview_specifications_bg_color.style.color
    }).on('changeColor', function(ev) {
        preview_specifications_bg_color.style.backgroundColor  = ev.color;
    });	

/********************************** COMMENTS ("Komentari") - change font color *************************************/  
  var preview_comment_headline_font_color = $('#comments_container')[0];  
  $('#preview_commentsHeadline_pickerFont').colorpicker({
    color: preview_comment_headline_font_color.style.color
    }).on('changeColor', function(ev) {
        preview_comment_headline_font_color.style.color  = ev.color;
    });

/********************************** COMMENTS ("Komentari") - change font color *************************************/  
  var first     = $('.comments-div')[0];
  var first1    = $('.comment-content')[0];
  var second    = $('.comments-div')[1];
  var second1   = $('.comment-content')[1];
  var third     = $('.comments-div')[2];
  var third1    = $('.comment-content')[2];
  var fourth    = $('.comments-div')[3];
  var fourth1   = $('.comment-content')[3];
  var fifth     = $('.comments-div')[4]; 
  var fifth1    = $('.comment-content')[4];
  var sixth     = $('.comments-div')[5];
  var sixth1    = $('.comment-content')[5];
  var seventh   = $('.comments-div')[6];
  var seventh1  = $('.comment-content')[6];
  var eighth    = $('.comments-div')[7];
  var eighth1   = $('.comment-content')[7];
  
  $('#preview_content_pickerFont').colorpicker({
    color: first.style.color
    }).on('changeColor', function(ev) {
        first.style.color     = ev.color;
        first1.style.color    = ev.color;
        second.style.color    = ev.color;
        second1.style.color   = ev.color;
        third.style.color     = ev.color;
        third1.style.color    = ev.color;
        fourth.style.color    = ev.color;
        fourth1.style.color   = ev.color;
        fifth.style.color     = ev.color;
        fifth1.style.color    = ev.color;
        sixth.style.color     = ev.color;
        sixth1.style.color    = ev.color;
        seventh.style.color   = ev.color;
        seventh1.style.color  = ev.color;
        eighth.style.color    = ev.color;
        eighth1.style.color   = ev.color;
    });


/********************************** COMMENTS ("Komentari") - change background color *************************************/  
  var firstBg     = $('.comments-div')[0];
  var secondBg    = $('.comments-div')[1];
  var thirdBg     = $('.comments-div')[2];
  var fourthBg    = $('.comments-div')[3];
  var fifthBg     = $('.comments-div')[4]; 
  var sixthBg     = $('.comments-div')[5];
  var seventhBg   = $('.comments-div')[6];
  var eighthBg    = $('.comments-div')[7];

  $('#preview_content_pickerBackground').colorpicker({
    color: firstBg.style.color
    }).on('changeColor', function(ev) {
        firstBg.style.backgroundColor  = ev.color;
        secondBg.style.backgroundColor  = ev.color;
        thirdBg.style.backgroundColor  = ev.color;
        fourthBg.style.backgroundColor  = ev.color;
        fifthBg.style.backgroundColor  = ev.color;
        sixthBg.style.backgroundColor  = ev.color;
        seventhBg.style.backgroundColor  = ev.color;
        eighthBg.style.backgroundColor  = ev.color;
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

