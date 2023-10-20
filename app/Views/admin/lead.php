<?php
// Top Bar End
echo view('cpanel-layout/header');
echo view('cpanel-layout/navbar');
?>
<style>
	.tab-content .tab-pane:not(.active){
		display:none
	}
	.simplebar-content{
		max-height: 450px;
	}
</style>
<div class="hk-wrapper" data-layout="navbar" data-layout-style="default" data-menu="light" data-footer="simple">
	<!-- Main Content -->
	<div class="hk-pg-wrapper pb-0">
		<!-- Page Body -->
		<div class="hk-pg-body py-0">
			<div class="taskboardapp-wrap">
				<div class="taskboardapp-content">
					<div class="taskboardapp-detail-wrap">
						<header class="taskboard-header">
							<div class="d-flex align-items-center flex-1">
								<div class="d-flex">
									<a class="taskboardapp-title link-dark" href="#">
										<h1>
											<!-- <span class="task-star marked"><span class="feather-icon"><i data-feather="star"></i></span></span> -->
										</h1>
									</a>
									<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
										<!-- <button class="btn btn-soft-primary flex-shrink-0 btn-add-newlist me-4 ms-4" data-bs-toggle="modal" data-bs-target="#add_task_list">Create New</button> -->
										<?php
										$department = session()->get('department');
										// $department_designation = session()->get('department_designation');
										// echo $department;
										if($department == 'Sales'){
										?>
										<button class="btn btn-soft-primary flex-shrink-0 btn-add-newlist me-4 ms-4" data-bs-toggle="modal" data-bs-target="#add_new_card">Add Lead</button>
										<?php
										}
										?>
										<?php
										// if(special_pipeline_access('SALES DEPARTMENT')){
										?>
										<!-- <h1>hello</h1> -->

										<?php
										// }
										?>
									</div>
										<!-- <div class="ms-3">
											<div class="input-group">
												<span class="input-affix-wrapper">
													<span class="input-prefix"><i class="ri-lock-line"></i></span>
													<select class="form-select">
														<option selected="" value="1">Private Board</option>
														<option value="2">Public Board</option>
													</select>
												</span>
											</div>
										</div> -->
									</div>
								</div>
								<select class="form-select d-xxl-none flex-1 mx-3">
									<option selected="" value="1">Initial Stage</option>
									<option value="2">COFC Stage</option>

								</select>
								<ul class="nav nav-pills nav-pills-rounded active-theme nav-light px-2 flex-shrink-0 d-xxl-flex d-none">
									<li class="nav-item">
										<a class="nav-link active" href="<?= base_url() ?>/lead">
											<span class="nav-link-text">Initial Stage</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="<?= base_url() ?>/cofc">
											<span class="nav-link-text">COFC Stage</span>
										</a>
									</li>
									<!-- <li class="nav-item">
										<a class="nav-link" href="javascript:void(0);">
											<span class="nav-link-text">To Do List</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="javascript:void(0);">
											<span class="nav-link-text">Files</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="javascript:void(0);">
											<span class="nav-link-text">Links</span>
										</a>
									</li> -->
								</ul>
								<div class="taskboard-options-wrap flex-1">
									<div class="d-flex ms-auto">

										<div class="v-separator d-xl-flex d-none"></div>
										<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover taskboardapp-info-toggle ms-xl-0" href="#"><span class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Info"><span class="feather-icon"><i data-feather="info"></i></span></span></a>
										<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover hk-navbar-togglable d-sm-inline-block d-none" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Collapse">
											<span class="icon">
												<span class="feather-icon"><i data-feather="chevron-up"></i></span>
												<span class="feather-icon d-none"><i data-feather="chevron-down"></i></span>
											</span>
										</a>
									</div>
								</div>
								<!-- <div class="hk-sidebar-togglable"></div> -->
							</header>

							<!--  -->
	
							
							<div class="taskboard-body">
								<div>
									<div id="kb_scroll" class="tasklist-scroll position-relative">
										<div id="tasklist_wrap" class="tasklist-wrap">
											<?php 
											// if(special_pipeline_access('SALES DEPARTMENT')){
                                            //     $access = 'yes';
											// 	echo $access;											}
											foreach($pipeline->get()->getResult() as $key => $item){ 
												if(special_pipeline_access($item->name)){
											?>
												
												<!--  -->
												<div class="card card-simple card-border tasklists">
													<div class="card-header card-header-action">
														<div class="tasklist-handle">
															<h6 class="text-uppercase fw-bold  d-flex align-items-center mb-0"><span class="tasklist-name"><?= $item->name ?></span> </h6>
															<div class="card-action-wrap">
															<?php
																$db      = \Config\Database::connect();
																$sess = session()->get('id');
																$builder = $db->table('leads')->where('pipeline_id',$item->id)->where('stage',1)->where('user_id',$sess);
																$count = $builder->countAllResults();
																?>
												
																<span class="badge badge-pill badge-soft-violet ms-2"><?= $count ?></span>
															</div>
														</div>
														<!-- <button class="btn btn-white btn-block btn-add-newtask" data-bs-toggle="modal" data-bs-target="#add_new_card"><span><span class="icon"><span class="feather-icon"><i data-feather="plus"></i></span></span></span></button> -->
													</div>
													<div data-simplebar class="card-body">
														<div id="i1" class="tasklist-cards-wrap">
															<!--  -->
															<?php
															$user_id = session()->get('id');
															$department = session()->get('department');
															$department_status = session()->get('status');
															// echo $department_status;
															foreach($leads as $key => $item2){
																// echo $user_id;
																if($item->id == $item2->pipeline_id){ 

																?>
																	
																	<div class="card card-border card-simple tasklist-card">
																		<div class="card-header card-header-action">
																			<div>
																				<h6 class="fw-bold"><?= $item2->firstname;?></h6>
																				<h6 class="fw-bold"><?= $item2->deal_title;?></h6>
																			</div>
																			<div class="card-action-wrap">
																				<a class="btn btn-xs btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" href="#" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																				<div class="dropdown-menu dropdown-menu-end">
																					<a class="dropdown-item" href="<?php base_url() ?>/lead/edit/<?php echo $item2->id ?>"><span class="feather-icon dropdown-icon"><i data-feather="edit-2"></i></span><span>Edit</span></a>
																					<!-- <a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="user"></i></span><span>Assign to</span></a>
																					<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="paperclip"></i></span><span>Attach files</span></a>
																					<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="tag"></i></span><span>Apply Labels</span></a>
																					<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="calendar"></i></span><span>Set Due Date</span></a>
																					<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="bookmark"></i></span><span>Follow Task</span></a>
																					<div class="dropdown-divider"></div>
																					<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="arrow-up"></i></span><span>Set as Top Priority</span></a>
																					<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="repeat"></i></span><span>Change Status</span></a>
																					<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="pocket"></i></span><span>Save as Template</span></a>
																					<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="archive"></i></span><span>Move to archive</span></a>
																					<a class="dropdown-item delete-task" href="#"><span class="feather-icon dropdown-icon"><i data-feather="trash-2"></i></span><span>Delete</span></a> -->
																				</div>
																			</div>
																		</div>

															<!-- <div class="card-body">
																<div class="avatar-group avatar-group-overlapped">
																	<div class="avatar avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dean">
																		<img src="dist/img/avatar13.jpg" alt="user" class="avatar-img">
																	</div>
																	<div class="avatar avatar-xs avatar-soft-danger avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tom">
																		<span class="initial-wrap">B</span>
																	</div>
																	<div class="avatar avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Danial">
																		<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
																	</div>
																</div>
															</div> -->

															<div class="card-footer text-muted justify-content-between">
																<div>
																	<span class="task-counter">
																		<span><i class="ri-checkbox-line"></i></span>
																		<span>
																		<?= date('h:i:s a (l)',strtotime($item2->expected_close_date));?>
																	
																		</span>
																	</span>
																	<!-- <span class="task-discuss">
																		<span><i class="ri-message-3-line"></i></span>
																		<span>24</span>
																	</span> -->
																</div>
																<div>
																	<span class="task-deadline">
																		<?= date('d ,M, Y',strtotime($item2->expected_close_date));?>
																	</span>
																</div>
															</div>
														</div>
													<?php }}?>


												</div>
											</div>
										</div>
										<!--  -->
									<?php }} ?>
								</div>
							</div>
						</div>
					</div>
					<!--  -->

					<div class="taskboard-info">
						<div data-simplebar class="nicescroll-bar">
							<button type="button" class="info-close btn-close mb-10">
								<span aria-hidden="true">×</span>
							</button>
							<form role="search" class="mt-xl-0 mt-5">
								<input type="text" class="form-control" placeholder="Search in conversation">
							</form>
							<div class="collapse-simple mt-4">
								<div class="card">
									<div class="card-header">
										<a role="button" data-bs-toggle="collapse" href="#members" aria-expanded="true">Members</a>
									</div>
									<div id="members" class="collapse show">
										<div class="card-body">
											<ul class="hk-list">
												<li>
													<div class="avatar avatar-sm avatar-primary avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Hencework">
														<span class="initial-wrap">H</span>
													</div>
												</li>
												<li>
													<div class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Morgan">
														<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
													</div>
												</li>
												<li>							
													<div class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Charlie">
														<img src="dist/img/avatar13.jpg" alt="user" class="avatar-img">
													</div>
												</li>
												<li>
													<div class="avatar avatar-sm avatar-rounded position-relative" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tom">
														<img src="dist/img/avatar7.jpg" alt="user" class="avatar-img">
														<span class="badge badge-success badge-indicator badge-indicator-lg position-bottom-end-overflow-1"></span>
													</div>
												</li>
												<li>
													<div class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Katherine">
														<img src="dist/img/avatar9.jpg" alt="user" class="avatar-img">
													</div>
												</li>
												<li>	
													<div class="avatar avatar-sm avatar-rounded position-relative" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Danial">
														<img src="dist/img/avatar10.jpg" alt="user" class="avatar-img">
														<span class="badge badge-success badge-indicator badge-indicator-lg position-bottom-end-overflow-1"></span>
													</div>
												</li>
												<li>	
													<div class="avatar avatar-sm avatar-rounded position-relative" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Boss">
														<img src="dist/img/avatar15.jpg" alt="user" class="avatar-img">
														<span class="badge badge-success badge-indicator badge-indicator-lg position-bottom-end-overflow-1"></span>
													</div>
												</li>
												<li>	
													<div class="avatar avatar-sm avatar-soft-danger avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Winston">
														<span class="initial-wrap">W</span>
													</div>
												</li>
												<li>	
													<a href="#" class="avatar avatar-sm avatar-icon avatar-soft-light avatar-rounded" data-bs-toggle="modal" data-bs-target="#invite_people">
														<span class="initial-wrap" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add New">
															<span class="feather-icon"><i data-feather="plus"></i></span>
														</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<a role="button" data-bs-toggle="collapse" href="#activity" aria-expanded="true">Latest Activity</a>
									</div>
									<div id="activity" class="collapse show">
										<div class="card-body">
											<ul class="activity-list list-group list-group-flush">
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-primary avatar-rounded">
																<span class="initial-wrap">H</span>
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Hencework</span> on Documentation link is working now - <a href="#" class="link-url"><u>ttps://hencework.com/theme/jampa</u></a></p>
															<div class="last-activity-time">Oct 15, 2021, 12:34 PM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-rounded">
																<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Morgan Fregman</span> completed react conversion of <a href="#" class="link-default"><u>components</u></a></p>
															<div class="last-activity-time">Sep 16, 2021, 4:54 PM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-rounded">
																<img src="dist/img/avatar13.jpg" alt="user" class="avatar-img">
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Jimmy Carry</span>completed side bar menu on <a href="#" class="link-default"><u>elements</u></a></p>
															<div class="last-activity-time">Sep 10, 2021, 10:13 AM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-rounded">
																<img src="dist/img/avatar7.jpg" alt="user" class="avatar-img">
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Charlie Chaplin</span> deleted empty cards on <a href="#" class="link-default"><u>completed</u></a></p>
															<div class="last-activity-time">Sep 10, 2021, 10:13 AM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-soft-danger avatar-rounded">
																<span class="initial-wrap">W</span>
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Winston Churchills</span> created a note on UI components task list</p>
															<div class="last-activity-time">Sep 2, 2021, 9:23 AM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-rounded">
																<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Morgan Fregman</span> completed react conversion of <a href="#" class="link-default"><u>components</u></a></p>
															<div class="last-activity-time">Sep 16, 2021, 4:54 PM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-rounded">
																<img src="dist/img/avatar13.jpg" alt="user" class="avatar-img">
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Jimmy Carry</span>added shared components to <a href="#" class="link-default"><u>basic structure</u></a></p>
															<div class="last-activity-time">Sep 10, 2021, 10:13 AM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-primary avatar-rounded">
																<span class="initial-wrap">H</span>
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Hencework</span> commented on <a href="#" class="link-default"><u>basic structure</u></a></p>
															<div class="last-activity-time">Sep 10, 2021, 10:13 AM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-rounded">
																<img src="dist/img/avatar7.jpg" alt="user" class="avatar-img">
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Charlie Chaplin</span> moved components from all modules to in progress</p>
															<div class="last-activity-time">Sep 10, 2021, 10:13 AM</div>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div class="media">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-soft-danger avatar-rounded">
																<span class="initial-wrap">W</span>
															</div>
														</div>
														<div class="media-body">
															<p><span class="text-dark">Winston Churchills</span> created a note on UI components task list</p>
															<div class="last-activity-time">Sep 10, 2021, 10:13 AM</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Task Details -->
				<div id="task_detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-xl task-detail-modal" role="document">
						<div class="modal-content">
							<div class="modal-body p-0">
								<header class="task-header">
									<div class="d-flex align-items-center">
										<div id="sparkline_chart_7"></div>
										<div class="form-check mx-lg-3 ms-3">
											<input type="checkbox" class="form-check-input" id="customCheckcTask" checked>
											<label class="form-check-label d-lg-inline d-none" for="customCheckcTask">Mark as completed</label>
										</div>
										<button class="btn btn-flush-light flush-outline-hover d-lg-inline-block d-none"><span><span class="icon"><span class="feather-icon"><i data-feather="link"></i></span></span><span>Copy Link</span></span></button>
										<button class="btn btn-icon btn-light btn-rounded d-lg-none d-lg-inline-block ms-1"><span><span class="icon"><span class="feather-icon"><i data-feather="link"></i></span></span></span></button>
									</div>
									<div class="task-options-wrap">	
										<span class="task-star marked"><span class="feather-icon"><i data-feather="star"></i></span></span>
										<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover ms-1 d-lg-inline-block d-none" href="#" ><span class="icon"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
										<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" href="#" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
										<div class="dropdown-menu dropdown-menu-end">
											<h6 class="dropdown-header">Action</h6>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="edit"></i></span><span>Assign to</span></a>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="user"></i></span><span>Attach files</span></a>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="paperclip"></i></span><span>Apply Labels</span></a>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="tag"></i></span><span>Set Due Date</span></a>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="calendar"></i></span><span>Follow Task</span></a>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="bookmark"></i></span><span>Set Due Date</span></a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="arrow-up"></i></span><span>Set as Top Priority</span></a>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="repeat"></i></span><span>Change Status</span></a>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="pocket"></i></span><span>Save as Template</span></a>
											<a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i data-feather="archive"></i></span><span>Move to archive</span></a>
											<a class="dropdown-item delete-task" href="#"><span class="feather-icon dropdown-icon"><i data-feather="trash-2"></i></span><span>Delete</span></a>
										</div>
									</div>
								</header>
								<div class="task-detail-body">

									<!-- <div class="alert alert-primary alert-wth-icon fade show mb-4" role="alert">
										<span class="alert-icon-wrap"><span class="feather-icon"><i class="zmdi zmdi-lock"></i></span></span> This task is private for Jampack Team
									</div> -->
									<h4 class="d-flex align-items-center fw-bold mb-0 inline-editable-wrap leadPopUp"><span class="editable leadTitle">Title Here</span>
									</h4>
									<p  class="d-flex align-items-center inline-editable-wrap leadPopUp"><span class="editable leadDescription">Instant rebuilding of assets during development</span>
									</p>
									
									<form class="row">
										<div class="col-md-4">
											<div class="title title-wth-divider my-4"><span>Created By</span></div>
											<div class="media align-items-center">
												<div class="media-head">
													<div class="avatar avatar-sm avatar-primary avatar-rounded">
														<span class="initial-wrap">M</span>
													</div>
												</div>
												<div class="media-body">
													<div class="as-name">Muhammad Faizan</div>
													<div class="as-date">4 july 2022, 8:30pm</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="title title-wth-divider my-4"><span>Due Date</span></div>
											<input class="form-control" type="text" name="single-date" />
										</div>
										<div class="col-md-4">
											<div class="title title-wth-divider my-4"><span>Status</span></div>
											<div class="dropdown">
												<button aria-expanded="false" data-bs-toggle="dropdown" class="btn btn-warning btn-rounded dropdown-toggle" type="button">In Progress</button>
												<div role="menu" class="dropdown-menu">
													<a class="dropdown-item" href="#">Action</a>
													<a class="dropdown-item" href="#">Another action</a>
													<a class="dropdown-item" href="#">Something else here</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="#">Separated link</a>
												</div>
											</div>
										</div>
									</form>
									<ul class="nav nav-justified nav-light nav-tabs nav-segmented-tabs active-theme mt-4">
										<!-- <li class="nav-item">
											<a class="nav-link active" data-bs-toggle="tab" href="#tab_checklist">
												<span class="nav-link-text">Checklist</span>
											</a>
										</li> -->
										<li class="nav-item">
											<a class="nav-link active" data-bs-toggle="tab" href="#tab_comments">
												<span class="nav-link-text badge-on-text">Comments</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#tab_timeline">
												<span class="nav-link-text badge-on-text">Timeline</span>
											</a>
										</li>
										<!-- <li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#tab_activity">
												<span class="nav-link-text badge-on-text">Activity</span>
											</a>
										</li> -->
									</ul>
									<div class="tab-content mt-7">
										
										<div class="tab-pane fade show active" id="tab_comments">
											
											<div class="comment-block" style="max-height:300px;overflow-y:auto;">
												<div id="chats" >

												</div>
												
												
											</div>
											<form id="addChatForm" class="position-relative">
												<input type="hidden" name="lead_id" id="lead_id">
												<div class="input-group mt-3 mb-3">
													<textarea class="form-control" aria-label="With textarea" rows="1" placeholder="Add Comment" name="chat_text"></textarea>
													<button type="submit" class="btn btn-primary input-group-text"><i class="fa fa-paper-plane"></i> </button>
												</div>
											</form>
										</div>
										<div class="tab-pane fade" id="tab_timeline">
											<p>This is time line tab</p>
										</div>
									</div>
								</div>
								<div class="task-action-wrap">
									<div class="nicescroll-bar">
										<div class="title title-xs text-primary"><span>Pipelines</span></div>
										<div class="btn-group-vertical w-100" id="pipelines" role="group" aria-label="Button group with nested dropdown">
											<?php
											foreach($pipeline2->get()->getResult() as $item3)
											{ 

												?>
												<button type="button" data-id="<?php echo $item3->id ?>" class="btn btn-outline-primary movelead"><?php echo $item3->name ?></button>
												<?php
											}
											?>
										</div>
										<!-- <div class="radio-buttons">
											<div class="form-group">
												<input type="radio" id="sales" name="department" />
												<label for="sales">Sales</label>
											</div>

											<div class="form-group">
												<input type="radio" id="noc" name="department" />
												<label for="noc">NOC</label>
											</div>

											<div class="form-group">
												<input type="radio" id="support" name="department" />
												<label for="support">Support</label>
											</div>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Task Details -->

				<!-- Add New Card -->
				<div id="add_new_card" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="btn-close mb-20" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<ul class="nav nav-justified nav-light nav-tabs nav-segmented-tabs active-theme mt-4">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#tab_leads2">
											<span class="nav-link-text badge-on-text">Lead</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#tab_product">
											<span class="nav-link-text badge-on-text">Product</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#tab_reminder">
											<span class="nav-link-text badge-on-text">Reminder</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#tab_follow-up">
											<span class="nav-link-text badge-on-text">Follow Up</span>
										</a>
									</li>

									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#tab_feasibility">
											<span class="nav-link-text badge-on-text">Feasibility Form</span>
										</a>
									</li>
								</ul>
								<div class="tab-content mt-3">

									<!-- <div class="tab-pane fade show active" id="tab_leads">
										<form id="" class="form-horizontal form-label-left input_mask">
											<div class="modal-body">
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<h5 class="mb-4">Create New Leads</h5>
												<div class="row gx-3">
													<div class="col-sm-12">
														<div class="form-group">
															<label class="form-label">Name</label>
															<input class="form-control task-name" name="name" id="exampleFormControlInput1" type="text" />
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group">
															<label class="form-label">Start Date</label>
															<input class="form-control" name="startdate" min="2023-06-07" id="exampleFormControlInput1" type="date" />
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group">
															<label class="form-label">End Date</label>
															<input class="form-control" name="enddate" id="exampleFormControlInput1" type="date"/>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="form-label">Description</label>
															<textarea class="form-control" name="description" id="exampleFormControlInput1" rows="3"></textarea>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group mt-3">
															<label class="form-label">Set priority:</label>
															<div class="form-check form-check-inline">
																<div class="form-check form-check-primary">
																	<input type="radio" id="priority" name="priority" value="high" class="form-check-input">
																	<label class="form-check-label" for="customRadioc2">High</label>
																</div>
															</div>
															<div class="form-check form-check-inline">
																<div class="form-check form-check-primary">
																	<input type="radio" id="priority" name="priority" value="medium" class="form-check-input">
																	<label class="form-check-label" for="customRadioc3">Medium</label>
																</div>
															</div>
															<div class="form-check form-check-inline">
																<div class="form-check form-check-primary">
																	<input type="radio" id="priority" name="priority" value="low" class="form-check-input" checked>
																	<label class="form-check-label" for="customRadioc4">Low</label>
																</div>
															</div>
														</div>
													</div>
												</div>

											</div>
											<div class="modal-footer align-items-center">
												 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> 
												<button type="submit" class="btn btn-primary " >Add</button>
											</div>
										</form>
									</div> -->
									<form id="MainLeadForm">
									<div class="tab-pane fade show active" id="tab_leads2">
										
											<div class="modal-body modal-lg">
												<div class="row gx-3">
													<div class="col-sm-6">	
														<div class="form-group">
															<input class="form-control task-name" placeholder="Firstname" name="firstname_lead" id="exampleFormControlInput1" type="text" />
														</div>
													</div>
													<div class="col-sm-6">	
														<div class="form-group">

															<input class="form-control task-name" placeholder="Lastname" name="lastname_lead" id="exampleFormControlInput1" type="text" />
														</div>
													</div>

													<div class="col-sm-6">	
														<div class="form-group">
															
															<input class="form-control task-name" placeholder="Organization" name="organization" id="exampleFormControlInput1" type="text" />
														</div>
													</div>
													<div class="col-sm-6">	
														<div class="form-group">
															
															<input class="form-control task-name" placeholder="Job Title" name="job_title" id="exampleFormControlInput1" type="text" />
														</div>
													</div>

													<div class="col-sm-6">	
														<div class="form-group">

															<input class="form-control task-name" placeholder="Email Address" name="email_address_lead" id="exampleFormControlInput1" type="text" />
														</div>
													</div>
													<div class="col-sm-6">	
														<div class="form-group">
															
															<input class="form-control task-name" placeholder="phone" name="phone" id="exampleFormControlInput1" type="text" />
														</div>
													</div>

													<div class="col-sm-6">
														<div class="form-group">
															<select class="form-control" name="country" id="country">
																<?php
																foreach($country->get()->getResult() as $value){
																	?>
																	<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>	
																	<?php
																}
																?>	
															</select>
														</div>
													</div>

													<div class="col-sm-6">
														<div class="form-group">
															<select class="form-control" name="state" id="state">

															</select>
														</div>
													</div>


													<div class="col-sm-12">	
														<div class="form-group">

															<input class="form-control task-name" placeholder="Deal Title" name="deal_title" id="exampleFormControlInput1" type="text" />
														</div>
													</div>

													<div class="col-sm-6">
														<div class="form-group">
															<select class="form-control" name="currency" id="exampleFormControlInput1">
																<option value="PKR">Pakistani Rupee</option>
																<option value="INR">Indian Rupee</option>
															</select>
														</div>
													</div>

													<div class="col-sm-6">
														<div class="form-group">
															<input class="form-control task-name" name="amount"  placeholder="0.00" id="exampleFormControlInput1" type="number" />
														</div>
													</div>


													<div class="col-sm-6">
														<div class="form-group">
															<select class="form-control" name="industry" id="exampleFormControlInput1">
																<option value="finance">Finance</option>
																<option value="intenet">Tech</option>
															</select>
														</div>
													</div>

													<div class="col-sm-6">	
														<div class="form-group">
															<input class="form-control task-name" placeholder="choose close date" name="expected_close_date" id="exampleFormControlInput1" type="datetime-local" />
														</div>
													</div>
												</div>
											</div>

											<div class="modal-footer align-items-center">
												<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
												<button type="submit" class="btn btn-primary">Add</button>
											</div>
										<!-- </form> -->
									</div>

									<div class="tab-pane fade" id="tab_product">
										<button type="button" class="btn btn-primary btn-sm" id="addButton">
											<i class="fa fa-plus"></i> Add Row
										</button>

											<!-- <div id="product"></div>
											<div id="product_code"></div>
											<div id="unit"></div>
											<div id="unit_price"></div>
											<div id="total_tax"></div> -->

										<div class="table-responsive">
											<table class="table productTable">
												<thead>
													<tr>
														<th>Category</th>
														<th>Product</th>
														<th>Price</th>
														<th>Quantity</th>
														<th>Tax</th>
														<th>Discount</th>
														<th>Amount</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="table_container">
										

												</tbody>
											</table>
											<!---table append here--->
										</div>

										<div class="modal-footer align-items-center">
											<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
											<button type="submit" class="btn btn-primary">save</button>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_reminder">
										<!-- <form id="addReminderForm" class="form-horizontal form-label-left input_mask"> -->
											<div class="modal-body">
												<div class="row gx-3">
												<div class="form-group">
                                   				 <select name="reminder_type" id="reminder_type" class="form-control" autocomplete="off">
													
												    <option value="0">Select Activity type</option>
													<option value="Call">Call</option>
													<option value="Meeting">Meeting</option>
													<option value="Task">Task</option>
													<option value="Deadline">Deadline</option>
													<option value="Email">Email</option>
													<option value="Lunch">Lunch</option>

													</select>
												</div>

													<div class="col-sm-6">
														<div class="form-group">
															<input class="form-control task-name" placeholder="Title" name="title" id="exampleFormControlInput1" type="text" />
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															
															<input class="form-control" name="date" min="2023-06-07" id="exampleFormControlInput1" type="date" />
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">

															<input class="form-control" name="time" id="exampleFormControlInput1" type="time"/>
														</div>
													</div>

													<div class="col-sm-6">
														<div class="form-group">
															<select class="form-control" name="assigned_to" id="exampleFormControlInput1">
																<option value="">select</option>
																<option value="faizan">faizan</option>
																<option value="osman">osman</option>
															</select>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															
															<textarea placeholder="Description" class="form-control" name="description" id="exampleFormControlInput1" rows="3"></textarea>
														</div>
													</div>
												</div>

											</div>
											<div class="modal-footer align-items-center">
												<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
												<button type="submit" class="btn btn-primary " >Add</button>
											</div>
										<!-- </form> -->
									</div>

									<div class="tab-pane fade" id="tab_follow-up">
										<!-- <form id="addFollowUpForm" class="form-horizontal form-label-left input_mask"> -->
										<div class="modal-body">
											<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button> -->
											<div class="row gx-3">
												<div class="col-sm-6">
													<div class="form-group">

														<input class="form-control" placeholder="follow up date" name="follow_up_date" min="2023-06-07" id="exampleFormControlInput1" type="date" />
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														
														<input class="form-control" name="follow_up_time" id="exampleFormControlInput1" type="time"/>
													</div>
												</div>
												<div class="col-sm-12">	
													<div class="form-group">
														
														<input class="form-control task-name"  placeholder="Firstname" name="firstname" id="exampleFormControlInput1" type="text" />
													</div>
												</div>
												<div class="col-sm-12">	
													<div class="form-group">
														
														<input class="form-control task-name" placeholder="Lastname"  name="lastname" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														
														<input class="form-control task-name" placeholder="Email Address" name="email_address" id="exampleFormControlInput1" type="email" />
													</div>
												</div>
												<div class="col-md-12">

													<div class="form-group mt-3">
														<div class="form-check form-check-inline">
															<div class="form-check form-check-primary">
																<input type="radio" name="template" value="Email Template" checked class="form-check-input">
																<label class="form-check-label" for="customRadioc2">Email Template</label>
															</div>
														</div>
														<div class="form-check form-check-inline">
															<div class="form-check form-check-primary">
																<input type="radio" name="template" value="Workflow Template" class="form-check-input">
																<label class="form-check-label" for="customRadioc3">Workflow Template</label>
															</div>
														</div>
														
													</div>
												</div>
												<div class="col-sm-12">
													<div class="form-group">
														<select class="form-control" name="email_template" id="exampleFormControlInput1">
															<option value="">select Email Template</option>
															<?php
															foreach($email_templates->get()->getResult() as $item){
															?> 
															<option value="<?= $item->id ?>"><?= $item->template_name ?></option>

															<?php
																}
															?>
															
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer align-items-center">
											<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
											<button type="submit" class="btn btn-primary">Add</button>
										</div>
									</div>
									<!--------tab of Feasibility form start--------->
										<div class="tab-pane fade" id="tab_feasibility">
										<div class="modal-body">
											<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button> -->
											<div class="row gx-3">
												<div class="col-sm-6">
													<div class="form-group">
													<select class="form-control form-select" name="customer_type">
													<option value="">Select Customer Type</option>
													<option value="Private">Private</option>
												</select>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<input class="form-control" placeholder="Customer Name" name="customer_name" id="exampleFormControlInput1" type="text"/>
													</div>
												</div>
												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name"  placeholder="Address" name="address" id="exampleFormControlInput1" type="text" />
													</div>
												</div>
												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" placeholder="POC (Point Of Contact)"  name="poc" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" placeholder="POC Phone" name="poc_phone" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" placeholder="Gps/Google coordinates" name="google_coordinates" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" placeholder="Originally Request By" name="originally_request_by" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" placeholder="Sales Person" name="sales_person" id="exampleFormControlInput1" type="email" />
													</div>
												</div>

												<div class="modal-footer align-items-center">
													<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
													<button type="submit" class="btn btn-primary">Add</button>
												</div>
										    </div>	
									  </div>
									<!--------tab of Feasibility form End--------->
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
		<!-- </div> -->
				<!-- /Add New Card -->

				<!-- Add Task List -->
				<div id="add_task_list" class="modal fade add-tasklist-modal" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<h5 class="mb-4">Add Task List</h5>
								<form>
									<div class="row gx-3">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input class="form-control" type="text"/>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer align-items-center">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-primary btn-add-tasklist" >Add</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Task List -->

				<!-- Edit Task List -->
				<div id="edit_task_list" class="modal fade edit-tasklist-modal" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<h5 class="mb-4">Create Task List</h5>
								<form>
									<div class="row gx-3">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input class="form-control" type="text"/>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer align-items-center">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-primary btn-edit-tasklist" >Save</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Task List -->

				<!-- Add New Board -->
				<div id="add_new_board" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<h5>Add New Board</h5>
								<p class="mb-4">You are granted limited license only for purposes of viewing the material contained on this Website.</p>
								<form>
									<div class="row gx-3">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input class="form-control task-name" type="text"/>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Visibility</label>
												<select class="form-control form-select">
													<option selected="">Public</option>
													<option value="1">Private</option>
												</select>
												<small class="form-text text-muted">
													Public setting will be seen by everybody with login details.
												</small>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Avatar</label>
												<select class="form-control form-select">
													<option selected="">Choose Avatar-Text</option>
													<option value="1">A</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Avatar Color</label>
												<div class="input-group color-picker" title="Using horizontal option">
													<span class="input-group-text colorpicker-input-addon"><i></i></span>
													<input type="text" class="form-control" value="#009B84"/>
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<div class="dropify-square">
													<input type="file"  class="dropify-1"/>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer align-items-center">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-primary" >Add</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add New Board -->

				<!-- Add Fav Board -->
				<div class="modal fade" id="add_fav_board" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-dialog-centered mw-400p" role="document">
						<div class="modal-content">
							<div class="modal-header header-wth-bg-inv">
								<h5 class="modal-title">Add Board</h5>
								<button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body p-0">
								<div>
									<div data-simplebar class="nicescroll-bar h-350p">
										<ul class="p-3 pb-0">
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-primary avatar-rounded">
															<span class="initial-wrap">J</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">Jampack</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck2" checked>
												</div>
											</li>
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-danger avatar-rounded">
															<span class="initial-wrap">H</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">Hencework</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck3" checked>
												</div>
											</li>
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-info avatar-rounded">
															<span class="initial-wrap">G</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">Griffin</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck4">
												</div>
											</li>
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-warning avatar-rounded">
															<span class="initial-wrap">R</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">React - Jampack</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck5" checked>
												</div>
											</li>
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-primary avatar-rounded">
															<span class="initial-wrap">P</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">Pangong</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck6" checked>
												</div>
											</li>
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-success avatar-rounded">
															<span class="initial-wrap">A</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">Angular - Jampack</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck7" checked>
												</div>
											</li>
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-warning avatar-rounded">
															<span class="initial-wrap">R</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">React - Jampack</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck8">
												</div>
											</li>
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-primary avatar-rounded">
															<span class="initial-wrap">P</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">Pangong</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck9">
												</div>
											</li>
											<li class="d-flex align-items-center justify-content-between mb-3">
												<div class="media d-flex align-items-center">
													<div class="media-head me-2">
														<div class="avatar avatar-xs avatar-success avatar-rounded">
															<span class="initial-wrap">A</span>
														</div>
													</div>
													<div class="media-body">
														<div class="name">Angular - Jampack</div>	
													</div>
												</div>
												<div class="form-check">
													<input type="checkbox" class="form-check-input" id="customCheck10">
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="modal-footer justify-content-center">
								<button type="button" class="btn flex-fill btn-light flex-1" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="btn flex-fill btn-primary flex-1" data-bs-dismiss="modal">Add Board</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Fav Board -->
			</div>
		</div>
	</div>
	<!-- /Page Body -->
