<!-- =================================================
	FUNCTION FOR DEFINE FONT WEIGHT AND FONT TYPE 
======================================================-->
<?php
function font_weight_and_style($weight_style_div_name, $weight_style_form, $weight_style_action, $weight_style_db_column_first, $weight_style_font_weight, $weight_style_db_column_second, $weight_style_font_style, $weight_style_submit){ 
?>
	<div id="<?php echo $weight_style_div_name; ?>" class="popup_msg">
	<form method="POST" id="<?php echo $weight_style_form; ?>" action="<?php echo $weight_style_action; ?>" role="form" class="form-group">
		<div class="edit_font_boxes">
			<table class="table well">
			<tr></tr>
			<tr><td class="boxes_text_style"><b>Izaberite veličinu fonta: </b></td><td>
				<select class="form-control weight_type" id="<?php echo $weight_style_font_weight; ?>" name="<?php echo $weight_style_font_weight; ?>">
					<option value="">Izaberite veličinu fonta</option>
					<option value="12px">12 px</option>
					<option value="14px">14 px</option>
					<option value="16px">16 px</option>
					<option value="20px">20 px</option>
					<option value="24px">24 px</option>
					<option value="28px">28 px</option>
					<option value="32px">32 px</option>
					<option value="36px">36 px</option>
					<option value="42px">42 px</option>
					<option value="48px">48 px</option>
					<option value="54px">54 px</option>
					<option value="62px">62 px</option>
					<option value="70px">70 px</option>
					<option value="78px">78 px</option>
					<option value="86px">86 px</option>
				</select>
					<input type="text" style="visibility:hidden" id="<?php echo $weight_style_db_column_first; ?>" name="<?php echo $weight_style_db_column_first; ?>" value="<?php echo $weight_style_db_column_first; ?>" />
			</td></tr>
		<tr>
			<td class="boxes_text_style"><b>Izaberite font:</b></td>
			<td>
				<select class="form-control font_type" id="<?php echo $weight_style_font_style; ?>" name="<?php echo $weight_style_font_style; ?>">
					<option class="boxes_text_style" value="">Izaberite vrstu slova</option>
					<option class="boxes_text_style" value="Arial">Arial</option>
					<option class="boxes_text_style" value="Curier">Curier</option>
					<option class="boxes_text_style" value="Georgia">Georgia</option>
					<option class="boxes_text_style" value="Serif">Serif</option>
					<option class="boxes_text_style" value="Verdana">Verdana</option>
					<option value="Times New Roman">Times New Roman</option>
					<option value="Calibri">Calibri</option>
				</select>
				<input type="text" style="visibility:hidden" id="<?php echo $weight_style_db_column_second; ?>" name="<?php echo $weight_style_db_column_second; ?>" value="<?php echo $weight_style_db_column_second; ?>" />
			</td>
		</tr>

			<button type='button' class='font-style-close close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<tr>
			<td><p class="btn btn-lg btn-default apply_font_in_this_page">Primeni na ovu stranicu</p></td><br>
			<td><p class="btn btn-lg btn-default apply_font_in_all_pages">Primeni na sve stranice</p></td><br>
			<td><input type="submit" id="<?php echo $weight_style_submit; ?>" class="btn btn-lg btn-this-field" name="<?php echo $weight_style_submit; ?>" value="Primeni na ovo polje" />
			</td>
		</tr>
		<br>
		</table>
		</div>
	</form>
	</div>
<?php } ?>


<!-- =========================================================== 
	FUNCTION FOR DEFINE FONT AND DIV BACKGROUND COLOR 
================================================================ -->
<?php function background_and_font_color($table_name, $color_div_name,$color_form_id, $color_action, $color_submit, $color_column_name, $color_input_value){ ?>
	<div id="<?php echo $color_div_name; ?>" class="popup_msg change_color">
		<div>
			<table class="table well">
			<tr><td class="boxes_text_style">Izaberite boju: </td></tr>
			<button type='button' class='close-color-picker close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<tr>
				<td> 
					<form method="POST" id="<?php echo $color_form_id; ?>" action="<?php echo $color_action; ?>">
						<div style="height:10px;">
							<input style="visibility:hidden;" type="text" id="<?php echo $color_column_name; ?>" name="<?php echo $color_column_name; ?>" value="<?php echo $color_column_name; ?>" class="btn btn-success" />
						</div>
						<input type="text" id="<?php echo $color_input_value; ?>" class="form-control demo demo_forceformat" name="<?php echo $color_input_value; ?>" data-horizontal="true" />

					  <div class="submit_color_picker_buttons">
						<input type="submit" class="btn btn-default boxes_choose_color" id="<?php echo $color_submit; ?>" value="Potvrdi" />
						<div class="buttons_for_color_picker">
							<p class="btn btn-default apply_in_this_page">Primeni na ovu stranicu</p>
							<p class="btn btn-default apply_in_all_pages">Primeni na sve stranice</p>
					  	</div>
					  </div>
					</form>
				</td>
			</tr>
			</table>
		</div>
	</div>
<?php } ?>


<!-- =================================================================
	FUNCTION for define SHOW/HIDE images or some part of the page 
====================================================================== -->
<?php 
	function show_or_hide_part($show_div_name, $show_form_id, $show_action, $show_radio_name, $show_db_column, $show_form_submit){
?>
	<div id="<?php echo $show_div_name; ?>" class="popup_msg">
	<div>
		<table class="table well">
		<tr><td class="boxes_text_style">Opcije za prikazivanje</td></tr>
		<button type='button' class='close-show-hide close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<tr>
			<td> 
				<form id="<?php echo $show_form_id; ?>" method="POST" action="<?php echo $show_action; ?>">
					<div class="radio">
						<label><input type="radio" id="lft_img_show" name="<?php echo $show_radio_name; ?>" value="1" /> Prikaži</label>
					</div>
					<div class="radio">
						<label><input type="radio" id="l" name="<?php echo $show_radio_name; ?>" value="0" /> Sakrij</label>
					</div>
					<div class="radio" style="visibility:hidden;  height:2px;">
						<label><input type="text" id="<?php echo $show_db_column; ?>" name="<?php echo $show_db_column; ?>" value="<?php echo $show_db_column; ?>" /> Text</label>
					</div>
					<div class="radio">
						<label><input type="submit" class="btn btn-default boxes_choose_color btn_show_hide" id="<?php echo $show_form_submit; ?>" name="<?php echo $show_form_submit; ?>" value="Potvrdi promene" /> 
					</div>
				</form>
			</td>
		</tr>
		</table>
	</div>
	</div>

<?php
	}
?>
