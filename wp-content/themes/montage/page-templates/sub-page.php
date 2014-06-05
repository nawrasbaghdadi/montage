<?php
/**
 * Template Name: Sub Page Template
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
			<?php
            $current_page_id = $post->ID;
            $parent = $post->post_parent;
            ?>
            <section class="page-title tahoma">
                <img src="<?php echo get_template_directory_uri(); ?>/images/services-banner.png" />
                <h1><?php echo get_the_title($parent); ?></h1>
            </section>
            <div class="wrapper clear sub-page-details">
                <div class="col1">
                    <ul class="sub-page-list">
                        <?php
                            $sub_pages = array('post_type' => 'page','post_parent' => $parent,'order' => 'asc');
                            $query_sub_pages = new WP_Query($sub_pages);
                            ?>
                            
                            <?php if ( $query_sub_pages->have_posts() )
                                while ($query_sub_pages->have_posts() ) : $query_sub_pages->the_post();
                                $page_item_id = get_the_ID();
                            ?>
                                <li <?php if($page_item_id == $current_page_id){ echo" class='current-page-item'";} ?>>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?><span class="icons"></span></a>
                                </li>					
                            <?php endwhile; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="col2">
					<?php while ( have_posts() ) : the_post(); ?>
                        <h2 class="sub-page-title"><?php the_title(); ?></h2>
                        <?php the_content(); ?>
        			<?php endwhile; // end of the loop. ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
<?php get_footer(); ?>