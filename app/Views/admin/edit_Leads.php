<?php
// Top Bar End
echo view('cpanel-layout/header');
echo view('cpanel-layout/navbar');
?>
<style>
#tab_timeline ul{
	padding-left: 0;
}
</style>
<body>
	<!-- Wrapper -->
	<div class="hk-wrapper hk-pg-auth" data-layout="navbar" data-menu="light" data-footer="simple">
		<!-- Main Content -->
		<div class="hk-pg-wrapper">
			<!-- Page Body -->
			<div class="hk-pg-body">
				<!-- Container -->
				<div class="container-fluid">
					<!-- Task Details -->

					<div class="task-detail-modal">
						<div class="">
							<div class="modal-body p-0">
								<header class="task-header me-0">
									<div>
										<h4 class="d-flex align-items-center fw-bold mb-0 inline-editable-wrap leadPopUp"><span class="editable leadTitle"><?php echo $leads->deal_title ?></span>
										</h4>
										<p  class="d-flex align-items-center inline-editable-wrap leadPopUp"><span class="editable leadDescription"><?php echo $leads->deal_title ?></span>
										</p>
									</div>
									<div class="btn-group btn-group-rounded" role="group" aria-label="Basic example">
										<?php
										 $stage_status =  $leads->stage;
										 if($stage_status == 2){
										 if(special_access('Can won the lead')){
										 if($leads->status == 'Won'){
											$wonstatus = 'active';
										 }	
										?>
										<button type="button" class="btn btn-outline-success <?= @$wonstatus; ?>" id="WonBtn" value="WON">WON</button>
										<?php
										 }
										 }
										 if(special_access('Can loss the lead')){
										 if($leads->status == 'Lost'){
												$lossstatus = 'active';
										 }	
										?>
										<button type="button" class="btn btn-outline-danger <?php echo ($leads->status == 'Lost' ) ? 'active': '' ; ?>"  id="LossBtn" value="LOST">LOST</button>
										<?php
										 }
										if(special_access('Can enable to COFC')){
											if($stage_status == 2){
												$cofcstatus = 'active';
										 }	
										?>									
										<button type="button" onclick="show()" class="btn btn-outline-primary <?= @$cofcstatus; ?>" title="CUSTOMER ORDER FULFILLMENT CYCLE"  id="stage2" value="stage2">COFC</button>
									   <?php
										}
									   ?>
									</div>
									
									<div class="position-relative">
									<label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
									<?php
									// $department =  session()->get('Department');
									// if($department == 'Sales'){
									if(special_access('can move lead to another department')){
									?>
									<select class="form-select " id="movelead">
										<?php
										 foreach($pipeline2->get()->getresult() as $item3)
										 {
										?>
										<option value="<?php echo $item3->id ?>" <?php echo ($leads->pipeline_id == $item3->id ) ? 'selected' : ''; ?>><?php echo $item3->name ?></option>
										<?php
										}
										?>
										</select>	
										<i class="fa fa-question-circle" style="position:absolute; right:-26px; top:15px;cursor:pointer" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Move this lead to another department"></i>
									<?php
										}
									?>
									</div>
								</header>
								<div class="task-detail-body m-0">

									<ul class="nav nav-light nav-tabs nav-segmented-tabs active-theme mt-4">
										
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#tab_Lead">
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
											<a class="nav-link" data-bs-toggle="tab" href="#tab_follow_up">
												<span class="nav-link-text badge-on-text">Follow Up</span>
											</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#tab_comments">
												<span class="nav-link-text badge-on-text">Comments</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#tab_timeline">
												<span class="nav-link-text badge-on-text">Timeline</span>
											</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#tab_feasibility">
												<span class="nav-link-text badge-on-text">Feasibility Form</span>
											</a>
										</li>
										<?php
										 $stage_status =  $leads->stage;
										 if($stage_status == 2){
										?>

										<li  class="nav-item stage2">
											<a class="nav-link" data-bs-toggle="tab" href="#tab_stage2">
												<span class="nav-link-text badge-on-text">Upload PO</span>
											</a>
										</li>
										<?php
										 }
										?>
										<!-- <li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#tab_activity">
												<span class="nav-link-text badge-on-text">Activity</span>
											</a>
										</li> -->
									</ul>
									<div class="tab-content mt-7">
									<?php
									// $department =  session()->get('Department');
									// if($department != 'Sales'){
									// 	$class = "readonly"; 
									// }
									if(!access_crud('Leads','update')) {
											$class = "readonly"; 
									}
									?>
									<div class="tab-pane fade" id="tab_Lead">
										<form id="EditLeadForm" class="form-horizontal form-label-left">
										    <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $leads->id ?>">
				
											<div class="modal-body">

												<div class="row gx-3">
													<div class="col-sm-6">	
														<div class="form-group">
														   <label class="form-label">Firstname</label>
															<input class="form-control task-name" placeholder="Firstname" value="<?php echo $leads->firstname ?>" name="firstname_lead" id="exampleFormControlInput1" type="text" <?php echo @$class ?>/>
														</div>
													</div>
													<div class="col-sm-6">	
														<div class="form-group">
														   <label class="form-label">lastname</label>
															<input class="form-control task-name" placeholder="Lastname" value="<?php echo $leads->lastname ?>" name="lastname_lead" id="exampleFormControlInput1" type="text" <?php echo @$class ?>/>
														</div>
													</div>

													<div class="col-sm-6">	
														<div class="form-group">
														   <label class="form-label">Organization</label>
															<input class="form-control task-name" placeholder="Organization" value="<?php echo $leads->organization ?>" name="organization" id="exampleFormControlInput1" type="text" <?php echo @$class ?>/>
														</div>
													</div>
													<div class="col-sm-6">	
														<div class="form-group">
														    <label class="form-label">Job Title</label>
															<input class="form-control task-name" placeholder="Job Title" value="<?php echo $leads->job_title ?>" name="job_title" id="exampleFormControlInput1" type="text" <?php echo @$class ?>/>
														</div>
													</div>

													<div class="col-sm-6">	
														<div class="form-group">
														    <label class="form-label">Email Address</label>
															<input class="form-control task-name" placeholder="Email Address" value="<?php echo $leads->email_address ?>" name="email_address_lead" id="exampleFormControlInput1" type="text" <?php echo @$class ?>/>
														</div>
													</div>
													<div class="col-sm-6">	
														<div class="form-group">
														    <label class="form-label">Phone</label>
															<input class="form-control task-name" value="<?php echo $leads->phone ?>" placeholder="phone" name="phone" id="exampleFormControlInput1" type="tel" <?php echo @$class ?>/>
														</div>
													</div>

													<div class="col-sm-6">
														<div class="form-group">
														   <label class="form-label">Country</label>
															<select class="form-control" name="country" id="country">
															<option value="">select country here</option>	
															<?php
																foreach($country->get()->getResult() as $value){
																?>
																<option value="<?= $value->id; ?>" <?php echo ($leads->country_id == $value->id ) ? 'selected' : ''; ?>><?php echo $value->name; ?></option>	
																<?php
																}
															?>
														
															</select>
														</div>
													</div>

													<div class="col-sm-6">
														<div class="form-group">
														<label class="form-label">State</label>
															<select class="form-control" name="state" id="state" <?php echo @$class ?>>
															<option value="">select country here</option>	
															 <?php
																foreach($state->get()->getResult() as $value){
																if($value->country_id == $leads->country_id){	
																?>
																<option value="<?= $value->id; ?>" <?php echo ($leads->state_id == $value->id ) ? 'selected' : ''; ?> ><?php echo $value->name; ?></option>	
																<?php
																}
															}
															?>
													
															</select>
														</div>
													</div>
											

												<div class="col-sm-12">	
													<div class="form-group">
													   <label class="form-label">Deal Title</label>
													   <input class="form-control task-name" value="<?php echo $leads->deal_title ?>" placeholder="Deal Title" name="deal_title" id="exampleFormControlInput1" type="text" <?php echo @$class ?>/>
													</div>
												</div>

												<div class="col-sm-6">
														<div class="form-group">
														<label>Currency</label>
															<select class="form-control" name="currency" id="exampleFormControlInput1" <?php echo @$class ?>>
															<option value="PKR">Pakistani Rupee</option>
															<option value="INR">Indian Rupee</option>
															</select>
														</div>
													</div>

													<div class="col-sm-6">
														<div class="form-group">
														<label class="form-label">Amount</label>
													     <input class="form-control task-name" value="<?php echo $leads->amount ?>" name="amount"  placeholder="0.00" id="exampleFormControlInput1" type="number" <?php echo @$class ?>/>
														</div>
													</div>
									

												<div class="col-sm-6">
														<div class="form-group">
															<label class="form-label">Industry</label>
															<select class="form-control" name="industry" id="exampleFormControlInput1" <?php echo @$class ?>>
															<option value="finance">Finance</option>
															<option value="intenet">Tech</option>
															</select>
													</div>
												</div>

												<div class="col-sm-6">	
													<div class="form-group">
													<label class="form-label">Expected Close Date</label>
													   <input class="form-control task-name" value="<?php echo $leads->expected_close_date ?>" placeholder="choose close date" name="expected_close_date" id="exampleFormControlInput1" type="datetime" <?php echo @$class ?>/>
													</div>
												</div>
											</div>
										</div>

										<div style="float:right;">
										<?php
										if(access_crud('Leads','update')) {
										?>
												<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
												<button type="submit" class="btn btn-primary">save</button>
										<?php
										}
										?>
									</div>
								</form>	
							</div>
									<!----------lead end----->

									<div class="tab-pane fade" id="tab_product">
									  <button type="button" class="btn btn-primary btn-sm" id="addButton">
											<i class="fa fa-plus"></i> Add Row
										</button>

										<form id="add_lead_product">
										  <input type="hidden" id="lead_product_id" name="lead_product_id" value="<?php echo $leads->id ?>">
										<div class="table-responsive">
											<table class="table productTable">
												<thead>
													<tr>
														<th>Category</th>
														<th>Product</th>
														<th>Price</th>
														<th>Quantity</th>
														<th>Tax</th>
														<th>Amount</th>
														<th>Action</th>
													</tr>
												</thead>
												<?php
												foreach($lead_products as $item){

													foreach($categories2 as $item2){
													
													if($item->category_id == $item2->id)
													{
													$cat_name = $item2->category_name;
													}
												    }

													foreach($products as $item3){
													
													if($item->product_id == $item3->id)
													{
													$prod_name = $item3->product_name;
													}
													}	
												?>
												<tbody id="table_container">
												
												<td><?php echo $cat_name ?></td>
												<td><?php echo $prod_name ?></td>
												<td><?php echo $item->price ?></td>
												<td><?php echo $item->quantity ?></td>
												<td><?php echo $item->tax ?></td>
												<td><?php echo $item->amount ?></td>
												<td><a href="javascript:void(0);" class="text-danger delLeadProductBtn" data-toggle="tooltip" data-placement="top" title="" data-Lead_product_id="<?= $item->id ?>" data-original-title="Delete"><i class="fa fa-trash-alt"></i></a></td> 
											
											    </tbody>
												<?php
												}
												?>

											<tbody id="add_lead_product_table">
											<!---table appends here------->
											</tbody>
											  
											</table>
											<!---table append here--->
										</div>

										<div class="modal-footer align-items-center">
											<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
											<button type="submit" id="prodBtn" class="btn btn-primary">save</button>
										</div>
										</form>
									</div>

									<!----------product end----->

										<div class="tab-pane fade" id="tab_reminder">
										
											<!-- <form id="EditReminderForm" class="form-horizontal form-label-left input_mask"> -->
											<!-- <input type="hidden" name="lead_id" value="<?php echo $leads->id ?>"> -->
											<div class="modal-body">

											<div class="table-responsive">
											<div class="card shadow mb-4 border-left-secondary">
											<!-- <div class="card-header py-3">
												<h6 class="m-0 font-weight-bold text-primary" style="float:left;">All Notifications</h6>
											</div> -->
											<div class="card-body">

												<ul class="nav nav-tabs" id="myTab" role="tablist">
												<li class="nav-item" role="presentation">
														<a class="nav-link tabclick active" id="issued" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="Isstable" aria-selected="false">Inbox</a>
													</li>

													<li class="nav-item" role="presentation">
														<a class="nav-link tabclick" id="requested" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="Reqtable" aria-selected="true">Outbox</a>
													</li>
												</ul>
															<div class="tab-content" id="myTabContent">
																<div class="tab-pane fade show" id="tab1" role="tabpanel" aria-labelledby="requested">
																	<div class="table-responsive">
																		<table id="Isstable" class="table table-striped table-bordered">
																			<thead>
																				<tr>
																					<th class="text-center">#</th>
																					<th class="">Title</th>
																					<th class="text-center">Date</th>
																					<th class="text-center">Time</th>
																					<th style="width:200px;" class="text-center">Action</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php if (count($myreminderlist) > 0): ?>
																					<?php foreach ($myreminderlist as $key => $value): ?>
																					
																						<tr>
																							<td class="text-center"><?php echo $key+1; ?></td>
																							<td><?php echo $value->title;?></td>
																							<td class="text-center"><?php echo $value->remind_date;?></td>
																							<td class="text-center"><?php echo date("g:i a", strtotime($value->time));?></td>
																							<td class="text-center">
																								<?php 
																								$dateTimeStored = $value->remind_date.' '.$value->time;
																								$date = strtotime($dateTimeStored);
																								$current = strtotime(date('Y-m-d H:i:s'));
																								?>
																								<span class="badge badge-soft-danger"></span>
																								<button class="btn btn-primary btn-sm ViewReminderDetail"  data-rem_id="<?php echo $value->rem_id?>"><i class="fa fa-info"></i></button>
																								<?php if ($date > $current && $value->user_id == session()->get('id')): 

																									// echo '<script>
																									// function autoRefresh() {
																									// 	window.location = window.location.href;
																									// }
																									// setInterval("autoRefresh()", 2000);
																									// </script>';
																									// $numOfSeconds = $starttime - $current;
																								?>
																								<!-- <p id="demo2"></p> -->


																								<!-- <p id="timer"></p> -->
																								<button class="btn btn-danger btn-sm" onclick="deleteid('<?php echo $value->rem_id?>')"><i class="fa fa-trash"></i></button>
																								<!-- <a  class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-alt"></i></a> -->
																							<?php endif ?>
																						</td>
																					</tr>
																				<?php endforeach ?>
																				<?php endif ?>
																			</tbody>
																		</table>
																	</div>
																</div>
													<div class="tab-pane fade show active" id="tab2" role="tabpanel" aria-labelledby="issued">
														<div class="table-responsive">
															<table id="Reqtable" class="table table-striped table-bordered">
																<thead>
																	<tr>
																		<th class="text-center">#</th>
																		<th class="text-center">From</th>
																		<th class="">Title</th>
																		<th class="text-center">Date</th>
																		<th class="text-center">Time</th>
																		<th style="width:200px;" class="text-center">Action</th>
																	</tr>
																</thead>
																<tbody>
																	<!--  --><?php if (count($reminderlistforme) > 0){ ?>
																		<?php foreach ($reminderlistforme as $key => $value){ ?>
																		<?php
																		foreach ($all_users as $key2 => $value2){ 
																			if($value->user_id == $value2->id){
																				$name = $value2->username;
																			?>
																			<tr>
																				<td class="text-center"><?php echo $key+1; ?></td>
																				<td class="text-center"><?php echo $name ?></td>
																				<td><?php echo $value->title;?></td>
																				<td class="text-center"><?php echo $value->remind_date;?></td>
																				<td class="text-center"><?php echo date("g:i a", strtotime($value->time));?></td>
																				<td class="text-center">
																					<?php
																					if($value->status == 0){
						
																					?>
																					<span class="badge badge-soft-primary">New</span>

																					<?php
																					}
																					?>
																					<button class="btn btn-primary btn-sm ViewReminderDetailForMe" data-my_reminder="0" data-rem_id="<?php echo $value->rem_id?>"><i class="fa fa-info"></i></button>
																				
																				</td>
																			</tr>
																			<?php } ?>
																		<?php } ?>
																	<?php } ?>
																	<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
										<form id="myform" action="<?php echo base_url();?>/tools/set_reminder" method="POST">
														<div class="form-group">
															<label for="datetime">Reminder Date Time:</label>
															<input type="datetime-local" name="reminderDate" id="" class="form-control" placeholder="Reminder Date Time" required>
														</div>
														<div class="form-group" id="reminder_for_group">
														<label for="remind_for">Reminder For:</label>
														<select name="remind_for[]" class="form-control js-example-basic-multiple" id="remind_for" multiple="multiple" required>
															<?php if (count($all_users_result) > 0): ?>
																<?php foreach ($all_users_result as $key => $user): ?>
																	<option value="<?php echo $user->id ?>"><?php echo $user->username .' ('.$user->firstname.' '.$user->lastname.')' ?></option>
																<?php endforeach ?>
															<?php endif ?>
														</select>
														</div>
														<div class="checkbox">
															<label><input id="select_all_users" type="checkbox" name="select_all"> <i class="fa fa-broadcast-tower"></i> Broadcast</label>
														</div>
														<!-- <div class="form-group hide" id="except_users_group">
														<label for="except_users">Except users if any:</label>
														<select name="except_users[]" class="form-control js-example-basic-multiple" id="except_users" multiple="multiple" style="width:100%;">
															<?php if (count($all_users_result) > 0): ?>
																<?php foreach ($all_users_result as $key => $user): ?>
																	<option value="<?php echo $user->id ?>"><?php echo $user->username .' ('.$user->firstname.' '.$user->lastname.')' ?></option>
																<?php endforeach ?>
															<?php endif ?>
														</select>
														</div> -->
														<div class="form-group">
															<label for="remindTitle">Title:</label>
															<input id="remindTitle" type="text" name="title" class="form-control" placeholder="Reminder Title" required>
														</div>
														<div class="form-group">
															<label for="ckEditor">Content:</label>
															<textarea name="content" id="ckEditor" cols="30" rows="10"></textarea>
														</div>
														<div class="form-group">
															<button type="submit" class="btn btn-primary"><i class="fa fa-bell"></i> Set Reminder</button>
														</div>
									</form>			
								</div>

							</div>

									<!---------------reminder end------------>
									<div class="tab-pane fade" id="tab_follow_up">
											<form id="EditFollowUpForm" class="form-horizontal form-label-left input_mask">
											<input type="hidden" name="lead_id" value="<?php echo $leads->id ?>">
											<div class="modal-body">

											<div class="table-responsive">
												<table id="table2" class="table nowrap w-100 mb-5">
													<thead>
														<tr>
															<th>#</th>
															<th>Follow up date</th>
															<th>Follow up time</th>
															<th>Firstname</th>
															<th>Lastname</th>
															<th>Email Address</th>
															<th>Template</th>
															<th>Email Template</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody id="tbody2">
													</tbody>
												</table>
											</div>

												<div class="row gx-3">
													<div class="col-sm-6">
														<div class="form-group">
														    <label class="form-label">Date</label>
															<input class="form-control" placeholder="follow up date" value="<?=  @$follow_up->follow_up_date ?>" name="follow_up_date" min="2023-06-07" id="exampleFormControlInput1" type="date" />
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
														<label class="form-label">Time</label>
															<input class="form-control" value="<?= @$follow_up->follow_up_time ?>" name="follow_up_time" id="exampleFormControlInput1" type="time"/>
														</div>
													</div>
													<div class="col-sm-12">	
														<div class="form-group">
														<label class="form-label">Firstname</label>
															<input class="form-control task-name" value="<?= @$follow_up->firstname ?>"  placeholder="Firstname" name="firstname" id="exampleFormControlInput1" type="text" />
														</div>
													</div>
													<div class="col-sm-12">	
														<div class="form-group">
														<label class="form-label">Lastname</label>
															<input class="form-control task-name" value="<?= @$follow_up->lastname ?>" placeholder="Lastname"  name="lastname" id="exampleFormControlInput1" type="text" />
														</div>
													</div>

													<div class="col-sm-12">	
														<div class="form-group">
														<label class="form-label">Eamil Address</label>
															<input class="form-control task-name" value="<?= @$follow_up->email_address ?>" placeholder="Email Address" name="email_address" id="exampleFormControlInput1" type="email" />
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
														<label class="form-label">Template</label>
															<select class="form-control" name="email_template" id="exampleFormControlInput1">
															<option value="">Choose Follow Up Template</option>
															<option value="osman">No Template</option>
															</select>
														</div>
													</div>
												</div>

											</div>
											<div style="float:right;">
												<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
												<button type="submit" class="btn btn-primary">save</button>
											</div>
										</form>
									</div>

									<!-----------follow up end--------->

									<div class="tab-pane" id="tab_comments">
										<div class="comment-block" style="min-height: calc(100vh - 350px);max-height: calc(100vh - 350px);overflow-y:auto;">
										  	<div id="chats" >

										  	</div>
									 	</div>
										<form id="addChatForm" class="position-relative">
											<input type="hidden" name="lead_id" id="lead_id" value="<?php echo $leads->id ?>">
											<div class="input-group mt-3 mb-3" style="position: fixed;bottom: 40px;width: 96%">
												<textarea class="form-control" aria-label="With textarea" rows="1" placeholder="Add Comment" name="chat_text"></textarea>
												<button type="submit" class="btn btn-primary input-group-text"><i class="fa fa-paper-plane"></i> </button>
											</div>
										</form>
										</div>

										<!----------- comment end--------->
										<div class="tab-pane fade" id="tab_timeline">
											<div class="d-flex justify-content-sm-center" id="container">

												<div id="tree"></div>
											
												</div>
											</div>
										<!----------- Timeline end--------->
										<div class="tab-pane fade" id="tab_feasibility">
										<form id="upd_feasibility_form" class="form-horizontal form-label-left">	
											<input type="hidden" name="lead_id" value="<?= $leads->id ?>">
										<div class="modal-body">
											<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button> -->
											<div class="row gx-3">
												<div class="col-sm-6">
													<div class="form-group">
													<select class="form-control form-select" name="customer_type">
													<option value="">Select Customer Type</option>
													<option value="Private" <?= @$Feasibility->customer_type == 'Private' ? 'selected' : ''; ?>>Private</option>
												</select>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<input class="form-control" placeholder="Customer Name" name="customer_name" value="<?=@$Feasibility->customer_name ?>"id="exampleFormControlInput1" type="text"/>
													</div>
												</div>
												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" value="<?=@$Feasibility->address ?>"  placeholder="Address" name="address" id="exampleFormControlInput1" type="text" />
													</div>
												</div>
												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" value="<?=@$Feasibility->poc ?>" placeholder="POC (Point Of Contact)"  name="poc" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" value="<?=@$Feasibility->poc_phone ?>" placeholder="POC Phone" name="poc_phone" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" value="<?=@$Feasibility->google_coordinates ?>" placeholder="Gps/Google coordinates" name="google_coordinates" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" value="<?=@$Feasibility->originally_request_by ?>" placeholder="Originally Request By" name="originally_request_by" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="col-sm-12">	
													<div class="form-group">
														<input class="form-control task-name" value="<?=@$Feasibility->sales_person ?>" placeholder="Sales Person" name="sales_person" id="exampleFormControlInput1" type="text" />
													</div>
												</div>

												<div class="modal-footer align-items-center">
													<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
													<button type="submit" class="btn btn-primary">Save</button>
												</div>
										    </div>	
									  </div>
									</div>
									</form>
										<!-----------feasibility end--------->
										<?php
											$status = null;
											if (file_exists('./assets/po/po-'.$leads->id.'.pdf')) {
											   $status = 1;
											}
											else{
											$status = 0;
											}		
										?>
										<div class="tab-pane fade" id="tab_stage2">
											<form id="uploadpo">
											  <input class="form-control" type="hidden" name="lead_id" value="<?= $leads->id; ?>">
												<?php
												if($status == 0){
												?>
											 <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Select PO To Upload:</label>
                                                <div class="col-sm-10">
												
                                                    <div class="row">
                                                        <div class="col-md-4">
														
                                                            <input type="file" class="form-control" id="po" name="PO" required>
                                                        </div>
                                                        <div class="col-md-4">
															<button class="btn btn-primary" type="submit">Upload PDF</button>
                                                        </div>

                                                    </div>
													
                                                </div>
                                            </div>
											<?php
											 }else{
											?>
											</form>
											<div class="container">
											<p>Purchase Order OF This Lead Alredy Uploaded (if you want to see click on view pdf button or delete click delte pdf button) </p>
										
											<div class="btn-group btn-group-rounded" role="group" aria-label="Basic example">
											<a target="_blank" href="<?= base_url();?>/pdf/<?= $leads->id; ?>"><button class="btn btn-primary btn-sm"><i style="font-size:20px;" class="fa fa-file-pdf-o" aria-hidden="true"></i> View PDF </button></a>
											&nbsp;
											<a><button class="btn btn-danger delpdf btn-sm"><i style="font-size:20px;" class="fa fa-file-pdf-o" aria-hidden="true"></i> Delete PDF </button></a>
											 </div>

										  </div>
										  <?php
											 }
											?>
                                                
										</div>

									</div>
								</div>
							</div>
						</div>
				     </div>
			      </div>
				</div>
			</div>

					<!-- /Task Details -->
				</div>
				<!-- /Container -->
			</div>
			<!-- /Page Body -->
			<!-- Page Footer -->
			<div class="hk-footer">
				<footer class="container-xxl footer">
					<div class="row">
						<div class="col-xl-8">
							<p class="footer-text"><span class="copy-text">© <?= get_setting_value('Footer Text ');?></span> <a href="#" class="" target="_blank">Privacy Policy</a><span class="footer-link-sep">|</span><a href="#" class="" target="_blank">T&C</a><span class="footer-link-sep">|</span><a href="#" class="" target="_blank">System Status</a></p>
						</div>
						<div class="col-xl-4">
							<a href="#" class="footer-extr-link link-default"><span class="feather-icon"><i data-feather="external-link"></i></span><u>Send feedback to our help forum</u></a>
						</div>
					</div>
				</footer>
			</div>
			<!-- / Page Footer -->
		</div>
		<!-- /Main Content -->
	</div>
	<!-- /Wrapper -->
</body>
</html>

<?php
echo view('cpanel-layout/footer');
?>


<script>
$(document).ready(function(){

	
    $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('.nav-tabs a[href="' + activeTab + '"]').tab('show');

    } else {
		$('.nav-tabs a[href="#tab_Lead"]').tab('show');
	}
});
</script>

