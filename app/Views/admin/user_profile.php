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
				<div class="content-page">
					<!-- Start content -->
					<div class="content">
						<div class="profile__wrapper">
							<div class="profile__header">
								<!-- <img src="header.jpg"> -->
							</div>
							<div class="profile__title">
								<div class="profile_image">
									<form>
										<!-- <img src="/assets/images/avatar.png"> -->
										<input type="file" id="myfile" style="display:none"/>
									</form>
								</div>
										<div class="d-flex justify-content-center align-items-center flex-column mb-4">
										   <div class="">
											 <img src="/assets/images/user-icon.jfif" alt="user" class="avatar-img">
										   </div>

											<div class="">
												<h2><?= ucfirst($info->username);?></h2>
											</div>

											<div class="">
											   <h4><?= ucwords($info->status);?></h4>
											</div>
										</div>
								</div>
								<div class="profile__detail">
									<div class="container-fluid">
										<div class="row d-flex">

											<div class="col-lg-6">
												<div class="card">
													<div class="card-body">

									<h4 class="mt-0 header-title">Profile Info</h4>
									<small class="text-muted mb-4"><i>The field labels marked with * are required input fields.</i></small>

									<form id="updateProfile">
										<input type="hidden" name="id" value="<?= $info->id;?>">
										<div class="form-group mb-4">
											<label>Full Name</label>
											<div>
												<div class="input-group">
													<input type="text" class="form-control" name="f_name" readonly value="<?= $info->firstname.' '.$info->lastname;?>">
												</div><!-- input-group -->
											</div>
										</div>

										<div class="form-group mb-4">
											<label>Email</label>
											<div>
												<div class="input-group">
													<input type="email" class="form-control" name="email" readonly value="<?= $info->email;?>">
												</div><!-- input-group -->
											</div>
										</div>
										<div class="form-group mb-4">
											<label>CNIC</label>
											<div>
												<div class="input-group">
													<input type="text" class="form-control" name="cnic" readonly value="<?= $info->nic;?>">
												</div><!-- input-group -->
											</div>
										</div>

										<div class="form-group mb-4">
											<label>Mobile No.*</label>
											<div>
												<div class="input-group">
													<input type="text" class="form-control" name="mobile" placeholder="03009999999" value="<?= $info->mobilephone;?>">
												</div><!-- input-group -->
											</div>
										</div>

										<div class="form-group mb-4">
											<label>Address*</label>
											<div>
												<div class="input-group">
													<input type="text" class="form-control" name="address" placeholder="" value="<?= $info->address;?>">
												</div><!-- input-group -->
											</div>
										</div>
										<button type="submit" class="btn btn-primary waves-effect waves-light float-right">Save</button>
									</form>
								</div>
							</div>

						</div>
						<!-- <hr> -->
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">

									<h4 class="mt-0 header-title">Change Password</h4>
									<small class="text-muted mb-4"><i>The field labels marked with * are required input fields.</i></small>

									<form id="changePassword">
										<input type="hidden" name="id" value="<?= $info->id;?>">
										<div class="form-group mb-4">
											<label>Old Password*</label>
											<div>
												<div class="input-group">
													<input type="password" class="form-control" name="old">
												</div><!-- input-group -->
											</div>
										</div>

										<div class="form-group mb-4">
											<label>New Password*</label>
											<div>
												<div class="input-group">
													<input type="password" class="form-control" name="new">
												</div><!-- input-group -->
											</div>
										</div>

										<div class="form-group mb-4">
											<label>Confirm New Password*</label>
											<div>
												<div class="input-group">
													<input type="password" class="form-control" name="confirm">
												</div><!-- input-group -->
											</div>
										</div>
										<button type="submit" class="btn btn-primary waves-effect waves-light float-right">Save</button>
									</form>
								</div>
							</div>

						</div>


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
</body>
</html>

<?php
echo view('cpanel-layout/footer');
?>


<script type="text/javascript">
	$(document).ready(function() {
		$("#updateProfile").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/user/update_profile',
				data:$("#updateProfile").serialize(),
				success: function (data) {
					if(data.includes('Success')){
						toastr.success(data);
					}else{
						toastr.error(data);
					}
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
		$("#changePassword").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/user/change_password',
				data:$("#changePassword").serialize(),
				success: function (data) {
					if(data.includes('Success')){
						toastr.success(data);
						$('#changePassword').trigger('reset');
					}else{
						toastr.error(data);
					}
				},
				error: function(jqXHR, text, error){
					toastr.error(error);

				}
			});
			return false;
		});
	});
</script>