</div>
<!-- /Main Content -->
</div>

<?php
echo view('cpanel-layout/footer');
?>
<script>
	

</script>
<!----------add lead  using ajax-------->
<script type="text/javascript">
	$('#task_detail').on('shown.bs.modal', function (e) {

		var element = document.getElementById('chats');
		element.scrollTop = element.scrollHeight;

		let width = element.offsetWidth;
		let height = element.offsetHeight;
		console.log(width);
		console.log(height);
		// console.log(element.scrollTop);
		// $('#chats').scrollTop($('#chats').height());
	})
	$(document).ready(function() {
		// $('.comment-block').scrollTop($('.comment-block').height());
		$("#MainLeadForm").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Lead/add_leads',
				// data:$("#MainLeadForm").serialize(),
				data:  new FormData(this),
				contentType: false,
        		cache: false,
        		processData:false,
				success: function (data) {
					toastr.success(data);
					location.reload();
				},
				error: function(jqXHR, text, error){
					toastr.error(error);
				}
			});
			return false;
		});
	});
</script>
<!----------get lead detail using attribute-------->
<script>
	$(document).on('click','.editLeads',function(){
		var id = $(this).attr('data-id');
        // $('#pipeline .movelead').css('background-color', 'transparent');
		// $('#pipeline .movelead').css('color', '#007D88');
		//
		$.ajax({
			dataType: 'json',
			type: "POST",
			url: "<?php echo base_url();?>/Lead/leads_detail",
			data:'id='+id,
			success: function(response){
				$('.leadPopUp .leadTitle').html(response.lead.deal_title);
				$('.leadPopUp .leadDescription').html(response.lead.description);
				$('#addChatForm #lead_id').val(id);
					//  console.log(response.lead.stage);
				$('[data-id="'+response.lead.pipeline_id+'"]').css('background-color', '#007d88');
				$('[data-id="'+response.lead.pipeline_id+'"]').css('color', '#ffffff');
				get_chats(id);
			},error: function(jqXHR, text, error){
				toastr.error(error);
			}
		});
	});
