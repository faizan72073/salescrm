<!-- sample modal content -->
<div id="addPipelineModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add New Pipeline</h5>
				<span style="font-size:22px; cursor:pointer; color:black;" class="" id="closeaddpipelinemodal">x</span>

            </div>
            <form id="addpipelineform" class="form-horizontal form-label-left input_mask">
                <div class="modal-body">

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Name</label>
									<input type="text" class="form-control" name="name" id="exampleFormControlInput1">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<label for="exampleFormControlInput1">Description</label>
									<textarea type="text" class="form-control" name="description" id="exampleFormControlInput1"></textarea>
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
