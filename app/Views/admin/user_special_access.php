<?php
// Top Bar End
echo view('cpanel-layout/header');
echo view('cpanel-layout/navbar');
?>

<!-- Wrapper -->
<div class="hk-wrapper hk-pg-auth" data-layout="navbar" data-menu="light" data-footer="simple">
  <!-- Main Content -->
  <div class="hk-pg-wrapper">
    <!-- Page Header -->
    <div class="container hk-pg-header pg-header-wth-tab pt-7">
     <div class="d-flex">
      <div class="d-flex flex-wrap justify-content-between flex-1">
       <div class="mb-lg-0 mb-2 me-8">
        <h1 class="pg-title">Special Access</h1>
        <h4 class="page-title"><small><?= $userInfo->firstname.' '.$userInfo->lastname ;?> </small></h4>
    </div>
</div>
</div>
</div>
<!-- /Page Header -->
<!-- Page Body -->
<div class="hk-pg-body">
    <div class="container-xxl">
        <div class="tab-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                                <div class="col-md-2">
                                <h6>Modules</h6>
                                </div>

                                <div class="col-md-2">
                                <h6>Permissions</h6>
                                </div>
                            </div>
                            &nbsp;
                        <?php
							//
							foreach($data2->get()->getResult() as $key => $value){
                            ?>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label"><?= $value->permission ?></label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="switch">
                                                        <div class="form-check form-switch mb-1">
                                                           <?php 
                                                            // echo $value->status;
                                                            $db = \Config\Database::connect();
									                         $builder = $db->table('special_permission_allow');
                                                             $builder->where('user_id',$userInfo->id);
                                                             $builder->where('sp_id',$value->id);
                                                             $permission_status = $builder->get()->getRow();
                                                             @$status = $permission_status->status;
                                                            //  echo $status; 
                                                            //  foreach($permission_status as $item){  
                                                            //     $status = $item->status;
                                                            //     echo $status;               
                                                            ?>
                                                             <input type="checkbox" class="form-check-input" name="Access" id="Access"  onchange="special_access_flip('<?php echo $value->id;?>','<?php echo $userInfo->id ?>','<?php echo '0'?>')" switch="success" value="enable" <?= ($status == 1 ) ? 'checked' : ''; ?>/>
                                                            </div>
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                     <?php
                                      }
                                     ?>
                                </div>
                            </div>
                         </div>
                    </div>
                 </div>
                  <!-- /Container -->
            </div>
                <!-- </div>
            </div> -->
    </div>
<!----------Tabs Ends--------------->

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

<?php
echo view('cpanel-layout/footer');
?>

<script>
		function special_access_flip(mod,user,operation) {

            // alert(mod);
            //
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>/User/special_access_flip",
				data:'module='+mod+'&user='+user+'&operation='+operation,
				success: function(data){
					// for get return data
					// toastr.success(data);
				}
				
			});
		}
</script>



