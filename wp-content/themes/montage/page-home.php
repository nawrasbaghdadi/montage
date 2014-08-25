<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
        <div class="wrapper relative clear home-intro">
            <h1 class="page-title home-title">
                <span class="title" title="<?php the_title(); ?>"><?php the_title(); ?></span>
            </h1>
            <?php the_content(); ?>
        </div>
    <?php endwhile; // end of the loop. ?>
    <script defer src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
          $('.home-news-list-container').flexslider({
            animation: "slide",
			slideshowSpeed: 7000,
			animationSpeed: 1500,
			directionNav: false,
			slideshow:true
          });
        });        
    </script>
    <script type="text/javascript">
        $(window).load(function(){
          $('.home-slider-container').flexslider({
            animation: "slide",
			slideshowSpeed: 8000,
			animationSpeed: 2000,
			manualControls: '.custom-controls li a',
			controlsContainer: '.home-slider-outer-container',
            start: function(slider){
              $('.home-slider-container').css({background: 'none #f1f1f1'});
            }
          });
        });        
    </script>
    <div class="home-slider-outer-container">
        <div class="home-slider-container clear">
            <ul class="slides">
        <?php
         $home_slides = new WP_Query( array('meta_key'=>'display_in_home_gallery',
                                            'meta_value' => '1',
                                            'meta_compare' => '==',
                                            'order' => 'DESC') );
                while ($home_slides->have_posts()) : $home_slides->the_post();
                    $brands = get_field('brands');		
                    $clients = get_field('client');
                    $image_id = get_field('home_gallery_image');
                    $image_size = "full"; // (thumbnail, medium, large, full or custom size)				 
                    $image_url = wp_get_attachment_image_src( $image_id, $image_size );
                    $post_brands = '';
                    $post_clients = '';
                    if( $brands ):  
                        foreach($brands as $brand){
                            $post_brands .= $brand->post_title.' ';} 
                    endif;
                    if( $clients ):  
                        foreach($clients as $client){
                            $post_clients .= $client->post_title.' ';} 
                    endif;
                ?>
                <li style="background-image:url(<?php echo $image_url[0]; ?>);">
                	<a href="<?php echo the_permalink(); ?>" class="image-link"></a>
                    <a class="trigger" href="<?php echo the_permalink(); ?>">
                        <span class="title"><?php echo $post_brands ;?></span>
                        <span class="desc"><?php echo $post_clients ;?></span>
                    </a>
                </li>
        <?php endwhile; ?>
            </ul>
        </div>
        <ul class="custom-controls flex-control-nav flex-control-paging">
        <?php
         $home_slides = new WP_Query( array('category__not_in' => 15,'meta_key'=>'display_in_home_gallery',
                                            'meta_value' => '1',
                                            'meta_compare' => '==',
                                            'order' => 'DESC') );
				$posts_count = 1;
                while ($home_slides->have_posts()) : $home_slides->the_post();
                ?>
           			<li><a href="#"><?php echo $posts_count ?></a></li>
                    
        <?php 
		$posts_count++;
		
		endwhile; ?>
        <?php
         $home_slides = new WP_Query( array('cat' => 15,'posts_per_page'=>'1','meta_key'=>'display_in_home_gallery',
                                            'meta_value' => '1',
                                            'meta_compare' => '==',
                                            'order' => 'DESC') );
                while ($home_slides->have_posts()) : $home_slides->the_post();
                ?>
           			<li><a href="#" style="font-size:13px;">showreel</a></li>
        <?php endwhile; ?>
        </ul>
    </div>
		<?php
             $news_home_block_title = get_field("news_home_block_title", 'options');
		?>
	<div class="wrapper relative clear latest-news">
    	<h1 class="page-title all-news normalcase">
        	<a href="<?php echo get_category_link(14); ?>"><span class="title" title="<?php echo $news_home_block_title; ?>"><?php echo $news_home_block_title; ?></span></a>
        </h1>
 <div class="home-news-list-container">
            <ul class="home-news-list slides clear">
                <?php $news_query = new WP_Query("cat=14&showposts=3"); 
                while ($news_query->have_posts()) : $news_query->the_post();
                ?>
                <li>
                    <date><?php echo the_date();  ?></date>
                    <label><a href="<?php echo get_permalink();  ?>"><?php the_title(); ?></a></label>
                    <span>
                        <?php
                            $thecontent = $post->post_content; /* or you can use get_the_title() */
                            $postOutput = strip_tags(nl2br($thecontent),"");
                            $getlength = strlen($postOutput);
                            $thelength = 450;
                            echo substr($postOutput, 0, $thelength);
                            if ($getlength > $thelength) echo "...";
                        ?>
                    </span>
                </li>
                <?php endwhile; ?>
            </ul>
            <a href="<?php echo get_category_link(14); ?>" class="view-all-news">more news...</a>
        </div> 
             
    </div>
	<div class="clear"></div>
<?php get_footer(); ?>