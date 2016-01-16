$(document).ready(function() {

	$( "#program" ).prop( "disabled", true );
	// $( "#course" ).prop( "disabled", true );

	ajax_programs();
});
function ajax_programs(){
	$("#school").change(function(){
		getPrograms();
	});
}
function getPrograms(){

	for(var i = document.post.program.options.length-1; i>0; i--){
		document.post.program.remove(i);
	}

	var school_id = $("#school option:selected").val();
	$.ajax({
		url: "<?php echo URL::route('ajaxGetPrograms') ?>",
	    type: 'POST',
	    data: {
	    	school_id : school_id,
	    	'_token': $('input[name=_token]').val()
	    },
	    success: function(programs){
	    	var option = '';
			for (var i = 0; i < programs.length; i++){
				alert("dd");
			   // option += '<option value="'+ programs[i]['id'] + '">' + programs[i]['program_name'] + '</option>';

			}
			// $('#program').append(option);
	    }
	});
}