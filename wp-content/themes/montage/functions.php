<?php
update_option('siteurl','http://localhost/montage');
update_option('home','http://localhost/montage');
/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 720, 9000 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'twentytwelve-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		wp_enqueue_style( 'twentytwelve-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Contact Form', 'twentytwelve' ),
		'id' => 'footer_contact_form_widget',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 style="display:none;"><i>',
		'after_title' => '</i></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'login Form', 'twentytwelve' ),
		'id' => 'login_form_widget',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 style="display:none;"><i>',
		'after_title' => '</i></h3>',
	) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 ); ?>
					<div class="name-date">
				<?php
					printf( '<cite class="fn"><span class="post-author">%2$s <b>%1$s</b></span></cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? ' ' . __( 'Post author: ', 'twentytwelve' ) . '' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
				</div>
			</div><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &darr;', 'twentytwelve' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( '', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( '', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( '<div class="catz"><label>Posted in:</label> %1$s</div><div class="tagz"><label>Tagged with:</label> %2$s</div> <span style="display:none;">on %3$s</span><span class="by-author" style="display:none;"> by %4$s</span>', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( '<div class="catz"><label>Posted in:</label> %1$s</div><span style="display:none;">on %3$s</span><span class="by-author" style="display:none;"> by %4$s</span>', 'twentytwelve' );
	} else {
		$utility_text = __( '<div class="catz"><label>Posted in:</label> %3$s</div><span class="by-author" style="display:none;"> by %4$s</span>', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function twentytwelve_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_customize_preview_js() {
	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );

function remove_menus () {
global $menu;
	$restricted = array(__('Links'), __('Dashboard'), __('Tools'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');
// Remove Unecessary links from Admin Bar
function ipstenu_admin_bar_remove() {
        global $wp_admin_bar;
        /* Remove their stuff */
        //$wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('new-content');
		$wp_admin_bar->remove_menu('tribe-events');
} 
add_action('wp_before_admin_bar_render', 'ipstenu_admin_bar_remove');
//manage user dashboard
if ( !is_super_admin() && is_user_logged_in() ) {  
	function remove_dashboard_widgets() {
		global $wp_meta_boxes;
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_welcome_message']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
		//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	}
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
}
function disable_tribe_dashboard_widget() {
remove_meta_box('tribe_dashboard_widget', 'dashboard', 'normal');
}
add_action('admin_menu', 'disable_tribe_dashboard_widget');
add_action( 'init', 'register_cpt_brand' );
function register_cpt_brand() {
    $labels = array( 
        'name' => _x( 'Brand', 'brand' ),
        'singular_name' => _x( 'Brand', 'brand' ),
        'add_new' => _x( 'Add New', 'brand' ),
        'add_new_item' => _x( 'Add New Brand', 'brand' ),
        'edit_item' => _x( 'Edit Brand', 'brand' ),
        'new_item' => _x( 'New Brand', 'brand' ),
        'view_item' => _x( 'View Brand', 'brand' ),
        'search_items' => _x( 'Search brands', 'brand' ),
        'not_found' => _x( 'No brands found', 'brand' ),
        'not_found_in_trash' => _x( 'No brands found in Trash', 'brand' ),
        'parent_item_colon' => _x( 'Parent Brand:', 'brand' ),
        'menu_name' => _x( 'Brands', 'brand' ),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,        
        'supports' => array( 'title', 'editor', 'thumbnail' ),     
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 14,
		//'menu_icon' => get_template_directory_uri().'/images/menu-icons-products.png',      
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'brand', $args );
}
add_action( 'init', 'register_cpt_client' );
function register_cpt_client() {
    $labels = array( 
        'name' => _x( 'Client', 'client' ),
        'singular_name' => _x( 'Client', 'client' ),
        'add_new' => _x( 'Add New', 'client' ),
        'add_new_item' => _x( 'Add New Client', 'client' ),
        'edit_item' => _x( 'Edit Client', 'client' ),
        'new_item' => _x( 'New Client', 'client' ),
        'view_item' => _x( 'View Client', 'client' ),
        'search_items' => _x( 'Search clients', 'client' ),
        'not_found' => _x( 'No clients found', 'client' ),
        'not_found_in_trash' => _x( 'No clients found in Trash', 'client' ),
        'parent_item_colon' => _x( 'Parent Brand:', 'client' ),
        'menu_name' => _x( 'Clients', 'client' ),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,        
        'supports' => array( 'title', 'editor', 'thumbnail' ),     
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 14,
		//'menu_icon' => get_template_directory_uri().'/images/menu-icons-products.png',      
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'client', $args );
}
add_action( 'init', 'register_cpt_agency' );
function register_cpt_agency() {
    $labels = array( 
        'name' => _x( 'Agency', 'agency' ),
        'singular_name' => _x( 'Agency', 'agency' ),
        'add_new' => _x( 'Add New', 'agency' ),
        'add_new_item' => _x( 'Add New Agency', 'agency' ),
        'edit_item' => _x( 'Edit Agency', 'agency' ),
        'new_item' => _x( 'New Agency', 'agency' ),
        'view_item' => _x( 'View Agency', 'agency' ),
        'search_items' => _x( 'Search agencies', 'agency' ),
        'not_found' => _x( 'No agencies found', 'agency' ),
        'not_found_in_trash' => _x( 'No agencies found in Trash', 'agency' ),
        'parent_item_colon' => _x( 'Parent Agency:', 'agency' ),
        'menu_name' => _x( 'Agencies', 'agency' ),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,        
        'supports' => array( 'title', 'editor', 'thumbnail' ),     
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 14,
		//'menu_icon' => get_template_directory_uri().'/images/menu-icons-products.png',      
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'agency', $args );
}
add_action( 'init', 'register_cpt_talent' );
function register_cpt_talent() {
    $labels = array( 
        'name' => _x( 'Talent', 'talent' ),
        'singular_name' => _x( 'Talent', 'talent' ),
        'add_new' => _x( 'Add New', 'talent' ),
        'add_new_item' => _x( 'Add New Talent', 'talent' ),
        'edit_item' => _x( 'Edit Talent', 'talent' ),
        'new_item' => _x( 'New Talent', 'talent' ),
        'view_item' => _x( 'View Talent', 'talent' ),
        'search_items' => _x( 'Search talents', 'talent' ),
        'not_found' => _x( 'No talents found', 'talent' ),
        'not_found_in_trash' => _x( 'No talents found in Trash', 'talent' ),
        'parent_item_colon' => _x( 'Parent Talent:', 'talent' ),
        'menu_name' => _x( 'Talents', 'talent' ),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 21,
		//'menu_icon' => get_template_directory_uri().'/images/menu-icons-products.png',      
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'talent', $args );
}
add_action( 'init', 'register_cpt_voice' );
function register_cpt_voice() {
    $labels = array( 
        'name' => _x( 'Voice', 'voice' ),
        'singular_name' => _x( 'Voice', 'voice' ),
        'add_new' => _x( 'Add New', 'voice' ),
        'add_new_item' => _x( 'Add New Voice', 'voice' ),
        'edit_item' => _x( 'Edit Voice', 'voice' ),
        'new_item' => _x( 'New Voice', 'voice' ),
        'view_item' => _x( 'View Voice', 'voice' ),
        'search_items' => _x( 'Search voices', 'voice' ),
        'not_found' => _x( 'No voices found', 'voice' ),
        'not_found_in_trash' => _x( 'No voices found in Trash', 'voice' ),
        'parent_item_colon' => _x( 'Parent Voice:', 'voice' ),
        'menu_name' => _x( 'Voices', 'voice' ),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,        
        'supports' => array( 'title', 'editor', 'thumbnail' ),     
        'taxonomies' => array( 'tonality', 'language', 'accent', 'age_bracket' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 21,
		//'menu_icon' => get_template_directory_uri().'/images/menu-icons-products.png',      
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'voice', $args );
}
add_action( 'init', 'register_taxonomy_tonality' );
function register_taxonomy_tonality() {
    $labels = array( 
        'name' => _x( 'Tonalities', 'tonality' ),
        'singular_name' => _x( 'Tonality', 'tonality' ),
        'search_items' => _x( 'Search Tonalities', 'tonality' ),
        'popular_items' => _x( 'Popular Tonalities', 'tonality' ),
        'all_items' => _x( 'All Tonalities', 'tonality' ),
        'parent_item' => _x( 'Parent Tonality', 'tonality' ),
        'parent_item_colon' => _x( 'Parent Tonality:', 'tonality' ),
        'edit_item' => _x( 'Edit Tonality', 'tonality' ),
        'update_item' => _x( 'Update Tonality', 'tonality' ),
        'add_new_item' => _x( 'Add New Tonality', 'tonality' ),
        'new_item_name' => _x( 'New Tonality', 'tonality' ),
        'separate_items_with_commas' => _x( 'Separate tonalities with commas', 'tonality' ),
        'add_or_remove_items' => _x( 'Add or remove tonalities', 'tonality' ),
        'choose_from_most_used' => _x( 'Choose from the most used tonalities', 'tonality' ),
        'menu_name' => _x( 'Tonalities', 'tonality' ),
    );
    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
    register_taxonomy( 'tonality', array('voice'), $args );
}
add_action( 'init', 'register_taxonomy_language' );
function register_taxonomy_language() {
    $labels = array( 
        'name' => _x( 'Languages', 'language' ),
        'singular_name' => _x( 'Language', 'language' ),
        'search_items' => _x( 'Search Languages', 'language' ),
        'popular_items' => _x( 'Popular Languages', 'language' ),
        'all_items' => _x( 'All Languages', 'language' ),
        'parent_item' => _x( 'Parent Language', 'language' ),
        'parent_item_colon' => _x( 'Parent Language:', 'language' ),
        'edit_item' => _x( 'Edit Language', 'language' ),
        'update_item' => _x( 'Update Language', 'language' ),
        'add_new_item' => _x( 'Add New Language', 'language' ),
        'new_item_name' => _x( 'New Language', 'language' ),
        'separate_items_with_commas' => _x( 'Separate languages with commas', 'language' ),
        'add_or_remove_items' => _x( 'Add or remove languages', 'language' ),
        'choose_from_most_used' => _x( 'Choose from the most used languages', 'language' ),
        'menu_name' => _x( 'Languages', 'language' ),
    );
    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
    register_taxonomy( 'language', array('voice'), $args );
}
add_action( 'init', 'register_taxonomy_accent' );
function register_taxonomy_accent() {
    $labels = array( 
        'name' => _x( 'Accents', 'accent' ),
        'singular_name' => _x( 'Accent', 'accent' ),
        'search_items' => _x( 'Search accents', 'accent' ),
        'popular_items' => _x( 'Popular Accents', 'accent' ),
        'all_items' => _x( 'All Accents', 'accent' ),
        'parent_item' => _x( 'Parent Accent', 'accent' ),
        'parent_item_colon' => _x( 'Parent Accent:', 'accent' ),
        'edit_item' => _x( 'Edit Accent', 'accent' ),
        'update_item' => _x( 'Update Accent', 'accent' ),
        'add_new_item' => _x( 'Add New Accent', 'accent' ),
        'new_item_name' => _x( 'New Accent', 'accent' ),
        'separate_items_with_commas' => _x( 'Separate accents with commas', 'accent' ),
        'add_or_remove_items' => _x( 'Add or remove accents', 'accent' ),
        'choose_from_most_used' => _x( 'Choose from the most used accents', 'accent' ),
        'menu_name' => _x( 'Accents', 'accent' ),
    );
    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
    register_taxonomy( 'accent', array('voice'), $args );
}
add_action( 'init', 'register_taxonomy_age_bracket' );
function register_taxonomy_age_bracket() {
    $labels = array( 
        'name' => _x( 'Age Brackets', 'age_bracket' ),
        'singular_name' => _x( 'Age Brackets', 'age_bracket' ),
        'search_items' => _x( 'Search Age Brackets', 'age_bracket' ),
        'popular_items' => _x( 'Popular Age Brackets', 'age_bracket' ),
        'all_items' => _x( 'All Age Brackets', 'age_bracket' ),
        'parent_item' => _x( 'Parent Age Bracket', 'age_bracket' ),
        'parent_item_colon' => _x( 'Parent Age Bracket:', 'age_bracket' ),
        'edit_item' => _x( 'Edit Age Bracket', 'age_bracket' ),
        'update_item' => _x( 'Update Age Bracket', 'age_bracket' ),
        'add_new_item' => _x( 'Add New Age Bracket', 'age_bracket' ),
        'new_item_name' => _x( 'New Age Bracket', 'age_bracket' ),
        'separate_items_with_commas' => _x( 'Separate age brackets with commas', 'age_bracket' ),
        'add_or_remove_items' => _x( 'Add or remove age brackets', 'age_bracket' ),
        'choose_from_most_used' => _x( 'Choose from the most used age brackets', 'age_bracket' ),
        'menu_name' => _x( 'Age Brackets', 'age_bracket' ),
    );
    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
    register_taxonomy( 'age_bracket', array('voice'), $args );
}
add_action( 'init', 'register_taxonomy_voice_gender' );
function register_taxonomy_voice_gender() {
    $labels = array( 
        'name' => _x( 'Voice Gender', 'voice_gender' ),
        'singular_name' => _x( 'Voice Genders', 'voice_gender' ),
        'search_items' => _x( 'Search Voice Genders', 'voice_gender' ),
        'popular_items' => _x( 'Popular Voice Genders', 'voice_gender' ),
        'all_items' => _x( 'All Voice Genders', 'voice_gender' ),
        'parent_item' => _x( 'Parent Voice Gender', 'voice_gender' ),
        'parent_item_colon' => _x( 'Parent Voice Gender:', 'voice_gender' ),
        'edit_item' => _x( 'Edit Voice Gender', 'voice_gender' ),
        'update_item' => _x( 'Update Voice Gender', 'voice_gender' ),
        'add_new_item' => _x( 'Add New Voice Gender', 'voice_gender' ),
        'new_item_name' => _x( 'New Voice Gender', 'voice_gender' ),
        'separate_items_with_commas' => _x( 'Separate voice genders with commas', 'voice_gender' ),
        'add_or_remove_items' => _x( 'Add or remove voice genders', 'voice_gender' ),
        'choose_from_most_used' => _x( 'Choose from the most used voice genders', 'voice_gender' ),
        'menu_name' => _x( 'Voice Genders', 'voice_gender' ),
    );
    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
    register_taxonomy( 'voice_gender', array('voice'), $args );
}
function get_id_by_post_name($post_name)
{
	global $wpdb;
	$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$post_name."'");
	return $id;
}
if(false === get_option("medium_crop")) {
    add_option("medium_crop", "1");
} else {
    update_option("medium_crop", "1");
}
function remove_pages_from_search() {
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
}
if ( !is_super_admin() && is_user_logged_in() ) { 
	show_admin_bar(false);
}
function addtoselection(){
	/// Insert in xpertonl_montage user_id post_id
 	
	$query  = "INSERT INTO xs_my_selection (user_id, item_id) VALUES (" . $_GET['userid'] . ",". $_GET['itemid'] ." )";
	$result = mysql_query($query);	
	//echo $query;
	///////////////////////////////////
	//$query_select  = "SELECT distinct item_id item_id , id id FROM xs_my_selection where user_id = ".$_GET['userid']." ORDER BY id DESC";
//	$result_select = mysql_query($query_select);	
//	$result_select_rows = mysql_num_rows($result_select);
	
	//////////////////////////////////
	//$row = mysql_fetch_object($result);
	//echo $row->CompDetID;
	//echo $query;	
	//echo '<select  class="select" name="car_make" id="car_make" size="1" style="width:100%;">';
	//echo '<option value="Choose Make">Choose Make</option>';	
  
    //echo '<tr>';
	//echo '<td>';
	//echo '<ul class="ul_inside">';
	///////////////////////////////////
	
	///////////////////////////////////
   // echo '</td>';
    //echo  '</tr>';	
	//echo '</ul>';	
	//echo '</select>';		
	//echo ($row->Comp_Det_Name . "///" . $_GET['greeting'] );
	// Return String
	///////////////////////////////////
	die();
	///////////////////////////////////
}
function removefromselection(){
	/// Insert in xpertonl_montage user_id post_id
 	
	$query  = "DELETE FROM xs_my_selection WHERE  user_id=" . $_GET['userid'] . " and item_id=". $_GET['itemid'];
	$result = mysql_query($query);	
	//echo $query;
	
	
	//$row = mysql_fetch_object($result);
	//echo $row->CompDetID;
	//echo $query;	
	//echo '<select  class="select" name="car_make" id="car_make" size="1" style="width:100%;">';
	//echo '<option value="Choose Make">Choose Make</option>';	
  
    //echo '<tr>';
	//echo '<td>';
	//echo '<ul class="ul_inside">';
	
   // echo '</td>';
    //echo  '</tr>';	
	//echo '</ul>';	
	//echo '</select>';		
	//echo ($row->Comp_Det_Name . "///" . $_GET['greeting'] );
	// Return String
//	die();
}
add_action( 'wp_ajax_nopriv_addtoselection', 'addtoselection' );
add_action( 'wp_ajax_addtoselection', 'addtoselection' );
function add_myselectionscript(){
    wp_enqueue_script( 'my-ajax-request', get_bloginfo('template_directory') . "/my-ajax.js", array( 'jquery' ) );
	wp_localize_script( 'my-ajax-request', 'addtoselection', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'init', 'add_myselectionscript' );

add_action( 'wp_ajax_nopriv_removefromselection', 'removefromselection' );
add_action( 'wp_ajax_removefromselection', 'removefromselection' );
function remove_myselectionscript(){
    wp_enqueue_script( 'my-ajax-request', get_bloginfo('template_directory') . "/my-ajax.js", array( 'jquery' ) );
	wp_localize_script( 'my-ajax-request', 'removefromselection', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'init', 'remove_myselectionscript' );

