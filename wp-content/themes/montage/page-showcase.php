<?php
/**
 * Template Name: Showcase Page Template
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
error_reporting(E_ALL & ~E_NOTICE);

get_header(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/isotope.css" />
    <!-- Select Style -->
    
  
  <!-- Select Style -->
<div class="wrapper relative clear showcase-page" style="min-height:340px;">
    <script type="text/javascript">
    $(document).ready(function() {
        $("select").selectOrDie();
    })
    
    </script>
    <?php
     $category_list =array();
     $brand_list =array();
     $client_list =array();
     $agency_list =array();
     $showcase_items = new WP_Query( array('meta_key'=>'add_as_showcase',
                                            'posts_per_page'=>'-1',
                                            'meta_value' => '1',
                                            'meta_compare' => '==',
                                            'order' => 'DESC') );
        while ($showcase_items->have_posts()) : $showcase_items->the_post();
            $categorylist = get_the_category();     
            $brandlist = get_field('brands');       
            $clientlist = get_field('client');      
            $agencylist = get_field('agency');      
            
            if($categorylist){
                foreach($categorylist as $category){
                    $category_list[] = $category->slug;}
            }   
            
            if($brandlist){
                foreach($brandlist as $brand){
                    $brand_list[] = $brand->post_name;}
            }   
            
            if($clientlist){            
                foreach($clientlist as $client){
                    $client_list[] = $client->post_name;}
            }   
            
            if($agencylist){            
                foreach($agencylist as $agency){
                    $agency_list[] = $agency->post_name;}
            }   
      
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
<div id="filter-form" >  
    <div class="preview" class="mainfilter">  
            <select data-custom-id="custom" data-custom-class="custom" data-filter-group="category" class="subfilter option-set clearfix cats ">
                <option id="#all-categories" data-filter-value="" class="selected all" value="">All Categories</option>
                <?php   $get_showreel = get_category_by_slug('showreel'); ?>
                <option value=".showreel" id="#showreel" data-filter-value=".showreel">Showreel</option>
                    <?php foreach($category_list as $category_item){

                        if ($category_item != 'showreel'){ ?>
                    <option value=".<?php  echo $category_item; ?>" id="#<?php  echo $category_item; ?>" data-filter-value=".<?php  echo $category_item; ?>">
                            <?php $term = get_term_by('slug', $category_item, 'category'); $cat_name = $term->name; echo $cat_name;?></option>
                <?php } } ?>
               
            </select>
    </div>
       <div class="preview">  
            <select data-custom-id="custom" data-custom-class="custom" data-filter-group="brand"  class="subfilter option-set clearfix">
                <option id="#all-brands" data-filter-value="" class="selected all" value="">All Brands</option>
                    <?php foreach($brand_list as $brand_item){ ?>
                    <option value=".<?php  echo $brand_item; ?>" id="#<?php  echo $brand_item; ?>" data-filter-value=".<?php  echo $brand_item; ?>">
                            <?php $brand_id = get_id_by_post_name($brand_item); echo get_the_title($brand_id); ?></option>
                <?php } ?>
            </select>
    </div>
    <div class="preview">   
            <select data-custom-id="custom" data-custom-class="custom" data-filter-group="client"  class="subfilter option-set clearfix">
                <option id="#all-clients" data-filter-value="" class="selected all" value="">All Clients</option>
                    <?php foreach($client_list as $client_item){ ?>
                     <option value=".<?php  echo $client_item; ?>" id="#<?php  echo $client_item; ?>" data-filter-value=".<?php  echo $client_item; ?>">
                            <?php $client_id = get_id_by_post_name($client_item); echo get_the_title($client_id); ?></option>
                <?php } ?>
            </select>
    </div>
    <div class="preview">  
            <select data-custom-id="custom" data-custom-class="custom" data-filter-group="agency"  class="subfilter option-set">
                <option id="#all-agencies" data-filter-value="" class="selected all" value="">All Agencies</option>
                    <?php foreach($agency_list as $agency_item){ ?>
                     <option value=".<?php  echo $agency_item; ?>" id="#<?php  echo $agency_item; ?>" data-filter-value=".<?php  echo $agency_item; ?>">
                            <?php $agency_id = get_id_by_post_name($agency_item); echo get_the_title($agency_id); ?></option>
                <?php } ?>
            </select>
    </div>
      
</div>


	<?php while ( have_posts() ) : the_post(); ?>
        <h1 class="page-title">
            <span class="title" title="<?php the_title(); ?>"><?php the_title(); ?></span>
        </h1>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
    
	<div class="clear"></div> 
	<?php
		global $wpdb;
		$current_user_id =  get_current_user_id();
		$current_user_id_array = array();
		$user_selection_table = $wpdb->get_results( "SELECT Distinct item_id  FROM  xs_my_selection where user_id=" . $current_user_id);
		foreach ( $user_selection_table as $row ) {
			array_push($current_user_id_array, $row->item_id);}
		
	 //print_r($current_user_id_array);
    ?>
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
				endif;
				// rel = user_id _/* post_id _/* post_title _/* post_thumbnail _/* voice_talent _/* post_type _/* permalink
				$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
				$post_thumbnail_url = $post_thumbnail['0'];
				?>
       
				
            <li class="project-item <?php echo $post_cats ;?> <?php echo $post_brands ;?>  <?php echo $post_clients ;?>  <?php echo $post_agencies ;?> ">
                <script type="text/javascript">
                jQuery(document).ready(function(){
                if (jQuery.cookie('post_thumb')){
                var obj_arr = JSON.parse(jQuery.cookie("post_thumb"));
               var ids = [];
                if (obj_arr.length>0){
                for (var i =0 ; i<obj_arr.length; i++)
                    ids.push(obj_arr[i].id);
                }
               if($.inArray('<?php echo $post->ID; ?>',ids)!== -1)
                   {
                    $("#add_item_<?php echo $post->ID; ?>").css("display","none");
                    $("#remove_item_<?php echo $post->ID; ?>").css("display","block");
                    }
                }
                    })
                </script>
            
<a id="add_item_<?php echo $post->ID; ?>"  class="selection-button add-to-selection" 
rel="<?php echo get_current_user_id().'_/*'.$post->ID.'_/*'.get_the_title().'_/*'.$post_thumbnail_url.'_/*null_/*video_/*'.get_permalink($post->ID); ?>"><b><span class="icons"></span><label>Add to My Selection</label></b></a>
<a id="remove_item_<?php echo $post->ID; ?>" class="selection-button remove-from-selection" 
rel="<?php echo get_current_user_id().'_/*'.$post->ID.'_/*'.get_the_title().'_/*'.$post_thumbnail_url.'_/*null_/*video_/*'.get_permalink($post->ID); ?>"><b><span class="icons"></span><label>Remove from My Selection</label></b></a>


                <a class="post_link" href="<?php the_permalink(); ?>">
                	<span>
						<?php if ( has_post_thumbnail() ) { echo get_the_post_thumbnail($page->ID, 'thumbnail', array('class' => 'thumbnail'));} ?>
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

       
        $('select').change(function () {
              
           
           
                var vall = $(this).val();

                $('select').find("option").removeClass('selected');
                var ss=$(this).find("option[value='"+vall+"']").addClass('selected');

                
            // don't proceed if already selected
            if ($(this).hasClass('selected')) {
                return;
            }
           // $this.addClass('selected');
            var $optionSet = $(this).closest('.option-set');
          
            // change selected class
            //$this.siblings().removeClass('selected');
           // $this.addClass('selected');

            // store filter value in object
            // i.e. filters.color = 'red'
            var group = $optionSet.attr('data-filter-group');
           
            filters[group] = $optionSet.attr('value');
           
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
                $(this).find('a.selection-button').stop().animate({top:'0px'}, 300);
            }, function () {
                $(this).find('a.selection-button').stop().animate({top:'-36px'}, 300);
            });
            $("#showcase-container>li>a.selection-button").hover(function () {
                $(this).find('label').stop().fadeIn(150);
            }, function () {
                $(this).find('label').stop().fadeOut(150);
            });
            $(".mainfilter").hover(function () {
                $(this).find('ul').stop().slideDown(150);
            }, function () {
                $(this).find('ul').stop().slideUp(150);
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
</div>
<?php get_footer(); ?>