<!-- JAVASCRIPTS -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- JQUERY -->
{{ HTML::script('assets/js/jquery/jquery-2.0.3.min.js') }}
<!-- JQUERY UI-->
{{ HTML::script('assets/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js') }}
<!-- BOOTSTRAP -->
{{ HTML::script('assets/bootstrap-dist/js/bootstrap.min.js') }}

<!-- BOOTSTRAP FILEUPLOAD -->
{{ HTML::script('assets/js/fileinput/fileinput.min.js') }}
{{ HTML::script('assets/js/fileinput/fileinput_locale_es.js') }}

<!-- BOOTBOX -->
{{ HTML::script('assets/js/bootbox/bootbox.min.js') }}
	
<!-- DATE RANGE PICKER -->
{{ HTML::script('assets/js/bootstrap-daterangepicker/moment.min.js') }}

{{ HTML::script('assets/js/bootstrap-daterangepicker/daterangepicker.min.js') }}
<!-- SLIMSCROLL -->
{{ HTML::script('assets/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js') }}
{{ HTML::script('assets/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js') }}
<!-- COOKIE -->
{{ HTML::script('assets/js/jQuery-Cookie/jquery.cookie.min.js') }}
<!-- CUSTOM SCRIPT -->
{{ HTML::script('assets/js/script.js') }}
{{ HTML::script('assets/js/custom.js') }}
<script>
	jQuery(document).ready(function() {		
		App.setPage("widgets_box");  //Set current page
		App.init(); //Initialise plugins and elements
		
		// Custom inits
    	CustomApp.init();
	});
</script>
<!-- /JAVASCRIPTS -->
