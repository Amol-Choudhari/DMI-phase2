<input type="hidden" id="add_master_btn_master_id" value="<?php echo $masterId; ?>">
<?php // This Below Condition Block is added to the common the buttons from the Edit Masters -> Akash [13-12-2022]
    if ($masterId == '11') { #For Edit Template Button
        echo $this->Form->control('Edit Template', array('name'=>'edit_sms_template','type'=>'submit', 'id'=>'edit_sms_template_btn','class'=>'btn btn-success', 'label'=>false));
    } elseif ($masterId == '12') { #For Edit PAO Button
        echo $this->Form->submit('Edit PAO/DDO', array('name'=>'edit_pao', 'id'=>'add_pao_btn', 'label'=>false, 'class'=>'btn btn-success')); 
    } else { #For All Other Submit buttons
        echo $this->Form->submit('Edit', array('name'=>'add_master', 'id'=>'add_master_btn','label'=>false,'class'=>'btn btn-success'));
    }

    echo $this->Html->script('element/masters_management_elements/button_elements/edit_submit_common_btn'); 
?>
