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
                <h3>Dashboard <small>Menu Management</small><h3>
         </div>
	 <div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="w-100 d-flex align-items-centre justify-content-between mb-3">
							
							<h5 class="mb-0">Main Menu</h5>
							<button type="button" class="btn btn-primary btn-icon float-right btn-sm" onclick="$('#addMainMenuModel').modal('show');">
								<span class="btn-icon-label"><i class="fa fa-plus mr-2"></i></span>Add New
							</button>
							</div>
							<div class="table-responsive">
								<table id="menuTable" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
									<thead>
										<tr>
											<th>#</th>
											<th>Menu</th>
											<th>Has Submenu</th>
											<th>Icon</th>
											<th>Order</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
						<div class="w-100 d-flex align-items-centre justify-content-between mb-3">
						<h5 class="mb-0">Sub Menu</h5>

							<button type="button" class="btn btn-primary btn-icon float-right btn-sm" onclick="$('#addSubMenuModel').modal('show');">
								<span class="btn-icon-label"><i class="fa fa-plus mr-2"></i></span>Add New
							</button>
</div>
							<div class="table-responsive">
								<table id="submenuTable" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
									<thead>
										<tr>
											<th>#</th>
											<th>ID</th>
											<th>Sub Menu</th>
											<th>Main Menu</th>
											<th>Route</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
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



<!---------------------------------------------Modals------------------------------------>

<div id="addMainMenuModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Add Main Menu</h5>
		
					</button>
				</div>
				<form id="addMainMenuform" class="form-horizontal form-label-left input_mask">
					<div class="modal-body">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleFormControlInput1">Menu</label>
										<input type="text" class="form-control" name="menu" id="exampleFormControlInput1" required="">
									</div>
									<div class="custom-control custom-checkbox">
										<input type="hidden" name="has_submenu" value="0">
										<input type="checkbox" name="has_submenu" value="1" class="custom-control-input" id="customCheck2">
										<label class="custom-control-label" for="customCheck2">Has Submenu</label>
									</div>
									<div class="form-group">
										<label for="exampleFormControlInput1">Icon</label>
										<input type="text" class="form-control" name="icon" id="exampleFormControlInput1" required="">
									</div>
									<div class="form-group">
										<label for="exampleFormControlInput1">Order</label>
										<input type="number" class="form-control" name="order" id="exampleFormControlInput1" required="">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					
						<button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Add Sub Menu modal content -->
	<div id="addSubMenuModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Add Sub Menu</h5>
					</button>
				</div>
				<form id="addSubMenuform" class="form-horizontal form-label-left input_mask">
					<div class="modal-body">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleFormControlInput1">Sub Menu</label>
										<input type="text" class="form-control" name="submenu" id="exampleFormControlInput1" required="">
									</div>
									<div class="form-group">
										<label for="exampleFormControlInput1">Menu</label>
										<select class="form-control" name="menu" required>
											<option value="">Select Parent Menu</option>
											<?php foreach($main_menu->get()->getResult() as $value){?>
												<option value="<?= $value->id;?>"><?= $value->menu;?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleFormControlInput1">Route</label>
										<input type="text" class="form-control" name="route" id="exampleFormControlInput1" required="">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Update Sub Menu modal content -->
	<div id="updateSubMenuModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Update Sub Menu</h5>
				</div>
				<form id="updateSubMenuform" class="form-horizontal form-label-left input_mask">
					<div class="modal-body">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12" id="updateSubMenuContent">
									<!-- content here -->
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						
						<button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

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


<script>
	$(document).ready(function(){
		fetchdata('menuTable','/Dashboard_menu/show_main_menu');
		fetchdata('submenuTable','/Dashboard_menu/show_sub_menu');
	});
  //
  function fetchdata(table,func){
  	var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
  	$('#'+table).dataTable().fnDestroy();
  	$('#'+table+' tbody').html(loader);
  	$.ajax({
  		method: 'POST',
  		url: '<?php echo base_url();?>'+func,
  		success: function(data){
  			$('#'+table+' tbody').html(data);
  			$('#'+table).DataTable();
  		}
  	})
  }
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#addMainMenuform").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Dashboard_menu/add_main_menu',
				data:$("#addMainMenuform").serialize(),
				success: function (data) {
					if(data.includes('Success')){
						toastr.success(data);
						$('#addMainMenuModel').modal('hide');
						fetchdata('menuTable','/Dashboard_menu/show_main_menu');
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
		$("#addSubMenuform").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Dashboard_menu/add_sub_menu',
				data:$("#addSubMenuform").serialize(),
				success: function (data) {
					if(data.includes('Success')){
						toastr.success(data);
						$('#addSubMenuModel').modal('hide');
						fetchdata('submenuTable','/Dashboard_menu/show_sub_menu');
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
<script>
	$(document).on('click','.updUserBtn',function(){
		var id = $(this).attr('data-id');
		$.ajax({
			method: 'POST',
			url: '<?php echo base_url();?>/Dashboard_menu/update_menu_content',
			data:'id='+id,
			success: function(data){
				$('#updateSubMenuContent').html(data);
				$('#updateSubMenuModel').modal('show');
			}
		})
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#updateSubMenuform").submit(function() {
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>/Dashboard_menu/update_sub_menu',
				data:$("#updateSubMenuform").serialize(),
				success: function (data) {
					if(data.includes('Success')){
						toastr.success(data);
						$('#updateSubMenuModel').modal('hide');
						fetchdata('submenuTable','/Dashboard_menu/show_sub_menu');
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