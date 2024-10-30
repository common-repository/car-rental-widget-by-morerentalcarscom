jQuery(document).ready(function(){	
	console.log('W');
	jQuery('iframe').load(function(){
		console.log('X');
		//jQuery('mrc_iframe .ui-datepicker').css('top', '0px');
		console.log('Y');
	});
});