<?php ?>
<div class ="col-md-12">
<!--Added below variable to set the message for dupicate state name on 04-12-2021 by AKASH-->
<?php if (!empty($duplicate_state_name)) {
	echo "<div class='alert alert-danger'>".$duplicate_state_name."</div>";
}?>
</div>
<label class="col-md-3">Enter State Name<span class="cRed">*</span></label>
<!-- added class inboxwidth by shankhpal shende on 08/09/2022 for max width -->
	<div class="col-md-7 inboxwidth">
		<?php echo $this->Form->control('state_name', array('type'=>'text', 'id'=>'state_name','label'=>false, 'placeholder'=>'Enter State Name Here','class'=>'form-control txtOnly','required'=>'true')); ?>
	<span id="error_state_name" class="error invalid-fld"></span>
</div>
<div class="col-md-1 float-right">
	<?php echo $this->element('masters_management_elements/add_submit_common_btn'); ?>
</div>
<!-- added by shankhpal shende  -->
<?php echo $this->Html->script('input_validation'); ?> <!-- added by shankhpal shende on 08/09/2022  -->
<?php echo $this->Html->script('element/masters_management_elements/add_state'); ?>