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
    
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/global.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.bgpos.js"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/flexslider.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.placeholder.js"></script>
    
    
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
<input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo get_current_user_id(); ?>" ></input>
<div class="my-selection-container">
    <div class="inner">
        <a class="trigger">My Selection</a>
        <div class="inside">
        	<div class="inside_list">
        	<?php if(!is_user_logged_in()){ ?>
            	<div>Howdy Guest,</div><div class="space10"></div><div>Please sign in in order to view your selection.</div>
        	<?php }else{ ?>
                <ul class="ul_inside">
	<?php 
	
		global $wpdb;
		$current_user_id =  get_current_user_id();
		$selection_table = $wpdb->get_results( "SELECT distinct item_id item_id , id id FROM xs_my_selection where user_id = ".$current_user_id." ORDER BY id DESC" );
		if ( $selection_table )
		{
			foreach ( $selection_table as $selection_row ) {
				// rel = user_id _/* post_id _/* post_title _/* post_thumbnail _/* voice_talent _/* post_type _/* permalink
				if(get_post_type( $selection_row->item_id ) =='post'){ ?>
					<li id="item-<?php echo get_current_user_id().'-'.$selection_row->item_id; ?>" class="video">
                    	<a class="permalink" href="<?php echo get_permalink($selection_row->item_id); ?>">
                        	<?php if (has_post_thumbnail( $selection_row->item_id ) ): ?>
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $selection_row->item_id ), 'thumbnail' ); ?>
                            	<img src='<?php echo $image[0]; ?>' />
                            <?php endif; ?>
                        	<label><?php $item_title = get_the_title($selection_row->item_id); echo $item_title; ?></label>
                        </a>
<a class="selection-button remove-from-selection icons" 
rel="<?php echo get_current_user_id().'_/*'.$selection_row->item_id.'_/*'.$item_title.'_/*'.$image[0].'_/*null_/*video_/*'.get_permalink(10); ?>" title="Remove from My Selection"></a>
                    </li>
				<?php }else{ ?>       
					<li id="item-<?php echo get_current_user_id().'-'.$selection_row->item_id; ?>" class="voice">
                    	<a class="permalink" href="<?php echo get_permalink(10); ?>?v_id=<?php echo $selection_row->item_id; ?>">
                        	<?php $item_title = get_the_title($selection_row->item_id); echo $item_title; ?>
                        </a>
                        <em>by <?php $talents = get_field('talent',$selection_row->item_id); foreach($talents as $talent){$talent_name  = get_the_title($talent); } echo $talent_name?></em>
<a class="selection-button remove-from-selection icons" 
rel="<?php echo get_current_user_id().'_/*'.$selection_row->item_id.'_/*'.$item_title.'_/*null_/*'.$talent_name.'_/*voice_/*'.get_permalink(10); ?>" title="Remove from My Selection"></a>
                     </li>
				<?php } }	
			}
			else
			{
				?>
				<li class="no-items-found">No items were added!</li>
				<?php
			}?>
            </ul>
            <?php } ?>
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
        <div class="header-login-form hidden">
            <?php if ( is_active_sidebar( 'login_form_widget' ) ) : ?>
                <?php dynamic_sidebar( 'login_form_widget' ); ?>
            <?php endif; ?>
        </div>
        <?php get_search_form(); ?>
    </div>
</section>
<section class="sitecontent <?php if(is_page(2)){ echo"homecontent";} ?> clear">
<section class="notifications-container">
	<div class="wrapper">
    	<label></label>
    </div>
</section>
			