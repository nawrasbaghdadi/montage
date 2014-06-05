		<?php
		
		 if ((!is_404()) && (have_posts())){	?>
        	<section class="share-buttons">
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
		<?php } ?>
        	<section class="topic-list category-list">
            	<h1>Category List</h1>
                <ul> 
                	<li>
                    	<a href="<?php echo get_permalink(12); ?>">All Categories <span>(<?php echo wp_count_posts()->publish; ?>)</span></a>
                    </li>
                <?php
					$categories = get_categories();
					foreach ($categories as $cat) { ?>
                    	<li><a href="<?php echo get_category_link( $cat->term_id ); ?>" <?php if ($cat->category_parent!=0) { echo ' class="sub-cat"';} ?>
                        		<?php if ($cat->category_description != '') { echo ' title = "' . $cat->category_description . '"';} ?>>                    
			                    <?php echo $cat->cat_name.' <span>('.$cat->category_count.')</span>';?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="clear"></div>
            </section>
        	<section class="topic-list tag-list">
            	<h1>Tags List</h1>
					<?php
						$posttags = get_tags(); 
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