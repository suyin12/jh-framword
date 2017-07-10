jQuery(document).ready(function($){

	// for magic search label
	search_input = "#apsm-search";
	search_default = "Search posts";
	
	$(search_input).attr('value', search_default);
	$(search_input).css('color', '#888'); 
	
	$(search_input).focus(function() {
		if ($(this).attr('value')==search_default) {
			$(this).attr('value', '');
			$(this).css('color', '#000');
		}
	});
	$(search_input).blur(function() {
		if ($(this).attr('value')=="") {
			$(this).attr('value', search_default);
			$(this).css('color', '#888');
		}
	});

	
	// for live search results
	$("#apsm-search").bind( 'keydown', function(e){
		if( e.keyCode == 13 ){
			return false;
		}
	});

	var timer = 0;	
	$("#apsm-search").bind( 'keyup', function(e){
		if( ( e.keyCode > 47 && e.keyCode < 91 ) || e.keyCode == 8 || e.keyCode == 13 ){
			clearTimeout( timer );
			timer = setTimeout( function() {
						apsm_search();
					}, 200 );
		}
	});
	

	function apsm_search() {
		if( $("#apsm-search").val() != '' ) {
			var searchResults = "../wp-content/plugins/sticky-manager/apsm-search.php?apsm_s=" +  $("#apsm-search").val() ;
			if( $("#post_ID").val() ) {
				searchResults += "&apsm_id=" +  $("#post_ID").val() ; 
			}
			$("#apsm-results").load( searchResults, '', 
				function() { $("#apsm-results li .apsm-result").each(function(i) {
						$(this).click(function() {
							var postID = this.id.substring(7);
							var resultID = "sticky-post-" + postID;
							if( $("#"+resultID).text() == '' ) {
								$("#apsm-sticky-posts-replacement").hide();
								var newLI = document.createElement("li");
								$(newLI).attr('id', resultID);
								$(newLI).text($(this).text());
								$("#apsm-sticky-posts-list").append( '<li id="'+resultID+'"><span>'+$(this).text()+'</span><span><a class="apsm-deletebtn" onclick="apsm_remove(\''+resultID+'\')">X</a></span><input type="hidden" name="apsm-sticky-posts[]" value="'+postID+'" /></li>' );
							}
							else {
								$("#"+resultID ).focus();
								$("#"+resultID ).css("color", "red");
								setTimeout('document.getElementById("'+resultID+'").style.color = "#000000";', 1350);
							}
						});	  					
					});
				}
			);
		}
		else {
			$("#apsm-results").html("");
		}
	}
});

function apsm_remove( postID ) {
	jQuery(document).ready(function($){
		$("#"+postID).remove();
		if( $("#apsm-sticky-posts-list li").length < 2 ){
			$("#apsm-sticky-posts-replacement").show();
		}
	});
}