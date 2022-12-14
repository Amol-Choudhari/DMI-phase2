<label class="col-md-3">Laboratory Type <span class="cRed">*</span></label>
<div class="col-md-7">
	<?php echo $this->Form->control('laboratory_type', array('type'=>'text', 'id'=>'laboratory_type','label'=>false, 'value'=>$record_details['laboratory_type'],'class'=>'form-control')); ?>	
	<span id="error_laboratory_type" class="error invalid-feedback"></span>
</div>