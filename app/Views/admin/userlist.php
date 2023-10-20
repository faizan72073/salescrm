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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="d-inline-block">User <small>List</small></h3>
                            <div class="pull-right mb-3">
                                <?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
                                    <a type="button" class="btn btn-secondary btn-icon"
                                        href="<?= $_SERVER['HTTP_REFERER']; ?>">
                                        <span class="btn-icon-label"><i class="fa fa-arrow-left mr-2"></i></span> Go Back
                                    </a>
                                <?php } ?>
                                <button type="button" class="btn btn-primary btn-icon"
                                    onclick="$('#addUserModel').modal('show');">
                                    <span class="btn-icon-label"><i class="fa fa-plus mr-2"></i></span>Add New User
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
                                                    <th>Username</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Department</th>
                                                    <th>Company</th>
                                                    <th>Mobile</th>
                                                    <th>Status</th>
                                                    <th>Active|Block</th>
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
                                <p class="footer-text"><span class="copy-text">©
                                        <?= get_setting_value('App Title'); ?>
                                    </span> <a href="#" class="" target="_blank">Privacy Policy</a><span
                                        class="footer-link-sep">|</span><a href="#" class=""
                                        target="_blank">T&C</a><span class="footer-link-sep">|</span><a href="#"
                                        class="" target="_blank">System Status</a></p>
                            </div>
                            <div class="col-xl-4">
                                <a href="#" class="footer-extr-link link-default"><span class="feather-icon"><i
                                            data-feather="external-link"></i></span><u>Send feedback to our help
                                        forum</u></a>
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
<div id="updateuserModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">User Detail</h5>
                <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeusermodal">x</span>
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
echo view('admin/popup/add_user');
?>

<script>
    $(document).ready(function () {
        user_fetchdata();
    });
    //
    function user_fetchdata() {
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table1').dataTable().fnDestroy();
        $('#tbody1').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/User/show_users',
            success: function (data) {
                $('#tbody1').html(data);
                $('#table1').DataTable();
            }
        })
    }
</script>
<script>
    $(document).on('click', '.updUserBtn', function () {
        var val = $(this).attr('data-userid');
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/User/update_form",
            data: 'userid=' + val,
            success: function (data) {
                $("#updateuser").html(data);
                $('#updateuserModel').modal('show');
            },
            error: function (jqXHR, text, error) {
                // Displaying if there are any errors
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#updUserForm").submit(function () {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/user/update_user',
                data: $("#updUserForm").serialize(),
                success: function (data) {
                    toastr.success(data);
                    $('#updateuserModel').modal('hide');
                    user_fetchdata();
                },
                error: function (jqXHR, text, error) {
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#adduserform").submit(function () {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/user/add_user',
                data: $("#adduserform").serialize(),
                success: function (data) {
                    toastr.success(data);
                    $('#addUserModel').modal('hide');
                    $('#adduserform').trigger('reset');
                    user_fetchdata();
                },
                error: function (jqXHR, text, error) {
                    // Displaying if there are any errors
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>
<script>
    $(document).on('click', '.delUserBtn', function () {
        var val = $(this).attr('data-userid');
        //
        if (confirm("Do you really want to delete this?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/user/delete_user",
                data: 'id=' + val,
                success: function (data) {
                    user_fetchdata();
                    // snack('#59b35a','User Deleted Successfully','check-square-o');
                    toastr.success(data);
                }, error: function (jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        }
    });
</script>

<script>
    $('#closemodal').click(function () {
        $('#addUserModel').modal('hide');
    });
</script>


<script>
    $('#closeusermodal').click(function () {
        $('#updateuserModel').modal('hide');
    });
</script>