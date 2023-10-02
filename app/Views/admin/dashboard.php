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
				<h1>Dashboard</h1>
				   Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, alias ea consectetur, repellat id velit perferendis non esse tenetur quidem omnis nostrum reprehenderit autem aut error cum consequuntur voluptatem incidunt.
				<?php
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
</body>

</html>

<?php
echo view('cpanel-layout/footer');
?>