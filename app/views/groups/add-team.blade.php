<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-team-to-group-form-div" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">@yield('title-modal')</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => ['groups.api.add.team', $group->id],'class'=>'form-horizontal','role'=>'form', 'id'=> 'add-team-to-group-form']) }}
			
			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>
