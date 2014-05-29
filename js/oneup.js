(function($) {
$.fn.oneUp = function(options, callback){
	if($.isFunction(options)){
		callback = options;
		options = null;
	}
	settings = jQuery.extend({
		distance: 20,
		speed: "slow",
		callback: callback
	}, options);

	return this.each(function(){
		$(this).show().animate({ 
				top:"-=" + settings.distance + "px", 
				opacity:"toggle" 
			}, settings.speed, function(){
				$(this).css({top: ""}).hide( settings.callback );
			});
		});
};

})(jQuery);