<!-- sample modal content -->
<div id="popupModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add New User</h5>
				<span style="font-size:22px; cursor:pointer; color:black;" class="" id="closemodal">x</span>

            </div>
            <form id="adduserform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body">

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Firstname</label>
									<input type="text" class="form-control" name="f_name" id="exampleFormControlInput1" required="">
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Lastname</label>
									<input type="text" class="form-control" name="l_name" id="exampleFormControlInput1" required="">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Email</label>
									<input type="email" class="form-control" name="email" id="exampleFormControlInput1" required="">
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">CNIC</label>
									<input type="text" class="form-control" name="nic" id="exampleFormControlInput1" required="">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Username</label>
									<input type="text" class="form-control" name="username" id="exampleFormControlInput1" required="">
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Password</label>
									<input type="password" class="form-control" name="password" id="exampleFormControlInput1" required="">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Mobile#</label>
									<input type="tel" class="form-control" name="mobile" id="exampleFormControlInput1" required="">
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Address</label>
									<input type="text" class="form-control" name="address" id="exampleFormControlInput1" required="">
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Designation</label>
									<input type="text" class="form-control" name="designation" id="exampleFormControlInput1">
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Department</label>
									<select class="form-control" name="department" id="exampleFormControlInput1" >
										<?php
										foreach($department->get()->getResult() as $item){
										?>
										<option id="department" value="<?= $item->id; ?>"><?= strtolower($item->department); ?></option>

										<?php
										}
										?>
									
								    </select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Select Company</label>
									<select class="form-control" required="" name="company">
										<?php
										foreach($companies->get()->getResult() as $value){

										?>
										<option value="<?= $value->id ?>"><?= $value->company_name ?></option>

										<?php
										}
										?>
	
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Status</label>
									<select class="form-control" required="" name="status">
										<option value="">select status</option>
										<option value="admin">Admin</option>
										<option value="user">User</option>
										<option value="Hod">Hod</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">IP Phone Extension</label>
									<input type="tel" class="form-control" name="extension" id="exampleFormControlInput1">
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
