jQuery(document).ready(function ($) {
	//var site_url =  'http://xpert-online.com/xpertlb/montage';
	var site_url =  'http://www.montage-me.com';
	//var site_url = 'http://localhost/montage';
	/// var post_id for video id
	/// vsr user_id for user
	
    //var greeting = jQuery("#greeting").val();
	//var greeting = jQuery('#comp_type :selected').val();
	
	var current_user_id = jQuery('input#current_user_id').val();

	
    
		

    jQuery(".add-to-selection").click(function(){
		//alert(getCookie("status"));
		if(getCookie("status") == "user"){
			
			//alert(jQuery(this).attr('class'));
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
			//alert(item_permalink);
			
			jQuery('#remove_item_'+item_id).css({display:'block'});
			jQuery('#add_item_'+item_id).css({display:'none'});				
			
			jQuery.ajax({
				type: 'GET',
				url: site_url + '/wp-admin/admin-ajax.php',
				data: {
					action: 'addtoselection',
					userid: user_id,
					itemid: item_id,
					
				},
				success: function(data, textStatus, XMLHttpRequest){	
					//jQuery(".my-selection-container .inside .ul_inside").html('');
					jQuery(".my-selection-container .inside .ul_inside li.no-items-found").fadeOut();
					//jQuery(".my-selection-container .inside .ul_inside").append(data);		  
					jQuery('.notifications-container').slideDown(500).delay(2000).slideUp(500);
					jQuery('.notifications-container label').html('Item added to My Selection successfully.'); 
					jQuery('.my-selection-container').animate({right:'0'}, 500);
					jQuery('.my-selection-container .trigger').stop().animate({backgroundColor:'#77b900',color:"#ffffff"}, 300);
					if(item_type=='voice'){
						jQuery(".my-selection-container .inside ul.ul_inside")
.prepend("<li style='display:none;' id='item-"+user_id+"-"+item_id+"' class='voice'><a class='permalink' href='"+item_permalink+"?v_id="+item_id+"'>"+post_title+"</a><em>by "+voice_talent+"</em> <a class='selection-button remove-from-selection icons' rel='"+user_id+"_/*"+item_id+"' title='Remove from My Selection'></a></li>");
					}else{
						jQuery(".my-selection-container .inside ul.ul_inside")
.prepend("<li style='display:none;' id='item-"+user_id+"-"+item_id+"' class='video'><a class='permalink' href='"+item_permalink+"'><img src='"+post_thumbnail+"' /><label>"+post_title+"</label></a><a class='selection-button remove-from-selection icons' rel='"+user_id+"_/*"+item_id+"' title='Remove from My Selection'></a></li>");
					}

					jQuery(".my-selection-container .inside ul.ul_inside li#item-"+user_id+"-"+item_id).slideDown()				   
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					
				}
			});
		}else{	  
			jQuery('.notifications-container').slideDown(500).delay(3000).slideUp(500);
			jQuery('.notifications-container label').html('<span style="color:red;">Please sign in to your account in order to add items to your selection!</span>');
			
		}
		
	
	});
	 jQuery(".remove-from-selection").live("click", function() {
		 
			//alert(jQuery(this).attr('class'));
			// rel = user_id _/* post_id _/* post_title _/* post_thumbnail _/* voice_talent _/* post_type _/* permalink _/* row_id
			var user_item_ids = jQuery(this).attr("rel");
			var array_user_item_ids=user_item_ids.split("_/*");
			var user_id = array_user_item_ids[0];
			var item_id = array_user_item_ids[1];
			var post_title = array_user_item_ids[2];
			var post_thumbnail = array_user_item_ids[3];
			var voice_talent = array_user_item_ids[4];
			var item_type = array_user_item_ids[5];
			
			jQuery('#remove_item_'+item_id).css({display:'none'});
			jQuery('#add_item_'+item_id).css({display:'block'});
			
				jQuery.ajax({
					type: 'GET',
					url: site_url + '/wp-admin/admin-ajax.php',
					data: {
						action: 'removefromselection',
						userid: user_id,
						itemid: item_id,
						
					},
					success: function(data, textStatus, XMLHttpRequest){	
					//jQuery(".my-selection-container .inside .ul_inside").html('');
					//jQuery(".my-selection-container .inside .ul_inside").append(data);		  
					jQuery('.notifications-container').slideDown(500).delay(2000).slideUp(500);
					jQuery('.notifications-container label').html('<span style="color:red;">Item removed from My Selection successfully.</span>');	
					jQuery('.my-selection-container').animate({right:'0'}, 500);
					jQuery('.my-selection-container .trigger').stop().animate({backgroundColor:'#77b900',color:"#ffffff"}, 300);	
					jQuery(".my-selection-container .inside ul.ul_inside li#item-"+user_id+"-"+item_id).remove()				   
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						
					}
				});
	});

	});