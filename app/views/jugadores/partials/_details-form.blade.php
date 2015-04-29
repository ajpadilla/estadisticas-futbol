<h4>Otros datos</h4>

<div class="form-group">
	{{ Form::label('info_url', 'Información URL', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">
		<div class="input-group">
			<span class="input-group-addon">http://</span>
			{{ Form::text('info_url', null, ['class' => 'form-control', 'placeholder'=>'Dirección Web','id'=> 'info_url_jugador']) }}
		</div>
	</div>
</div>

<div class="form-group">
	{{ Form::label('historia', 'Historia', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::textarea('historia', null, ['class' => 'form-control', 'rows' => 16, 'cols' => 32,'id'=>'historia_jugador']) }}</div>
</div>

<div class="form-group">
	{{ Form::label('facebook_url', 'Facebook', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">
		<div class="input-group">
			<span class="input-group-addon">http://</span>
			{{ Form::text('facebook_url', null, ['class' => 'form-control', 'placeholder'=>'Dirección Web','id'=> 'facebook_url_jugador']) }}
		</div>
	</div>
</div>

<div class="form-group">
	{{ Form::label('twitter_url', 'Twitter', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">
		<div class="input-group">
			<span class="input-group-addon">http://</span>
			{{ Form::text('twitter_url', null, ['class' => 'form-control', 'placeholder'=>'Dirección Web','id'=> 'twitter_url_jugador']) }}
		</div>
	</div>
</div>