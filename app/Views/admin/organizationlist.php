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
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="d-inline-block">Organization<small> List</small></h3>
                        <div class="pull-right mb-3">
                            <?php if(isset($_SERVER['HTTP_REFERER'])){ ?>
                                <a type="button" class="btn btn-secondary btn-icon" href="<?= $_SERVER['HTTP_REFERER'];?>">
                                    <span class="btn-icon-label"><i class="fa fa-arrow-left mr-2"></i></span> Go Back
                                </a>
                            <?php } ?>
                            <button type="button" class="btn btn-primary btn-icon" onclick="$('#addOrganizationModel').modal('show');">
                                <span class="btn-icon-label"><i class="fa fa-plus mr-2"></i></span>Add New Organization
                            </button>
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- <div class="row"> -->
                       <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table1" class="table nowrap w-100 mb-5">
                                     <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Organization</th>
                                        <th>Address 1</th>
                                        <th>Address 2</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Zip Code</th>
                                        <th>Industry</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody1">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- </div> -->
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
<div id="updateorganizationModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Organization Detail</h5>
                <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeupdatemodal">x</span>
            </div>
            <form id="updOrganizationForm" class="form-horizontal form-label-left input_mask">
                <div class="modal-body" id="updateorganization">

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
echo view('admin/popup/add_organization');
?>

<script>
    $(document).ready(function(){
        organization_fetchdata();
    });
  //
    function organization_fetchdata(){
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table1').dataTable().fnDestroy();
        $('#tbody1').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Organization/show_organization',
            success: function(data){
                $('#tbody1').html(data);
                $('#table1').DataTable();
            }
        })
    }
</script>
<script>
    $(document).on('click','.UpdOrganizationBtn',function(){
        var id = $(this).attr('data-organizationid');
        // alert(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>/Organization/update_Organization_from",
            data:'id='+id,
            success: function(data){
                $("#updateorganization").html(data);
                $('#updateorganizationModel').modal('show');
            },
            error: function(jqXHR, text, error){
                toastr.error(error);
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#updOrganizationForm").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Organization/update_organization',
                data:$("#updOrganizationForm").serialize(),
                success: function (data) {
                    toastr.success(data);
                    $('#updateorganizationModel').modal('hide');
                    organization_fetchdata();
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
        $("#addOrganizationform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Organization/add_organization',
                data:$("#addOrganizationform").serialize(),
                success: function (data) {
                    toastr.success(data);
                    $('#addOrganizationModel').modal('hide');
                    $('#addOrganizationform').trigger('reset');
                    organization_fetchdata();
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
    $(document).on('click','.delOrganizationBtn',function(){
        var id = $(this).attr('data-organizationid'); 
        //
        if(confirm("Do you really want to delete this?")){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Organization/delete_organization",
                data:'id='+id,
                success: function(data){
                    organization_fetchdata();
            // snack('#59b35a','User Deleted Successfully','check-square-o');
                    toastr.success(data);
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script>


<!------------this code is used t make depent dropdown of country city state ------->
<script>

    $(document).ready(function(){
   // $('#country').change(function(){
        $(document).on('change','#country',function(){
            var id = $(this).val();
            console.log(id);
            //
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: "<?php echo base_url(); ?>/Organization/get_state",
                data: 'id='+id,
                success: function(data){
                    // console.log(data.state);
                    $('#state').html('<option value="">select</option>');
                    $('#city').html('<option value="">select</option>');
                    $.each(data.state, function(index, item) {
                        $('#state').append('<option value="'+item.id+'">'+item.name+'</option>');
                    });
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }); 
    });
</script>
<!------------this code is used t make depent dropdown of country city state ------->
<script>
    $(document).ready(function(){
        $(document).on('change','#state',function(){
        var id = $('#state').val();
        // alert(id);
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: "<?php echo base_url(); ?>/Organization/get_cities",
            data: 'id='+id,
            success: function(data){
                $('#city').html('<option value="">select</option>');
                 $.each(data.cities, function(index, item) {
                 $('#city').append('<option value="'+item.id+'">'+item.name+'</option>');
            });              
          },error: function(jqXHR, text, error){
            toastr.error(error);
        }
    });
    }); 
 });
</script>

<script>
    $('#closeaddmodal').click(function() {
        $('#addOrganizationModel').modal('hide');
    });
</script>

<script>
    $('#closeupdatemodal').click(function() {
        $('#updateorganizationModel').modal('hide');
    });
</script>




