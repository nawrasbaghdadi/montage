<?php

get_header(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/isotope.css" />
<div class="wrapper relative clear showcase-page" style="min-height:340px;">
	<?php while ( have_posts() ) : the_post(); ?>
        <h1 class="page-title">
            <span class="title" title="<?php the_title(); ?>"><?php the_title(); ?></span>
        </h1>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
    <?php
     $category_list =array();
     $brand_list =array();
     $client_list =array();
     $agency_list =array();
	 $showcase_items = new WP_Query( array('meta_key'=>'add_as_showcase',
											'meta_value' => '1',
											'meta_compare' => '==',
											'order' => 'DESC') );
		while ($showcase_items->have_posts()) : $showcase_items->the_post();
			$categorylist = get_the_category();		
			$brandlist = get_field('brands');		
			$clientlist = get_field('client');		
			$agencylist = get_field('agency');		
		
			foreach($categorylist as $category){
				$category_list[] = $category->slug;}
				
			foreach($brandlist as $brand){
				$brand_list[] = $brand->post_name;}
			
			foreach($clientlist as $client){
				$client_list[] = $client->post_name;}
			
			foreach($agencylist as $agency){
				$agency_list[] = $agency->post_name;}
	  
	   endwhile;
	   // print_r($category_list); 
	   // print_r($brand_list); 
		$category_list = array_unique($category_list);
		$brand_list = array_unique($brand_list);
		$client_list = array_unique($client_list);
		$agency_list = array_unique($agency_list);
		sort($category_list);
		sort($brand_list);
		sort($client_list);
		sort($agency_list);
		?>
    <ul class="mainfilter">
    	<li><label>All Categories</label><span class="icons"></span>
        	<div class="col-list">
                <ul class="subfilter option-set clearfix cats" data-filter-group="category"> 
                    <?php   $get_showreel = get_category_by_slug('showreel'); ?>
                    <li><a id="#showreel" data-filter-value=".showreel">
                            Showreel</a></li>
                    <?php foreach($category_list as $category_item){
                            if ($category_item != 'showreel'){ ?>
                        <li><a id="#<?php  echo $category_item; ?>" data-filter-value=".<?php  echo $category_item; ?>">
                                <?php $term = get_term_by('slug', $category_item, 'category'); $cat_name = $term->name; echo $cat_name;?></a></li>
                    <? } } ?>
                </ul>
                <a id="#all-categories" data-filter-value="" class="selected all">All Categories</a>
            </div>
    	</li>
    	<li><label>All Brands</label><span class="icons"></span>
        	<div class="col-list">
                <ul class="subfilter option-set clearfix " data-filter-group="brand"> 
                    <?php foreach($brand_list as $brand_item){ ?>
                        <li><a id="#<?php  echo $brand_item; ?>" data-filter-value=".<?php  echo $brand_item; ?>">
                                <?php $brand_id = get_id_by_post_name($brand_item); echo get_the_title($brand_id); ?></a></li>
                    <? } ?>
                </ul>
            <a id="#all-brands" data-filter-value="" class="selected all">All Brands</a>
            </div>
        </li>
    	<li><label>All Clients</label><span class="icons"></span>
        	<div class="col-list">
                <ul class="subfilter option-set clearfix " data-filter-group="client"> 
                    <?php foreach($client_list as $client_item){ ?>
                        <li><a id="#<?php  echo $client_item; ?>" data-filter-value=".<?php  echo $client_item; ?>">
                                <?php $client_id = get_id_by_post_name($client_item); echo get_the_title($client_id); ?></a></li>
                    <? } ?>
                </ul>
                <a id="#all-clients" data-filter-value="" class="selected all">All Clients</a>
            </div>
        </li>
    	<li><label>All Agencies</label><span class="icons"></span>
        	<div class="col-list">
                <ul class="subfilter option-set clearfix " data-filter-group="agency"> 
                    <?php foreach($agency_list as $agency_item){ ?>
                        <li><a id="#<?php  echo $agency_item; ?>" data-filter-value=".<?php  echo $agency_item; ?>">
                                <?php $agency_id = get_id_by_post_name($agency_item); echo get_the_title($agency_id); ?></a></li>
                    <? } ?>
                </ul>
                <a id="#all-agencies" data-filter-value="" class="selected all">All Agencies</a>
            </div>
        </li>
    </ul>
	<div class="clear"></div>
	<ul id="showcase-container" class="clearfix">
		<?php 	
		while ($showcase_items->have_posts()) : $showcase_items->the_post();
			$categorylist = get_the_category();	
			$brands = get_field('brands');		
			$clients = get_field('client');		
			$agencies = get_field('agency');	
			$post_cats = '';
			$post_brands = '';
			$post_clients = '';
			$post_agencies = '';
			?>
            <?php foreach($categorylist as $category){ $post_cats .= ' ' . $category->slug; } ?>
            <?php
				if( $brands ):  
					foreach($brands as $brand){
						$post_brands .= ' ' . $brand->post_name;} 
				endif;
				if( $clients ):  
					foreach($clients as $client){
						$post_clients .= ' ' . $client->post_name;} 
				endif;
				if( $agencies ):  
					foreach($agencies as $agency){
						$post_agencies .= ' ' . $agency->post_name;} 
				endif;?>
            <li class="project-item <?php echo $post_cats ;?> <?php echo $post_brands ;?>  <?php echo $post_clients ;?>  <?php echo $post_agencies ;?> ">
            	<a class="add-to-selection"><b><span class="icons"></span><label>Add to My Selection</label></b></a>
                <a class="post_link" href="<?php the_permalink(); ?>">
                    <?php 			 
					$thumb_id = get_field('home_gallery_image');
					$thumb_size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
					 
					$thumb_url = wp_get_attachment_image_src( $thumb_id, $thumb_size );
					// url = $image[0];
					// width = $image[1];
					// height = $image[2];
					?>
                	<span>
						<img src="<?php echo $thumb_url[0]; ?>" />
                    </span>
                    <em><?php the_title(); ?></em>
                </a>
            </li>
		<?php endwhile; ?>
	</ul>            
</div>
<div class="clear"></div>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.isotope.min.js"></script>
<script>
    $(function () {
		//$("ul#showcase-container>li:nth-child(3)").css({marginRight:'0'});

        var $container = $('#showcase-container'),
        filters = {};

        $container.isotope({
            itemSelector: '.project-item',
            masonry: {
                columnWidth: 3
            }
        });

        // filter buttons
        $('.subfilter a').click(function () {
            var $this = $(this);
            // don't proceed if already selected
            if ($this.hasClass('selected')) {
                return;
            }

            var $optionSet = $this.parents('.option-set');
            // change selected class
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');

            // store filter value in object
            // i.e. filters.color = 'red'
            var group = $optionSet.attr('data-filter-group');
            filters[group] = $this.attr('data-filter-value');
            // convert object into array
            var isoFilters = [];
            for (var prop in filters) {
                isoFilters.push(filters[prop])
            }
            var selector = isoFilters.join('');
            $container.isotope({ filter: selector });

            return false;
        });

    });
</script>
	<script language="javascript">	
        $(document).ready(function () {
            $("#showcase-container>li").hover(function () {
                $(this).find('a.add-to-selection').stop().animate({top:'0px'}, 300);
            }, function () {
                $(this).find('a.add-to-selection').stop().animate({top:'-36px'}, 300);
            });
            $("#showcase-container>li>a.add-to-selection").hover(function () {
                $(this).find('label').stop().fadeIn(150);
            }, function () {
                $(this).find('label').stop().fadeOut(150);
            });
            $(".mainfilter").hover(function () {
                $(this).find('.col-list').stop().slideDown(150);
            }, function () {
                $(this).find('.col-list').stop().slideUp(150);
            });
            var selectedCat = $(".mainfilter>li>ul>li>a.selected").html();
            $(".mainfilter>label").text(selectedCat);
            $(".mainfilter ul li a").click(function () {
            	var selectedCat = $(this).html();
            	$(".mainfilter>li").has(this).find('label').text(selectedCat);
                return false;
            });
        });
    </script>
<?php get_footer(); ?>