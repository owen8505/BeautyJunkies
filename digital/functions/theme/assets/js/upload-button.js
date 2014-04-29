jQuery(function(jQuery) {

	jQuery(document).on('DOMNodeInserted', '#TB_iframeContent', function(){
		var postID = jQuery('#post #post_ID').val();
		jQuery(this).attr('src', 'media-upload.php?type=image&post_id=' + postID + '&wpz_slides=true');
	});

	jQuery('.wpzoom_slide_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.wpzoom_slide_upload_image');
		preview = jQuery(this).siblings('.wpzoom_slide_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			html = jQuery(html);
			if(html.get(0).tagName.toLowerCase() != 'img') html = html.find('img');
			imgurl = html.attr('src');
			classes = html.attr('class');
			if(typeof classes !== 'undefined' && classes.match(/(.*?)wp-image-/)) {
 				id = classes.replace(/(.*?)wp-image-/, '');
			} else {
				id = imgurl;
			}
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});

	jQuery('.wpzoom_slide_clear_image_button').click(function() {
		var defaultImage = jQuery(this).parent().siblings('.wpzoom_slide_default_image').text();
		jQuery(this).parent().siblings('.wpzoom_slide_upload_image').val('');
		jQuery(this).parent().siblings('.wpzoom_slide_preview_image').attr('src', defaultImage);
		return false;
	});

	jQuery('.wpzoom_slide_add').click(function() {
		field = jQuery(this).closest('div.inside').find('.wpzoom_slider li:last').clone(true);
		fieldLocation = jQuery(this).closest('div.inside').find('.wpzoom_slider li:last');
		function incrementNew(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		}
		field.attr('class', incrementNew);
		jQuery('input:not(:button)', field).val('').attr('name', incrementNew);
		var defaultImage = field.find('.wpzoom_slide_default_image').text();
		field.find('.wpzoom_slide_upload_image').val('');
		field.find('.wpzoom_slide_preview_image').attr('src', defaultImage);
		field.insertAfter(fieldLocation, jQuery(this).closest('div.inside'));
		if(jQuery('.wpzoom_slider li').length > 1) jQuery('.wpzoom_slider').removeClass('onlyone');
		return false;
	});

	jQuery('.wpzoom_slide_remove').click(function(){
		jQuery(this).parent().remove();
		if(jQuery('.wpzoom_slider li').length <= 1) jQuery('.wpzoom_slider').addClass('onlyone');
		return false;
	});

	jQuery('.wpzoom_slider').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});

});