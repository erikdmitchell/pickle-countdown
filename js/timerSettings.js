jQuery(document).ready(function($) {
	
	$("#pickle-countdown .timer").countdown(pcTimerOptions.date, function(event) {
		$(this).html(event.strftime(pcTimerOptions.format));
	});	
	
});