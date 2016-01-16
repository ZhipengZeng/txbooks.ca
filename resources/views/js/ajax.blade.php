<!-- views/js/ajax.blade.php -->
<!-- for ajax operation -->
<script type="text/javascript">
	$(document).ready(function() {

		$( "#submit" ).prop( "disabled", true );
		$( "#program" ).prop( "disabled", true );
		$( "#course" ).prop( "disabled", true );

		ajax_schools();
		ajax_programs();
		ajax_courses();

		$('#reset').click(function () { 
            reset();
        }); 

        $('#course').change(function () { 
            $( "#submit" ).prop( "disabled", $("select[name ='course'] option:selected").index() === 0 );
        });

        

        var book_school_id = 0;
        var book_program_id = 0;
        var book_course_id = 0;


	});
	function ajax_schools(){
		getSchools(); // get schools when is document ready
	}
	function ajax_programs(){
		$("#school").change(function(){
			getPrograms();
			$( "#submit" ).prop( "disabled", $("select[name ='course'] option:selected").index() === 0 || $("select[name ='course'] option:selected").index() === -1 );
		});
	}
	function ajax_courses(){
		$("#program").change(function(){
			getCourses();
			$( "#submit" ).prop( "disabled", $("select[name ='course'] option:selected").index() === 0 || $("select[name ='course'] option:selected").index() === -1 );
		});
	}
	function getSchools(){
		$.ajax({
			url: "{{ URL::route('ajaxGetSchools') }}",
		    type: 'POST',
		    data: {
		    	'_token': $('input[name=_token]').val()
		    },
		    success: function(data){
		    	var option = '<option value="intro">=== Please Select School Here ===</option>';
		    	$("#school").append(option);
		    	$.each(data,function(index,array){
					option = "<option value='" + array['id'] + "'>" + array['school_name'] + "</option>";
					$("#school").append(option);
				});
		    }
		});
	}
	function getPrograms(){
		$( "#program" ).prop( "disabled", false );

		var school_id=$("#school option:selected").val();

		$('#program').empty();
	
		$.ajax({
			url: "{{ URL::route('ajaxGetPrograms') }}",
		    type: 'POST',
		    data: {
		    	school_id : school_id,
		    	'_token': $('input[name=_token]').val()
		    },
		    success: function(data){
		    	var option = '<option value="intro">=== Please Select Program Here ===</option>';
		    	$("#program").append(option);
		    	$.each(data,function(index,array){
					option = "<option value='" + array['id'] + "'>" + array['program_name'] + "</option>";
					$("#program").append(option);
				});
		    }
		});
	}
	function getCourses(){
		$( "#course" ).prop( "disabled", false );

		var program_id = $("#program option:selected").val();

		$('#course').empty();
		$.ajax({
			url: "{{ URL::route('ajaxGetCourses') }}",
		    type: 'POST',
		    data: {
		    	program_id : program_id,
		    	'_token': $('input[name=_token]').val()
		    },
		    success: function(data){
		    	var option = '<option value="intro">=== Please Select Course Here ===</option>';
		    	$("#course").append(option);
		    	$.each(data,function(index,array){
					option = "<option value='" + array['id'] + "'>" + array['course_name'] + " --- " + array['course_code'] + "</option>";
					$("#course").append(option);
				});
		    }
		});
	}

	function reset(){
		$('#program').empty();
		$( "#program" ).prop( "disabled", true );
		
		$('#course').empty();
		$( "#course" ).prop( "disabled", true );

		$( "#submit" ).prop( "disabled", true );
	}

</script>