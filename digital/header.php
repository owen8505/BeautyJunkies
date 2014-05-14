<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
    <title><?php ui::title(); ?></title>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
 
	<?php wp_head(); ?>
    <?php if (is_home() && option::get('featured_posts_show') == 'on' || get_post_type() == 'portfolio') { ui::js("slides"); } ?>

</head>

<body <?php body_class() ?>>

<div id="wrapper">
    <div id="inner-wrap">

		<div id="custom-heading">
			<div class="custom-header">
				<a href="<?php echo home_url(); ?>"><div class="custom-logo"></div></a>
				<div class="custom-titulo"></div>
			</div>
			<a class="btn_menu" id="toggle-top" href="#"></a>

			<div class="buscador"> <input type="text" placeholder="Search here..." /> </div>
			
			<div class="redes-sociales">
				<div class="boton-red-social"><a href="http://www.pinterest.com/hildelisab/"><img src="wp-content/themes/digital/images/logos/icon-pinterest.png"></a></div>
				<div class="boton-red-social"><a href="https://www.facebook.com/pages/Beautyjunkiesmx/215358368602874"><img src="wp-content/themes/digital/images/logos/icon-facebook.png"></a></div>
				<div class="boton-red-social"><a href="http://instagram.com/hildelisab"><img src="wp-content/themes/digital/images/logos/icon-instagram.png"></a></div>
				<div class="boton-red-social"><a href="https://twitter.com/BeautyJunkiesMX"><img src="wp-content/themes/digital/images/logos/icon-twitter.png"></a></div>
			</div>
		</div><!-- / #custom-heading -->

        <div id="header">
		 
			<!--div id="logo">
				<?php if (!option::get('misc_logo_path')) { echo "<h1>"; } ?>
				
				<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
					<?php if (!option::get('misc_logo_path')) { bloginfo('name'); } else { ?>
						<img src="<?php echo ui::logo(); ?>" alt="<?php bloginfo('name'); ?>" />
					<?php } ?>
				</a>
				
				<?php if (!option::get('misc_logo_path')) { echo "</h1>"; } ?>

				<?php if (option::get('logo_desc') == 'on') {  ?><p id="tagline"><?php bloginfo('description'); ?></p><?php } ?>
			</div--><!-- / #logo -->
			
            
            <!--div id="menu">
				
            </div-->

			<div id="menu" class="desktop-menu">
				<?php //dynamic_sidebar('Sidebar'); ?>
				<?php if (has_nav_menu( 'primary' )) {  

					wp_nav_menu( array( 
						'container_class' => 'menu-header', 
						'theme_location' => 'primary',
						'container' => '', 
						'menu_class' => 'dropdown', 
 						'menu_id' => 'main-menu', 
						'sort_column' => 'menu_order', 
						'walker' => new Page_Navigation_Walker,
						'theme_location' => 'primary' 

						) );
				} ?>
				<!--div class="lateral-menu-button">
				</div-->
				<div class="redes-sociales-mobile">
					<div class="boton-red-social"><a href="#"><img src="wp-content/themes/digital/images/logos/icon-pinterest.png"></a></div>
					<div class="boton-red-social"><a href="#"><img src="wp-content/themes/digital/images/logos/icon-facebook.png"></a></div>
					<div class="boton-red-social"><a href="#"><img src="wp-content/themes/digital/images/logos/icon-instagram.png"></a></div>
					<div class="boton-red-social"><a href="#"><img src="wp-content/themes/digital/images/logos/icon-twitter.png"></a></div>
				</div>
			</div>

             
            <div class="clear"></div>

            <div id="footer">
				<div class="copyright" >
					<!--p class="copy"><?php _e('Copyright', 'wpzoom'); ?> &copy; <?php echo date("Y",time()); ?> <?php bloginfo('name'); ?></p>
					<p class="wpzoom"><a href="http://www.wpzoom.com" target="_blank" title="Portfolio Themes"><?php _e('Designed by WPZOOM', 'wpzoom'); ?></a></p-->
					<p class="copy">Derechos Reservados <strong>+Starch</strong></p>

				</div>
			</div><!-- / #footer -->

             
        </div><!-- / #header-->
		
	   <div id="main">