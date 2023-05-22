<?php 
	if (!empty($status)){
		if ($status == 'saved') {
			echo $this->Form->submit('Update', array('name'=>'update_action','id'=>'update_action','label'=>false,'class'=>'float-left btn btn-success'));
			echo $this->Form->control('Send Notice',array('type'=>'button','name'=>'send_notice','class'=>'btn btn-primary ml-2 float-left', 'data-toggle'=>'modal','data-target'=>'#confirm_action','label'=>false));
		} 
	} else {
		echo $this->Form->submit('Save', array('name'=>'save_action','id'=>'save_action','label'=>false,'class'=>'float-left btn btn-success'));
	}

	if ($_SESSION['whichUser'] == 'applicant') {

		echo $this->Form->control('Save Comment', array('name'=>'scn_ro_referred_back','type'=>'submit','id'=>'scn_ro_referred_back', 'class'=>'btn btn-success mr-5px btn_w_auto btn_save_remark float-left ml-2','label'=>false));
	
		if (!empty($atleastOneComment)) { 
			echo $this->Form->control('Final Submit Referred Back', array('name'=>'sent_to_applicant', 'type'=>'submit', 'id'=>'final_submit_referred_back', 'class'=>'btn btn-success mr-5px btn_final_submit float-left','label'=>false)); 
		} 

	}elseif($_SESSION['whichUser'] == 'dmiuser'){

	}

	echo $this->Html->link('Cancel', array('controller' => 'othermodules', 'action'=>'misgrading_home'),array('class'=>'add_btn btn btn-danger float-right')); 

?> 