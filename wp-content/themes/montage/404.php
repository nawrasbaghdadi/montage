<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div class="wrapper relative clear blog-page" style="min-height:340px;">
    <h1 class="page-title-inside" title="Page not found">
    	Page not found
	</h1>
    <div class="cols-container">
        <div class="col1">
            <h2 class="sub-title-inside" title="<?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?>">
                <?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?>
            </h2>
            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentytwelve' ); ?></p>
                <div class="search-container">
	                <?php get_search_form(); ?>
				</div>
        </div>
        <div class="col2">
			<?php include("includes/blog_side_bar.php"); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<?php get_footer(); ?>