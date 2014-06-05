<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div class="wrapper relative clear blog-page" style="min-height:340px;">
	<h1 class="page-title-inside" title="<?php printf( __( 'Search Results', 'twentytwelve' )); ?>"><?php printf( __( 'Search Results', 'twentytwelve' )); ?></h1>
    <div class="cols-container">
        <div class="col1">
            <h2 class="sub-title-inside">
                <?php printf( __( 'for: %s', 'twentytwelve' ), get_search_query() ); ?>
            </h2>

			<?php if ( have_posts() ) : ?>
				<?php twentytwelve_content_nav( 'nav-above' ); ?>
    
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
    
                <?php twentytwelve_content_nav( 'nav-below' ); ?>
    
            <?php else : ?>
                <h2>
                    <?php _e( 'Nothing Found', 'twentytwelve' ); ?>
                </h2>
                <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
                <div class="search-container">
	                <?php get_search_form(); ?>
				</div>
            <?php endif; ?>
        </div>
        <div class="col2">
			<?php include("includes/blog_side_bar.php"); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>