<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="wrapper relative clear blog-page" style="min-height:340px;">
    <h1 class="page-title">
        <span class="title" title="<?php echo get_the_title(12); ?>"><?php echo get_the_title(12); ?></span>
    </h1>
    <div class="cols-container">
        <div class="col1">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<h2><?php _e( 'No posts to display', 'twentytwelve' ); ?></h2>
				<?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?>

			<?php else :
				// Show the default message to everyone else.
			?>
				<h2><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h2>
				<?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?>
				<?php get_search_form(); ?>
			<?php endif; // end current_user_can() check ?>

		<?php endif; // end have_posts() check ?>

<?php get_sidebar(); ?>
        </div>
        <div class="col2">
			<?php include("includes/blog_side_bar.php"); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<?php get_footer(); ?>