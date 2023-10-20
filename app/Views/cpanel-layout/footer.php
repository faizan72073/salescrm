<!------------ whole site javascript & jquery links here -------------------------->

<style>
	#viewMessage{
		display: none;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: #fff;
		padding: 20px;
	}
	.modal.fade.zoom:not(.show) .modal-dialog {
		transform: scale(0.8);
	}

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="<?= base_url();?>/assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JS -->
   <script src="<?= base_url();?>/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- FeatherIcons JS -->
<script type="text/javascript" src="<?= base_url();?>/assets/js/feather.min.js"></script>

<!-- Fancy Dropdown JS -->
<script src="<?= base_url();?>/assets/js/dropdown-bootstrap-extended.js"></script>

<!-- Simplebar JS -->
<script type="text/javascript" src="<?= base_url();?>/assets/vendors/simplebar/dist/simplebar.min.js"></script>

<!-- Data Table JS -->
<script src="<?= base_url();?>/assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>/assets/vendors/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url();?>/assets/vendors/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Daterangepicker JS -->
<script src="<?= base_url();?>/assets/vendors/moment/min/moment.min.js"></script>
<script src="<?= base_url();?>/assets/vendors/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url();?>/assets/js/daterangepicker-data.js"></script>

<!-- Amcharts Maps JS -->

<script src="<?= base_url();?>/assets/vendors/@amcharts/amcharts4/core.js"></script>
<script src="<?= base_url();?>/assets/vendors/@amcharts/amcharts4/maps.js"></script>
<script src="<?= base_url();?>/assets/vendors/@amcharts/amcharts4-geodata/worldLow.js"></script>
<script src="<?= base_url();?>/assets/vendors/@amcharts/amcharts4-geodata/worldHigh.js"></script>

<!-- <script src="<?= base_url();?>/assets/vendors/@amcharts/amcharts4/themes/animated.js"></script> -->

<!-- Apex JS -->
<script src="<?= base_url();?>/assets/vendors/apexcharts/dist/apexcharts.min.js"></script>

<!-- Init JS -->
<script src="<?= base_url();?>/assets/js/init.js"></script>
<script src="<?= base_url();?>/assets/js/chips-init.js"></script>
<script src="<?= base_url();?>/assets/js/dashboard-data.js"></script>
<script src="<?= base_url();?>/assets/js/toastr.min.js"></script>

<!-------Toast Popup ----------->
<script src="<?= base_url();?>/assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>



<!-- Fancy Dropdown JS -->
<script src="<?= base_url();?>/assets/js/dropdown-bootstrap-extended.js"></script>


<!-- Tinymce JS -->
<script src="<?= base_url();?>/assets/vendors/tinymce/tinymce.min.js"></script>

<!-- Dragula JS -->
<script src="<?= base_url();?>/assets/vendors/dragula/dist/dragula.min.js"></script>

<!-- PS scroll JS -->
<script src="<?= base_url();?>/assets/js/perfect-scrollbar.min.js"></script>

<!-- Daterangepicker JS -->
<script src="<?= base_url();?>/assets/vendors/moment/min/moment.min.js"></script>
<script src="<?= base_url();?>/assets/vendors/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url();?>/assets/js/daterangepicker-data.js"></script>

<!-- Bootstrap Colorpicker JS -->
<script src="<?= base_url();?>/assets/vendors/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url();?>/assets/js/color-picker-data.js"></script>


<!-- Dropzone JS -->
<script src="<?= base_url();?>/assets/vendors/dropzone/dist/dropzone.min.js"></script>

<!-- Dropify JS -->
<script src="<?= base_url();?>/assets/vendors/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url();?>/assets/js/dropify-data.js"></script>


<!---kanban--------->
<script src="<?= base_url();?>/assets/js/kanban-board-data.js"></script>


<!--------Hirarchy Tree------->
<script src="<?= base_url();?>/assets/tree-js/treeData.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!------select 2 for multiple selection------>

<div id="ViewReminderModelForMe" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Reminder Detail</h5>
                <input style="background-color: #fff;cursor: default;" id="read_status" type="hidden" name="title" class="form-control" readonly="">
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


<div id="ViewReminderModal" class="modal fade zoom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Notification</h5>
				<!-- <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closemodal" data-bs-dismiss="modal">x</span> -->
                <button class="btn btn-primary markallread btn-sm" value="1" id="markallread">Mark All As Read</button>
            </div>
			<div class="modal-body">
				
					<table id="table1" class="table table-hover remindertable">
						<thead>
							<tr>
								<td>#</td>
								<td>From</td>
								<td>To</td>
								<td>Subject</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody id="reminderlist" style="max-height: 80vh;">

						</tbody>

					</table>
				<div id="viewMessage">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<a href="javascript:void(0)" class="markRead" onclick="goBack()">&lt; Back</a>
						<a href="javascript:void(0)" onclick="goBack()" class="btn btn-xs btn-primary markRead">Mark as Read</a>
					</div>
					<hr>
					<h5 class="text-center">Message</h5>
                    <span class="text-center" id="message_text"></span>
				</div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		checkNewReminder();
	});