</script>
<!----------fetch chat using ajax-------->
<script>
	function get_chats(lead_id){
		$.ajax({
			method: 'POST',
			url: '<?php echo base_url();?>/Lead/show_chats',
			data:'lead_id='+lead_id,
			success: function(data){
				$('#chats').html(data);
			}
		});
	}
</script>
<!----------add chat using ajax-------->
<script type="text/javascript">
	$(document).ready(function() {
		$("#addChatForm").submit(function() {
			var lead_id = $('#addChatForm #lead_id').val();
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Lead/add_chat',
				data:$("#addChatForm").serialize(),
				success: function (data) {
					get_chats(lead_id);
                    // toastr.success(data);
					$("#addChatForm").trigger("reset");
				},
				error: function(jqXHR, text, error){
					toastr.error(error);
				}
			});
			return false;
		});
	});
</script>
<!----------add Reminder using ajax-------->
<script type="text/javascript">
	$(document).ready(function() {
		$("#addReminderForm").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Lead/addReminder',
				data:$("#addReminderForm").serialize(),
				success: function (data) {
					toastr.success(data);
					$("#addReminderForm").trigger("reset");
				},
				error: function(jqXHR, text, error){
					toastr.error(error);
				}
			});
			return false;
		});
	});
</script>

<!----------add followup using ajax-------->
<script type="text/javascript">
	$(document).ready(function() {
		$("#addFollowUpForm").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Lead/addFollowup',
				data:$("#addFollowUpForm").serialize(),
				success: function (data) {
					toastr.success(data);
					$("#addFollowUpForm").trigger("reset");
				},
				error: function(jqXHR, text, error){
					toastr.error(error);
				}
			});
			return false;
		});
	});
