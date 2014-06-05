<script type="text/javascript">
	$(document).ready(function () {
		//making Showcase as selected on the menu.
		$(".menu-item-21").addClass("current-menu-item");
	});
</script>
	<?php 
		$category_list =array();
		$brand_list =array();
		$client_list =array();
		$agency_list =array();
		$categorylist = get_the_category();	
		$brandlist = get_field('brands');		
		$clientlist = get_field('client');		
		$agencylist = get_field('agency');
		$post_cats = '';
		$post_brands = '';
		$post_clients = '';
		$post_agencies = '';
		
		$video_id = get_field('video_id');
		$summary = get_field('summary');
		$offline_editor = get_field('offline_editor');
		$online_editor = get_field('online_editor');
		$editor = get_field('editor');
		$post_production_vfx = get_field('post_production_vfx');
		$editorial_concept = get_field('editorial_concept');
		$three_d_artist = get_field('3d_artist');
		$two_d_lead_artist = get_field('2d_lead_artist');
		$two_d_artist = get_field('2d_artist');
		$sound_design = get_field('sound_design');	
		$compositing_smoke_artist = get_field('compositing_smoke_artist');	
		$grading = get_field('grading');	
		$post_supervision = get_field('post_supervision');	
		$credits_details = get_field('credits_details');
		
		?>
		<?php
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
			$category_list = array_unique($category_list);
			$brand_list = array_unique($brand_list);
			$client_list = array_unique($client_list);
			$agency_list = array_unique($agency_list);
			?> 

