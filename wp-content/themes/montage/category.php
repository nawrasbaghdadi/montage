<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
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
            <h2 class="sub-title-inside">
                <?php printf( __( 'Category: %s', 'twentytwelve' ), single_cat_title( '', false ) ); ?>
            </h2>
        	<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
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