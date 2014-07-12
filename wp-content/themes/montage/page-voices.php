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

get_header(); ?>
<section class="player-container">
	<div class="wrapper">
    <?php
	$voice_query = new WP_Query(array('post_type' => 'voice'));
		if ( $voice_query->have_posts() ) :
			while ( $voice_query->have_posts() ) : $voice_query->the_post();
				$voice_url = get_field('voice_url');
				$talents = get_field('talent');
                 ?>				                
                <div class="player_item post<?php echo $post->ID; ?>">
                	<label class="voice_title"><?php the_title(); ?> <em>by <?php foreach($talents as $talent){echo get_the_title($talent); } ?></em></label>
                	<a href="<?php echo $voice_url; ?>" class="sc-player"></a>
                </div>
                <?php 
			endwhile;
		else :
			echo wpautop( 'Sorry, no voices were found.' );
		endif; ?>
    </div>
</section>
        
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/isotope.css" />
<style>
.isotope .isotope-item {
  /* multiple -vendor declarations omited for brevity */
  transition-property: left, top, opacity;
}
.isotope .isotope-item {
  transition-delay: 0s, 0.8s, 0s;
}
</style>
  <script type="text/javascript">
    $(document).ready(function() {
        $("select").selectOrDie();
    })
    
    </script>
<div class="wrapper relative clear voices-page" style="min-height:340px;">

 
	<?php while ( have_posts() ) : the_post(); ?>
        <h1 class="page-title">
            <span class="title" title="<?php the_title(); ?>"><?php the_title(); ?></span>
        </h1>
        <div class="helper-color"><span class="label label-selected">Selected</span><span class="label label-played">Played</span><span class="label label-now">Playing Now</span></div>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. 
	// if it is the Voices page, then query the voice list below
	$voice_query = new WP_Query(array('post_type' => 'voice'));
	 
		if ( $voice_query->have_posts() ) :?>
	<div class="clear"></div>
    
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sc-player-minimal.css" type="text/css" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/soundcloud.player.api.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/sc-player.js"></script>
    <div class="clear space10"></div>
       <div id="filter-form" >  
    <div class="preview" class="mainfilter">  
            <select data-custom-id="custom" data-custom-class="custom" data-filter-group="language" class="subfilter option-set clearfix cats ">
                <option id="#all-languages" data-filter-value="" class="selected all" value="">All Languages</option>
                    <?php 
                 $languages = get_terms("language");
                 $lang_count = count($languages);
                 if ( $lang_count > 0 ){
                     foreach ( $languages as $language) {?>
                <option id="#<?php  echo $language->slug; ?>" data-filter-value=".<?php  echo $language->slug; ?>" value=".<?php  echo $language->slug; ?>" >
                        <?php echo $language->name;?></option>
                <?php } } ?>
               
            </select>
    </div>
       <div class="preview">  
            <select data-custom-id="custom" data-custom-class="custom" data-filter-group="accent"  class="subfilter option-set clearfix">
                <option id="#all-accents" data-filter-value="" class="selected all" value="">All Accents</option>
                           <?php 
                 $accents = get_terms("accent");
                 $accent_count = count($accents);
                 if ( $accent_count > 0 ){
                     foreach ( $accents as $accent) {?>
                <option  id="#<?php  echo $accent->slug; ?>" data-filter-value=".<?php  echo $accent->slug; ?>" value=".<?php  echo $accent->slug; ?>">
                        <?php echo $accent->name;?></option>
                <?php } } ?>
            </select>
    </div>
    <div class="preview">   
            <select data-custom-id="custom" data-custom-class="custom" data-filter-group="gender"  class="subfilter option-set clearfix">
                <option id="#all-genders" data-filter-value="" class="selected all" value="">All Genders</option>
                  <?php 
                 $genders = get_terms("voice_gender");
                 $gender_count = count($genders);
                 if ( $gender_count > 0 ){
                     foreach ( $genders as $gender) {?>
                <option id="#<?php  echo $gender->slug; ?>" data-filter-value=".<?php  echo $gender->slug; ?>" value=".<?php  echo $gender->slug; ?>"> 
                        <?php echo $gender->name; ?></option>
                <?php } } ?>
            </select>
    </div>
    <div class="preview">  
            <select data-custom-id="custom" data-custom-class="custom" data-filter-group="agency"  class="subfilter option-set">
                <option id="#all-brackets" data-filter-value="" class="selected all" value="">All Age Brackets</option>
                    <?php 
                 $brackets = get_terms("age_bracket");
                 $bracket_count = count($brackets);
                 if ( $bracket_count > 0 ){
                     foreach ( $brackets as $bracket) {?>
                <option id="#<?php  echo $bracket->slug; ?>" data-filter-value=".<?php  echo $bracket->slug; ?>" value=".<?php  echo $bracket->slug; ?>">
                        <?php echo $bracket->name; ?></option>
                <?php } } ?>
            </select>
    </div>
      
