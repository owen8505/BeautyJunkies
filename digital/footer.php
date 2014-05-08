    	</div><!-- / #main -->
 
	</div><!-- / #inner-wrap -->
</div><!-- / #wrapper -->


<script type="text/javascript">
jQuery(window).load(function($) {

 	jQuery("#main-menu").flexNav();     

 	<?php if (is_home() && option::get('featured_posts_show') == 'on') { ?>
 	jQuery("#slider").flexslider({
 		controlNav: false,
		directionNav:true,
		animationLoop: true,
   		animation: "<?php if (option::get('slideshow_effect') == 'Slide') { ?>slide<?php } else { ?>fade<?php } ?>",
		useCSS: true,
		smoothHeight: true,
		slideshow: <?php if (option::get('slideshow_auto') == 'on') { echo "true"; } else { echo "false"; } ?>,
		<?php if (option::get('slideshow_auto') == 'on') { ?>slideshowSpeed:<?php echo option::get('slideshow_speed'); ?>,<?php } ?>
		pauseOnAction: true,
		touch: true,
		animationSpeed: 600
 	});	
	<?php } ?>
	
	<?php wp_reset_query(); if (is_singular('portfolio')) { ?>
 	jQuery("#portfolio-slider").flexslider({
 		controlNav: false,
		directionNav:true,
		animationLoop: true,
		slideshow: false,
  		animation: "slide",
		useCSS: false,
		smoothHeight: true,
		slideshow: false,
		touch: true,
 		animationSpeed: 300
 	});	
	<?php } ?>

	jQuery('input, textarea').placeholder();
 
});

var wpz_isHome = <?php echo is_home() ? 'true' : 'false'; ?>;

</script>
<script type="text/javascript" src="wp-content/themes/digital/js/animaciones-menu.js"></script>
 
<?php wp_footer(); ?>
</body>
</html>