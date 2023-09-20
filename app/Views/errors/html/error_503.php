
<?php
// Top Bar End
echo view('cpanel-layout/header');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jampack - Admin CRM Dashboard Template</title>
    <meta name="description" content="A modern CRM Dashboard Template with reusable and flexible components for your SaaS web applications by hencework. Based on Bootstrap."/>

</head>
<body>
   	<!-- Wrapper -->
	<div class="hk-wrapper hk-pg-auth" data-layout="navbar" data-menu="light" data-footer="simple">
	

		<!-- Main Content -->
		<div class="hk-pg-wrapper">
			<!-- Page Body -->
			<div class="hk-pg-body">
				<!-- Container -->
				<div class="container-xxl">
					<!-- Row -->
					<div class="auth-content py-md-0 py-8">
						<div class="d-flex justify-content-center">
							<div class="w-50 text-center">
								<h1 class="display-4 fw-bold mb-2">503</h1>
								<p>Server is temporarily unable to handle the request. This may be due to the server being overloaded or down for maintenance.</p>
								<a href="<?php base_url() ?>/dashboard" class="btn btn-primary mt-4">Return to App</a>
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