</div>
    <div class="clear space25"></div>
    <div class="voice_list_header">
        <div class="selection_status">&nbsp;</div>
        <div class="play_btn">&nbsp;</div>
        <div class="voice_title">
            <a id="sort_name_asc" class="up">Voice Title<span class="icons"></span></a>
            <a id="sort_name_desc" class="down">Voice Title<span class="icons"></span></a>
        </div>
        <div class="talent_name">
            <a id="sort_price_asc" class="up">Talent Name<span class="icons"></span></a>
            <a id="sort_price_desc" class="down">Talent Name<span class="icons"></span></a>
        </div>
        <div class="tonality_list">Tonalities</div>
        <div class="language_list">Languages</div>
        <div class="accent_list">Accents</div>
        <div class="age_list">Age Brackets</div>
        <div class="gender_list">Gender</div>               
    </div>
	<?php
		global $wpdb;
		$current_user_id =  get_current_user_id();
		$current_user_id_array = array();
		$user_selection_table = $wpdb->get_results( "SELECT Distinct item_id  FROM  xs_my_selection where user_id=" . $current_user_id);
		foreach ( $user_selection_table as $row ) {
			array_push($current_user_id_array, $row->item_id);}
		
	 //print_r($current_user_id_array);
    ?>
    <!-- list -->
    <ul class="voice_list" id="voice_list">
<?php 
			while ( $voice_query->have_posts() ) : $voice_query->the_post();
				$talents = get_field('talent');	
				$post_tonalities = '';
				$post_languages = '';
				$post_accents = '';
				$post_voice_genders = '';
				$post_talents = '';
				
				$tonalities = get_the_terms( $post->ID , 'tonality' );
				$languages = get_the_terms( $post->ID , 'language' );
				$accents = get_the_terms( $post->ID , 'accent' );
				$age_brackets = get_the_terms( $post->ID , 'age_bracket' );
				$voice_genders = get_the_terms( $post->ID , 'voice_gender' );
				
				foreach ( $tonalities as $tonality) { 
					$post_tonalities .= $tonality->slug.' '; } 
				foreach ( $languages as $language) { 
					$post_languages .= $language->slug.' '; }
                foreach ( $accents as $accent) { 
					$post_accents .= $accent->slug.' '; }
                foreach ( $age_brackets as $age_bracket) { 
					$post_age_brackets .= $age_bracket->slug.' '; }
                foreach ( $voice_genders as $voice_gender) { 
					$post_voice_genders .= $voice_gender->slug.' '; }
                if($talents){foreach($talents as $talent){ 
					$post_talents .= basename( get_permalink($talent) ).' '; }};
					
				// rel = user_id _/* post_id _/* post_title _/* post_thumbnail _/* voice_talent _/* post_type _/* permalink
				
				 ?>
                    
		<li class="voice_item <?php echo $post_tonalities ;?> <?php echo $post_languages ;?> <?php echo $post_accents ;?> <?php echo $post_age_brackets ;?> <?php echo $post_voice_genders ;?> <?php echo $post_talents ;?>">
            <div class="inner">
                <div class="selection_status">
                <?php if($talents){
                         foreach($talents as $talent){
							 	$talent_name = get_the_title($talent); ?>
                    <?php } } ?>
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
                    $("#add_item_<?php echo $post->ID; ?>").parents('.voice_item').addClass('selected');
                    }
                }
                    })
                </script>

                
