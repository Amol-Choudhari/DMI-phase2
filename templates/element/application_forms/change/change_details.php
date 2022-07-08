<?php echo $this->Form->create(null, array('type'=>'file', 'enctype'=>'multipart/form-data', 'id'=>$section)); ?>

<section class="content form-middle form_outer_class" id="form_outer_main">
	<div class="container-fluid">
	  	<h5 class="mt-1 mb-2">Change Details</h5>
	    
			<div class="card col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="card card-success">
							<div class="card-header"><h3 class="card-title">New Details</h3></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card card-success">
							<div class="card-header"><h3 class="card-title">Last Details</h3></div>
						</div>
					</div>
				

					<?php if (in_array(1,$selectedValues)) { // for firm name ?>

						<div class="col-md-12"><p><b>Firm Details</b></p></div>
						<div class="clearfix"></div>
						<!-- fields for new change value-->
						<div class="col-md-6">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Firm Name <span class="cRed">*</span></label>
								<div class="col-sm-9">
									<?php echo $this->Form->control('firm_name', array('type'=>'text', 'id'=>'firm_name', 'escape'=>false, 'value'=>$change_details['firm_name'], 'class'=>'form-control input-field', 'label'=>false)); ?>
								</div>
							</div>
						</div>
						<!-- fields to show last value-->
						<div class="col-md-6">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Firm Name <span class="cRed">*</span></label>
								<div class="col-sm-9">
									<?php echo $this->Form->control('firm_name_last', array('type'=>'text', 'id'=>'firm_name_last', 'escape'=>false, 'value'=>$last_details['firm_name'], 'class'=>'form-control input-field', 'label'=>false, 'disabled'=>true)); ?>
								</div>
							</div>
						</div>
					<?php } ?>

					<?php if (in_array(2,$selectedValues)) { // for firm contact details ?>
						<!-- fields for new change value-->
						<div class="col-md-6">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Mobile No. <span class="cRed">*</span></label>
								<div class="col-sm-9">
									<?php echo $this->Form->control('mobile_no', array('type'=>'text', 'id'=>'mobile_no', 'escape'=>false, 'value'=>$change_details['mobile_no'], 'class'=>'form-control input-field', 'label'=>false)); ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Email Id <span class="cRed">*</span></label>
								<div class="col-sm-9">
									<?php echo $this->Form->control('email_id', array('type'=>'text', 'id'=>'email_id', 'escape'=>false, 'value'=>$change_details['email_id'], 'class'=>'form-control input-field', 'label'=>false)); ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Phone No. <span class="cRed">*</span></label>
								<div class="col-sm-9">
									<?php echo $this->Form->control('phone_no', array('type'=>'text', 'id'=>'phone_no', 'escape'=>false, 'value'=>$change_details['phone_no'], 'class'=>'form-control input-field', 'label'=>false)); ?>
								</div>
							</div>
						</div>
						<!-- fields to show last value-->
						<div class="col-md-6">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Mobile No. <span class="cRed">*</span></label>
								<div class="col-sm-9">
									<?php echo $this->Form->control('mobile_no_last', array('type'=>'text', 'id'=>'mobile_no_last', 'escape'=>false, 'value'=>$last_details['mobile_no'], 'class'=>'form-control input-field', 'label'=>false)); ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Email Id <span class="cRed">*</span></label>
								<div class="col-sm-9">
									<?php echo $this->Form->control('email_id_last', array('type'=>'text', 'id'=>'email_id_last', 'escape'=>false, 'value'=>$last_details['email_id'], 'class'=>'form-control input-field', 'label'=>false)); ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Phone No. <span class="cRed">*</span></label>
								<div class="col-sm-9">
									<?php echo $this->Form->control('phone_no_last', array('type'=>'text', 'id'=>'phone_no_last', 'escape'=>false, 'value'=>$last_details['phone_no'], 'class'=>'form-control input-field', 'label'=>false)); ?>
								</div>
							</div>
						</div>

					<?php } ?>	

					<?php if (in_array(5,$selectedValues)) { // for Premises/Location ?>
						<!-- fields for new change value-->
						<div class="col-md-12"><p><b>Premises/Location</b></p></div>
						<div class="clearfix"></div>
						<div class="col-md-6">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Address <span class="cRed">*</span></label>
									<div class="custom-file col-sm-9">
										<?php echo $this->Form->control('premise_street', array('type'=>'textarea', 'id'=>'premise_street', 'escape'=>false, 'value'=>$change_details['premise_street'], 'class'=>'form-control input-field', 'label'=>false, 'placeholder'=>'Please enter street address')); ?>
									<span id="error_street_address" class="error invalid-feedback"></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">State/Region <span class="cRed">*</span></label>
									<div class="custom-file col-sm-9">
										<?php echo $this->Form->control('premise_state', array('type'=>'select', 'id'=>'premise_state', 'options'=>$state_list,  'value'=>$change_details['premise_state'],  'empty'=>'Select', 'label'=>false,'class'=>'form-control')); ?>
									<span id="error_state" class="error invalid-feedback"></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">District <span class="cRed">*</span></label>
									<div class="custom-file col-sm-9">
										<?php echo $this->Form->control('premise_city', array('type'=>'select', 'id'=>'premise_city', 'options'=>$section_form_details[2], 'value'=>$change_details['premise_city'], 'label'=>false, 'class'=>'form-control')); ?>
									<span id="error_district" class="error invalid-feedback"></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Pin Code <span class="cRed">*</span></label>
									<div class="custom-file col-sm-9">
										<?php echo $this->Form->control('premise_pin', array('type'=>'text', 'id'=>'premise_pin', 'escape'=>false, 'value'=>$change_details['premise_pin'], 'class'=>'form-control input-field', 'label'=>false, 'placeholder'=>'Please enter postal/zip code')); ?>
									<span id="error_postal_code" class="error invalid-feedback"></span>
								</div>
							</div>
						</div>
						<!-- fields to show last value-->
						<div class="col-md-6">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Address <span class="cRed">*</span></label>
									<div class="custom-file col-sm-9">
										<?php echo $this->Form->control('street_address', array('type'=>'textarea', 'id'=>'street_address', 'escape'=>false, 'value'=>$change_details['premise_street'], 'class'=>'form-control input-field', 'label'=>false, 'placeholder'=>'Please enter street address')); ?>
									<span id="error_street_address" class="error invalid-feedback"></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">State/Region <span class="cRed">*</span></label>
									<div class="custom-file col-sm-9">
										<?php echo $this->Form->control('state', array('type'=>'select', 'id'=>'state', 'options'=>$state_list,  'value'=>$change_details['premise_state'],  'empty'=>'Select', 'label'=>false,'class'=>'form-control')); ?>
									<span id="error_state" class="error invalid-feedback"></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">District <span class="cRed">*</span></label>
									<div class="custom-file col-sm-9">
										<?php echo $this->Form->control('district', array('type'=>'select', 'id'=>'district', 'options'=>$section_form_details[2], 'value'=>$change_details['premise_city'], 'label'=>false, 'class'=>'form-control')); ?>
									<span id="error_district" class="error invalid-feedback"></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Pin Code <span class="cRed">*</span></label>
									<div class="custom-file col-sm-9">
										<?php echo $this->Form->control('postal_code', array('type'=>'text', 'id'=>'postal_code', 'escape'=>false, 'value'=>$change_details['premise_pin'], 'class'=>'form-control input-field', 'label'=>false, 'placeholder'=>'Please enter postal/zip code')); ?>
									<span id="error_postal_code" class="error invalid-feedback"></span>
								</div>
							</div>
						</div>

					<?php } ?>

					<?php if (in_array(3,$selectedValues)) { // for TBL details ?>
						<!-- fields for new change value-->
						<div class="col-md-12"><p><b>TBL Details</b></p></div>
						<div class="clearfix"></div>
						<?php echo $this->element('application_forms/change/tbl_details_table'); ?>

					<?php } ?>

					<?php if (in_array(4,$selectedValues)) { // for Directors details ?>
						<!-- fields for new change value-->
						<div class="col-md-12"><p><b>Director/Partner Details</b></p></div>
						<div class="clearfix"></div>
						<?php echo $this->element('application_forms/change/directors_details_table_view'); ?>

					<?php } ?>
				</div>
			</div>

					
				</div>
			</div>
		</div>
	</div>
</section>


	<div id="form_outer_main" class="form-style-3" class="form_outer_class">


	<!-- commented on 16-07-2021 by Amol as per new order updates -->
	<!--	<div class="form-buttons">
			<a href="<?php //echo $this->getRequest()->getAttribute('webroot');?><?php //echo $this->request->getParam('controller');?>/section/2" >Next Section</a>
		</div>-->
	</div>

<?php 
//used common validation file for firm details in renewal for ca/pp/lab
//echo $this->Html->script('element/application_forms/renewal/laboratory/lab_firm_details'); ?>
