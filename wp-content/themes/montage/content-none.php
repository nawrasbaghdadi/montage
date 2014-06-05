<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<div class="wrapper relative clear blog-page" style="min-height:340px;">
    <h2 class="sub-title-inside" title="<?php _e( 'Nothing Found', 'twentytwelve' ); ?>">
    	<?php _e( 'Nothing Found', 'twentytwelve' ); ?>
	</h2>
    <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
    <div class="search-container">
        <?php get_search_form(); ?>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>