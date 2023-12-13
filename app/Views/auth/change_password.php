<?php
// Top Bar End
echo view('cpanel-layout/header');
?>
<body class="login-img">
   	<!-- Wrapper -->
	<div class="hk-wrapper hk-pg-auth " data-footer="simple">
		<!-- Main Content -->
		<div class="hk-pg-wrapper pt-0 pb-xl-0 pb-5">
			<div class="hk-pg-body pt-0 pb-xl-0">
				<!-- Container -->
				<div class="container-xxl">
					<!-- Row -->
					<div class="row">
						<div class="col-sm-10 position-relative mx-auto">
							<div class="auth-content py-8">
								<form id="passchangeForm" class="w-100">
									<div class="row">
										<div class="col-lg-5 col-md-7 col-sm-10 mx-auto">
											<div class="text-center mb-7">
												<a class="navbar-brand me-0" href="">
												<img src="<?= base_url();?>/assets/images/logo-sm.png?t=<?= time(); ?>" alt=""  width="220px">
												</a>
											</div>
											<div class="card card-lg card-border">
												<div class="card-body">
													<h4 class="mb-4 text-center">Change Password</h4>
													<div class="row gx-3">
														<div class="form-group col-lg-12">
															<div class="form-label-group">
																<label>password</label>
															</div>
															<div class="input-group password-check">
																<span class="input-affix-wrapper">
																	<input class="form-control" name="password" placeholder="Enter passwords" value="" type="password">
																	<a href="#" class="input-suffix text-muted">
																		<span class="feather-icon"><i class="form-icon" data-feather="eye"></i></span>
																		<span class="feather-icon d-none"><i class="form-icon" data-feather="eye-off"></i></span>
																	</a>
																</span>
															</div>
														</div>
														<div class="form-group col-lg-12">
														<div class="form-label-group">
																<label>confirm password</label>
															</div>
															<div class="input-group password-check">
																<span class="input-affix-wrapper">
																	<input class="form-control" name="confirm_password" placeholder="Enter confirm passwords" value="" type="password">
																	<a href="#" class="input-suffix text-muted">
																		<span class="feather-icon"><i class="form-icon" data-feather="eye"></i></span>
																		<span class="feather-icon d-none"><i class="form-icon" data-feather="eye-off"></i></span>
																	</a>
																</span>
															</div>
														</div>
													</div>
													
													<div class="col-sm-12 text-right mt-4" id="changepassbtn">
                                                     <button class="btn btn-primary btn-uppercase btn-block" type="submit">save</button>
                                                    </div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /Row -->
				</div>
				<!-- /Container -->
			</div>
			<!-- /Page Body -->

		
		</div>
		<!-- /Main Content -->
	</div>
    <!-- /Wrapper -->
</body>
</html>

<?php
// Top Bar End
echo view('cpanel-layout/footer');
?>

<script type="text/javascript">
$(document).ready(function() {
      
    $("#passchangeForm").submit(function() {
      $.ajax({
      type: "POST",
      url: '<?php echo base_url();?>/login/changepassword',
      data:$("#passchangeForm").serialize(),
      success: function (data) {
		toastr.success(data);
        setTimeout(function(){ 
        window.location.href = "<?= base_url();?>/login";
        }, 2000);
},
        error: function(jqXHR, text, error){
			toastr.error(error);
  }
});
   return false;
  });
});
</script>


