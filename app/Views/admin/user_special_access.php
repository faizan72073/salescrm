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
        <h1 class="pg-title">Special Acces</h1>
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
                            <form class="p-x-xs" id="settingsForm">
                                <input type="hidden" name="loginOTP" value="disable">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Login OTP</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="switch">
                                                        <div class="form-check form-switch mb-1">
                                                            <input type="checkbox" class="form-check-input" name="loginOTP" id="loginOTP" switch="success" value="enable"  <?= (@$loginOTP->value == 'enable') ? 'checked' : ''; ?>  />
                                                        </div></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Maintanance Mode</label>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="switch">
                                                                <div class="form-check form-switch mb-1">
                                                                    <input type="checkbox" name="mMode" class="form-check-input" id="customSwitch1" value="enable" <?= (@$mMode->value == 'enable') ? 'checked' : ''; ?>>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" name="mModeIPs" placeholder="Allow IPs" value="<?= @$mMode->parameter;?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Application Title</label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="appTitle" placeholder="App Title" value="<?= @$appTitle->parameter;?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Footer Text</label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="footerText" placeholder="Footer Text" value="<?= @$footerText->parameter;?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Application Logo</label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="file" class="form-control" name="smLogo">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img src="<?= base_url();?>/assets/images/logo-sm.png?t=<?php echo time(); ?>" style="max-width:100px;max-height:100px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Small Logo & Favicon</label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="file" class="form-control" name="appLogo">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img src="<?= base_url();?>/assets/images/logo.png?t=<?php echo time(); ?>" style="max-width:100px;max-height:100px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Login Page Background Image</label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="file" class="form-control" name="backImage">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img src="<?= base_url();?>/assets/images/bank/loginBackground.jpg?t=<?php echo time(); ?>" style="max-width:100px;max-height:100px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Currency</label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <select class="form-select form-select-sm w-130p" name="currency">
                                                                <option <?= (@$currency->parameter == 'USD') ? 'selected' : '';?> >USD</option>
                                                                <option <?= (@$currency->parameter == 'AED') ? 'selected' : '';?> >AED</option>
                                                                <option <?= (@$currency->parameter == 'PKR') ? 'selected' : '';?> >PKR</option>
                                                                <option <?= (@$currency->parameter == 'EUR') ? 'selected' : '';?> >EUR</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <!-- <label class="col-sm-2 col-form-label">Maintanance Mode</label> -->
                                                <div class="col-sm-12 ">
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-primary" type="submit">Save</button>

                                                    </div>
                                                    
                                                </div>
                                            </form>
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
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $("#settingsForm").submit(function() {
            $('#action_loader').modal('show');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/settings/update',
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    toastr.success(data);
                    setTimeout(function() { 
                        $('#action_loader').modal('hide');
                        location.reload();
                    }, 1000); 
                },  
                error: function(jqXHR, text, error){
                    // Displaying if there are any errors
                    $('#action_loader').modal('hide');
                    toastr.danger(error); 
                }
            });
            return false;
        });
    });
</script> -->
</script>

<!--------- Product add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addproductform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/add_product',
                data:$("#addproductform").serialize(),
                success: function (data) { 
                 toastr.success(data);
                 $('#addproductform').trigger('reset');
                 $('#addProductModel').modal('hide');
                 category_fetchdata();
                 product_fetchdata();
              },
                error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>
<!------------fetch product data using ajax----------->

<script>
    $(document).ready(function(){
        product_fetchdata();
        category_fetchdata();
        product_categories_fetchdata();
        company_fetchdata();
        department_fetchdata();
        show_country_state_city();
    });
  //
    function product_fetchdata(){
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table1').dataTable().fnDestroy();
        $('#tbody1').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Settings/show_products',
            success: function(data){
                $('#tbody1').html(data);
                $('#table1').DataTable();
                
            }
        })
    }
