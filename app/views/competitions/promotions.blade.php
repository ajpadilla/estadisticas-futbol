<div class="row">
	<div class="col-md-2">
		<button class="pull-left btn btn-lg btn-primary" id="add-promotions-to-competition" data-competition-id="{{ $competition->id }}" href="#">Agregar Ascensos</button>
	</div>
	<div id="add-promotions-to-competition" class="hidden">
		@include('competitions.partials._form_promotions')
	</div>

</div>
<div class="row">
	<?php $table = $teamsTable; ?>
	<div class="col-md-12">
		@include('partials._index-table')
	</div>
</div>
<br />