<!------------this code is used t make depent dropdown of country city state ------->
<script>
$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
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


<!---------update lead form using ajax-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#EditLeadForm").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Lead/update_lead_form',
                data:$("#EditLeadForm").serialize(),
                success: function (data) {

                    toastr.success(data);
                },
                error: function(jqXHR, text, error){
                  toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<!---------update reminder form using ajax-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#EditReminderForm").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Lead/update_reminder_form',
                data:$("#EditReminderForm").serialize(),
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

<!---------update reminder form using ajax-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#EditFollowUpForm").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Lead/update_follow_up_form',
                data:$("#EditFollowUpForm").serialize(),
                success: function (data) {
					toastr.success(data);
					location.reload();
					// $("#EditFollowUpForm").trigger("reset");
					// follow_up_fetchdata();
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
$(document).on('change','#movelead',function(){
        var pipid = $(this).val();
		// alert(pipid);
		var leadid = $('#EditLeadForm #lead_id').val();
		// console.log(leadid);
		if(confirm("Do you really want to delete this?")){
		$.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Lead/update_lead_pipeline",
                data:'pipid='+pipid+'&leadid='+leadid,
                success: function(data){
					toastr.success(data);
					window.location.href = '<?php echo base_url(); ?>/lead';
                }
				,error: function(jqXHR, text, error){
                    toastr.error(error);
            }
        });
	}

});		

