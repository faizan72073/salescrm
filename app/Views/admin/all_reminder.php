<?php
// Top Bar End
echo view('cpanel-layout/header');
echo view('cpanel-layout/navbar');
?>

<body>
   	<!-- Wrapper -->
	<div class="hk-wrapper hk-pg-auth" data-layout="navbar" data-menu="light" data-footer="simple">
		<!-- Main Content -->
		<div class="hk-pg-wrapper">
			<!-- Page Body -->
			<div class="hk-pg-body">
				<!-- Container -->
				<div class="container-xxl">
					<div class="col-12" style="margin-bottom:15px; float:left;">
						<a href="<?= base_url();?>/tools/notification" class="btn btn-primary btn-icon-split btn-sm">
							<span class="">
								<i class="fas fa-plus"></i>
							</span>
							<span class="text">Set New Notification</span>
						</a>	
					</div>

					<div class="card shadow mb-4 border-left-secondary">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary" style="float:left;">All Notifications</h6>
						</div>
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
																echo "<script>document.getElementById('markread').style.display = 'block';</script>"	
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

<div id="ViewReminderModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Reminder Detail</h5>
                <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeremindmodal">x</span>
            </div>
            <form id="viewreminder" class="form-horizontal form-label-left input_mask">
			<div class="modal-body">
					<div class="form-group">
						<label for="datetime">Reminder Date Time:</label>
						<input style="background-color: #fff;cursor: default;" id="datetime" type="text" name="reminderDate" class="form-control" readonly="">
					</div>

					<div class="form-group">
						<label for="datetime" >Reminder for:</label>
						<span class="badge badge-soft-primary" id="for"></span>
					</div>
					<div class="form-group viewTitle">
						<label for="remindTitle">Title:</label>
						<input style="background-color: #fff;cursor: default;" id="remindTitle" type="text" name="title" class="form-control" readonly="">
					</div>
					<div class="form-group">
						<label for="content">Message:</label>
						<div id="text" style="cursor: default;border: 1px solid #ddd;background: #fff;height: 200px;overflow-x: hidden;overflow-y: scroll;padding: 10px;"><p></p></div>
					</div>
				</div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="ViewReminderModelForMe" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Reminder Detail</h5>
                <button class="btn btn-primary markRead" value="1" id="markread">Mark As Read</button>
            </div>
            <form id="viewreminderforme" class="form-horizontal form-label-left input_mask">
			<div class="modal-body">
					<div class="form-group">
						<label for="datetime">Reminder Date Time:</label>
						<input style="background-color: #fff;cursor: default;" id="datetime2" type="text" name="reminderDate" class="form-control" readonly="">
					</div>

					<!-- <div class="form-group">
						<label for="datetime" >Reminder form:</label>
						<span class="badge badge-soft-primary" id="from2"></span>
					</div> -->
					<div class="form-group viewTitle">
						<label for="remindTitle">Title:</label>
						<input style="background-color: #fff;cursor: default;" id="remindTitle2" type="text" name="title" class="form-control" readonly="">
					</div>
					<div class="form-group">
						<label for="content">Message:</label>
						<div id="text2" style="cursor: default;border: 1px solid #ddd;background: #fff;height: 200px;overflow-x: hidden;overflow-y: scroll;padding: 10px;"><p></p></div>
					</div>
				</div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
echo view('cpanel-layout/footer');
echo view('admin/popup/view_reminder');

?>
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


<!-- <script>

setInterval(myTimer, 1000);
															
function myTimer() {
var actualtime = <?php json_encode($myreminderlist); ?>

<?php
	// foreach($myreminderlist as $key => $item){

	// 	$html = $item->remind_date;
			
	// }
?>
$('#reminddata').html($html);

const d = new Date();

var datetime = d.toLocaleTimeString();
document.getElementById("demo2").innerHTML = datetime;
	
}
</script> -->



