<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>  <article id="post-<?php the_ID(); ?>" class="post-item">
                <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                <h1>
                    <?php _e( 'Featured post', 'twentytwelve' ); ?>
                </h1>
                <?php endif; ?>
                <div class="entry-header">
                    <?php if ( is_single() ) : ?>
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                    <?php else : ?>
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                        <date class="post-date"><?php the_time('l, M jS, Y') ?></date>
                    <?php if ( has_post_thumbnail() ) {  ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a> <?php } ?>
                    <?php endif; // is_single() ?>
                </div><!-- .entry-header -->
        
                <?php if ( is_search() ) : // Only display Excerpts for Search ?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
                <?php else : ?>
                <div class="entry-content">
                    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                </div><!-- .entry-content -->
                <?php endif; ?>
        
                <div class="entry-meta">
                    <?php twentytwelve_entry_meta(); ?>
                    <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                    <?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
                        <div class="author-info">
                            <div class="author-avatar">
                                <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
                            </div><!-- .author-avatar -->
                            <div class="author-description">
                                <h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
                                <p><?php the_author_meta( 'description' ); ?></p>
                                <div class="author-link">
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                        <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
                                    </a>
                                </div><!-- .author-link	-->
                            </div><!-- .author-description -->
                        </div><!-- .author-info -->
                    <?php endif; ?>
                </div><!-- .entry-meta -->
                    <?php if ( comments_open() ) : ?>
                        <div class="leave-a-reply">
                            <?php comments_popup_link( '<span class="icon"></span>' . __( 'Leave a reply', 'twentytwelve' ) . '', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
                        </div><!-- .comments-link -->
                    <?php endif; // comments_open() ?>
            </article><!-- #post -->