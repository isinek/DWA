jQuery(document).ready(function (){
	jQuery('#filterProizvoda').keyup(function (){
		var filter = jQuery('#filterProizvoda').val();
		var redci = jQuery('#tableProizvodi').children().last().children();
		redci.each(function (){
			var redak = jQuery(this);
			redak.addClass('hide');
			var stupci = redak.children();
			for(var i = 0; i < stupci.length; ++i) {
				if(filter.length == 0 || (jQuery(stupci[i]).text().length > 0 && jQuery(stupci[i]).text().indexOf(filter) > 0)) {
					redak.removeClass('hide');
					break;
				}
			}
		});
	});
});