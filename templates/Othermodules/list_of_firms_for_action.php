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
					<?php echo $this->Form->create(); ?>
						<div class="card card-primary">
							<div class="card-header"><h3 class="card-title-new">List of Firms</h3></div>
							<div class="form-horizontal">
								<table class="table table-hover table-bordered table-responsive">
								<caption>List of Firms Under this Office</caption>
									<thead class="tablehead">
										<tr>
											<th>Sr.No</th>
											<th>Applicant ID</th>
											<th>Firm Name</th>
											<th>Firm Contact</th>
											<th>Commodity</th>
											<th>Certification Type</th>
											<th>Take Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$sr_no=1; 
											foreach($underThisOffice as $eachdata){ ?>
												<tr>
													<td><?php echo $sr_no;?></td>
													<td><?php echo $eachdata['customer_id']; ?></td>
													<td><?php echo $eachdata['firm_name']; ?></td>
													<td>
														<?php echo "<span class='badge'>Mobile:</span>".base64_decode($eachdata['mobile_no']); ?>
														<br>
														<?php echo "<span class='badge'>Email:</span>".base64_decode($eachdata['email']); ?>
													</td>
													<td><?php echo $eachdata['certificate_type']; ?></td>
													<td><?php echo $eachdata['category_name']; ?></td>
													<td>
														<?php echo $this->Html->link('', array('controller' => 'othermodules', 'action'=>'fetchIdForAction', $eachdata['id']),array('class'=>'fas fa-arrow-right','title'=>'Go To Action Home')); ?>
														|
														<?php echo $this->Html->link('', array('controller' => 'othermodules', 'action'=>'fetchIdForShowcause', $eachdata['id']),array('class'=>'fas fa-exclamation-circle','title'=>'Send Show Cause Notice')); ?>

													</td>
												</tr>
											<?php $sr_no++; } 
										?>
									</tbody>
								</table>
							</div>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</section>
</div>
<?php echo $this->Html->script('othermodules/suspension_actions/actions_on_misgrading');?>