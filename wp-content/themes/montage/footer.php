<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<section class="sitefooter">
	<div class="wrapper relative">
		<?php
           /*  $facebook = get_field("facebook", 'options');
             $twitter = get_field("twitter", 'options');
             $linkedin = get_field("linkedin", 'options'); 
             $vimeo = get_field("vimeo", 'options'); 
      
            if($twitter || $vimeo || $facebook || $linkedin){ ?>
            <div class="social-menu-container">
                <ul>
					<?php if($facebook){ ?><li><a href="<?php echo $facebook; ?>" target="_blank" class="facebook icons"></a></li><?php } ?>
                    <?php if($vimeo){ ?><li><a href="<?php echo $vimeo; ?>" target="_blank" class="vimeo icons"></a></li><?php } ?>
                    <?php if($twitter){ ?><li><a href="<?php echo $twitter; ?>" target="_blank" class="twitter icons"></a></li><?php } ?>
                    <?php if($linkedin){ ?><li><a href="<?php echo $linkedin; ?>" target="_blank" class="linkedin icons"></a></li><?php } ?>
                </ul>
            </div>
		<?php }*/ ?>
		<?php
             /*$footer_first_location_title = get_field("footer_first_location_title", 'options');
             $footer_first_location_details = get_field("footer_first_location_details", 'options');
             $footer_first_location_map = get_field("footer_first_location_map", 'options'); 
             $footer_second_location_title = get_field("footer_second_location_title", 'options');
             $footer_second_location_details = get_field("footer_second_location_details", 'options');
             $footer_second_location_map = get_field("footer_second_location_map", 'options');*/
		?>
       <!-- <section class="contact-details">
        	<div class="branch">
            	<label><?php echo $footer_first_location_title; ?></label>
                <div class="details"><?php echo $footer_first_location_details; ?></div>
                <a href="<?php echo $footer_first_location_map; ?>" class="locate clear" target="_blank">Location map<span class="icons"></span></a>
            </div>
        	<div class="branch">
            	<label><?php echo $footer_second_location_title; ?></label>
                <div class="details"><?php echo $footer_second_location_details; ?></div>
                <a href="<?php echo $footer_second_location_map; ?>" class="locate clear" target="_blank">Location map<span class="icons"></span></a>
            </div>
            <div class="clear"></div>
            <div class="email">
				<?php $footer_email = get_field("footer_email", 'options'); ?>
            	<a href="mailto:<?php echo $footer_email; ?>"><?php echo $footer_email; ?></a>
            </div>
        </section>
        <section class="contact-form"> 
            <?php if ( is_active_sidebar( 'footer_contact_form_widget' ) ) : ?>
                <?php dynamic_sidebar( 'footer_contact_form_widget' ); ?>
            <?php endif; ?>
        </section>-->
        <div class="clear"></div>
        
        <section class="montage-signature">
            <a href="http://www.montage-me.com" target="_blank">&copy; <script>document.write(year); </script> Montage. All Rights Reserved.
            	
        </section>
        <div class="clear"></div>
    </div>
</section>
<?php wp_footer(); ?>
</body>
</html>