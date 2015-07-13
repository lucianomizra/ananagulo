var VerticalSlider = {

	init: function(options) {

		var slider = options.element;
		var ul = options.element.find('ul');
		var btn_prev = options.btn_up;
		var btn_next = options.btn_down;
		var item_height = options.item_height;
		var cols = options.cols;
		var rows = options.rows;
		var total_rows = Math.round(ul.find('li').length / options.cols) - 1;
		var actual_row = 0;

		var item_width = 100 / cols;

		slider.css({'max-height':item_height * rows});
		ul.find('li').css({'width':item_width+'%','height':item_height});

		var max_lines = slider.height() / item_height;


		btn_next.on('click',function() {

			if( actual_row <= total_rows ) {
				actual_row++;
				
				slider.animate({
			        scrollTop: item_height * actual_row
			    }, 300);
				
			}
		});

		btn_prev.on('click',function() {

			if( actual_row >= 0 ) {
				actual_row--;

				slider.animate({
			        scrollTop: item_height * actual_row
			    }, 300);
				
			}
		});
	}

}