<?php ?>
<label>Enter Packing Type <span class="cRed">*</span></label>
<!-- added class inboxwidth by shankhpal shende on 08/09/2022 -->
	<div class="col-md-7 inboxwidth">
		<?php echo $this->Form->control('packing_type', array('type'=>'text', 'id'=>'packing_type','label'=>false, 'placeholder'=>'Enter Packing Type Here','class'=>'form-control','required'=>true)); ?>
		<span id="error_packing_type" class="error invalid-feedback"></span>
	</div>


	<div class="col-md-1">
		<?php echo $this->element('masters_management_elements/add_submit_common_btn'); ?>
	</div>

	<div class="clearfix"></div>
