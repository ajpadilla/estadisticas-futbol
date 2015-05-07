<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-group-to-competition-form-div" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">@yield('title-modal')</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => ['competitions.api.add.group', $competition->id],'class'=>'form-horizontal','role'=>'form',
			'method' => 'POST','files' => true,'id'=> 'add-group-to-competition-form']) }}
			
			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>
