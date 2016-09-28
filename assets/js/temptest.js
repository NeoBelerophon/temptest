	$(function() {
		$( "#temperatures, #selectedtemperatures" ).sortable({
			connectWith: "ul"
		});
		$( "#temperatures, #selectedtemperatures").disableSelection();
	});
	
	$(function () {
		$(".gen-temptest").on('click', gen_temptest);
	});
	
	
	 $(function() {
		$( "#dialog-no-selected" ).dialog({
			autoOpen: false,
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"OK": function() {
					$( this ).dialog( "close" );
				},
			}
		});
	});
	

	
	function do_temptest(){
/*		openWait('Bed scan in process');
		var now = jQuery.now();
		ticker_url = '/temp/bed_scan_' + now + '.trace';
		$.ajax({
			type: "POST",
			url : "../application/plugins/bedscan/ajax/bed_scan.php",
			data : {time: now},
			dataType: "html"
		}).done(function( data ) {
			closeWait();
			ticker_url = '';
			if($(".step-1").is(":visible") ){
				$(".step-1").slideUp('fast', function(){
					$(".step-2").slideDown('fast');
				});
			}
			$(".todo").html(data);
		}); */
	}	 
	
	
	function gen_temptest()
	{
		var temperatures = $('#selectedtemperatures li');
		if(temperatures.length == 0)
		{
			$( "#dialog-no-selected" ).dialog( "open" );
			return;
		} 
		openWait('Temperature Test G-Code generation in process');
		
		var temps = [];
		temperatures.each(function(){
			var temptext = $(this).text().substring(0,3)
			temps.push(temptext);
		});
		temps.reverse();
		
		var data = { 
			'bedtemp': $('#bedtemperature').val(), 
			'bedtemp1': $('#bedtemperature1').val(),
			'temp1': $('#printtemperature').val(),
			'testtemps': JSON.stringify(temps)
		};
		
		$.ajax({
			type: "POST",
			url : "../application/plugins/temptest/ajax/gen_testrod.php",
			data : data,
			dataType: "html"
		}).done(function( data ) {
			closeWait();
			if($(".step-1").is(":visible") ){
				$(".step-1").slideUp('fast', function(){
					$(".step-2").slideDown('fast');
				});
			}
			$(".todo").html(data);
		});
	
		
	}