<a id="add_item_<?php echo $post->ID; ?>" title="Add to My Selection" class="selection-button add-to-selection add icons" 
rel="<?php echo get_current_user_id().'_/*'.$post->ID.'_/*'.get_the_title().'_/*null_/*'.$talent_name.'_/*voice_/*'.get_permalink(10); ?>"></a>
<a id="remove_item_<?php echo $post->ID; ?>" title="Remove from My Selection" class="selection-button remove-from-selection add icons" 
rel="<?php echo get_current_user_id().'_/*'.$post->ID.'_/*'.get_the_title().'_/*null_/*'.$talent_name.'_/*voice_/*'.get_permalink(10); ?>"></a>

					
                </div>
                <div class="play_btn"><a class="post<?php the_id(); ?>"></a></div>
                <div class="voice_title">
					<?php the_title(); ?>
                </div>
                <div class="talent_name filterable">
					<?php if($talents){
                         foreach($talents as $talent){
							 	echo '<a class="'. $post_talents .'" data-filter-value=".'. $post_talents .'">'.get_the_title($talent).'</a> <em>('. $talent->ID .'</em>)'; ?>
                    <?php } } ?>
                </div>
                <div class="tonality_list filterable">
                    <?php 
						if ($tonalities){
							foreach ( $tonalities as $tonality ) {
								echo '<a class="'. $tonality->slug .'" data-filter-value=".'. $tonality->slug .'">'.$tonality->name.'</a> ';
							}
						}
					?>
                </div>
                <div class="language_list filterable">
                	<?php 
						if ($languages){
							foreach ( $languages as $language ) {
								echo '<a class="'. $language->slug .'" data-filter-value=".'. $language->slug .'">'.$language->name.'</a> ';
							}
						}
					?>
                </div>
                <div class="accent_list filterable">
                    <?php 
						if ($accents){
							foreach ( $accents as $accent ) {
								echo '<a class="'. $accent->slug .'" data-filter-value=".'. $accent->slug .'">'.$accent->name.'</a> ';
							}
						}
					?>   
                </div>
                <div class="age_list filterable">
                    <?php 
						if ($age_brackets){
							foreach ( $age_brackets as $age_bracket ) {
								echo '<a class="'. $age_bracket->slug .'" data-filter-value=".'. $age_bracket->slug .'">'.$age_bracket->name.'</a> ';
							}
						}
					?>     
                </div>
                <div class="gender_list filterable">
                    <?php 
						if ($voice_genders){
							foreach ( $voice_genders as $voice_gender ) {
								echo '<a class="'. $voice_gender->slug .'" data-filter-value=".'. $voice_gender->slug .'">'.$voice_gender->name.'</a> ';
							}
						}
					?>    
                </div>               
                <div class="clear"></div>
            </div>
		</li>
                <?php 
			endwhile;
		else :
			echo wpautop( 'Voices will be available soon.' );
		endif;
?>
	
                </ul>
    <div class="clear space25"></div>
    
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.isotope.min.js"></script>
<script>
    $(function () {

        var $container = $('#voice_list'),
        filters = {};

        $container.isotope({
            itemSelector: '.voice_item',
            masonry: {
                columnWidth: 3
            },
  			transformsEnabled: false

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
        // filter buttons

    });
</script>
	<script language="javascript">	

		<?php $voice_id = $_GET['v_id'];
        echo 'idddd='.$_GET['page_id'];
			if($voice_id){ ?>
                
			$(window).load(function () {
				$('.player-container').slideDown(500);
				$('.player_item').fadeOut();
				$('.player_item.post' + <?php echo $voice_id; ?>).delay(500).fadeIn();		
			});			
	<?php } ?>
						
        $(document).ready(function () {
			
			$('#voice_list .play_btn a').click(function () {
				$('.player-container').slideDown(500);
				var btn_class = $(this).attr('class');
				$('.player_item').fadeOut();
				$('.player_item.' + btn_class).delay(500).fadeIn();
			});
			
			$('.voice_list_header>div a.up').click(function () {
				$(this).css({display:"none"});
				$(this).parent().find('.down').css({display:"inline-block"});
			});
			$('.voice_list_header>div a.down').click(function () {
				$(this).css({display:"none"});
				$(this).parent().find('.up').css({display:"inline-block"});
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

            ////////////////////////////
            $('body').on('click','.play_btn',function(){
                if($(this).parents('li').siblings().hasClass('now-playing')){
                    var ss = $('li.now-playing');
                    console.log(ss);
                    ss.removeClass('now-playing');
                    ss.addClass('played');
                }else{
                $(this).parents('li').addClass('now-playing');
               
                }
            })
              $('body').on('click','.selection-button.add-to-selection',function(){
                $(this).parents('li').toggleClass('selected');
            })
              $('body').on('click','.selection-button.remove-from-selection',function(){
                $(this).parents('li').removeClass('selected');
            })
            
        });

    </script>
    </div>
<?php get_footer(); ?>