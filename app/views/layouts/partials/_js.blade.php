<!-- JAVASCRIPTS -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- JQUERY -->
{{ HTML::script('assets/js/jquery/jquery-2.0.3.min.js') }}"></script>
<!-- JQUERY UI-->
{{ HTML::script('assets/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<!-- BOOTSTRAP -->
{{ HTML::script('assets/bootstrap-dist/js/bootstrap.min.js') }}"></script>

	
<!-- DATE RANGE PICKER -->
{{ HTML::script('assets/js/bootstrap-daterangepicker/moment.min.js') }}"></script>

{{ HTML::script('assets/js/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
<!-- SLIMSCROLL -->
{{ HTML::script('assets/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js') }}"></script>
{{ HTML::script('assets/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js') }}"></script>
<!-- COOKIE -->
{{ HTML::script('assets/js/jQuery-Cookie/jquery.cookie.min.js') }}"></script>
<!-- CUSTOM SCRIPT -->
{{ HTML::script('assets/js/script.js') }}"></script>
<script>
	jQuery(document).ready(function() {		
		App.setPage("widgets_box");  //Set current page
		App.init(); //Initialise plugins and elements
	});
</script>
<!-- /JAVASCRIPTS -->
