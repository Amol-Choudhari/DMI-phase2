<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6"><label class="badge badge-info">Actions on Misgrading Module</label></div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><?php echo $this->Html->link('Dashboard', array('controller' => 'dashboard', 'action'=>'home'));?></a></li>
						<li class="breadcrumb-item active">List of Firms</li>
					</ol>
				</div>
			</div>
	  </div>
	</div>
  <section class="content form-middle ">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php echo $this->Form->create(null, array('id' => 'misgrading_action_home')); ?>
            <div class="card card-danger">
              <div class="card-header"><h3 class="card-title">Misgrading Actions</h3></div>
              <div class="card-body">
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label class="col-form-label">Applicant ID <span class="cRed">*</span></label>
                      <?php echo $this->Form->control('customer_id', array('type'=>'text','id'=>'customer_id','value'=>$customer_id, 'class'=>'form-control', 'label'=>false,'readonly'=>true)); ?>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label class="col-form-label">Misgrading Category <span class="cRed">*</span></label>
                      <?php echo $this->Form->control('misgrade_category', array('type'=>'select','empty'=>'-- Select Misgrading Category --','id'=>'misgrade_category', 'options'=>$misgradingCategories, 'label'=>false, 'class'=>'form-control')); ?>
                      <span id="error_misgrade_category" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label class="col-form-label">Misgrading Level <span class="cRed">*</span></label>
                      <?php echo $this->Form->control('misgrade_level', array('type'=>'select','empty'=>'-- Select Misgrading Level --','id'=>'misgrade_level', 'options'=>$misgradingLevels, 'label'=>false, 'class'=>'form-control')); ?>
                      <span id="error_misgrade_level" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label class="col-form-label">Action To Be Taken <span class="cRed">*</span></label>
                      <?php echo $this->Form->control('misgrade_action', array('type'=>'select','empty'=>'-- Select Misgrading Action --','id'=>'misgrade_action', 'options'=>$misgradingActions, 'label'=>false, 'class'=>'form-control')); ?>
                      <span id="error_misgrade_action" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="col-form-label">Reason <span class="cRed">*</span></label>
                      <?php echo $this->Form->control('reason', array('type'=>'textarea','id'=>'reason', 'label'=>false, 'class'=>'form-control')); ?>
                      <span id="error_reason" class="error invalid-feedback"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <?php echo $this->Form->submit('Submit', array('name'=>'take_action','id'=>'take_action','label'=>false,'class'=>'float-left btn btn-success')); ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Launch demo modal</button>
              </div>
            </div>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </section>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-3 d-inline">Application PDF: </div>
        <div class="col-md-4 d-inline"><a target="blank" href="../applicationformspdfs/showcauseApplPdf" >Preview</a></div><br>
        <div class="clearfix"></div>
        <?php echo $this->Form->control('declaration_check_box_wo_esign', array('type'=>'checkbox', 'id'=>'declaration_check_box_wo_esign', 'class'=>'modal-checkbox','label'=>$message_wo_esign, 'escape'=>false)); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="okBtn_wo_esign" class="modal-button btn btn-success mt-2 float-right mr-2" name="final_submit"><i class="fa fa-check-circle"></i> Submit</button>
      </div>
    </div>
  </div>
</div>

<?php echo $this->Html->script('othermodules/misgrading_actions_home') ?>