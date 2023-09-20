<?php
// Top Bar End
echo view('cpanel-layout/header');
echo view('cpanel-layout/navbar');
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
        <div class="row">
             <div class="col-lg-11">
				<h4 class="page-title">Allow Access <br><small><?= $userInfo->firstname.' '.$userInfo->lastname ;?> </small></h4>
         </div>
     </div>

            <div class="row">
             <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="table1" class="table nowrap w-100 mb-5">
							<thead>
                                  <tr>
									<th>Category</th>
									<th>Module</th>
									<th>View</th>
									<th>Create</th>
									<th>Update</th>
									<th>Delete</th>
                                  </tr>
							</thead>
							<tbody>
									<?php
										//
										foreach($data2->get()->getResult() as $key => $value){
											$module=$value->id;
											?>
											<tr>
												<td><?php echo $modelUser->get_main_menu($value->menu_id)->get()->getRow()->menu;?></td>
												<td><?php echo $value->submenu;?></td>

												<?php if(access_crud($value->submenu,'view',$id)){
													$check='checked';
												}else{
													$check='';
												}?>
												<td><!-- create switch -->
												<div class="form-check form-switch mb-1">
													<input type="checkbox" class="form-check-input" name="block" id="view<?= $id.$module;?>" switch="success" onchange="crud_flip('<?php echo $module;?>','<?php echo $id;?>','view')" <?php echo $check;?>  />
												    <label for="view<?= $id.$module;?>" data-on-label="ON" data-off-label="OFF"></label>
												</div>

												</td>
												<?php if(access_crud($value->submenu,'create',$id)){
													$check='checked';
												}else{
													$check='';
												}?>
												<td>
													<!-- create switch -->
													<div class="form-check form-switch mb-1">
													  <input type="checkbox" name="block" class="form-check-input" id="create<?= $id.$module;?>" switch="success" onchange="crud_flip('<?php echo $module;?>','<?php echo $id;?>','create')" <?php echo $check;?>/>
													  <label for="create<?= $id.$module;?>" data-on-label="ON" data-off-label="OFF"></label>
													</div>
												</td>
												<?php if(access_crud($value->submenu,'update',$id)){
													$check='checked';
												}else{
													$check='';
												}?>
												<td><!-- create switch -->
												<div class="form-check form-switch mb-1">
													  <input type="checkbox" name="block" class="form-check-input" id="create<?= $id.$module;?>" switch="success" onchange="crud_flip('<?php echo $module;?>','<?php echo $id;?>','update')" <?php echo $check;?>/>
													  <label for="create<?= $id.$module;?>" data-on-label="ON" data-off-label="OFF"></label>
												</div>
												</td> 
												<?php if(access_crud($value->submenu,'delete',$id)){
													$check='checked';
												}else{
													$check='';
												}?>
												<td><!-- create switch -->
												<div class="form-check form-switch mb-1">
													  <input type="checkbox" name="block" class="form-check-input" id="create<?= $id.$module;?>" switch="success" onchange="crud_flip('<?php echo $module;?>','<?php echo $id;?>','delete')" <?php echo $check;?>/>
													  <label for="create<?= $id.$module;?>" data-on-label="ON" data-off-label="OFF"></label>
													</div>
												</td>

											</tr>

										<?php } ?>
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

<!-- sample modal content -->
<div id="updateModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">User Detail</h5>
            </div>
            <form id="updUserForm" class="form-horizontal form-label-left input_mask">
                <div class="modal-body" id="updateuser">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
echo view('cpanel-layout/footer');
?>


<script type="text/javascript">
		$(document).ready( function () {
			$('#table1').DataTable();
		} );
	</script>
	<script>
		function crud_flip(mod,user,operation) {
//
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>/user/crud_flip",
				data:'module='+mod+'&user='+user+'&operation='+operation,
				success: function(data){
					// for get return data
					$("#output").html(data);
				}
				
			});
		}
	</script>
