<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6"><label class="badge badge-info">Show Cause Notice</label></div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><?php echo $this->Html->link('Dashboard', array('controller' => 'dashboard', 'action'=>'home'));?></a></li>
						<li class="breadcrumb-item active">Details</li>
					</ol>
				</div>
			</div>
	  	</div>
	</div>
	<section class="content form-middle">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create(null, array('id' => 'showcause_home')); ?>
						<div class="card card-primary">
							<div class="card-header"><h3 class="card-title">Show Cause Notice</h3></div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="card">
											<div class="card-header"><h3 class="card-title">Firm Details</h3></div>
											<div class="card-body">
												<dl class="row">
													<dt class="col-sm-4">Firm ID: </dt>
													<dd class="col-sm-8"><?php echo $customer_id; ?></dd>
													<dt class="col-sm-4">Firm Name: </dt>
													<dd class="col-sm-8"><?php echo $firmDetails['firm_name']; ?></dd>
													<dt class="col-sm-4">Category: </dt>
													<dd class="col-sm-8"><?php echo $category; ?></dd>
													<dt class="col-sm-4">Commodity</dt>
													<dd class="col-sm-8"><?php echo implode(',', $sub_commodity_value); ?></dd>
												</dl>
											</div>
										</div>
									</div>

							
									<div class="col-6">
										<div class="form-group">
											<label class="col-form-label">Reason <span class="cRed">*</span></label>
											<?php echo $this->Form->control('reason', array('type'=>'textarea','id'=>'reason', 'value'=>$reason,'label'=>false, 'class'=>'form-control')); ?>
											<span id="error_reason" class="error invalid-feedback"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<?php 
									if (!empty($status)){
										if ($status == 'saved') {
											echo $this->Form->submit('Update', array('name'=>'save_action','id'=>'save_action','label'=>false,'class'=>'float-left btn btn-success'));
											echo $this->Form->control('Send Notice',array('type'=>'button','name'=>'send_notice','class'=>'btn btn-primary ml-2', 'data-toggle'=>'modal','data-target'=>'#confirm_action','label'=>false));
										} 
									} else {
										echo $this->Form->submit('Save', array('name'=>'save_action','id'=>'save_action','label'=>false,'class'=>'float-left btn btn-success'));
									}
								?>
							</div>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="confirm_action" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="col-md-3 d-inline">Show Cause Notice PDF: </div>
				<div class="col-md-4 d-inline"><a target="blank" href="../applicationformspdfs/showcauseApplPdf" >Preview</a></div><br>
				<table class="mt-2">
					<tbody>
						<tr>
							<td>Applicant ID : </td>
							<td><?php echo $customer_id; ?></td>
						</tr>
						
					</tbody>
				</table>
				<div class="clearfix"></div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" name="final_submit"><i class="fa fa-check-circle"></i> Submit</button>
				<button class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="status_id" value="<?php echo $status; ?>">
<?php echo $this->Html->script('othermodules/misgrading_actions_home') ?>