</script>
<!-------delete product using ajax-------->
<script>
    $(document).on('click','.delProductBtn',function(){
        var val = $(this).attr('data-productid');
        //
        if(confirm("Do you really want to delete this?")){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Settings/delete_product",
                data:'id='+val,
                success: function(data){
                    product_fetchdata();
                    toastr.success(data);
                  
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script>
<!--------update product form using ajax----------->

<script>
    $(document).on('click','.updProductBtn',function(){
        var val = $(this).attr('data-productid');
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>/Settings/update_Product_from",
            data:'id='+val,
            success: function(data){
                $("#updateproduct").html(data);
                $('#updateproductModel').modal('show');
            },
            error: function(jqXHR, text, error){
            // Displaying if there are any errors

            }
        });
    });
</script>

<!--------update product using ajax----------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#updProductForm").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/update_products',
                data:$("#updProductForm").serialize(),
                success: function (data) {
                    toastr.success(data);
                     $('#updateproductModel').modal('hide');
                     product_fetchdata();
                },
                error: function(jqXHR, text, error){
                    toastr.success(data);

                }
            });
            return false;
        });
    });
</script>
<!--------- Product add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addcategoryform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/add_category',
                data:$("#addcategoryform").serialize(),
                success: function (data) { 
                 toastr.success(data);
                 $('#addcategoryform').trigger('reset');
                 $('#addCategoryModel').modal('hide');
                 category_fetchdata();
              },
                error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>


<!---------- delete empty reason -------->
<!-- <script>
    $(document).on('click','.deleteRow',function(){
        var id = $(this).attr('data-id');
        //
        // alert(val);
        if(confirm("Do you really want to delete this?")){

            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Settings/delete_reason",
                data:'id='+id,
                success: function(data){
                    toastr.success(data);
                    location.reload();
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script> -->

<!-------Fetch category using ajax-------->
<script>
  //
    function category_fetchdata(){
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table2').dataTable().fnDestroy();
        $('#tbody2').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Settings/show_categories',
            success: function(data){
                $('#tbody2').html(data);
                $('#table2').DataTable();
            }
        })
    }
</script>
<!-------delete category using ajax-------->
<script>
    $(document).on('click','.delcategoryBtn',function(){
        var val = $(this).attr('data-categoryid');
        //
        if(confirm("Do you really want to delete this?")){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Settings/delete_category",
                data:'id='+val,
                success: function(data){
                    category_fetchdata();
                    toastr.success(data);
                  
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script>
<!--------update Category form using ajax----------->
<script>
    $(document).on('click','.updcategoryBtn',function(){
        var val = $(this).attr('data-categoryid');
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>/Settings/update_category_from",
            data:'id='+val,
            success: function(data){
                $("#updatecategory").html(data);
                $('#updatecategoryModel').modal('show');
            },
            error: function(jqXHR, text, error){
            // Displaying if there are any errors

            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#updcategoryForm").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/update_category',
                data:$("#updcategoryForm").serialize(),
                success: function (data) {
                    toastr.success(data);
                     $('#updatecategoryModel').modal('hide');
                     category_fetchdata();
                },
                error: function(jqXHR, text, error){
                    toastr.success(data);

                }
            });
            return false;
        });
    });
</script>

<!---------fetch categories using ajax------>
<script type="text/javascript">
 function product_categories_fetchdata(){

        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Settings/fetch_categories',
            success: function(data){
                // toastr.success(data); 
                $('#product_categories').html(data)
            }
        })
    }
</script>
<!------update pipeline form using ajax------------>
<script>
    $(document).on('click', '.updpipBtn', function () {
        var id = $(this).attr('data-pipid');
        // alert(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Settings/pipeline_update_form",
            data: 'id='+id,
            success: function (data) {
                $("#updatepipeline").html(data);
                $('#updatepipilineModel').modal('show');
            },
            error: function (jqXHR, text, error) {
                // Displaying if there are any errors
            }
        });
    });
</script>

<!---------  update Pipeline ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#updatepipielineform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/update_pipeline',
                data:$("#updatepipielineform").serialize(),
                success: function (data) {
                    location.reload();
                   toastr.success(data);   
               },
               error: function(jqXHR, text, error){
                toastr.error(error);   
            }
        });
            return false;
        });
    });
