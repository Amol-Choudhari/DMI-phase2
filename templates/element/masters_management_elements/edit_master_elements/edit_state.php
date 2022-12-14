<label class="col-md-3">Enter State Name <span class="cRed">*</span></label>
<div class="col-md-7">
	<?php echo $this->Form->control('state_name', array('type'=>'text', 'id'=>'state_name','label'=>false, 'value'=>$record_details['state_name'],'class'=>'form-control')); ?>	
	<span id="error_state_name" class="error invalid-feedback"></span>
</div>