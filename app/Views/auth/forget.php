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
								<form id="ForgetForm" class="w-100">
									<div class="row">
										<div class="col-lg-5 col-md-7 col-sm-10 mx-auto">
											<div class="text-center mb-7">
												<a class="navbar-brand me-0" href="">
												<img src="<?= base_url();?>/assets/images/logo-sm.png?t=<?= time(); ?>" alt=""  width="220px">
												</a>
											</div>
											<div class="card card-lg card-border">
												<div class="card-body">
													<h4 class="mb-4 text-center">Forget Password</h4>
													<div class="row gx-3">
														<div class="form-group col-lg-12">
															<div class="form-label-group">
																<label>Email</label>
															</div>
															<input class="form-control" name="email" placeholder="Enter Register Eamil Address"  value="" type="email">
														</div>
													
													</div>
											
													<div class="col-sm-12 text-right mt-4" id="loginbtn">
                                                     <button class="btn btn-primary btn-uppercase btn-block" type="submit">Forget</button>
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
      
    $("#ForgetForm").submit(function() {
      $.ajax({
      type: "POST",
      url: '<?php echo base_url();?>/login/forgot_password',
      data:$("#ForgetForm").serialize(),
      success: function (data) {
		toastr.success(data);
        setTimeout(function(){ 
        window.location.href = "<?= base_url();?>/otp";
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


