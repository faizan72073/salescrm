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
        <div class="row">
             <div class="col-11">
                <h3>User <small>Login History</small><h3>
         </div>
         <div class="col-1">
         <?php if(isset($_SERVER['HTTP_REFERER'])){ ?>
             <a type="button" class="btn btn-secondary btn-icon pull-right mb-3" href="<?= $_SERVER['HTTP_REFERER'];?>">
                <span class="btn-icon-label"><i class="fa fa-arrow-left mr-2"></i></span> Go Back
             </a>
                <?php } ?>
         </div>
     </div>

            <div class="row">
             <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="table1" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>Username/Email</th>
                                    <th>Login Date Time</th>
                                    <th>IP Address</th>
                                    <th>Platform</th>
                                    <th>Browser</th>
                                </tr>
                            </thead>
                            <tbody id="tbody1">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
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
							<p class="footer-text"><span class="copy-text">© <?= get_setting_value('App Title');?></span> <a href="#" class="" target="_blank">Privacy Policy</a><span class="footer-link-sep">|</span><a href="#" class="" target="_blank">T&C</a><span class="footer-link-sep">|</span><a href="#" class="" target="_blank">System Status</a></p>
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
        user_fetchdata();
    });
  //
    function user_fetchdata(){
        $('#table1').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?php echo base_url();?>/user/login_history_datatable',
        order: [],
        columns: [
            {data: 'username'},
            {data: 'login_time'},
            {data: 'ip'},
            {data: 'platform'},
            {data: 'browser'},
        ]
    });
    }
</script>