</script>


<!---------update or move lead from one department to another by using ajax this code -------->
<script>
	$(document).on('click','.movelead',function(){
		var pipid = $(this).attr('data-id');
		var leadid = $('#addChatForm #lead_id').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/Lead/update_lead",
			data:'pipid='+pipid+'&leadid='+leadid,
			success: function(data){
				console.log(data);
					// toastr.success(data);
					// location.reload();
			}
			,error: function(jqXHR, text, error){
				toastr.error(error);
			}
		});
	});		
</script>

<!------------this code is used t make depent dropdown of country city state ------->
<script>

	$(document).ready(function(){
   // $('#country').change(function(){
		$(document).on('change','#country',function(){
			var id = $(this).val();
			console.log(id);
            //
			$.ajax({
				dataType: 'json',
				type:'POST',
				url: "<?php echo base_url(); ?>/Organization/get_state",
				data: 'id='+id,
				success: function(data){
                    // console.log(data.state);
					$('#state').html('<option value="">select</option>');
					$('#city').html('<option value="">select</option>');
					$.each(data.state, function(index, item) {
						$('#state').append('<option value="'+item.id+'">'+item.name+'</option>');
					});
				},error: function(jqXHR, text, error){
					toastr.error(error);
				}
			});
		}); 
	});
</script>
<!------------this code is used t make depent dropdown of country city state ------->
<script>
	$(document).ready(function(){
		$(document).on('change','#state',function(){
			var id = $('#state').val();
        // alert(id);
			$.ajax({
				dataType: 'json',
				type:'POST',
				url: "<?php echo base_url(); ?>/Organization/get_cities",
				data: 'id='+id,
				success: function(data){
					$('#city').html('<option value="">select</option>');
					$.each(data.cities, function(index, item) {
						$('#city').append('<option value="'+item.id+'">'+item.name+'</option>');
					});              
				},error: function(jqXHR, text, error){
					toastr.error(error);
				}
			});
		}); 
	});
