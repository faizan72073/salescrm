<!-- sample modal content -->
<div id="addOrganizationModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add New Organization</h5>
				<span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeaddmodal">x</span>

            </div>
            <form id="addOrganizationform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body">

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Organization</label>
									<input type="text" class="form-control" name="organization" id="exampleFormControlInput1" >
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Address 1</label>
									<input type="text" class="form-control" name="address_1" id="exampleFormControlInput1" >
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">

						<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Address 2</label>
									<input type="text" class="form-control" name="address_2" id="exampleFormControlInput1" >
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


					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Zip Code</label>
									<input type="number" class="form-control" name="zipcode" id="exampleFormControlInput1">
								</div>
							</div>

							<div class="col-md-6 col-xs-12">
								<div class="form-group">
								<label for="exampleFormControlInput1">Industry</label>
								<select class="form-control" name="industry" id="exampleFormControlInput1" >
									<option value="textile">textile</option>
									<option value="wool">wool</option>
									<option value="bussiness">bussiness</option>
									<option value="infra">infra</option>
								</select>
			
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
