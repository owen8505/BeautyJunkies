<?php 
/*-----------------------------------------------------------------------------------*/
/* Initializing Widgetized Areas (Sidebars)																			 */
/*-----------------------------------------------------------------------------------*/


/*----------------------------------*/
/* Sidebar							*/
/*----------------------------------*/
 
 register_sidebar(array(
	'name'=>'Sidebar',
	'id' => 'sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h3 class="title">',
	'after_title' => '</h3>',
));

?>