</script>

<!----append table row to add more product using jquery --------->
<script>
	$(document).ready(function() {
		var category = <?php echo json_encode($categories); ?>;
		// array
		var num = 0;
		//
		if(num == 0){
			$('#prodBtn').hide();
		}
        // Attach click event handler to the button
		$('#addButton').click(function() {
			$('#prodBtn').show();
            // Append a new input field to the container
		    var html = '';
      	    // html += '<tr><td><select id="category'+num+'" name="category" class="form-control"><option value="">select</option>';
			html += '<tr id="row'+num+'"><td><select id="category" name="category[]"  class="form-control category" data-ser="'+num+'" required> <option value="">please select</option>';
      	    //
			jQuery.each(category, function(index, item) {
				html += '<option value="'+item.id+'">'+item.category_name+'</option>';
			});
			//
			html += '</select></td>';
		    //
			html += '<td><select id="product" name="product[]" class="form-control product" data-ser="'+num+'" required>';

			html += '</select></td>';

			html += '<td><input class="form-control" id="price" name="price[]" type="number" required readonly></td> <td><input class="form-control" value="" min="1" id="quantity" name="quantity[]" type="number" required></td> <td><input class="form-control" value="" id="tax" name="tax[]" type="number" required readonly></td> <td><input class="form-control" value="" id="amount" name="amount_product[]" type="number" required readonly></td> <td><a href="javascript:void(0);" class="text-danger deleteRow" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-alt"></i></a></td> </tr>';

			$('.productTable #add_lead_product_table').append(html);
        //
			num++;
		});
		$(document).on('click','.deleteRow',function(){
			num;
			$(this).parent().closest('tr').remove();
			// alert(num);
			num--;
			if(num == 0){
				$('#prodBtn').hide();
			}
		});
	});

