/*projects list*/
(function($){
   $.fn.jProjectsList = function(options){
	   
	var options = $.extend({
		selected: 0
	},options);

	return this.each(function() {            
		var hndl = this;
		
		$(this).addClass("jDropDown");
		this.ul = $(this).find("ul");
		this.li_list = this.ul.find("li");
		this.div = $(this).find("div");
		this.par = $(this).find("p");
		
		//init
		//this.par.text(this.ul.find("li:eq(" + options.selected + ")").text());
		
		this.close = function(){
			hndl.ul.hide();
		};
				
		//click
		this.div.click(function(e){
			e.stopPropagation();
			if(hndl.ul.is(":visible")){
				hndl.close();
			}
			else{
				hndl.ul.show();				
			}
		});
		
		$(document).click(function(){
			hndl.close();
		});
		
	});    
   };
})(jQuery);

function set_menu_current(id){
	$(".project-menu li").each(function(){
		var cid = $(this).attr("id").replace("-li", "");
		if(cid == id){
			$(this).addClass("current");
		}
		else{
			$(this).removeClass("current");
		}
	});
}

$("document").ready(function(){
	//project-dd-list
	$("#project-dd-list").jProjectsList({selected: 0});
});
