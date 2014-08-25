<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
  
    <?php wp_head(); ?>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.0/animate.min.css" media="all" rel="stylesheet">
    
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/global.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.bgpos.js"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/flexslider.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.placeholder.js"></script>

   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/src/selectordie.min.js"></script>
   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/src/jquery.inview.min.js"></script>
   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/src/jquery.cookie.js"></script>

  	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/src/selectordie.css"/>
    
    
    <script type="text/javascript">

        $(document).ready(function () {
			$('input, textarea').placeholder();			
			$(".my-selection-container .trigger").click(function(){		
				var div_right = $('.my-selection-container').css('right');
				//alert (div_right);
				if(div_right == '0px'){
					$('.my-selection-container').animate({right:'-250px'}, 500);
					$(this).stop().animate({backgroundColor:'#000000',color:"#77b900"}, 300);
				}else{
					$('.my-selection-container').animate({right:'0px'}, 500);
					$(this).stop().animate({backgroundColor:'#77b900',color:"#ffffff"}, 300);
				}
			});
		});
	</script>
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/scrollbars.css" type="text/css" />

    <!-- the mousewheel plugin -->
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.mousewheel.js"></script>
    <!-- the jScrollPane script -->
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.inside_list').jScrollPane(
					{
						verticalDragMinHeight: 30,
						verticalDragMaxHeight: 30,
						autoReinitialise: true,
						hideFocus: true
					}
				);
			});
		</script>
    <meta name="GENERATOR" content="MSHTML 8.00.6001.19019">
	<script type="text/javascript">

	<?php if(!is_user_logged_in()){ ?>
		//alert("guest");
		//alert(<?php echo is_user_logged_in();?>);
		WriteCookie('guest');	
		//alert(getCookie("status"));
	<?php }else{ ?>
		//alert("user");
		//alert(<?php echo is_user_logged_in();?>);
		WriteCookie('user');	
		//alert(getCookie("status"));
		
	<?php } ?>
	
    function WriteCookie(cookieVal)
    {   
	 var date = new Date();
date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
expires = "; expires=" + date.toGMTString();
	    document.cookie = "status="+cookieVal + expires + "; path=/";
    }
	
	function getCookie(name) {
	 
		var dc = document.cookie;
		var prefix = name + "=";
		var begin = dc.indexOf("; " + prefix);
		if (begin == -1) {
			begin = dc.indexOf(prefix);
			if (begin != 0) return null;
		} else {
			begin += 2;
		}
		var end = document.cookie.indexOf(";", begin);
		if (end == -1) {
			end = dc.length;
		}
		return unescape(dc.substring(begin + prefix.length, end));
	}
    //-->
    </script>
    
</head>

<body>
<div class="my-selection-container">
    <div class="inner">
        <a class="trigger">My Selection</a>
        <div class="tabs">
          <a href="#" data-tab="video" class="tab active" id="voe"><i class="fa fa-video-camera"></i> Videos</a>
          <a href="#" data-tab="voice" class="tab" id="voi"><i class="fa fa-bullhorn"></i> Voices</a>
          <div data-content="video" class="content active" id="videos">
            <div class="inside">
            	<div class="inside_list">            
                    <ul class="ul_inside">
                    </ul>
                </div>            
            </div>
          </div>
          <div data-content="voice" class="content active" id="voices">
                <div class="inside">
                <div class="inside_list">
                    <ul class="ul_inside">
                </ul>
                </div>
                </div>
          </div>
        </div>
    </div>
</div>
<section class="siteheader">
	<div class="wrapper relative">
    	<h1 class="logo">
        	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
            	<img src="<?php echo get_template_directory_uri(); ?>/images/montage-logo.png" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" />
            </a>
        </h1>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu-container' ) ); ?>
        	<?php
             $facebook = get_field("facebook", 'options');
             $twitter = get_field("twitter", 'options');
             $linkedin = get_field("linkedin", 'options'); 
             $vimeo = get_field("vimeo", 'options'); 
      
            if($twitter || $vimeo || $facebook || $linkedin){ ?>
            <div class="social-menu-container">
                <ul>
					<?php if($facebook){ ?><li><a href="<?php echo $facebook; ?>" target="_blank" class="facebook icons"></a></li><?php } ?>
                    <?php if($vimeo){ ?><li><a href="<?php echo $vimeo; ?>" target="_blank" class="vimeo icons"></a></li><?php } ?>
                    <?php if($twitter){ ?><li><a href="<?php echo $twitter; ?>" target="_blank" class="twitter icons"></a></li><?php } ?>
                    <?php if($linkedin){ ?><li><a href="<?php echo $linkedin; ?>" target="_blank" class="linkedin icons"></a></li><?php } ?>
                </ul>
            </div>
		<?php } ?>
    <?php get_search_form(); ?>
    </div>
</section>
<section class="sitecontent <?php if(is_page(2)){ echo"homecontent";} ?> clear">
<section class="notifications-container">
	<div class="wrapper">
    	<label></label>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function () {
	$('.news-toggle a').click(function(e) {
		e.preventDefault();
		$('.news-toggle').toggleClass('active');
		$('.latest-news').toggleClass('active');
	})
})
$(function () {
    
      $('[data-tab]').on('click', function (e) {
        $(this)
          .addClass('active')
          .siblings('[data-tab]')
          .removeClass('active')
          .siblings('[data-content=' + $(this).data('tab') + ']')
          .addClass('active')
          .siblings('[data-content]')
          .removeClass('active');
        e.preventDefault();
      });
      
    });
</script>
			