
jQuery(document).ready(function($){  
	var form_count = 1, previous_form, next_form, total_forms;
	total_forms = $("fieldset").length;  
	$(".next-form").click(function(){
		previous_form = $(this).parent();
		next_form = $(this).parent().next();
		next_form.show();
		previous_form.hide();
		//setProgressBarValue(++form_count);
	});  
	// $(".previous-form").click(function(){
	// 	previous_form = $(this).parent();
	// 	next_form = $(this).parent().prev();
	// 	next_form.show();
	// 	previous_form.hide();
	// 	setProgressBarValue(--form_count);
	// });
	// setProgressBarValue(form_count);  
	// function setProgressBarValue(value){
	// 	var percent = parseFloat(100 / total_forms) * value;
	// 	percent = percent.toFixed();
	// 	$(".progress-bar")
	// 	.css("width",percent+"%")
	// 	.html(percent+"%");   
	// } 
});

jQuery(document).ready(function($){
	$( ".yes-no.next1 label" ).click(function() {
		// alert('next1');
		$( ".next-form.next1" ).trigger( "click" );
	});
	$( ".yes-no.next2 label" ).click(function() {
		// alert('next2');
		$( ".next-form.next2" ).trigger( "click" );
	});
	$( ".yes-no.next3 label" ).click(function() {
		// alert('next3');
		$( ".next-form.next3" ).trigger( "click" );
	});
	$( ".yes-no.next4 input" ).click(function() {
		//alert('next4');
		$( ".submit.next4" ).trigger( "click" );
	});
});

jQuery(document).ready( function($) {
	$(".submit.next4").click(function(event){
		//event.preventDefault();
		var data = {
			action : 'display_response',
            q1 : $("input[name=yes_no_q1]:checked").val(),
            q2 : $("input[name=yes_no_q2]:checked").val(),
            q3 : $("input[name=yes_no_q3]:checked").val(),
            q4 : $("input[name=yes_no_q4]:checked").val()
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	jQuery.post(the_ajax_script.ajaxurl, data, function(response) {
	 		//console.log(data);
	 		jQuery('#survey_form').hide();
			jQuery('#result').html(response);
	 	});
	 	return false;
	});
});
// jQuery(document).ready(function($){
//     $("#survey_form").on("submit", function(event){
//         event.preventDefault();
 
//         var formValues= $(this).serialize();
 		


//         $.post("process_form.php", formValues, function(data){
//             // Display the returned data in browser
//             $("#result").html(data);
//         });
//     });
// });