<!-- HEADER -->
<header class="navbar clearfix" id="header">
	<div class="container">
			<div class="navbar-brand">
				<!-- COMPANY LOGO -->
				<a href="{{ route('pages.home') }}">
					<img src="{{ asset('assets/img/logo/logo.png') }}" alt="Cloud Admin Logo" class="img-responsive" height="30" width="120">
				</a>
				<!-- /COMPANY LOGO -->
				<!-- TEAM STATUS FOR MOBILE -->
				<div class="visible-xs">
					<a href="#" class="team-status-toggle switcher btn dropdown-toggle">
						<i class="fa fa-users"></i>
					</a>
				</div>
				<!-- /TEAM STATUS FOR MOBILE -->
				<!-- SIDEBAR COLLAPSE -->
				<div id="sidebar-collapse" class="sidebar-collapse btn">
					<i class="fa fa-bars" 
						data-icon1="fa fa-bars" 
						data-icon2="fa fa-bars" ></i>
				</div>
				<!-- /SIDEBAR COLLAPSE -->
			</div>
			<!-- NAVBAR LEFT -->
			<ul class="nav navbar-nav pull-left hidden-xs" id="navbar-left">
				@include('layouts.partials.header._navbar-left')				
			</ul>
			<!-- /NAVBAR LEFT -->
			<!-- BEGIN TOP NAVIGATION MENU -->					
			<ul class="nav navbar-nav pull-right">
				@include('layouts.partials.header._notification-dropdown')				
				@include('layouts.partials.header._inbox-dropdown')				
				@include('layouts.partials.header._todo-dropdown')				
				@include('layouts.partials.header._user-login-dropdown')				
			</ul>
			<!-- END TOP NAVIGATION MENU -->
	</div>
	
	@include('layouts.partials.header._team-status-container')
</header>
<!--/HEADER -->