</script>



<!-- <script>
$(document).on('click','addButton',function(){

alert("gdf");

});

</script> -->

<!------------this code is used to fetch data according to category ------->
<script>
	$(document).ready(function(){
		$(document).on('change','.category',function(){
			var rowid = $(this).attr('data-ser');
			var id =  $(this).val();
			$('#row'+rowid+' #price').val('');
			$('#row'+rowid+' #quantity').val('');
			$('#row'+rowid+' #tax').val('');
			$('#row'+rowid+' #amount').val('');
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
					if(response.products_data == null){
					$('#row'+rowid+' #price').val('');
					$('#row'+rowid+' #quantity').val('');
					$('#row'+rowid+' #tax').val('');
					$('#row'+rowid+' #amount').val('');
					}
					else{
                    //  console.log(response.products_data.id);
					// $('#unit').html(response.products_data.unit);
					// $('#product_code').html(response.products.product_code);
				    // $('#row'+rowid+' #product_name').val(response.products.product_name);
					$('#row'+rowid+' #price').val(response.products_data.unit_price);
					$('#row'+rowid+' #quantity').val(response.products_data.unit);
					$('#row'+rowid+' #tax').val(response.products_data.total_tax);
					$('#row'+rowid+' #amount').val(response.products_data.amount);
					}
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

<!------this function is used to delete lead product add by or buy by users-------->

<script>
    $(document).on('click','.delLeadProductBtn',function(){
        var val = $(this).attr('data-Lead_product_id');
        //
        if(confirm("Do you really want to delete this?")){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Lead/delete_lead_products",
                data:'id='+val,
                success: function(data){

					location.reload();
                    
                   // snack('#59b35a','User Deleted Successfully','check-square-o');
                    toastr.success(data);
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script>

<!---------add leads product form using ajax------------->
<script>
$(document).ready(function() {
		// $('.comment-block').scrollTop($('.comment-block').height());
		$("#add_lead_product").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Lead/add_lead_product',
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

<!---------add leads product form using ajax------------->
<script>
$(document).ready(function() {
		// $('.comment-block').scrollTop($('.comment-block').height());
		$("#add_lead_feasibility").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Lead/edit_lead_feasibility',
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

<!---------add chat using ajax-------->
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
<!----------fetch chat using ajax-------->
<script>
    function get_chats(lead_id){

		var lead_id = $('#addChatForm #lead_id').val();
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Lead/show_chats',
			data:'lead_id='+lead_id,
            success: function(data){
				
				$('#chats').html(data);
            }
        })
    }
</script>

<!---------add chat using ajax-------->
<script>
	$(document).ready(function(){
		get_chats(lead_id);
	});
</script>


</script>
<!----------delete chat using ajax-------->
<script>
    $(document).on('click', '.delChatBtn', function () {
        var val = $(this).attr('data-chatid');
        //
        if (confirm("Do you really want to delete this?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Lead/delete_chats",
                data: 'id='+val,
                success: function (data) {
                    get_chats(lead_id);
                    toastr.success(data);
                }, error: function (jqXHR, text, error) {
                    toastr.error(error);
					
                }
            });
        }
    });
</script>

<!---------won Lead using ajax-------->
<script>
	$(document).ready(function(){

		$('#WonBtn').click(function(){

			var lead_id = $('#addChatForm #lead_id').val();
			var status = $('#WonBtn').val();
            //
			$.ajax({
			method:'POST',
			url: '<?php echo base_url(); ?>/Lead/lead_won',
			data:'lead_id='+lead_id+'&status='+ status,
			success: function(data){
				toastr.success(data);
				location.reload();
            }, 
			error: function (jqXHR, text, error) {
                 toastr.error(error);
            }

		});

	});
		
});
</script>
<!--------- lost Lead using ajax-------->
<script>
	$(document).ready(function(){

		$('#LossBtn').click(function(){

			var lead_id = $('#addChatForm #lead_id').val();
			var status = $('#LossBtn').val();
            //
			$.ajax({
			method:'POST',
			url: '<?php echo base_url(); ?>/Lead/lead_loss',
			data:'lead_id='+lead_id+'&status='+ status,
			success: function(data){
				toastr.error(data);
				location.reload();
            }, 
			error: function (jqXHR, text, error) {
                 toastr.error(error);
            }

		});

	});
		
});
</script>
<!--------timeline lead tree structure javascript code ---------->
<script>

var lead_timeline_data = <?php echo json_encode($timeline); ?>;
console.log(<?php echo json_encode($timeline); ?>);
//
var tree = {
<?php
		foreach($timeline as $key => $item){
			$parent = $key-1;
			echo $key.' : {value : "'.$item.'", parent : "'.$parent.'"},';	
		}
	?>
};
TreeData(tree, "#tree");
</script>

<!------this function is used to show lead reminder -------->
<script>
    $(document).ready(function(){
        reminder_fetchdata();
    });
  //
    function reminder_fetchdata(){
		var id = $('#addChatForm #lead_id').val();
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table1').dataTable().fnDestroy();
        $('#tbody1').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Lead/show_reminders',
			data:'id='+id,
            success: function(data){
                $('#tbody1').html(data);
                $('#table1').DataTable();
                
            }
        })
    }
</script>

<!------this function is used to delete lead reminder -------->
<script>
    $(document).on('click','.delReminderBtn',function(){
        var id = $(this).attr('data-reminderid');
        //
        if(confirm("Do you really want to delete this?")){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Lead/delete_lead_reminder",
                data:'id='+id,
                success: function(data){

					location.reload();
                    
                   // snack('#59b35a','User Deleted Successfully','check-square-o');
                    toastr.success(data);
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script>

<!------this function is used to show lead follow up -------->
<script>
    $(document).ready(function(){
        follow_up_fetchdata();
    });
  //
    function follow_up_fetchdata(){
		var id = $('#addChatForm #lead_id').val();
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table2').dataTable().fnDestroy();
        $('#tbody2').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Lead/show_follow_up',
			data:'id='+id,
            success: function(data){
                $('#tbody2').html(data);
                $('#table2').DataTable();
                
            }
        })
    }
</script>

<!------this function is used to delete lead follow up -------->
<script>
    $(document).on('click','.delFollowupBtn',function(){
        var id = $(this).attr('data-followupid');
        //
        if(confirm("Do you really want to delete this?")){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Lead/delete_lead_follow_up",
                data:'id='+id,
                success: function(data){

					location.reload();
                    
                   // snack('#59b35a','User Deleted Successfully','check-square-o');
                    toastr.success(data);
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script>

<!---------update lead form using ajax-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#upd_feasibility_form").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Lead/update_feasibility_form',
                data:$("#upd_feasibility_form").serialize(),
                success: function (data) {
                    toastr.success(data);
                },
                error: function(jqXHR, text, error){
                  toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#uploadpo").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Lead/upload_po',
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
					location.reload();
                    toastr.success(data);
                },  
                error: function(jqXHR, text, error){
                    // Displaying if there are any errors
                    toastr.error(error); 
                }
            });
            return false;
        });
    });
</script>

<script type="text/javascript">

        $("#stage2").click(function() {

			var lead_id = $('#lead_id').val();
			// alert(lead_id);
			//
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Lead/stage_2',
				data: 'lead_id='+lead_id,
                success: function (data) {
					location.reload();
                    toastr.success(data);
                },  
                error: function(jqXHR, text, error){
                    // Displaying if there are any errors
                    toastr.error(error); 
                }
            });
			
            return false;
        });
</script>


<script type="text/javascript">

        $(".delpdf").click(function() {
			var lead_id = $('#lead_id').val();
			// alert(lead_id);
			//
			if(confirm("Do You Really Want To Delete Already Uploaded PO ?")){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Lead/delete_pdf',
				data: 'lead_id='+lead_id,
                success: function (data) {
					location.reload();
                    toastr.success(data);
                },  
                error: function(jqXHR, text, error){
                    // Displaying if there are any errors
                    toastr.error(error); 
                }
            });
			
		}
        });
</script>


<script type="text/javascript">
function show(){
document.getElementByClassName("stage2").style.display = "block";}
</script>


<!-- <script>
var tree = {
     zelda : {value : "Zelda Timeline", parent : ""},
     a : {value : "Skyward Sword", parent : "zelda"},
     b : {value : "The Minish Cap", parent : "a"},
     c : {value : "Four Swords", parent : "b"},
     d : {value : "Ocarina of Time", parent : "c"},
     e : {value : "A link to Past", parent : "d"},
     f : {value : "Oracle of Seasons & Oracle of Ages", parent : "e"},
     g : {value : "Link's Awakening", parent : "f"},
     h : {value : "The Legend of Zelda", parent : "g"},
     i : {value : "Adventure of Link", parent : "h"},
     j : {value : "Majora's Mask", parent : "d"},
     k : {value : "Twilight Princess", parent : "j"},
     l : {value : "Four Swords", parent : "k"},
     m : {value : "The Wind Waker", parent : "d"},
     n : {value : "Phanthom Hourglass", parent : "m"},
     o : {value : "Spirit Tracks", parent : "n"}

};

TreeData(tree, "#tree");
</script> -->

<!----------get lead id using attribute-------->
<!-- <script>
$(document).on('click','.editLeads',function(){
  // Attach a click event handler to the element
  var val = $(this).attr("data-id");
   alert(val);

});
</script> -->

<script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
<script src="<?php echo base_url();?>/assets/js/flatpickr.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	ClassicEditor
	.create( document.querySelector( '#ckEditor' ) )
	.catch( error => {
		console.error( error );
	} );

	$('.js-example-basic-multiple').select2({
			placeholder: 'Select User',
			allowClear: true
		});
</script>

<script type="text/javascript">
	$(document).ready(function() {

		$("#myform").submit(function() {
			var $this = $(this);
			var dateTime = $('#datetime').val();
			var remind_for = $('#remind_for').val();
			var remindTitle = $.trim($('#remindTitle').val());
			var select_all_users = $('#select_all_users');
			var content = $.trim(CKEDITOR.instances.ckEditor.document.getBody().getChild(0).getText());

			if (dateTime == '' || remindTitle == '' || content == '') {
				alert('All fields are required');
			} else {
				
				if(select_all_users.prop("checked") == false){
				   if (remind_for == null) {
					alert('All fields are required');
				   } else {
				   		// setReminder($this);
				   		$this.submit();
				   }
				} else {
			   		// setReminder($this);
			   		$this.submit();
				}
			}
			return false;
		});

		flatpickr("#datetime", {
			enableTime: true,
		    dateFormat: "Y-m-d H:i",
		    minDate: "today"
		});

	});
</script>

<script>
$('#select_all_users').click(function(){
	
            if($(this).prop("checked") == true){

                $('#reminder_for_group').css({
                	'pointer-events': 'none',
                	'opacity': '0.5'
					// 'display' : 'none'
                });
                $('#except_users_group').removeClass('hide');
                $('#remind_for').val('');
				$("#remind_for").prop('required',false);
            }
            else if($(this).prop("checked") == false){
                $('#reminder_for_group').css({
                	'pointer-events': 'unset',
                	'opacity': '1'
                });
                $('#except_users_group').addClass('hide');
                $('#remind_for').prop('required',true);
            }
        });
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#Isstable').dataTable();
		$('#Reqtable').dataTable();
		// checkNewReminder();
	});
	function deleteid(val) {
		if(confirm("Do you realy want to delete this?")){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/Tools/delete_reminder",
			data:'rem_id='+val,
			success: function(data){
				// snack('#d9534f','Deleted Successfully','check-square-o');
				toastr.success('Reminder Deleted Successfully');
				setTimeout(function(){
					location.reload();
				}, 2000);

			}
		});
	}
	}