</script>


<!----append table row to add more product using jquery --------->
<script>
	$(document).ready(function() {
		var category = <?php echo json_encode($categories); ?>;
		// array
		var num = 0;
         // Attach click event handler to the button
		$('#addButton').click(function() {
            // Append a new input field to the container
		    var html = '';
      	    // html += '<tr><td><select id="category'+num+'" name="category" class="form-control"><option value="">select</option>';
			html += '<tr id="row'+num+'"><td><select id="category" name="category[]"  class="form-control category" data-ser="'+num+'"> <option value="">please select</option>';
      	    //
			jQuery.each(category, function(index, item) {
				html += '<option value="'+item.id+'">'+item.category_name+'</option>';
			});
			//
			html += '</select></td>';
		    //
			html += '<td><select id="product" name="product[]" class="form-control product" data-ser="'+num+'"> ';

			html += '</select></td>';

			html += '<td><input class="form-control" id="price" name="price[]" type="number" readonly></td> <td><input class="form-control" value="" min="1" id="quantity" name="quantity[]" type="number"></td> <td><input class="form-control" value="" id="tax" name="tax[]" type="number" readonly></td> <td><input class="form-control" value="" id="discount" name="discount[]" type="number" readonly></td> <td><input class="form-control" value="" id="amount" name="amount_product[]" type="number" readonly></td> <td><a href="javascript:void(0);" class="text-danger deleteRow" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-alt"></i></a></td> </tr>';

			$('.productTable tbody').append(html);
        //
			num++;
		});
		$(document).on('click','.deleteRow',function(){
			$(this).parent().closest('tr').remove();
		});
	});


