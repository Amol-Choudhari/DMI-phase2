<?php echo $this->Html->css('attachpplab/attach_pp_lab'); ?>
<?php echo $this->Form->create(null, array('type'=>'file', 'enctype'=>'multipart/form-data', 'id'=>'firm_form')); ?>
	<section class="content form-middle form_outer_class" id="form_outer_main">
		<a href="../customers/secondary_home" class="btn btn-primary">Back</a>
		<div class="container-fluid form-group wd1080">
	  		<h5 class="mt-1 mb-2">Application For Attach PP/LAB</h5>
			<div class="row">
				<div class="col-md-12">
					<div id="firm_details_block" class="card card-success">
						<div class="card-header"><h3 class="card-title">PP/LAB Details</h3></div>
							<div class="form-horizontal">
								<div class="card-body">
									<div class="row">
										<div class="col-md-4"></div>

										<div class="col-md-4">
                                           <label><input type="radio" name="colorRadio" value="pp">Attached Printer</label>
                                           <label><input type="radio" name="colorRadio" value="lab">Attached Laboratory </label>
                                           <div class="pp box">You have selected :
                                              <?php echo $this->Form->control('grading_lab', array('type'=>'select', 'id'=>'grading_lab','options'=>$printers_list, 'value'=>$selected_lab,'empty'=>'--Select Authorised Printers--', 'class'=>'form-control', 'label'=>'Authorised Printers', 'required'=>true)); ?>
                                           </div>
                                           <div class="lab box">You have selected :
                                              <?php echo $this->Form->control('grading_lab', array('type'=>'select', 'id'=>'grading_lab','options'=>$lab_list, 'value'=>$selected_lab,'empty'=>'--Select Authorised Laboratory--', 'class'=>'form-control', 'label'=>'Authorised Laboratory', 'required'=>true)); ?>
                                           </div>
                                        </div>

										<div class="col-md-4"></div>
									</div>
								</div>
							</div>
					  </div>
				</div>
			</div>
		</div>

		<?php //echo $this->element('replica/printer_details'); ?>

		<div class="col-md-2">
			<?php //if(empty($dataArray[0]['customer_id'])){ $btn_name = 'Save & Apply'; }else{ $btn_name = 'Update'; } ?>
			<?php //echo $this->Form->control($btn_name, array('type'=>'submit', 'id'=>'save', 'name'=>'save', 'class'=>'btn btn-success', 'label'=>false,)); ?>
		</div>

		<div class="clear"></div>
	</section>
	<input type="hidden" id="tableFormData" value='<?php// echo $tableForm; ?>'>
	<?php echo $this->Form->end(); ?>


<?php echo $this->Html->script('attachpplab/attach_pp_lab'); ?>
