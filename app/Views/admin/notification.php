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
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary" style="float:left;">Set New Notification</h6>
			</div>
			<div class="card-body">
				<div class="col-md-12">
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
</body>
</html>

<?php
echo view('cpanel-layout/footer');
?>

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






