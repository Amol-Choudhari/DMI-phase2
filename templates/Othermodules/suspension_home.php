<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6"><label class="badge badge-info">Suspension/Cancellation</label></div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><?php echo $this->Html->link('Dashboard', array('controller' => 'dashboard', 'action'=>'home'));?></a></li>
						<li class="breadcrumb-item active">Suspension Module</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content form-middle ">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create(); ?>
						<div class="card card-gray">
							<div class="card-header"><h3 class="card-title-new">Suspension/Cancellation Module</h3></div>
							<div class="form-horizontal">
								<div class="card-body">
									<div class="row">
										<p class="alert alert-info col-md-12">
											Note: This module is to:<br>
											1. To process the suspension/cancellation through AQCMS system online with option to select time period for suspension.<br>
											2. To lock registered packer/printer/laboratory account on for time period of suspension.<br>
											3. To take suspension/cancellation action for any misgrading/irregularities is to be continued by any firm.
										</p>
										<div class="col-md-12">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="field3">Application Id <span class="cRed">*</span></label>
													<?php echo $this->Form->control('appl_id', array('type'=>'select', 'id'=>'appl_id', 'escape'=>false, 'options'=>$underThisOffice, 'empty'=>'---Select---', 'label'=>false,'class'=>'form-control')); ?>
													<div id="error_appl_id"></div>
													<div id="view_certificate_link"></div>
													<div id="view_valid_upto"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer cardFooterBackground">
								<label><?php echo $this->form->submit('Proceed', array('id'=>'proceed_btn', 'label'=>false,'class'=>'btn btn-success')); ?></label>
							</div>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</section>
</div>