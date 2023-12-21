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
                        <h1 class="pg-title">Setting</h1>
                    </div>
                </div>
            </div>
            <ul class="nav nav-line nav-light nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#application">
                        <span class="nav-link-text">Application</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#pipeline">
                        <span class="nav-link-text">Pipeline</span>
                    </a>
                </li>
                <!-- Add a dropdown for smaller screens -->
                <li class="nav-item dropdown d-sm-none"> <!-- Hidden on small devices -->
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" data-bs-toggle="tab" href="#lostreason">Lost Reason</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#invoice">Invoice</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#product_category">Product | Category</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#company">Company</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#department">Department</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#country_state_city">Country | State | City</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#reminder">Set Reminder</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#email_smtp">Email SMTP</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#email_template">Email Template</a>
                    </div>
                </li>
                <!-- End dropdown -->

                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#lostreason">
                        <span class="nav-link-text">Lost Reason</span>
                    </a>
                </li>
                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#invoice">
                        <span class="nav-link-text">Invoice</span>
                    </a>
                </li>
                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#product_category">
                        <span class="nav-link-text">Product | Category</span>
                    </a>
                </li>
                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#company">
                        <span class="nav-link-text">Company</span>
                    </a>
                </li>
                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#department">
                        <span class="nav-link-text">Department</span>
                    </a>
                </li>
                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#country_state_city">
                        <span class="nav-link-text">Country | State | City</span>
                    </a>
                </li>
                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#reminder">
                        <span class="nav-link-text">Set Reminder</span>
                    </a>
                </li>
                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#email_smtp">
                        <span class="nav-link-text">Email SMTP</span>
                    </a>
                </li>
                <li class="nav-item d-sm-block d-none">
                    <a class="nav-link" data-bs-toggle="tab" href="#email_template">
                        <span class="nav-link-text">Email Template</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- /Page Header -->
        <!-- Page Body -->
        <div class="hk-pg-body">
            <div class="container-xxl">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="application">
                        <div class="container">
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
                                                                            <input type="checkbox" class="form-check-input" name="loginOTP" id="loginOTP" switch="success" value="enable" <?= ($loginOTP->value == 'enable') ? 'checked' : ''; ?> />
                                                                        </div>
                                                                    </label>
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
                                                                                <input type="checkbox" name="mMode" class="form-check-input" id="customSwitch1" value="enable" <?= ($mMode->value == 'enable') ? 'checked' : ''; ?>>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" class="form-control" name="mModeIPs" placeholder="Allow IPs" value="<?= $mMode->parameter; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Application Title</label>
                                                        <div class="col-sm-10">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <input type="text" class="form-control" name="appTitle" placeholder="App Title" value="<?= $appTitle->parameter; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Footer Text</label>
                                                        <div class="col-sm-10">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <input type="text" class="form-control" name="footerText" placeholder="Footer Text" value="<?= $footerText->parameter; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row my-4">
                                                        <label class="col-sm-2 col-form-label">Application Logo</label>
                                                        <div class="col-sm-10">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="file" class="form-control" name="smLogo">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <img class="border p-2 shadow rounded" src="<?= base_url(); ?>/assets/images/logo-sm.png?t=<?php echo time(); ?>" style="max-width:100px;max-height:100px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row my-4">
                                                        <label class="col-sm-2 col-form-label">Small Logo & Favicon</label>
                                                        <div class="col-sm-10">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="file" class="form-control" name="appLogo">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <img class="border p-2 shadow rounded" src="<?= base_url(); ?>/assets/images/logo.png?t=<?php echo time(); ?>" style="max-width:100px;max-height:100px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row my-4">
                                                        <label class="col-sm-2 col-form-label">Login Page Background Image</label>
                                                        <div class="col-sm-10">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="file" class="form-control" name="backImage">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <img class="border p-1 shadow rounded" src="<?= base_url(); ?>/assets/images/bank/loginBackground.jpg?t=<?php echo time(); ?>" style="max-width:100px;max-height:100px;">
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
                                                                        <option <?= ($currency->parameter == 'USD') ? 'selected' : ''; ?>>USD</option>
                                                                        <option <?= ($currency->parameter == 'AED') ? 'selected' : ''; ?>>AED</option>
                                                                        <option <?= ($currency->parameter == 'PKR') ? 'selected' : ''; ?>>PKR</option>
                                                                        <option <?= ($currency->parameter == 'EUR') ? 'selected' : ''; ?>>EUR</option>
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
                    </div>
                </div>
                <!-- /Container -->
            </div>
            <div class="tab-pane fade" id="pipeline">
                <div class="container">
                    <div class="taskboard-body taskboard-body-alt">
                        <div>
                            <div data-simplebar class="tasklist-scroll position-relative">
                                <div id="tasklist_wrap" class="tasklist-wrap justify-content-center" style="float:none">
                                    <div class="card card-simple card-flush spipeline-list">
                                        <div class="card card-simple card-border spipeline-list create-new-list">
                                            <div class="card-header card-header-action">
                                                <button class="btn btn-light btn-block bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#add_task_list"><span><span class="icon"><span class="feather-icon"><i data-feather="plus"></i></span></span><span class="btn-text" onclick="$('#addPipelineModel').modal('show');">Add New Pipeline</span></span></button>
                                            </div>
                                        </div>
                                        <form id="pipelineForm">
                                            <div class="card-body">
                                                <div id="i1" class="tasklist-cards-wrap">
                                                    <?php foreach ($pipeline->get()->getResult() as $item) {
                                                    ?>
                                                        <div class="card card-border spipeline-card">
                                                            <div class="card-body">
                                                                <div class="media">
                                                                    <div class="media-head">
                                                                    </div>
                                                                    <input type="hidden" name="pipeline[]" value="<?php echo $item->id; ?>">
                                                                    <div class="media-body">
                                                                        <span class="brand-name"><?php echo $item->name ?></span>
                                                                        <div><?php echo $item->description ?></div>
                                                                        <span class="feather-icon "><i data-feather="move"></i></span>
                                                                    </div>
                                                                    <a href="javascript:void(0);" class="text-danger delBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-id="<?php echo $item->id; ?>"><i class="fa fa-trash-alt"></i></a>
                                                                    <a href="javascript:void(0);" class="mr-3 text-primary updpipBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-pipid="<?php echo $item->id; ?>"><i class="fa fa-edit"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div>
            </div> -->
            <div class="tab-pane fade" id="lostreason">
                <div class="container">
                    <form id="lostreasonform">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="d-flex justify-content-between mb-3">
                                    <h2>Lost reasons</h2>
                                    <button onclick="show()" type="button" class="btn btn-primary" id="addButton">
                                        <i class="fa fa-plus mr-2"></i> Add Row
                                    </button>
                                </div>
                                <div class="form-group" id="container">
                                    <?php
                                    $result = $lostreason->get()->getResult();
                                    if (!empty($result)) {
                                        foreach ($result as $item) {
                                    ?>
                                            <div class="input-group mb-3">
                                                <input type="hidden" name="id[]" value="<?php echo $item->id ?>">
                                                <input type="text" class="form-control" value="<?php echo $item->reason; ?>" placeholder="Enter Lost Reason" aria-label="Enter Lost Reason" name="reason[]" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-danger delbtn" data-id="<?php echo $item->id ?>" type="button" id="button-addon2"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <!--  <div class="form-group"  id="container">
                                            <input type="text" class="form-control mb-3" name="reason[]" placeholder="Enter Lost Reason" value="<php echo $item->reason; ?> " style="width: 90%">
                                        </div> -->
                                            <!-- <input class="form-control mb-3 d-inline-block" type="text" placeholder="Enter Lost Reason " name="reason[]" style="width: 90%"/>
                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button> -->
                                    <?php
                                        }
                                    } else {
                                        echo '<center>No data available</center>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <button style="" id="subbtn" type="submit" class="btn btn-primary waves-effect waves-light">Submit Reason</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!----------Invoice Tabs Stars--------------->
            <div class="tab-pane fade" id="invoice">


                <div class="container">
                    <p>No Data Found</p>
                </div>

            </div>

            <!----------product category Tabs Stars--------------->
            <div class="tab-pane fade" id="product_category">
                <div class="container">
                    <h2>Product | Category</h2>
                    <ul class="nav nav-line nav-light nav-tabs">
                        <li class="nav-item" onclick="product_fetchdata();">
                            <a class="nav-link active" data-bs-toggle="tab" href="#product">
                                <span class="nav-link-text" style="font-size:12px;">Add Product</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#category">
                                <span class="nav-link-text" style="font-size:12px;">Add Category</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product">
                            <div class="col-12">
                                <div style="display:flex; align-items:center;justify-content:flex-end;column-gap:10px;">
                                    <?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
                                        <a type="button" class="btn btn-secondary btn-icon" href="<?= $_SERVER['HTTP_REFERER']; ?>">
                                            <span class="btn-icon-label"><i class="fa fa-arrow-left mr-2"></i></span> Go Back
                                        </a>
                                    <?php } ?>
                                    <button style="float:right;" type="button" class="btn btn-primary btn-icon" onclick="$('#addProductModel').modal('show'); product_categories_fetchdata();">
                                        <span class="btn-icon-label"><i class="fa fa-plus mr-2"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="table1" class="table nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Name</th>
                                                        <th>Product Code</th>
                                                        <th>Product Category</th>
                                                        <th>Unit</th>
                                                        <th>Unit Price</th>
                                                        <th>Discount</th>
                                                        <th>Total Tax</th>
                                                        <th>Action</th>
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
                        <div class="tab-pane fade" id="category">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end gap-2 mb-3">
                                    <?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
                                        <a type="button" class="btn btn-secondary btn-icon" href="<?= $_SERVER['HTTP_REFERER']; ?>">
                                            <span class="btn-icon-label"><i class="fa fa-arrow-left mr-2"></i></span> Go Back
                                        </a>
                                    <?php } ?>
                                    <button type="button" class="btn btn-primary btn-icon" onclick="$('#addCategoryModel').modal('show');">
                                        <span class="btn-icon-label"><i class="fa fa-plus mr-2"></i></span>Add New User
                                    </button>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table2" class="table nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Category Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody2">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->

            <div class="tab-pane fade" id="company">
                <div class="container">
                    <div class="col-12">
                        <div style="display:flex; align-items:center;justify-content:flex-end;column-gap:10px;">
                            <?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
                                <a type="button" class="btn btn-secondary btn-icon" href="<?= $_SERVER['HTTP_REFERER']; ?>">
                                    <span class="btn-icon-label"><i class="fa fa-arrow-left mr-2"></i></span> Go Back
                                </a>
                            <?php } ?>
                            <button style="float:right;" type="button" class="btn btn-primary btn-icon" onclick="$('#addCompanyModel').modal('show');">
                                <span class="btn-icon-label"><i class="fa fa-plus mr-2"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table3" class="table nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Company Name</th>
                                                <th>Country</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody3">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="department">
                <div class="container">
                    <div class="col-12">
                        <div style="display:flex; align-items:center;justify-content:flex-end;column-gap:10px;">
                            <?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
                                <a type="button" class="btn btn-secondary btn-icon" href="<?= $_SERVER['HTTP_REFERER']; ?>">
                                    <span class="btn-icon-label"><i class="fa fa-arrow-left mr-2"></i></span> Go Back
                                </a>
                            <?php } ?>
                            <button style="float:right;" type="button" class="btn btn-primary btn-icon" onclick="$('#addDepartmentModel').modal('show');">
                                <span class="btn-icon-label"><i class="fa fa-plus mr-2"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table4" class="table nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Department Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody4">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!------country state city tab start---------->
            <div class="tab-pane fade" id="country_state_city">

                <div class="container">
                    <form method="post" id="addcountryform">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="FieldLabel">Country: </label>
                                    <div>
                                        <input name="country" type="text" maxlength="100" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="FieldLabel"></label>
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <form method="post" id="addstateform">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="FieldLabel">Country: </label>
                                    <div>
                                        <select name="country" class="form-control" required>
                                            <option value="" selected="selected">select country</option>
                                            <?php
                                            foreach ($country->get()->getResult() as $item) {
                                            ?>
                                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="FieldLabel">state </label>
                                    <div>
                                        <input name="state" type="text" maxlength="100" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="FieldLabel"></label>
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <form method="post" id="addcityform">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="FieldLabel">Country </label>
                                    <div>
                                        <select name="country" id="country2" class="form-control" required>
                                            <option value="" selected="selected">select country</option>
                                            <?php
                                            foreach ($country->get()->getResult() as $item) {
                                            ?>
                                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="FieldLabel">State</label>
                                    <div>
                                        <select class="form-control" name="state" id="state2" required>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="FieldLabel">City</label>
                                    <div>
                                        <input name="city" type="text" maxlength="100" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="FieldLabel"></label>
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    &nbsp;
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table5" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Country Name</th>
                                            <th>State Name</th>
                                            <th>City Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody5">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!------country state city tab end---------->
            <div class="tab-pane fade" id="reminder">
                <div class="container">

                    <p>No Reminder Found</p>
                </div>
            </div>
            <!------reminder tab end---------->
            <div class="tab-pane fade" id="email_smtp">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="HeadingLabel">Email SMTP Server Setup</h2>
                        </div>
                    </div>
                    <form method="post" id="SMTPsettingform">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="FieldLabel">Email Address:</label>
                                <input type="hidden" name="smtpid" id="smtpid" value="<?= $EmailSMTP->id ?>">
                                <input name="email" value="<?= $EmailSMTP->email ?>" type="text" maxlength="100" id="MainContent_txtSMTPEmailAddress" onblur="ValidateEmail(this)" autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="FieldLabel">Password: </label>
                                <div>
                                    <input name="password" value="<?= $EmailSMTP->password ?>" maxlength="20" id="MainContent_txtSMTPEmailPassword" type="password" autocomplete="off" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="FieldLabel">Display Name:</label>
                                <input name="sent_title" value="<?= $EmailSMTP->sent_title ?>" type="text" maxlength="40" id="sent_title" class="p form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="FieldLabel">SMTP Server Name:</label>
                                <input name="host" value="<?= $EmailSMTP->host ?>" type="text" maxlength="100" id="host" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="FieldLabel">Port Number:</label>
                                <input name="port" value="<?= $EmailSMTP->port ?>" type="number" maxlength="5" id="port" onkeypress="return isNumber(event)" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="FieldLabel">Sent Email</label>
                                <input name="sent_email" value="<?= $EmailSMTP->sent_email ?>" type="text" maxlength="40" id="sent_email" class="p form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="FieldLabel">Reply Email</label>
                                <input name="reply_email" value="<?= $EmailSMTP->reply_email ?>" type="text" maxlength="100" id="reply_email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="FieldLabel">Enable SSL:</label>
                                <table id="MainContent_rbnEnableSSL">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input id="MainContent_rbnEnableSSL_0" type="radio" name="ctl00$MainContent$rbnEnableSSL" value="True" checked="checked">
                                                <label for="MainContent_rbnEnableSSL_0">True</label>
                                                &nbsp
                                            </td>
                                            <td>
                                                <input id="MainContent_rbnEnableSSL_1" type="radio" name="ctl00$MainContent$rbnEnableSSL" value="False">
                                                <label for="MainContent_rbnEnableSSL_1">False</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="FieldLabel">Default Credentials:</label>
                                <table id="MainContent_rbnDefCredential" name="rbnDefCredential">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input id="MainContent_rbnDefCredential_0" type="radio" name="ctl00$MainContent$rbnDefCredential" value="True" checked="checked">
                                                <label for="MainContent_rbnDefCredential_0">True</label>
                                                &nbsp
                                            </td>
                                            <td>
                                                <input id="MainContent_rbnDefCredential_1" type="radio" name="ctl00$MainContent$rbnDefCredential" value="False">
                                                <label for="MainContent_rbnDefCredential_1">False</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4 hidden">
                            <div class="form-group">
                                <label class="FieldLabel">Status:</label>
                                <table id="MainContent_rbnSMTPStatus">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input id="MainContent_rbnSMTPStatus_0" type="radio" name="ctl00$MainContent$rbnSMTPStatus" value="1" checked="checked">
                                                <label for="MainContent_rbnSMTPStatus_0">Active</label>
                                                &nbsp
                                            </td>
                                            <td>
                                                <input id="MainContent_rbnSMTPStatus_1" type="radio" name="ctl00$MainContent$rbnSMTPStatus" value="0">
                                                <label for="MainContent_rbnSMTPStatus_1">InActive</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <div class="controls col-md-12 ">
                            <input type="submit" value="Test Save" id="" class="btn btn-primary pull-right">
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <!--------Email Template------------->

            <div class="tab-pane fade" id="email_template">

                <div class="container">
                    <form method="post" id="addemailtemplateform">
                        <div class="col-md-12">
                            <div id="MainContent_divEmailTemplate" class="BlockDiv" onclick="window.location.href='../UpdateSubscription.aspx'" style="display:none;">
                                <a href="">
                                    <div class="BlockText">
                                        <span class="text-center fa fa-lock fa-2x"></span>
                                        <br>
                                        Please upgrade to use email template
                                    </div>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="FieldLabel">Template:</label>
                                        <select name="template" id="template" class="form-control">
                                            <option selected="selected">Create New Template</option>
                                            <?php
                                            foreach ($email_templates->get()->getResult() as $item) {
                                            ?>
                                                <option value="<?= $item->id ?>"><?= $item->template_name ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="FieldLabel">Template Name: </label>
                                        <div>
                                            <input name="template_name" type="text" maxlength="100" id="template_name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="FieldLabel">Status: </label>
                                        <div>
                                            <table id="MainContent_rbnTemplateStatus">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input id="template_status" type="radio" name="template_status" value="Active" checked>
                                                            <label for="template_status">Active</label>
                                                        </td>
                                                        <td>
                                                            &emsp;
                                                        </td>
                                                        <td>
                                                            <input id="template_status" type="radio" name="template_status" value="InActive">
                                                            <label for="template_status">InActive</label>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="FieldLabel">Subject: </label>
                                        <div>
                                            <input name="template_subject" type="text" maxlength="100" id="template_subject" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="FieldLabel">Description: </label>
                                    <div>
                                        <textarea name="template_description" type="text" maxlength="100" id="template_description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                        </div>
                </div>
                </form>

            </div>
        </div>

    </div>
    <!----------Tabs Ends--------------->

    <!-- /Page Body -->
    <!-- Page Footer -->
    <div class="hk-footer">
        <footer class="container-xxl footer">
            <div class="row">
                <div class="col-xl-8">
                    <p class="footer-text"><span class="copy-text">© <?= get_setting_value('Footer Text '); ?></span> <a href="#" class="" target="_blank">Privacy Policy</a><span class="footer-link-sep">|</span><a href="#" class="" target="_blank">T&C</a><span class="footer-link-sep">|</span><a href="#" class="" target="_blank">System Status</a></p>
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

<!-- sample modal content -->
<div id="updateproductModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Product Detail</h5>
                <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeupdproductmodal">x</span>

            </div>
            <form id="updProductForm" class="form-horizontal form-label-left input_mask">
                <div class="modal-body" id="updateproduct">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- sample modal content -->
<div id="updatepipilineModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">pipeline Detail</h5>
                <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closepipelinemodal">x</span>
            </div>
            <form id="updatepipielineform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body" id="updatepipeline">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="updcompanyModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Company Detail</h5>
                <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeupdcompanymodal">x</span>
            </div>
            <form id="updcompanyform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body" id="updatecompany">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="updatecategoryModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Category Detail</h5>
                <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeupdcategorymodal">x</span>
            </div>
            <form id="updcategoryForm" class="form-horizontal form-label-left input_mask">
                <div class="modal-body" id="updatecategory">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div id="upddepartmentModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Department Detail</h5>
                <span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeupddepartmentmodal">x</span>
            </div>
            <form id="upddepartmentform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body" id="updatedepartment">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php

echo view('admin/popup/add_pipeline');
echo view('admin/popup/add_company');
echo view('admin/popup/add_department');

echo view('admin/popup/add_product');
echo view('admin/popup/add_categories');

echo view('cpanel-layout/footer');
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#settingsForm").submit(function() {
            $('#action_loader').modal('show');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/settings/update',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    toastr.success(data);
                    setTimeout(function() {
                        $('#action_loader').modal('hide');
                        location.reload();
                    }, 1000);
                },
                error: function(jqXHR, text, error) {
                    // Displaying if there are any errors
                    $('#action_loader').modal('hide');
                    toastr.danger(error);
                }
            });
            return false;
        });
    });