</script>

<!--------- company add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addcompanyform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/add_company',
                data:$("#addcompanyform").serialize(),
                success: function (data) { 

                 toastr.success(data);
                //  $('#addCompanyModel').modal('hide');
                 $('#addcompanyform').trigger('reset');
                 location.reload(); 
              },
                error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>



<!--------update company form using ajax----------->

<script>
    $(document).on('click','.UpdCompanyBtn',function(){
        var id = $(this).attr('data-companyid');
        // alert(id);
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>/Settings/update_company_from",
            data:'id='+id,
            success: function(data){
                $("#updatecompany").html(data);
                $('#updcompanyModel').modal('show');
            },
            error: function(jqXHR, text, error){
            // Displaying if there are any errors

            }
        });
    });
</script>

<!--------update company using ajax----------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#updcompanyform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/update_company',
                data:$("#updcompanyform").serialize(),
                success: function (data) {
                    toastr.success(data);
                     $('#updcompanyModel').modal('hide');
                     company_fetchdata();
                },
                error: function(jqXHR, text, error){
                    toastr.success(data);

                }
            });
            return false;
        });
    });
</script>



<script>
function company_fetchdata(){
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table3').dataTable().fnDestroy();
        $('#tbody3').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Settings/show_company',
            success: function(data){
                $('#tbody3').html(data);
                $('#table3').DataTable();
                
            }
        })
    }
</script>

<!----delete  company using ajax--------->
<script>
    $(document).on('click','.delCompanyBtn',function(){
        var id = $(this).attr('data-companyid');
        //
        if(confirm("Do you really want to delete this?")){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Settings/delete_company",
                data:'id='+id,
                success: function(data){
                    company_fetchdata();
                    toastr.success(data);
                  
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script>

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

<script>

    $(document).ready(function(){
   // $('#country').change(function(){
        $(document).on('change','#country2',function(){
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
                    $('#state2').html('<option value="">select</option>');
                    $.each(data.state, function(index, item) {
                        $('#state2').append('<option value="'+item.id+'">'+item.name+'</option>');
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




<!---------email template add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addemailtemplateform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/add_email_template',
                data:$("#addemailtemplateform").serialize(),
                success: function (data) { 

                 toastr.success(data);
                //  $('#addCompanyModel').modal('hide');
                 $('#addemailtemplateform').trigger('reset');
                 location.reload(); 
              },
                error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<!-- <script>
    $(document).on('change','#template',function(){
        var id = $(this).val();

        alert(id);
    });
</script> -->


<!--------- company add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#adddepartmentform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/add_department',
                data:$("#adddepartmentform").serialize(),
                success: function (data) { 

                 toastr.success(data);
                 $('#addDepartmentModel').modal('hide');
                 $('#adddepartmentform').trigger('reset');
                 location.reload(); 
              },
                error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<!--------update department form using ajax----------->

<script>
    $(document).on('click','.UpddepartmentBtn',function(){
        var id = $(this).attr('data-departmentid');
        // alert(id);
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>/Settings/update_department_from",
            data:'id='+id,
            success: function(data){
                // toastr.success(data);
                $("#updatedepartment").html(data);
                $('#upddepartmentModel').modal('show');

            },
            error: function(jqXHR, text, error){
            // Displaying if there are any errors
            toastr.error(error);

            }
        });
    });
</script>

<!--------update department using ajax----------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#upddepartmentform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/update_department',
                data:$("#upddepartmentform").serialize(),
                success: function (data) {
                    toastr.success(data);
                     $('#upddepartmentModel').modal('hide');
                     department_fetchdata();
                },
                error: function(jqXHR, text, error){
                    toastr.success(data);

                }
            });
            return false;
        });
    });
</script>



<script>
function department_fetchdata(){
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table4').dataTable().fnDestroy();
        $('#tbody4').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Settings/show_department',
            success: function(data){
                $('#tbody4').html(data);
                $('#table4').DataTable();
                
            }
        })
    }