</script>

<script>
    $(document).on('click', '.ViewReminderDetail', function () {
        var val = $(this).attr('data-rem_id');
        // alert(val);
        $.ajax({
			dataType: 'json',
            type: "POST",
            url: "<?php echo base_url(); ?>/Tools/getReminderById",
            data: 'rem_id='+val,
            success: function (res){
				// alert(res.remindersUsers[0].firstname);
				console.log(res.reminders);

				$('#datetime').val(res.reminders.date+' '+res.reminders.time);
				$('#for').html(res.remindersUsers[0].firstname);
				$('#remindTitle').val(res.reminders.title);
				$('#text').html(res.reminders.text);
                $('#ViewReminderModel').modal('show');
            },
            error: function (jqXHR, text, error) {
                // Displaying if there are any errors
            }
        });
    });
</script>

<script>
    $(document).on('click', '.ViewReminderDetailForMe', function () {
        var val = $(this).attr('data-rem_id');
        // alert(val);
        $.ajax({
			dataType: 'json',
            type: "POST",
            url: "<?php echo base_url(); ?>/Tools/getReminderById",
            data: 'rem_id='+val,
            success: function (res){
				// alert(res.remindersUsers[0].firstname);

				$('#datetime2').val(res.reminders.date+' '+res.reminders.time);
				$('#from2').html(res.remindersUsers[0].firstname);
				$('#remindTitle2').val(res.reminders.title);
				$('#text2').html(res.reminders.text);
                $('#ViewReminderModelForMe').modal('show');
            },
            error: function (jqXHR, text, error) {
                // Displaying if there are any errors
            }
        });
    });
</script>

<script>
	$('#closeremindmodal').click(function() {
		$('#ViewReminderModel').modal('hide');
	});
</script>

<script>
	$('#closeremindmodalforme').click(function() {
		$('#ViewReminderModelForMe').modal('hide');
	});
</script>