</script>
<!--------- pipeline add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addpipelineform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/Settings/add_pipeline',
                data: $("#addpipelineform").serialize(),
                success: function(data) {

                    toastr.success(data);
                    $('#addPipelineModel').modal('hide');
                    $('#addpipelineform').trigger('reset');
                    location.reload();

                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>
<!---------- pipeline sorting-------->
<script type="text/javascript">
    $(document).ready(function() {
        // $("#pipelineForm").submit(function() {
        $(document).mouseup('#pipelineForm', function() {
            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>/Settings/pipeline_sorting_action',
                data: $("#pipelineForm").serialize(),
                success: function(data) {
                    // toastr.success(data);
                    console.log(data);
                },
                error: function(jqXHR, text, error) {

                    toastr.error(error);

                }
            });
            return false;
        });
    });
</script>
<!---------- pipeline delete ajax code-------->
<script>
    $(document).on('click', '.delBtn', function() {
        var val = $(this).attr('data-id');
        //
        if (confirm("Do you really want to delete this?")) {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Settings/delete_Pipeline",
                data: 'id=' + val,
                success: function(data) {
                    toastr.success(data);
                    location.reload();
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        }
    });
</script>
<!---------- close modal-------->

<!---------add more field using javascript----------->
<!-- <script>
function addInputField() {
  var container = document.getElementById("inputFieldsContainer");
  var input = document.createElement("input");
  input.type = "text";
  input.name = "inputField[]";
  input.placeholder = "Enter Reason " + (container.children.length + 1);

  container.appendChild(input);
}
</script> -->
<!---------add more field using jquery----------->
<script>
    $(document).ready(function() {

        // Attach click event handler to the button
        $('#addButton').click(function() {
            // Append a new input field to the container
            $('#container').append('<div class="input-group mb-3"><input type="hidden" name="id[]" value="new"><input type="text" class="form-control" placeholder="Enter Lost Reason" aria-label="Enter Lost Reason" name="reason[]" aria-describedby="button-addon2"><button data-id="<?php echo $item->id; ?>" class="btn btn-outline-danger deleteRow" type="button" id="button-addon2"><i class="fa fa-minus"></i></button></div>');
        });


        $(document).on('click', '.deleteRow', function() {
            $(this).parent().closest('div').remove();
        });
    });
</script>
<!--------- add or update Reasons ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#lostreasonform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/Settings/lost_reason',
                data: $("#lostreasonform").serialize(),
                success: function(data) {
                    location.reload()
                    toastr.success(data);
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<!---------- delete reason -------->
<script>
    $(document).on('click', '.delbtn', function() {
        var id = $(this).attr('data-id');
        //
        // alert(id);
        if (confirm("Do you really want to delete this?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Settings/delete_reason",
                data: 'id=' + id,
                success: function(data) {
                    toastr.success(data);
                    location.reload();
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        }
    });
</script>

<!--------- Product add ajax code-------->
<script type="text/javascript">
    $(document).ready(function() {
        $("#addproductform").submit(function() {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/Settings/add_product',
                data: $("#addproductform").serialize(),
                success: function(data) {
                    toastr.success(data);
                    $('#addproductform').trigger('reset');
                    $('#addProductModel').modal('hide');
                    category_fetchdata();
                    product_fetchdata();
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>
<!------------fetch product data using ajax----------->

<script>
    $(document).ready(function() {
        product_fetchdata();
        category_fetchdata();
        product_categories_fetchdata();
        company_fetchdata();
        department_fetchdata();
        show_country_state_city();
    });
    //
    function product_fetchdata() {
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table1').dataTable().fnDestroy();
        $('#tbody1').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/Settings/show_products',
            success: function(data) {
                $('#tbody1').html(data);
                $('#table1').DataTable();

            }
        })
    }
</script>
<!-------delete product using ajax-------->
<script>
    $(document).on('click', '.delProductBtn', function() {
        var val = $(this).attr('data-productid');
        //
        if (confirm("Do you really want to delete this?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Settings/delete_product",
                data: 'id=' + val,
                success: function(data) {
                    product_fetchdata();
                    toastr.success(data);

                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        }
    });
</script>
<!--------update product form using ajax----------->

<script>
    $(document).on('click', '.updProductBtn', function() {
        var val = $(this).attr('data-productid');
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Settings/update_Product_from",
            data: 'id=' + val,
            success: function(data) {
                $("#updateproduct").html(data);
                $('#updateproductModel').modal('show');
            },
            error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/update_products',
                data: $("#updProductForm").serialize(),
                success: function(data) {
                    toastr.success(data);
                    $('#updateproductModel').modal('hide');
                    product_fetchdata();
                },
                error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/add_category',
                data: $("#addcategoryform").serialize(),
                success: function(data) {
                    toastr.success(data);
                    $('#addcategoryform').trigger('reset');
                    $('#addCategoryModel').modal('hide');
                    category_fetchdata();
                },
                error: function(jqXHR, text, error) {
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
                url: "<?php echo base_url(); ?>/Settings/delete_reason",
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
    function category_fetchdata() {
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table2').dataTable().fnDestroy();
        $('#tbody2').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/Settings/show_categories',
            success: function(data) {
                $('#tbody2').html(data);
                $('#table2').DataTable();
            }
        })
    }
</script>
<!-------delete category using ajax-------->
<script>
    $(document).on('click', '.delcategoryBtn', function() {
        var val = $(this).attr('data-categoryid');
        //
        if (confirm("Do you really want to delete this?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Settings/delete_category",
                data: 'id=' + val,
                success: function(data) {
                    category_fetchdata();
                    toastr.success(data);

                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        }
    });
</script>
<!--------update Category form using ajax----------->
<script>
    $(document).on('click', '.updcategoryBtn', function() {
        var val = $(this).attr('data-categoryid');
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Settings/update_category_from",
            data: 'id=' + val,
            success: function(data) {
                $("#updatecategory").html(data);
                $('#updatecategoryModel').modal('show');
            },
            error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/update_category',
                data: $("#updcategoryForm").serialize(),
                success: function(data) {
                    toastr.success(data);
                    $('#updatecategoryModel').modal('hide');
                    category_fetchdata();
                },
                error: function(jqXHR, text, error) {
                    toastr.success(data);

                }
            });
            return false;
        });
    });
</script>

<!---------fetch categories using ajax------>
<script type="text/javascript">
    function product_categories_fetchdata() {

        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/Settings/fetch_categories',
            success: function(data) {
                // toastr.success(data); 
                $('#product_categories').html(data)
            }
        })
    }
</script>
<!------update pipeline form using ajax------------>
<script>
    $(document).on('click', '.updpipBtn', function() {
        var id = $(this).attr('data-pipid');
        // alert(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Settings/pipeline_update_form",
            data: 'id=' + id,
            success: function(data) {
                $("#updatepipeline").html(data);
                $('#updatepipilineModel').modal('show');
            },
            error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/update_pipeline',
                data: $("#updatepipielineform").serialize(),
                success: function(data) {
                    location.reload();
                    toastr.success(data);
                },
                error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/add_company',
                data: $("#addcompanyform").serialize(),
                success: function(data) {

                    toastr.success(data);
                    //  $('#addCompanyModel').modal('hide');
                    $('#addcompanyform').trigger('reset');
                    location.reload();
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>



<!--------update company form using ajax----------->

<script>
    $(document).on('click', '.UpdCompanyBtn', function() {
        var id = $(this).attr('data-companyid');
        // alert(id);
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Settings/update_company_from",
            data: 'id=' + id,
            success: function(data) {
                $("#updatecompany").html(data);
                $('#updcompanyModel').modal('show');
            },
            error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/update_company',
                data: $("#updcompanyform").serialize(),
                success: function(data) {
                    toastr.success(data);
                    $('#updcompanyModel').modal('hide');
                    company_fetchdata();
                },
                error: function(jqXHR, text, error) {
                    toastr.success(data);

                }
            });
            return false;
        });
    });
</script>



<script>
    function company_fetchdata() {
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table3').dataTable().fnDestroy();
        $('#tbody3').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/Settings/show_company',
            success: function(data) {
                $('#tbody3').html(data);
                $('#table3').DataTable();

            }
        })
    }
</script>

<!----delete  company using ajax--------->
<script>
    $(document).on('click', '.delCompanyBtn', function() {
        var id = $(this).attr('data-companyid');
        //
        if (confirm("Do you really want to delete this?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Settings/delete_company",
                data: 'id=' + id,
                success: function(data) {
                    company_fetchdata();
                    toastr.success(data);

                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        // $('#country').change(function(){
        $(document).on('change', '#country', function() {
            var id = $(this).val();
            console.log(id);
            //
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: "<?php echo base_url(); ?>/Organization/get_state",
                data: 'id=' + id,
                success: function(data) {
                    // console.log(data.state);
                    $('#state').html('<option value="">select</option>');
                    $('#city').html('<option value="">select</option>');
                    $.each(data.state, function(index, item) {
                        $('#state').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // $('#country').change(function(){
        $(document).on('change', '#country2', function() {
            var id = $(this).val();
            console.log(id);
            //
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: "<?php echo base_url(); ?>/Organization/get_state",
                data: 'id=' + id,
                success: function(data) {
                    // console.log(data.state);
                    $('#state2').html('<option value="">select</option>');
                    $.each(data.state, function(index, item) {
                        $('#state2').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        });
    });
</script>
<!------------this code is used t make depent dropdown of country city state ------->
<script>
    $(document).ready(function() {
        $(document).on('change', '#state', function() {
            var id = $('#state').val();
            // alert(id);
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: "<?php echo base_url(); ?>/Organization/get_cities",
                data: 'id=' + id,
                success: function(data) {
                    $('#city').html('<option value="">select</option>');
                    $.each(data.cities, function(index, item) {
                        $('#city').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                },
                error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/add_email_template',
                data: $("#addemailtemplateform").serialize(),
                success: function(data) {

                    toastr.success(data);
                    //  $('#addCompanyModel').modal('hide');
                    $('#addemailtemplateform').trigger('reset');
                    location.reload();
                },
                error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/add_department',
                data: $("#adddepartmentform").serialize(),
                success: function(data) {

                    toastr.success(data);
                    $('#addDepartmentModel').modal('hide');
                    $('#adddepartmentform').trigger('reset');
                    location.reload();
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<!--------update department form using ajax----------->

<script>
    $(document).on('click', '.UpddepartmentBtn', function() {
        var id = $(this).attr('data-departmentid');
        // alert(id);
        // alert(val);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Settings/update_department_from",
            data: 'id=' + id,
            success: function(data) {
                // toastr.success(data);
                $("#updatedepartment").html(data);
                $('#upddepartmentModel').modal('show');

            },
            error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/update_department',
                data: $("#upddepartmentform").serialize(),
                success: function(data) {
                    toastr.success(data);
                    $('#upddepartmentModel').modal('hide');
                    department_fetchdata();
                },
                error: function(jqXHR, text, error) {
                    toastr.success(data);

                }
            });
            return false;
        });
    });
</script>



<script>
    function department_fetchdata() {
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table4').dataTable().fnDestroy();
        $('#tbody4').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/Settings/show_department',
            success: function(data) {
                $('#tbody4').html(data);
                $('#table4').DataTable();

            }
        })
    }
</script>

<!----delete  department using ajax--------->
<script>
    $(document).on('click', '.deldepartmentBtn', function() {
        var id = $(this).attr('data-departmentid');
        //
        if (confirm("Do you really want to delete this?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Settings/delete_department",
                data: 'id=' + id,
                success: function(data) {
                    department_fetchdata();
                    toastr.success(data);

                },
                error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/add_country',
                data: $("#addcountryform").serialize(),
                success: function(data) {

                    toastr.success(data);
                    //  $('#addCompanyModel').modal('hide');
                    $('#addcountryform').trigger('reset');
                    location.reload();
                },
                error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/add_state',
                data: $("#addstateform").serialize(),
                success: function(data) {

                    toastr.success(data);
                    //  $('#addCompanyModel').modal('hide');
                    $('#addstateform').trigger('reset');
                    location.reload();
                },
                error: function(jqXHR, text, error) {
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
                url: '<?php echo base_url(); ?>/Settings/add_city',
                data: $("#addcityform").serialize(),
                success: function(data) {

                    toastr.success(data);
                    //  $('#addCompanyModel').modal('hide');
                    $('#addcityform').trigger('reset');
                    location.reload();
                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
            return false;
        });
    });
</script>

<!--------this function is used to get template details-------->
<script>
    $(document).ready(function() {
        $(document).on('change', '#template', function() {
            var id = $('#template').val();
            // alert(id);
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: "<?php echo base_url(); ?>/Settings/get_template_detail",
                data: 'id=' + id,
                success: function(data) {
                    $('#template_name').val('');
                    $('#template_subject').val('');
                    $('#template_description').val('');
                    //
                    $('#template_name').val(data.template_name);
                    $('#template_subject').val(data.subject);
                    // $("#template_status").attr('checked', 'checked');
                    $('#template_status[value="' + data.status + '"]').prop('checked', true);

                    $('#template_description').val(data.description);

                },
                error: function(jqXHR, text, error) {
                    toastr.error(error);
                }
            });
        });
    });
</script>

<!-----country state city data---------------->
<script>
    function show_country_state_city() {
        var loader = `<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status" id="loading"></div></td></tr>`;
        $('#table5').dataTable().fnDestroy();
        $('#tbody5').html(loader);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/Settings/show_country_state_city',
            success: function(data) {
                $('#tbody5').html(data);
                $('#table5').DataTable();

            }
        })
    }
</script>

<script>
    $(document).ready(function() {


        $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTabSetting', $(e.target).attr('href'));
        });
        var activeTabsetting = localStorage.getItem('activeTabSetting');
        if (activeTabsetting) {
            $('.nav-tabs a[href="' + activeTabsetting + '"]').tab('show');

        } else {
            $('.nav-tabs a[href="#application"]').tab('show');
        }
    });
</script>

<!-----update SMTP SERVE Setting Ajax----->
<script type="text/javascript">
    $(document).ready(function() {
        $("#SMTPsettingform").submit(function() {
            $('#action_loader').modal('show');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/settings/update_smtp_setting',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    toastr.success(data);
                    setTimeout(function() {
                        $('#action_loader').modal('hide');
                        location.reload();
                    }, 1000);
                },
                error: function(jqXHR, text, error) {
                    // Displaying if there are any errors
                    $('#action_loader').modal('hide');
                    toastr.danger(error);
                }
            });
            return false;
        });
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