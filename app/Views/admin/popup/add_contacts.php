<!-- sample modal content -->
<div id="addContactModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add New Contact</h5>
				<span style="font-size:22px; cursor:pointer; color:black;" class="" id="closecontactaddmodal">x</span>

            </div>
            <form id="addContactform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body">

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Firstname</label>
									<input type="text" class="form-control" name="firstname" id="exampleFormControlInput1" >
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Lastname</label>
									<input type="text" class="form-control" name="lastname" id="exampleFormControlInput1" >
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">

						<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Title</label>
									<input type="text" class="form-control" name="title" id="exampleFormControlInput1" >
								</div>
							</div>

							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Email Address</label>
									<input type="email" class="form-control" name="email" id="exampleFormControlInput1" >
								</div>
							</div>
						
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Phone</label>
									<input type="tel" class="form-control" name="phone" id="exampleFormControlInput1" >
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
								<label for="exampleFormControlInput1">Phone Type</label>
								<select class="form-control" name="phonetype" id="exampleFormControlInput1" >
									<option value="Home">Home</option>
									<option value="Mobile">Mobile</option>
									<option value="Work">Work</option>
									<option value="other">other</option>
								</select>
			
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Remarks</label>
									<textarea type="text" class="form-control" name="remarks" id="exampleFormControlInput1" ></textarea>
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
