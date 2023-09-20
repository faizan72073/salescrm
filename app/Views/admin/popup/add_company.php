<!--sample modal content -->
<div id="addCompanyModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add New company</h5>
				<span style="font-size:22px; cursor:pointer; color:black;" class="" id="closemodal">x</span>

            </div>
            <form id="addcompanyform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body">

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Company Name</label>
									<input type="text" class="form-control" name="company_name" id="exampleFormControlInput1" required="">
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Country</label>
									<select class="form-control" name="country" id="country" >
										<?php
											foreach($country->get()->getResult() as $value){
											?>
											<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
									
										<?php
										}
									   ?>	
									</select>
								</div>
							</div>
							<div class="col-md-4 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">State</label>
									<select class="form-control" name="state" id="state" >
					
									</select>
								
								</div>
							</div>

							<div class="col-md-4 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">City</label>
									<select class="form-control" name="city" id="city" >
					
									</select>
									
								</div>
							</div>
					
						</div>
					</div>

					<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Description</label>
									<textarea type="number" class="form-control" name="description" id="exampleFormControlInput1" required=""></textarea>
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
