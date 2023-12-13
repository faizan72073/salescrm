<?php

// Top Bar End
echo view('cpanel-layout/header');
echo view('cpanel-layout/navbar');
?>
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
<body>
   	<!-- Wrapper -->
	<div class="hk-wrapper hk-pg-auth" data-layout="navbar" data-menu="light" data-footer="simple">
		<!-- Main Content -->
		<div class="hk-pg-wrapper">
			<!-- Page Body -->
			<div class="hk-pg-body">
				<!-- Container -->
				<div class="container-xxl">
				<h1>Dashboard</h1>
				   Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, alias ea consectetur, repellat id velit perferendis non esse tenetur quidem omnis nostrum reprehenderit autem aut error cum consequuntur voluptatem incidunt.
				<?php
				    // echo session()->get('otp');
					$department =  session()->get('Department');
					echo $department;
				?>
				
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
	<!-- Popup Modal -->
	<!-- sample modal content -->
<div id="popupModel" class="modal fade zoom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Notification</h5>
				<!-- <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closemodal" data-bs-dismiss="modal">x</span> -->
            </div>
			<!-- <div class="modal-body">
				<form id="adduserform" class="form-horizontal form-label-left input_mask">
					<table class="table table-hover" >
						<thead>
							<tr>
								<td>#</td>
								<td>From</td>
								<td>To</td>
								<td>Subject</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody style="max-height: 80vh;">
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
							<tr>
								<td>1</td>
								<td>Fiber</td>
								<td>NOC</td>
								<td>Test Notification</td>
								<td><a href="javascript:void(0)" class="btn btn-primary btn-xs me-1" onclick="viewMessage()">View</a><a href="" class="btn btn-secondary btn-xs">Mark as read</a></td>
							</tr>
						</tbody>
					</table>
				</form>
				<div id="viewMessage">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<a href="javascript:void(0)" onclick="goBack()">&lt; Back</a>
						<a href="javascript:void(0)" onclick="goBack()" class="btn btn-xs btn-primary">Mark as Read</a>
					</div>
					<hr>
					<h5 class="text-center">This is message content here</h5>
				</div>
            </div> -->
        </div>
    </div>
</div>

<?php
echo view('cpanel-layout/footer');
// echo view('popup/popup');
?>
<!-- <script>
	$(function() {
		$('#popupModel').modal('hide');

	})
	function viewMessage() {
		$('#viewMessage').css('display', 'block');
	}
	function goBack() {
		$('#viewMessage').css('display', 'none');
	}

	
</script> -->

</body>
</html>



