<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6"><label class="badge badge-info">Show Cause Notice</label></div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<?php 
								if ($_SESSION['whichUser'] == 'applicant') {
									echo $this->Html->link('Dashboard', array('controller' => 'customers', 'action'=>'secondary_home'));
								} else {
									echo $this->Html->link('Dashboard', array('controller' => 'dashboard', 'action'=>'home'));
								}
							?>
						</li>
						<li class="breadcrumb-item active">Details</li>
					</ol>
				</div>
			</div>
	  	</div>
	</div>
	<section class="content form-middle">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->create(null, array('id' => 'showcause_home')); ?>
						<div class="card card-primary">
							<div class="card-header"><h3 class="card-title-new">Show Cause Notice</h3></div>
							<?php 
								echo $this->element('misgrade_elements/scn_user_form'); 
								if ($_SESSION['whichUser'] == 'applicant') {echo $this->element('misgrade_elements/showcause_communication'); } 
							?>
							<div class="card-footer">
								<?php echo $this->element('misgrade_elements/showcause_buttons'); ?>
							</div>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="confirm_action" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="col-md-3 d-inline">Show Cause Notice PDF: </div>
				<div class="col-md-4 d-inline"><a target="blank" href="../applicationformspdfs/showcauseApplPdf" >Preview</a></div><br>
				<table class="mt-2">
					<tbody>
						<tr>
							<td>Applicant ID : </td>
							<td><?php echo $customer_id; ?></td>
						</tr>
						
					</tbody>
				</table>
				<div class="clearfix"></div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" id="final_submit"><i class="fa fa-check-circle"></i> Submit</button>
				<button class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="status_id" value="<?php echo $status; ?>">
<input type="hidden" id="customer_id_value" value="<?php echo $customer_id; ?>">
<input type="hidden" id="which_user" value="<?php echo $_SESSION['whichUser']; ?>">
<?php echo $this->Html->script('othermodules/showcause_home') ?>