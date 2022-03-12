/* load.js
  - Loading order
--------------------------------------------------------- */
jQuery.noConflict();
jQuery.ajaxSetup({scriptCharset:'utf-8'});

// domready
jQuery(document).ready(function() {
	////////// parts
	if (bindobj.printstate) Bindprint.control();
	else Bindprint.set();
	
	////////// blockeditor
	if (bindobj.isLocal && !bindobj.ie52) BindApp.onload();
	
	////////// fx
	if (!bindobj.printstate) initFx();
	
});

// onload
jQuery(function(){
	////////// for legacy browser
	legacyCheck();
	
	////////// set footer
	Bindfooter.set();

});