<div class="wrapper relative clear showcase-details-page" style="min-height:340px;">
    <h1 class="page-title-inside" title="<?php the_title(); ?>">
        <?php the_title(); ?>
    </h1>
    <h2 class="sub-title-inside">
		<?php if($client_list){ foreach($client_list as $client_item){ ?>
            <?php $client_id = get_id_by_post_name($client_item); echo get_the_title($client_id); ?>
        <?php } } ?>
    </h2>
    <div class="cols-container">
	<?php
		global $wpdb;
		$current_user_id =  get_current_user_id();
		$current_user_id_array = array();
		$user_selection_table = $wpdb->get_results( "SELECT Distinct item_id  FROM  xs_my_selection where user_id=" . $current_user_id);
		foreach ( $user_selection_table as $row ) {
			array_push($current_user_id_array, $row->item_id);}
		
	 //print_r($current_user_id_array);
	// rel = user_id _/* post_id _/* post_title _/* post_thumbnail _/* voice_talent _/* post_type _/* permalink
	$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
	$post_thumbnail_url = $post_thumbnail['0'];
    ?>
	<?php  if (in_array($post->ID, $current_user_id_array)) { ?>
    
<a id="add_item_<?php echo $post->ID; ?>" class="selection-button add-to-selection" 
rel="<?php echo get_current_user_id().'_/*'.$post->ID.'_/*'.get_the_title().'_/*'.$post_thumbnail_url.'_/*null_/*video_/*'.get_permalink($post->ID); ?>" style="display:none;"><span class="icons"></span>Add to My Selection</a>
<a id="remove_item_<?php echo $post->ID; ?>" class="selection-button remove-from-selection" 
rel="<?php echo get_current_user_id().'_/*'.$post->ID.'_/*'.get_the_title().'_/*'.$post_thumbnail_url.'_/*null_/*video_/*'.get_permalink($post->ID); ?>" style="display:block;"><span class="icons"></span>Remove from My Selection</a>

	<?php  } else{ ?>

<a id="add_item_<?php echo $post->ID; ?>" class="selection-button add-to-selection" 
rel="<?php echo get_current_user_id().'_/*'.$post->ID.'_/*'.get_the_title().'_/*'.$post_thumbnail_url.'_/*null_/*video_/*'.get_permalink($post->ID); ?>"><span class="icons"></span>Add to My Selection</a>
<a id="remove_item_<?php echo $post->ID; ?>" class="selection-button remove-from-selection" 
rel="<?php echo get_current_user_id().'_/*'.$post->ID.'_/*'.get_the_title().'_/*'.$post_thumbnail_url.'_/*null_/*video_/*'.get_permalink($post->ID); ?>"><span class="icons"></span>Remove from My Selection</a>

    <?php  } ?>
        <div class="col1">
            <iframe src="http://player.vimeo.com/video/<?php if($video_id){echo $video_id;} ?>?title=0&amp;byline=0&amp;portrait=0" width="720" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                <br />
            <ul class="info-tabs">
                <li id="#video_summary">Summary</li>
                <li id="#video_credits">Credits</li>
            </ul>
            <ul class="info-tabs-content">
                <li id="video_summary">
                    <?php if($summary){ ?><?php echo $summary; ?><?php } ?>
                </li>
                <li id="video_credits">            	
                    <?php if($offline_editor){ ?><div class="row"><label>Offline Editor: </label><div><?php echo $offline_editor; ?></div></div><?php } ?>
                    <?php if($online_editor){ ?><div class="row"><label>Online Editor: </label><div><?php echo $online_editor; ?></div></div><?php } ?>
                    <?php if($editor){ ?><div class="row"><label>Editor: </label><div><?php echo $editor; ?></div></div><?php } ?>
                    <?php if($post_production_vfx){ ?><div class="row"><label>Post Production VFX: </label><div><?php echo $post_production_vfx; ?></div></div><?php } ?>
                    <?php if($editorial_concept){ ?><div class="row"><label>Editorial Concept: </label><div><?php echo $editorial_concept; ?></div></div><?php } ?>
                    <?php if($three_d_artist){ ?><div class="row"><label>3D Artist: </label><div><?php echo $three_d_artist; ?></div></div><?php } ?>
                    <?php if($two_d_lead_artist){ ?><div class="row"><label>2D Lead Artist: </label><div><?php echo $two_d_lead_artist; ?></div></div><?php } ?>
                    <?php if($two_d_artist){ ?><div class="row"><label>2D Artist: </label><div><?php echo $two_d_artist; ?></div></div><?php } ?>
                    <?php if($sound_design){ ?><div class="row"><label>Sound Design: </label><div><?php echo $sound_design; ?></div></div><?php } ?>
                    <?php if($compositing_smoke_artist){ ?><div class="row"><label>Compositing Smoke Artist: </label><div><?php echo $compositing_smoke_artist; ?></div></div><?php } ?>
                    <?php if($grading){ ?><div class="row"><label>Grading:</label><div><?php echo $grading; ?></div></div><?php } ?>
                    <?php if($post_supervision){ ?><div class="row"><label>Post Supervision: </label><div><?php echo $post_supervision; ?></div></div><?php } ?>
                    <?php if($credits_details){ ?><div class="row"><label>Credit Details: </label><div><?php echo $credits_details; ?></div></div><?php } ?>
                </li>
            </ul>
                    <?php if ( comments_open() ) : ?>
                        <div class="leave-a-reply">
                            <?php comments_popup_link( '<span class="icon"></span>' . __( 'Leave a reply', 'twentytwelve' ) . '', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
                        </div><!-- .comments-link -->
                    <?php endif; // comments_open() ?>
					<?php comments_template( '', true ); ?>
        </div>
        <div class="col2">
        	<section class="project-information">
            	<h1>Project Information</h1>
                <?php if($agency_list){ ?>
                    <div class="row">
                        <label>Agency</label>
                        <div>
                            <?php foreach($agency_list as $agency_item){ ?>
                                <?php $agency_id = get_id_by_post_name($agency_item); echo get_the_title($agency_id); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if($client_list){ ?>
                    <div class="row">
                        <label>Client</label>
                        <div>
                            <?php foreach($client_list as $client_item){ ?>
                                <?php $client_id = get_id_by_post_name($client_item); echo get_the_title($client_id); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if($client_list){ ?>
                    <div class="row">
                        <label>Brand</label>
                        <div>
                            <?php foreach($brand_list as $brand_item){ ?>
                                <?php $brand_id = get_id_by_post_name($brand_item); echo get_the_title($brand_id); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </section>
        	<section>
            	<h1>Share This Page</h1>
                <?php $this_page_id = get_the_ID(); //echo $this_page_id; ?>               
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.share.js"></script>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.share.css" type="text/css" media="screen" />
				<script type="text/javascript">            
                    $(document).ready(function () {
                             $('#sharelinks').share({
                                networks: ['facebook','twitter','pinterest','googleplus','linkedin','tumblr','digg','email'],
                                theme: 'square'
                            });            
                    });
                </script>            
                <div id="sharelinks"></div>
            </section>
        	<section class="topic-list category-list">
            	<h1>Related Categories</h1>
                <ul> 
                <?php 
					 $postcategories= get_the_category(); 
					foreach($postcategories as $postcategory)
					{ ?>
                        <li><a href="<?php  echo get_category_link($postcategory->term_id); ?>" id="<?php  echo $postcategory->term_id; ?>"><?php echo $postcategory->name;?></a></li>
               		<?php
                    }					
				?>
                </ul>
                <div class="clear"></div>
            </section>
        	<section class="topic-list tag-list">
            	<h1>Related Tags</h1>
					<?php
						$posttags = get_the_tags(); 
						if ($posttags) {?>
                            <ul> 
								<?php
                                  foreach($posttags as $posttag) { ?>
                                    <li><a href="<?php  echo get_tag_link($posttag->term_id); ?>" id="<?php echo $posttag->term_id; ?>"><?php echo $posttag->name; ?></a></li> 
                                  <?php }?>
                            </ul> 
                        <?php
						}
						else
						{
							echo '<span class="no-topics">no related tags.</span>';
						}
					?>
                </ul>
        		<div class="clear"></div>
            </section>
        </div>
        <div class="clear"></div>
    </div>
    
    <script type="text/javascript">

        $(document).ready(function () {

            //Default Action
            $(".info-tabs-content li").hide(); //Hide all content
            $("ul.info-tabs li:first").removeClass().addClass("active").show(); //Activate first tab
            //$("ul.info-tabs li:first span").fadeIn(); //Fade in the span
            $(".info-tabs-content li:first").show(); //Show first tab content

            //On Click Event
            $("ul.info-tabs li").click(function () {
                $("ul.info-tabs li").removeClass(); //Remove any "active" class
                //$("ul.info-tabs li span").fadeOut(); //Fade out the span
                $(this).removeClass().addClass("active"); //Add "active" class to selected tab
                //$(this).find('span').fadeIn(); //Fade in the span
                $(".info-tabs-content li").hide(); //Hide all tab content
                var activeTab = $(this).attr("id"); //Find the rel attribute value to identify the active tab + content
                $(activeTab).fadeIn(); //Fade in the active content
                return false;
            });

        });
    </script>
    <div class="clear"></div>
</div>
