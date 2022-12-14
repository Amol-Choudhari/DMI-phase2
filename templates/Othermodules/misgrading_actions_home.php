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
                                            <?php echo $this->Form->control('customer_id', array('type'=>'text','id'=>'customer_id','value'=>$_SESSION['firm_id'], 'class'=>'form-control', 'label'=>false,'readonly'=>true)); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="col-form-label">Misgrading Category <span class="cRed">*</span></label>
                                            <?php echo $this->Form->control('misgradingCategories', array('type'=>'select','empty'=>'-- Select Misgrading Category --','id'=>'misgradingCategories', 'options'=>$misgradingCategories, 'label'=>false, 'class'=>'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="col-form-label">Misgrading Level <span class="cRed">*</span></label>
                                            <?php echo $this->Form->control('misgradingLevels', array('type'=>'select','empty'=>'-- Select Misgrading Level --','id'=>'misgradingLevels', 'options'=>$misgradingLevels, 'label'=>false, 'class'=>'form-control')); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="col-form-label">Action To Be Taken <span class="cRed">*</span></label>
                                            <?php echo $this->Form->control('misgradingActions', array('type'=>'select','empty'=>'-- Select Misgrading Action --','id'=>'misgradingActions', 'options'=>$misgradingActions, 'label'=>false, 'class'=>'form-control')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </section>
</div>