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
											<div class="alert alert-primary alert-wth-icon fade show mb-4" role="alert">
												<span class="alert-icon-wrap"><span class="feather-icon"><i class="zmdi zmdi-lock"></i></span></span> This task is private for Jampack Team
											</div>
											<h4 class="d-flex align-items-center fw-bold mb-0 inline-editable-wrap"><span class="editable">Framworking Building</span><a class="btn btn-sm btn-icon btn-flush-light btn-rounded flush-soft-hover edit-tyn ms-1" href="#"><span class="icon"><span class="feather-icon"><i data-feather="edit-2"></i></span></span></a></h4>
											<p  class="d-flex align-items-center inline-editable-wrap"><span class="editable">Instant rebuilding of assets during development</span><a class="btn btn-sm btn-icon btn-flush-light btn-rounded flush-soft-hover edit-tyn ms-1" href="#"><span class="icon"><span class="feather-icon"><i data-feather="edit-2"></i></span></span></a></p>
											<div class="avatar-group avatar-group-lg avatar-group-overlapped mt-3">
												<div class="avatar avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Katharine">
													<img src="dist/img/avatar8.jpg" alt="user" class="avatar-img">
												</div>
												<div class="avatar avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dean">
													<img src="dist/img/avatar13.jpg" alt="user" class="avatar-img">
												</div>
												<div class="avatar avatar-xs avatar-soft-danger avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tom">
													<span class="initial-wrap">T</span>
												</div>
												<div class="avatar avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Morgan">
													<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
												</div>
												<div class="avatar avatar-icon avatar-primary avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tooltip text">
													<span class="initial-wrap"><span class="feather-icon"><i data-feather="plus"></i></span></span>
												</div>
											</div>	
											<form class="row">
												<div class="col-md-4">
													<div class="title title-wth-divider my-4"><span>Assignee</span></div>
													<div class="media align-items-center">
														<div class="media-head">
															<div class="avatar avatar-sm avatar-primary avatar-rounded">
																<span class="initial-wrap">H</span>
															</div>
														</div>
														<div class="media-body">
															<div class="as-name">Hencework</div>
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
												<div class="col-md-12">
													<div class="title title-wth-divider my-4"><span>Labels</span></div>
													<input type="text" id="exist_values1" class="user-input-tagged form-control" name="tag-3" value="Framework,Html" placeholder="Add Chips">
												</div>
											</form>
											<ul class="nav nav-justified nav-light nav-tabs nav-segmented-tabs active-theme mt-4">
												<li class="nav-item">
													<a class="nav-link active" data-bs-toggle="tab" href="#tab_checklist">
														<span class="nav-link-text">Checklist</span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-bs-toggle="tab" href="#tab_comments">
														<span class="nav-link-text badge-on-text">Comments</span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-bs-toggle="tab" href="#tab_files">
														<span class="nav-link-text badge-on-text">Files</span>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-bs-toggle="tab" href="#tab_activity">
														<span class="nav-link-text badge-on-text">Activity</span>
													</a>
												</li>
											</ul>
											<div class="tab-content mt-7">
												<div class="tab-pane fade show active" id="tab_checklist">
													<div class="d-flex align-items-center justify-content-between mb-2">
														<div class="title title-lg mb-0"><span>Checklist</span></div>
														<a href="#" class="btn btn-xs btn-icon btn-rounded btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add Category"><span class="icon"><span class="feather-icon"><i data-feather="plus"></i></span></span></a>
													</div>
													<div class="hk-checklist">
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="customCheckList1" checked="">
															<label class="form-check-label" for="customCheckList1">
																Video conference with canada Team
																<span class="done-strikethrough"></span>
															</label>
															<a href="#" class="btn btn-xs btn-icon btn-rounded btn-flush-light flush-soft-hover delete-checklist"><span class="icon"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
														</div>
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="customCheckList2" checked="">
															<label class="form-check-label" for="customCheckList2">
																Client objective meeting
																<span class="done-strikethrough"></span>
															</label>
															<a href="#" class="btn btn-xs btn-icon btn-rounded btn-flush-light flush-soft-hover delete-checklist"><span class="icon"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
														</div>
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="customCheckList3" checked="">
															<label class="form-check-label" for="customCheckList3">
																Upgrade dependency on resources
																<span class="done-strikethrough"></span>
															</label>
															<a href="#" class="btn btn-xs btn-icon btn-rounded btn-flush-light flush-soft-hover delete-checklist"><span class="icon"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
														</div>
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="customCheckList4">
															<label class="form-check-label" for="customCheckList4">
																Invite jaqueline on video conference
																<span class="done-strikethrough"></span>
															</label>
															<a href="#" class="btn btn-xs btn-icon btn-rounded btn-flush-light flush-soft-hover delete-checklist"><span class="icon"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
														</div>
														<a href="#" class="d-flex align-items-center add-new-checklist">
															<span class="feather-icon fe-x me-2"><i data-feather="plus-square"></i></span>
															<span>New Item</span>
														</a>
													</div>
													<div class="d-flex align-items-center justify-content-between">
														<div class="title title-wth-divider flex-grow-1 my-4 me-2"><span>Canada team task</span></div>
														<div>
															<a href="#" class="btn btn-xs btn-icon btn-rounded btn-flush-light flush-soft-hover delete-checklist" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit"><span class="icon"><span class="feather-icon"><i data-feather="edit-2"></i></span></span></a>
															<a href="#" class="btn btn-xs btn-icon btn-rounded btn-flush-light flush-soft-hover delete-checklist"><span class="icon"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
														</div>
													</div>
													<div class="hk-checklist">
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="customCheckList5" checked="">
															<label class="form-check-label" for="customCheckList5">
																Upgrade dependency on resources
																<span class="done-strikethrough"></span>
															</label>
															<a href="#" class="btn btn-xs btn-icon btn-rounded btn-flush-light flush-soft-hover delete-checklist"><span class="icon"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
														</div>
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="customCheckList6">
															<label class="form-check-label" for="customCheckList6">
																Invite jaqueline on video conference
																<span class="done-strikethrough"></span>
															</label>
															<a href="#" class="btn btn-xs btn-icon btn-rounded btn-flush-light flush-soft-hover delete-checklist"><span class="icon"><span class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
														</div>
														<a href="#" class="d-flex align-items-center add-new-checklist">
															<span class="feather-icon fe-x me-2"><i data-feather="plus-square"></i></span>
															<span>New Item</span>
														</a>
													</div>
													<div class="d-flex align-items-center justify-content-between mt-5 mb-2">
														<div class="title title-lg mb-0"><span>Notes</span></div>
														<a href="#" class="btn btn-xs btn-icon btn-rounded btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add Category"><span class="icon"><span class="feather-icon"><i data-feather="plus"></i></span></span></a>
													</div>
													<div class="card card-border note-block bg-orange-light-5">
														<div class="card-body">
															<div class="card-action-wrap">
																<button class="btn btn-xs btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" aria-expanded="false" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></button>
																<div role="menu" class="dropdown-menu dropdown-menu-end">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																	<div class="dropdown-divider"></div>
																	<a class="dropdown-item" href="#">Separated link</a>
																</div>
															</div>
															<div class="media align-items-center">
																<div class="media-head">
																	<div class="avatar avatar-sm avatar-rounded">
																		<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
																	</div>
																</div>
																<div class="media-body">
																	<div>Martin Luther</div>
																	<div>9 Apr, 20, 7:14 AM</div>
																</div>
															</div>
															<p>@<a href="#" class="fw-medium">Charlie Darvin</a> From there, you can run grunt compile, grunt migrate and grunt test to compile your contracts, deploy those contracts to the network, and run their associated unit tests.</p>
														</div>
													</div>
													<div class="card card-border note-block bg-orange-light-5">
														<div class="card-body">
															<div class="card-action-wrap">
																<button class="btn btn-xs btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" aria-expanded="false" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></button>
																<div role="menu" class="dropdown-menu dropdown-menu-end">
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<a class="dropdown-item" href="#">Something else here</a>
																	<div class="dropdown-divider"></div>
																	<a class="dropdown-item" href="#">Separated link</a>
																</div>
															</div>
															<div class="media align-items-center">
																<div class="media-head">
																	<div class="avatar avatar-sm avatar-rounded">
																		<img src="dist/img/avatar3.jpg" alt="user" class="avatar-img">
																	</div>
																</div>
																<div class="media-body">
																	<div>Katherine Jones</div>
																	<div>8 Apr, 20, 5:30 PM</div>
																</div>
															</div>
															<p>@<a href="#" class="fw-medium">Martin Luther</a> Viscosity ratio for "Appear view" link text is 3.7:1 which is less </p>
														</div>
													</div>
													<a href="#" class="btn btn-outline-light btn-block">View more</a>
												</div>
												<div class="tab-pane fade" id="tab_comments">
													<div class="d-flex align-items-center justify-content-between mb-2">
														<div class="title title-lg mb-0"><span>3 Responses</span></div>
														<a href="#" class="btn btn-xs btn-icon btn-rounded btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add Board"><span class="icon"><span class="feather-icon"><i data-feather="plus"></i></span></span></a>
													</div>
													<div class="comment-block">
														<div class="media">
															<div class="media-head">
																<div class="avatar avatar-xs avatar-rounded">
																	<img src="dist/img/avatar4.jpg" alt="user" class="avatar-img">
																</div>
															</div>
															<div class="media-body">
																<div>
																	<span class="cm-name">Martin Luther</span>
																	<span class="badge badge-soft-violet">Manager</span>
																</div>
																<p>@<a href="#" class="fw-medium">Charlie Darvin</a> From there, you can run truffle compile, truffle migrate and truffle test to compile your contracts, deploy those contracts to the network, and run their associated unit tests.</p>
																<div class="comment-action-wrap mt-3">
																	<span>3 hours ago</span>
																	<span class="comment-dot-sep">●</span>
																	<a href="#">Reply</a>
																	<span class="comment-dot-sep">●</span>
																	<a href="#">Like</a>
																</div>
															</div>
														</div>
														<div class="separator separator-light"></div>
														<div class="media">
															<div class="media-head">
																<div class="avatar avatar-xs avatar-rounded">
																	<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
																</div>
															</div>
															<div class="media-body">
																<div>
																	<span class="cm-name">Katherine Jones</span>
																</div>
																<p>Dynamically beautiful work done by @<a href="#" class="fw-medium">Ashton Kutcher</a></p>
																<div class="comment-action-wrap mt-3">
																	<span>3 hours ago</span>
																	<span class="comment-dot-sep">●</span>
																	<a href="#">Reply</a>
																	<span class="comment-dot-sep">●</span>
																	<a href="#">Like</a>
																</div>
																<div class="media">
																	<div class="media-head">
																		<div class="avatar avatar-xs avatar-rounded">
																			<img src="dist/img/avatar3.jpg" alt="user" class="avatar-img">
																		</div>
																	</div>
																	<div class="media-body">
																		<div>
																			<span class="cm-name">Ashton Kutche</span>
																			<span class="badge badge-soft-danger">Designer</span>
																		</div>
																		<p>@<a href="#" class="fw-medium">Katherine Jones</a> Thank you :)</p>
																		<div class="comment-action-wrap mt-3">
																			<span>3 hours ago</span>
																			<span class="comment-dot-sep">●</span>
																			<a href="#">Reply</a>
																			<span class="comment-dot-sep">●</span>
																			<a href="#">Like</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="separator separator-light"></div>
														<form>
															<div class="form-group">
																<label class="form-label">Add Comment</label>
																<textarea class="form-control" rows="5"></textarea>
															</div>
															<div class="d-flex align-items-center justify-content-between">
																<button class="btn btn-primary">Send</button>
																<small class="form-text text-muted mt-0">Basic HTML is allowed</small>
															</div>
														</form>
													</div>
												</div>
												<div class="tab-pane fade" id="tab_files">
													<div class="row">
														<div class="col-sm">
															<form action="#" class="dropzone" id="remove_link">
																<div class="fallback">
																	<input name="file" type="file" multiple />
																</div>
															</form>
														</div>
													</div>
													<div class="mt-5 mb-2">
														<div class="title title-lg mb-0"><span>Shared files</span></div>
													</div>
													<div class="file-block">
														<div class="collapse-simple">
															<div class="card">
																<div class="card-header">
																	<a role="button" data-bs-toggle="collapse" href="#files_collapse" aria-expanded="true">Yesterday</a>
																</div>
																<div id="files_collapse" class="collapse show">
																	<div class="card-body">
																		<ul class="sh-files">
																			<li>
																				<div class="media">
																					<div class="media-head">
																						<div class="avatar avatar-icon avatar-sm avatar-soft-blue">
																							<span class="initial-wrap fs-3">
																								<i class="ri-file-excel-2-fill"></i>
																							</span>
																						</div>
																					</div>
																					<div class="media-body">
																						<div>
																							<p class="file-name">website_content.exl</p>
																							<p class="file-size">2,635 KB</p>
																						</div>
																						<div>
																							<div class="avatar avatar-xs avatar-rounded me-2">
																								<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
																							</div>
																							<a href="#" class="btn btn-sm btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																							<div class="dropdown-menu dropdown-menu-end">
																								<a class="dropdown-item ms-0" href="#">Download</a>
																								<a class="dropdown-item ms-0 link-danger" href="#">Delete</a>
																							</div>
																						</div>
																					</div>
																				</div>
																			</li>
																			<li>
																				<div class="media">
																					<div class="media-head">
																						<div class="avatar avatar-icon avatar-sm avatar-soft-light">
																							<span class="initial-wrap fs-3">
																								<i class="ri-file-text-fill"></i>
																							</span>
																						</div>
																					</div>
																					<div class="media-body">
																						<div>
																							<p class="file-name">jampack.pdf</p>
																							<p class="file-size">1.3 GB</p>
																						</div>
																						<div>
																							<div class="avatar avatar-xs avatar-rounded me-2">
																								<img src="dist/img/avatar3.jpg" alt="user" class="avatar-img">
																							</div>
																							<a href="#" class="btn btn-sm btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																							<div class="dropdown-menu dropdown-menu-end">
																								<a class="dropdown-item ms-0" href="#">Download</a>
																								<a class="dropdown-item ms-0 link-danger" href="#">Delete</a>
																							</div>
																						</div>
																					</div>
																				</div>
																				
																			</li>
																			<li>
																				<div class="media">
																					<div class="media-head">
																						<div class="avatar avatar-icon avatar-sm avatar-soft-warning">
																							<span class="initial-wrap fs-3">
																								<i class="ri-file-zip-fill"></i>
																							</span>
																						</div>
																					</div>
																					<div class="media-body">
																						<div>
																							<p class="file-name">themeforest-pack.zip</p>
																							<p class="file-size">2.45 GB</p>
																						</div>
																						<div>
																							<div class="avatar avatar-xs avatar-soft-danger avatar-rounded me-2">
																								<span class="initial-wrap">H</span>
																							</div>
																							<a href="#" class="btn btn-sm btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																							<div class="dropdown-menu dropdown-menu-end">
																								<a class="dropdown-item ms-0" href="#">Download</a>
																								<a class="dropdown-item ms-0 link-danger" href="#">Delete</a>
																							</div>
																						</div>
																					</div>
																				</div>
																				
																			</li>
																			<li>
																				<div class="media">
																					<div class="media-head">
																						<div class="avatar avatar-logo avatar-sm">
																							<span class="initial-wrap">
																								<img src="dist/img/6image.png" alt="user">
																							</span>
																						</div>
																					</div>
																					<div class="media-body">
																						<div>
																							<p class="file-name">bruce-mars-fiEG-Pk6ZASFPk6ZASF</p>
																							<p class="file-size">4,178 KB</p>
																						</div>
																						<div>
																							<div class="avatar avatar-xs avatar-rounded me-2">
																								<img src="dist/img/avatar5.jpg" alt="user" class="avatar-img">
																							</div>
																							<a href="#" class="btn btn-sm btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																							<div class="dropdown-menu dropdown-menu-end">
																								<a class="dropdown-item ms-0" href="#">Download</a>
																								<a class="dropdown-item ms-0 link-danger" href="#">Delete</a>
																							</div>
																						</div>
																					</div>
																				</div>
																				
																			</li>
																			<li>
																				<div class="media">
																					<div class="media-head">
																						<div class="avatar avatar-logo avatar-sm">
																							<span class="initial-wrap">
																								<img src="dist/img/2image.png" alt="user">
																							</span>
																						</div>
																					</div>
																					<div class="media-body">
																						<div>
																							<p class="file-name">jonas-kakaroto-KIPqvvTKIPqvvT</p>
																							<p class="file-size">951 KB</p>
																						</div>
																						<div>
																							<div class="avatar avatar-xs avatar-rounded me-2">
																								<img src="dist/img/avatar6.jpg" alt="user" class="avatar-img">
																							</div>
																							<a href="#" class="btn btn-sm btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																							<div class="dropdown-menu dropdown-menu-end">
																								<a class="dropdown-item ms-0" href="#">Download</a>
																								<a class="dropdown-item ms-0 link-danger" href="#">Delete</a>
																							</div>
																						</div>
																					</div>
																				</div>
																				
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
															<div class="card">
																<div class="card-header">
																	<a role="button" data-bs-toggle="collapse" href="#files_collapse_1" aria-expanded="true">23 April</a>
																</div>
																<div id="files_collapse_1" class="collapse show">
																	<div class="card-body">
																		<ul class="sh-files">
																			<li>
																				<div class="media">
																					<div class="media-head">
																						<div class="avatar avatar-icon avatar-sm avatar-soft-light">
																							<span class="initial-wrap fs-3">
																								<i class="ri-keynote-fill"></i>
																							</span>
																						</div>
																					</div>
																					<div class="media-body">
																						<div>
																							<p class="file-name">presentation.keynote</p>
																							<p class="file-size">20 KB</p>
																						</div>
																						<div>
																							<div class="avatar avatar-xs avatar-rounded me-2">
																								<img src="dist/img/avatar5.jpg" alt="user" class="avatar-img">
																							</div>
																							<a href="#" class="btn btn-sm btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																							<div class="dropdown-menu dropdown-menu-end">
																								<a class="dropdown-item ms-0" href="#">Download</a>
																								<a class="dropdown-item ms-0 link-danger" href="#">Delete</a>
																							</div>
																						</div>
																					</div>
																				</div>
																			</li>
																			<li>
																				<div class="media">
																					<div class="media-head">
																						<div class="avatar avatar-icon avatar-sm avatar-soft-warning">
																							<span class="initial-wrap fs-3">
																								<i class="ri-file-zip-fill"></i>
																							</span>
																						</div>
																					</div>
																					<div class="media-body">
																						<div>
																							<p class="file-name">PACK-TRIAL.zip</p>
																							<p class="file-size">2.45 GB</p>
																						</div>
																						<div>
																							<div class="avatar avatar-xs avatar-rounded me-2">
																								<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
																							</div>
																							<a href="#" class="btn btn-sm btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																							<div class="dropdown-menu dropdown-menu-end">
																								<a class="dropdown-item ms-0" href="#">Download</a>
																								<a class="dropdown-item ms-0" href="#">Delete</a>
																							</div>
																						</div>
																					</div>
																				</div>
																				
																			</li>
																			<li>
																				<div class="media">
																					<div class="media-head">
																						<div class="avatar avatar-sm">
																							<img src="dist/img/img-thumb1.jpg" alt="user" class="avatar-img">
																						</div>
																					</div>
																					<div class="media-body">
																						<div>
																							<p class="file-name">joel-mott-LaK153ghdigaghdi</p>
																							<p class="file-size">3,028 KB</p>
																						</div>
																						<div>
																							<div class="avatar avatar-xs avatar-rounded me-2">
																								<img src="dist/img/avatar8.jpg" alt="user" class="avatar-img">
																							</div>
																							<a href="#" class="btn btn-sm btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></a>
																							<div class="dropdown-menu dropdown-menu-end">
																								<a class="dropdown-item ms-0" href="#">Download</a>
																								<a class="dropdown-item ms-0" href="#">Delete</a>
																							</div>
																						</div>
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
												<div class="tab-pane fade" id="tab_activity">
													<div class="mt-5 mb-2">
														<div class="title title-lg mb-0"><span>Latest activity</span></div>
													</div>
													<div class="collapse-simple">
														<div class="card">
															<div class="card-header">
																<a role="button" data-bs-toggle="collapse" href="#activity_1" aria-expanded="true">Today</a>
															</div>
															<div id="activity_1" class="collapse show">
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
																	</ul>
																</div>
															</div>
														</div>
														<div class="card">
															<div class="card-header">
																<a role="button" data-bs-toggle="collapse" href="#activity_2" aria-expanded="true">Yesterday</a>
															</div>
															<div id="activity_2" class="collapse show">
																<div class="card-body">
																	<ul class="activity-list list-group list-group-flush">
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
										<div class="task-action-wrap">
											<div class="nicescroll-bar">
												<div class="title title-xs text-primary"><span>Action</span></div>
												<ul class="nav nav-sm nav-icon nav-vertical nav-light">
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="edit"></i></span></span>
															<span class="nav-link-text">Edit</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="user"></i></span></span>
															<span class="nav-link-text">Assign to</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="paperclip"></i></span></span>
															<span class="nav-link-text">Attach files</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="tag"></i></span></span>
															<span class="nav-link-text">ApplyLabels</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="calendar"></i></span></span>
															<span class="nav-link-text">Set Due Date</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="bookmark"></i></span></span>
															<span class="nav-link-text">Follow Task</span>
														</a>
													</li>
												</ul>
												<div class="hk-separator hk-separator-sm hk-secondary-separator"></div>
												<ul class="nav nav-sm nav-icon nav-vertical nav-light">
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="arrow-up"></i></span></span>
															<span class="nav-link-text">Set as Top Priority</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="repeat"></i></span></span>
															<span class="nav-link-text">Change Status</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="pocket"></i></span></span>
															<span class="nav-link-text">Save as Template</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="archive"></i></span></span>
															<span class="nav-link-text">Move to archive</span>
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="javascript:void(0);">
															<span class="nav-icon-wrap"><span class="feather-icon"><i data-feather="trash-2"></i></span></span>
															<span class="nav-link-text">Delete</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>