jQuery(document).ready(function($) {


/*=====================================
	Search Results 
=======================================*/
	$('.search_company_input').keyup(function(){
     var search = $('.search_company_input').val(); 
     //alert(search);
		$.ajax({
			url:'admin/search.php',
			data:{search: search},
			type: 'POST',
			success:function(data){
				if(!data.error) {
					$('.index-searching-result-company').html(data);
				}
			}
		});
    });		


/*=====================================
	Add Class "active" in Current Page
=======================================*/
	function add_class_active(){
		var url      	= window.location.pathname; 
		var cleanerUrl 	= url.split("/");
		var urlWithPhp 	= cleanerUrl[cleanerUrl.length-1];
			//alert(urlWithPhp);
		$('.nav li a').each(function() {
			var href 		= $(this).attr('href');
			var cleanHref	= href.split("?");
			var hrefWithPhp = cleanHref[cleanHref.length-2];
			if( urlWithPhp == ''){
				hrefWithPhp = 'index.php';
				href = 'index.php';
				urlWithPhp = 'index.php';
				$(this).addClass('active');
			}
			if( urlWithPhp == hrefWithPhp || urlWithPhp == href ){
				$(this).addClass('active');
			}
		});
	}

		add_class_active();



/*=====================================
	jQuery Form Validator
=======================================*/
// Check out Password Overlapping
	$('#pass').bind('click blur', function(){
		var pass1 = $('#pass_confirmation');
		var pass2 = $('#pass');
		var message = $('#confirmMessage');
		var goodColor = '#66cc66';
		var badColor  = '#ff6666';

		if( pass1.val() == pass2.val() && pass1.val().length > 6 && pass2.val().length > 6 ){
			pass2.css( 'border-color', goodColor );
			message.html( 'Šifre se podudaraju. Možete izvršiti registraciju.' ).css('color', goodColor).css('font-weight', 'bold');
			$('#register-sub').prop('disabled', false);			
		}
			else if ( pass2.val().length <= 6 ){
				alert('Šifra mora sadržati najmanje 7 karaktera.');
				$('#register-sub').prop('disabled', true);
			}

			else if( pass1.val() != pass2.val() ) {
				pass2.css( 'border-color', badColor );
				message.html( 'Unete šifre se ne podudaraju.' ).css('color', badColor).css('font-weight', 'bold');
				$('#register-sub').prop('disabled', true);
			}

	});



/*========================================
	Check out if Company Name or Username
	already exists into Database
==========================================*/
// Function for Checking Info from Database	
	function protect_register_form( $name, $disableBtn, $url, $loadedInfo, $registerContainer ){
		$($name).on('blur', function(e){
			e.preventDefault();
			var name = $($name).val();
			var disableBtn = $($disableBtn);
			if( $name == '#register-form-company-name' ){
				var divName = 'companyName';
				var messageInfoGood = 'Naziv je odobren.';
				var messageInfoBad  = 'Naziv koji Ste uneli postoji u bazi podataka. Molimo Vas da unesete nov naziv ili da postojećem nazivu dodate tip delatnosti. Npr. "doo, ad.".';
			}
			else if ( $name == '#register-form-company-username' ){
				var divName = 'companyUsername';
				var messageInfoGood = 'Korisničko ime je odobreno.';
				var messageInfoBad  = 'Korisničko ime koje Ste izabrali postoji u bazi podataka. Molimo Vas da izaberete drugo korisničko ime.';
			}

			//alert($url);

			$.ajax({
				type:'POST',
				url: $url,
				data:{ name:name, divName:divName },
				success: function(data){
					if(!data.error){
						var loadedInfo = $($loadedInfo).html(data).text();
						var empty = loadedInfo.indexOf('empty');
						var fill  = loadedInfo.indexOf('fill');
						$($registerContainer).hide();
						
						if ( empty != -1 && $($name).val().length > 1 ){
							$($loadedInfo).append(messageInfoGood).css('color','#66cc66').css('font-weight','bold');
							$($name).css('border-color','green').css('color','#000000').css('font-weight','bold');
						}
						else if ( fill != -1 ){
							$($loadedInfo).append(messageInfoBad).css('color','red').css('font-weight','bold');
							$($name).css('border-color','red').css('color','#000000').css('font-weight','bold');
							$(disableBtn).prop('disabled', true);
						}
					}
				},
				error: function(data){
					console.log('Greška prilikom slanja zahteva...');
				}		
			});
			
		});
	}


// Checking Company Name "Naziv Preduzeća"
	protect_register_form('#register-form-company-name', '#register-sub', 'register-form-file-ajax.php', '#coutionName', '.register-container');

// Checking Username "Izaberite Vaš username"
	protect_register_form('#register-form-company-username', '#register-sub', 'register-form-file-ajax.php', '#coutionUsername', '.register-container-username' );
		


/*========================================
	Pagination for Home Pages
==========================================*/
	function specific_pagination_home(container, onclickClass, divData, address, galleryLoader){
		$(container).on('click', onclickClass, function(e){
			e.preventDefault();
			var userId  = $(divData).data('userid');
			var page 	= $(this).attr('rel');
				$(container).load(address + userId + '&page=' + page + galleryLoader);
		});
	}

  // Gallery Page Pagination
	specific_pagination_home('#gallery_container', '.pagination li a', '.pagination', 'company-gallery.php?user_id=', ' #gallery_loader');



/*========================================
	Pagination for Comments
==========================================*/
	function specific_pagination_extra(galleryContainer, onclickClass, userData, articleData, address, galleryLoader){
		$(galleryContainer).on('click', onclickClass, function(e){
			e.preventDefault();

			var userId  	= $(userData).data('userid');
			var articleId 	= $(articleData).data('articleid');
			var page 		= $(this).attr('rel');
				$(galleryContainer).load(address + userId + '&article_id=' + articleId + '&page=' + page + galleryLoader);
		});
	}

  // Preview Page Comments
  	specific_pagination_extra('#comments_div', ' .pagination a', '.pagination', '.pagination', 'company-preview.php?user_id=', ' .comments-container' );



/*====================================
	Form for insert comment and marks
	from clients and customers...
======================================*/	
	function insert_marks_and_comment(form_name){
		$(form_name).submit(function(evt){
			evt.preventDefault();
			var clientIp = $('.check-client-ip').attr('attr');
			//alert(clientIp);
			
				var commentContent = tinyMCE.get('comment_article').getContent();
				//alert(commentContent);
				var postData = $(this).serialize() + commentContent;
				var url = $(this).attr('action');
				$.post(url, postData, function(php_table_data){
					$(form_name)[0].reset();
					alert('Hvala za komentar.');
					location.reload();
					console.log(postData);
				});
			
		});	
	}

		insert_marks_and_comment('#preview_marks_comment_form1');


/*=====================================
	Toggle Div - Show or Hide Message
	Form
=======================================*/
function toggle_divs(div_name, click_button){
	$(div_name).hide();
	$(click_button).click(function(){
		$(div_name).slideToggle();
	});
}	
	toggle_divs('#contact_form_container', '#contact_us');
	toggle_divs('.advance-searching', '.advance-search-button');
	toggle_divs('.new-searching', '.advance-search-button-second');


/*=====================================
	OWL Change Background Images
=======================================*/
	function owlCarousel(){
		$("#owl-demo").owlCarousel({
		    autoPlay: 7000,
		    navigation : false,
		    paginationSpeed : 2000,
		    singleItem : true,
		    mouseDrag: false,
		    responsiveRefreshRate: true
	  	});
	}
		owlCarousel();
});