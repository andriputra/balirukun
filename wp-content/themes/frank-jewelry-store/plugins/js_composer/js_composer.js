/* global jQuery:false */
/* global FRANK_JEWELRY_STORE_STORAGE:false */

jQuery(document).on('action.ready', frank_jewelry_store_js_composer_init);
jQuery(document).on('action.init_shortcodes', frank_jewelry_store_js_composer_init);
jQuery(document).on('action.init_hidden_elements', frank_jewelry_store_js_composer_init);

function frank_jewelry_store_js_composer_init(e, container) {
	"use strict";
	if (arguments.length < 2) var container = jQuery('body');
	if (container===undefined || container.length === undefined || container.length == 0) return;

	container.find('.vc_message_box_closeable:not(.inited)').addClass('inited').on('click', function(e) {
		"use strict";
		jQuery(this).fadeOut();
		e.preventDefault();
		return false;
	});
}