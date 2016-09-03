<script type="text/javascript" src="number_separate_jquery.min.js"></script>
<script type="text/javascript" src="autoNumeric.js"></script>
<script type="text/javascript">
jQuery(function($) {
    $('.auto').autoNumeric('init');
});
</script>




    <form name="form" method="POST" action="">
         <input type="text" name="test" class="auto" data-a-sep="." data-a-dec=","  value="1212121212"/>
         <input type="submit" name="sub" value="Potvrdi" />
    </form>

   
<?php
	if(isset($_POST['test'])){
		$take_value = $_POST['test'];
		echo $clean_value = str_replace('.','',$take_value);
	}
?>