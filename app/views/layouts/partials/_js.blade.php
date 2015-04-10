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

<!-- JQUERY VALIDATE -->
{{ HTML::script('assets/js/jquery-validate/jquery.validate.min.js') }}
{{ HTML::script('assets/js/jquery-validate/additional-methods.min.js') }}
{{ HTML::script('assets/js/jquery-validate/localization/messages_es.min.js') }}

<!-- BOOTBOX -->
{{ HTML::script('assets/js/bootbox/bootbox.min.js') }}

<!-- FANCYBOX -->
{{ HTML::script('assets/js/fancybox/source/jquery.fancybox.pack.js') }}

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

<!-- Datatable -->
{{ HTML::script('assets/js/dataTables/jquery.dataTables.js'); }}
{{ HTML::script('assets/js/dataTables/dataTables.bootstrap.js'); }}

<!-- Chosen -->
{{ HTML::script('assets/js/chosen/chosen.jquery.js')}}

<!-- Date picker -->
{{ HTML::script('assets/js/datapicker/bootstrap-datepicker.js'); }}

{{ HTML::script('assets/js/jQueryForm/jquery.form.min.js'); }}

<script>
	jQuery(document).ready(function() {		
		App.setPage("widgets_box");  //Set current page
		App.init(); //Initialise plugins and elements
		
		// Custom inits
    	CustomApp.init();
	});
</script>

@yield('scripts')

<!-- /JAVASCRIPTS -->
