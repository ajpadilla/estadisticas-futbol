@extends("layouts.main")

@section("page-title")
	Datos {{ $equipo->nombre }}
@stop

@section("page-description")
	Equipos
@stop

@section('content')
	<div class="col-md-12">
		<!-- BOX -->
		<div class="box border">
			<div class="box-title">
				<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{ $equipo->nombre }}</span></h4>
			</div>
			<div class="box-body">
				<div class="tabbable header-tabs user-profile">
					<ul class="nav nav-tabs">
					   <li><a href="#pro_help" data-toggle="tab"><i class="fa fa-question"></i> <span class="hidden-inline-mobile"> Help</span></a></li>
					   <li><a href="#pro_edit" data-toggle="tab"><i class="fa fa-edit"></i> <span class="hidden-inline-mobile"> Editar Cuenta</span></a></li>
					   <li class="active"><a href="#pro_overview" data-toggle="tab"><i class="fa fa-dot-circle-o"></i> <span class="hidden-inline-mobile">Overview</span></a></li>
					</ul>
					<div class="tab-content">
					   <!-- OVERVIEW -->
					   <div class="tab-pane fade in active" id="pro_overview">
						  <div class="row">
							<!-- PROFILE PIC -->
							<div class="col-md-3">
								<div class="list-group">
								  <li class="list-group-item zero-padding">
									<img alt="" class="img-responsive" src="img/profile/avatar.jpg">
								  </li>
								  <div class="list-group-item profile-details">
										{{-- <h2>Jennifer Doe</h2> --}}
										<p>{{ $equipo->historia }}</p>
										<p><a href="{{ $equipo->info_url }}">En Wikipedia.</a></p>
										<ul class="list-inline">
										   <li><i class="fa fa-facebook fa-2x"></i></li>
										   <li><i class="fa fa-twitter fa-2x"></i></li>
										   <li><i class="fa fa-dribbble fa-2x"></i></li>
										   <li><i class="fa fa-bitbucket fa-2x"></i></li>
										</ul>
								 </div>
								  <a href="#" class="list-group-item"><i class="fa fa-user fa-fw"></i> Profile</a>
								  <a href="#" class="list-group-item">
									<span class="badge badge-red">9</span>
									<i class="fa fa-calendar fa-fw"></i> Partidos
								  </a>
								</div>														
							</div>
							<!-- /PROFILE PIC -->
							<!-- PROFILE DETAILS -->
							<div class="col-md-9">
								<!-- ROW 1 -->
								<div class="row">
									<div class="col-md-7 profile-details">																
										<h3>My Skills</h3>
										<div class="row">
											<div class="col-md-4 text-center">
												<div id="pie_1" class="piechart" data-percent="76">
													<span class="percent"></span>
												</div>
												<div class="skill-name">Graphic Design</div>
											</div>
											<div class="col-md-4 text-center">
												<div id="pie_2" class="piechart" data-percent="82">
													<span class="percent"></span>
												</div>
												<div class="skill-name">Web Design</div>
											</div>
											<div class="col-md-4 text-center">
												<div id="pie_3" class="piechart" data-percent="66">
													<span class="percent"></span>
												</div>
												<div class="skill-name">Javascript</div>
											</div>
										</div>
										<div class="divide-20"></div>
										<!-- BUTTONS -->
										<div class="row">
											<div class="col-md-3">
												<a class="btn btn-danger btn-icon input-block-level" href="javascript:void(0);">
													<i class="fa fa-google-plus-square fa-2x"></i>
													<div>Google Plus</div>
													<span class="label label-right label-warning">4</span>
												</a>
											</div>
											<div class="col-md-3">
												<a class="btn btn-primary btn-icon input-block-level" href="javascript:void(0);">
													<i class="fa fa-facebook-square fa-2x"></i>
													<div>Facebook</div>
													<span class="label label-right label-danger">7+</span>
												</a>
											</div>
											<div class="col-md-3">
												<a class="btn btn-pink btn-icon input-block-level" href="javascript:void(0);">
													<i class="fa fa-dribbble fa-2x"></i>
													<div>Dribbble</div>
													<span class="label label-right label-info">1</span>
												</a>
											</div>
											<div class="col-md-3">
												<a class="btn btn-success btn-icon input-block-level" href="javascript:void(0);">
													<i class="fa fa-github fa-2x"></i>
													<div>Github</div>
												</a>
											</div>
										</div>
										<!-- /BUTTONS -->
									</div>
									<div class="col-md-5">
										<!-- BOX -->
										<div class="box border inverse">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Statistics</h4>
												<div class="tools">
													<a href="#box-config" data-toggle="modal" class="config">
														<i class="fa fa-cog"></i>
													</a>
													<a href="javascript:;" class="reload">
														<i class="fa fa-refresh"></i>
													</a>
													<a href="javascript:;" class="collapse">
														<i class="fa fa-chevron-up"></i>
													</a>
													<a href="javascript:;" class="remove">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</div>
											<div class="box-body big sparkline-stats">
												<div class="sparkline-row">
													<span class="title">Profile Visits</span>
													<span class="value">7453</span>
													<div class="linechart linechart-lg">1:3,2.8:4,3:3,4:3.4,5:7.5,6:2.3,7:5.4</div>
												</div>
												<div class="sparkline-row">
													<span class="title">Account balance</span>
													<span class="value"><i class="fa fa-usd"></i> 45,732</span>
													<span class="sparkline big" data-color="blue">16,6,23,14,12,10,15,4,19,18,4,24</span>
												</div>
												<div class="sparkline-row">
													<span class="title">Revenue distribution</span>
													<span class="value"><i class="fa fa-usd"></i> 25,674</span>
													<span class="sparklinepie big">16,6,23</span>
												</div>
											</div>
										</div>
										<!-- /BOX -->
										<!-- /SAMPLE -->
									</div>
								</div>
								<!-- /ROW 1 -->
								<div class="divide-40"></div>
								<!-- ROW 2 -->
								<div class="row">
									<div class="col-md-12">
									<div class="box border blue">
									<div class="box-title">
										<h4><i class="fa fa-columns"></i> <span class="hidden-inline-mobile">Profile Summary</span></h4>																
									</div>
									<div class="box-body">
										<div class="tabbable">
											<ul class="nav nav-tabs">
											   <li class="active"><a href="#sales" data-toggle="tab"><i class="fa fa-signal"></i> <span class="hidden-inline-mobile">Sales Table</span></a></li>
											   <li><a href="#feed" data-toggle="tab"><i class="fa fa-rss"></i> <span class="hidden-inline-mobile">Recent Activities</span></a></li>
											</ul>
											<div class="tab-content">
											   <div class="tab-pane active" id="sales">
												  <table class="table table-striped table-bordered table-hover">
													 <thead>
														<tr>
														   <th><i class="fa fa-user"></i> Client</th>
														   <th class="hidden-xs"><i class="fa fa-quote-left"></i> Sales Item</th>
														   <th><i class="fa fa-dollar"></i> Amount</th>
														   <th><i class="fa fa-bars"></i> Status</th>
														</tr>
													 </thead>
													 <tbody>
														<tr>
														   <td><a href="#">Fortune 500</a></td>
														   <td class="hidden-xs">Gold Level Virtual Server</td>
														   <td>$ 2310.23</td>
														   <td><span class="label label-success label-sm">Paid</span></td>
														</tr>
														<tr>
														   <td><a href="#">Cisco Inc.</a></td>
														   <td class="hidden-xs">Platinum Level Virtual Server</td>
														   <td>$ 5502.67</td>
														   <td><span class="label label-warning label-sm">Pending</span></td>
														</tr>
														<tr>
														   <td><a href="#">VMWare Ltd.</a></td>
														   <td class="hidden-xs">Hardware Switch</td>
														   <td>$ 3472.54</td>
														   <td><span class="label label-success label-sm">Paid</span></td>
														</tr>
														<tr>
														   <td><a href="#">Wall-Mart Stores</a></td>
														   <td class="hidden-xs">Branding & Marketing</td>
														   <td>$ 6653.25</td>
														   <td><span class="label label-success label-sm">Paid</span></td>
														</tr>
														<tr>
														   <td><a href="#">Exxon Mobil</a></td>
														   <td class="hidden-xs">UX and UI Services</td>
														   <td>$ 45645.45</td>
														   <td><span class="label label-danger label-sm">Overdue</span></td>
														</tr>
														<tr>
														   <td><a href="#">General Electric</a></td>
														   <td class="hidden-xs">Web Designing</td>
														   <td>$ 3432.11</td>
														   <td><span class="label label-warning label-sm">Pending</span></td>
														</tr>
													 </tbody>
												  </table>
											   </div>
											   <div class="tab-pane" id="feed">
												  <div class="scroller" data-height="250px" data-always-visible="1" data-rail-visible="1">
													  <div class="feed-activity clearfix">
														<div>
															<i class="pull-left roundicon fa fa-check btn btn-info"></i>
															<a class="user" href="#"> John Doe </a>
															accepted your connection request.
															<br>
															<a href="#">View profile</a>
															
														</div>
														<div class="time">
															<i class="fa fa-clock-o"></i>
															5 hours ago
														</div>
													  </div>
													  <div class="feed-activity clearfix">
														<div>
															<i class="pull-left roundicon fa fa-picture-o btn btn-danger"></i>
															<a class="user" href="#"> Jack Doe </a>
															uploaded a new photo.
															<br>
															<a href="#">Take a look</a>
															
														</div>
														<div class="time">
															<i class="fa fa-clock-o"></i>
															5 hours ago
														</div>
													  </div>
													  <div class="feed-activity clearfix">
														<div>
															<i class="pull-left roundicon fa fa-edit btn btn-pink"></i>
															<a class="user" href="#"> Jess Doe </a>
															edited their skills.
															<br>
															<a href="#">Endorse them</a>
															
														</div>
														<div class="time">
															<i class="fa fa-clock-o"></i>
															5 hours ago
														</div>
													  </div>
													  <div class="feed-activity clearfix">
														<div>
															<i class="pull-left roundicon fa fa-bitcoin btn btn-yellow"></i>
															<a class="user" href="#"> Divine Doe </a>
															made a bitcoin payment.
															<br>
															<a href="#">Check your financials</a>
															
														</div>
														<div class="time">
															<i class="fa fa-clock-o"></i>
															6 hours ago
														</div>
													  </div>
													  <div class="feed-activity clearfix">
														<div>
															<i class="pull-left roundicon fa fa-dropbox btn btn-primary"></i>
															<a class="user" href="#"> Lisbon Doe </a>
															saved a new document to Dropbox.
															<br>
															<a href="#">Download</a>
															
														</div>
														<div class="time">
															<i class="fa fa-clock-o"></i>
															1 day ago
														</div>
													  </div>
													  <div class="feed-activity clearfix">
														<div>
															<i class="pull-left roundicon fa fa-pinterest btn btn-inverse"></i>
															<a class="user" href="#"> Bob Doe </a>
															pinned a new photo to Pinterest.
															<br>
															<a href="#">Take a look</a>
															
														</div>
														<div class="time">
															<i class="fa fa-clock-o"></i>
															2 days ago
														</div>
													  </div>
												  </div>
											   </div>
											</div>
										 </div>
									</div>
									</div>
									</div>
								</div>
								<!-- /ROW 2 -->
							</div>
							<!-- /PROFILE DETAILS -->
						  </div>
					   </div>
					   <!-- /OVERVIEW -->
					   
					   <!-- EDIT ACCOUNT -->
					   <div class="tab-pane fade" id="pro_edit">
						  <form class="form-horizontal" action="#">
							<div class="row">
								 <div class="col-md-6">
									<div class="box border green">
										<div class="box-title">
											<h4><i class="fa fa-bars"></i>General Information</h4>
										</div>
										<div class="box-body big">
											<div class="row">
											 <div class="col-md-12">
												<h4>Basic Information</h4>
												<div class="form-group">
												   <label class="col-md-4 control-label">Name</label> 
												   <div class="col-md-8"><input type="text" name="regular" class="form-control" value="Jennifer"></div>
												</div>
												<div class="form-group">
												   <label class="col-md-4 control-label">Birthday</label> 
												   <div class="col-md-8"><input  class="form-control datepicker" type="text" name="regular" size="10"></div>
												</div>
												<div class="form-group">
												   <label class="col-md-4 control-label">Gender</label> 
												   <div class="col-md-8">
													  <label class="radio"> <input type="radio" class="uniform" name="optionsRadios1" value="option1"> Male </label> 
													 <label class="radio"> <input type="radio" class="uniform" name="optionsRadios1" value="option2" checked> Female </label>
												   </div>
												</div>
												<h4>Contact Information</h4>
												<div class="form-group">
												   <label class="col-md-4 control-label">Phone</label> 
												   <div class="col-md-8"><input type="number" name="regular" class="form-control" value="1002927323"></div>
												</div>
												
												<div class="form-group">
												   <label class="col-md-4 control-label">Address</label> 
												   <div class="col-md-8"><textarea name="regular" class="form-control"></textarea></div>
												</div>
												<div class="form-group">
												   <label class="col-md-4 control-label">Website</label> 
												   <div class="col-md-8">
														<div class="input-group">
														  <span class="input-group-addon">http://</span>
														  <input type="text" class="form-control" placeholder="Website">
														</div>																			
												   </div>
												</div>
											 </div>
										  </div>
										</div>
									</div>
								 </div>
								 <div class="col-md-6 form-vertical">
									<div class="box border inverse">
										<div class="box-title">
											<h4><i class="fa fa-bars"></i>Profile Settings</h4>
										</div>
										<div class="box-body big">
											<h4>Security Settings</h4>
												<div class="form-group">
												   <label class="col-md-4 control-label">Secure Browsing</label> 
												   <div class="col-md-8">
														<label class="checkbox-inline"> <input type="checkbox" class="uniform" value="" checked> Enable </label> 
														<label class="checkbox-inline"> <input type="checkbox" class="uniform" value=""> Disable </label> 
												   </div>
												</div>
												<div class="form-group">
												   <label class="col-md-4 control-label">Login Notifications</label> 
												   <div class="col-md-8">
														<label class="checkbox-inline"> <input type="checkbox" class="uniform" value=""> Enable </label> 
														<label class="checkbox-inline"> <input type="checkbox" class="uniform" value="" checked> Disable </label> 
												   </div>
												</div>
												<div class="form-group">
												   <label class="col-md-4 control-label">Recognized Devices</label> 
												   <div class="col-md-8">
														<label class="checkbox"> <input type="checkbox" class="uniform" value="" checked> Apple iPhone </label> 
														<label class="checkbox"> <input type="checkbox" class="uniform" value="" checked> Samsung Galaxy Note 3 </label>
														<label class="checkbox"> <input type="checkbox" class="uniform" value=""> Google Nexus 5 </label>
												   </div>
												</div>
												<div class="form-group">
												   <label class="col-md-4 control-label">Active sessions</label> 
												   <div class="col-md-8">
														<div class="divide-10"></div>
														<p>Logged in from <a href="#"><strong>New York, US</strong></a> and <a href="#">6 other</a> locations</p>
												   </div>
												</div>
										</div>
									</div>
								 </div>
							 </div>
						  </form>
						  <div class="form-actions clearfix"> <input type="submit" value="Update Account" class="btn btn-primary pull-right"> </div>
					   </div>
					   <!-- /EDIT ACCOUNT -->
					   
					   <!-- HELP -->
					   <div class="tab-pane fade" id="pro_help">
						  <!-- FAQ -->
							<div class="row">
								<!-- NAV -->
								<div id="list-toggle" class="col-md-3">
									<div class="list-group">
									  <a href="#tab1" data-toggle="tab" class="list-group-item active">
										<i class="fa fa-suitcase"></i> General Questions
									  </a>
									  <a href="#tab2" data-toggle="tab" class="list-group-item"><i class="fa fa-tags"></i> Payment related</a>
									  <a href="#tab3" data-toggle="tab" class="list-group-item"><i class="fa fa-user"></i> Terms of Service</a>
									  <a href="#tab4" data-toggle="tab" class="list-group-item"><i class="fa fa-sitemap"></i> Account Queries</a>
									  <a href="#tab5" data-toggle="tab" class="list-group-item"><i class="fa fa-arrows"></i> Other Questions</a>
									</div>
								</div>
								<!-- /NAV -->
								<!-- CONTENT -->
								<div class="col-md-9">
									<div class="tab-content">
									   <div class="tab-pane active" id="tab1">
										  <div class="panel-group" id="accordion">
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_1">1. If I post to a public community, does that mean all my friends and followers can see it? </a> </h3>
												 </div>
												 <div id="collapse1_1" class="panel-collapse collapse in">
													<div class="panel-body"> No, the posts you share to a public community will not show up in your friends and followers’ Home streams, unless your friends and followers are also members of the same community.
													Your public community posts will be visible to people who navigate to your profile page unless you have set your settings for them not to appear. Visitors will see text indicating that it was shared to a community.
													Remember that your private community posts will only be visible to people in those communities, regardless of whether or not you show community posts on your profile. </div>
												 </div>
											  </div>
											  <div class="panel panel-info">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
												 </div>
												 <div id="collapse1_2" class="panel-collapse collapse">
													<div class="panel-body"> While in communities:
														Place your cursor in the top left corner for the main menu.
														Select  Settings.
														Scroll to 'Profile'.
														Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-success">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_3">3. Can I change my community from public to private, or vice versa? </a> </h3>
												 </div>
												 <div id="collapse1_3" class="panel-collapse collapse">
													<div class="panel-body">You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-danger">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_4">4. Why aren't people seeing my invites? </a> </h3>
												 </div>
												 <div id="collapse1_4" class="panel-collapse collapse">
													<div class="panel-body"> You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new.
													Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_5">5. If I moderate a post out of my community, is it deleted? </a> </h3>
												 </div>
												 <div id="collapse1_5" class="panel-collapse collapse">
													<div class="panel-body">Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_6">6. Are community names unique? If someone else has a "Software" community, does that prevent me from owning one? </a> </h3>
												 </div>
												 <div id="collapse1_6" class="panel-collapse collapse">
													<div class="panel-body"> They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications. They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_7">7. How can I control how many community invitations I receive? </a> </h3>
												 </div>
												 <div id="collapse1_7" class="panel-collapse collapse">
													<div class="panel-body">A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
										   </div>
									   </div>
									   <div class="tab-pane" id="tab2">
										  <div class="panel-group" id="accordion">
											  <div class="panel panel-danger">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_1">1. If I post to a public community, does that mean all my friends and followers can see it? </a> </h3>
												 </div>
												 <div id="collapse2_1" class="panel-collapse collapse">
													<div class="panel-body"> No, the posts you share to a public community will not show up in your friends and followers’ Home streams, unless your friends and followers are also members of the same community.
													Your public community posts will be visible to people who navigate to your profile page unless you have set your settings for them not to appear. Visitors will see text indicating that it was shared to a community.
													Remember that your private community posts will only be visible to people in those communities, regardless of whether or not you show community posts on your profile. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
												 </div>
												 <div id="collapse2_2" class="panel-collapse collapse">
													<div class="panel-body"> While in communities:
														Place your cursor in the top left corner for the main menu.
														Select  Settings.
														Scroll to 'Profile'.
														Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_3">3. Can I change my community from public to private, or vice versa? </a> </h3>
												 </div>
												 <div id="collapse2_3" class="panel-collapse collapse">
													<div class="panel-body">You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_4">4. Why aren't people seeing my invites? </a> </h3>
												 </div>
												 <div id="collapse2_4" class="panel-collapse collapse in">
													<div class="panel-body"> You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new.
													Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-success">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_5">5. If I moderate a post out of my community, is it deleted? </a> </h3>
												 </div>
												 <div id="collapse2_5" class="panel-collapse collapse">
													<div class="panel-body">Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-warning">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_6">6. Are community names unique? If someone else has a "Software" community, does that prevent me from owning one? </a> </h3>
												 </div>
												 <div id="collapse2_6" class="panel-collapse collapse">
													<div class="panel-body"> They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications. They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_7">7. How can I control how many community invitations I receive? </a> </h3>
												 </div>
												 <div id="collapse2_7" class="panel-collapse collapse">
													<div class="panel-body">A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
										   </div>
									   </div>
									   <div class="tab-pane" id="tab3">
										  <div class="panel-group" id="accordion">
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_1">1. If I post to a public community, does that mean all my friends and followers can see it? </a> </h3>
												 </div>
												 <div id="collapse3_1" class="panel-collapse collapse">
													<div class="panel-body"> No, the posts you share to a public community will not show up in your friends and followers’ Home streams, unless your friends and followers are also members of the same community.
													Your public community posts will be visible to people who navigate to your profile page unless you have set your settings for them not to appear. Visitors will see text indicating that it was shared to a community.
													Remember that your private community posts will only be visible to people in those communities, regardless of whether or not you show community posts on your profile. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
												 </div>
												 <div id="collapse3_2" class="panel-collapse collapse">
													<div class="panel-body"> While in communities:
														Place your cursor in the top left corner for the main menu.
														Select  Settings.
														Scroll to 'Profile'.
														Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_3">3. Can I change my community from public to private, or vice versa? </a> </h3>
												 </div>
												 <div id="collapse3_3" class="panel-collapse collapse">
													<div class="panel-body">You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_4">4. Why aren't people seeing my invites? </a> </h3>
												 </div>
												 <div id="collapse3_4" class="panel-collapse collapse">
													<div class="panel-body"> You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new.
													Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_5">5. If I moderate a post out of my community, is it deleted? </a> </h3>
												 </div>
												 <div id="collapse3_5" class="panel-collapse collapse in">
													<div class="panel-body">Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-info">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_6">6. Are community names unique? If someone else has a "Software" community, does that prevent me from owning one? </a> </h3>
												 </div>
												 <div id="collapse3_6" class="panel-collapse collapse">
													<div class="panel-body"> They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications. They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-success">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_7">7. How can I control how many community invitations I receive? </a> </h3>
												 </div>
												 <div id="collapse3_7" class="panel-collapse collapse">
													<div class="panel-body">A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
										   </div>
									   </div>
									   <div class="tab-pane" id="tab4">
										  <div class="panel-group" id="accordion">
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_1">1. If I post to a public community, does that mean all my friends and followers can see it? </a> </h3>
												 </div>
												 <div id="collapse4_1" class="panel-collapse collapse in">
													<div class="panel-body"> No, the posts you share to a public community will not show up in your friends and followers’ Home streams, unless your friends and followers are also members of the same community.
													Your public community posts will be visible to people who navigate to your profile page unless you have set your settings for them not to appear. Visitors will see text indicating that it was shared to a community.
													Remember that your private community posts will only be visible to people in those communities, regardless of whether or not you show community posts on your profile. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
												 </div>
												 <div id="collapse4_2" class="panel-collapse collapse">
													<div class="panel-body"> While in communities:
														Place your cursor in the top left corner for the main menu.
														Select  Settings.
														Scroll to 'Profile'.
														Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_3">3. Can I change my community from public to private, or vice versa? </a> </h3>
												 </div>
												 <div id="collapse4_3" class="panel-collapse collapse">
													<div class="panel-body">You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_4">4. Why aren't people seeing my invites? </a> </h3>
												 </div>
												 <div id="collapse4_4" class="panel-collapse collapse">
													<div class="panel-body"> You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new.
													Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_5">5. If I moderate a post out of my community, is it deleted? </a> </h3>
												 </div>
												 <div id="collapse4_5" class="panel-collapse collapse">
													<div class="panel-body">Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_6">6. Are community names unique? If someone else has a "Software" community, does that prevent me from owning one? </a> </h3>
												 </div>
												 <div id="collapse4_6" class="panel-collapse collapse">
													<div class="panel-body"> They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications. They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_7">7. How can I control how many community invitations I receive? </a> </h3>
												 </div>
												 <div id="collapse4_7" class="panel-collapse collapse">
													<div class="panel-body">A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
										   </div>
									   </div>
									   <div class="tab-pane" id="tab5">
										  <div class="panel-group" id="accordion">
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_1">1. If I post to a public community, does that mean all my friends and followers can see it? </a> </h3>
												 </div>
												 <div id="collapse5_1" class="panel-collapse collapse">
													<div class="panel-body"> No, the posts you share to a public community will not show up in your friends and followers’ Home streams, unless your friends and followers are also members of the same community.
													Your public community posts will be visible to people who navigate to your profile page unless you have set your settings for them not to appear. Visitors will see text indicating that it was shared to a community.
													Remember that your private community posts will only be visible to people in those communities, regardless of whether or not you show community posts on your profile. </div>
												 </div>
											  </div>
											  <div class="panel panel-success">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
												 </div>
												 <div id="collapse5_2" class="panel-collapse collapse">
													<div class="panel-body"> While in communities:
														Place your cursor in the top left corner for the main menu.
														Select  Settings.
														Scroll to 'Profile'.
														Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-info">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_3">3. Can I change my community from public to private, or vice versa? </a> </h3>
												 </div>
												 <div id="collapse5_3" class="panel-collapse collapse">
													<div class="panel-body">You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-warning">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_4">4. Why aren't people seeing my invites? </a> </h3>
												 </div>
												 <div id="collapse5_4" class="panel-collapse collapse">
													<div class="panel-body"> You can turn your community notifications on or off by clicking on the  icon on a community’s page.
													Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new.
													Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-danger">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_5">5. If I moderate a post out of my community, is it deleted? </a> </h3>
												 </div>
												 <div id="collapse5_5" class="panel-collapse collapse">
													<div class="panel-body">Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_6">6. Are community names unique? If someone else has a "Software" community, does that prevent me from owning one? </a> </h3>
												 </div>
												 <div id="collapse5_6" class="panel-collapse collapse">
													<div class="panel-body"> They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications. They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications.
													 </div>
												 </div>
											  </div>
											  <div class="panel panel-default">
												 <div class="panel-heading">
													<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_7">7. How can I control how many community invitations I receive? </a> </h3>
												 </div>
												 <div id="collapse5_7" class="panel-collapse collapse">
													<div class="panel-body">A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
												 </div>
											  </div>
										   </div>
									   </div>

										   </div>
									   </div>
									</div>
									<!-- /FAQ -->
								<div class="divide-40"></div>
					   </div>
					   <!-- /HELP -->
					</div>
				</div>
				<!-- /USER PROFILE -->
			</div>
		</div>
		<!-- /BOX -->					
	</div>
@stop	