</script>


<!------------this code is used to fetch data according to category ------->
<script>
	$(document).ready(function(){
		$(document).on('change','.category',function(){
			var rowid = $(this).attr('data-ser');
			var id =  $(this).val();
			// alert(id);
        	// 
			$.ajax({
				dataType: 'json',
				type:'POST',
				url: "<?php echo base_url(); ?>/Lead/get_product_ac_category",
				data: 'id='+id,
				success: function(response){
				// console.log(response.products);
				$('#row'+rowid+' #product').html('');
				$('#row'+rowid+' #product').html('<option value="">please select</option>');
				jQuery.each(response.products, function(index, item) {
				$('#row'+rowid+' #product').append('<option value="'+item.id+'">'+item.product_name+'</option>');

			    });

				},
				error: function(jqXHR, text, error){
					toastr.error(error);
				}
			});
		}); 
	});
</script>
<!------------this code is used to fetch data according to product ------->
<script>
	$(document).ready(function(){
		$(document).on('change','.product',function(){
			var rowid = $(this).attr('data-ser');
			var id =  $(this).val();
			// alert(id);
        	// 
			$.ajax({
				dataType: 'json',
				type:'POST',
				url: "<?php echo base_url(); ?>/Lead/get_data_ac_product",
				data: 'id='+id,
				success: function(response){
                    //  console.log(response.products_data.id);

					// $('#unit').html(response.products_data.unit);
					// $('#product_code').html(response.products.product_code);
				    // $('#row'+rowid+' #product_name').val(response.products.product_name);
					$('#row'+rowid+' #price').val(response.products_data.unit_price);
					$('#row'+rowid+' #quantity').val(response.products_data.unit);
					$('#row'+rowid+' #tax').val(response.products_data.total_tax);
					$('#row'+rowid+' #discount').val(response.products_data.discount);
					$('#row'+rowid+' #amount').val(response.products_data.amount);
					// $('#unit_price').html(response.products.unit_price);
					// $('#total_tax').html(response.products.total_tax);

				},
				error: function(jqXHR, text, error){
					toastr.error(error);
				}
			});
		}); 
	});
</script>



<script>
	$('#closemodal').click(function() {
		$('#addOrganizationModel').modal('hide');
	});
</script>
