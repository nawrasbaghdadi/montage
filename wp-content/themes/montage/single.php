<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<?php $add_as_showcase = get_field('add_as_showcase'); 
		if ( is_single() && ($add_as_showcase == 1 ) ){	
				include 'includes/showcase_details.php';
		}
		else
		{
	?>
          
<div class="wrapper relative clear blog-page" style="min-height:340px;">
    <h1 class="page-title">
        <span class="title" title="<?php echo get_the_title(12); ?>"><?php echo get_the_title(12); ?></span>
    </h1>
    <div class="cols-container">
        <div class="col1">
            
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
				<nav class="nav-single" style="display:none;">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
				<div>
					<?php comments_template( '', true ); ?>
                </div>
			<?php endwhile; // end of the loop. ?>
        </div>
        <div class="col2">
			<?php include("includes/blog_side_bar.php"); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


<?php } //endif for 'add_as_showcase'  ?>

<?php get_footer(); ?>