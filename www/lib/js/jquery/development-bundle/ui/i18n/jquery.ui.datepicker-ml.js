/* Malayalam (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Saji Nediyanchath (saji89@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ml'] = {
		closeText: 'à´¶à´°à´¿',
		prevText: 'à´®àµà´¨àµà´¨à´¤àµà´¤àµ',  
		nextText: 'à´à´àµà´¤àµà´¤à´¤àµ ',
		currentText: 'à´à´¨àµà´¨àµ',
		monthNames: ['à´à´¨àµà´µà´°à´¿','à´«àµà´¬àµà´°àµà´µà´°à´¿','à´®à´¾à´°àµâà´àµà´àµ','à´à´ªàµà´°à´¿à´²àµâ','à´®àµà´¯àµ','à´àµà´£àµâ',
		'à´àµà´²àµ','à´à´à´¸àµà´±àµà´±àµ','à´¸àµà´ªàµà´±àµà´±à´à´¬à´°àµâ','à´à´àµà´àµà´¬à´°àµâ','à´¨à´µà´à´¬à´°àµâ','à´¡à´¿à´¸à´à´¬à´°àµâ'],
		monthNamesShort: ['à´à´¨àµ', 'à´«àµà´¬àµ', 'à´®à´¾à´°àµâ', 'à´à´ªàµà´°à´¿', 'à´®àµà´¯àµ', 'à´àµà´£àµâ',
		'à´àµà´²à´¾', 'à´à´', 'à´¸àµà´ªàµ', 'à´à´àµà´àµ', 'à´¨à´µà´', 'à´¡à´¿à´¸'],
		dayNames: ['à´à´¾à´¯à´°àµâ', 'à´¤à´¿à´àµà´à´³àµâ', 'à´àµà´µàµà´µ', 'à´¬àµà´§à´¨àµâ', 'à´µàµà´¯à´¾à´´à´', 'à´µàµà´³àµà´³à´¿', 'à´¶à´¨à´¿'],
		dayNamesShort: ['à´à´¾à´¯', 'à´¤à´¿à´àµà´', 'à´àµà´µàµà´µ', 'à´¬àµà´§', 'à´µàµà´¯à´¾à´´à´', 'à´µàµà´³àµà´³à´¿', 'à´¶à´¨à´¿'],
		dayNamesMin: ['à´à´¾','à´¤à´¿','à´àµ','à´¬àµ','à´µàµà´¯à´¾','à´µàµ','à´¶'],
		weekHeader: 'à´',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ml']);
});
