<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
    
        <h1 class="page-title">
            <span class="title" title="<?php the_title(); ?>"><?php the_title(); ?></span>
        </h1>
    <?php the_content(); ?>