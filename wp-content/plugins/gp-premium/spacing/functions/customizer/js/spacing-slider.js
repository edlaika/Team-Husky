jQuery(window).load(function(){
	jQuery( '.customize-control-gp-spacing-slider .slider-input' ).change(function () {
		var value = this.value;
		jQuery( this ).closest( 'label' ).next( 'div.slider' ).slider( 'value', parseFloat(value));
	});
	
	jQuery( '.gp-spacing-slider-default-value' ).on( 'click', function(e) {
		e.preventDefault();
		var default_value = jQuery( this ).data( 'default-value' );
		jQuery( this ).prevAll( 'label' ).find( 'input' ).attr( 'value', default_value ).trigger( 'change' );
		jQuery( this ).prevAll( 'label' ).find( '.no-edit-value' ).text( default_value );
	});
	
	function generate_spacing_range_slider( name, min, max, step ) {
		setTimeout(function() {
			jQuery('input[name="' + name + '"]').closest( 'label' ).next('div.slider').slider({
				value: jQuery('input[name="' + name + '"]').val(),
				min: min,
				max: max,
				step: step,
				slide: function( event, ui ) {
					jQuery('input[name="' + name + '"]').val( ui.value ).change();
					jQuery('#customize-control-' + name + ' .value input').val( ui.value );
					jQuery('input[name="' + name + '"]').nextAll( '.no-edit-field' ).children( '.no-edit-value' ).text( ui.value );
				},
				stop: function( event, ui ) {
					jQuery('body').trigger('generate_slider_stopped');
				}
			});
		});
	}
	
	generate_spacing_range_slider( 'generate_spacing_settings[separator]', 0, 100, 1 );
	generate_spacing_range_slider( 'generate_spacing_settings[menu_item]', 0, 100, 1 );
	generate_spacing_range_slider( 'generate_spacing_settings[menu_item_height]', 20, 150, 1 );
	generate_spacing_range_slider( 'generate_spacing_settings[sub_menu_item_height]', 0, 50, 1 );
	generate_spacing_range_slider( 'generate_secondary_nav_settings[secondary_menu_item]', 0, 100, 1 );
	generate_spacing_range_slider( 'generate_secondary_nav_settings[secondary_menu_item_height]', 20, 150, 1 );
	generate_spacing_range_slider( 'generate_secondary_nav_settings[secondary_sub_menu_item_height]', 0, 50, 1 );
	generate_spacing_range_slider( 'generate_spacing_settings[left_sidebar_width]', 15, 50, 5 );
	generate_spacing_range_slider( 'generate_spacing_settings[right_sidebar_width]', 15, 50, 5 );
});