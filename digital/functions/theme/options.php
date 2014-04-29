<?php return array(


/* Theme Admin Menu */
"menu" => array(
    array("id"    => "1",
          "name"  => "General"),
    
    array("id"    => "2",
          "name"  => "Homepage"),

      array("id"   => "5",
        "name" => "Styling"),
 
),

/* Theme Admin Options */
"id1" => array(
    array("type"  => "preheader",
          "name"  => "Theme Settings"),
         
	array("name"  => "Logo Image",
          "desc"  => "Upload a custom logo image for your site, or you can specify an image URL directly.",
          "id"    => "misc_logo_path",
          "std"   => "",
          "type"  => "upload"),

    array("name"  => "Display Site Tagline under Logo?",
          "desc"  => "Tagline can be changed in <a href='options-general.php' target='_blank'>General Settings</a>",
          "id"    => "logo_desc",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Favicon URL",
          "desc"  => "Upload a favicon image (16&times;16px).",
          "id"    => "misc_favicon",
          "std"   => "",
          "type"  => "upload"),
          
    array("name"  => "Custom Feed URL",
          "desc"  => "Example: <strong>http://feeds.feedburner.com/wpzoom</strong>",
          "id"    => "misc_feedburner",
          "std"   => "",
          "type"  => "text"),
  
	array("name"  => "Enable comments for static pages",
          "id"    => "comments_page",
          "std"   => "off",
          "type"  => "checkbox"),
  

 	array("type"  => "preheader",
          "name"  => "Portfolio Template"),
          
	array("name"  => "Number of works in Paginated Portfolio Template",
          "desc"  => "Default: <strong>12</strong>",
          "id"    => "paginated_posts",
          "std"   => "12",
          "type"  => "text"),
          
	array("name"  => "Display Categories on the Top ?",
          "id"    => "portfolio_tags",
          "std"   => "on",
          "type"  => "checkbox"),
          
          
 	array("type"  => "preheader",
          "name"  => "Global Posts Options"),
	
	array("name"  => "Content",
          "desc"  => "The number of posts displayed on homepage can be changed <a href=\"options-reading.php\" target=\"_blank\">here</a>.",
          "id"    => "display_content",
          "options" => array('Excerpt', 'Full Content'),
          "std"   => "Excerpt",
          "type"  => "select"),
     
    array("name"  => "Excerpt length",
          "desc"  => "Default: <strong>50</strong> (words)",
          "id"    => "excerpt_length",
          "std"   => "50",
          "type"  => "text"),
          
    array("name"  => "Display thumbnail",
          "id"    => "index_thumb",
          "std"   => "on",
          "type"  => "checkbox"),
          
    array("name"  => "Thumbnail Width (in pixels)",
          "desc"  => "Default: <strong>540</strong> (pixels)",
          "id"    => "thumb_width",
          "std"   => "740",
          "type"  => "text"),
          
    array("name"  => "Thumbnail Height (in pixels)",
          "desc"  => "Default: <strong>280</strong> (pixels)",
          "id"    => "thumb_height",
          "std"   => "300",
          "type"  => "text"),
          
    array("name"  => "Display Date/Time",
          "desc"  => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
          "id"    => "display_date",
          "std"   => "on",
          "type"  => "checkbox"),  
          
    array("name"  => "Display Category",
          "id"    => "display_category",
          "std"   => "on",
          "type"  => "checkbox"),    
          
    array("name"  => "Display Comments Count",
          "id"    => "display_comments",
          "std"   => "on",
          "type"  => "checkbox"), 
           
          
	array("type"  => "preheader",
          "name"  => "Single Post Options"),

    array("name"  => "Display thumbnail",
          "id"    => "post_thumb",
          "std"   => "on",
          "type"  => "checkbox"),


    array("type"  => "startsub",
          "name"  => "Display meta"),
      
     	array("name"  => "Date/Time",
              "desc"  => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
              "id"    => "post_date",
              "std"   => "on",
              "type"  => "checkbox"),  
              
        array("name"  => "Author Name",
              "desc"  => "You can edit your profile on this <a href='profile.php' target='_blank'>page</a>.",
              "id"    => "post_author",
              "std"   => "on",
              "type"  => "checkbox"),

    	array("name"  => "Category",
              "id"    => "post_category",
              "std"   => "on",
              "type"  => "checkbox"),
     	 
        array("type"  => "endsub"),

   
    array("name"  => "Tags",
          "id"    => "post_tags",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Comments",
          "id"    => "post_comments",
          "std"   => "on",
          "type"  => "checkbox"),
 
          
          
	array("type"  => "preheader",
          "name"  => "Translations"),
        
	array("name"  => "Client",
          "desc"  => "Default: <em>Client</em>",
          "id"    => "client",
          "std"   => "Client",
          "type"  => "text"),
          
	array("name"  => "Services",
          "desc"  => "Default: <em>Services</em>",
          "id"    => "services",
          "std"   => "Services",
          "type"  => "text"),

	array("name"  => "Skills",
          "desc"  => "Default: <em>Skills</em>",
          "id"    => "skills",
          "std"   => "Skills",
          "type"  => "text"),
          
 	array("name"  => "Previous project",
          "desc"  => "Default: <em>Previous project</em>",
          "id"    => "prev_project",
          "std"   => "Previous project",
          "type"  => "text"),
          
	array("name"  => "Next project",
          "desc"  => "Default: <em>Next project</em>",
          "id"    => "next_project",
          "std"   => "Next project",
          "type"  => "text"),

  array("name"  => "Similar Projects",
          "desc"  => "Default: <em>Similar Projects</em>",
          "id"    => "similar_projects",
          "std"   => "Similar Projects",
          "type"  => "text"),
),

"id2" => array(
    
    array("type"  => "preheader",
          "name"  => "Homepage Slider"),   
              
    array("name"  => "Display the slider on homepage?",
          "desc"  => "Do you want to show a featured slider on the homepage?",
          "id"    => "featured_posts_show",
          "std"   => "on",
          "type"  => "checkbox"),

		array("name"  => "Slider Title",
          "desc"  => "The title displayed above the slider.",
          "id"    => "slideshow_title",
          "std"   => "Featured Works",
          "type"  => "text"),

    array("name"  => "Autoplay Slider?",
          "desc"  => "Do you want to auto-scroll the slides?",
    	  "id"    => "slideshow_auto",
          "std"   => "on",
          "type"  => "checkbox"),
            
    array("name"  => "Slider Autoplay Interval",
          "desc"  => "Select the interval (in miliseconds) at which the Slider should change posts (<strong>if autoplay is enabled</strong>). Default: 3000 (3 seconds).",
          "id"    => "slideshow_speed",
          "std"   => "3000",
          "type"  => "text"),
            
    array("name"  => "Slider Effect",
          "desc"  => "Select the effect for slides transition.",
          "id"    => "slideshow_effect",
          "options" => array('Slide', 'Fade'),
          "std"   => "Slide",
          "type"  => "select"),
            
    array("name"  => "Number of Posts in Slider",
          "desc"  => "How many posts should appear in \"Featured Slider\" on the homepage? Default: 5.<br/><br/>To add posts in slider, go to <a href='edit.php?post_type=slideshow' target='_blank'>Slideshow section</a>",
          "id"    => "featured_posts_posts",
          "std"   => "5",
          "type"  => "text"),
          
    
    array("type"  => "preheader",
          "name"  => "Portfolio on Homepage"),
 
	array("name"  => "Show latest entries from Portfolio on Homepage?",
          "id"    => "portfolio",
          "std"   => "on",
          "type"  => "checkbox"),
            
    array("name"  => "Portfolio Title",
          "desc"  => "For example: <em>Portfolio</em>",
          "id"    => "portfolio_title",
          "std"   => "Portfolio",
          "type"  => "text"),
 
    array("name"  => "Number of items to show",
          "desc"  => "Default: <strong>6</strong>",
          "id"    => "portfolio_items",
          "std"   => "6",
          "type"  => "text"),
          
 	array("name" => "Portfolio Page",
    		 "desc"  => "Choose the page <em>All</em> link.",
    		 "id"    => "portfolio_url",
    		 "std"   => "",
    		 "type"  => "select-page"),


    array("type"  => "preheader",
          "name"  => "Recent Posts"),
 
	array("name"  => "Show latest blog entries on Homepage?",
          "id"    => "recent_posts",
          "std"   => "on",
          "type"  => "checkbox"),
            
    array("name"  => "Recent Posts Title",
          "desc"  => "For example: <em>Recent Posts</em>",
          "id"    => "recent_posts_title",
          "std"   => "Recent Posts",
          "type"  => "text"),
    
    array("name"  => "Number of items to show",
          "desc"  => "Default: <strong>3</strong>",
          "id"    => "recent_posts_items",
          "std"   => "3",
          "type"  => "text"),

    array("name"  => "Display Post Excerpts",
           "id"    => "recent_posts_content",
          "std"   => "off",
          "type"  => "checkbox"),

    array("name"  => "Display Date/Time",
          "desc"  => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
          "id"    => "recent_posts_date",
          "std"   => "on",
          "type"  => "checkbox"),  
          
    array("name"  => "Display Category",
          "id"    => "recent_posts_category",
          "std"   => "on",
          "type"  => "checkbox"),    
          
    array("name"  => "Display Comments Count",
          "id"    => "recent_posts_comments",
          "std"   => "on",
          "type"  => "checkbox"),

),

"id5" => array(
    array("type"  => "preheader",
          "name"  => "Colors"),
 
    array("name"  => "Link Color",
           "id"   => "a_css_color",
           "type" => "color",
           "selector" => "a",
           "attr" => "color"),
           
    array("name"  => "Link Hover Color",
           "id"   => "ahover_css_color",
           "type" => "color",
           "selector" => "a:hover",
           "attr" => "color"),

    array("name"  => "Header Background Color",
           "id"   => "header_bgcolor",
           "type" => "color",
           "selector" => "#heading",
           "attr" => "background-color"),

    array("name"  => "Left Sidebar Background Color",
           "id"   => "sidebar_bg",
           "type" => "color",
           "selector" => "#header",
           "attr" => "background-color"),
 
 
    array("type"  => "preheader",
          "name"  => "Fonts"),

    array("name" => "General Text Font Style", 
          "id" => "typo_body", 
          "type" => "typography", 
          "selector" => "body" ),

    array("name" => "Logo Text Style", 
          "id" => "typo_logo", 
          "type" => "typography", 
          "selector" => "#logo h1 a" ),

    array("name"  => "Homepage Slider Title Style",
           "id"   => "typo_slider_title",
           "type" => "typography",
           "selector" => ".slides li .content h3 a"),
  
     array("name"  => "Widget Title Style",
           "id"   => "typo_widget",
           "type" => "typography",
           "selector" => "#header #widgets .widget .title"),

)

/* end return */);