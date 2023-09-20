<!-- sample modal content -->
<div id="addProductModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add New Product</h5>
				<span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeaddproductmodal">x</span>
            </div>
            <form id="addproductform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body">

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Product Name</label>
									<input type="text" class="form-control" name="product_name" id="exampleFormControlInput1" required="">
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Product Code</label>
									<input type="number" class="form-control" name="product_code" id="exampleFormControlInput1" required="">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
								<label for="exampleFormControlInput1">Product Category</label>
								
								<div id="product_categories"> 
                                 <!---categories  data render here -->
								</div>
		
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Unit</label>
									<input type="number" class="form-control" name="unit" id="exampleFormControlInput1" required="">
								</div>
							</div>
							<div class="col-md-3 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Unit Price</label>
									<input type="number" class="form-control" name="unit_price" id="exampleFormControlInput1" required="">
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Discount</label>
									<input type="number" min="1" class="form-control" name="discount" id="exampleFormControlInput1" required="">
								</div>
							</div>
						

						<div class="col-md-3 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Texation</label>
									<input type="number" class="form-control" name="total_tax" id="exampleFormControlInput1" required="">
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
