var _ewpq_admin = _ewpq_admin || {};

jQuery(document).ready(function($) {
   "use strict";  
   
   if($('#query-output').length){
	   var queryGenerator = CodeMirror.fromTextArea(document.getElementById("query-output"), {
          mode:  "application/x-httpd-php",
          lineNumbers: true,
          lineWrapping: true,
          indentUnit: 0,
          matchBrackets: true,
          viewportMargin: Infinity,
          extraKeys: {"Ctrl-Space": "autocomplete"},
      });
   }
   
   
   
   /*
   *  query_generator
   *  Generate a unique WP_Query
   *
   *  @since 1.0.0
   */
   
   _ewpq_admin.buildQuery = function(data){
      var placement = $('#query-output'),
          container_type = $('input[name=container_type]:checked').val(),
          classes = $('input#classes').val();       
        
      // Post Types  
      var post_types = '',
          post_type_count = 0;
      $('.post_types input[type=checkbox]:checked').each(function(e){         
         post_type_count++;
         if(post_type_count>1){
            post_types += ",'" + $(this).data('type') +"'";
         }else{
            post_types += "'" + $(this).data('type') + "'"; 
         }
      });        
      
      // Category In
      var cat_in = $('#category-select').val();   
      if(cat_in){
         var category__in = '',
         	 category__in_count = 0;
			$(cat_in).each(function(e){         
	         category__in_count++;
	         if(category__in_count>1){
	            category__in += ",'" + cat_in[e] +"'";
	         }else{
	            category__in += "'" + cat_in[e] + "'"; 
	         }
	      });
		}
		 
		// Category not in  
      var cat_not_in = $('#category-exclude-select').val();
      if(cat_not_in){
         var category__not_in = '',
         	 category__not_in_count = 0;
			$(cat_not_in).each(function(e){         
	         category__not_in_count++;
	         console.log(cat_not_in[e]);
	         if(category__not_in_count>1){
	            category__not_in += ",'" + cat_not_in[e] +"'";
	         }else{
	            category__not_in += "'" + cat_not_in[e] + "'"; 
	         }
	      });
		}
      
      // Tag in
      var tag_in = $('#tag-select').val(); 
      if(tag_in){
         var tag__in = '',
         	 tag__in_count = 0;
			$(tag_in).each(function(e){         
	         tag__in_count++;
	         if(tag__in_count>1){
	            tag__in += ",'" + tag_in[e] +"'";
	         }else{
	            tag__in += "'" + tag_in[e] + "'"; 
	         }
	      });
		}
        
      // Tag not in   
      var tag_not_in = $('#tag-exclude-select').val();
      if(tag_not_in){
         var tag__not_in = '',
         	 tag__not_in_count = 0;
			$(tag_not_in).each(function(e){         
	         tag__not_in_count++;
	         console.log(tag_not_in[e]);
	         if(tag__not_in_count>1){
	            tag__not_in += ",'" + tag_not_in[e] +"'";
	         }else{
	            tag__not_in += "'" + tag_not_in[e] + "'"; 
	         }
	      });
		}
      
		
      var year = $('#input-year').val();
      var monthnum = $('#input-month').val();
      var day = $('#input-day').val();
      
      var author = $('#author-select').val();
      
      var search = $.trim($('#search-term').val());
      
      var custom_args = $.trim($('#custom-args').val());
      
      var post_status = $('#post-status').val();
      
      var order = $('#post-order').val();
      var orderby = $('#post-orderby').val();
      
      var include_posts = $('#include-posts').val();
		if(include_posts) 
		   var include_posts = include_posts.split(',');
      
      var exclude = $('#exclude-posts').val();
		if(exclude) 
		   exclude = exclude.split(',');
		   
      var offset = $('#offset-select').val();
      if(offset === '') 
         offset = 0;
            
      var posts_per_page = $('#display_posts-select').val();
         if(posts_per_page == 0)
            posts_per_page = "-1";
      
      // Paging Styles and Settings
      var is_paged = $('.paging input[name=enable_paging]:checked').val();  
      
      
      // ************************
   	// Build the query	
      // ************************
      
      var $q = '';
      $q += "<?php ";
      $q += "\n";
      
      $q += "$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; \n";
      
      $q += "$args = array(\n";
      
      $q += "  'post_type' => array("+ post_types + "), \n";
     
		// Category
      if(category__in)
      $q += "  'category__in' => array("+ category__in + "), \n";     
      
      // Cat Not In
      if(category__not_in)
      $q += "  'category__not_in' => array("+ category__not_in + "), \n"; 
     
      // Tag
      if(tag__in)
      $q += "  'tag__in' => array("+ tag__in + "), \n";    
      
      // Tag Not In
      if(tag__not_in)
      $q += "  'tag__not_in' => array("+ tag__not_in + "), \n";  
     
      // Date
      if(year)
      $q += "  'year' => '"+ year + "', \n";   
     
      if(monthnum)
      $q += "  'monthnum' => '"+ monthnum + "', \n";   
     
      if(day)
      $q += "  'day' => '"+ day + "', \n"; 
     
      // Author
      if(author)
      $q += "  'author' => '"+ author + "', \n";
     
      // Search
      if(search)
      $q += "  's' => '"+ search + "', \n";
     
      // Custom Args
      if(custom_args){
         var custom_args_arr = custom_args.split(';'); // Split all args
         for(var i = 0; i < custom_args_arr.length; i++){
            var custom_argument = custom_args_arr[i].split(':'); // Split current argument
            $q += "  '"+custom_argument[0]+"' => '"+ custom_argument[1] + "', \n";
         }
      }
      //$q += "  's' => '"+ search + "', \n";
      
      // Include Posts
      if(include_posts)
      $q += "  'post__in' => array("+ include_posts + "), \n";
      
      // Exclude Posts
      if(exclude)
      $q += "  'post__not_in' => array("+ exclude + "), \n";
      
      // Post Status
      if(post_status)
      $q += "  'post_status' => '"+ post_status + "', \n";     
      	
      // Order
      if(order)
      $q += "  'order' => '"+ order + "', \n";      
      
      // OrderBy	
      if(orderby)
      $q += "  'orderby' => '"+ orderby + "', \n";
      	
      // Posts Per Page	
      if(posts_per_page)      
      $q += "  'posts_per_page' => "+ posts_per_page + ", \n";
      
      // Paged
      $q += "  'paged' => $paged, \n";
      $q += ");\n";
      
      // Offset
      if(offset > 0){ 
         $q += "\n";
         $q += "// Offset/Pagination fix \n";        
         $q += "$page = $paged - 1; \n";
         $q += "$offset = "+offset+"; \n";
         $q += "$posts_per_page = "+posts_per_page+"; \n";
         $q += "if($offset > 0){ \n";
         $q += "   $args['offset'] = $offset + ($posts_per_page*$page); \n";
         $q += "}\n";
      }      
      
      $q += "\n";
      
      // WP_QUERY 
      $q += "// WP_Query";
      $q += "\n";
      $q += "$eq_query = new WP_Query( $args );";
      $q += "\n";
      $q += "if ($eq_query->have_posts()) : // The Loop";
      $q += "\n";
      $q += "?>";
      $q += "\n";
      $q += "<div class=\"wp-easy-query\">"
      $q += "\n";
      $q += "<div class=\"wp-easy-query-posts\">"
      $q += '\n';
      $q += '<' + container_type + ' class="'+ classes +'">';
      $q += "\n";
      $q += "<?php ";
      $q += "\n";
      $q += "while ($eq_query->have_posts()): $eq_query->the_post();";  
      $q += "\n";  
      $q += "?>";
      $q += "\n";
      $q += data;
      $q += "\n"; 
      $q += "<?php endwhile; wp_reset_query(); ?> ";   
      $q += "\n"; 
      $q += "</" + container_type + ">"   
      $q += "\n"; 
      $q += "</div>";
      $q += "\n";
      
      // Paging
      if(is_paged === 'true'){
         $q += "<?php include(EQ_PAGING); ?>";
         $q += "\n";     
      } 
      
      $q += "</div>"
      $q += "\n";
      
      $q += "<?php endif; ?> ";
      
      // Set CodeMirror and textarea Val
      queryGenerator.setValue($q);      
      placement.val($q);      
   	$('.CodeMirror').removeClass('loading');
	}
	
	
	
	/*
    *  _ewpq_admin.getTemplateValue
    *  Get value of template from DB for placement in query generator
    *  
    *  @since 1.0.0
    */  
	
	_ewpq_admin.getTemplateValue = function(template) {	   							
		$.ajax({
			type: 'POST',
			url: ewpq_admin_localize.ajax_admin_url,
			data: {
				action: 'ewpq_query_generator',
				template: template,
				nonce: ewpq_admin_localize.ewpq_admin_nonce,
			},
			success: function(response) {	
			   var data = response;
			   _ewpq_admin.buildQuery(data);							
			},
			error: function(xhr, status, error) {
            console.log('An error has occurred while retrieving template data.');
            $('.CodeMirror').removeClass('loading');
			}
      });
      
	}
	
	// Generate query button click
	$('#generate-query').click(function(e){
   	$('.CodeMirror').addClass('loading');
   	e.preventDefault();
   	var template = $('select#template-select').val();	
   	_ewpq_admin.getTemplateValue(template);
	});	
	
	
	
	/*
    *  _ewpq_admin.saveQuery
    *  Save the value of the wp_query
    *  
    *  @since 1.0.0
    */  
	
	_ewpq_admin.saveQuery = function(value, alias) {	   							
		$.ajax({
			type: 'POST',
			url: ewpq_admin_localize.ajax_admin_url,
			data: {
				action: 'ewpq_save_query',
				value: value,
				alias: alias,
				nonce: ewpq_admin_localize.ewpq_admin_nonce,
			},
			success: function(response) {	
   			var responseTxt = $('.save-query-wrap .saved-response-text');
            $('.save-query-wrap input').val('');
            $('.save-query-wrap .saving').delay(150).fadeOut(250, function(){
               $('.save-query-wrap').removeClass('saving');	
               $('.CodeMirror').removeClass('loading');		
               responseTxt.show().text(response);
               setTimeout(function(){ 
                  responseTxt.hide().text(''); 
               }, 3000);
            });					
			},
			error: function(xhr, status, error) {
            console.log('An error has occurred while saving your query.');
			}
      });
	}
	
	
	
	// Generate query button click
	$('#ewpq-save-query').click(function(e){
   	e.preventDefault();
   	var alias_field = $('input#ewpq_query_alias'),
   		 value = queryGenerator.getValue(),
   		 alias = $.trim(alias_field.val());
   		 
		if(alias === ''){
			alias_field.addClass('error').focus();
			return false;
		}else{
   		$('.save-query-wrap').addClass('saving');
         $('.CodeMirror').addClass('loading');		
			alias_field.removeClass('error');
   		$('.save-query-wrap .saving').delay(50).fadeIn(250, function(){
            _ewpq_admin.saveQuery(value, alias);	
			});		
		}		
	});	
	
	
	
	/* Saved Queries */
	
	
	
	/*
    *  _ewpq_admin.saveQuery
    *  Save the value of the wp_query
    *  
    *  @since 1.0.0
    */  
	
	_ewpq_admin.viewSavedQuery = function(id, alias) {	   							
		$.ajax({
			type: 'POST',
         dataType: "JSON",
			url: ewpq_admin_localize.ajax_admin_url,
			data: {
				action: 'ewpq_view_saved_query',
				id: id,
				nonce: ewpq_admin_localize.ewpq_admin_nonce,
			},
			success: function(response) {	 
            queryGenerator.setValue(response.template);
            $('#query-alias').val(response.alias);
            $('.update-saved-query').attr('data-id', id);
            $('.CodeMirror').removeClass('loading');			
			},
			error: function(xhr, status, error) {
            console.log('An error has occurred while saving your query.');
			}
      });
	}
	
	
	
	// Generate query button click
	$('ul.query-list li a').click(function(e){
	   var el = $(this);
	   if(!el.parent('li').hasClass('active')){ 
      	e.preventDefault();
      	var id = el.data('id'),
      		 alias = el.data('alias');
      	el.parent('li').addClass('active').siblings('li').removeClass('active');
      	$('.CodeMirror').addClass('loading');
      	_ewpq_admin.viewSavedQuery(id, alias);	
   	}
	});
	
	
	
	/*
    *  _ewpq_admin.saveQuery
    *  Save the value of the wp_query
    *  
    *  @since 1.0.0
    */  
	
	_ewpq_admin.deleteSavedQuery = function(id) {	   							
		$.ajax({
			type: 'POST',
			url: ewpq_admin_localize.ajax_admin_url,
			data: {
				action: 'ewpq_delete_saved_query',
				id: id,
				nonce: ewpq_admin_localize.ewpq_admin_nonce,
			},
			success: function(response) {	
			   var data = response;	  
			   window.location.reload();					
			},
			error: function(xhr, status, error) {
            console.log('An error has occurred while deleting your query.');
			}
      });
	}
	
	
	
	// Generate query button click
	$('ul.query-list li span').click(function(e){
      var el = $(this);
          parent = el.parent('li');
      var r = confirm("Are you sure you want to delete this saved query?");
      if (r == true && !$(this).hasClass('deleting')) {
         el.addClass('deleting');
         $('.CodeMirror').addClass('loading');
         parent.css('opacity', 0.4);
      	var id = el.data('remove');
      	_ewpq_admin.deleteSavedQuery(id);
   	}
	});
	
	
	
	/*
    *  _ewpq_admin.updateSavedQuery
    *  Update the value of the wp_query
    *  
    *  @since 1.0.0
    */  
	
	_ewpq_admin.updateSavedQuery = function(id, alias, value) {	
		var container = $('.saved-query-display'),
			 responseText = $(".saved-response", container);
			 
      responseText.addClass('loading').html('Updating query...');
      responseText.animate({'opacity' : 1});   
			 							
		$.ajax({
			type: 'POST',
			url: ewpq_admin_localize.ajax_admin_url,
			data: {
				action: 'ewpq_update_saved_query',
				id: id,
				alias: alias,
				value: value,
				nonce: ewpq_admin_localize.ewpq_admin_nonce,
			},
			success: function(response) {	
			   var data = response;			
			   $('.CodeMirror').removeClass('loading');	
			   setTimeout(function() { 
				   responseText.delay(500).html(response).removeClass('loading');				
			   }, 250);
			  						  
			   setTimeout(function() { 
				   responseText.animate({'opacity': 0}, function(){
					   responseText.html('&nbsp;');
                  $('.update-saved-query').removeClass('saving');
				   });
					
				}, 3000);	
				
				$(".query-list li a[data-id='"+ id +"'").text(alias); // Update navigation text
				$(".query-list li a[data-id='"+ id +"'").attr('title', alias); // Update title text
						
			},
			error: function(xhr, status, error) {
            console.log('An error has occurred while deleting your query.');
			}
      });
	}
	
	// Generate query button click
	$('.update-saved-query').click(function(e){
      var el = $(this),
      	 id = el.attr('data-id'),
      	 alias = el.closest('.saved-query-display').find('#query-alias').val(),
      	 value = queryGenerator.getValue();
      if(!el.hasClass('saving')){
	      el.addClass('saving');	 
	      $('.CodeMirror').addClass('loading');
	      _ewpq_admin.updateSavedQuery(id, alias, value);
      }   	
	});
	
	// Load first query on load
	if($('ul.query-list li').length) $('ul.query-list li').eq(0).find('a').trigger('click');
	
	
});