/**
 * https://github.com/berumen/tShift
 * Created by JAlfredo Berumen Saldivar.
 * User: berumen
 * Date: 12/04/12
 * @berumen
 * http://alfredberumen.com
 * Licensed under the MIT license 
 */
(function($) {
	$.fn.tshift = function() 
	{
		var start = 0;
		var checkboxes = $("#"+ this.attr('id') +" :checkbox");
	    checkboxes.on("click", function(event)
		{
			if(this.checked)
			{
				if(event.shiftKey)
				{
  	 				end = checkboxes.index(this);
  	 				if(end < start)
  	 				{
 						end   = start;
 						start = checkboxes.index(this);
  	 				}
					checkboxes.each(function(index) {
						if (index >= start && index < end)
						{
							this.checked = true;
						}
					});
				}
				start = checkboxes.index(this);
			}else{
                            if(event.shiftKey)
				{
  	 				end = checkboxes.index(this);
  	 				if(end < start)
  	 				{
 						end   = start;
 						start = checkboxes.index(this);
  	 				}
					checkboxes.each(function(index) {
						if (index >= start && index < end)
						{
							this.checked = false;
						}
					});
				}
				start = checkboxes.index(this);
                        }
		});
		return this;
	};
})(jQuery);