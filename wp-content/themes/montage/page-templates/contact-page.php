<?php
/**
 * Template Name: Contact Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<?php while ( have_posts() ) : the_post(); ?>
        <section class="page-title tahoma">
            <img src="<?php echo get_template_directory_uri(); ?>/images/services-banner.png" />
            <h1 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>
        </section>
    <?php endwhile; // end of the loop. ?>
    <div class="wrapper clear">
        <div class="contact-col-1">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; // end of the loop. ?>
            <div class="clear"></div>
        </div>
        <div class="contact-col-2">    
            <?php if ( is_active_sidebar( 'contact_form_widget' ) ) : ?>
                <?php dynamic_sidebar( 'contact_form_widget' ); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="clear"></div>
<?php get_footer(); ?>