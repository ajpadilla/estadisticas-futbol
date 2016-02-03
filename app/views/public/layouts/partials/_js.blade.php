{{-- <script type="text/javascript" src="../ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script> --}}
{{-- <script src="../code.jquery.com/ui/1.11.0/jquery-ui.js"></script> --}}
<!-- JQUERY -->
{{ HTML::script('assets/js/jquery/jquery-2.0.3.min.js') }}
<!-- JQUERY UI-->
{{ HTML::script('assets/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js') }}

<!-- CUSTOM -->
{{ HTML::script('assets/js/public/inicio4.js') }}

{{ HTML::script('assets/js/public/custom.js') }}

<script>
	jQuery(document).ready(function() {		
    	CustomPublicApp.init();
	});
</script>

<script type="text/javascript" src="assets/js/apis.google.com/plusone.js">
  {lang: 'es-419'}
</script>