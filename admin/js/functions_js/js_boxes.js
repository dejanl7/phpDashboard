function boxes_dashboard(right_click_div, div_content, param1, param2, param3, param4, param5, param6){
	$(document).ready(function(){
		$(right_click_div).click(function(e){
			var color_type = $(this).data('color'); // Take data attribute - font color or background color
			var page = $(this).data('page');
			var insert_database_value_into_input_field = $(right_click_div).attr('attr');
			var font_style = $(this).data('font'); 
			if(typeof insert_database_value_into_input_field !== 'undefined'){
				$(".demo_forceformat").val(insert_database_value_into_input_field);
				
				// Select All Fields in All Pages with the same color
					$(div_content + ' .apply_in_all_pages').click(function(){
						var font_color_all_tables = $(div_content + ' .demo_forceformat').val();
						var background_color_all_tables = $(div_content + ' .demo_forceformat').val();
						var url_address = 'inc/pages/pages_insert_info.php';

						if(color_type === 'font_color'){
							$.ajax({
								type: 'POST',
								url: url_address,
								data: {font_color_all_tables:font_color_all_tables},
								success: function(data){
									location.reload();
								},
								error: function(){
									alert("failure");
								}
							});	
						}
							else {
								$.ajax({
									type: 'POST',
									url: url_address,
									data: {background_color_all_tables:background_color_all_tables},
									success: function(data){
										location.reload();
									},
									error: function(){
										alert("failure");
									}
								});	
							}			
					});

					//Select One Color for ONE Page
					$(div_content + ' .apply_in_this_page').click(function(){
						var color_this_page = $(div_content + ' .demo_forceformat').val();
						var url_address = 'inc/pages/pages_insert_info.php';

						//alert(color_type + color_this_page + page);
						$.ajax({
							type: 'POST',
							url: url_address,
							data: {color_this_page:color_this_page, page:page, color_type:color_type},
							success: function(data){
								location.reload();
							},
							error: function(){
								alert("failure");
							}
						});				
					});
			}
			
            // Apply The Same TITLE Font Weight And Style in ALL Pages
			$(div_content + ' .apply_font_in_all_pages').click(function(){
				var font_address = 'inc/pages/pages_insert_info.php';
				var weight_type = $(div_content + ' .weight_type').val();
				var font_type= $(div_content + ' .font_type').val();

				$.ajax({
					type: 'POST',
					url: font_address,
					data: {weight_type:weight_type, font_type:font_type, font_style:font_style},
					success: function(data){
						//alert(weight_type + font_type + font_style);
						location.reload();
						//alert(weight_type + font_type + font_style);
					},
					error: function(){
						alert("failure");
					}
				});		
			
			});

			// Apply The Same TITLE Font Weight and Style in ONE Page
			$(div_content + ' .apply_font_in_this_page').click(function(){
				var font_style_address = 'inc/pages/pages_insert_info.php';
				var font_size =  $(div_content + ' .weight_type').val();
				var font_type_one_page = $(div_content + ' .font_type').val();

				$.ajax({
					type: 'POST',
					url: font_style_address,
					data: {font_size:font_size, font_type_one_page:font_type_one_page, page:page},
					success: function(data){
						location.reload();
					},
					error: function(){
						alert("failure");
					}
				});

			});	

			leftVal=e.pageX;
			topVal=e.pageY;
				$(div_content).css({
					display: "block",
					left:leftVal,
					top:topVal
				});
			return false;
		});
		
		$("#index_headline").click(function(){
			$(div_content).hide(); 
		});
		$("#top_menu").click(function(){
			$(div_content).hide(); 
		});
		$("#info_head").click(function(){
			$(div_content).hide(); 
		});
		$("#headline2").click(function(){
			$(div_content).hide(); 
		});
		$("#change_first_div_background").click(function(){
			$(div_content).hide(); 
		});
		$("#second_div").click(function(){
			$(div_content).hide(); 
		});
		$("#second_div_content").click(function(){
			$(div_content).hide(); 
		});
		$(param1).click(function(){
			$(div_content).hide(); 
		});
		$(param2).click(function(){
			$(div_content).hide(); 
		});
		$(param3).click(function(){
			$(div_content).hide(); 
		});
		$(param4).click(function(){
			$(div_content).hide(); 
		});
		$(param5).click(function(){
			$(div_content).hide(); 
		});
		$(param6).click(function(){
			$(div_content).hide(); 
		});
		$(document).on('keyup',function(evt){
			if (evt.keyCode == 27) {
			   $(div_content).hide(); //If press ESC key, this div will disapear
			}
		});
		
	});
}


/*=============================================================== 
	BOXES FOR PAGE "INDEX.PHP" 
=================================================================*/
function index_two_parametars(right_click_div, div_content, param1){
	boxes_dashboard(right_click_div, div_content, param1);
}
function index_three_parametars(right_click_div, div_content, param1, param2){
	boxes_dashboard(right_click_div, div_content, param1);
}
function index_four_parametars(right_click_div, div_content, param1, param2, param3){
	boxes_dashboard(right_click_div, div_content, param1);
}


/*=============================================================== 
	BOXES FOR PAGE "ABOUT.PHP" 
=================================================================*/
function about_two_parametars(right_click_div, div_content, param1){
	boxes_dashboard(right_click_div, div_content, param1);
}
function about_three_parametars(right_click_div, div_content, param1, param2){
	boxes_dashboard(right_click_div, div_content, param1);
}
function about_six_parametars(right_click_div, div_content, param1, param2, param3, param4, param5){
	boxes_dashboard(right_click_div, div_content, param1);
}


/*=============================================================== 
	BOXES FOR PAGE "GALLERY.PHP" 
=================================================================*/
function gallery_two_parametars(right_click_div, div_content, param1){
	boxes_dashboard(right_click_div, div_content, param1);
}
function gallery_three_parametars(right_click_div, div_content, param1, param2){
	boxes_dashboard(right_click_div, div_content, param1);
}
function gallery_six_parametars(right_click_div, div_content, param1, param2, param3, param4, param5){
	boxes_dashboard(right_click_div, div_content, param1);
}


/*=============================================================== 
	BOXES FOR PAGE "PREVIEW.PHP" 
=================================================================*/
function preview_two_parametars(right_click_div, div_content, param1){
	boxes_dashboard(right_click_div, div_content, param1);
}
function preview_three_parametars(right_click_div, div_content, param1, param2){
	boxes_dashboard(right_click_div, div_content, param1);
}
function preview_four_parametars(right_click_div, div_content, param1, param2, param3){
	boxes_dashboard(right_click_div, div_content, param1);
}
function preview_six_parametars(right_click_div, div_content, param1, param2, param3, param4, param5){
	boxes_dashboard(right_click_div, div_content, param1);
}


/*=============================================================== 
	BOXES FOR PAGE "CONTACT.PHP" 
=================================================================*/
function contact_two_parametars(right_click_div, div_content, param1){
	boxes_dashboard(right_click_div, div_content, param1);
}
function contact_five_parametars(right_click_div, div_content, param1, param2, param3, param4){
	boxes_dashboard(right_click_div, div_content, param1);
}