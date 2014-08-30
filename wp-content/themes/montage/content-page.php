<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
 <script src="https://maps.googleapis.com/maps/api/js"></script>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/src/jquery.validation.js"></script>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/src/main.js"></script>
 <script type="text/javascript">
     function initialize() {
    var myLatlng = new google.maps.LatLng(25.107892,55.197865);
  var mapOptions = {
  zoom: 12,
  center: myLatlng,
  mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

var marker = new google.maps.Marker({
  position: myLatlng,
  map: map,
  title: 'Montage'
 });
}

google.maps.event.addDomListener(window, 'load', initialize);
      function initialize_2() {
        var myLatlng = new google.maps.LatLng(33.87372,35.517359);
  var mapOptions = {
  zoom: 12,
  center: myLatlng,
  mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('map_canvas_2'), mapOptions);

var marker = new google.maps.Marker({
  position: myLatlng,
  map: map,
  title: 'Montage'
 });
      }
      google.maps.event.addDomListener(window, 'load', initialize_2);
      $(document).ready(function(){
               $('#add,#add-2,#map_canvas,#map_canvas_2,.wrapper-form').bind('inview', function(event, visible) {
      if (visible) {
        $(this).stop().animate({ opacity: 1 });
      } else {
        $(this).stop().animate({ opacity: 0 });
      }
    });

      })

</script>
    <?php the_content(); ?>