</script>


<script type="text/javascript">

	function checkNewReminder(){
		$.ajax({
			type: "POST",
            dataType: "json",
			url: "<?php echo base_url();?>/Tools/checkNewReminder",
			success: function(response){
                // console.log(response.checkreminder);
            if(response){
                $('#ViewReminderModal').modal('show');
                //
                var html = '';
                $.each(response.checkreminder, function( index, value ) {
                //
                var sno = index+1;
                //
                //  html += '<tr><td>'+sno+'</td> <td>'+value.title+'</td> <td>'+value.firstname+'</td> <td>'+value.text+'</td> <td> <button  style="font-size:7px;"class="btn btn-primary btn-sm markRead" id="markRead" value="'+value.rem_id+'" id="markread">Mark As Read</button></td></tr>';
                 html += '<tr><td>'+sno+'</td> <td>'+value.title+'</td> <td>'+value.firstname+'</td> <td>'+value.text+'</td> <td><button data-rem_id='+value.rem_id+' href="javascript:void(0)" class="btn btn-primary btn-xs me-1 view_message" onclick="viewMessage()">View</button> <button class="btn btn-secondary btn-xs markRead" id="markRead" value="'+value.rem_id+'" id="markread">Mark As Read</button></td></tr>';
                 //
            });
            $('.remindertable #reminderlist').html(html);
            }
		},

	});
}
</script>

<script>
    $(document).on('click', '.view_message', function () {
        // var val = $('#markRead').val();
        // alert("fsd");
		// var val = $('#view_msg').attr('data-rem_id');
        var val = $(this).attr('data-rem_id');
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Tools/show_message",
            data: 'rem_id='+val,
            dataType: 'json',
            success: function (response){

                console.log(response.reminders.text);
                $("#message_text").html(response.reminders.text);
				// toastr.success(response);
				// toastr.success(data);
				// location.reload();
            },
            error: function (jqXHR, text, error) {
                // Displaying if there are any errors
				toastr.error(error);
            }
        });
    });
</script>

<script>
checkNewReminder();
setInterval(function(){ checkNewReminder(); }, 10000);
</script>

<script>
    $(document).on('click', '.markRead', function () {
        var val = $('#markRead').val();
		// var val = $('.ViewReminderDetailForMe').attr('data-rem_id');
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Tools/markRead",
            data: 'rem_id='+val,
            success: function (data){
				// toastr.success(response);
				toastr.success(data);
				location.reload();
            },
            error: function (jqXHR, text, error) {
                // Displaying if there are any errors
				toastr.error(error);
            }
        });
    });
</script>


<script>
    $(document).on('click', '#markallread', function () {
        // var val = $('.markRead').val();
		// var val = $('.ViewReminderDetailForMe').attr('data-rem_id');
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Tools/markallRead",
            success: function (data){
				// toastr.success(response);
				toastr.success(data);
				location.reload();
            },
            error: function (jqXHR, text, error) {
                // Displaying if there are any errors
				toastr.error(error);
            }
        });
    });
</script>



<script>
    $(document).on('click', '.view_notification', function () {
        var val = $(this).attr('data-id');
        // alert(val);
        $.ajax({
			dataType: 'json',
            type: "POST",
            url: "<?php echo base_url(); ?>/Tools/getReminderById",
            data: 'rem_id='+val,
            success: function (res){
				console.log(res.remindersUsers);

				$('#datetime2').val(res.reminders.date+' '+res.reminders.time);
				$('#from2').html(res.remindersUsers[0].firstname);
				$('#remindTitle2').val(res.reminders.title);
				$('#text2').html(res.reminders.text);
                $('#read_status').val(res.reminders.read_status);

                if(res.remindersUsers[0].status == 1){
                    $('#markread').hide();
                }
                else{
                    $('#markread').show();
                }
                $('#ViewReminderModelForMe').modal('show');
            },
            error: function (jqXHR, text, error) {
                // Displaying if there are any errors
            }
        });
    });
</script>

<script>
	function viewMessage() {
		$('#viewMessage').css('display', 'block');
	}
	function goBack() {
		$('#viewMessage').css('display', 'none');
	}
</script>

</body>
</html>