</script>

<!----delete  department using ajax--------->
<script>
    $(document).on('click','.deldepartmentBtn',function(){
        var id = $(this).attr('data-departmentid');
        //
        if(confirm("Do you really want to delete this?")){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/Settings/delete_department",
                data:'id='+id,
                success: function(data){
                    department_fetchdata();
                    toastr.success(data);
                  
                },error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
        }
    });
</script>


<!--------- country add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addcountryform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/add_country',
                data:$("#addcountryform").serialize(),
                success: function (data) { 

                 toastr.success(data);
                //  $('#addCompanyModel').modal('hide');
                 $('#addcountryform').trigger('reset');
                 location.reload(); 
              },
                error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>
<!--------- state add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addstateform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/add_state',
                data:$("#addstateform").serialize(),
                success: function (data) { 

                 toastr.success(data);
                //  $('#addCompanyModel').modal('hide');
                 $('#addstateform').trigger('reset');
                 location.reload(); 
              },
                error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<!--------- city add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addcityform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>/Settings/add_city',
                data:$("#addcityform").serialize(),
                success: function (data) { 

                 toastr.success(data);
                //  $('#addCompanyModel').modal('hide');
                 $('#addcityform').trigger('reset');
                 location.reload(); 
              },
                error: function(jqXHR, text, error){
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<!--------this function is used to get template details-------->
<script>
    $(document).ready(function(){
        $(document).on('change','#template',function(){
        var id = $('#template').val();
        // alert(id);
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: "<?php echo base_url(); ?>/Settings/get_template_detail",
            data: 'id='+id,
            success: function(data){
                $('#template_name').val('');
                $('#template_subject').val('');
                $('#template_description').val('');
                //
                $('#template_name').val(data.template_name);
                $('#template_subject').val(data.subject);
                // $("#template_status").attr('checked', 'checked');
                $('#template_status[value="' + data.status + '"]').prop('checked', true);

                $('#template_description').val(data.description);
                
          },error: function(jqXHR, text, error){
            toastr.error(error);
        }
    });
    }); 
 });
</script>

<!-----country state city data---------------->
<script>
function show_country_state_city(){
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table5').dataTable().fnDestroy();
        $('#tbody5').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url();?>/Settings/show_country_state_city',
            success: function(data){
                $('#tbody5').html(data);
                $('#table5').DataTable();
                
            }
        })
    }
</script>

<script>
$(document).ready(function(){

	
    $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTabSetting', $(e.target).attr('href'));
    });
    var activeTabsetting = localStorage.getItem('activeTabSetting');
    if(activeTabsetting){
        $('.nav-tabs a[href="' + activeTabsetting + '"]').tab('show');

    } else {
		$('.nav-tabs a[href="#application"]').tab('show');
	}
});
</script>



<script>
    $('#closeproductmodal').click(function() {
        $('#addProductModel').modal('hide');
    });
</script>

<script>
    $('#closecompanymodal').click(function() {
        $('#addCompanyModel').modal('hide');
    });
</script>

<script>
    $('#closeupdcompanymodal').click(function() {
        $('#updcompanyModel').modal('hide');
    });
</script>


<script>
    $('#closedepartmentmodal').click(function() {
        $('#addDepartmentModel').modal('hide');
    });
</script>


<script>
    $('#closepipelinemodal').click(function() {
        $('#updatepipilineModel').modal('hide');
    });
</script>


<script>
    $('#closeaddpipelinemodal').click(function() {
        $('#addPipelineModel').modal('hide');
    });
</script>



<script>
    $('#closecategorymodal').click(function() {
        $('#addCategoryModel').modal('hide');
    });
</script>


<script>
    $('#closeupdcategorymodal').click(function() {
        $('#updatecategoryModel').modal('hide');
    });
</script>

<script>
    $('#closeupdproductmodal').click(function() {
        $('#updateproductModel').modal('hide');
    });
</script>


<script>
    $('#closeupddepartmentmodal').click(function() {
        $('#upddepartmentModel').modal('hide');
    });
</script>



