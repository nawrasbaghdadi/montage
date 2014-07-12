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
    <script>
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
    
        <h1 class="page-title">
            <span class="title" title="<?php the_title(); ?>"><?php the_title(); ?></span>
        </h1>
        <div class="address right" id="add">
        	<div class="pull-right left-txt">
          	<h4><i class="fa fa-university"></i> DUBAI</h4>
          	<p><i class="fa fa-phone"></i> :+971		4	453	4295 </p>
          	<p><i class="fa fa-mobile"></i>  :+971	5	0	454	5946 </p>
          	<p><i class="fa fa-phone-square"></i> :+971		4	453	4296 </p>
          </div>
         <div id="map_canvas"></div>
          
      </div>
        <div class="address left" id="add-2">
         <div id="map_canvas_2"></div>
          <div class="pull-right">
          	<h4><i class="fa fa-tree"></i> BEIRUT</h4>
          	<p><i class="fa fa-phone"></i> :+961   1  387701 </p>
          	<p><i class="fa fa-mobile"></i> :+961 71  817080 </p>
          </div>
      </div>

    <div class="wrapper-form">
      <div class="form-header">
        <div class="fa fa-paper-plane"></div>
        <h1>Keep In Touch</h1>
      </div>
      <form class="form animate-form" id="form" onsubmit="return false;">
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="username">Name</label>
          <div class="input-group-addon">
            <i class="fa fa-user"></i>
          </div>
          <input class="form-control" id="username" name="username" placeholder="Username" type="text">
          <span class="glyphicon glyphicon-ok form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="email">Email address</label>
          <div class="input-group-addon">
            <i class="fa fa-envelope"></i>
          </div>
          <input class="form-control" id="email" name="email" placeholder="Email address" type="text"><span class="glyphicon glyphicon-ok form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label sr-only">your Massage</label>
          <div class="input-group-addon">
          </div>
          <textarea class="form-control text-area" placeholder="Your Massage"></textarea>
          
        </div>
        <div class="form-group submit">
          <input class="btn btn-lg" type="submit" value="SEND">
        </div>
      </form>
    </div>
    <?php the_content(); ?>