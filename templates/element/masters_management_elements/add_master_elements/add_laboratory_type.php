<label class="col-md-3">Enter Laboratory Type <span class="cRed">*</span></label>
<div class="col-md-7">
	<?php echo $this->Form->control('laboratory_type', array('type'=>'text', 'id'=>'laboratory_type','label'=>false, 'placeholder'=>'Enter Laboratory Type Here','class'=>'form-control','required'=>true)); ?>
	<span id="error_laboratory_type" class="error invalid-feedback"></span>
</div>