var title = [];
var type = [];
var thumbnails = [];
window.renderselected = function(obj){
		
			$(".my-selection-container .inside .ul_inside li.no-items-found").fadeOut();					
					$('.my-selection-container .trigger').stop().animate({backgroundColor:'#77b900',color:"#ffffff"}, 300);
			
				if(obj.type=='voice'){
						$(".my-selection-container #voices  .jspPane  .ul_inside")
.prepend("<li id='item-"+obj.id+"' class='voice'><a class='permalink' href='"+obj.link+"?v_id="+obj.id+"'>"+obj.title+"</a><em>bysss </em> </li>");
					}else{
					$(".my-selection-container  #videos .jspPane  .ul_inside")
	.prepend("<li  id='item-"+obj.id+"' class='video'><a class='permalink' href='"+obj.link+"'><img src='"+obj.thumb+"' /><label>"+obj.title+"</label></a><a class='selection-button remove-from-selection icons' rel='_/*"+obj.id+"' title='Remove from My Selection'></a></li>");
					}

		
	}
jQuery(window).load(function ($) {
	var current_user_id = jQuery('input#current_user_id').val();

	if (jQuery.cookie('post_thumb')){
		thumbnails = JSON.parse(jQuery.cookie('post_thumb'));
		for (var i =0 ; i<thumbnails.length; i++)
			renderselected(thumbnails[i]);
	}
	
    jQuery(".add-to-selection").on('click', function(){
		
		if(getCookie("status") == "guest"){
			
			
			// rel = user_id _/* post_id _/* post_title _/* post_thumbnail _/* voice_talent _/* post_type _/* permalink _/* row_id
			var user_item_ids = jQuery(this).attr("rel");
			
			var array_user_item_ids=user_item_ids.split("_/*");
			var user_id = array_user_item_ids[0];
			var item_id = array_user_item_ids[1];
			var post_title = array_user_item_ids[2];
			
			var post_thumbnail = array_user_item_ids[3];
			var voice_talent = array_user_item_ids[4];
			var item_type = array_user_item_ids[5];
			var item_permalink = array_user_item_ids[6];
			var postObj = {'thumb': post_thumbnail, 'type': item_type , 'link': item_permalink, 'title':post_title, 'id':item_id};
			thumbnails.push(postObj);
			jQuery.cookie("post_thumb",JSON.stringify(thumbnails));
			renderselected(postObj);
			jQuery('.my-selection-container').animate({right:'0'}, 500);
			
			if(item_type == "voice"){
				jQuery(".my-selection-container .tabs #voi").addClass('active');
				jQuery(".my-selection-container .tabs #voe").removeClass('active');
				jQuery(".my-selection-container .tabs #voices").addClass('active');
				jQuery(".my-selection-container .tabs #videos").removeClass('active');
				
			}else{
				jQuery(".my-selection-container .tabs #voe").addClass('active');
				jQuery(".my-selection-container .tabs #voi").removeClass('active');
				jQuery(".my-selection-container .tabs #videos").addClass('active');
				jQuery(".my-selection-container .tabs #voices").removeClass('active');
			}
			
			
			jQuery('#remove_item_'+item_id).css({display:'block'});
			jQuery('#add_item_'+item_id).css({display:'none'});				
			
		}else{	  
			jQuery('.notifications-container').slideDown(500).delay(3000).slideUp(500);
			jQuery('.notifications-container label').html('<span style="color:red;">Please sign in to your account in order to add items to your selection!</span>');
			
		}
		
	
	});
	 jQuery(".remove-from-selection").live("click", function() {
		 
			var user_item_ids = jQuery(this).attr("rel");
			var array_user_item_ids=user_item_ids.split("_/*");
			var user_id = array_user_item_ids[0];
			var item_id = array_user_item_ids[1];
			var post_title = array_user_item_ids[2];
			var post_thumbnail = array_user_item_ids[3];
			var voice_talent = array_user_item_ids[4];
			var item_type = array_user_item_ids[5];
			var item_permalink = array_user_item_ids[6];
			var postObj = {'thumb': post_thumbnail, 'type': item_type ,  'link': item_permalink, 'title':post_title, 'id':item_id};
			thumbnails.splice( jQuery.inArray(postObj,thumbnails) ,1 );
			jQuery.cookie("post_thumb",JSON.stringify(thumbnails));
			jQuery('.my-selection-container').animate({right:'0'}, 500);
			jQuery('.my-selection-container #item-'+item_id).css('display','none');
			jQuery('#remove_item_'+item_id).css({display:'none'});
			jQuery('#add_item_'+item_id).css({display:'block'});


	});

	});