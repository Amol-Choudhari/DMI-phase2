<?php ?>

    <label class="col-md-3">Enter Division Grade <span class="cRed">*</span></label>
    <!-- inboxwidth class added by shankhpal shende on 08/09/2022 -->
    <div class="col-md-7 inboxwidth ">
        <?php echo $this->Form->control('division_type', array('type'=>'text', 'id'=>'division_type', 'label'=>false, 'placeholder'=>'Enter Division Type Here' ,'class'=>'form-control', 'required'=>true)); ?>
        <span id="error_division_type" class="error invalid-fld"></span>
    </div>

    <div class="col-md-1 float-right">
        <?php echo $this->element('masters_management_elements/add_submit_common_btn'); ?>
    </div>
